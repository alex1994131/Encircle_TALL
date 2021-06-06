<?php

namespace App\Http\Controllers;

use App\Models\Trust;
use App\Models\Campaign;
use App\Models\Condition;
use App\Models\SubCondition;
use App\Models\Library;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CampaignStoreRequest;
use App\Http\Requests\CampaignUpdateRequest;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Campaign::class);

        $search = $request->get('search', '');
        
        if(Auth::user()->isTrustAdmin())
            $campaigns = Campaign::search($search)
                ->where('trust_id', Auth::user()->trust_id)
                ->orwhere('trust_id', null)
                ->latest()
                ->paginate(5);
        else
            $campaigns = Campaign::search($search)
                ->latest()
                ->paginate(5);
        return view('app.campaigns.index', compact('campaigns', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Campaign::class);

        $trusts = Trust::pluck('name', 'id');

        if(Auth::user()->isTrustAdmin())
        {
            $conditions = Condition::where('trust_id', null)
                                    ->orWhere('trust_id', Auth::user()->trust_id)
                                    ->get();
            $subConditions = SubCondition::where('trust_id', null)
                                        ->orWhere('trust_id', Auth::user()->trust_id)
                                        ->get();
        }
        else
        {
            $conditions = Condition::all();
            $subConditions = SubCondition::all();
        }
        return view('app.campaigns.create', compact('trusts', 'conditions', 'subConditions'));
    }


    public function storeCondition($validated) {
        $sel_condition = Condition::where('name', '=', $validated['condition_id'])->first();
        if($sel_condition) 
        {
            $validated['condition_id'] = $sel_condition->id;
        } else {
            $condition = new Condition();
            $condition->name = $validated['condition_id'];
            if(Auth::user()->isTrustAdmin())
                $condition->trust_id = Auth::user()->trust_id;
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
            if(Auth::user()->isTrustAdmin())
                $subcondition->trust_id = Auth::user()->trust_id;
            $subcondition->condition_id = $validated['condition_id'];
            $subcondition->save();
            $validated['subCondition_id'] = $subcondition->id;
        }

        return $validated;
    }

    /**
     * @param \App\Http\Requests\CampaignStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignStoreRequest $request)
    {
        $this->authorize('create', Campaign::class);        
        $validated = $request->validated();   
        $validated = $this->storeCondition($validated);
        $campaign = Campaign::create($validated);                               
        $lib_ids = $request->library_id;
        $index = 0;
        $campaign->msgs = '';
        $campaign->save();
        foreach($lib_ids as $each) {
            $library = Library::find($each);
            if (!$library)
                $this->generateNewLibraryToCampaign($campaign, $request, $index);
            else {
                
                $upload_image = ($request->upload_image && isset($request->upload_image[$index])) ? $request->upload_image[$index] : $library->upload_image;
                $upload_video = ($request->upload_video && isset($request->upload_video[$index])) ? $request->upload_video[$index] : $library->upload_video;
                
                if ($library->msg_title !== $request->msg_title[$index] ||
                $library->msg_text !== $request->msg_text[$index] ||
                // $video_diff_flag == true ||
                // $image_diff_flag == true ||
                $library->telephone !== $request->telephone[$index] ||
                $library->add_url !== $request->add_url[$index] ||
                $library->upload_image !== $upload_image || 
                $library->upload_video !== $upload_video || 
                $library->selected_date !== $request->selected_date[$index])
                {
                    // If there is something changed then new library would be generated
                    $this->generateNewLibraryToCampaign($campaign, $request, $index, $library->upload_image, $library->upload_video);
                }
                else {
                    $campaign->msgs .= $campaign->msgs ? ','.$library->id : $library->id;
                    $campaign->save();
                }
            }
            $index ++;
        }

        return redirect()
            ->route('campaigns.edit', $campaign)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Campaign $campaign)
    {
        $this->authorize('view', $campaign);

        $trusts = Trust::pluck('name', 'id');
        $subConditions = SubCondition::all();
        if(Auth::user()->isTrustAdmin())
        {
            $conditions = Condition::where('trust_id', null)
                                    ->orWhere('trust_id', Auth::user()->trust_id)
                                    ->get();
            $subConditions = SubCondition::where('trust_id', null)
                                        ->orWhere('trust_id', Auth::user()->trust_id)
                                        ->get();
        }
        else
        {
            $conditions = Condition::all();
            $subConditions = SubCondition::all();
        }

        return view('app.campaigns.show', compact('campaign', 'trusts', 'conditions', 'subConditions'));        
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Campaign $campaign)
    {
        $this->authorize('update', $campaign);

        $trusts = Trust::pluck('name', 'id');
        $subConditions = SubCondition::all();
        if(Auth::user()->isTrustAdmin())
        {
            $conditions = Condition::where('trust_id', null)
                                    ->orWhere('trust_id', Auth::user()->trust_id)
                                    ->get();
            $subConditions = SubCondition::where('trust_id', null)
                                        ->orWhere('trust_id', Auth::user()->trust_id)
                                        ->get();
        }
        else
        {
            $conditions = Condition::all();
            $subConditions = SubCondition::all();
        }
        return view('app.campaigns.edit', compact('campaign', 'trusts', 'conditions', 'subConditions'));
    }


    public function generateNewLibraryToCampaign(Campaign $campaign, Request $request, $index, $upload_image = null, $upload_video = null) {
        $library = new Library;
        $library->msg_title = $request->msg_title[$index];
        $library->msg_text = $request->msg_text[$index];
        $library->upload_video = $upload_video;
        $library->upload_image = $upload_image;

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

    /**
     * @param \App\Http\Requests\CampaignUpdateRequest $request
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignUpdateRequest $request, Campaign $campaign)
    {
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
            $library = Library::find($each);

            if (!$library){
                $this->generateNewLibraryToCampaign($campaign, $request, $index);
            }
            else {
                print_r($each);
                // $existing_video = null;
                // $video_diff_flag = false;
                // $existing_image = null;
                // $image_diff_flag = false;

                // if($library->upload_video)
                // {
                //     $existing_video = Storage::get($library->upload_video);  
                //     $upload_video = null;
                //     if($request->hasfile('upload_image'))
                //         $upload_video = $request->file('upload_video')[$index];
    
                //     $video_diff_flag = $upload_video ? $this->fileDiff($existing_video, $upload_video) : true;
                // } else {
                //     $upload_video = null;
                //     if($request->hasfile('upload_image'))
                //         $upload_video = $request->file('upload_video')[$index];
                //     if($upload_video)                        
                //         $video_diff_flag = true;
                // }
                // if($library->upload_image)
                // {
                //     $existing_image = Storage::get($library->upload_image); 
                //     $upload_image = null;
                //     if($request->file('upload_image'))   
                //         $upload_image =  $request->file('upload_image')[$index];
                //     $image_diff_flag = $upload_image ? $this->fileDiff($existing_image, $upload_image) : true;                            
                // } else {
                //     if($request->file('upload_image')[$index])
                //         $image_diff_flag = true;
                // }
                // dd($request->upload_image[0]);

                $upload_image = ($request->upload_image && isset($request->upload_image[$index])) ? $request->upload_image[$index] : $library->upload_image;
                $upload_video = ($request->upload_video && isset($request->upload_video[$index])) ? $request->upload_video[$index] : $library->upload_video;

                if ($library->msg_title !== $request->msg_title[$index] ||
                $library->msg_text !== $request->msg_text[$index] ||
                // $video_diff_flag == true ||
                // $image_diff_flag == true ||
                $library->telephone !== $request->telephone[$index] ||
                $library->add_url !== $request->add_url[$index] ||
                $library->upload_image !== $upload_image || 
                $library->upload_video !== $upload_video || 
                $library->selected_date !== $request->selected_date[$index])
                {
                    // If there is something changed then new library would be generated
                    $this->generateNewLibraryToCampaign($campaign, $request, $index, $library->upload_image, $library->upload_video);
                }
                else {
                    $campaign->msgs .= $campaign->msgs ? ','.$library->id : $library->id;
                    $campaign->save();
                }
            }
            $index ++;
        }

        return redirect()
            ->route('campaigns.edit', $campaign)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Campaign $campaign)
    {
        $this->authorize('delete', $campaign);

        $campaign->delete();

        return redirect()
            ->route('campaigns.index')
            ->withSuccess(__('crud.common.removed'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Campaign $campaign
     * @return \Illuminate\Http\Response
     */
    public function getSubConditions(Request $request)
    {        
        $condition = $request->condition;        
        $sel_condition = Condition::where('name', '=', $condition)->first();        
        $subConditions = null;
        if($sel_condition) 
        {            
            $subConditions = SubCondition::where('condition_id', '=', $sel_condition->id)->get();
        }             
        return response()->json([
            'subConditions' => $subConditions,
        ], 200);
    }
    
    /**
     * Compare the contents of two files to check if they have some difference.
     *
     * It does not check what exactly is different between files. This way, as 
     * soon as a difference is found, the function stops reading the files.
     *
     * @param  SplFileInfo $a The first file to compare.
     * @param  SplFileInfo $b The second file to compare.
     * @return bool Indicates if the files have differences between them.
     */
    private function fileDiff($a, $b)  
    {
        $diff = false;
        $fa = $a->openFile();
        $fb = $b->openFile();

        /*
        * Read the same amount from each file. Breaks the loop as soon as a 
        * difference is found.
        */
        while (!$fa->eof() && !$fb->eof()) {
            if ($fa->fread(4096) !== $fb->fread(4096)) {
                $diff = true;
                break;
            }
        }

        /*
        * Just one of the files ended. This is unlikely to happen, though. 
        * Since we already checked before if the files have the same size.
        */
        if ($fa->eof() !== $fb->eof()) {
            $diff = true;
        }

        /*
        * Closing handlers.
        */
        $fa = null;
        $fb = null;

        return $diff;
    }
}
