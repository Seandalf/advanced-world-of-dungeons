<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RandomGenerator;
use Exception;
use Illuminate\Support\Facades\Log;

class ToolsController extends Controller
{
    public function randomGenerator($generate, $amount)
    {
        try {
            return response()->json([
                'success' => true,
                'results' => RandomGenerator::whereType($generate)
                                            ->take($amount)
                                            ->inRandomOrder()
                                            ->pluck('value')
                                            ->toArray()
            ])->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('Could not randomly generate', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'results' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function randomGeneratorTypes()
    {
        try {
            return response()->json([
                'success' => true,
                'types'   => RandomGenerator::select('type')
                                            ->distinct()
                                            ->pluck('type')
                                            ->toArray()
            ])->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('Could not get types', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'results' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
