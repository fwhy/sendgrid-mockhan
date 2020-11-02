<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    public const UPDATED_AT = null;
    public const CREATED_AT = 'created_at';
    protected $with = [
        'personalizations', 'from', 'reply_to', 'content', 'attachments', 'asm',
        'mail_settings',
    ];
    protected $fillable = [
        'subject', 'template_id', 'headers', 'categories', 'custom_args', 'send_at',
        'batch_id', 'ip_pool_name',
    ];
    protected $casts = [
        'headers' => 'array',
        'categories' => 'array',
        'custom_args' => 'array',
    ];

    public function personalizations()
    {
        return $this->hasMany(Personalization::class);
    }

    public function from()
    {
        return $this->hasOne(From::class);
    }

    public function reply_to()
    {
        return $this->hasOne(ReplyTo::class);
    }

    public function content()
    {
        return $this->hasMany(Content::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function asm()
    {
        return $this->hasOne(Asm::class);
    }

    public function mail_settings()
    {
        return $this->hasOne(MailSetting::class);
    }

    public function tracking_settings()
    {
        return $this->hasOne(TrackingSetting::class);
    }
}
