@php $editing = isset($library) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="campaign_id" label="Campaign" required>
            @php $selected = old('campaign_id', ($editing ? $library->campaign_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Campaign</option>
            @foreach($campaigns as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="content" label="Content" maxlength="255" required>{{ old('content', ($editing ? $library->content : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>

    <button type="button"
        class="ml-4 px-2 py-1 border border-transparent text-xs leading-5 font-regular rounded-md text-white bg-blue-400 hover:bg-blue-300 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
        Name
    </button>
    <button type="button"
        class="ml-4 px-2 py-1 border border-transparent text-xs leading-5 font-regular rounded-md text-white bg-blue-400 hover:bg-blue-300 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
        Apt. Date
    </button>
    <button type="button"
        class="ml-4 px-2 py-1 border border-transparent text-xs leading-5 font-regular rounded-md text-white bg-blue-400 hover:bg-blue-300 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
        Location
    </button>
    <button type="button"
        class="ml-4 px-2 py-1 border border-transparent text-xs leading-5 font-regular rounded-md text-white bg-blue-400 hover:bg-blue-300 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
        Test
    </button>
    <button type="button"
        class="ml-4 px-2 py-1 border border-transparent text-xs leading-5 font-regular rounded-md text-white bg-blue-400 hover:bg-blue-300 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
        Result
    </button>

    <x-inputs.group class="w-full">
        <x-inputs.text name="data" label="Data" value="{{ old('data', ($editing ? $library->data : '')) }}"
            maxlength="255"></x-inputs.text>
    </x-inputs.group>

    <div class="w-full pl-4 pr-4 mb-6 mt-2">
        <label for="phone_number" class="block text-sm font-medium text-gray-700">Button 1</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 flex items-center">
                <label for="country" class="sr-only">Action / Link</label>
                <select id="country" name="country"
                    class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-mdblock appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                    <option>More Info</option>
                    <option>Book Online</option>
                    <option>Call</option>
                    <option>Snooze</option>
                </select>
            </div>
            <input type="text" name="phone_number" id="phone_number"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md">
        </div>
    </div>

    <div class="w-full pl-4 pr-4 mb-6">
        <label for="phone_number" class="block text-sm font-medium text-gray-700">Button 2</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <div class="absolute inset-y-0 left-0 flex items-center">
                <label for="country" class="sr-only">Action / Link</label>
                <select id="country" name="country"
                    class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-3 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-mdblock appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                    <option>More Info</option>
                    <option>Book Online</option>
                    <option>Call</option>
                    <option>Snooze</option>
                </select>
            </div>
            <input type="text" name="phone_number" id="phone_number"
                class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-16 sm:text-sm border-gray-300 rounded-md">
        </div>
    </div>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox name="published" label="Published"
            :checked="old('published', ($editing ? $library->published : 0))"></x-inputs.checkbox>
    </x-inputs.group>
</div>