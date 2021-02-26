<x-app-layout>
    @foreach($characters as $character)
        <character-sheet class="pb-6" :id="{{ $character }}"></character-sheet>
    @endforeach
</x-app-layout>
