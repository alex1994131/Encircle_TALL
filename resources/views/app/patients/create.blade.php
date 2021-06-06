@extends('layouts.app')

@section('style')
   <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('patients.index') }}" class="mr-4"
                ><i class="mr-1 icon ion-md-arrow-back"></i
            ></a>
            @lang('crud.patients.create_title')
        </x-slot>
    </x-partials.card>
    <x-form
            method="POST"
            action="{{ route('patients.store') }}"
            class="mt-4 create-form"
            novalidate
        >
        @include('app.patients.form-inputs')

        <div class="mt-10 p-2">
            <a href="{{ route('patients.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left text-primary"></i>
                @lang('crud.common.back')
            </a>
        </div>
    </x-form>                        
</div>
@endsection

@section('scripts_section')
    @include('app.patients.partials.scripts')
    @include('app.patients.partials.modal')
@endsection