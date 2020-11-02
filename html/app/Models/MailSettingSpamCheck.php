<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSettingSpamCheck extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mail_setting_id', 'enable', 'threshold', 'post_to_url',
    ];
    protected $casts = [
        'enable' => 'boolean',
    ];

    public function mail_setting()
    {
        return $this->belongsTo(MailSetting::class);
    }
}
