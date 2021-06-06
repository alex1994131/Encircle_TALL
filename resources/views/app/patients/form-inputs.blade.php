@php $editing = isset($patient) @endphp
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('libs/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

<!-- Modal Dialog -->

<div class="main-modal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated faster"
    style="display:none; background: rgba(0,0,0,.7);">
    <div
        class="border border-blue-500 shadow-lg modal-container bg-white w-4/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Edit Keydate Data</p>
                <div class="modal-close cursor-pointer z-50" onclick="modalClose('main-modal')">
                    <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <div class="">
                    <input type="hidden" id="campaign_id" name="campaign_id">
                    <div class="">
                        <label for="names" class="text-md text-gray-600">Order Number</label>
                    </div>
                    <div class="">
                        <input type="text" required id="archive_order_num" name="archive_order_num" autocomplete="off"
                            class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md"
                            placeholder="Ex: RJE00/NNNNNNNN">
                    </div>
                    <div class="">
                        <label for="phone" class="text-md text-gray-600">Date</label>
                    </div>
                    <div class="">
                        <input type="date" required id="archive_date" name="archive_date"
                            class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" maxlength="255">
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 space-x-14">
                <span class="px-4 bg-gray-200 p-3 rounded text-black hover:bg-gray-300 font-semibold"
                    onclick="modalClose('main-modal')">Cancel</span>
                <span
                    class="px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400 duplicate_btn">Duplicate</span>
            </div>
        </div>
    </div>
</div>

<!-- End Modal Dialog -->

<!-- Editable Apt Date Modal -->
<div class="editable-apt-date-modal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated faster"
    style="display:none; background: rgba(0,0,0,.7);">
    <div
        class="border border-blue-500 shadow-lg modal-container bg-white w-3/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Edit Appoitment Date</p>
                <div class="modal-close cursor-pointer z-50" onclick="modalClose('editable-apt-date-modal')">
                    <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <div class="">
                    <input type="hidden" id="editable_keydate_id" name="editable_keydate_id">
                    <div class="">
                        <label for="phone" class="text-md text-gray-600">Appointment Date</label>
                    </div>
                    <div class="">
                        <input type="date" required id="editable_apt_date" name="editable_apt_date"
                            class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" maxlength="255">
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 space-x-14">
                <span class="px-4 bg-gray-200 p-3 rounded text-black hover:bg-gray-300 font-semibold"
                    onclick="modalClose('editable-apt-date-modal')">Cancel</span>
                <span
                    class="px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400 edit-apt-date-btn">OK</span>
            </div>
        </div>
    </div>
</div>
<!-- End Editable Apt Date Modal -->

<!-- Editable Apt Time Modal -->
<div class="editable-apt-time-modal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated faster"
    style="display:none; background: rgba(0,0,0,.7);">
    <div
        class="border border-blue-500 shadow-lg modal-container bg-white w-3/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Edit Appoitment Time</p>
                <div class="modal-close cursor-pointer z-50" onclick="modalClose('editable-apt-time-modal')">
                    <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="my-5 mr-5 ml-5 flex justify-center">
                <div class="">
                    <input type="hidden" id="editable_keytime_id" name="editable_keytime_id">
                    <div class="">
                        <label for="phone" class="text-md text-gray-600">Appointment Time</label>
                    </div>
                    <div class="">
                        <input type="time" required id="editable_apt_time" name="editable_apt_time"
                            class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" maxlength="255">
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 space-x-14">
                <span class="px-4 bg-gray-200 p-3 rounded text-black hover:bg-gray-300 font-semibold"
                    onclick="modalClose('editable-apt-time-modal')">Cancel</span>
                <span
                    class="px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400 edit-apt-time-btn">OK</span>
            </div>
        </div>
    </div>
</div>
<!-- End Editable Apt Date Modal -->

<!-- Appointment KeyDate Modal Dialog -->

<div class="keydate-modal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated faster"
    style="display:none; background: rgba(0,0,0,.7);">
    <div
        class="border border-blue-500 shadow-lg modal-container bg-white w-4/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Edit Keydate Data</p>
                <div class="modal-close cursor-pointer z-50" onclick="modalClose('keydate-modal')">
                    <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="mr-5 ml-5 flex justify-center">
                <div class="">
                    <div class="bg-white space-y-4 sm:p-4 ">
                        <div class="mt-1 bg-white rounded-md shadow-sm">
                            <div class="grid grid-cols-2 mt-4 pb-6">
                                <div class="px-2 mt-1 mb-1">
                                    <input type="hidden" id="campaign_idx" name="campaign_idx">
                                    <input type="hidden" id="add_btn_id" name="add_btn_id">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Order Number</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="text" id="order_num" name="order_num" multiple="multiple" required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="order_num_required">This field is required
                                        </p>
                                    </div>
                                </div>
                                <div class="px-2 mt-1 mb-1">
                                    <div class=" flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Kick-off Date</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="date" id="kick_off_date" name="kick_off_date" required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="kick_off_date_required">This field is
                                            required</p>
                                    </div>
                                </div>
                                <div class="px-2 mt-1 mb-1">
                                    <div class=" flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Appointment Date</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="date" id="apt_date" name="apt_date" required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="apt_date_required">This field is required
                                        </p>
                                    </div>
                                </div>
                                <div class="px-2 mt-1 mb-1">
                                    <div class=" flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Appointment Time</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="time" id="apt_time" name="apt_time" required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="apt_time_required">This field is required
                                        </p>
                                    </div>
                                </div>
                                <div class="px-2 col-span-2 mt-1 mb-1">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Order Type</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <select id="order_type" required name="order_type"
                                            class="select2 custom-select block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255" multiple="true">
                                            @foreach($testTypes as $testType)
                                            <option value="{{$testType->id}}">{{$testType->test_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-red-500" id="order_type_required">This field is required
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 space-x-14">
                <span class="px-4 bg-gray-200 p-3 rounded text-black hover:bg-gray-300 font-semibold cursor-pointer"
                    onclick="modalClose('keydate-modal')">Cancel</span>
                <span
                    class="px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400 add_keydate_btn cursor-pointer">Apply</span>
            </div>
        </div>
    </div>
</div>

<!-- End Appointment KeyDate Modal Dialog -->

<!-- Result KeyDate Modal Dialog -->

<div class="keydate-result-modal overflow-auto fixed w-full inset-0 z-50 overflow-scroll flex justify-center items-center animated faster"
    style="display:none; background: rgba(0,0,0,.7);">
    <div style="height:700px;"
        class="overflow-scroll border border-blue-500 shadow-lg modal-container bg-white w-4/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Edit Result Data</p>
                <div class="modal-close cursor-pointer z-50" onclick="modalClose('keydate-result-modal')">
                    <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="mr-5 ml-5 flex justify-center">
                <div class="">
                    <div class="bg-white space-y-4 sm:p-4 ">
                        <p class="text-left text-lg font-medium ">Result Data</p>
                        <input type="hidden" id="keydate_id">
                        <div class="mt-1 bg-white rounded-md shadow-sm">
                            <div class="grid grid-cols-2 mt-4 pb-6">
                                <div class="px-2 mt-1 mb-1">
                                    <input type="hidden" id="campaign_idx" name="campaign_idx">
                                    <input type="hidden" id="add_btn_id" name="add_btn_id">
                                    <div class=" flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Result Date</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="date" id="result_date" name="result_date" required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="result_date_required">This field is required
                                        </p>
                                    </div>
                                </div>
                                <div class="px-2 mt-1 mb-1">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Lab Reference</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="text" id="lab_ref" name="lab_ref" multiple="multiple" required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="lab_ref_required">This field is required</p>
                                    </div>
                                </div>
                                <div class="px-2 mt-3 mb-1 col-span-2">
                                    <div class=" flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Results</p>
                                    </div>
                                    <div class="flex-1 min-w-0 result-div mt-2">

                                    </div>
                                </div>
                                <div class="px-2 col-span-2 mt-3 mb-1">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Result Type</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <select id="result_types" name="result_types"
                                            class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                            <option value="normal">Normal</option>
                                            <option value="abnormal">Abnormal</option>
                                            <option value="no_results">No Result</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="px-2 col-span-2 mt-3 mb-1">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Result Campaign</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <select id="result_campaign" name="result_campaign"
                                            class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">

                                        </select>
                                        <p class="text-xs text-red-500" id="result_campaign_required">This field is
                                            required</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-left text-lg font-medium">Campaign Preview</p>
                        <div class="display_result_campaign">
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 space-x-14">
                <span class="px-4 bg-gray-200 p-3 rounded text-black hover:bg-gray-300 font-semibold cursor-pointer"
                    onclick="modalClose('keydate-result-modal')">Cancel</span>
                <span
                    class="px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400 add_result_data cursor-pointer">OK</span>
            </div>
        </div>
    </div>
</div>

<!-- End Result KeyDate Modal Dialog -->

<!-- Next Appointment KeyDate Modal Dialog -->

<div class="next-apt-keydate-modal fixed w-full inset-0 z-50 overflow-hidden flex justify-center items-center animated faster"
    style="display:none; background: rgba(0,0,0,.7);">
    <div style="height:700px;"
        class="overflow-scroll border border-blue-500 shadow-lg modal-container bg-white w-4/12 md:max-w-11/12 mx-auto rounded-xl shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold text-gray-500">Edit Next Apppointment Keydate Data</p>
                <div class="modal-close cursor-pointer z-50" onclick="modalClose('next-apt-keydate-modal')">
                    <svg class="fill-current text-gray-500" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 18 18">
                        <path
                            d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                        </path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <div class="mr-5 ml-5 flex justify-center">
                <div class="">
                    <div class="bg-white space-y-4 sm:p-4 ">
                        <p class="text-left text-lg font-medium ">Next Appointment Data</p>
                        <div class="mt-1 bg-white rounded-md shadow-sm">
                            <div class="grid grid-cols-2 mt-4 pb-6">
                                <div class="px-2 col-span-2 mt-3 mb-1">
                                    <input type="hidden" id="campaign_idx" name="campaign_idx">
                                    <input type="hidden" id="add_btn_id" name="add_btn_id">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Next Appointment Order
                                            Number</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="text" id="next_order_num" name="next_order_num" multiple="multiple"
                                            required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="next_order_num_required">This field is
                                            required</p>
                                    </div>
                                </div>
                                <div class="px-2 mt-3 mb-1">
                                    <div class=" flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Next Appointment Due</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <select id="next_apt_due" name="next_apt_due"
                                            class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">
                                            <option value="1Week">1 Week</option>
                                            <option value="2Weeks">2 Weeks</option>
                                            <option value="1Month">1 Month</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="px-2 mt-3 mb-1">
                                    <div class=" flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Kick-off Date</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <input type="date" id="next_kick_off_date" name="next_kick_off_date" required
                                            class="block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255">
                                        <p class="text-xs text-red-500" id="next_kick_off_date_required">This field is
                                            required</p>
                                    </div>
                                </div>
                                <div class="px-2 col-span-2 mt-3 mb-1">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Order Type</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <select id="next_order_type" required name="next_order_type"
                                            class="select2 custom-select block appearance-none w-full py-1 px-1 text-base leading-normal bg-gray-50 text-gray-800 border border-gray-200 rounded focus:ring-indigo-500 focus:border-indigo-500 relative block w-full rounded-md rounded-br-md bg-transparent focus:z-10 sm:text-sm border-gray-300"
                                            maxlength="255" multiple="true">
                                            @foreach($testTypes as $testType)
                                            <option value="{{$testType->id}}">{{$testType->test_name}}</option>
                                            @endforeach
                                        </select>
                                        <p class="text-xs text-red-500" id="next_order_type_required">This field is
                                            required</p>
                                    </div>
                                </div>
                                <div class="px-2 col-span-2 mt-3 mb-1">
                                    <div class="w-1/2 flex-1 min-w-0">
                                        <p class="text-left text-sm font-medium text-gray-500">Appointment Campaign</p>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <select id="apt_campaign" name="apt_campaign"
                                            class="block appearance-none w-full py-1 px-2 mb-1 mt-1 text-sm font-medium text-gray-700 leading-normal bg-gray-50 border-gray-200 rounded">

                                        </select>
                                        <p class="text-xs text-red-500" id="apt_campaign_required">This field is
                                            required</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-left text-lg font-medium">Campaign Preview</p>
                        <div class="display_apt_campaign">
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2 space-x-14">
                <span class="px-4 bg-gray-200 p-3 rounded text-black hover:bg-gray-300 font-semibold cursor-pointer"
                    onclick="modalClose('next-apt-keydate-modal')">Cancel</span>
                <span
                    class="px-4 bg-blue-500 p-3 ml-3 rounded-lg text-white hover:bg-teal-400 add_next_apt_btn cursor-pointer">OK</span>
            </div>
        </div>
    </div>
</div>

<!-- End Next Appointment KeyDate Modal Dialog -->

<div class="grid grid-cols-12 mt-6 divide-x-2 divide-gray-300">
    <div class="col-span-8">
        <div>
            <p class="text-lg md:text-lg px-4">General Information</p>
            <div class="grid grid-cols-3">
                <x-inputs.group
                    class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                    <x-inputs.text name="name" label="Name" value="{{ old('name', ($editing ? $patient->name : '')) }}"
                        maxlength="255" required></x-inputs.text>
                </x-inputs.group>

                <x-inputs.group
                    class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                    <x-inputs.date name="dob" label="Date of Birth"
                        value="{{ old('dob', ($editing ? optional($patient->dob)->format('Y-m-d') : '')) }}" max="255"
                        required></x-inputs.date>
                </x-inputs.group>

                <x-inputs.group
                    class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                    <x-inputs.text name="nhsnum" label="NHS Number"
                        value="{{ old('nhsnum', ($editing ? $patient->nhsnum : '')) }}" maxlength="255" required>
                    </x-inputs.text>
                </x-inputs.group>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <x-inputs.group
                    class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                    <x-inputs.text name="phone" label="Phone"
                        value="{{ old('phone', ($editing ? $patient->phone : '')) }}" maxlength="255"></x-inputs.text>
                </x-inputs.group>

                <x-inputs.group
                    class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                    <x-inputs.email name="email" label="Email"
                        value="{{ old('email', ($editing ? $patient->email : '')) }}" maxlength="255" required>
                    </x-inputs.email>
                </x-inputs.group>
            </div>

            <x-inputs.group
                class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300 mb-4">
                <x-inputs.textarea name="notes" label="Notes" maxlength="255">{{ old('notes', ($editing ? $patient->notes : ''))
                }}</x-inputs.textarea>
            </x-inputs.group>
        </div>
        <hr class="h-1 bg-gray-300">
        @if($editing)
        <div class="grid grid-cols-3 mt-6">
            <p class="text-lg md:text-lg px-4 col-span-3 mb-4">
                Keydate Management
            </p>

            <div class="keydate-container col-span-3">

            </div>

        </div>
        <hr class="h-1 bg-gray-300 mt-5">
        @endif

        <!-- Div for add campaigns or view active or archived campaigns -->
        <p class="text-lg md:text-lg px-4 mt-6">
            {{!$editing ? '' : ($isActive ? 'Active Patient Campaigns' : 'Archive Patient Campaigns')}}
        </p>
        <div class="mt-3">
            @if($editing)
            @if(isset($savedCampaigns))
            <div
                class="block overflow-auto scrolling-touch shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mx-4">
                <a href="{{$isActive ? route('patients.edit_archive', $patient) : route('patients.edit', $patient) }}">
                    @if(!$isActive)
                    <span id="convert_archive"
                        class="flex mr-2 cursor-pointer float-right border-none rounded-md text-white bg-green-600 hover:bg-green-500 focus:border-green-700 focus:outline-none focus:shadow-outline-green active:bg-green-700 transition duration-150 ease-in-out mt-3 mb-3 text-xs font-semibold">
                        @else
                        <span id="convert_archive"
                            class="flex mr-2 cursor-pointer float-right border-none rounded-md text-white bg-red-600 hover:bg-red-500 focus:border-red-700 focus:outline-none focus:shadow-outline-red active:bg-red-700 transition duration-150 ease-in-out mt-3 mb-3 text-xs font-semibold">
                            @endif
                            <i
                                class="icon {{$isActive ? 'ion-ios-archive' : 'ion-ios-school'}} align-middle my-auto pl-1.5 text-xs"></i>
                            &nbsp;&nbsp;&nbsp;
                            <p class="my-auto">{{$isActive ? 'Archive' : 'Active'}}</p>
                            <i
                                class="icon {{$isActive ? 'ion-ios-return-right' : 'ion-ios-return-left'}} align-middle pl-1.5 text-lg"></i>
                            &nbsp;&nbsp;
                        </span>

                </a>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-3 text-center text-sm text-gray-900">
                                @lang('crud.campaigns.inputs.title')
                            </th>
                            <th class="px-3 py-3 text-center text-sm text-gray-900">
                                Category
                            </th>
                            <th class="px-3 py-3 text-center text-sm text-gray-900">
                                Condition
                            </th>
                            <th class="px-3 py-3 text-center text-sm text-gray-900">
                                Subcondition
                            </th>
                            <th class="text-center text-sm text-gray-900">
                                @lang('crud.patients.tbl_action')
                            </th>
                        </tr>
                    </thead>
                    <tbody id="saved_campaigns_list" class="active_table">
                        @forelse($savedCampaigns as $campaign)
                        <tr class="hover:bg-gray-50" id="active_column_{{$campaign->id}}">
                            <td class="px-3 py-3 text-left text-sm font-medium text-gray-500 display_saved_campaign cursor-pointer"
                                id="saved_campaign_title_{{$loop->index}}">
                                {{ $campaign->title ?? '-' }}
                            </td>
                            <td class="px-3 py-3 text-center text-sm font-medium text-gray-500 display_saved_campaign cursor-pointer"
                                id="saved_campaign_category_{{$loop->index}}">
                                {{ $campaign->category}}
                            </td>
                            <td class="px-3 py-3 text-center text-sm font-medium text-gray-500 display_saved_campaign cursor-pointer"
                                id="saved_campaign_condition_{{$loop->index}}">
                                {{ $campaign->getCondition->name}}
                            </td>
                            <td class="px-3 py-3 text-center text-sm font-medium text-gray-500 display_saved_campaign cursor-pointer"
                                id="saved_campaign_subcondition_{{$loop->index}}">
                                {{ $campaign->getSubCondition->name}}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                                    @if($isActive)
                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
                                        <a href="{{ route('patients.campaign.edit', ['campaign' => $campaign, 'patient' => $patient]) }}"
                                            class="mr-1" x-on:mouseover="tooltip = true"
                                            x-on:mouseleave="tooltip = false">
                                            <button type="button" class="button">
                                                <i class="icon ion-md-create"></i>
                                            </button>
                                        </a>
                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                            <div
                                                class="absolute top-0 z-10 p-1 -ml-3 text-sm leading-tight text-black transform  -translate-y-full bg-gray-50	bg-opacity-50 rounded-lg shadow-lg">
                                                Edit
                                            </div>
                                        </div>
                                    </div>
                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
                                        <button type="button" class="button to_archive" id="to_archive_{{$loop->index}}"
                                            x-on:mouseover="tooltip = true" x-on:mouseleave="tooltip = false">
                                            <i class="icon ion-ios-archive"></i>
                                        </button>
                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                            <div
                                                class="absolute top-0 z-10 p-1 -ml-2 text-sm leading-tight text-black transform  -translate-y-full bg-gray-50	bg-opacity-50 rounded-lg shadow-lg">
                                                To Archive
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div x-data="{ tooltip: false }" class="relative z-30 inline-flex">
                                        <button type="button" class="button keydate_modal"
                                            id="keydate_modal_{{$campaign->id}}" x-on:mouseover="tooltip = true"
                                            x-on:mouseleave="tooltip = false">
                                            <i class="icon ion-ios-refresh text-lg"></i>
                                        </button>
                                        <div class="relative" x-cloak x-show.transition.origin.top="tooltip">
                                            <div
                                                class="absolute top-0 z-10 p-1 -ml-2 text-sm leading-tight text-black transform  -translate-y-full bg-gray-50	bg-opacity-50 rounded-lg shadow-lg">
                                                Repeat/Restart
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="text-center font-medium text-gray-500">
                            <td>@lang('crud.common.no_items_found')</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <hr class="h-1 bg-gray-300 mt-5">
            @endif
            @endif
        </div>

        <div class="grid grid-cols-3 mt-6">
            <p class="text-lg md:text-lg px-4 mb-3 col-span-3">
                Add New Campaigns
            </p>
            <x-inputs.group
                class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                <x-inputs.select name="condition_filter" id="condition_filter" label="Condition">
                    <option value="">Select Condition</option>
                    @forelse ($conditions as $condition)
                    <option value="{{ $condition->id }}">{{ $condition->name }}</option>
                    @empty
                    <option value="there is no data"></option>
                    @endforelse
                </x-inputs.select>
            </x-inputs.group>
            <x-inputs.group
                class="focus:ring-indigo-500 focus:border-indigo-500 w-full rounded-none rounded-r-md sm:text-sm border-gray-300">
                <x-inputs.select name="subCondition_filter" id="subCondition_filter" label="Sub Condition">
                    <option value="">Select Sub Condition</option>
                </x-inputs.select>
            </x-inputs.group>
            <span id="search_campaigns"
                class="cursor-pointer w-8 h-8 border-none rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:shadow-outline-green focus:border-green-700 active:bg-green-700 transition duration-150 ease-in-out mt-7">
                <i class="icon ion-md-search align-middle pl-2.5"></i>
            </span>
        </div>
        <div
            class="block overflow-auto scrolling-touch shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mx-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 py-3 text-center text-sm text-gray-900">
                            @lang('crud.campaigns.inputs.title')
                        </th>
                        <th class="px-3 py-3 text-center text-sm text-gray-900">
                            Category
                        </th>
                        <th class="text-center text-sm text-gray-900">
                            @lang('crud.patients.tbl_action')
                        </th>
                    </tr>
                </thead>
                <tbody id="campaigns_list">
                </tbody>
            </table>
        </div>
        <div id="kyedate_form">
        </div>
        @if(!$editing)
        <button type="submit" class="button btn-create button-primary float-right mt-10 mr-4">
            <i class="mr-1 icon ion-md-save"></i>
            @lang('crud.common.create')
        </button>
        @else
        <button type="submit" class="button btn-update button-primary float-right mt-10 mr-4">
            <i class="mr-1 icon ion-md-save"></i>
            @lang('crud.common.update')
        </button>
        @endif
    </div>
    <!-- Div for the campaign preview -->
    <div class="col-span-4">
        <p class="text-lg md:text-lg px-6">Campaign Display</p>
        <div class="px-4 mt-6" id="campaign_display">
        </div>
    </div>
</div>