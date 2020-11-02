<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingSettingSubscriptionTracking extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tracking_setting_id', 'enable', 'text', 'html', 'substitution_tag',
    ];
    protected $casts = [
        'enable' => 'boolean',
    ];

    public function tracking_setting()
    {
        return $this->belongsTo(TrackingSetting::class);
    }
}
