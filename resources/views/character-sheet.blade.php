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
        @if($needs_creation)
            <form method="post" action="{{ route('character.create') }}">
            @csrf

                <div class="text-sm mt-4 overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                <div class="bg-white px-2 py-3 sm:px-3 flex">
                    <div class="font-semibold uppercase tracking-widest text-gray-600">
                    Character Creation
                    </div>
                </div>
                <div class="bg-white bg-opacity-95 p-4 sm:p-3">
                    <h4 class="text-sm text-violet font-semibold tracking-wide">Character Name</h4>
                    <p class="text-sm leading-loose text-gray-800">Pick a name for your character. Something snazzy that commands respect from your peers and strikes fear into the hearts of your enemies.</p>
                    <div class="mt-4 grid grid-cols-1">
                        <div class="col-span-1">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-3 border-t border-gray-100 pt-3 text-sm text-violet font-semibold tracking-wide">Stats</h4>
                    <p class="text-sm leading-loose text-gray-800">Roll 2d6. On a 6-, the value is 0, on a 7-9 the value is +1, on a 10-11 the value is +2, and on a 12 the value is +3. Repeat this process until you have 6 different values.</p>
                    <p class="text-sm leading-loose text-gray-800">Assign your each of your 6 values to one of the stats below (just the numbers, no +), until you have a value for all stats.</p>
                    <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="col-span-1">
                            <label for="str" class="block text-sm font-medium text-gray-700">Strength</label>
                            <div class="mt-1">
                                <input type="text" name="str" id="str" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label for="dex" class="block text-sm font-medium text-gray-700">Dexterity</label>
                            <div class="mt-1">
                                <input type="text" name="dex" id="dex" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label for="con" class="block text-sm font-medium text-gray-700">Constitution</label>
                            <div class="mt-1">
                                <input type="text" name="con" id="con" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label for="int" class="block text-sm font-medium text-gray-700">Intelligence</label>
                            <div class="mt-1">
                                <input type="text" name="int" id="int" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label for="wis" class="block text-sm font-medium text-gray-700">Wisdom</label>
                            <div class="mt-1">
                                <input type="text" name="wis" id="wis" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="col-span-1">
                            <label for="cha" class="block text-sm font-medium text-gray-700">Charisma</label>
                            <div class="mt-1">
                                <input type="text" name="cha" id="cha" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-3 border-t border-gray-100 pt-3 text-sm text-violet font-semibold tracking-wide">Health</h4>
                    <p class="text-sm leading-loose text-gray-800">You have hit dice equal to 1 + CON. Roll a number of d6 equal to your hit dice and add the total. That number +4 is your starting Maximum HP.</p>
                    <div class="mt-4 grid grid-cols-1">
                        <div class="col-span-1">
                            <label for="max_hp" class="block text-sm font-medium text-gray-700">Maximum HP</label>
                            <div class="mt-1">
                                <input type="text" name="max_hp" id="max_hp" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                    </div>

                    <h4 class="mt-3 border-t border-gray-100 pt-3 text-sm text-violet font-semibold tracking-wide">Skills</h4>
                    <p class="text-sm leading-loose text-gray-800">Choose one skill for your character to have, in addition to the skill granted to you by your class.</p>
                    <div class="mt-4 grid grid-cols-1">
                        <div class="col-span-1">
                            <label for="skill" class="block text-sm font-medium text-gray-700">Skill</label>
                            <select id="skill" name="skill" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @foreach($skills as $skill)
                                    <option value="{{ $skill['id'] }}">{{ $skill['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <h4 class="mt-3 border-t border-gray-100 pt-3 text-sm text-violet font-semibold tracking-wide">Background</h4>
                    <p class="text-sm leading-loose text-gray-800">Pick a background for your character. This is something that describes your characters upbringing, childhood, an early life event, or something else that accounts for the formative years of your character.</p>
                    <div class="mt-4 grid grid-cols-1">
                        <div class="col-span-1">
                            <label for="background_id" class="block text-sm font-medium text-gray-700">Background</label>
                            <select id="background_id" name="background_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                @foreach($backgrounds as $background)
                                    <option value="{{ $background['id'] }}">{{ $background['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-3">
                            {{ __('Create!') }}
                        </x-button>
                    </div>

                </div>
                </div>
            </form>
        @else
            <character-sheet class="pb-6" :id="{{ $character }}"></character-sheet>
        @endif
    @endforeach
</x-app-layout>
