@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('keydates.index') }}" class="mr-4"
                ><i class="mr-1 icon ion-md-arrow-back"></i
            ></a>
            @lang('crud.keydates.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.type')
                </h5>
                <span>{{ $keydate->type ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.test_order')
                </h5>
                <span>{{ $keydate->test_order ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.next_test_order')
                </h5>
                <span>{{ $keydate->next_test_order ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.lab_ref')
                </h5>
                <span>{{ $keydate->lab_ref ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.next_appointment')
                </h5>
                <span>{{ $keydate->next_appointment ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.apt_date')
                </h5>
                <span>{{ $keydate->apt_date ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.campaign_num')
                </h5>
                <span>{{ $keydate->campaign_num ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.test_type_id')
                </h5>
                <span
                    >{{ optional($keydate->testType)->test_name ?? '-'
                    }}</span
                >
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.result')
                </h5>
                <span>{{ $keydate->result ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">
                    @lang('crud.keydates.inputs.patient_id')
                </h5>
                <span>{{ $keydate->patient_id ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('keydates.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\Keydate::class)
            <a href="{{ route('keydates.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection
