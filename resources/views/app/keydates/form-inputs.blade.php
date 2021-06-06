@php $editing = isset($keydate) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="type" label="Type" value="{{ old('type', ($editing ? $keydate->type : '')) }}"
            maxlength="255" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="test_order" label="Test Order"
            value="{{ old('test_order', ($editing ? $keydate->test_order : '')) }}" maxlength="255" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="next_test_order" label="Next Test Order"
            value="{{ old('next_test_order', ($editing ? $keydate->next_test_order : '')) }}" maxlength="255" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="lab_ref" label="Lab Ref" value="{{ old('lab_ref', ($editing ? $keydate->lab_ref : '')) }}"
            maxlength="255" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="next_appointment" label="Next Appointment"
            value="{{ old('next_appointment', ($editing ? $keydate->next_appointment : '')) }}" maxlength="255"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.datetime name="apt_date" label="Apt Date"
            value="{{ old('apt_date', ($editing ? optional($keydate->apt_date)->format('Y-m-d\TG:i:s') : '')) }}"
            max="255" required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number name="campaign_num" label="Campaign Num"
            value="{{ old('campaign_num', ($editing ? $keydate->campaign_num : '')) }}" max="255" required>
        </x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="test_type_id" label="Test Type" required>
            @php $selected = old('test_type_id', ($editing ? $keydate->test_type_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Test Type</option>
            @foreach($testTypes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="result" label="Test Result" value="{{ old('result', ($editing ? $keydate->result : '')) }}"
            maxlength="255" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="patient_id" label="Patient Id">
            @php $selected = old('patient_id', ($editing ? $keydate->patient_id : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>
</div>