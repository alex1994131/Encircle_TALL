@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('patient-campaigns.index') }}" class="mr-4"
                ><i class="mr-1 icon ion-md-arrow-back"></i
            ></a>
            @lang('crud.patient_campaigns.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_campaigns.inputs.patient_id')
                </h5>
                <span
                    >{{ optional($patientCampaign->patient)->name ?? '-'
                    }}</span
                >
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_campaigns.inputs.title')
                </h5>
                <span>{{ $patientCampaign->title ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_campaigns.inputs.condition')
                </h5>
                <span>{{ $patientCampaign->condition ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_campaigns.inputs.subcondition')
                </h5>
                <span>{{ $patientCampaign->subcondition ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_campaigns.inputs.campaign_id')
                </h5>
                <span
                    >{{ optional($patientCampaign->campaign)->title ?? '-'
                    }}</span
                >
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.patient_campaigns.inputs.content')
                </h5>
                <span>{{ $patientCampaign->content ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('patient-campaigns.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\PatientCampaign::class)
            <a href="{{ route('patient-campaigns.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection
