<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personalization extends Model
{
    public $timestamps = false;
    protected $with = [
        'from', 'to', 'cc', 'bcc',
    ];
    protected $fillable = [
        'mail_id', 'subject', 'headers', 'substitutions', 'custom_args', 'send_at',
    ];
    protected $casts = [
        'headers' => 'array',
        'substitutions' => 'array',
        'custom_args' => 'array',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }

    public function from()
    {
        return $this->hasOne(PersonalizationFrom::class);
    }

    public function to()
    {
        return $this->hasMany(PersonalizationTo::class);
    }

    public function cc()
    {
        return $this->hasMany(PersonalizationCc::class);
    }

    public function bcc()
    {
        return $this->hasMany(PersonalizationBcc::class);
    }
}
