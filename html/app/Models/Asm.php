<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asm extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mail_id', 'group_id', 'groups_to_display'
    ];
    protected $casts = [
        'groups_to_display' => 'array',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }
}
