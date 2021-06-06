@php $editing = isset($user) @endphp
<div>
    <div class="grid grid-cols-2">
        <x-inputs.group class="w-full">
            <x-inputs.text name="name" label="Name" value="{{ old('name', ($editing ? $user->name : '')) }}"
                maxlength="255" required></x-inputs.text>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.email name="email" label="Email" value="{{ old('email', ($editing ? $user->email : '')) }}"
                maxlength="255" required></x-inputs.email>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.password name="password" label="Password" maxlength="255" :required="!$editing">
            </x-inputs.password>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.password name="password_confirmation" label="Password Confirmation" maxlength="255"
                placeholder="Password Confirmation"></x-inputs.password>
        </x-inputs.group>

        <x-inputs.group class="w-full">
            <x-inputs.select name="trust_id" label="Trust" required>
                @php $selected = old('trust_id', ($editing ? $user->trust_id : '')) @endphp
                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Trust</option>
                @foreach($trusts as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </x-inputs.select>
            <x-inputs.text name="department" label="Department"
                value="{{ old('department', ($editing ? $user->department : '')) }}" maxlength="255"></x-inputs.text>
            <x-inputs.text name="jobtitle" label="Job Title"
                value="{{ old('jobtitle', ($editing ? $user->jobtitle : '')) }}" maxlength="255"></x-inputs.text>
        </x-inputs.group>

        <div class="px-4 my-4">
            <h4 class="font-bold text-lg">Assign @lang('crud.roles.name')</h4>

            <div class="py-2">
                @foreach ($roles as $role)
                <div>
                    <x-inputs.checkbox id="role{{ $role->id }}" name="roles[]" label="{{ ucfirst($role->name) }}"
                        value="{{ $role->id }}" :checked="isset($user) ? $user->hasRole($role) : false"
                        :add-hidden-value="false"></x-inputs.checkbox>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>