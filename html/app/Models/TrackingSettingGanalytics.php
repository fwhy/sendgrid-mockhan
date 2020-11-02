<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingSettingGanalytics extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tracking_setting_id', 'enable', 'utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign'
    ];
    protected $casts = [
        'enable' => 'boolean',
    ];

    public function tracking_setting()
    {
        return $this->belongsTo(TrackingSetting::class);
    }
}
