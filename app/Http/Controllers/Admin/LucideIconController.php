<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\LucideIconService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LucideIconController extends Controller
{
    public function catalog(LucideIconService $icons): JsonResponse
    {
        return response()->json([
            'icons' => $icons->catalog(),
        ]);
    }

    public function preview(Request $request, LucideIconService $icons): JsonResponse
    {
        $component = $icons->normalize($request->query('name'));

        if ($component === null || ! $icons->exists($component)) {
            return response()->json([
                'message' => 'Icono no encontrado.',
            ], 404);
        }

        return response()->json([
            'component' => $component,
            'html' => $icons->svgHtml($component),
        ]);
    }

    /**
     * Preview en lote para el grid del picker.
     * GET admin/icons/previews?names=bed-double,umbrella,...
     */
    public function previews(Request $request, LucideIconService $icons): JsonResponse
    {
        $raw = $request->query('names', '');
        $names = is_array($raw)
            ? $raw
            : array_filter(array_map('trim', explode(',', (string) $raw)));

        $names = array_slice($names, 0, 60);
        $result = [];

        foreach ($names as $name) {
            $component = $icons->normalize(is_string($name) ? $name : null);

            if ($component === null || ! $icons->exists($component)) {
                continue;
            }

            $basename = $icons->svgBasename($component);
            $result[$basename] = $icons->svgHtml($component);
        }

        return response()->json([
            'icons' => $result,
        ]);
    }
}
