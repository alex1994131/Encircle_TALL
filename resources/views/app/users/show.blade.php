@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('users.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.users.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">@lang('crud.users.inputs.name')</h5>
                <span>{{ $user->name ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">@lang('crud.users.inputs.email')</h5>
                <span>{{ $user->email ?? '-' }}</span>
            </div>
            <div class="mb-4">
                <h5 class="font-medium">@lang('crud.users.inputs.trust_id')</h5>
                <span>{{ optional($user->trust)->name ?? '-' }}</span>
            </div>
        </div>

        <div class="mt-4">
            <div class="mb-4">
                <h5 class="font-medium">@lang('crud.roles.name')</h5>
                <div>
                    @forelse ($user->roles as $role)
                    <div class="inline-block p-1 text-center text-sm rounded bg-blue-400 text-white">
                        {{ $role->name }}
                    </div>
                    <br />
                    @empty - @endforelse
                </div>
            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('users.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\User::class)
            <a href="{{ route('users.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection