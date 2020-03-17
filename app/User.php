<?php

namespace App;

use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(LikePost::class);
    }

    public function votes()
    {
        return $this->hasMany(VoteComment::class);
    }

    public function getAvatarAttribute()
    {
        if($this->avatar_path)
            return 'storage/'.$this->avatar_path;
        return env('DEFAULT_AVATAR_PATH');
    }
    public function hasLikedPost(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->where('user_id', Auth::user()->id)->count();
    }

    public function hasVoted(Comment $com)
    {
        return VoteComment::where('user_id', $this->id)->where('comment_id', $com->id)->count();
    }

    public function hasUpvoted(Comment $com)
    {
        $ret = false;
        if($this->hasVoted($com)) {
            $ret = VoteComment::where('user_id', $this->id)->where('comment_id', $com->id)->first()->voto;
        }
        return $ret;
    }

    public function hasDownvoted(Comment $com)
    {
        $ret = false;
        if($this->hasVoted($com)) {
            $ret = !(VoteComment::where('user_id', $this->id)->where('comment_id', $com->id)->first()->voto);
        }
        return $ret;
    }
}
