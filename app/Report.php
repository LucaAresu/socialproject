<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = [ 'reporter','reported'];
    public function reportable()
    {
        return $this->morphTo();
    }
}
