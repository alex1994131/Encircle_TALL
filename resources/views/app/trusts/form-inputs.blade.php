@php $editing = isset($trust) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="name" label="Name" value="{{ old('name', ($editing ? $trust->name : '')) }}"
            maxlength="255" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.partials.label name="logo" label="Logo"></x-inputs.partials.label><br />

        <input type="file" name="logo" id="logo" class="form-control-file" />
        @if($editing && $trust->logo)
        <div class="mt-2">
            <a href="{{ \Storage::url($trust->logo) }}" target="_blank"><i
                    class="icon ion-md-download"></i>&nbsp;Download</a>
        </div>
        @endif @error('logo') @include('components.inputs.partials.error')
        @enderror
    </x-inputs.group>
</div>