<div>
    <div style="cursor: pointer;" onclick="vote(this)" class="px-2 @if(Auth::user()->hasUpvoted($comment))votato text-primary @endif" id="up-{{$comment->id}}">
        <i class="fas fa-arrow-up fa-lg" ></i>
    </div>
    <div style="cursor: pointer;" onclick="vote(this)" class="px-2 @if(Auth::user()->hasDownvoted($comment))votato text-danger @endif" id="down-{{$comment->id}}">
        <i class="fas fa-arrow-down fa-lg"></i>
    </div>
</div>
