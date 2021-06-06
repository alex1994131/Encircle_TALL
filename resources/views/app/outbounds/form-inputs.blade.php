@php $editing = isset($outbound) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="keydate_id" label="Keydate" required>
            @php $selected = old('keydate_id', ($editing ? $outbound->keydate_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Keydate</option>
            @foreach($keydates as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="recipient"
            label="Recipient"
            value="{{ old('recipient', ($editing ? $outbound->recipient : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="trust"
            label="Trust"
            value="{{ old('trust', ($editing ? $outbound->trust : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="trust_logo"
            label="Trust Logo"
            value="{{ old('trust_logo', ($editing ? $outbound->trust_logo : '')) }}"
            maxlength="255"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea
            name="message"
            label="Message"
            maxlength="255"
            required
            >{{ old('message', ($editing ? $outbound->message : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="message_data"
            label="Message Data"
            value="{{ old('message_data', ($editing ? $outbound->message_data : '')) }}"
            maxlength="255"
        ></x-inputs.text>
    </x-inputs.group>
</div>
