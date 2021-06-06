@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('campaigns.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.campaigns.create_title')
        </x-slot>

        <form method="POST" action="{{ route('campaigns.store') }}" enctype="multipart/form-data" id="campaignForm"
            class="mt-4">
            @csrf
            @include('app.campaigns.form-inputs')

            <div class="mt-10">
                <a href="{{ route('campaigns.index') }}" class="button">
                    <i class="mr-1 icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <button type="submit" class="button button-primary float-right">
                    <i class="mr-1 icon ion-md-save"></i>
                    @lang('crud.common.create')
                </button>
            </div>
        </form>
    </x-partials.card>
    @endsection