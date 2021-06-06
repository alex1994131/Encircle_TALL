@extends('layouts.app')

@section('content')


<div class="mx-auto px-4 md:p-10 md:pt-5">
    <x-partials.card>
        <x-slot name="title">
        <a href="{{ route('patients.index') }}" class="mr-4"
        ><i class="mr-1 icon ion-md-arrow-back"></i
        ></a>

            @lang('crud.patients.show_title')
        </x-slot>

<div class="overflow-hidden">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        {{ $patient->name ?? '-' }}
      </h3>
      <p class="mt-3 max-w-2xl text-sm text-gray-500">
        <span class="text-gray-900">NHS No:</span> {{ $patient->nhsnum ?? '-' }}
        <span class="text-gray-900">DOB:</span> {{ $patient->dob->format('j F, Y') ?? '-' }}
      </p>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
      <dl class="sm:divide-y sm:divide-gray-200">

        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
          <dt class="text-sm font-medium text-gray-500">
            @lang('crud.patients.inputs.name')
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $patient->name ?? '-' }}
          </dd>
        </div>

        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            @lang('crud.patients.inputs.dob')
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $patient->dob->format('j F, Y') ?? '-' }}
          </dd>
        </div>

        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
          <dt class="text-sm font-medium text-gray-500">
            @lang('crud.patients.inputs.email')
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $patient->email ?? '-' }}
          </dd>
        </div>

        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm font-medium text-gray-500">
            @lang('crud.patients.inputs.nhsnum')
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $patient->nhsnum ?? '-' }}
          </dd>
        </div>
        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
          <dt class="text-sm font-medium text-gray-500">
            @lang('crud.patients.inputs.phone')
          </dt>
          <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $patient->phone ?? '-' }}
          </dd>
        </div>

        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm font-medium text-gray-500">
              @lang('crud.patients.inputs.email')
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $patient->email ?? '-' }}
            </dd>
          </div>

          <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50">
            <dt class="text-sm font-medium text-gray-500">
              @lang('crud.patients.inputs.notes')
            </dt>
            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $patient->notes ?? '-' }}
            </dd>
          </div>

        </dl>
    </div>
  </div>


</div>







        {{-- <div class="mt-10">
            <a href="{{ route('patients.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\Patient::class)
            <a href="{{ route('patients.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div> --}}

    </div>

        <div class="flex items-center mt-4">

            <span class="shadow-sm rounded-md  mr-4">
            <button type="button" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
                New Message
            </button>
            </span>

            <span class="shadow-sm rounded-md mr-4">
            <button type="" onclick="modalCampHandler(true)" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
                New Campaign
            </button>
            </span>

            @can('update', $patient)
                <a
                    href="{{ route('patients.edit', $patient) }}"
                    class="mr-1"
                >
                <span class="shadow-sm rounded-md mr-4">
                    <button type="button" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
                        Edit Patient
                    </button>
                    </span>
                </a>
            @endcan
            @can('delete', $patient)
            <form
                action="{{ route('patients.destroy', $patient) }}"
                method="POST"
                onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
            >
                @csrf @method('DELETE')
                <span class="shadow-sm rounded-md">
                  <button type="submit" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
                      Delete Patient
                  </button>
                  </span>
            </form>
            @endcan

    </x-partials.card>
</div>

{{-- KEY DATES v4 --}}


<div class="m-10">
    <div class="mx-auto container bg-white shadow rounded">
        <div class="flex w-full pl-3 sm:pl-6 pr-3 py-5 items-center justify-between bg-white rounded-t">
            <h3 class="text-gray-800 font-medium text-base sm:text-xl">Campaign #20479 - Cholesterol - High Cholesterol</h3>
        </div>
        <div class="w-full overflow-x-scroll xl:overflow-x-hidden">
            <table class="min-w-full bg-white rounded border border-gray-300" id="main-table">
                <thead>
                    <tr class="w-full bg-gray-100 ">
                        <th class="border-b border-gray-300 pl-3 w-24 py-3">
                            <div class="flex items-center">
                                <div class="opacity-0 cursor-defaut ml-4 text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="6 15 12 9 18 15" />
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative chuss-div">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Appointment No.</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Test Order No.</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Date</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Time</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Test</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Result</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Lab Ref</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Date</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-1">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Next Appointment Due</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 pr-12 whitespace-no-wrap w-32">
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Actions</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-t border-gray-300">
                        <td class="pl-3 w-24 py-3 h-10">
                            <div class="flex items-center">
                            </div>
                        </td>
                        <td class="whitespace-no-wrap w-32">

                               <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">3</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">RJE00/33991533</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <span class="text-xs text-blue-500 font-normal">20 Feb 21</span>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2:30pm</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Blood Sugar</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-1">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 pr-4 whitespace-no-wrap w-32 text-gray-500">
                            <div class="flex items-center">
                                <div class="mr-3" onclick="modalResultHandler(true)">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4"></path>
                                            <circle cx="9" cy="9" r="2"></circle>
                                        </svg>
                                </div>
                                <div class="mr-3" onclick="modalAptHandler(true)">
                                    <button class="focus:outline-none mx-auto transition duration-150 ease-in-out rounded " >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                            <line x1="16" y1="3" x2="16" y2="7"></line>
                                            <line x1="8" y1="3" x2="8" y2="7"></line>
                                            <line x1="4" y1="11" x2="20" y2="11"></line>
                                            <rect x="8" y="15" width="2" height="2"></rect>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="border-t border-gray-300">
                        <td class="pl-3 w-24 py-3">
                            <div class="flex items-center">
                                <a onclick="accordionHandler(this)" class="focus:outline-none cursor-pointer text-gray-800 ml-2 lg:ml-4 mr-2 sm:mr-0 border border-transparent rounded focus:outline-none" href="javascript: void(0)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </td>
                        <td class="whitespace-no-wrap w-32">

                               <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">RJE00/33991487</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <span class="text-xs text-blue-500 font-normal">20 Jan 21</span>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2:30pm</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Blood Sugar</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">148</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">40122</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2 Feb 21</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-1">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 pr-4 whitespace-no-wrap w-32 text-gray-500">
                            <div class="flex items-center">
                                <div class="mr-3" onclick="modalResultHandler(true)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4"></path>
                                        <circle cx="9" cy="9" r="2"></circle>
                                    </svg>
                                </div>
                                <div class="mr-3" onclick="modalAptHandler(true)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <rect x="8" y="15" width="2" height="2"></rect>
                                    </svg>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="detail-row">
                        <td class="pl-3 w-24 h-10 py-3">
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Cholesterol</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">43</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">40189</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2 Feb 21</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                    </tr>
                    <tr class="detail-row">
                        <td class="pl-3 w-24 h-10 py-3">
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Blood Oxygen</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                    </tr>

                    <tr class="border-t border-gray-300">
                        <td class="pl-3 w-24 py-3">
                            <div class="flex items-center">
                                <a onclick="accordionHandler(this)" class="focus:outline-none cursor-pointer text-gray-800 ml-2 lg:ml-4 mr-2 sm:mr-0 border border-transparent rounded focus:outline-none" href="javascript: void(0)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </td>
                        <td class="whitespace-no-wrap w-32">

                               <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">1</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">RJE00/33991401</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <span class="text-xs text-blue-500 font-normal">20 Jan 21</span>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2:30pm</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Blood Sugar</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">148</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">40122</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2 Feb 21</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-1">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 pr-4 whitespace-no-wrap w-32 text-gray-200">
                            <div class="flex items-center">
                                <div class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4"></path>
                                        <circle cx="9" cy="9" r="2"></circle>
                                    </svg>
                                </div>
                                <div class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <rect x="8" y="15" width="2" height="2"></rect>
                                    </svg>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="detail-row">
                        <td class="pl-3 w-24 h-10 py-3">
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Cholesterol</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                    </tr>
                    <tr class="detail-row">
                        <td class="pl-3 w-24 h-10 py-3">
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Blood Oxygen</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<span class="shadow-sm rounded-md  ml-10 mt-0">
    <button type="button" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out"  onclick="newaptModalHandler(true)">
        New Appointment
    </button>
</span>

{{-- END KEY DATES v4 --}}

{{-- KEY DATES v4 Pt 2 --}}


<div class="m-10">
    <div class="mx-auto container bg-white shadow rounded">
        <div class="flex w-full pl-3 sm:pl-6 pr-3 py-5 items-center justify-between bg-white rounded-t">
            <h3 class="text-gray-800 font-medium text-base sm:text-xl">Campaign #19087 - Gout - Severe</h3>
        </div>
        <div class="w-full overflow-x-scroll xl:overflow-x-hidden">
            <table class="min-w-full bg-white rounded border border-gray-300" id="main-table">
                <thead>
                    <tr class="w-full bg-gray-100 ">
                        <th class="border-b border-gray-300 pl-3 w-24 py-3">
                            <div class="flex items-center">
                                <div class="opacity-0 cursor-defaut ml-4 text-gray-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <polyline points="6 15 12 9 18 15" />
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative chuss-div">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Appointment No.</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Test Order No.</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Date</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Time</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Test</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Result</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Lab Ref</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Date</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-1">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                            <div class="flex items-center justify-between relative">
                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Next Appointment Due</p>
                            </div>
                        </th>
                        <th class="border-b border-gray-300 pl-4 pr-12 whitespace-no-wrap w-32">
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Actions</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-t border-gray-300">
                        <td class="pl-3 w-24 py-3">
                            <div class="flex items-center">
                                <a onclick="accordionHandler(this)" class="focus:outline-none cursor-pointer text-gray-800 ml-2 lg:ml-4 mr-2 sm:mr-0 border border-transparent rounded focus:outline-none" href="javascript: void(0)">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </a>
                            </div>
                        </td>
                        <td class="whitespace-no-wrap w-32">

                               <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">1</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">RJE00/22991411</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <span class="text-xs text-blue-500 font-normal">20 Dec 20</span>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2:30pm</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Blood Sugar</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">202</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">40122</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">2 Jan 21</p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-1">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 whitespace-no-wrap w-32">

                                <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                        </td>
                        <td class="pl-4 pr-4 whitespace-no-wrap w-32 text-gray-200">
                            <div class="flex items-center">
                                <div class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4"></path>
                                        <circle cx="9" cy="9" r="2"></circle>
                                    </svg>
                                </div>
                                <div class="mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z"></path>
                                        <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                        <line x1="16" y1="3" x2="16" y2="7"></line>
                                        <line x1="8" y1="3" x2="8" y2="7"></line>
                                        <line x1="4" y1="11" x2="20" y2="11"></line>
                                        <rect x="8" y="15" width="2" height="2"></rect>
                                    </svg>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr class="detail-row">
                        <td class="pl-3 w-24 h-10 py-3">
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Cholesterol</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                    </tr>
                    <tr class="detail-row">
                        <td class="pl-3 w-24 h-10 py-3">
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Blood Oxygen</p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                        <td>
                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<span class="shadow-sm rounded-md  ml-10 mt-0">
    <button type="button" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out"  onclick="newaptModalHandler(true)">
        New Appointment
    </button>
</span>

{{-- END KEY DATES v4 --}}

<div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden" id="modal-apt-new">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-start text-gray-600 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                        <rect x="8" y="15" width="2" height="2" />
                    </svg>
            </div>
            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">New Appointment</h1>
            <label for="next_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Date</label>
            <div class="relative mb-5 mt-2">
                <div class="absolute right-0 text-gray-600 flex items-center pr-3 h-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                        <rect x="8" y="15" width="2" height="2" />
                    </svg>
                </div>
                <input id="next_date" class="text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="MM/YY" />
            </div>
            <label for="next_order" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Next Order</label>
            <input id="next_order" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Test order number" />


            <div class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out" onclick="modalHandler()">
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden" id="modal-apt-1">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-start text-gray-600 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                        <rect x="8" y="15" width="2" height="2" />
                    </svg>
            </div>
            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Next Appointment</h1>
            <label for="next_date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Date</label>
            <div class="relative mb-5 mt-2">
                <div class="absolute right-0 text-gray-600 flex items-center pr-3 h-full cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                        <rect x="8" y="15" width="2" height="2" />
                    </svg>
                </div>
                <input id="next_date" class="text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="MM/YY" />
            </div>
            <label for="next_order" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Next Order</label>
            <input id="next_order" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="James" />


            <div class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out" onclick="modalHandler()">
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </div>
        </div>
    </div>
</div>



<script>
let elements = document.querySelectorAll("[data-menu]");
for (let i = 0; i < elements.length; i++) {
    let main = elements[i];
    main.addEventListener("click", function () {
        let element = main.parentElement.parentElement;
        let andicators = main.querySelectorAll("svg");
        let child = element.querySelector("ul");
        if (child.classList.contains("opacity-0")) {
            child.classList.remove("invisible");
            child.classList.add("visible");
            child.classList.add("opacity-100");
            child.classList.remove("opacity-0");
            andicators[0].style.display = "block";
            andicators[1].style.display = "none";
        } else {
            child.classList.add("invisible");
            child.classList.remove("visible");
            child.classList.remove("opacity-100");
            child.classList.add("opacity-0");
            andicators[0].style.display = "none";
            andicators[1].style.display = "block";
        }
    });
}
var tableDetails = document.getElementsByClassName("detail-row");
for (var i = 0; i < tableDetails.length; i++) {
    tableDetails[i].getElementsByTagName("td")[0].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[1].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[2].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[3].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[4].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[5].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[6].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[7].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[8].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[9].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[10].classList.add("hidden");
    tableDetails[i].getElementsByTagName("td")[11].classList.add("hidden");
}

function dropdownFunction(element) {
    var single = element.getElementsByClassName("dropdown-content")[0];
    single.classList.toggle("hidden");
}

function accordionHandler(element) {
    var single = element.parentElement.parentElement.parentElement.nextElementSibling.children[0];
    var single1 = element.parentElement.parentElement.parentElement.nextElementSibling.children[1];
    var single2 = element.parentElement.parentElement.parentElement.nextElementSibling.children[2];
    var single3 = element.parentElement.parentElement.parentElement.nextElementSibling.children[3];
    var single4 = element.parentElement.parentElement.parentElement.nextElementSibling.children[4];
    var single5 = element.parentElement.parentElement.parentElement.nextElementSibling.children[5];
    var single6 = element.parentElement.parentElement.parentElement.nextElementSibling.children[6];
    var single7 = element.parentElement.parentElement.parentElement.nextElementSibling.children[7];
    var single8 = element.parentElement.parentElement.parentElement.nextElementSibling.children[8];
    var single9 = element.parentElement.parentElement.parentElement.nextElementSibling.children[9];
    var single10 = element.parentElement.parentElement.parentElement.nextElementSibling.children[10];
    var single11 = element.parentElement.parentElement.parentElement.nextElementSibling.children[11];
    var single12 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[0];
    var single13 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[1];
    var single14 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[2];
    var single15 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[3];
    var single16 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[4];
    var single17 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[5];
    var single18 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[6];
    var single19 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[7];
    var single20 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[8];
    var single21 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[9];
    var single22 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[10];
    var single23 = element.parentElement.parentElement.parentElement.nextElementSibling.nextElementSibling.children[11];
    single.classList.toggle("hidden");
    single1.classList.toggle("hidden");
    single2.classList.toggle("hidden");
    single3.classList.toggle("hidden");
    single4.classList.toggle("hidden");
    single5.classList.toggle("hidden");
    single6.classList.toggle("hidden");
    single7.classList.toggle("hidden");
    single8.classList.toggle("hidden");
    single9.classList.toggle("hidden");
    single10.classList.toggle("hidden");
    single11.classList.toggle("hidden");
    single12.classList.toggle("hidden");
    single13.classList.toggle("hidden");
    single14.classList.toggle("hidden");
    single15.classList.toggle("hidden");
    single16.classList.toggle("hidden");
    single17.classList.toggle("hidden");
    single18.classList.toggle("hidden");
    single19.classList.toggle("hidden");
    single20.classList.toggle("hidden");
    single21.classList.toggle("hidden");
    single22.classList.toggle("hidden");
    single23.classList.toggle("hidden");

    }
function tableInteract(element) {
    var single = element.parentElement.parentElement.parentElement;
    single.classList.toggle("bg-gray-100");
}
function checkAll(element) {
    let rows = element.parentElement.parentElement.parentElement.parentElement.nextElementSibling.children;
    for (var i = 0; i < rows.length; i++) {
        if (element.checked) {
            rows[i].classList.add("bg-gray-100");
            let checkbox = rows[i].getElementsByTagName("input")[0];
            if (checkbox) {
                checkbox.checked = true;
            }
        } else {
            rows[i].classList.remove("bg-gray-100");
            let checkbox = rows[i].getElementsByTagName("input")[0];
            if (checkbox) {
                checkbox.checked = false;
            }
        }
    }
}

</script>

{{-- MODAL SCRIPT --}}
<script>
let modal = document.getElementById("modal-apt-1");
function modalHandler(val) {
    if (val) {
        fadeIn(modal);
    } else {
        fadeOut(modal);
    }
}

let modal2 = document.getElementById("modal-apt-new");
function newaptModalHandler(val) {
    if (val) {
        fadeIn(modal2);
    } else {
        fadeOut(modal2);
    }
}

function fadeOut(el) {
    el.style.opacity = 1;
    (function fade() {
        if ((el.style.opacity -= 0.1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
}
function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "flex";
    (function fade() {
        let val = parseFloat(el.style.opacity);
        if (!((val += 0.2) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
}



</script>













    {{-- Experimental Patient campaigns --}}

    <div class="mx-auto px-4 md:p-10  md:pt-5">
        <x-partials.card>
            <div class="flex justify-between">
                <x-slot name="title"> Active Campaigns
                    <div class="mt-4 mb-5">

                    </div>
                </x-slot>
            </div>


            <div class="px-4 py-3 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                  Suspected High Cholesterol
                </h3>
                <p class="mt-3 max-w-2xl text-sm text-gray-500">
                  <span class="text-gray-900">Condition:</span> Cholesterol
                  <span class="text-gray-900">Subcondition:</span> High Cholesterol
                </p>
              </div>
        <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4  px-4 md:px-6 mt-4">

        <li class="col-span-1 flex flex-col text-center bg-green-50 rounded-lg shadow divide-y divide-gray-200">
          <div class="flex-1 flex flex-col p-8">
            <h3 class="mt-6 text-gray-900 text-sm font-medium">Your cholesterol test.</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dt class="sr-only">Condition</dt>
              <dd class="text-gray-500 text-sm">Cholesterol</dd>
              <dt class="sr-only">Subcondition</dt>
              <dd class="text-gray-500 text-sm">High Cholesterol</dd>
              {{-- <dt class="sr-only">Find Out More</dt>
              <dd class="text-gray-900 text-sm">More Info:</dd><dd class="text-gray-500 text-sm">https://encircle.app/more-info/cholesterol</dd>
              <dt class="sr-only">Results</dt>
              <dd class="text-gray-900 text-sm">Results:</dd><dd class="text-gray-500 text-sm">https://encircle.app/results/es669184kw05bd530188ff</dd>
              <dt class="sr-only">Phone</dt>
              <dd class="text-gray-900 text-sm">Phone:</dd><dd class="text-gray-500 text-sm">0201 123 4567</dd> --}}
              <dt class="sr-only">Status</dt>
              <dd class="mt-3">
                <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">
                    Sent
                </span>
              </dd>
              <dt class="sr-only">Message</dt>
              <dd class="mt-3">
                You have a cholesterol test on [APPOINTMENT-DATE]
              </dd>
            </dl>
          </div>
        </li>

        <li class="col-span-1 flex flex-col text-center bg-red-50 rounded-lg shadow divide-y divide-gray-200">
          <div class="flex-1 flex flex-col p-8">
            <h3 class="mt-6 text-gray-900 text-sm font-medium">Your cholesterol test results.</h3>
            <dl class="mt-1 flex-grow flex flex-col justify-between">
              <dt class="sr-only">Condition</dt>
              <dd class="text-gray-500 text-sm">Cholesterol</dd>
              <dt class="sr-only">Subcondition</dt>
              <dd class="text-gray-500 text-sm">High Cholesterol</dd>
              <dt class="sr-only">Status</dt>
              <dd class="mt-3">
                <span class="px-2 py-1 text-red-800 text-xs font-medium bg-red-100 rounded-full">
                    Overdue
                </span>
              </dd>
              <dt class="sr-only">Message</dt>
              <dd class="mt-3">
                The results of your cholesterol test are [RESULT1]
              </dd>
            </dl>
          </div>
        </li>

        <li class="col-span-1 flex flex-col text-center bg-yellow-50 rounded-lg shadow divide-y divide-gray-200">
            <div class="flex-1 flex flex-col p-8">
              <h3 class="mt-6 text-gray-900 text-sm font-medium">Your follow-up cholesterol test.</h3>
              <dl class="mt-1 flex-grow flex flex-col justify-between">
                <dt class="sr-only">Condition</dt>
                <dd class="text-gray-500 text-sm">Cholesterol</dd>
                <dt class="sr-only">Subcondition</dt>
                <dd class="text-gray-500 text-sm">High Cholesterol</dd>
                <dt class="sr-only">Status</dt>
                <dd class="mt-3">
                  <span class="px-2 py-1 text-yellow-800 text-xs font-medium bg-yellow-100 rounded-full">
                      Pending
                  </span>
                </dd>
                <dt class="sr-only">Message</dt>
                <dd class="mt-3">
                  You have a follow-up cholesterol test on [APPOINTMENT-DATE]
                </dd>
              </dl>
            </div>
          </li>

          <li class="col-span-1 flex flex-col text-center bg-yellow-50 rounded-lg shadow divide-y divide-gray-200">
            <div class="flex-1 flex flex-col p-8">
              <h3 class="mt-6 text-gray-900 text-sm font-medium">Your cholesterol test results.</h3>
              <dl class="mt-1 flex-grow flex flex-col justify-between">
                <dt class="sr-only">Condition</dt>
                <dd class="text-gray-500 text-sm">Cholesterol</dd>
                <dt class="sr-only">Subcondition</dt>
                <dd class="text-gray-500 text-sm">High Cholesterol</dd>
                <dt class="sr-only">Status</dt>
                <dd class="mt-3">
                  <span class="px-2 py-1 text-yellow-800 text-xs font-medium bg-yellow-100 rounded-full">
                      Pending
                  </span>
                </dd>
                <dt class="sr-only">Message</dt>
                <dd class="mt-3">
                  The results of your cholesterol test are [RESULT1]
                </dd>
              </dl>
            </div>
          </li>

        </ul>
      <br />
    </x-partials.card>

<!-- START NEW CAMPAIGN MODAL -->
<div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden" id="campmodal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-start text-gray-600 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" width="52" height="52" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">New Campaign</h1>
            <label for="city" class="pb-2 text-sm font-bold text-gray-800">Condition</label>
            <div class="border border-gray-300 shadow-sm rounded flex relative">
                <select type="text" name="city" required id="next" class="bg-transparent appearance-none z-10 pl-3 py-3 w-full text-sm border border-transparent focus:outline-none focus:border-indigo-700 text-gray-800 rounded">
                    <option value="Switzerland">Select</option>
                    <option value="America">Gout</option>
                    <option value="Australia">Diabetes</option>
                </select>
                <div class="px-4 flex items-center border-l border-gray-300 flex-col justify-center text-gray-500 absolute right-0 bottom-0 top-0 mx-auto z-0">
                    <svg tabindex="0" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="6 15 12 9 18 15" />
                    </svg>
                    <svg tabindex="0" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </div>
            </div>
            <label for="city" class="pb-2 text-sm font-bold text-gray-800">Sub Condition</label>
            <div class="border border-gray-300 shadow-sm rounded flex relative">
                <select type="text" name="city" required id="next" class="bg-transparent appearance-none z-10 pl-3 py-3 w-full text-sm border border-transparent focus:outline-none focus:border-indigo-700 text-gray-800 rounded">
                    <option value="Switzerland">Select</option>
                    <option value="Switzerland">Type 1</option>
                    <option value="America">Type 2</option>
                    <option value="Australia">Suspected</option>
                </select>
                <div class="px-4 flex items-center border-l border-gray-300 flex-col justify-center text-gray-500 absolute right-0 bottom-0 top-0 mx-auto z-0">
                    <svg tabindex="0" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="6 15 12 9 18 15" />
                    </svg>
                    <svg tabindex="0" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </div>
            </div>
            <label for="date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Campaign</label>
            <input id="date" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />


{{-- date --}}
<div x-data="app()" x-init="[initDate(), getNoOfDays()]" x-cloak>

    <div class="">
        <label for="datepicker" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">First Appointment</label>

            <div class="relative">
                <input type="hidden" name="date" x-ref="date">
                <input
                    type="text"
                    readonly
                    x-model="datepickerValue"
                    @click="showDatepicker = !showDatepicker"
                    @keydown.escape="showDatepicker = false"
                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                    placeholder="Select date">

                    <div class="absolute top-0 right-0 px-3 py-2">
                        <svg class="h-6 w-6 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>


                    <!-- <div x-text="no_of_days.length"></div>
                    <div x-text="32 - new Date(year, month, 32).getDate()"></div>
                    <div x-text="new Date(year, month).getDay()"></div> -->

                    <div
                        class="bg-white mt-12 rounded-lg shadow p-4 absolute top-0 left-0"
                        style="width: 17rem"
                        x-show.transition="showDatepicker"
                        @click.away="showDatepicker = false">

                        <div class="flex justify-between items-center mb-2">
                            <div>
                                <span x-text="MONTH_NAMES[month]" class="text-lg font-bold text-gray-800"></span>
                                <span x-text="year" class="ml-1 text-lg text-gray-600 font-normal"></span>
                            </div>
                            <div>
                                <button
                                    type="button"
                                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                    :class="{'cursor-not-allowed opacity-25': month == 0 }"
                                    :disabled="month == 0 ? true : false"
                                    @click="month--; getNoOfDays()">
                                    <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <button
                                    type="button"
                                    class="transition ease-in-out duration-100 inline-flex cursor-pointer hover:bg-gray-200 p-1 rounded-full"
                                    :class="{'cursor-not-allowed opacity-25': month == 11 }"
                                    :disabled="month == 11 ? true : false"
                                    @click="month++; getNoOfDays()">
                                    <svg class="h-6 w-6 text-gray-500 inline-flex"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-wrap mb-3 -mx-1">
                            <template x-for="(day, index) in DAYS" :key="index">
                                <div style="width: 14.26%" class="px-1">
                                    <div
                                        x-text="day"
                                        class="text-gray-800 font-medium text-center text-xs"></div>
                                </div>
                            </template>
                        </div>

                        <div class="flex flex-wrap -mx-1">
                            <template x-for="blankday in blankdays">
                                <div
                                    style="width: 14.28%"
                                    class="text-center border p-1 border-transparent text-sm"
                                ></div>
                            </template>
                            <template x-for="(date, dateIndex) in no_of_days" :key="dateIndex">
                                <div style="width: 14.28%" class="px-1 mb-1">
                                    <div
                                        @click="getDateValue(date)"
                                        x-text="date"
                                        class="cursor-pointer text-center text-sm leading-none rounded-full leading-loose transition ease-in-out duration-100"
                                        :class="{'bg-blue-500 text-white': isToday(date) == true, 'text-gray-700 hover:bg-blue-200': isToday(date) == false }"
                                    ></div>
                                </div>
                            </template>
                        </div>
                    </div>

            </div>
        </div>
</div>
<script>
    const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

    function app() {
        return {
            showDatepicker: false,
            datepickerValue: '',

            month: '',
            year: '',
            no_of_days: [],
            blankdays: [],
            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

            initDate() {
                let today = new Date();
                this.month = today.getMonth();
                this.year = today.getFullYear();
                this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
            },

            isToday(date) {
                const today = new Date();
                const d = new Date(this.year, this.month, date);

                return today.toDateString() === d.toDateString() ? true : false;
            },

            getDateValue(date) {
                let selectedDate = new Date(this.year, this.month, date);
                this.datepickerValue = selectedDate.toDateString();

                this.$refs.date.value = selectedDate.getFullYear() +"-"+ ('0'+ selectedDate.getMonth()).slice(-2) +"-"+ ('0' + selectedDate.getDate()).slice(-2);

                console.log(this.$refs.date.value);

                this.showDatepicker = false;
            },

            getNoOfDays() {
                let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                // find where to start calendar day of week
                let dayOfWeek = new Date(this.year, this.month).getDay();
                let blankdaysArray = [];
                for ( var i=1; i <= dayOfWeek; i++) {
                    blankdaysArray.push(i);
                }

                let daysArray = [];
                for ( var i=1; i <= daysInMonth; i++) {
                    daysArray.push(i);
                }

                this.blankdays = blankdaysArray;
                this.no_of_days = daysArray;
            }
        }
    }
</script>
{{-- end date --}}

            <label for="date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal mt-6">Test Order Number</label>
            <input id="date" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />
            <div class="flex items-center justify-start w-full">
                <button class="focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                <button class="focus:outline-none ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalCampHandler()">Cancel</button>
            </div>
            <div class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out" onclick="modalCampHandler()">
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </div>
        </div>
    </div>
</div>
<!-- END NEW CAMPAIGN MODAL -->
<!-- START Next Appointment MODAL -->
<div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden" id="aptmodal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-start text-gray-600 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" width="52" height="52" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Next Appointment</h1>
            <label for="labref" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Test Order Number</label>
            <input id="labref" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />
            <label for="city" class="pb-2 text-sm font-bold text-gray-800">Next Appointment</label>
            <div class="border border-gray-300 shadow-sm rounded flex relative">
                <select type="text" name="city" required id="next" class="bg-transparent appearance-none z-10 pl-3 py-3 w-full text-sm border border-transparent focus:outline-none focus:border-indigo-700 text-gray-800 rounded">
                    <option value="Switzerland">1 Week</option>
                    <option value="America">2 Weeks</option>
                    <option value="Australia">4 Weeks</option>
                </select>
                <div class="px-4 flex items-center border-l border-gray-300 flex-col justify-center text-gray-500 absolute right-0 bottom-0 top-0 mx-auto z-0">
                    <svg tabindex="0" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="6 15 12 9 18 15" />
                    </svg>
                    <svg tabindex="0" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </div>
            </div>
            <label for="date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Date</label>
            <input id="date" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />

            <div class="flex items-center justify-start w-full">
                <button class="focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                <button class="focus:outline-none ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalAptHandler()">Cancel</button>
            </div>
            <div class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out" onclick="modalAptHandler()">
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </div>
        </div>
    </div>
</div>
<!-- End NEXT APPOINTMENT MODAL -->
<!-- START RESULTS MODAL -->

<div class="py-12 bg-gray-700 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden" id="resultmodal">
    <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
        <div class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            <div class="w-full flex justify-start text-gray-600 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" width="52" height="52" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                  </svg>
            </div>
            <h1 class="text-gray-800 font-lg font-bold tracking-normal leading-tight mb-4">Enter Test Results</h1>
            <label for="labref" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Lab Ref</label>
            <input id="labref" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />
            <label for="result" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Result</label>
            <input id="result" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />
            <label for="date" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Date</label>
            <input id="date" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-indigo-700 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" />

            <div class="flex items-center justify-start w-full">
                <button class="focus:outline-none transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-8 py-2 text-sm">Submit</button>
                <button class="focus:outline-none ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" onclick="modalResultHandler()">Cancel</button>
            </div>
            <div class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out" onclick="modalResultHandler()">
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Close" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </div>
        </div>
    </div>
</div>
<script>
let campmodal = document.getElementById("campmodal");
function modalCampHandler(val) {
if (val) {
fadeIn(campmodal);
} else {
fadeOut(campmodal);
}
}


let aptmodal = document.getElementById("aptmodal");
function modalAptHandler(val) {
if (val) {
fadeIn(aptmodal);
} else {
fadeOut(aptmodal);
}
}

let resultmodal = document.getElementById("resultmodal");
function modalResultHandler(val) {
if (val) {
fadeIn(resultmodal);
} else {
fadeOut(resultmodal);
}
}

function fadeOut(el) {
el.style.opacity = 1;
(function fade() {
if ((el.style.opacity -= 0.1) < 0) {
el.style.display = "none";
} else {
requestAnimationFrame(fade);
}
})();
}

function fadeIn(el, display) {
el.style.opacity = 0;
el.style.display = display || "flex";
(function fade() {
let val = parseFloat(el.style.opacity);
if (!((val += 0.2) > 1)) {
el.style.opacity = val;
requestAnimationFrame(fade);
}
})();
}

</script>

<div class="w-full flex justify-center py-12" id="button">
    <button class="focus:outline-none mx-auto transition duration-150 ease-in-out hover:bg-indigo-600 bg-indigo-700 rounded text-white px-4 sm:px-8 py-2 text-xs sm:text-sm" onclick="modalResultHandler(true)">Open Modal</button>
</div>
<!-- END RESULTS MODAL -->


@endsection
