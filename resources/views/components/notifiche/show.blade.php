<ul>
    @forelse($notifications as $notification)
        @switch($notification->type)
            @case('App\Notifications\NewCommentNotification')
                @component('components.notifiche.comment', compact('notification'))
                @endcomponent
                @break
            @case('App\Notifications\NewFollowNotification')
                @component('components.notifiche.follow',compact('notification'))
                @endcomponent
                @break

        @endswitch
    @empty
        <li>Non hai nuove notifiche al momento!</li>
    @endforelse
</ul>
