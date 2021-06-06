@extends('layouts.app')
@section('style')
<style>
.avatar_wrapper {
    position: relative;
}

.search_avatar_icon {
    position: absolute;
    width: 30px;
    height: 30px;
    border: 1px solid transparent;
    border-radius: 30px;
    background: #000;
    opacity: 0.8;
    top: 75%;
    left: 60%;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user_avatar {
    cursor: pointer;
    transition: 0.3s;
    margin: auto;
}

.user_avatar:hover {
    opacity: 0.5
}

.card-body {
    padding-left: 1rem;
    padding-right: 1rem;
    border-right: 1px solid lightgray;
    padding-top: 30px;
}
</style>
@endsection
@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('users.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            Edit Profile
        </x-slot>
        <x-form method="POST" action="{{ route('user.update.profile') }}" class="mt-4 mb-10">
            @include('app.users.profile-form-inputs')
            <div class="pt-5">
                <button type="submit" class="button button-primary float-right">
                    <i class="mr-1 icon ion-md-save"></i>
                    @lang('crud.common.update')
                </button>
            </div>
        </x-form>
        <hr>
        <x-form method="POST" action="{{route('user.update.profile.password')}}" class="mt-4">
            <h1 class="text-xl px-4 pb-5">Change your account password</h1>
            <div class="px-8">
                <x-inputs.group class="w-full">
                    <x-inputs.password name="prev_password" label="Current Password" maxlength="255"
                        placeholder="Current Password"></x-inputs.password>
                </x-inputs.group>
                <div class="grid grid-cols-2">
                    <x-inputs.group class="w-full">
                        <x-inputs.password name="password" label="New Password" placeholder="Password" maxlength="255">
                        </x-inputs.password>
                    </x-inputs.group>

                    <x-inputs.group class="w-full">
                        <x-inputs.password name="password_confirmation" label="New Password Confirmation"
                            maxlength="255" placeholder="Password Confirmation"></x-inputs.password>
                    </x-inputs.group>
                </div>
            </div>
            <div class="pt-5">
                <button type="submit" class="button button-primary float-right">
                    <i class="mr-1 icon ion-md-key"></i>
                    Change
                </button>
            </div>
        </x-form>
    </x-partials.card>
</div>
@endsection