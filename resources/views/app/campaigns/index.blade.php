@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <div class="flex justify-between">
            <x-slot name="title"> @lang('crud.campaigns.index_title')
                <div class="mt-4 mb-5">
                    <div class="flex flex-wrap">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-stretch w-full">
                                    <x-inputs.text id="indexSearch" name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}" autocomplete="off"></x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit"
                                            class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-700 active:bg-blue-700 transition duration-150 ease-in-out mt-1">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Campaign::class)
                            <a href="{{ route('campaigns.create') }}" class="button button-primary">
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>

                    </div>
                </div>
            </x-slot>
        </div>

        <div
            class="block w-full overflow-auto scrolling-touch shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.campaigns.inputs.trust_id')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.campaigns.inputs.title')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.campaigns.inputs.content')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.campaigns.inputs.condition')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.campaigns.inputs.subcondition')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            {{-- @lang('crud.common.actions') --}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($campaigns as $campaign)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ optional($campaign->getTrust($campaign->trust_id))->name ?? 'ALL' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ $campaign->title ?? '-' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ $campaign->content ?? '-' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ optional($campaign->condition)->name ?? '-' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ optional($campaign->subCondition)->name ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                @can('update', $campaign)
                                @if(Auth::user()->isTrustAdmin())
                                @if(Auth::user()->trust_id == $campaign->trust_id)
                                <a href="{{ route('campaigns.edit', $campaign) }}" class="mr-1">
                                    <button type="button" class="button">
                                        <i class="icon ion-md-create"></i>
                                    </button>
                                </a>
                                @endif
                                @else
                                <a href="{{ route('campaigns.edit', $campaign) }}" class="mr-1">
                                    <button type="button" class="button">
                                        <i class="icon ion-md-create"></i>
                                    </button>
                                </a>
                                @endif
                                @endcan @can('view', $campaign)
                                <a href="{{ route('campaigns.show', $campaign) }}" class="mr-1">
                                    <button type="button" class="button">
                                        <i class="icon ion-md-eye"></i>
                                    </button>
                                </a>
                                @endcan @can('delete', $campaign)
                                @if(Auth::user()->isTrustAdmin())
                                @if(Auth::user()->trust_id == $campaign->trust_id)
                                <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="button">
                                        <i class="icon ion-md-trash text-red-600"></i>
                                    </button>
                                </form>
                                @endif
                                @else
                                <form action="{{ route('campaigns.destroy', $campaign) }}" method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="button">
                                        <i class="icon ion-md-trash text-red-600"></i>
                                    </button>
                                </form>
                                @endif

                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr class="text-left font-medium text-gray-500">
                        <td colspan="7" class="px-3 py-6">@lang('crud.common.no_items_found')</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td class="px-3 py-6" colspan="7">
                            {!! $campaigns->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </x-partials.card>
</div>
@endsection