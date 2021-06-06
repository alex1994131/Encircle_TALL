@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('trusts.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.trusts.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">@lang('crud.trusts.inputs.name')</h5>
                <span>{{ $trust->name ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">@lang('crud.trusts.inputs.logo')</h5>
                @if($trust->logo)
                <a href="{{ \Storage::url($trust->logo) }}" target="blank"><i
                        class="mr-1 icon ion-md-download"></i>&nbsp;Download</a>
                @else - @endif
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('trusts.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\Trust::class)
            <a href="{{ route('trusts.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection