<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ping;
use Illuminate\Http\Request;

class PingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'uuid' => 'required|string',
            'battery_percent' => 'required|integer',
        ]);

        Ping::create([
            'uuid' => $request->uuid,
            'battery_percent' => $request->battery_percent,
        ]);

        return response()->json(['status' => 'ok']);
    }
}
