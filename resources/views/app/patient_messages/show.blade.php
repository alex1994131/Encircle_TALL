@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('patient-messages.index') }}" class="mr-4"
                ><i class="mr-1 icon ion-md-arrow-back"></i
            ></a>
            @lang('crud.patient_messages.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_messages.inputs.patient_id')
                </h5>
                <span
                    >{{ optional($patientMessage->patient)->name ?? '-' }}</span
                >
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_messages.inputs.patient_campaign_id')
                </h5>
                <span
                    >{{ optional($patientMessage->patientCampaign)->title ?? '-'
                    }}</span
                >
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_messages.inputs.library_id')
                </h5>
                <span
                    >{{ optional($patientMessage->library)->data ?? '-' }}</span
                >
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_messages.inputs.content')
                </h5>
                <span>{{ $patientMessage->content ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_messages.inputs.data')
                </h5>
                <span>{{ $patientMessage->data ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('patient-messages.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\PatientMessage::class)
            <a href="{{ route('patient-messages.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection
