<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'uuid' => 'required|string',
                'battery_percent' => 'required|integer|min:0|max:100',
            ]);

            DB::transaction(function () use ($request) {
                Ping::create([
                    'uuid' => $request->uuid,
                    'battery_percent' => $request->battery_percent,
                ]);
            });

            return response()->json(['status' => 'ok']);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Server error'
            ], 500);
        }
    }
}
