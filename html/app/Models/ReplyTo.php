<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyTo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mail_id', 'email', 'name',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }

    public function __toString()
    {
        return ($this->name) ? "{$this->name} <{$this->email}>" : $this->email;
    }
}
