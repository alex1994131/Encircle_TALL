@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('libraries.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.libraries.create_title')
        </x-slot>

        <x-form method="POST" action="{{ route('libraries.store') }}" enctype="multipart/form-data" class="mt-4">
            @include('app.libraries.form-inputs')

            <div class="mt-10">
                <a href="{{ route('libraries.index') }}" class="button">
                    <i class="mr-1 icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <button type="submit" class="button button-primary float-right">
                    <i class="mr-1 icon ion-md-save"></i>
                    @lang('crud.common.create')
                </button>
            </div>
        </x-form>
    </x-partials.card>
</div>

<div class="relative mt-8">
    <div class="absolute inset-x-0 bottom-0 "></div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="relative sm:overflow-auto ">
            <div class="absolute inset-0">
                <img class="h-full w-full object-none" src="/img/phone.png" alt="">
                <div class="absolute inset-0" style="mix-blend-mode: multiply;"></div>
            </div>
            <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                <h1 class="text-center text-xl font-extrabold tracking-tight sm:text-xl lg:text-xl">
                    <span class="block text-gray-700">Gout Test Results</span>
                </h1>
                <p class="text-xs mt-6 max-w-lg mx-auto text-center text-gray-600 sm:max-w-xs px-12">
                    Hello. The result of your serum uric acid blood test taken on [date] was [results] umol/L
                    (laboratory ID number: [lab number]). This result is within the target range. If you require more
                    information, please discuss with your doctor or nurse. Your next blood test is due on [date]. Please
                    arrange to have this test as close to the above date as possible. Information on how to get a test,
                    including online booking, can be found online [click here link] or by telephoning [number]. Thank
                    you.
                </p>
                <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                    <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                        <a href="#"
                            class="flex items-center justify-center px-1 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-white bg-blue-700 bg-opacity-60 hover:bg-opacity-70 sm:px-2">
                            Find out more
                        </a>
                        <a href="#"
                            class="flex items-center justify-center px-1 py-1 border border-transparent text-xs font-medium rounded-md shadow-sm text-blue-700 bg-blue-100 hover:bg-indigo-50 sm:px-2">
                            Snooze
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>


</div>
@endsection