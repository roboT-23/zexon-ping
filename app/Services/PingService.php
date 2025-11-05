<?php

namespace App\Services;

use App\Models\Ping;
use Illuminate\Support\Facades\DB;

class PingService
{
    /**
     * Store a new ping record.
     */
    public function storePing(string $uuid, int $batteryPercent): Ping
    {
        return DB::transaction(function () use ($uuid, $batteryPercent) {
            return Ping::create([
                'uuid' => $uuid,
                'battery_percent' => $batteryPercent,
            ]);
        });
    }
}
