<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';
    public function users() {
        return $this->belongsTo(User::class);
    }
}
