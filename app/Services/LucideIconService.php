<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class LucideIconService
{
    private const SVG_PATH = 'mallardduck/blade-lucide-icons/resources/svg';

    private const CACHE_KEY = 'lucide_icons_catalog';

    private const CACHE_TTL_SECONDS = 86400;

    /**
     * Normaliza un nombre a componente Blade Lucide (ej. lucide-bed-double).
     */
    public function normalize(?string $name): ?string
    {
        if ($name === null) {
            return null;
        }

        $name = trim($name);

        if ($name === '') {
            return null;
        }

        $name = Str::lower($name);
        $name = preg_replace('/[\s_]+/', '-', $name) ?? $name;
        $name = preg_replace('/[^a-z0-9\-]/', '', $name) ?? $name;
        $name = preg_replace('/-+/', '-', $name) ?? $name;
        $name = trim($name, '-');

        if ($name === '') {
            return null;
        }

        if (! str_starts_with($name, 'lucide-')) {
            $name = 'lucide-'.$name;
        }

        return $name;
    }

    /**
     * Nombre del archivo SVG sin extensión (ej. bed-double).
     */
    public function svgBasename(string $component): string
    {
        return str_starts_with($component, 'lucide-')
            ? substr($component, strlen('lucide-'))
            : $component;
    }

    public function exists(string $component): bool
    {
        $path = $this->svgPath($component);

        return $path !== null && is_file($path);
    }

    public function svgHtml(string $component): ?string
    {
        $path = $this->svgPath($component);

        if ($path === null || ! is_file($path)) {
            return null;
        }

        $svg = File::get($path);

        if ($svg === false || $svg === '') {
            return null;
        }

        // Asegura clases útiles en el preview
        if (str_contains($svg, '<svg')) {
            $svg = preg_replace(
                '/<svg\b([^>]*)>/',
                '<svg$1 class="size-5" aria-hidden="true">',
                $svg,
                1
            ) ?? $svg;
        }

        return $svg;
    }

    /**
     * @return list<string> Nombres sin prefijo lucide- (ej. bed-double)
     */
    public function catalog(): array
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, function () {
            $directory = base_path('vendor/'.self::SVG_PATH);

            if (! is_dir($directory)) {
                return [];
            }

            $files = File::files($directory);
            $names = [];

            foreach ($files as $file) {
                if ($file->getExtension() !== 'svg') {
                    continue;
                }

                $names[] = $file->getFilenameWithoutExtension();
            }

            sort($names);

            return $names;
        });
    }

    private function svgPath(string $component): ?string
    {
        $basename = $this->svgBasename($this->normalize($component) ?? '');

        if ($basename === '') {
            return null;
        }

        return base_path('vendor/'.self::SVG_PATH.'/'.$basename.'.svg');
    }
}
