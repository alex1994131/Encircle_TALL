@php $editing = isset($user) @endphp
<div>
    <h1 class="text-xl px-4">Edit your personal Information</h1>
    <div class="grid grid-cols-4 mt-3">
        <div class="card-body col-span-1">
            <input type="file" id="photo" name="photo" style="display:none;" accept="image/*">
            <div id="avatar_wrapper" class="avatar_wrapper">
                @if(!$user->upload_avatar)
                <img src="{{ asset('img/default_avatar.png') }}" id="user_avatar" class="rounded-full user_avatar"
                    width="150" />
                @else
                <img src="{{ asset('storage/' . $user->upload_avatar) }}" id="user_avatar"
                    class="rounded-full user_avatar" width="150" />
                @endif
                <span class="search_avatar_icon">
                    <div id="search-toggle" class="search-icon cursor-pointer pl-1">
                        <svg class="fill-current pointer-events-none text-grey-darkest w-4 h-4 inline"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z">
                            </path>
                        </svg>
                    </div>
                </span>
            </div>
            <h4 class="text-lg font-medium md:text-center leading-6 text-gray-900">{{ $user->name}}</h4>
            <h6 class="mt-1 text-sm md:text-center text-gray-600">{{ $user->email }}</h6>
        </div>
        <div class="col-span-3 pl-5">
            <x-inputs.group class="w-full">
                <x-inputs.text name="name" label="Name" value="{{ old('name', ($editing ? $user->name : '')) }}"
                    maxlength="255" required></x-inputs.text>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.email name="email" label="Email" value="{{ old('email', ($editing ? $user->email : '')) }}"
                    maxlength="255" required></x-inputs.email>
            </x-inputs.group>

            <x-inputs.group class="w-full">
                <x-inputs.text name="department" label="Department"
                    value="{{ old('department', ($editing ? $user->department : '')) }}" maxlength="255">
                </x-inputs.text>
            </x-inputs.group>
            <x-inputs.group class="w-full">
                <x-inputs.text name="jobtitle" label="Job Title"
                    value="{{ old('jobtitle', ($editing ? $user->jobtitle : '')) }}" maxlength="255"></x-inputs.text>
            </x-inputs.group>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script>
var base_url = "{{ url('/') }}";
</script>
<script src="{{ asset('js/profile.js') }}"></script>