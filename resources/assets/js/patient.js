var selected_condition = document.getElementById('condition_filter');
selected_condition.addEventListener('change', function () {
    var sel_condition = selected_condition.value
    console.log(sel_condition)
    var subconditions = subcondition_list.filter(({ condition_id }) => condition_id == sel_condition)
    console.log(subconditions);
    var html = ""
    for (var i = 0; i < subconditions.length; i++) {
        html += '<option value="' + subconditions[i].id + '">' + subconditions[i].name + '</option>';
    }
    document.getElementById('subCondition_filter').innerHTML = ""
    document.getElementById('subCondition_filter').innerHTML = html
})

$(document).ready(function() {

    $(`#order_type`).select2({})
    $(`#next_order_type`).select2({})
    $('.select2-container').width('100%')
    if (keydates)
        displayKeydates();

    test_types.forEach(function (type) {
        typeOptions += `<option value="` + type.id + `">` + type.test_name + `</option>`
    });

    function displayCampaign(index) {
        var campaign_html = `<div class="w-full">            
            <div class="px-4 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">` +
            `<label class="label text-sm font-medium text-gray-700" for="title">Title</label>` +
            `<input type="text" name="title" readonly class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded" value="` + (campaigns[index].title) + `">
            </div>` +
            `<div class="px-4 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300 mb-4">` +
            `<label class="label text-sm font-medium text-gray-700" for="content">Content</label>` +
            `<textarea name="content" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded">` + (campaigns[index].content) + `</textarea>
            </div>
        </div>`;
        if (campaigns[index].msgs) {
            $.ajax({
                type: 'POST',
                url: base_url + '/libraries/getMessages',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    msgs: campaigns[index].msgs,
                },
                success: function (response) {
                    var msgList = response.msgList;
                    for (let i = 0; i < msgList.length; i++) {
                        campaign_html += `<div id="messagediv_` + i + `" class="border-1 bg-gray-100 pt-4 pb-4">
                            <div class="px-4 my-2 w-full">
                                <label class="label text-sm font-medium text-gray-700" for="msg_title[]">Message Title</label>
                                <input type="text" id="msg_title_`+ i + `" name="msg_title[]" readonly value="` + msgList[i].msg_title + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                            </div>                              
                            <div class="px-4 my-2 w-full">
                                <label class="label text-sm font-medium text-gray-700" for="msg_text[]">Message Text</label>
                                <textarea id="msg_text_`+ i + `" name="msg_text[]" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded" maxlength="512" value="` + msgList[i].msg_text + `">` + msgList[i].msg_text + `</textarea>
                            </div>                            
                            <div class="grid grid-cols-2 w-full px-2">
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">Message Video</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                        <video class="absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-100" controls="" id="videoPeviewTag_`+ i + `">
                                            <source src="`+ ((msgList[i] && msgList[i].upload_video) ? base_url + '/storage/' + msgList[i].upload_video : '') + `" id="videoPreview_` + i + `">
                                        </video>                                        
                                    </div>
                                </div>
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">Message Image</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                        <div class="absolute top-0 left-0 bg-cover bg-center w-full h-full" id="imagePreview_`+ i + `" style="background-image: url(` + ((msgList[i] && msgList[i].upload_image) ? base_url + '/storage/' + msgList[i].upload_image : '') + `)"></div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="grid grid-cols-3">                                    
                                <div>
                                    <div class="px-4 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="add_url[]">Add Url</label>
                                        <input type="text" id="add_url_`+ i + `" name="add_url[]" readonly value="` + msgList[i].add_url + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>                                                                          
                                </div>
                                <div>
                                    <div class="px-4 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="telephone[]">Phone Number</label>
                                        <input type="text" id="telephone_`+ i + `" name="telephone[]" readonly value="` + msgList[i].telephone + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>   
                                </div>
                                <div>
                                    <div class="px-4 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="selected_date[]">Date/Time Rule</label>
                                        <input type="text" id="selected_date_`+ i + `" name="selected_date[]" readonly value="` + msgList[i].selected_date + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>
                                </div>                                                                     
                            </div>
                            <hr class="h-1 bg-gray-300">
                        </div>`
                    }
                    $("#campaign_display").html(campaign_html);
                }
            });
        }
    }

    function displayResultCampaign(id) {

        console.log(id);
        var result_campaign = null;
        for (var i = 0; i < global_campaigns.length; i++) {
            if (global_campaigns[i].id == id) {
                result_campaign = global_campaigns[i];
                break;
            }
        }
        var campaign_html = `<div class="w-full">            
            <div class="px-2 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">` +
            `<label class="label text-sm font-medium text-gray-700" for="title">Title</label>` +
            `<input type="text" name="title" readonly class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded" value="` + (result_campaign.title) + `">
            </div>` +
            `<div class="px-2 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300 mb-4">` +
            `<label class="label text-sm font-medium text-gray-700" for="content">Content</label>` +
            `<textarea name="content" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded">` + (result_campaign.content) + `</textarea>
            </div>
        </div>`;
        if (result_campaign.msgs) {
            $.ajax({
                type: 'POST',
                url: base_url + '/libraries/getMessages',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    msgs: result_campaign.msgs,
                },
                success: function (response) {
                    var msgList = response.msgList;
                    for (let i = 0; i < msgList.length; i++) {
                        campaign_html += `<div id="messagediv_` + i + `" class="border-1 bg-gray-100 pt-4 pb-4">
                            <div class="px-2 my-2 w-full">
                                <label class="label text-sm font-medium text-gray-700" for="msg_title[]">Message Title</label>
                                <input type="text" id="msg_title_`+ i + `" name="msg_title[]" readonly value="` + msgList[i].msg_title + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                            </div>                              
                            <div class="px-2 my-2 w-full">
                                <label class="label text-sm font-medium text-gray-700" for="msg_text[]">Message Text</label>
                                <textarea id="msg_text_`+ i + `" name="msg_text[]" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded" maxlength="512" value="` + msgList[i].msg_text + `">` + msgList[i].msg_text + `</textarea>
                            </div>                            
                            <div class="grid grid-cols-2 w-full px-2">
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">Message Video</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                        <video class="absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-100" controls="" id="videoPeviewTag_`+ i + `">
                                            <source src="`+ ((msgList[i] && msgList[i].upload_video) ? base_url + '/storage/' + msgList[i].upload_video : '') + `" id="videoPreview_` + i + `">
                                        </video>                                        
                                    </div>
                                </div>
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">Message Image</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                        <div class="absolute top-0 left-0 bg-cover bg-center w-full h-full" id="imagePreview_`+ i + `" style="background-image: url(` + ((msgList[i] && msgList[i].upload_image) ? base_url + '/storage/' + msgList[i].upload_image : '') + `)"></div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="grid grid-cols-3">                                    
                                <div>
                                    <div class="px-2 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="add_url[]">Add Url</label>
                                        <input type="text" id="add_url_`+ i + `" name="add_url[]" readonly value="` + msgList[i].add_url + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>                                                                          
                                </div>
                                <div>
                                    <div class="px-2 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="telephone[]">Phone Number</label>
                                        <input type="text" id="telephone_`+ i + `" name="telephone[]" readonly value="` + msgList[i].telephone + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>   
                                </div>
                                <div>
                                    <div class="px-2 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="selected_date[]">Date/Time Rule</label>
                                        <input type="text" id="selected_date_`+ i + `" name="selected_date[]" readonly value="` + msgList[i].selected_date + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>
                                </div>                                                                     
                            </div>
                            <hr class="h-1 bg-gray-300">
                        </div>`
                    }
                    $(".display_result_campaign").html(campaign_html);
                }
            });
        }
    }

    function displayAptCampaign(id) {

        console.log(id);
        var apt_campaign = null;
        for (var i = 0; i < global_campaigns.length; i++) {
            if (global_campaigns[i].id == id) {
                apt_campaign = global_campaigns[i];
                break;
            }
        }
        var campaign_html = `<div class="w-full">            
            <div class="px-2 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">` +
            `<label class="label text-sm font-medium text-gray-700" for="title">Title</label>` +
            `<input type="text" name="title" readonly class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded" value="` + (apt_campaign.title) + `">
            </div>` +
            `<div class="px-2 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300 mb-4">` +
            `<label class="label text-sm font-medium text-gray-700" for="content">Content</label>` +
            `<textarea name="content" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded">` + (apt_campaign.content) + `</textarea>
            </div>
        </div>`;
        if (apt_campaign.msgs) {
            $.ajax({
                type: 'POST',
                url: base_url + '/libraries/getMessages',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    msgs: apt_campaign.msgs,
                },
                success: function (response) {
                    var msgList = response.msgList;
                    for (let i = 0; i < msgList.length; i++) {
                        campaign_html += `<div id="messagediv_` + i + `" class="border-1 bg-gray-100 pt-4 pb-4">
                            <div class="px-2 my-2 w-full">
                                <label class="label text-sm font-medium text-gray-700" for="msg_title[]">Message Title</label>
                                <input type="text" id="msg_title_`+ i + `" name="msg_title[]" readonly value="` + msgList[i].msg_title + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                            </div>                              
                            <div class="px-2 my-2 w-full">
                                <label class="label text-sm font-medium text-gray-700" for="msg_text[]">Message Text</label>
                                <textarea id="msg_text_`+ i + `" name="msg_text[]" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded" maxlength="512" value="` + msgList[i].msg_text + `">` + msgList[i].msg_text + `</textarea>
                            </div>                            
                            <div class="grid grid-cols-2 w-full px-2">
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">Message Video</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                        <video class="absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-100" controls="" id="videoPeviewTag_`+ i + `">
                                            <source src="`+ ((msgList[i] && msgList[i].upload_video) ? base_url + '/storage/' + msgList[i].upload_video : '') + `" id="videoPreview_` + i + `">
                                        </video>                                        
                                    </div>
                                </div>
                                <div class="px-2">
                                    <label class="block text-sm font-medium text-gray-700">Message Image</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                        <div class="absolute top-0 left-0 bg-cover bg-center w-full h-full" id="imagePreview_`+ i + `" style="background-image: url(` + ((msgList[i] && msgList[i].upload_image) ? base_url + '/storage/' + msgList[i].upload_image : '') + `)"></div>
                                    </div>
                                </div>
                            </div>                            
                            <div class="grid grid-cols-3">                                    
                                <div>
                                    <div class="px-2 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="add_url[]">Add Url</label>
                                        <input type="text" id="add_url_`+ i + `" name="add_url[]" readonly value="` + msgList[i].add_url + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>                                                                          
                                </div>
                                <div>
                                    <div class="px-2 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="telephone[]">Phone Number</label>
                                        <input type="text" id="telephone_`+ i + `" name="telephone[]" readonly value="` + msgList[i].telephone + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>   
                                </div>
                                <div>
                                    <div class="px-2 my-2 col-span-6 sm:col-span-2">
                                        <label class="label text-sm font-medium text-gray-700" for="selected_date[]">Date/Time Rule</label>
                                        <input type="text" id="selected_date_`+ i + `" name="selected_date[]" readonly value="` + msgList[i].selected_date + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                    </div>
                                </div>                                                                     
                            </div>
                            <hr class="h-1 bg-gray-300">
                        </div>`
                    }
                    $(".display_apt_campaign").html(campaign_html);
                }
            });
        }
    }

    function displaySavedCampaign(index) {
        var campaign_html = `<div class="w-full">            
            <div class="px-4 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">` +
            `<label class="label text-sm font-medium text-gray-700" for="title">Title</label>` +
            `<input type="text" name="title" readonly class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded" value="` + (saved_campaigns[index].title) + `">
            </div>` +
            `<div class="px-4 my-2 focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300 mb-4">` +
            `<label class="label text-sm font-medium text-gray-700" for="content">Content</label>` +
            `<textarea name="content" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded">` + (saved_campaigns[index].content) + `</textarea>
            </div>
        </div>`;
        if (saved_campaigns[index].msgs) {
            $.ajax({
                type: 'POST',
                url: base_url + '/libraries/getPatientMessages',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    msgs: saved_campaigns[index].msgs,
                },
                success: function (response) {
                    var msgList = response.msgList;
                    console.log(msgList);
                    for (let i = 0; i < msgList.length; i++) {
                        if (msgList[i]) {
                            campaign_html += `<div id="messagediv_` + i + `" class="border-1 bg-gray-100 pt-4 pb-4">
                                <div class="px-4 my-2 w-full">
                                    <label class="label text-sm font-medium text-gray-700" for="msg_title[]">Message Title</label>
                                    <input type="text" id="msg_title_`+ i + `" name="msg_title[]" readonly value="` + msgList[i].msg_title + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                </div>                              
                                <div class="px-4 my-2 w-full">
                                    <label class="label text-sm font-medium text-gray-700" for="msg_text[]">Message Text</label>
                                    <textarea id="msg_text_`+ i + `" name="msg_text[]" rows="3" readonly class="block appearance-none w-full py-1 px-2 mb-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border border-gray-200 rounded" maxlength="512" value="` + msgList[i].msg_text + `">` + msgList[i].msg_text + `</textarea>
                                </div>                            
                                <div class="grid grid-cols-2 w-full px-2">
                                    <div class="px-2">
                                        <label class="block text-sm font-medium text-gray-700">Message Video</label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                            <video class="absolute top-0 left-0 bg-cover bg-center w-full h-full opacity-100" controls="" id="videoPeviewTag_`+ i + `">
                                                <source src="`+ ((msgList[i] && msgList[i].upload_video) ? base_url + '/storage/' + msgList[i].upload_video : '') + `" id="videoPreview_` + i + `">
                                            </video>                                        
                                        </div>
                                    </div>
                                    <div class="px-2">
                                        <label class="block text-sm font-medium text-gray-700">Message Image</label>
                                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md relative" style="min-height : 190px">
                                            <div class="absolute top-0 left-0 bg-cover bg-center w-full h-full" id="imagePreview_`+ i + `" style="background-image: url(` + ((msgList[i] && msgList[i].upload_image) ? base_url + '/storage/' + msgList[i].upload_image : '') + `)"></div>
                                        </div>
                                    </div>
                                </div>                            
                                <div class="grid grid-cols-3">                                    
                                    <div>
                                        <div class="px-4 my-2 col-span-6 sm:col-span-2">
                                            <label class="label text-sm font-medium text-gray-700" for="add_url[]">Add Url</label>
                                            <input type="text" id="add_url_`+ i + `" name="add_url[]" readonly value="` + msgList[i].add_url + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                        </div>                                                                          
                                    </div>
                                    <div>
                                        <div class="px-4 my-2 col-span-6 sm:col-span-2">
                                            <label class="label text-sm font-medium text-gray-700" for="telephone[]">Phone Number</label>
                                            <input type="text" id="telephone_`+ i + `" name="telephone[]" readonly value="` + msgList[i].telephone + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                        </div>   
                                    </div>
                                    <div>
                                        <div class="px-4 my-2 col-span-6 sm:col-span-2">
                                            <label class="label text-sm font-medium text-gray-700" for="selected_date[]">Date/Time Rule</label>
                                            <input type="text" id="selected_date_`+ i + `" name="selected_date[]" readonly value="` + msgList[i].selected_date + `" class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                        </div>
                                    </div>                                                                     
                                </div>
                                <hr class="h-1 bg-gray-300">
                            </div>`
                        }
                    }
                    $("#campaign_display").html(campaign_html);
                }
            });
        }
    }

    $(".to_archive").on('click', function () {
        var campaign_id_str = $(this).attr('id')
        var campaign_ids = campaign_id_str.split('_')
        var campaign_id = campaign_ids[2]
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, convert it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(result => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: base_url + '/patients/convertToArchive',
                    dataType: 'json',
                    data: {
                        _token: $("[name='_token']").val(),
                        campaign: saved_campaigns[campaign_id],
                    },
                    success: function (response) {
                        var campaign = response.changed_campaign;
                        $(`#active_column_${campaign.id}`).remove();
                    }
                })
            }
        });

    })

    $("#search_keydates").on('click', function () {
        var condition = $("#keydate_condition_filter").val();
        var subcondition = $("#keydate_subCondition_filter").val();
        if (!condition) {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Select the Condition First!',
            });
        } else {
            $.ajax({
                type: 'POST',
                url: base_url + '/patients/getKeydatesByFilter',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    condtion: condition,
                    subcondition: subcondition,
                    patient_id: patient.id,
                },
                success: function (response) {
                    keydates = response.keydates;

                    console.log(keydates);
                    displayKeydates();
                }
            })
        }
    })

    $('body').on('click', '.result-btn', function () {
        var keydate_ids = $(this).attr("id").split('_');
        var ordered_test_types = keydates[keydate_ids[2]].test_types.split(',');
        $('#result_date').val('');
        $('#lab_ref').val('');
        $('#result_types').val('normal');

        $('#result_date_required').hide()
        $('#lab_ref_required').hide()
        $('#result_campaign_required').hide()
        $('#keydate_id').val(keydate_ids[2]);
        var html = "";
        console.log(ordered_test_types);
        for (var i = 0; i < ordered_test_types.length; i++) {
            for (var j = 0; j < test_types.length; j++) {
                if (test_types[j].id == ordered_test_types[i]) {
                    html += `<div class="grid-cols-2 px-3">
                                <p class="text-xs font-medium text-gray-500 text-left col-span-1">
                                    ${test_types[j].test_name}
                                </p>
                                <input type="text" id="results_id_${i}" multiple="multiple" required class="results_data_class col-span-1 block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300" maxlength="255">
                            </div>
                            `
                    break;
                }
            }
        }
        $('.result-div').html(html);

        html = `<option value="">Select Result Campaign</option>`;
        for (i = 0; i < global_campaigns.length; i++) {
            if (global_campaigns[i].condition_id == keydates[keydate_ids[2]].condition_id && global_campaigns[i].subCondition_id == keydates[keydate_ids[2]].subcondition_id && global_campaigns[i].category == "result") {
                html += `<option value="${global_campaigns[i].id}">${global_campaigns[i].title}</option>`;
            }
        }
        $('#result_campaign').html(html);

        $('.display_result_campaign').html("");
        openModal('keydate-result-modal');
    })

    $('body').on('click', '.next-apt-btn', function () {
        var html = `<option value="">Select Appointment Campaign</option>`;
        $('#next_order_num').val('');
        $('#next_apt_due').val('');
        var today = new Date();
        var date_month = (today.getMonth() + 1) >= 10 ? today.getMonth + 1 : '0' + (today.getMonth() + 1)
        var date_day = today.getDate() >= 10 ? today.getDate() : '0' + today.getDate()
        var date = today.getFullYear() + '-' + date_month + '-' + date_day;
        $('#next_kick_off_date').val(date);
        $(".display_apt_campaign").html("");

        $('#next_order_num_required').hide();
        $('#next_kick_off_date_required').hide();
        $('#next_order_type_required').hide();
        $('#apt_campaign_required').hide();
        var keydate_ids = $(this).attr("id").split('_');
        var ordered_test_types = keydates[keydate_ids[2]].test_types.split(',');
        $('#keydate_id').val(keydate_ids[2]);
        var keydate_ids = $(this).attr("id").split('_');
        for (i = 0; i < global_campaigns.length; i++) {
            if (global_campaigns[i].condition_id == keydates[keydate_ids[2]].condition_id && global_campaigns[i].subCondition_id == keydates[keydate_ids[2]].subcondition_id && global_campaigns[i].category == "appointment") {
                html += `<option value="${global_campaigns[i].id}">${global_campaigns[i].title}</option>`;
            }
        }
        $('#apt_campaign').html(html);
        openModal('next-apt-keydate-modal');
    })

    $('body').on('change', '#result_campaign', function () {
        displayResultCampaign($(this).val())
    })

    $('body').on('change', '#apt_campaign', function () {
        displayAptCampaign($(this).val())
    })

    $('body').on('click', '.add_result_data', function () {

        var results = [];
        $('.results_data_class').each(function (i, obj) {
            //test
            var temp_arr = $(this).attr('id').split('_');
            results[temp_arr[2]] = $(this).val();
        });
        var result_date = $('#result_date').val()
        var lab_ref = $('#lab_ref').val()
        var result_type = $('#result_types').val()
        var result_campaign = $('#result_campaign').val()
        var keydate_arr_id = $('#keydate_id').val()
        var keydate_id = keydates[keydate_arr_id].id;
        var condition = keydates[keydate_arr_id].condition_id;
        var subcondition = keydates[keydate_arr_id].subcondition_id;
        console.log(result_campaign);
        if (result_date != "" && result_campaign != "" && lab_ref != "") {
            $.ajax({
                type: 'POST',
                url: base_url + '/patients/addResultData',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    result_date: result_date,
                    lab_ref: lab_ref,
                    result_type: result_type,
                    result_campaign: result_campaign,
                    results: results,
                    keydate_id: keydate_id,
                    patient_id: patient.id,
                    condition: condition,
                    subcondition: subcondition,
                },
                success: function (response) {
                    console.log(response);
                    keydates = response.keydates;
                    displayKeydates();
                    modalClose('keydate-result-modal');
                }
            })
        }
        else {
            if (result_date == "")
                $('#result_date_required').show()
            if (result_campaign == "")
                $('#result_campaign_required').show()
            if (lab_ref == "")
                $('#lab_ref_required').show()
        }
    })

    $('body').on('click', '.add_next_apt_btn', function () {
        var next_apt_order_num = $('#next_order_num').val();
        var next_apt_due = $('#next_apt_due').val();
        var next_kick_off_date = $('#next_kick_off_date').val();
        var next_test_types = $('#next_order_type').val();
        var apt_campaign = $('#apt_campaign').val();
        var keydate_arr_id = $('#keydate_id').val()
        var keydate_id = keydates[keydate_arr_id].id;

        if (next_apt_order_num != "" && next_kick_off_date != "" && apt_campaign != "" && next_test_types.length != 0) {
            $.ajax({
                type: 'POST',
                url: base_url + '/patients/addNextAppointment',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    next_apt_order_num: next_apt_order_num,
                    next_apt_due: next_apt_due,
                    next_test_types: next_test_types,
                    next_kick_off_date: next_kick_off_date,
                    patient_id: patient.id,
                    apt_campaign: apt_campaign,
                    keydate_id: keydate_id,
                },
                success: function (response) {
                    console.log(response);
                    keydates = response.keydates;
                    show_keydate_campaigns = response.showKeydateCampaigns;
                    displayKeydates();
                    modalClose('next-apt-keydate-modal');
                }
            })
        }
        else {
            if (next_apt_order_num == "") {
                $('#next_order_num_required').show();
            }
            if (next_kick_off_date == "") {
                $('#next_kick_off_date_required').show();
            }
            if (next_test_types.length == 0) {
                $('#next_order_type_required').show();
            }
            if (apt_campaign == "") {
                $('#apt_campaign_required').show();
            }
        }
    })

    $("#search_campaigns").on('click', function () {
        var condition = $("#condition_filter").val();
        var subcondition = $("#subCondition_filter").val();
        console.log(condition, subcondition);
        if (!condition) {
            Swal.fire({
                type: 'warning',
                title: 'Oops...',
                text: 'Select the Condition First!',
            });
        } else {
            $.ajax({
                type: 'POST',
                url: base_url + '/patients/getCampaignsByFilter',
                dataType: 'json',
                data: {
                    _token: $("[name='_token']").val(),
                    condition: condition,
                    subcondition: subcondition,
                },
                success: function (response) {
                    var campaigns_temp = response.campaigns;
                    var cnt = 0;
                    campaigns = [];
                    for (var idx = 0; idx < campaigns_temp.length; idx++) {
                        if (campaigns_temp[idx].category != "result") {
                            campaigns[cnt] = campaigns_temp[idx];
                            cnt++;
                        }
                    }
                    console.log(campaigns);
                    var html = "";
                    if (campaigns) {
                        for (var i = 0; i < campaigns.length; i++) {
                            var flg = 0;
                            for (var j = 0; j < flg_global_campaigns.length; j++) {
                                if (flg_global_campaigns[j].id == campaigns[i].id) {
                                    flg = flg_global_campaigns[j].flg;
                                    break;
                                }
                            }
                            if (flg == 0)
                                html += `<tr class="hover:bg-gray-50 cursor-pointer">` +
                                    `<td class="px-3 py-3 text-left text-sm font-medium text-gray-500 display_campaign" id="campaign_title_` + i + `">` +
                                    (campaigns[i].title ?? '-') +
                                    `</td>
                                    <td class="px-3 py-3 text-left text-sm font-medium text-gray-500 display_campaign" id="campaign_category_${i}">
                                        ${campaigns[i].category}
                                    </td>
                                    <td class="text-center">
                                        <span id="addToCampaign_` + i + `" name="addToCampaign[]" class="addToCampaign px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-700 active:bg-blue-700 transition duration-150 ease-in-out mt-1"><i class="icon ion-md-add"></i></span>
                                    </td>
                                </tr>`;
                            else
                                html += `<tr class="hover:bg-gray-50 cursor-pointer">` +
                                    `<td class="px-3 py-3 text-left text-sm font-medium text-gray-500 display_campaign" id="campaign_row_` + i + `">` +
                                    (campaigns[i].title ?? '-') +
                                    `</td>
                                    <td class="px-3 py-3 text-left text-sm font-medium text-gray-500 display_campaign" id="campaign_category_${i}">
                                        ${campaigns[i].category}
                                    </td>
                                    <td class="text-center">
                                    <span id="removeFromCampaign_`+ i + `" class="removeFromCampaign px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline-red focus:border-red-700 active:bg-red-700 transition duration-150 ease-in-out mt-1"><i class="icon ion-md-remove"></i></span>
                                    </td>
                                </tr>`;
                        }
                    }
                    $("#campaigns_list").html(html);
                }
            });
        }
    });

    $('body').on('click', '.display_campaign', function () {
        let id = $(this).attr('id')
        let index = id.split('_')[2]
        displayCampaign(index)

    })

    $('body').on('click', '.display_saved_campaign', function () {
        let id = $(this).attr('id')
        let index = id.split('_')[3]
        displaySavedCampaign(index)

    })

    $('body').on('change', '#kick_off_date', function () {
        console.log($('#kick_off_date').val())
    })

    $('body').on('click', '.addToCampaign', function () {
        let id = $(this).attr('id')
        let index = id.split('_')[1]
        $('#order_num_required').hide();
        $('#apt_date_required').hide();
        $('#kick_off_date_required').hide();
        $('#order_type_required').hide();
        $('#apt_time_required').hide();

        $('#order_num').val('');
        $('#apt_date').val('');
        $('#apt_time').val('');
        var today = new Date();
        var date_month = (today.getMonth() + 1) >= 10 ? today.getMonth + 1 : '0' + (today.getMonth() + 1)
        var date_day = today.getDate() >= 10 ? today.getDate() : '0' + today.getDate()
        var date = today.getFullYear() + '-' + date_month + '-' + date_day;
        $('#kick_off_date').val(date);
        $('#order_type').val(null).trigger('change');

        $('#campaign_idx').val(index);
        $('#add_btn_id').val($(this).attr('id'));

        var flg = 0;
        for (var i = 0; i < campaigns.length; i++) {
            for (var j = 0; j < flg_global_campaigns.length; j++) {
                if (flg_global_campaigns[j].id == campaigns[i].id && campaigns[i].category == "appointment" && flg_global_campaigns[j].flg == 1) {
                    console.log(flg_global_campaigns[j], campaigns[i])
                    flg = 1;
                    break;
                }
            }
        }
        if (campaigns[index].category == "advice") {
            $('#order_num').prop('disabled', true);
            $('#apt_date').prop('disabled', true);
            $('#apt_time').prop('disabled', true);
            $('#order_type').prop('disabled', true);
            openModal('keydate-modal');
        }
        else {
            $('#order_num').prop('disabled', false);
            $('#apt_date').prop('disabled', false);
            $('#apt_time').prop('disabled', false);
            $('#order_type').prop('disabled', false);
            if (flg)
                Swal.fire({
                    type: 'warning',
                    title: 'Oops...',
                    text: `You've already picked up the appointment campaign`,
                });
            else
                openModal('keydate-modal')
        }
        // addKeyDateDiv(index)
    })

    $('body').on('click', '.add_keydate_btn', function () {
        var html = "";
        var index = $('#campaign_idx').val();
        var order_num = $('#order_num').val();
        var apt_date = $('#apt_date').val();
        var apt_time = $('#apt_time').val();
        var kick_off_date = $('#kick_off_date').val();
        var order_type = $('#order_type').val();
        var order_type_str = "";
        if ($('#order_num').prop('disabled') == true) {
            if (kick_off_date != "") {
                for (var i = 0; i < order_type.length; i++) {
                    order_type_str += order_type[i];
                    if (i < (order_type.length - 1))
                        order_type_str += ',';
                }
                console.log(order_type_str);
                html = `<div id="keyDateDiv_${campaigns[index].id}">` +
                    `<input type="hidden" name="campaign_ids[]" id="campaign_ids_${campaigns[index].id}" value="${campaigns[index].id}" >` +
                    `<input type="hidden" name="order_nums[]" id="order_nums_${campaigns[index].id}" value="${order_num}" >` +
                    `<input type="hidden" name="apt_dates[]" id="apt_dates_${campaigns[index].id}" value="${apt_date}" >` +
                    `<input type="hidden" name="apt_times[]" id="apt_times_${campaigns[index].id}" value="${apt_time}" >` +
                    `<input type="hidden" name="kick_off_dates[]" id="kick_off_dates_${campaigns[index].id}" value="${kick_off_date}" >` +
                    `<input type="hidden" name="order_types[]" id="order_types_${campaigns[index].id}" value="${order_type_str}" >` +
                    `</div>`
                    ;
                $('#kyedate_form').append(html);
                modalClose('keydate-modal');
                let change_html = `<span id="removeFromCampaign_` + index + `" class="removeFromCampaign px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline-red focus:border-red-700 active:bg-red-700 transition duration-150 ease-in-out mt-1"><i class="icon ion-md-remove"></i></span>`
                var add_btn_id = $('#add_btn_id').val();
                $(`#${add_btn_id}`).replaceWith(change_html);
                for (i = 0; i < flg_global_campaigns.length; i++) {
                    if (flg_global_campaigns[i].id == campaigns[index].id) {
                        flg_global_campaigns[i].flg = 1;
                        break;
                    }
                }
            }
            else {
                $('#kick_off_date_required').show();
            }
        }
        else {
            if (order_num != "" && apt_date != "" && kick_off_date != "" && order_type.length != 0) {
                for (var i = 0; i < order_type.length; i++) {
                    order_type_str += order_type[i];
                    if (i < (order_type.length - 1))
                        order_type_str += ',';
                }
                console.log(order_type_str);
                html = `<div id="keyDateDiv_${campaigns[index].id}">` +
                    `<input type="hidden" name="campaign_ids[]" id="campaign_ids_${campaigns[index].id}" value="${campaigns[index].id}" >` +
                    `<input type="hidden" name="order_nums[]" id="order_nums_${campaigns[index].id}" value="${order_num}" >` +
                    `<input type="hidden" name="apt_dates[]" id="apt_dates_${campaigns[index].id}" value="${apt_date}" >` +
                    `<input type="hidden" name="apt_times[]" id="apt_times_${campaigns[index].id}" value="${apt_time}" >` +
                    `<input type="hidden" name="kick_off_dates[]" id="kick_off_dates_${campaigns[index].id}" value="${kick_off_date}" >` +
                    `<input type="hidden" name="order_types[]" id="order_types_${campaigns[index].id}" value="${order_type_str}" >` +
                    `</div>`
                    ;
                $('#kyedate_form').append(html);
                modalClose('keydate-modal');
                let change_html = `<span id="removeFromCampaign_` + index + `" class="removeFromCampaign px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline-red focus:border-red-700 active:bg-red-700 transition duration-150 ease-in-out mt-1"><i class="icon ion-md-remove"></i></span>`
                var add_btn_id = $('#add_btn_id').val();
                $(`#${add_btn_id}`).replaceWith(change_html);
                for (i = 0; i < flg_global_campaigns.length; i++) {
                    if (flg_global_campaigns[i].id == campaigns[index].id) {
                        flg_global_campaigns[i].flg = 1;
                        break;
                    }
                }
            }
            else {
                if (order_num == "") {
                    $('#order_num_required').show()
                }
                if (apt_date == "") {
                    $('#apt_date_required').show()
                }
                if (kick_off_date == "") {
                    $('#kick_off_date_required').show()
                }
                if (order_type.length == 0) {
                    $('#order_type_required').show()
                }

            }
        }

    })

    $('body').on('click', '.editable-apt-date', function () {
        var keydate_id = $(this).attr('id').split('_')[3];
        $('#editable_keydate_id').val(keydate_id);
        openModal('editable-apt-date-modal')
    })

    $('body').on('click', '.editable-apt-time', function () {
        var keydate_id = $(this).attr('id').split('_')[3];
        $('#editable_keytime_id').val(keydate_id);
        openModal('editable-apt-time-modal')
    })

    $('body').on('click', '.edit-apt-date-btn', function () {
        var keydate_id = $('#editable_keydate_id').val();
        var editable_apt_date = $('#editable_apt_date').val();
        $.ajax({
            type: 'POST',
            url: base_url + '/patients/editKeydateAptDate',
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
                keydate_id: keydate_id,
                editable_apt_date: editable_apt_date,
            },
            success: function (response) {
                modalClose('editable-apt-date-modal');
                keydates = response.keydates;
                displayKeydates();
            }
        });
    })

    $('body').on('click', '.edit-apt-time-btn', function () {
        var keydate_id = $('#editable_keytime_id').val();
        var editable_apt_time = $('#editable_apt_time').val();
        $.ajax({
            type: 'POST',
            url: base_url + '/patients/editKeydateAptTime',
            dataType: 'json',
            data: {
                _token: $("[name='_token']").val(),
                keydate_id: keydate_id,
                editable_apt_time: editable_apt_time,
            },
            success: function (response) {
                modalClose('editable-apt-time-modal');
                keydates = response.keydates;
                displayKeydates();
            }
        });
    })

    $('body').on('click', '.removeFromCampaign', function () {
        var button = $(this);
        let id = $(this).attr('id')
        var index = id.split('_')[1]
        var change_html = `<span id="addToCampaign_` + index + `" class="addToCampaign px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-700 active:bg-blue-700 transition duration-150 ease-in-out mt-1"><i class="icon ion-md-add"></i></span>`
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, remove it!",
            cancelButtonText: "No, cancel plz!",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(result => {
            if (result.value) {
                $(`#keyDateDiv_${campaigns[index].id}`).remove()
                button.replaceWith(change_html)
                for (var i = 0; i < flg_global_campaigns.length; i++) {
                    if (flg_global_campaigns[i].id == campaigns[index].id) {
                        flg_global_campaigns[i].flg = 0;
                        break;
                    }
                }
            }
        });
    });
});

function displayKeydates() {
    var k = 0;
    var l = 0;
    var all_html = "";
    var idx;
    var i, j;
    var flg = 0;
    console.log(keydates, saved_campaigns);
    for (k = 0; k < condition_list.length; k++) {
        for (l = 0; l < subcondition_list.length; l++) {
            var html = `<div class="m-5">
                            <div class="mx-auto container bg-white shadow rounded">
                                <div class="flex w-full pl-3 sm:pl-6 pr-3 py-5 items-center justify-between bg-white rounded-t">
                                    <h3 class="text-gray-800 font-medium text-base sm:text-xl">${condition_list[k].name}-${subcondition_list[l].name}</h3>
                                </div>
                                <div class="w-full overflow-x-scroll xl:overflow-x-hidden">
                                    <table class="min-w-full bg-white rounded border border-gray-300" id="main-table">
                                        <thead>
                                            <tr class="w-full bg-gray-100 ">
                                                <th class="border-b border-gray-300 pl-3 w-24 py-3">
                                                    <div class="flex items-center">
                                                        <div class="opacity-0 cursor-defaut ml-4 text-gray-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-up" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" />
                                                                <polyline points="6 15 12 9 18 15" />
                                                            </svg>
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative chuss-div">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Appointment No.</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Test Order No.</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Apppointment Date</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Time</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Test</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Result</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Lab Ref</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Result Date</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-1">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 whitespace-no-wrap w-32">
                                                    <div class="flex items-center justify-between relative">
                                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Next Appointment Due</p>
                                                    </div>
                                                </th>
                                                <th class="border-b border-gray-300 pl-4 pr-12 whitespace-no-wrap w-32">
                                                    <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">Actions</p>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                   `;
            var cnt = 0;
            for (idx = 0; idx < keydates.length; idx++) {
                flg = 0;
                for (i = 0; i < show_keydate_campaigns.length; i++) {
                    if (show_keydate_campaigns[i].id == keydates[idx].apt_campaign_id && show_keydate_campaigns[i].category == "appointment" && keydates[idx].condition_id == condition_list[k].id && keydates[idx].subcondition_id == subcondition_list[l].id) {
                        flg = 1;
                        cnt++;
                        break;
                    }
                }
            }
            var big_flg = 0;
            for (idx = keydates.length - 1; idx >= 0; idx--) {
                flg = 0;
                for (i = 0; i < show_keydate_campaigns.length; i++) {
                    if (show_keydate_campaigns[i].id == keydates[idx].apt_campaign_id && show_keydate_campaigns[i].category == "appointment" && keydates[idx].condition_id == condition_list[k].id && keydates[idx].subcondition_id == subcondition_list[l].id) {
                        flg = 1;
                        big_flg = 1;
                        break;
                    }
                }
                if (flg == 1) {

                    var test_types_array = keydates[idx].test_types.split(',');
                    test_results = [];
                    lab_refs = [];
                    if (keydates[idx].results)
                        test_results = keydates[idx].results.split(',');
                    for (i = 0; i < test_types_array.length; i++) {
                        var test_type;

                        for (j = 0; j < test_types.length; j++) {
                            if (test_types_array[i] == test_types[j].id) {
                                test_type = test_types[j].test_name;
                                break;
                            }
                        }
                        if (i == 0) {
                            var apt_time = ""
                            if (keydates[idx].apt_time)
                                apt_time = keydates[idx].apt_time.split(':')[0] + ':' + keydates[idx].apt_time.split(':')[1];
                            html += `<tr class="border-t border-gray-300">
                                <td class="pl-3 w-24 py-3">
                                    <div class="flex items-center">
                                        <a onclick="accordionHandler(this)" class="focus:outline-none cursor-pointer text-gray-800 ml-2 lg:ml-4 mr-2 sm:mr-0 border border-transparent rounded focus:outline-none" href="javascript: void(0)">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down" width="16" height="16" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z"></path>
                                                <polyline points="6 9 12 15 18 9"></polyline>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                                <td class="whitespace-no-wrap w-32">

                                    <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${cnt}</p>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${keydates[idx].test_order}</p>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <span class="text-xs text-blue-500 font-normal cursor-pointer editable-apt-date" id="editable_apt_date_${keydates[idx].id}">${keydates[idx].apt_date.split('T')[0]}</span>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <span class="text-xs text-blue-500 font-normal cursor-pointer editable-apt-time" id="editable_apt_time_${keydates[idx].id}">${apt_time}</span>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${test_type}</p>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${test_results[i] ? test_results[i] : ''}</p>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${keydates[idx].lab_ref ? keydates[idx].lab_ref : ''}</p>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${keydates[idx].result_date ? keydates[idx].result_date : ''}</p>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-1">

                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>

                                </td>
                                <td class="pl-4 whitespace-no-wrap w-32">

                                        <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${keydates[idx].lab_ref ? keydates[idx].next_apt_due : ''}</p>

                                </td>`
                            html += `<td class="pl-4 pr-4 whitespace-no-wrap w-32 text-gray-500">
                                        <div class="flex items-center">
                                            <div class="mr-3 result-btn cursor-pointer" id="result_btn_${idx}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tag" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z"></path>
                                                    <path d="M11 3L20 12a1.5 1.5 0 0 1 0 2L14 20a1.5 1.5 0 0 1 -2 0L3 11v-4a4 4 0 0 1 4 -4h4"></path>
                                                    <circle cx="9" cy="9" r="2"></circle>
                                                </svg>
                                            </div>`;
                            html += `<div class="mr-3 cursor-pointer next-apt-btn" id="apt_btn_${idx}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z"></path>
                                            <rect x="4" y="5" width="16" height="16" rx="2"></rect>
                                            <line x1="16" y1="3" x2="16" y2="7"></line>
                                            <line x1="8" y1="3" x2="8" y2="7"></line>
                                            <line x1="4" y1="11" x2="20" y2="11"></line>
                                            <rect x="8" y="15" width="2" height="2"></rect>
                                        </svg>
                                    </div>`
                            html += `</div></td>`
                            html += "</tr>";
                        }
                        else {
                            html += `<tr class="detail-row">
                                        <td class="pl-3 w-24 h-10 py-3">
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${test_type}</p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4">${test_results[i] ? test_results[i] : ''}</p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                        <td>
                                            <p class="pl-4 text-gray-800 font-normal text-left text-xs tracking-normal leading-4"></p>
                                        </td>
                                    </tr>`
                        }
                    }
                    cnt--;
                }

            }

            html += `               </tbody>
                                </table>
                            </div>
                        </div>
                    </div>`;
            if (big_flg == 1) {
                all_html += html;
            }
        }
    }
    $('.keydate-container').html(all_html);
}