@php $editing = isset($testType) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="test_name" label="Test Name"
            value="{{ old('test_name', ($editing ? $testType->test_name : '')) }}" maxlength="255" required>
        </x-inputs.text>
    </x-inputs.group>
</div>