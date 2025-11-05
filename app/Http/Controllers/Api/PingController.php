<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePingRequest;
use App\Services\PingService;
use Illuminate\Http\JsonResponse;

class PingController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(
        private readonly PingService $pingService
    ) {}

    /**
     * Store a new ping record.
     */
    public function store(StorePingRequest $request): JsonResponse
    {
        try {
            $this->pingService->storePing(
                uuid: $request->validated('uuid'),
                batteryPercent: $request->validated('battery_percent')
            );

            return response()->json(['status' => 'ok']);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Server error'
            ], 500);
        }
    }
}
