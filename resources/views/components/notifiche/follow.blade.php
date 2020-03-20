@php
    $user = \App\User::find($notification->data['userId']);
@endphp
<li>Ora
    @component('components.user', compact('user'))
    @endcomponent
    ti segue!
</li>
