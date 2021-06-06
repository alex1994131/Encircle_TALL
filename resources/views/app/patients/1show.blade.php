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
            <button type="button" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
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

{{-- Key Dates 2 --}}
<div class="p-10">
<div class="flex flex-col max-w-6xl mx-auto px-6 sm:px-6 lg:px-8 bg-white border-gray-200 sm:rounded-lg shadow">

<div class="mx-auto container py-12 px-6">
    <div>
        <div class="flex items-center">
            <div data-menu class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Hide" class="hidden icon icon-tabler icon-tabler-chevron-up" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#718096" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <polyline points="6 15 12 9 18 15" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Show" class="icon icon-tabler icon-tabler-chevron-down" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#718096" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"></path>
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
            <h1 class="text-lg text-gray-900 ml-3 text-sm font-medium">Appointment 2</h1>
            <p class="pl-4">Date: 1/1/24</p>
            <p class="pl-4">Time: 1/1/24</p>
            <p class="pl-4">Order: REM00/15422</p>
            <div class="md:flex items-center md:w-1/4 w-full justify-end text-gray-700">
                <div class="mt-4 md:mt-0 flex items-center">
                   <div class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <rect x="4" y="5" width="16" height="16" rx="2" />
                            <line x1="16" y1="3" x2="16" y2="7" />
                            <line x1="8" y1="3" x2="8" y2="7" />
                            <line x1="4" y1="11" x2="20" y2="11" />
                            <rect x="8" y="15" width="2" height="2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <ul class="pt-6">
            <li class="md:flex justify-between items-center text-sm font-medium">
                <div class="flex items-center text-gray-400 w-full md:w-1/2 pl-4">
                    <p class="text-gray-600 ">Blood Test</p>
                </div>
                <div class="md:flex items-center md:w-1/2 w-full justify-end text-gray-700">
                    <p class="text-green-500 mt-4 md:mt-0 mr-10">Received 15/2/21</p>
                    <p class="text-gray-500 mt-4 md:mt-0 mr-10">Result 247</p>
                    <div class="mt-4 md:mt-0 flex items-center">
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4" />
                                <circle cx="9" cy="9" r="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr class="my-5 border-t border-gray-300" />
            </li>
            <li class="md:flex justify-between items-center text-sm font-medium">
                <div class="flex items-center text-gray-400 w-full md:w-1/2 pl-4">
                    <p class="text-gray-600 font-semibold">Blood Test</p>
                </div>
                <div class="md:flex items-center md:w-1/2 w-full justify-end text-gray-700">
                    <p class="text-green-500 mt-4 md:mt-0 mr-10">Received 15/2/21</p>
                    <p class="text-gray-500 mt-4 md:mt-0 mr-10">Result 247</p>
                    <div class="mt-4 md:mt-0 flex items-center">
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4" />
                                <circle cx="9" cy="9" r="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr class="my-5 border-t border-gray-300" />
            </li>
            <li class="md:flex justify-between items-center text-sm font-medium">
                <div class="flex items-center text-gray-400 w-full md:w-1/2 pl-4">
                    <p class="text-gray-600 font-semibold">Blood Test</p>
                </div>
                <div class="md:flex items-center md:w-1/2 w-full justify-end text-gray-700">
                    <p class="text-green-500 mt-4 md:mt-0 mr-10">Received 15/2/21</p>
                    <p class="text-gray-500 mt-4 md:mt-0 mr-10">Result 247</p>
                    <div class="mt-4 md:mt-0 flex items-center">
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4" />
                                <circle cx="9" cy="9" r="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr class="my-5 border-t border-gray-300" />
            </li>
        </ul>
    </div>
    <div>
        <div class="flex items-center mt-6">
            <div data-menu class="cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Hide" class="hidden icon icon-tabler icon-tabler-chevron-up" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#718096" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" />
                    <polyline points="6 15 12 9 18 15" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" aria-label="Show" class="icon icon-tabler icon-tabler-chevron-down" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#718096" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"></path>
                    <polyline points="6 9 12 15 18 9"></polyline>
                </svg>
            </div>
            <h1 class="text-lg text-gray-900 ml-3 text-sm font-medium">Appointment 1</h1>
            <p class="pl-4">Date: 1/1/24</p>
            <p class="pl-4">Time: 1/1/24</p>
            <p class="pl-4">Order: REM00/15422</p>
            <div class="md:flex items-center md:w-1/4 w-full justify-end text-gray-700">
                <div class="mt-4 md:mt-0 flex items-center">
                   <div class="mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <rect x="4" y="5" width="16" height="16" rx="2" />
                            <line x1="16" y1="3" x2="16" y2="7" />
                            <line x1="8" y1="3" x2="8" y2="7" />
                            <line x1="4" y1="11" x2="20" y2="11" />
                            <rect x="8" y="15" width="2" height="2" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <ul class="pt-6">
            <li class="md:flex justify-between items-center">
                <div class="flex items-center text-gray-400 w-full md:w-1/2 pl-4">
                    <p class="text-gray-600 font-small">Blood Test</p>
                </div>
                <div class="md:flex items-center md:w-1/2 w-full justify-end text-gray-700">
                    <p class="text-green-500 mt-4 md:mt-0 mr-10">Received 15/2/21</p>
                    <p class="text-gray-500 mt-4 md:mt-0 mr-10">Result 247</p>
                    <div class="mt-4 md:mt-0 flex items-center">
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4" />
                                <circle cx="9" cy="9" r="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr class="my-5 border-t border-gray-300" />
            </li>
            <li class="md:flex justify-between items-center">
                <div class="flex items-center text-gray-400 w-full md:w-1/2 pl-4">
                    <p class="text-gray-600 font-semibold">Blood Test</p>
                </div>
                <div class="md:flex items-center md:w-1/2 w-full justify-end text-gray-700">
                    <p class="text-green-500 mt-4 md:mt-0 mr-10">Received 15/2/21</p>
                    <p class="text-gray-500 mt-4 md:mt-0 mr-10">Result 247</p>
                    <div class="mt-4 md:mt-0 flex items-center">
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4" />
                                <circle cx="9" cy="9" r="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr class="my-5 border-t border-gray-300" />
            </li>
            <li class="md:flex justify-between items-center">
                <div class="flex items-center text-gray-400 w-full md:w-1/2 pl-4">
                    <p class="text-gray-600 font-semibold">Blood Test</p>
                </div>
                <div class="md:flex items-center md:w-1/2 w-full justify-end text-gray-700">
                    <p class="text-green-500 mt-4 md:mt-0 mr-10">Received 15/2/21</p>
                    <p class="text-gray-500 mt-4 md:mt-0 mr-10">Result 247</p>
                    <div class="mt-4 md:mt-0 flex items-center">
                        <div class="mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4" />
                                <circle cx="9" cy="9" r="2" />
                            </svg>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <hr class="my-5 border-t border-gray-300" />
            </li>
        </ul>
    </div>
</div>
</div>
</div>


{{-- Key Dates 2 --}}
{{-- KEY DATES --}}

<div class="flex flex-col max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Apt No.
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Test Order No
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Date/Time
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Result
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Lab Ref
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Date
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Next Test Order
                    </th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 tracking-wider">
                    Next Appointment
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Odd row -->
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        3
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            RJE00/33992518
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        01/09/2021
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                        </td>
                    </tr>
                    <!-- Even row -->
                <tr class="bg-white">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    2
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        RJE00/33991487
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        01/08/2021
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
64
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    12346
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        08/08/2021
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        RJE00/33992518
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    1 month
                    </td>
                </tr>
                    <!-- Odd row -->
                <tr class="bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                    1
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">

                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    01/07/2021
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    85
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    12345
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        08/07/2021
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    RJE00/33991487
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    1 month
                    </td>
                </tr>



                <!-- More rows... -->
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>

    <div class="flex items-center mt-4">
        <span class="shadow-sm rounded-md">
        <button type="button" class="px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out">
            New Appointment
        </button>
        </span>
    </div>
</div>
{{-- END KEY DATES --}}



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


<script>
// Inbox script starts
let elements = document.querySelectorAll("[data-menu]");
for (let i = 0; i < elements.length; i++) {
    let main = elements[i];
    main.addEventListener("click", function () {
        let element = main.parentElement.parentElement;
        let andicators = main.querySelectorAll("svg");
        let child = element.querySelector("ul");
        child.classList.toggle("hidden");
        if (child.classList[1] !== "hidden") {
            andicators[1].style.display = "block";
            andicators[0].style.display = "none";
        } else {
            andicators[1].style.display = "none";
            andicators[0].style.display = "block";
        }
    });
}
//Inbox script ends
// Notebook script starts
function dropdownFunction(element) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
    for (i = 0; i < dropdowns.length; i++) {
        dropdowns[i].classList.add("hidden");
    }
    list.classList.toggle("hidden");
}
window.onclick = function (event) {
    if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            openDropdown.classList.add("hidden");
        }
    }
};

</script>

@endsection
