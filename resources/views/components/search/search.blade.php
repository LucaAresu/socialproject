<div class="bg-white">
    @forelse($users as $user)
        <a class="linkRicerca" href="{{route('user_post', compact('user'))}}">
            <div class="risultatoRicerca p-2">
                @component('components.avatar',compact('user'))
                    {{$user->name }}
                @endcomponent
            </div>
        </a>
        @empty
        <div class="p-2">
        Nessun Utente Trovato
        </div>
    @endforelse
</div>
