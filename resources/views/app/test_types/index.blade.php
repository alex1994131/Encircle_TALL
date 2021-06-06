@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <div class="flex justify-between">
            <x-slot name="title"> @lang('crud.test_types.index_title')
                <div class="mt-4 mb-5">
                    <div class="flex flex-wrap">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-stretch w-full">
                                    <x-inputs.text id="indexSearch" name="search" value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}" autocomplete="off"></x-inputs.text>

                                    <div class="ml-1">
                                        <button type="submit" class="button button-primary">
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\TestType::class)
                            <a href="{{ route('test-types.create') }}" class="button button-primary">
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </x-slot>
        </div>

        <div class="block w-full overflow-auto scrolling-touch">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.test_types.inputs.test_name')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            Trust
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.common.actions')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testTypes as $testType)
                    @php $isTrust = 0; @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ $testType->test_name ?? '-' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            @foreach($trusts as $trust)
                            @if($trust->id == $testType->trust_id)
                            {{$trust->name}}
                            @php $isTrust = 1; @endphp
                            @endif
                            @endforeach
                            @if($isTrust == 0)
                            --
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center" style="width: 134px;">
                            <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                @if(Auth::user()->isSuperAdmin() || Auth::user()->trust_id == $testType->trust_id)
                                @can('update', $testType)
                                <a href="{{ route('test-types.edit', $testType) }}" class="mr-1">
                                    <button type="button" class="button">
                                        <i class="icon ion-md-create"></i>
                                    </button>
                                </a>
                                @endcan
                                @endif
                                @can('view', $testType)
                                <a href="{{ route('test-types.show', $testType) }}" class="mr-1">
                                    <button type="button" class="button">
                                        <i class="icon ion-md-eye"></i>
                                    </button>
                                </a>
                                @endcan
                                @if(Auth::user()->isSuperAdmin() || Auth::user()->trust_id == $testType->trust_id)
                                @can('delete', $testType)
                                <form action="{{ route('test-types.destroy', $testType) }}" method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="button">
                                        <i class="icon ion-md-trash text-red-600"></i>
                                    </button>
                                </form>
                                @endcan
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">@lang('crud.common.no_items_found')</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td class="pt-10" colspan="2">
                            {!! $testTypes->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </x-partials.card>
</div>
@endsection