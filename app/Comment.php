<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Comment
 *
 * @mixin \Eloquent
 */
class Comment extends Model
{
    protected $fillable = ['contenuto', 'user_id', 'post_id'];
    public function quantoTempoFa() {
        Carbon::setLocale('it');
        return $this->created_at->diffForHumans();
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }


}
