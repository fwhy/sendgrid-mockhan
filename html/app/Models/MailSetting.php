<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    public $timestamps = false;
    protected $with = [
        'bypass_list_management', 'footer', 'sandbox_mode', 'spam_check',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }

    public function bypass_list_management()
    {
        return $this->hasOne(MailSettingBypassListManagement::class);
    }

    public function footer()
    {
        return $this->hasOne(MailSettingFooter::class);
    }

    public function sandbox_mode()
    {
        return $this->hasOne(MailSettingSandboxMode::class);
    }

    public function spam_check()
    {
        return $this->hasOne(MailSettingSpamCheck::class);
    }
}
