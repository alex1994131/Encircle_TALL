function deleteMessage(index) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this Message Data!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plz!",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(result => {
        if (result.value) {
            $("#messagediv_" + index).remove();

            let res_cnt = $("[id ^= 'remove_message_']").length;
            if (res_cnt < 2) {
                for (let i = 0; i < res_cnt; i++)
                    $("[id ^= 'remove_message_']").parent().parent().parent()[0].remove();
            }
            var msg_idx = 1;
            $('.message-header').each(function () {
                console.log('aaa')
                $(this).html(`Message #${msg_idx}`)
                msg_idx++;
            })
        }
    });
}

const date_format = (selected_date) => {
    let date = new Date(selected_date)
    let month_number = date.getMonth() + 1
    let hour_num = date.getHours() % 12
    let month = (month_number < 10 ? '0' + month_number : month_number)
    let day = (date.getDate() < 10 ? '0' + date.getDate() : date.getDate())
    let hour = (hour_num < 10 ? '0' + hour_num : hour_num)
    let minute = (date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes())
    return date.getFullYear() + '-' + month + '-' + day + 'T' + hour + ':' + minute + ":00"
}

function contentAppend(index, lib = null) {
    let selected_date = ''
    if (lib && lib.selected_date)
        selected_date = lib.selected_date
    return `<div id="messagediv_${index}" class="messagediv border-1 bg-gray-100 pt-4 mt-2 pb-6 flex flex-wrap">` +
        `<p class="m-auto text-xl message-header">Message #${index + 1}</p>` +
        `<div class="px-4 my-2 w-full">
            <input hidden name="library_id[]" id = "library_id_${index}" value = "` + (lib !== null ? lib.id : 'null') + `" />
            <label class="label text-sm font-medium text-gray-700" for="msg_title_${index}">Message Title</label>` +
        `<input
                name="msg_title[]"
                id="msg_title_${index}"
                type="text"`
        + 'value = "' + ((lib && lib.msg_title) ? lib.msg_title : '') +
        `"
                class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded"                                                               
                maxlength="255"
                required>
            </input> 
        </div>
        <div class="px-4 my-2 w-full">
            <label class="label text-sm font-medium text-gray-700" for="msg_text_${index}">Message Text</label>
            <textarea
                name="msg_text[]"
                id="msg_text_${index}"                    
                class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded"                                                               
                maxlength="512"`
        + 'value = "' + ((lib && lib.msg_text) ? lib.msg_text : '') +
        `"
                required>`+ (lib ? lib.msg_text : '') + `</textarea> 
        </div>
        
        <div class="grid grid-cols-2 w-full px-2">
            <div class="px-2">
                <label class="block text-sm font-medium text-gray-700">
                    Message Video
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style = "min-height : 190px">
                    <video class = "absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-` + ((lib && lib.upload_video) ? '100' : '0') + `" controls id="videoPeviewTag_` + index + `">
                        <source src="` + ((lib && lib.upload_video) ? base_url + '/storage/' + lib.upload_video : '') + `" id="videoPreview_` + index + `"></source>
                    </video>
                    ` +
        (!(lib && lib.upload_video) ?
            `<div class="space-y-1 text-center" id="new_video_${index}">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="mx-auto h-10 w-10 text-gray-300"
                                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path d="M472,312.642v139c0,11.028-8.972,20-20,20H60c-11.028,0-20-8.972-20-20v-139H0v139c0,33.084,26.916,60,60,60h392
                                                c33.084,0,60-26.916,60-60v-139H472z"  fill="lightgray"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <polygon points="256,0.358 131.716,124.642 160,152.926 236,76.926 236,388.642 276,388.642 276,76.926 352,152.926 
                                                380.284,124.642"  fill="darkgray"/>
                                        </g>
                                    </g>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="upload_video_${index}" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input id="upload_video_${index}" `
            + `value = ""
                                    name="upload_video[]" type="file" class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                    Mp4, Avi, Webm up to 10MB
                                </p>
                            </div>`
            :
            `<div class="absolute top-2 right-2">
                                <label for="upload_video_${index}" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white" viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                    <input id="upload_video_${index}" name="upload_video[]" value="` + lib.upload_video + `" type="file" class="sr-only">
                                </label>
                            </div>`
        )
        +
        `</div>
            </div>
            <div class="px-2">
                <label class="block text-sm font-medium text-gray-700">Message Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style = "min-height : 190px">
                    <div class = "absolute top-0 left-0 bg-cover bg-center w-full h-full" id="imagePreview_`+ index + `" 
                        style="background-image: url(` + ((lib && lib.upload_image) ? base_url + '/storage/' + lib.upload_image : '') + `)">
                    </div>`
        + (!(lib && lib.upload_image) ?
            `<div class="space-y-1 text-center" id = "new_image_${index}">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="upload_image_${index}" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input id="upload_image_${index}" `
            + `value = ""
                            name="upload_image[]" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500"> PNG, JPG, GIF up to 10MB </p>
                    </div>`
            :
            `
                    <div class="absolute top-2 right-2">
                        <label for="upload_image_${index}" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white" viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            <input id="upload_image_${index}" name="upload_image[]" value = "` + lib.upload_image + `" type="file" class="sr-only">
                        </label>
                    </div>`)
        +
        `</div>
            </div>
        </div>
        <div class="grid grid-cols-5">
            <div>
                <div class="px-4 my-2 w-full">
                    <label class="label text-sm font-medium text-gray-700" for="add_url_${index}">Message Url</label>
                    <input
                        name="add_url[]"
                        id="add_url_${index}"
                        type="text"`
        + 'value = "' + ((lib && lib.add_url) ? lib.add_url : '') +
        `"
                        class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded"                                                               
                        maxlength="255"
                        >
                    </input> 
                </div>                     
            </div>
            <div>
                <div class="px-4 my-2 w-full">
                    <label class="label text-sm font-medium text-gray-700" for="telephone_${index}">Phone Number</label>
                    <input
                        name="telephone[]"
                        id="telephone_${index}"
                        type="text"`
        + 'value = "' + ((lib && lib.telephone) ? lib.telephone : '') +
        `"
                        class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded"                                                               
                        maxlength="255"
                        >
                    </input> 
                </div>                     
            </div>
            <div>
                <div class="px-4 my-2 w-full">
                    <label class="label text-sm font-medium text-gray-700" for="selected_date_${index}">Date Duration</label>
                    <input
                        name="selected_date[]"
                        id="selected_date_${index}"
                        type="number"`
        + 'value = "' + selected_date +
        `"
                        class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded"                                                               
                        maxlength="255"
                        >
                    </input> 
                </div>
            </div>
            <div>
                <br>
                <p class="label pt-4 text-sm font-medium text-gray-700">Day(s)</p>
            </div>
            <div>
                <div class="px-4 my-2 w-full">                      
                    <div>
                        <span id="remove_message_${index}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 rounded-md cursor-pointer float-right mt-7">
                            <i class="mr-1 icon ion-md-remove"></i> Remove Message </span>
                    </div>
                </div>
            </div>                                                              
        </div>                                              
    </div>
    <hr />`

}

$(document).ready(function () {

    let res_cnt = $("[id ^= 'remove_message_']").length;
    if (res_cnt < 2) {
        for (let i = 0; i < res_cnt; i++)
            $("[id ^= 'remove_message_']").parent().parent().parent()[0].remove();
    }

    $(document).on('change', 'input', function () {
        if ($(this).attr('id') == 'subCondition_id')
            return
        var selected_val = $(this).val();
        var conditions = condition_list.find(({ name }) => name === selected_val)
        var subconditions = subcondition_list.filter(({ condition_id }) => condition_id == conditions['id'])
        var subcondition_html = ""
        for (let i = 0; i < subconditions.length; i++) {
            subcondition_html += '<option value="' + subconditions[i].name + '">'
        }
        $("#subconditions").html(subcondition_html)
    });

    const getLastIndex = () => {
        let obj = $("[id ^= 'messagediv_']");
        let length_index = obj.length;

        if (!length_index)
            return 0;
        let last_obj = obj[length_index - 1];
        let last_id = $(last_obj).attr('id');
        let index = last_id.split('_')[1];

        index++;
        length_index++;
        return index;
    }

    const getCurrentCnt = () => {
        return $("[id ^= 'messagediv_']").length;
    }


    $("[id ^= 'remove_message_']").on('click', function () {
        let id = $(this).attr('id')
        let index = id.split('_')[2]
        deleteMessage(index)
    });


    $("#create_new_message").on('click', function () {
        let lastIndex = getLastIndex();
        if (getCurrentCnt() === 1) {
            let removeHtml = `<div>
                <div class="px-4 my-2 w-full">                      
                    <div>
                        <span id="remove_message_${lastIndex - 1}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 rounded-md cursor-pointer float-right mt-7">
                        <i class="mr-1 icon ion-md-remove"></i> Remove Message </span>
                    </div>
                </div>
            </div>`
            $(`#messagediv_${lastIndex - 1}`).children().last().append(removeHtml);
            $("[id ^= 'remove_message_']").on('click', function () {
                let id = $(this).attr('id')
                let index = id.split('_')[2]
                deleteMessage(index)
            });
        }

        let html = contentAppend(lastIndex);
        $("#message_wrapper").append(html);
        let index = $("[id ^= 'remove_message_']").last().attr('id');
        index = index.split('_');
        $("[id ^= 'remove_message_']").last().click(function () {
            deleteMessage(index[2])
        });


        $("[id ^= 'upload_video_']").on('change', function () {
            let id = $(this).attr('id')
            let index = id.split('_')[2]
            readVideo(this, index)
        });

        $("[id ^= 'upload_image_']").on('change', function () {
            let id = $(this).attr('id')
            let index = id.split('_')[2]
            readURL(this, index)
        });

        var msg_idx = 1;
        $('.message-header').each(function () {
            console.log('aaa')
            $(this).html(`Message #${msg_idx}`)
            msg_idx++;
        })
    });

    $("#duplicate_new_message").on('click', function () {
        let lastIndex = getLastIndex();
        if (getCurrentCnt() === 1) {
            let removeHtml = `<div>
                <div class="px-4 my-2 w-full">                      
                    <div>
                        <span id="remove_message_${lastIndex - 1}" class="bg-red-500 hover:bg-red-700 text-white py-1 px-4 rounded-md cursor-pointer float-right mt-7">
                        <i class="mr-1 icon ion-md-remove"></i> Remove Message </span>
                    </div>
                </div>
            </div>`
            $(`#messagediv_${lastIndex - 1}`).children().last().append(removeHtml);
            $("[id ^= 'remove_message_']").on('click', function () {
                let id = $(this).attr('id')
                let index = id.split('_')[2]
                deleteMessage(index)
            });
        }

        id = $('#duplicate_msgs').val()
        libraries.map((each) => {
            if (each.id == id) {
                let html = contentAppend(lastIndex, each);
                $("#message_wrapper").append(html);
            }
        })
        let index = $("[id ^= 'remove_message_']").last().attr('id');
        index = index.split('_');
        $("[id ^= 'remove_message_']").last().click(function () {
            deleteMessage(index[2])
        });


        $("[id ^= 'upload_video_']").on('change', function () {
            let id = $(this).attr('id')
            let index = id.split('_')[2]
            readVideo(this, index)
        });

        $("[id ^= 'upload_image_']").on('change', function () {
            let id = $(this).attr('id')
            let index = id.split('_')[2]
            readURL(this, index)
        });

        var msg_idx = 1;
        $('.message-header').each(function () {
            console.log('aaa')
            $(this).html(`Message #${msg_idx}`)
            msg_idx++;
        })
    });

    function readURL(input, index) {

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(`#imagePreview_${index}`).css('background-image', 'url(' + e.target.result + ')');
                $(`#imagePreview_${index}`).hide();
                $(`#imagePreview_${index}`).fadeIn(650);

                let new_image_div = $(`#new_image_${index}`);
                if (new_image_div.length) {
                    new_image_div.parent().append(`<div class="absolute top-2 right-2">
                        <label id ="upload_image_label_${index}" for="upload_image_${index}" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white" viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>    
                        </label>
                    </div>`)

                    new_image_div.remove();
                    $(input).appendTo(`#upload_image_label_${index}`)
                    $("[id ^= 'upload_image_']").on('change', function () {
                        let id = $(this).attr('id')
                        let index = id.split('_')[2]
                        readURL(this, index)
                    });
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("[id ^= 'upload_image_']").on('change', function () {
        let id = $(this).attr('id')
        let index = id.split('_')[2]
        readURL(this, index)
    });


    function readVideo(input, index) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $(`#videoPreview_${index}`).attr('src', e.target.result)
                $(`#videoPeviewTag_${index}`).css('opacity', 100)
                $(`#videoPeviewTag_${index}`).get(0).load();
                $(`#videoPeviewTag_${index}`).get(0).play();

                let new_video_div = $(`#new_video_${index}`);
                if (new_video_div.length) {
                    new_video_div.parent().append(
                        `<div class="absolute top-2 right-2">
                            <label id ="upload_video_label_${index}" for="upload_video_${index}" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7  px-1 py-1" fill="white" viewBox="0 0 24 24" stroke="black" style="background-color : cornsilk; border-radius:100%;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                            </label>
                        </div>`)

                    new_video_div.remove();
                    $(input).appendTo(`#upload_video_label_${index}`)
                    $("[id ^= 'upload_video_']").on('change', function () {
                        let id = $(this).attr('id')
                        let index = id.split('_')[2]
                        readVideo(this, index)
                    });
                }
            }
            reader.onprogress = function (e) {
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("[id ^= 'upload_video_']").on('change', function () {
        let id = $(this).attr('id')
        let index = id.split('_')[2]
        readVideo(this, index)
    });

    $("#campaignForm").submit((e) => {
        e.preventDefault();

        let flag = true
        let data = $('#campaignForm').serializeArray().reduce(function (obj, item) {
            switch (item.name) {
                case 'library_id[]':
                case 'add_url[]':
                case 'msg_title[]':
                case 'msg_text[]':
                case 'telephone[]':
                case 'selected_date[]':
                    if (!obj[item.name])
                        obj[item.name] = []
                    obj[item.name].push(item.value)
                    break;
                default:
                    obj[item.name] = item.value;
            }
            return obj;
        }, {});


        data['library_id[]'].map((each, idx) => {
            let lib = libraries.find(item => item.id == each)
            if (!lib) return;

            $("[id ^= 'library_id_']").each(function () {
                let id = $(this).attr('id')
                let index_id = id.split('_')[2]


                let lib_id = $(`#library_id_${index_id}`).val();
                if (lib_id != each) return;

                // Check this message title is existing on library list.
                let title_lib = libraries.find(item => item.msg_title == data['msg_title[]'][idx])

                if (title_lib)
                    if (!(data['add_url[]'][idx] == lib.add_url &&
                        data['msg_text[]'][idx] == lib.msg_text &&
                        data['selected_date[]'][idx] == date_format(lib.selected_date) &&
                        data['telephone[]'][idx] == lib.telephone) ||
                        $(`#upload_video_${index_id}`).val() ||
                        $(`#upload_image_${index_id}`).val()
                    ) {
                        $(`#msg_title_${index_id}`).val('');
                        $(`#msg_title_${index_id}`).focus();
                        flag = false;
                    }
            });
        })


        if (flag) {
            $("#campaignForm").unbind('submit').submit();
        }
    })

});