<?php
/**
 * App\VoteComment
 *
 * @mixin \Eloquent
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteComment extends Model
{
    function user()
    {
        return $this->belongsTo(User::class);
    }

    function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
