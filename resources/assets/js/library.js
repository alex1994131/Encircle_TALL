$(document).ready(function () {

    const readURL = (input) => {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(`#imagePreview`).css('background-image', 'url(' + e.target.result + ')');
                $(`#imagePreview`).hide();
                $(`#imagePreview`).fadeIn(650);

                let new_image_div = $(`#new_image`);
                if (new_image_div.length) {
                    new_image_div.parent().append(`<div class="absolute top-2 right-2">
                        <label id ="upload_image_label" for="upload_image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white" viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>    
                        </label>
                    </div>`)

                    new_image_div.remove();
                    $(input).appendTo(`#upload_image_label`)
                    $("#upload_image").on('change', function () {
                        readURL(this)
                    });
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    const readVideo = (input) => {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(`#videoPreview`).attr('src', e.target.result)
                $(`#videoPeviewTag`).css('opacity', 100)
                $(`#videoPeviewTag`).get(0).load();
                $(`#videoPeviewTag`).get(0).play();

                let new_video_div = $(`#new_video`);
                if (new_video_div.length) {
                    new_video_div.parent().append(
                        `<div class="absolute top-2 right-2">
                            <label id ="upload_video_label" for="upload_video" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white" viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </label>
                        </div>`)
                    new_video_div.remove();
                    $(input).appendTo(`#upload_video_label`)
                    $("#upload_video").on('change', function () {
                        readVideo(this)
                    });
                }
            }
            reader.onprogress = function (e) {
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


    $("#upload_image").on('change', function () {
        readURL(this)
    });

    $("#upload_video").on('change', function () {
        readVideo(this)
    });
});