<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSettingFooter extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mail_setting_id', 'enable', 'text', 'html',
    ];
    protected $casts = [
        'enable' => 'boolean',
    ];

    public function mail_setting()
    {
        return $this->belongsTo(MailSetting::class);
    }
}
