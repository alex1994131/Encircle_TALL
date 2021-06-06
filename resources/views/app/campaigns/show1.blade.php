@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('campaigns.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.campaigns.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.campaigns.inputs.trust_id')
                </h5>
                <span>{{ optional($campaign->trusts)->name ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.campaigns.inputs.content')
                </h5>
                <span>{{ $campaign->content ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.campaigns.inputs.title')
                </h5>
                <span>{{ $campaign->title ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.campaigns.inputs.condition')
                </h5>
                <span>{{ $campaign->condition ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.campaigns.inputs.subcondition')
                </h5>
                <span>{{ $campaign->subcondition ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.campaigns.inputs.published')
                </h5>
                <span>{{ $campaign->published ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('campaigns.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\Campaign::class)
            <a href="{{ route('campaigns.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection