@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="javascript:void(0)" class="back_edit_patient mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.campaigns.edit_title')
        </x-slot>

        <form method="POST"
            action="{{ route('patients.campaign.update',['campaign' => $campaign, 'patient' => $patient ]) }}"
            enctype="multipart/form-data" id="patientcampaignForm" class="mt-4">
            @csrf
            @include('app.patients.campaign-form-input')

            <div class="mt-10">
                <a href="javascript:void(0)" id="back_edit_patient" class="back_edit_patient button">
                    <i class="mr-1 icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <button type="submit" class="button button-primary float-right">
                    <i class="mr-1 icon ion-md-save"></i>
                    @lang('crud.common.update')
                </button>
            </div>
        </form>
    </x-partials.card>
    @endsection