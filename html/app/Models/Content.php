<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mail_id', 'type', 'value',
    ];

    public function mail()
    {
        return $this->belongsTo(Mail::class);
    }

    public function formattedValue(?array $substitutions)
    {
        return strtr($this->value, (array)$substitutions);
    }
}
