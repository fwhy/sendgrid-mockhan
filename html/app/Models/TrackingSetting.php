<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingSetting extends Model
{
    public $timestamps = false;
    protected $with = [
        'click_tracking', 'open_tracking', 'subscription_tracking', 'ganalytics',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }

    public function click_tracking()
    {
        return $this->hasOne(TrackingSettingClickTracking::class);
    }

    public function open_tracking()
    {
        return $this->hasOne(TrackingSettingOpenTracking::class);
    }

    public function subscription_tracking()
    {
        return $this->hasOne(TrackingSettingSubscriptionTracking::class);
    }

    public function ganalytics()
    {
        return $this->hasOne(TrackingSettingGanalytics::class);
    }
}
