<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

class HotelGroupImageService
{
    private const DIRECTORY = 'travel_media/hotel_groups';

    private const THUMB_MAX_WIDTH = 300;

    private const CROP_SIZE = 40;

    /**
     * Guarda la imagen original y genera variantes t_ y c_.
     *
     * @return array{
     *     img_original_name: string,
     *     img_new_name: string,
     *     img_compound_name: string,
     *     img_extension: string,
     *     img_hash_name: string,
     *     img_file_size: int
     * }
     */
    public function store(UploadedFile $file, string $name): array
    {
        $directory = storage_path(self::DIRECTORY);

        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
            throw new RuntimeException('No se pudo crear el directorio de grupos de hotel.');
        }

        $originalName = $file->getClientOriginalName();
        $clientExtension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'jpg');
        $newName = Str::slug($name) ?: 'grupo-hotel';
        $hashName = Str::lower(Str::random(8));
        $tempName = "{$newName}_{$hashName}.tmp";
        $tempPath = $directory . '/' . $tempName;

        if (! $file->move($directory, $tempName)) {
            throw new RuntimeException('No se pudo guardar la imagen del grupo de hotel.');
        }

        try {
            // La extensión del cliente puede mentir (p. ej. JPEG con nombre .webp).
            $extension = $this->detectExtension($tempPath, $clientExtension);
            $compoundName = "{$newName}_{$hashName}.{$extension}";
            $originalPath = $directory . '/' . $compoundName;
            $thumbPath = $directory . '/t_' . $compoundName;
            $cropPath = $directory . '/c_' . $compoundName;

            if (! rename($tempPath, $originalPath)) {
                throw new RuntimeException('No se pudo preparar la imagen del grupo de hotel.');
            }
            $tempPath = null;

            $this->createThumbnail($originalPath, $thumbPath, $extension);
            $this->createCrop($originalPath, $cropPath, $extension);
        } catch (\Throwable $e) {
            if ($tempPath && is_file($tempPath)) {
                unlink($tempPath);
            }
            if (isset($compoundName)) {
                $this->delete($compoundName);
            }

            throw $e;
        }

        return [
            'img_original_name' => $originalName,
            'img_new_name' => $newName,
            'img_compound_name' => $compoundName,
            'img_extension' => $extension,
            'img_hash_name' => $hashName,
            'img_file_size' => (int) (is_file($originalPath) ? filesize($originalPath) : 0),
        ];
    }

    /**
     * Elimina original + variantes t_ y c_ del storage.
     */
    public function delete(?string $compoundName): void
    {
        if (empty($compoundName)) {
            return;
        }

        $directory = storage_path(self::DIRECTORY);

        foreach (['', 't_', 'c_'] as $prefix) {
            $path = $directory . '/' . $prefix . $compoundName;
            if (is_file($path)) {
                unlink($path);
            }
        }
    }

    private function createThumbnail(string $source, string $destination, string $extension): void
    {
        [$sourceImage, $width, $height] = $this->loadImage($source, $extension);

        $targetWidth = min(self::THUMB_MAX_WIDTH, $width);
        $targetHeight = (int) max(1, round($height * ($targetWidth / $width)));

        $thumb = imagecreatetruecolor($targetWidth, $targetHeight);
        $this->preserveTransparency($thumb, $extension);
        imagecopyresampled($thumb, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
        $this->saveImage($thumb, $destination, $extension);

        imagedestroy($sourceImage);
        imagedestroy($thumb);
    }

    private function createCrop(string $source, string $destination, string $extension): void
    {
        [$sourceImage, $width, $height] = $this->loadImage($source, $extension);

        $side = min($width, $height);
        $srcX = (int) (($width - $side) / 2);
        $srcY = (int) (($height - $side) / 2);

        $crop = imagecreatetruecolor(self::CROP_SIZE, self::CROP_SIZE);
        $this->preserveTransparency($crop, $extension);
        imagecopyresampled(
            $crop,
            $sourceImage,
            0,
            0,
            $srcX,
            $srcY,
            self::CROP_SIZE,
            self::CROP_SIZE,
            $side,
            $side
        );
        $this->saveImage($crop, $destination, $extension);

        imagedestroy($sourceImage);
        imagedestroy($crop);
    }

    /**
     * Detecta el formato real del archivo (no confía en la extensión del cliente).
     */
    private function detectExtension(string $path, string $fallback = 'jpg'): string
    {
        $type = @exif_imagetype($path);

        return match ($type) {
            IMAGETYPE_JPEG => 'jpg',
            IMAGETYPE_PNG => 'png',
            IMAGETYPE_WEBP => 'webp',
            default => match (strtolower($fallback)) {
                'jpeg', 'jpg' => 'jpg',
                'png' => 'png',
                'webp' => 'webp',
                default => throw new RuntimeException('Formato de imagen no soportado o archivo corrupto.'),
            },
        };
    }

    /**
     * @return array{0: \GdImage, 1: int, 2: int}
     */
    private function loadImage(string $path, string $extension): array
    {
        $extension = $this->detectExtension($path, $extension);

        $image = match ($extension) {
            'jpg', 'jpeg' => @imagecreatefromjpeg($path),
            'png' => @imagecreatefrompng($path),
            'webp' => @imagecreatefromwebp($path),
            default => false,
        };

        if ($image === false) {
            throw new RuntimeException('No se pudo leer la imagen subida. Usa JPG, PNG o WEBP válido.');
        }

        $width = imagesx($image);
        $height = imagesy($image);

        return [$image, $width, $height];
    }

    private function preserveTransparency(\GdImage $image, string $extension): void
    {
        if (! in_array($extension, ['png', 'webp'], true)) {
            return;
        }

        imagealphablending($image, false);
        imagesavealpha($image, true);
        $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefilledrectangle($image, 0, 0, imagesx($image), imagesy($image), $transparent);
    }

    private function saveImage(\GdImage $image, string $path, string $extension): void
    {
        $ok = match ($extension) {
            'jpg', 'jpeg' => imagejpeg($image, $path, 85),
            'png' => imagepng($image, $path, 6),
            'webp' => imagewebp($image, $path, 85),
            default => false,
        };

        if (! $ok) {
            throw new RuntimeException('No se pudo generar la variante de imagen.');
        }
    }
}
