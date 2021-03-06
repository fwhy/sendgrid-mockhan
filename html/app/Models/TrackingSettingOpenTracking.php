<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingSettingOpenTracking extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tracking_setting_id', 'enable', 'substitution_tag',
    ];
    protected $casts = [
        'enable' => 'boolean',
    ];

    public function tracking_setting()
    {
        return $this->belongsTo(TrackingSetting::class);
    }
}
