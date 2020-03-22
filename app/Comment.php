<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Comment
 *
 * @mixin \Eloquent
 */
class Comment extends Model
{

    use SoftDeletes;

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
    public function votes()
    {
        return $this->hasMany(VoteComment::class);
    }
    public function getUpvotesnumberAttribute()
    {
        return VoteComment::where('comment_id',$this->id)->where('voto', true)->count();
    }
    public function getDownvotesnumberAttribute()
    {
        return VoteComment::where('comment_id',$this->id)->where('voto', false)->count();
    }


    public function getPuntiAttribute()
    {
        return $this->upvotesnumber - $this->downvotesnumber;
    }


}
