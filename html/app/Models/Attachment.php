<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mail_id', 'content', 'type', 'filename', 'disposition', 'content_id',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }
}
