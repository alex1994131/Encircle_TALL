@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <div class="flex justify-between">
            <x-slot name="title">
                @lang('crud.patient_campaigns.index_title')
            </x-slot>
        </div>

        <div class="mt-4 mb-5">
            <div class="flex flex-wrap">
                <div class="md:w-1/2">
                    <form>
                        <div class="flex items-stretch w-full">
                            <x-inputs.text
                                id="indexSearch"
                                name="search"
                                value="{{ $search ?? '' }}"
                                placeholder="{{ __('crud.common.search') }}"
                                autocomplete="off"
                            ></x-inputs.text>

                            <div class="ml-1">
                                <button
                                    type="submit"
                                    class="button button-primary"
                                >
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="md:w-1/2 text-right">
                    @can('create', App\Models\PatientCampaign::class)
                    <a
                        href="{{ route('patient-campaigns.create') }}"
                        class="button button-primary"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="block w-full overflow-auto scrolling-touch">
            <table class="w-full max-w-full mb-4 bg-transparent">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left">
                            @lang('crud.patient_campaigns.inputs.patient_id')
                        </th>
                        <th class="px-4 py-3 text-left">
                            @lang('crud.patient_campaigns.inputs.title')
                        </th>
                        <th class="px-4 py-3 text-left">
                            @lang('crud.patient_campaigns.inputs.condition')
                        </th>
                        <th class="px-4 py-3 text-left">
                            @lang('crud.patient_campaigns.inputs.subcondition')
                        </th>
                        <th class="px-4 py-3 text-left">
                            @lang('crud.patient_campaigns.inputs.campaign_id')
                        </th>
                        <th class="px-4 py-3 text-left">
                            @lang('crud.patient_campaigns.inputs.content')
                        </th>
                        <th class="px-4 py-3 text-center">
                            @lang('crud.common.actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patientCampaigns as $patientCampaign)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-left">
                            {{ optional($patientCampaign->patient)->name ?? '-'
                            }}
                        </td>
                        <td class="px-4 py-3 text-left">
                            {{ $patientCampaign->title ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-left">
                            {{ $patientCampaign->condition ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-left">
                            {{ $patientCampaign->subcondition ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-left">
                            {{ optional($patientCampaign->campaign)->title ??
                            '-' }}
                        </td>
                        <td class="px-4 py-3 text-left">
                            {{ $patientCampaign->content ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-center" style="width: 134px;">
                            <div
                                role="group"
                                aria-label="Row Actions"
                                class="relative inline-flex align-middle"
                            >
                                @can('update', $patientCampaign)
                                <a
                                    href="{{ route('patient-campaigns.edit', $patientCampaign) }}"
                                    class="mr-1"
                                >
                                    <button type="button" class="button">
                                        <i class="icon ion-md-create"></i>
                                    </button>
                                </a>
                                @endcan @can('view', $patientCampaign)
                                <a
                                    href="{{ route('patient-campaigns.show', $patientCampaign) }}"
                                    class="mr-1"
                                >
                                    <button type="button" class="button">
                                        <i class="icon ion-md-eye"></i>
                                    </button>
                                </a>
                                @endcan @can('delete', $patientCampaign)
                                <form
                                    action="{{ route('patient-campaigns.destroy', $patientCampaign) }}"
                                    method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                >
                                    @csrf @method('DELETE')
                                    <button type="submit" class="button">
                                        <i
                                            class="icon ion-md-trash text-red-600"
                                        ></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">@lang('crud.common.no_items_found')</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td class="pt-10" colspan="7">
                            {!! $patientCampaigns->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </x-partials.card>
</div>
@endsection
