<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSettingBypassListManagement extends Model
{
    protected $table = 'mail_setting_bypass_list_managements';
    public $timestamps = false;
    protected $fillable = [
        'mail_setting_id', 'enable'
    ];
    protected $casts = [
        'enable' => 'boolean',
    ];

    public function mail_setting()
    {
        return $this->belongsTo(MailSetting::class);
    }
}
