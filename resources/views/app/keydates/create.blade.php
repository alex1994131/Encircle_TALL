@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('keydates.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.keydates.create_title')
        </x-slot>

        <x-form method="POST" action="{{ route('keydates.store') }}" class="mt-4">
            @include('app.keydates.form-inputs')

            <div class="mt-10">
                <a href="{{ route('keydates.index') }}" class="button">
                    <i class="mr-1 icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <button type="submit" class="button button-primary float-right left-50%">
                    <i class="mr-1 icon ion-md-save"></i>
                    @lang('crud.common.create')
                </button>
            </div>
        </x-form>
    </x-partials.card>
</div>
@endsection