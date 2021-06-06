<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Condition;
use App\Models\SubCondition;
use App\Models\Campaign;
use App\Models\PatientCampaign;
use App\Models\Library;
use App\Models\PatientMessage;
use App\Models\TestType;
use App\Models\Keydate;
use App\Models\Trust;
use Illuminate\Http\Request;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Http\Requests\CampaignUpdateRequest;
use Auth;
class PatientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Patient::class);

        $search = $request->get('search', '');

        if(Auth::user()->isTrustAdmin())
            $patients = Patient::search($search)
                                ->where('trust_id', Auth::user()->trust_id)
                                ->latest()
                                ->paginate(20);
        else if(Auth::user()->isUser())
            $patients = Patient::search($search)
                                ->where('user_id', Auth::user()->id)
                                ->latest()
                                ->paginate(20);
        else
            $patients = Patient::search($search)
                ->latest()
                ->paginate(20);

        return view('app.patients.index', compact('patients', 'search'));
    }
// 
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Patient::class);
        $conditions = Condition::all();
        $subconditions = SubCondition::all();
        if(Auth::user()->isUser() || Auth::user()->isTrustAdmin())
            $testTypes = TestType::where('trust_id', Auth::user()->trust_id)
                                ->orWhere('trust_id', null)
                                ->get();
        else
            $testTypes = TestType::all();
        $savedCampaigns = null;
        $global_campaigns = Campaign::all();
        $patient = null;
        $keydates = null;
        return view('app.patients.create', compact('conditions', 'subconditions', 'testTypes' ,'savedCampaigns', 'patient', 'global_campaigns', 'keydates'));
    }

    /**
     * @param \App\Http\Requests\PatientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {
        $this->authorize('create', Patient::class);
        $campaign = $request->campaign_ids;
        $campaign_ids = "";
        $validated = $request->validated();
        $patient = Patient::create($validated);
        if($campaign)
        {
            for($i = 0; $i < count($campaign); $i++)
            {
               $msg_ids = "";
                $ref_campaign = Campaign::find($campaign[$i]);
                $patientCampaign = PatientCampaign::create([
                    'patient_id' => $patient->id,
                    'condition' => $ref_campaign->condition_id,
                    'subcondition' => $ref_campaign->subCondition_id,
                    'trust_id' => $ref_campaign->trust_id,
                    'title' => $ref_campaign->title,
                    'content' => $ref_campaign->content,
                    'msgs' => '',
                    'campaign_id' => $campaign[$i],
                    'category' => $ref_campaign->category,
                    ]
                );
                $keydate = new Keydate;
                $keydate->patient_id = $patient->id;
                $keydate->condition_id = $ref_campaign->condition_id;
                $keydate->subcondition_id = $ref_campaign->subCondition_id;
                $keydate->apt_campaign_id = $patientCampaign->id;
                $keydate->test_order = $request->order_nums[$i];
                $keydate->apt_date = $request->apt_dates[$i];
                if($request->apt_times[$i])
                    $keydate->apt_time = $request->apt_times[$i];
                else
                    $keydate->apt_time = "08:00:00";
                $keydate->apt_kickoff_date = $request->kick_off_dates[$i];
                $keydate->test_types = $request->order_types[$i];

                $keydate->type = 'asdf';
                $keydate->save();

                $campaign_ids .= $patientCampaign->id;
                if($i < (count($campaign)-1))
                {
                    $campaign_ids.= ',';
                }

                $libraries = $ref_campaign->libraries();
                if($libraries)
                {
                    $j = 0;
                    foreach($libraries as $library)
                    {
                        $patient_library = PatientMessage::create([
                            'patient_id' => $patient->id,
                            'patient_campaign_id' => $patientCampaign->id,
                            'library_id' => $library->id,
                            'msg_title' => $library->msg_title,
                            'msg_text' => $library->msg_text,
                            'upload_video' => $library->upload_video,
                            'upload_image' => $library->upload_image,
                            'add_url' => $library->add_url,
                            'telephone' => $library->telephone,
                            'selected_date' => $library->selected_date
                        ]);
                        $msg_ids .= $patient_library->id;
                        if($j < (count($libraries) - 2))
                            $msg_ids.=',';
                    }
                    $patientCampaign->msgs = $msg_ids;
                    $patientCampaign->save();
                    $j ++;
                }               
            }
        }
        $patient->campaigns = $campaign_ids;
        $patient->user_id = Auth::user()->id;
        $patient->trust_id = Auth::user()->trust_id;
        $patient->save(); 
        return redirect()
            ->route('patients.edit', $patient)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Patient $patient, PatientCampaign $patientCampaigns)
    {
        $this->authorize('view', $patient);
        $patientCampaigns = Patient::with('patientCampaigns')->with('patientMessages')->get();

        return view('app.patients.show', compact('patient'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Patient $patient = null)
    {
        $this->authorize('update', $patient);
        $conditions = Condition::all();
        $subconditions = SubCondition::all();
        if(Auth::user()->isUser() || Auth::user()->isTrustAdmin())
            $testTypes = TestType::where('trust_id', Auth::user()->trust_id)
                                ->orWhere('trust_id', null)
                                ->get();
        else
            $testTypes = TestType::all();
        $savedCampaigns = PatientCampaign::where('patient_id', $patient->id)->where('status', 'active')->get();
        $showKeydateCampaigns = PatientCampaign::where('patient_id', $patient->id)->get();
        $global_campaigns = Campaign::all();
        $keydates = Keydate::all();
        $isActive = 1;
        return view('app.patients.edit', compact('patient', 'conditions', 'subconditions', 'testTypes', 'savedCampaigns', 'isActive', 'global_campaigns' , 'keydates', 'showKeydateCampaigns'));
    }

    public function edit_archive(Request $request, Patient $patient) { 
        $isActive = 0;
        $this->authorize('update', $patient);
        $conditions = Condition::all();
        if(Auth::user()->isUser() || Auth::user()->isTrustAdmin())
            $testTypes = TestType::where('trust_id', Auth::user()->trust_id)
                                ->orWhere('trust_id', null)
                                ->get();
        else
            $testTypes = TestType::all();
        $subconditions = SubCondition::all();
        $savedCampaigns = PatientCampaign::where('patient_id', $patient->id)->where('status', 'archive')->get();
        $showKeydateCampaigns = PatientCampaign::where('patient_id', $patient->id)->get();
        $global_campaigns = Campaign::all();
        $keydates = Keydate::all();
        return view('app.patients.edit', compact('patient', 'conditions', 'subconditions', 'testTypes', 'savedCampaigns', 'isActive', 'global_campaigns', 'keydates', 'showKeydateCampaigns'));
    }
    /**
     * @param \App\Http\Requests\PatientUpdateRequest $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        $validated = $request->validated();

        $patient->update($validated);

        $campaign = $request->campaign_ids;
        $campaign_ids = $patient->campaigns;

        if($campaign)
        {
            $campaign_ids.=",";
            for($i = 0; $i < count($campaign); $i++)
            {
                $msg_ids = "";
                $ref_campaign = Campaign::find($campaign[$i]);
                $patientCampaign = PatientCampaign::create([
                    'patient_id' => $patient->id,
                    'condition' => $ref_campaign->condition_id,
                    'subcondition' => $ref_campaign->subCondition_id,
                    'trust_id' => $ref_campaign->trust_id,
                    'title' => $ref_campaign->title,
                    'content' => $ref_campaign->content,
                    'msgs' => '',
                    'campaign_id' => $campaign[$i],
                    'category' => $ref_campaign->category,
                    ]
                );
                
                $keydate = new Keydate;
                $keydate->patient_id = $patient->id;
                $keydate->condition_id = $ref_campaign->condition_id;
                $keydate->subcondition_id = $ref_campaign->subCondition_id;
                $keydate->apt_campaign_id = $patientCampaign->id;
                $keydate->test_order = $request->order_nums[$i];
                $keydate->apt_date = $request->apt_dates[$i];
                if($request->apt_times[$i])
                    $keydate->apt_time = $request->apt_times[$i];
                else
                    $keydate->apt_time = "08:00:00";
                $keydate->apt_kickoff_date = $request->kick_off_dates[$i];
                $keydate->test_types = $request->order_types[$i];

                $keydate->type = 'asdf';
                $keydate->save();

                $campaign_ids .= $patientCampaign->id;
                if($i < (count($campaign)-1))
                {
                    $campaign_ids.= ',';
                }

                $libraries = $ref_campaign->libraries();
                if($libraries)
                {
                    $j = 0;
                    foreach($libraries as $library)
                    {
                        $patient_library = PatientMessage::create([
                            'patient_id' => $patient->id,
                            'patient_campaign_id' => $patientCampaign->id,
                            'library_id' => $library->id,
                            'msg_title' => $library->msg_title,
                            'msg_text' => $library->msg_text,
                            'upload_video' => $library->upload_video,
                            'upload_image' => $library->upload_image,
                            'add_url' => $library->add_url,
                            'telephone' => $library->telephone,
                            'selected_date' => $library->selected_date
                        ]);
                        $msg_ids .= $patient_library->id;
                        if($j < (count($libraries) - 1))
                            $msg_ids.=',';
                        $j ++;
                    }
                    $patientCampaign->msgs = $msg_ids;
                    $patientCampaign->save();
                }               
            }
        }

        $patient->campaigns = $campaign_ids;
        $patient->save(); 

        return redirect()
            ->route('patients.edit', $patient)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Patient $patient)
    {
        $this->authorize('delete', $patient);

        $patient->delete();

        return redirect()
            ->route('patients.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function getSubConditions(Request $request)
    {
        $condition = $request->condition;
        $subConditions = null;        
        if($condition) 
        {            
            $subConditions = SubCondition::where('condition_id', '=', $condition)->get();
        }

        return response()->json([
            'subConditions' => $subConditions,
        ], 200);
    }

    public function getCampaignsByFilter(Request $request)
    {
        $condition = $request->condition;
        $subcondition = $request->subcondition;
        $conditon_arr = array(
            'condition' => $condition,
            'subcondition' => $subcondition,
        );
        $trust_id = Auth::user()->trust_id;
        if(Auth::user()->isTrustAdmin() || Auth::user()->isUser())
            $campaigns = Campaign::where('condition_id', $conditon_arr['condition'])
                                ->where('subCondition_id', $conditon_arr['subcondition'])
                                ->where(function ($query) use ($trust_id) {
                                    $query->where('trust_id', null)
                                        ->orwhere('trust_id', $trust_id);
                                })
                                ->get();
        else
            $campaigns = Campaign::where('condition_id', $condition)
                                ->where('subcondition_id', $subcondition)
                                ->get();
        return response()->json([
            'campaigns' => $campaigns,
        ], 200);
    }

    public function campaignEdit(Request $request, PatientCampaign $campaign, Patient $patient) {

        $this->authorize('update', $campaign);
        $trusts = Trust::pluck('name', 'id');
        $conditions = Condition::all();
        $subConditions = SubCondition::all();
        
        return view('app.patients.edit-campaign', compact('campaign', 'trusts', 'conditions', 'subConditions', 'patient'));

    }

    public function storeCondition($validated) {
        $sel_condition = Condition::where('name', '=', $validated['condition_id'])->first();
        if($sel_condition) 
        {
            $validated['condition_id'] = $sel_condition->id;
        } else {
            $condition = new Condition();
            $condition->name = $validated['condition_id'];
            $condition->save();
            $validated['condition_id'] = $condition->id;
        } 
        
        $sel_subCondition = SubCondition::where('name', '=', $validated['subCondition_id'])->first();
        if($sel_subCondition) 
        {
            $validated['subCondition_id'] = $sel_subCondition->id;
        } else {
            $subcondition = new SubCondition();
            $subcondition->name = $validated['subCondition_id'];
            $subcondition->condition_id = $validated['condition_id'];
            $subcondition->save();
            $validated['subCondition_id'] = $subcondition->id;
        }

        return $validated;
    }

    public function generateNewLibraryToCampaign(PatientCampaign $campaign, Request $request, $index, $upload_image = null, $upload_video = null) {
        $library = new PatientMessage;
        $library->msg_title = $request->msg_title[$index];
        $library->msg_text = $request->msg_text[$index];
        $library->upload_video = $upload_video;
        $library->upload_image = $upload_image;
        $library->patient_id = $campaign->patient_id;
        $library->patient_campaign_id = $campaign->id;
        
        if($request->hasfile('upload_video') && isset($request->file('upload_video')[$index]))
        {
            $video_url = "";
            $file = $request->file('upload_video')[$index];
            if($file)
            {                
                $fileName = time().rand(1,100).'.'.$file->extension();                 
                $path = $file->storeAs(
                    'public/uploads/library_video', $fileName
                );                
                $video_url = 'uploads/library_video/'.$fileName;   
            }
            $library->upload_video = $video_url;    
        } 
        if($request->hasfile('upload_image') && isset($request->file('upload_image')[$index]))
        {            
            $image_url = "";
            $file = $request->file('upload_image')[$index];
            if($file)
            {                
                $fileName = time().rand(1,100).'.'.$file->extension();                 
                $path = $file->storeAs(
                    'public/uploads/library_image', $fileName
                );                
                $image_url = 'uploads/library_image/'.$fileName;   
            }
            $library->upload_image = $image_url;
        }
        $library->telephone = $request->telephone[$index];
        $library->selected_date = $request->selected_date[$index];
        $library->add_url = $request->add_url[$index];
        $library->save();

        // Add new library to campaign
        if ($campaign->msgs) {
            $campaign->msgs .= ','.$library->id;
        } else {
            $campaign->msgs .= $library->id;
        }
        $campaign->save();
    }

    public function campaignUpdate(CampaignUpdateRequest $request, PatientCampaign $campaign, Patient $patient) {
        $this->authorize('update', $campaign);
        
        //update the campaign with new data
        // $new_dates = [];
        // foreach($request->selected_date as $each) {
        //     $new = str_replace('T', ' ', $each);
        //     array_push($new_dates, $new);
        // }
        // $request->selected_date = $new_dates;
        
        
        $validated = $request->validated();
        $validated = $this->storeCondition($validated);

        $campaign->update($validated);

        $lib_ids = $request->library_id;
        $index = 0;
        $campaign->msgs = '';
        $campaign->save();
        foreach($lib_ids as $each) {
            $library = PatientMessage::find($each);

            if (!$library){
                $this->generateNewLibraryToCampaign($campaign, $request, $index);
            }
            else {
                print_r($each);
                $upload_image = ($request->upload_image && isset($request->upload_image[$index])) ? $request->upload_image[$index] : $library->upload_image;
                $upload_video = ($request->upload_video && isset($request->upload_video[$index])) ? $request->upload_video[$index] : $library->upload_video;
                
                $library->msg_title = $request->msg_title[$index];
                $library->msg_text = $request->msg_text[$index];
                $library->telephone = $request->telephone[$index];
                $library->add_url = $request->add_url[$index];
                $library->upload_image = $upload_image;       
                $library->upload_video = $upload_video;
                $library->selected_date = $request->selected_date[$index];
                $library->save();
                $campaign->msgs .= $campaign->msgs ? ','.$library->id : $library->id;
                $campaign->save();
            }
            $index ++;
        }

        return redirect()
            ->route('patients.campaign.edit', ['campaign' => $campaign, 'patient' => $patient])
            ->withSuccess(__('crud.common.saved'));
    }

    function convertToArchive(Request $request){
        $campaign = PatientCampaign::find($request->campaign['id']);
        $campaign->status = "archive";
        $campaign->save();
        return response()->json([
            'changed_campaign' => $campaign,
        ], 200);
    }

    function duplicateArchive(Request $request) {
        $campaign_id = $request->campaign_id;
        $new_Campaign = new PatientCampaign;
        $custom_Campaign = PatientCampaign::find($campaign_id);
        $new_Campaign->patient_id = $custom_Campaign->patient_id;
        $new_Campaign->trust_id = $custom_Campaign->trust_id;
        $new_Campaign->content = $custom_Campaign->content;
        $new_Campaign->title = $custom_Campaign->title;
        $new_Campaign->condition = $custom_Campaign->condition;
        $new_Campaign->subcondition = $custom_Campaign->subcondition;
        $new_Campaign->campaign_id = $custom_Campaign->campaign_id;
        $new_Campaign->status = "active";
        $new_Campaign->msgs = "";
        $new_Campaign->category = $custom_Campaign->category;
        $new_Campaign->save();
        $lib_ids_str = $custom_Campaign->msgs;
        $lib_ids = explode(',', $lib_ids_str);
        $msg_ids = "";
        for($i = 0; $i < count($lib_ids); $i ++){
            $msg = PatientMessage::find($lib_ids[$i]);
            $new_msg = new PatientMessage;
            $new_msg->patient_id = $msg->patient_id;
            $new_msg->patient_campaign_id = $new_Campaign->id;
            $new_msg->library_id = $msg->library_id;
            $new_msg->msg_title = $msg->msg_title;
            $new_msg->msg_text = $msg->msg_text;
            $new_msg->upload_video = $msg->upload_video;
            $new_msg->upload_image = $msg->upload_image;
            $new_msg->add_url = $msg->add_url;
            $new_msg->telephone = $msg->telephone;
            $new_msg->selected_date = $msg->selected_date;
            $new_msg->save();
            $msg_ids .= $new_msg->id;

            if($i < (count($lib_ids) - 1)) {
                $msg_ids .= ',';
            }
        }

        $new_Campaign->msgs = $msg_ids;
        $new_Campaign->save();
        return response()->json([
            'success' => 'success',
        ], 200);
    }

    function getKeydatesByFilter(Request $request) {
        $keydates = Keydate::all();

        return response()->json([
            'keydates' => $keydates,
        ], 200);
    }

    function addResultData(Request $request) {

        $keydate = Keydate::find($request->keydate_id);
        $ref_campaign = Campaign::find($request->result_campaign);
        $patientCampaign = PatientCampaign::create([
            'patient_id' => $keydate->patient_id,
            'condition' => $ref_campaign->condition_id,
            'subcondition' => $ref_campaign->subCondition_id,
            'trust_id' => $ref_campaign->trust_id,
            'title' => $ref_campaign->title,
            'content' => $ref_campaign->content,
            'msgs' => '',
            'campaign_id' => $ref_campaign->id,
            'category' => $ref_campaign->category,
            ]
        );
        
        $patient = Patient::find($keydate->patient_id);
        $patient->campaigns .= $patientCampaign->id;
        $libraries = $ref_campaign->libraries();
        if($libraries)
        {
            $msg_ids = "";
            $j = 0;
            foreach($libraries as $library)
            {
                $patient_library = PatientMessage::create([
                    'patient_id' => $patient->id,
                    'patient_campaign_id' => $patientCampaign->id,
                    'library_id' => $library->id,
                    'msg_title' => $library->msg_title,
                    'msg_text' => $library->msg_text,
                    'upload_video' => $library->upload_video,
                    'upload_image' => $library->upload_image,
                    'add_url' => $library->add_url,
                    'telephone' => $library->telephone,
                    'selected_date' => $library->selected_date
                ]);
                $msg_ids .= $patient_library->id;
                if($j < (count($libraries) - 2))
                    $msg_ids.=',';
            }
            $patientCampaign->msgs = $msg_ids;
            $patientCampaign->save();
            $j ++;
        }   
        
        $keydate->result_date = $request->result_date;
        $keydate->lab_ref = $request->lab_ref;
        $keydate->result_type = $request->result_type;        
        $keydate->result_campaign_id = $patientCampaign->id;
        $keydate->results = "";
        $results = $request->results;
        for($i = 0; $i < count($results); $i ++)
        {
            $keydate->results .= $results[$i];
            if($i < (count($results) - 1))
                $keydate->results .= ',';
        }
        $keydate->save();

        $keydates = Keydate::all();

        return response()->json([
            'keydates' => $keydates,
        ], 200);
    }

    function addNextAppointment(Request $request) {

        $keydate = Keydate::find($request->keydate_id);
        $ref_campaign = Campaign::find($request->apt_campaign);
        $patientCampaign = PatientCampaign::create([
            'patient_id' => $keydate->patient_id,
            'condition' => $ref_campaign->condition_id,
            'subcondition' => $ref_campaign->subCondition_id,
            'trust_id' => $ref_campaign->trust_id,
            'title' => $ref_campaign->title,
            'content' => $ref_campaign->content,
            'msgs' => '',
            'campaign_id' => $ref_campaign->id,
            'category' => $ref_campaign->category,
            ]
        );
        $patient = Patient::find($keydate->patient_id);
        $patient->campaigns .= $patientCampaign->id;
        $libraries = $ref_campaign->libraries();
        if($libraries)
        {
            $msg_ids = "";
            $j = 0;
            foreach($libraries as $library)
            {
                $patient_library = PatientMessage::create([
                    'patient_id' => $patient->id,
                    'patient_campaign_id' => $patientCampaign->id,
                    'library_id' => $library->id,
                    'msg_title' => $library->msg_title,
                    'msg_text' => $library->msg_text,
                    'upload_video' => $library->upload_video,
                    'upload_image' => $library->upload_image,
                    'add_url' => $library->add_url,
                    'telephone' => $library->telephone,
                    'selected_date' => $library->selected_date
                ]);
                $msg_ids .= $patient_library->id;
                if($j < (count($libraries) - 2))
                    $msg_ids.=',';
            }
            $patientCampaign->msgs = $msg_ids;
            $patientCampaign->save();
            $j ++;
        }     
        
        $keydate->next_apt_due = $request->next_apt_due;
        $keydate->next_test_order = $request->next_apt_order_num;
        $keydate->save();
        $new_apt_keydate = new Keydate;
        $new_apt_keydate->patient_id = $request->patient_id;
        $new_apt_keydate->condition_id = $keydate->condition_id;
        $new_apt_keydate->subcondition_id = $keydate->subcondition_id;
        $new_apt_keydate->type = "asdf";
        $new_apt_keydate->test_order = $request->next_apt_order_num;
        $new_apt_keydate->apt_kickoff_date = $request->next_kick_off_date;
        $new_apt_keydate->apt_campaign_id = $patientCampaign->id;
        $next_test_types = "";
        for($i = 0; $i < count($request->next_test_types); $i ++)
        {
            $next_test_types .= $request->next_test_types[$i];
            if($i < (count($request->next_test_types) - 1))
                $next_test_types .= ',';
        }
        $new_apt_keydate->test_types = $next_test_types;
        $current_date = $keydate->apt_date;
        $current_date_str = $current_date->format('Y-m-d');
        $convert_time = strtotime($current_date_str);
        if($request->next_apt_due == "1Week")
            $current_date = strtotime("+7 day", $convert_time);    
        else if($request->next_apt_due == "2Weeks")
            $current_date = strtotime("+14 day", $convert_time);
        else if($request->next_apt_due == '1Month')
            $current_date = strtotime("+1 month", $convert_time);
        $new_apt_keydate->apt_date = date('Y/m/d', $current_date);
        $new_apt_keydate->apt_time = $keydate->apt_time;
        $new_apt_keydate->save();

        $keydates = Keydate::all();
        $showKeydateCampaigns = PatientCampaign::where('patient_id', $request->patient_id)->get();
        return response()->json([
            'keydates' => $keydates,
            'showKeydateCampaigns' => $showKeydateCampaigns,
        ], 200);
    }
    
    function editKeydateAptDate(Request $request) {
        $keydate = Keydate::find($request->keydate_id);
        $keydate->apt_date = $request->editable_apt_date;
        $keydate->save();
        $keydates = Keydate::all();
        return response()->json([
            'keydates' => $keydates,
        ], 200);
    }

    function editKeydateAptTime(Request $request) {
        $keydate = Keydate::find($request->keydate_id);
        if($request->editable_apt_time)
            $keydate->apt_time = $request->editable_apt_time;
        else
            $keydate->apt_time = "08:00:00";
        $keydate->save();
        $keydates = Keydate::all();
        return response()->json([
            'keydates' => $keydates,
        ], 200);
    }
}