@extends('layouts.app')

@section('content')



<div class="mx-auto px-4 md:px-6 mt-8">
    <x-partials.card>
        <div class="flex justify-between">
            <x-slot name="title"> @lang('crud.patients.index_title')
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
                                            class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out mt-1"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </x-slot>
        </div>

        <div class="block w-full overflow-auto scrolling-touch shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.patients.inputs.name')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.patients.inputs.dob')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.patients.inputs.nhsnum')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.patients.inputs.phone')
                        </th>
                        <th class="px-3 py-3 text-left text-sm text-gray-900">
                            @lang('crud.patients.inputs.email')
                        </th>
                          <th class="px-4 py-3 text-center">
                            {{-- @lang('crud.common.actions') --}}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr class="hover:bg-gray-50">
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-900">
                            @can('view', $patient)
                            <a
                                href="{{ route('patients.edit', $patient) }}"
                                class="mr-1 hover:underline"
                            >
                            {{ $patient->name ?? '-' }}
                            </a>
                            @else
                            {{ $patient->name ?? '-' }}
                            @endcan

                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ $patient->dob->format('d/m/Y') ?? '-' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ $patient->nhsnum ?? '-' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ $patient->phone ?? '-' }}
                        </td>
                        <td class="px-3 py-3 text-left text-sm font-medium text-gray-500">
                            {{ $patient->email ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-center" style="width: 134px;">
                            <div
                                role="group"
                                aria-label="Row Actions"
                                class="relative inline-flex align-middle"
                            >
                                @can('update', $patient)
                                <a
                                    href="{{ route('patients.edit', $patient) }}"
                                    class="mr-1"
                                >
                                    <button type="button" class="button">
                                        <i class="icon ion-md-create"></i>
                                    </button>
                                </a>
                                @endcan
                                @can('delete', $patient)
                                <form
                                    action="{{ route('patients.destroy', $patient) }}"
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
                        <td class="px-3 py-6" colspan="7">
                            {!! $patients->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </x-partials.card>
</div>



@endsection


