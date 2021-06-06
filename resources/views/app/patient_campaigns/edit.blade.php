@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('patient-campaigns.index') }}" class="mr-4"
                ><i class="mr-1 icon ion-md-arrow-back"></i
            ></a>
            @lang('crud.patient_campaigns.edit_title')
        </x-slot>

        <x-form
            method="PUT"
            action="{{ route('patient-campaigns.update', $patientCampaign) }}"
            class="mt-4"
        >
            @include('app.patient_campaigns.form-inputs')

            <div class="mt-10">
                <a href="{{ route('patient-campaigns.index') }}" class="button">
                    <i class="mr-1 icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <a
                    href="{{ route('patient-campaigns.create') }}"
                    class="button"
                >
                    <i class="mr-1 icon ion-md-add text-primary"></i>
                    @lang('crud.common.create')
                </a>

                <button type="submit" class="button button-primary float-right">
                    <i class="mr-1 icon ion-md-save"></i>
                    @lang('crud.common.update')
                </button>
            </div>
        </x-form>
    </x-partials.card>
</div>
@endsection
