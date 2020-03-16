@foreach($comments as $comment)
    @component('components.singleComment', compact('comment'))
    @endcomponent
@endforeach
