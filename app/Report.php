<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [ 'reporter','reported'];
    public function reportable()
    {
        return $this->morphTo();
    }
}
