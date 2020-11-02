<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalizationTo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'personalization_id', 'email', 'name',
    ];

    public function personalization()
    {
        return $this->belongsTo(Personalization::class);
    }

    public function __toString()
    {
        return ($this->name) ? "{$this->name} <{$this->email}>" : $this->email;
    }
}
