@php $editing = isset($library) @endphp

<div class="border-1 bg-gray-100 pt-4 pb-4 flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text name="msg_title" id="msg_title" label="Message Title"
            value="{{old('msg_title', ($editing ? $library->msg_title : ''))}}" maxlength="255" required>
        </x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="w-full">
        <x-inputs.textarea name="msg_text" id="msg_text" label="Message Text" maxlength="512"
            value="{{old('msg_text', ($editing ? $library->msg_text : ''))}}" required>
            {{old('msg_text', ($editing ? $library->msg_text : ''))}}</x-inputs.textarea>
    </x-inputs.group>
    <div class="grid grid-cols-2 w-full px-2">
        <div class="px-2">
            <label class="block text-sm font-medium text-gray-700">
                Message Video
            </label>
            @php
            $upload_video = old('upload_video', ($editing ? $library->upload_video : ''));
            $upload_image = old('upload_image', ($editing ? $library->upload_image : ''));
            @endphp
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative"
                style="min-height : 190px">
                <video
                    class="absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-{{$upload_video ? 100 : 0}}"
                    controls id="videoPeviewTag">
                    <source src="{{$upload_video ? asset('storage/'.$upload_video) : null}}" id="videoPreview">
                    </source>
                </video>
                @if (!$upload_video)
                <div class="space-y-1 text-center" id="new_video">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink" class="mx-auto h-10 w-10 text-gray-400"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"
                        stroke="currentColor">
                        <g>
                            <g>
                                <path d="M472,312.642v139c0,11.028-8.972,20-20,20H60c-11.028,0-20-8.972-20-20v-139H0v139c0,33.084,26.916,60,60,60h392
                                        c33.084,0,60-26.916,60-60v-139H472z" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" fill="lightgray" />
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
                        <label for="upload_video"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input id="upload_video" name="upload_video" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">
                        Mp4, Avi, Webm up to 10MB
                    </p>
                </div>
                @else
                <div class="absolute top-2 right-2">
                    <label for="upload_video"
                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white"
                            viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <input id="upload_video" name="upload_video" type="file" class="sr-only">
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
                <div class="absolute top-0 left-0 bg-cover bg-center w-full h-full" id="imagePreview"
                    style="background-image: url({{$upload_image ? asset('storage/'.$upload_image) : null}})">
                </div>
                @if (!$upload_image)
                <div class="space-y-1 text-center" id="new_image">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                        aria-hidden="true">
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="upload_image"
                            class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input id="upload_image" name="upload_image" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">
                        PNG, JPG, GIF up to 10MB
                    </p>
                </div>
                @else
                <div class="absolute top-2 right-2">
                    <label for="upload_image"
                        class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white"
                            viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                        <input id="upload_image" name="upload_image" type="file" class="sr-only">
                    </label>
                </div>
                @endif
            </div>
        </div>
    </div>
    <x-inputs.group class="col-span-6 sm:col-span-2">
        <x-inputs.text name="add_url" id="add_url" label="Add Url"
            value="{{old('add_url', ($editing ? $library->add_url : ''))}}" maxlength="255"></x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="col-span-6 sm:col-span-2">
        <x-inputs.text name="telephone" id="telephone" label="Phone Number"
            value="{{old('telephone', ($editing ? $library->telephone : ''))}}" maxlength="255"></x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="col-span-6 sm:col-span-2">
        @php
        $tmp_date = old('selected_date', ($editing ? $library->selected_date : ''));
        if ($tmp_date) {
        $tmp_date = date_create($library->selected_date);
        $tmp_date = date_format($tmp_date,"Y-m-dTh:i:s");
        $tmp_date = str_replace('UTC', 'T', $tmp_date);
        }
        @endphp
        <x-inputs.number name="selected_date" id="selected_date" label="Date Duration" value="{{$tmp_date}}"
            maxlength="255"></x-inputs.number>
    </x-inputs.group>
</div>

<script src="{{ asset('js/library.js') }}"></script>