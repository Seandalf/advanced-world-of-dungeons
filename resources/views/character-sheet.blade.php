<x-app-layout>
    <div class="flex flex-row-reverse">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a class="border-white border rounded-lg text-xs text-white px-3 py-2 uppercase tracking-widest hover:bg-white hover:text-violet" href="route('logout')"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                {{ __('Logout') }}
            </a>
        </form>
    </div>
    @foreach($characters as $character)
        <character-sheet class="pb-6" :id="{{ $character }}"></character-sheet>
    @endforeach
</x-app-layout>
