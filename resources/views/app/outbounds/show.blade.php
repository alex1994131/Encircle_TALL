@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('outbounds.index') }}" class="mr-4"
                ><i class="mr-1 icon ion-md-arrow-back"></i
            ></a>
            @lang('crud.outbounds.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.outbounds.inputs.keydate_id')
                </h5>
                <span>{{ optional($outbound->keydate)->type ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.outbounds.inputs.recipient')
                </h5>
                <span>{{ $outbound->recipient ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.outbounds.inputs.trust')
                </h5>
                <span>{{ $outbound->trust ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.outbounds.inputs.trust_logo')
                </h5>
                <span>{{ $outbound->trust_logo ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.outbounds.inputs.message')
                </h5>
                <span>{{ $outbound->message ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.outbounds.inputs.message_data')
                </h5>
                <span>{{ $outbound->message_data ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('outbounds.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\Outbound::class)
            <a href="{{ route('outbounds.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection
