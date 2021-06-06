@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-6">
    <x-partials.card>
        <x-slot name="title">
            <a href="{{ route('campaigns.index') }}" class="mr-4"><i class="mr-1 icon ion-md-arrow-back"></i></a>
            @lang('crud.campaigns.show_title')
        </x-slot>

        <form method="POST" action="{{ route('campaigns.update', $campaign) }}" enctype="multipart/form-data"
            id="campaignForm" class="mt-4">
            @csrf


            <div class="flex flex-wrap">
                <x-inputs.group class="w-full">
                    <x-inputs.select name="trust_id" label="Trusts" disabled>
                        @php $selected = old('trust_id', ($campaign->trust_id)) @endphp
                        <option {{$campaign->trust_id ? '' : 'selected'}}>For All Trusts</option>
                        @foreach($trusts as $value => $label)
                        <option value="{{$value}}" {{ $selected == $value ? 'selected' : ''}}> {{$label}} </option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>

                <x-inputs.group class="w-full">
                    <x-inputs.select name="category" label="Categories" disabled>
                        @if($campaign->category == 'advice')
                        <option value="advice" selected>Advice</option>
                        <option value="appointment">Appointment</option>
                        <option value="result">Result</option>
                        @elseif($campaign->category == 'appointment')
                        <option value="advice">Advice</option>
                        <option value="appointment" selected>Appointment</option>
                        <option value="result">Result</option>
                        @else
                        <option value="advice">Advice</option>
                        <option value="appointment">Appointment</option>
                        <option value="result" selected>Result</option>
                        @endif
                    </x-inputs.select>
                </x-inputs.group>

                <x-inputs.group class="w-full">
                    <x-inputs.textarea name="content" label="Content" maxlength="512" disabled>
                        {{ old('content', ($campaign->content))}}</x-inputs.textarea>
                </x-inputs.group>

                <x-inputs.group class="w-full">
                    <x-inputs.text name="title" label="Title" value="{{ old('title', ($campaign->title)) }}"
                        maxlength="255" disabled></x-inputs.text>
                </x-inputs.group>

                <x-inputs.group class="col-span-6 sm:col-span-2">
                    <x-inputs.text list="conditions" name="condition_id" id="sel_conditions" label="Condition"
                        value="{{ old('condition_id', ($campaign->condition->name)) }}" placeholder="Select a Condition"
                        disabled>
                    </x-inputs.text>
                    <datalist id="conditions" disabled>
                        @forelse ($conditions as $condition)
                        <option value="{{ $condition->name }}"></option>
                        @empty
                        <option value="there is no data"></option>
                        @endforelse
                    </datalist>
                </x-inputs.group>

                <x-inputs.group class="col-span-6 sm:col-span-2">
                    <x-inputs.text list="subconditions" name="subCondition_id" label="Subcondition"
                        value="{{ old('subCondition_id', ($campaign->subCondition->name)) }}"
                        placeholder="Select a Sub Condition" disabled>
                    </x-inputs.text>
                    <datalist id="subconditions" disabled>
                        @forelse($subConditions as $subcondition)
                        <option value="{{ $subcondition->name }}">
                            @empty
                        <option> There is no data</option>
                        @endforelse
                    </datalist>
                </x-inputs.group>

                <x-inputs.group class="w-full">
                    <x-inputs.checkbox name="published" label="Published"
                        :checked="old('published', ($campaign->published))" disabled></x-inputs.checkbox>
                </x-inputs.group>

                <div class="w-full">
                    <div id="message_wrapper">
                        @foreach($campaign->libraries() as $library)
                        @if($library)
                        <div id="messagediv_{{$loop->index}}"
                            class="messagediv border-1 bg-gray-100 pt-4 mt-2 pb-6 flex flex-wrap">
                            <p class="m-auto text-xl message-header">Message #{{$loop->index + 1}}</p>
                            <!-- <x-inputs.group class="w-full">
                                        <input
                                        class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-2 border-gray-200 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                        style ="border-width : 1px"
                                        name="msg_title[]"
                                        id="msg_title_{{$loop->index}}"
                                        label="Message Title"
                                        value="{{$library->msg_title}}"                       
                                        maxlength="255"
                                        required
                                        ></input>
                                    </x-inputs.group> -->
                            <div class="px-4 my-2 w-full">
                                <label class="label text-sm font-medium text-gray-700" for="msg_title[]">Message
                                    Title</label>
                                <input name="msg_title[]" id="msg_title_{{$loop->index}}"
                                    value="{{$library->msg_title}}" maxlength="255" required style="border-width: 1px;"
                                    class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-2 border-gray-200 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                                    disabled />
                            </div>
                            <x-inputs.group class="w-full">
                                <x-inputs.textarea name="msg_text[]" id="msg_text_{{$loop->index}}" label="Message Text"
                                    maxlength="512" value="{{$library->msg_text}}" disabled required>
                                    {{$library->msg_text}}</x-inputs.textarea>
                            </x-inputs.group>
                            <div class="grid grid-cols-2 w-full px-2">
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Message Video
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative"
                                        style="min-height : 190px">
                                        <video
                                            class="absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-{{$library->upload_video ? 100 : 0}}"
                                            controls id="videoPeviewTag_{{$loop->index}}">
                                            <source
                                                src="{{$library->upload_video ? asset('storage/'.$library->upload_video) : ''}}"
                                                id="videoPreview_{{$loop->index}}">
                                            </source>
                                        </video>
                                    </div>
                                </div>
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">
                                        Message Image
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative"
                                        style="min-height : 190px">
                                        <div class="absolute top-0 left-0 bg-cover bg-center w-full h-full"
                                            id="imagePreview_{{$loop->index}}"
                                            style="background-image: url({{$library->upload_image ? asset('storage/'.$library->upload_image) : ''}})">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-5">
                                <div>
                                    <x-inputs.group class="col-span-6 sm:col-span-2">
                                        <x-inputs.text name="add_url[]" id="add_url_{{$loop->index}}" label="Add Url"
                                            value="{{$library->add_url}}" maxlength="255" disabled></x-inputs.text>
                                    </x-inputs.group>
                                </div>
                                <div>
                                    <x-inputs.group class="col-span-6 sm:col-span-2">
                                        <x-inputs.text name="telephone[]" id="telephone_{{$loop->index}}"
                                            label="Phone Number" value="{{$library->telephone}}" maxlength="255"
                                            disabled></x-inputs.text>
                                    </x-inputs.group>
                                </div>
                                <div>
                                    <x-inputs.group class="col-span-6 sm:col-span-2">
                                        <x-inputs.number name="selected_date[]" id="selected_date_0"
                                            label="Date Duration" value="{{$library->selected_date}}" maxlength="255"
                                            disabled></x-inputs.number>
                                    </x-inputs.group>
                                </div>
                                <div>
                                    <br>
                                    <p class="label pt-4 text-sm font-medium text-gray-700">Day(s)</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <a href="{{ route('campaigns.index') }}" class="button">
                    <i class="mr-1 icon ion-md-return-left text-primary"></i>
                    @lang('crud.common.back')
                </a>

                <a href="{{ route('campaigns.create') }}" class="button">
                    <i class="mr-1 icon ion-md-add text-primary"></i>
                    @lang('crud.common.create')
                </a>
            </div>
        </form>
    </x-partials.card>

    @endsection