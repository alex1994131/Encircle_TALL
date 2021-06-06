@php $editing = isset($patientCampaign) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="patient_id" label="Patient" required>
            @php $selected = old('patient_id', ($editing ? $patientCampaign->patient_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Patient</option>
            @foreach($patients as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="title" label="Title" value="{{ old('title', ($editing ? $patientCampaign->title : '')) }}"
            maxlength="255" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="condition" label="Condition"
            value="{{ old('condition', ($editing ? $patientCampaign->condition : '')) }}" maxlength="255" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="subcondition" label="Subcondition"
            value="{{ old('subcondition', ($editing ? $patientCampaign->subcondition : '')) }}" maxlength="255"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="campaign_id" label="Campaign" required>
            @php $selected = old('campaign_id', ($editing ? $patientCampaign->campaign_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Campaign</option>
            @foreach($campaigns as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="content" label="Content" maxlength="255" required>{{ old('content', ($editing ? $patientCampaign->content : ''))
            }}</x-inputs.textarea>
    </x-inputs.group>
</div>