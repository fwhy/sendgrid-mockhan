<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingSettingClickTracking extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tracking_setting_id', 'enable', 'enable_text',
    ];
    protected $casts = [
        'enable' => 'boolean',
        'enable_text' => 'boolean',
    ];

    public function tracking_setting()
    {
        return $this->belongsTo(TrackingSetting::class);
    }
}
