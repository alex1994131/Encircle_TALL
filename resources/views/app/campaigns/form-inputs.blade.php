@php $editing = isset($campaign);
@endphp
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection
<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="trust_id" label="Trusts">
            @php $selected = old('trust_id', ($editing ? $campaign->trust_id : '')) @endphp

            @if($editing)
            @if(Auth::user()->isTrustAdmin())
            @foreach($trusts as $value => $label)
            @if($selected == $value)
            <option value="{{$value}}"> {{$label}} </option>
            @endif
            @endforeach
            @else
            <option {{$campaign->trust_id ? '' : 'selected'}}>For All Trusts</option>
            @foreach($trusts as $value => $label)
            <option value="{{$value}}" {{ $selected == $value ? 'selected' : ''}}> {{$label}} </option>
            @endforeach
            @endif
            @else
            @if(Auth::user()->isTrustAdmin())
            @foreach($trusts as $value => $label)
            @if($value == Auth::user()->trust_id)
            <option value="{{$value}}"> {{$label}} </option>
            @endif
            @endforeach
            @else
            <option selected>For All Trusts</option>
            @foreach($trusts as $value => $label)
            <option value="{{$value}}"> {{$label}} </option>
            @endforeach
            @endif
            @endif
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="category" label="Categories">
            @if($editing)
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
            @else
            <option value="advice" selected>Advice</option>
            <option value="appointment">Appointment</option>
            <option value="result">Result</option>
            @endif
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="content" label="Content" maxlength="512" required>
            {{ old('content', ($editing ? $campaign->content : ''))}}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text name="title" label="Title" value="{{ old('title', ($editing ? $campaign->title : '')) }}"
            maxlength="255" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-span-6 sm:col-span-2">
        <x-inputs.text list="conditions" name="condition_id" id="sel_conditions" label="Condition"
            value="{{ old('condition_id', ($editing ? $campaign->condition->name : '')) }}"
            placeholder="Select a Condition" required>
        </x-inputs.text>
        <datalist id="conditions">
            @forelse ($conditions as $condition)
            <option value="{{ $condition->name }}"></option>
            @empty
            <option value="there is no data"></option>
            @endforelse
        </datalist>
    </x-inputs.group>

    <x-inputs.group class="col-span-6 sm:col-span-2">
        <x-inputs.text list="subconditions" name="subCondition_id" label="Subcondition"
            value="{{ old('subCondition_id', ($editing ? $campaign->subCondition->name : '')) }}"
            placeholder="Select a Sub Condition" required>
        </x-inputs.text>
        <datalist id="subconditions">
            @forelse($subConditions as $subcondition)
            <option value="{{ $subcondition->name }}">
                @empty
            <option> There is no data</option>
            @endforelse
        </datalist>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox name="published" label="Published"
            :checked="old('published', ($editing ? $campaign->published : 0))"></x-inputs.checkbox>
    </x-inputs.group>

    <div class="w-full">
        <div id="message_wrapper">
            @if ($editing)
            @foreach($campaign->libraries() as $library)
            @if($library)
            <div id="messagediv_{{$loop->index}}" class="messagediv border-1 bg-gray-100 pt-4 mt-2 pb-6 flex flex-wrap">
                <p class="m-auto text-xl message-header">Message #{{$loop->index + 1}}</p>
                <input hidden name="library_id[]" id="library_id_{{$loop->index}}" value="{{$library->id}}" required />
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
                    <label class="label text-sm font-medium text-gray-700" for="msg_title[]">Message Title</label>
                    <input name="msg_title[]" id="msg_title_{{$loop->index}}" value="{{$library->msg_title}}"
                        maxlength="255" required style="border-width: 1px;"
                        class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-2 border-gray-200 rounded focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent" />
                </div>
                <x-inputs.group class="w-full">
                    <x-inputs.textarea name="msg_text[]" id="msg_text_{{$loop->index}}" label="Message Text"
                        maxlength="512" value="{{$library->msg_text}}" required>{{$library->msg_text}}
                    </x-inputs.textarea>
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
                                <source src="{{$library->upload_video ? asset('storage/'.$library->upload_video) : ''}}"
                                    id="videoPreview_{{$loop->index}}">
                                </source>
                            </video>
                            @if (!$library->upload_video)
                            <div class="space-y-1 text-center" id="new_video_{{$loop->index}}">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" class="mx-auto h-10 w-10 text-gray-400"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                    xml:space="preserve" stroke="currentColor">
                                    <g>
                                        <g>
                                            <path d="M472,312.642v139c0,11.028-8.972,20-20,20H60c-11.028,0-20-8.972-20-20v-139H0v139c0,33.084,26.916,60,60,60h392
                                                                c33.084,0,60-26.916,60-60v-139H472z" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" fill="lightgray" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <polygon points="256,0.358 131.716,124.642 160,152.926 236,76.926 236,388.642 276,388.642 276,76.926 352,152.926 
                                                                380.284,124.642" fill="darkgray" />
                                        </g>
                                    </g>
                                </svg>
                                <div class="h-1"></div>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload_video_{{$loop->index}}"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="upload_video_{{$loop->index}}" name="upload_video[]" type="file"
                                            class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    Mp4, Avi, Webm up to 10MB
                                </p>
                            </div>
                            @else
                            <div class="absolute top-2 right-2">
                                <label for="upload_video_{{$loop->index}}"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white"
                                        viewBox="0 0 24 24" stroke="black"
                                        style="background-color : cornsilk; border-radius:100%;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <input id="upload_video_{{$loop->index}}" name="upload_video[]" type="file"
                                        class="sr-only">
                                </label>
                            </div>
                            @endif
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
                            @if (!$library->upload_image)
                            <div class="space-y-1 text-center" id="new_image_{{$loop->index}}">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload_image_{{$loop->index}}"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="upload_image_{{$loop->index}}" name="upload_image[]" type="file"
                                            class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                            </div>
                            @else
                            <div class="absolute top-2 right-2">
                                <label for="upload_image_{{$loop->index}}"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white"
                                        viewBox="0 0 24 24" stroke="black"
                                        style="background-color : cornsilk; border-radius:100%;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <input id="upload_image_{{$loop->index}}" name="upload_image[]" type="file"
                                        class="sr-only">
                                </label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-5">
                    <div>
                        <x-inputs.group class="col-span-6 sm:col-span-2">
                            <x-inputs.text name="add_url[]" id="add_url_{{$loop->index}}" label="Add Url"
                                value="{{$library->add_url}}" maxlength="255"></x-inputs.text>
                        </x-inputs.group>
                    </div>
                    <div>
                        <x-inputs.group class="col-span-6 sm:col-span-2">
                            <x-inputs.text name="telephone[]" id="telephone_{{$loop->index}}" label="Phone Number"
                                value="{{$library->telephone}}" maxlength="255"></x-inputs.text>
                        </x-inputs.group>
                    </div>
                    <div>
                        <x-inputs.group class="col-span-6 sm:col-span-2">
                            <x-inputs.number name="selected_date[]" id="selected_date_0" label="Date Duration"
                                value="{{$library->selected_date}}" maxlength="255"></x-inputs.number>
                        </x-inputs.group>
                    </div>
                    <div>
                        <br>
                        <p class="label pt-4 text-sm font-medium text-gray-700">Day(s)</p>
                    </div>
                    @if(count($campaign->libraries()) > 1)
                    <div>
                        <div class="px-4 my-2 w-full">
                            <div>
                                <span id="remove_message_{{$loop->index}}"
                                    class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 rounded-md cursor-pointer float-right mt-7">
                                    <i class="mr-1 icon ion-md-remove"></i> Remove Message </span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <hr>
            @endif
            @endforeach
            @else
            <div id="messagediv_0" class="messagediv border-1 bg-gray-100 pt-4 mt-2 pb-6 flex flex-wrap">
                <input hidden name="library_id[]" id="library_id_0" value="null" />
                <p class="m-auto text-xl message-header">Message #1</p>
                <x-inputs.group class="w-full">
                    <x-inputs.text name="msg_title[]" id="msg_title_0" label="Message Title" value="" maxlength="255"
                        required></x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="w-full">
                    <x-inputs.textarea name="msg_text[]" id="msg_text_0" label="Message Text" maxlength="512" required>
                    </x-inputs.textarea>
                </x-inputs.group>

                <div class="grid grid-cols-2 w-full px-2">
                    <div class="px-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Message Video
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative"
                            style="min-height : 190px">
                            <video class="absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-0" controls
                                id="videoPeviewTag_0">
                                <source src="" id="videoPreview_0">
                                </source>
                            </video>
                            <div class="space-y-1 text-center" id="new_video_0">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" class="mx-auto h-10 w-10 text-gray-400"
                                    viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                    xml:space="preserve" stroke="currentColor">
                                    <g>
                                        <g>
                                            <path
                                                d="M472,312.642v139c0,11.028-8.972,20-20,20H60c-11.028,0-20-8.972-20-20v-139H0v139c0,33.084,26.916,60,60,60h392 c33.084,0,60-26.916,60-60v-139H472z"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                fill="lightgray" />
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <polygon points="256,0.358 131.716,124.642 160,152.926 236,76.926 236,388.642 276,388.642 276,76.926 352,152.926 
                                                    380.284,124.642" fill="darkgray" />
                                        </g>
                                    </g>
                                </svg>
                                <div class="h-1"></div>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload_video_0"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="upload_video_0" name="upload_video[]" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    Mp4, Avi, Webm up to 10MB
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <label class="block text-sm font-medium text-gray-700">
                            Message Image
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative"
                            style="min-height : 190px">
                            <div class="absolute top-0 left-0 bg-cover bg-center w-full h-full" id="imagePreview_0">
                            </div>
                            <div class="space-y-1 text-center" id="new_image_0">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload_image_0"
                                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input id="upload_image_0" name="upload_image[]" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    PNG, JPG, GIF up to 10MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-5">
                    <div>
                        <x-inputs.group class="col-span-6 sm:col-span-2">
                            <x-inputs.text name="add_url[]" id="add_url_0" label="Add Url" value="" maxlength="255">
                            </x-inputs.text>
                        </x-inputs.group>
                    </div>
                    <div>
                        <x-inputs.group class="col-span-6 sm:col-span-2">
                            <x-inputs.text name="telephone[]" id="telephone_0" label="Phone Number" value=""
                                maxlength="255"></x-inputs.text>
                        </x-inputs.group>
                    </div>
                    <div>
                        <x-inputs.group class="col-span-6 sm:col-span-2">
                            <x-inputs.number name="selected_date[]" id="selected_date_0" label="Date Duration" value=""
                                maxlength="255"></x-inputs.number>
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
        </div>
        <div class="mx-auto mt-4 mb-4 content-center grid grid-cols-2">
            <div>
                <a id="create_new_message"
                    class="bg-green-500 hover:bg-green-700 text-white py-1 px-4 rounded-md cursor-pointer float-left ml-4">
                    <i class="mr-1 icon ion-md-save"></i>
                    Add New Message
                </a>
            </div>
            <div>
                <div class="grid grid-cols-2">
                    <div class="float-right">
                        @php
                        $libraries = \App\Models\Library::all();
                        @endphp
                        <select id="duplicate_msgs" name="duplicate_msgs"
                            class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                            @foreach($libraries as $each)
                            <option value="{{$each->id}}">{{$each->msg_title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(count($libraries))
                    <div>
                        <a id="duplicate_new_message"
                            class="bg-pink-500 hover:bg-pink-700 text-white py-1 px-4 rounded-md cursor-pointer float-right mr-4">
                            <i class="mr-1 icon ion-md-save"></i>
                            Duplicate Message
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
    integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script>
var base_url = "{{ url('/') }}"
var libraries = {
    !!json_encode($libraries) !!
}
var condition_list = {
    !!json_encode($conditions) !!
}
var subcondition_list = {
    !!json_encode($subConditions) !!
}
</script>
<script src="{{ asset('libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/campaign.js') }}"></script>