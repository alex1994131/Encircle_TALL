@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('roles.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.roles.show_title')
        </x-slot>

        <div class="mt-4">
            <div class="mb-4">
                <div class="flex flex-wrap">
                    <x-inputs.group class="w-full">
                        <x-inputs.text name="name" label="Name" value="{{ old('name', ($role->name)) }}" disabled>
                        </x-inputs.text>
                    </x-inputs.group>

                    <div class="px-4 my-4">
                        <h4 class="font-bold text-lg">Assign @lang('crud.permissions.name')</h4>

                        <div class="py-2">
                            @foreach ($permissions as $permission)
                            <div>
                                <x-inputs.checkbox id="permission{{ $permission->id }}" name="permissions[]"
                                    label="{{ ucfirst($permission->name) }}" value="{{ $permission->id }}"
                                    :checked="isset($role) ? $role->hasPermissionTo($permission) : false"
                                    :add-hidden-value="false" disabled></x-inputs.checkbox>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="mt-10">
            <a href="{{ route('roles.index') }}" class="button">
                <i class="mr-1 icon ion-md-return-left"></i>
                @lang('crud.common.back')
            </a>

            @can('create', App\Models\Role::class)
            <a href="{{ route('roles.create') }}" class="button">
                <i class="mr-1 icon ion-md-add"></i> @lang('crud.common.create')
            </a>
            @endcan
        </div>
    </x-partials.card>
</div>
@endsection