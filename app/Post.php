<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function env;


/**
 * App\Post
 *
 * @mixin \Eloquent
 */
class Post extends Model
{
    use SoftDeletes;


    protected $fillable = ['titolo', 'contenuto', 'user_id'];

    public function quantoTempoFa() {
        Carbon::setLocale('it');
        return $this->created_at->diffForHumans();
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(LikePost::class);
    }

    public function getCommentiInOrdineTemporale()
    {

        return $this->comments()->withTrashed()->orderBy('created_at', 'desc')->take(env('COMMENTS_PER_PAGE'))->get();
    }

    public function getImageAttribute()
    {
        if($this->image_path)
            return 'storage/'.$this->image_path;
    }

    public function hasImage() {
        if($this->image_path)
            return true;
        return false;
    }
    public function likesCount()
    {
        return $this->likes()->count();
    }

    public function reports()
    {
        return $this->morphMany(Report::class, 'reportable');
    }
}
