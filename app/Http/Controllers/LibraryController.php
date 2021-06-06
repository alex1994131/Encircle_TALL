<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Campaign;
use App\Models\PatientMessage;
use Illuminate\Http\Request;
use App\Http\Requests\LibraryStoreRequest;
use App\Http\Requests\LibraryUpdateRequest;

class LibraryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Library::class);

        $search = $request->get('search', '');

        $libraries = Library::search($search)
            ->latest()
            ->paginate(5);

        return view('app.libraries.index', compact('libraries', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Library::class);

        $campaigns = Campaign::pluck('title', 'id');

        return view('app.libraries.create', compact('campaigns'));
    }


    public function uploadMedia($request, $video = null, $image = null) {
        $video_url = $video;
        $image_url = $image;


        if($request->hasfile('upload_video'))
        {
            $file = $request->file('upload_video');
            if($file)
            {                
                $fileName = time().rand(1,100).'.'.$file->extension();                 
                $path = $file->storeAs(
                    'public/uploads/library_video', $fileName
                );                
                $video_url = 'uploads/library_video/'.$fileName;   
            }
        } 
        if($request->hasfile('upload_image'))
        {            
            $file = $request->file('upload_image');
            if($file)
            {                
                $fileName = time().rand(1,100).'.'.$file->extension();                 
                $path = $file->storeAs(
                    'public/uploads/library_image', $fileName
                );                
                $image_url = 'uploads/library_image/'.$fileName;   
            }
        }
        return [
            'video' => $video_url,
            'image' => $image_url
        ];
    }

    /**
     * @param \App\Http\Requests\LibraryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LibraryStoreRequest $request)
    {
        $this->authorize('create', Library::class);

        $validated = $request->validated();

        $media = $this->uploadMedia($request);


        $library = Library::create($validated);
        $library->upload_video = $media['video'];
        $library->upload_image = $media['image'];
        $library->save();

        return redirect()
            ->route('libraries.edit', $library)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Library $library)
    {
        $this->authorize('view', $library);

        return view('app.libraries.show', compact('library'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Library $library)
    {
        $this->authorize('update', $library);

        $campaigns = Campaign::pluck('title', 'id');

        return view('app.libraries.edit', compact('library', 'campaigns'));
    }

    /**
     * @param \App\Http\Requests\LibraryUpdateRequest $request
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function update(LibraryUpdateRequest $request, Library $library)
    {
        $this->authorize('update', $library);

        $validated = $request->validated();

        $media = $this->uploadMedia($request, $library->upload_video, $library->upload_image);
        $library->upload_video = $media['video'];
        $library->upload_image = $media['image'];

        $library->update($validated);

        return redirect()
            ->route('libraries.edit', $library)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Library $library
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Library $library)
    {
        $this->authorize('delete', $library);

        $library->delete();

        return redirect()
            ->route('libraries.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function getMessages(Request $request)
    {
        $msgs_text = $request->msgs;
        
        $msg_ids = explode(',', $msgs_text);        
        $msgs = [];
        foreach($msg_ids as $each)
            array_push($msgs, Library::find($each));        
        return response()->json([
            'msgList' => $msgs,
        ], 200);
    }

    public function getPatientMessages(Request $request)
    {
        $msgs_text = $request->msgs;
        
        $msg_ids = explode(',', $msgs_text);        
        $msgs = [];
        foreach($msg_ids as $each)
            array_push($msgs, PatientMessage::find($each));        
        return response()->json([
            'msgList' => $msgs,
        ], 200);
    }
}