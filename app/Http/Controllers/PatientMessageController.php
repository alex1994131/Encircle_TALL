<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Library;
use Illuminate\Http\Request;
use App\Models\PatientMessage;
use App\Models\PatientCampaign;
use App\Http\Requests\PatientMessageStoreRequest;
use App\Http\Requests\PatientMessageUpdateRequest;

class PatientMessageController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PatientMessage::class);

        $search = $request->get('search', '');

        $patientMessages = PatientMessage::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.patient_messages.index',
            compact('patientMessages', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', PatientMessage::class);

        $patients = Patient::pluck('name', 'id');
        $patientCampaigns = PatientCampaign::pluck('title', 'id');
        $libraries = Library::pluck('data', 'id');

        return view(
            'app.patient_messages.create',
            compact('patients', 'patientCampaigns', 'libraries')
        );
    }

    /**
     * @param \App\Http\Requests\PatientMessageStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientMessageStoreRequest $request)
    {
        $this->authorize('create', PatientMessage::class);

        $validated = $request->validated();

        $patientMessage = PatientMessage::create($validated);

        return redirect()
            ->route('patient-messages.edit', $patientMessage)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientMessage $patientMessage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PatientMessage $patientMessage)
    {
        $this->authorize('view', $patientMessage);

        return view('app.patient_messages.show', compact('patientMessage'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientMessage $patientMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PatientMessage $patientMessage)
    {
        $this->authorize('update', $patientMessage);

        $patients = Patient::pluck('name', 'id');
        $patientCampaigns = PatientCampaign::pluck('title', 'id');
        $libraries = Library::pluck('data', 'id');

        return view(
            'app.patient_messages.edit',
            compact(
                'patientMessage',
                'patients',
                'patientCampaigns',
                'libraries'
            )
        );
    }

    /**
     * @param \App\Http\Requests\PatientMessageUpdateRequest $request
     * @param \App\Models\PatientMessage $patientMessage
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientMessageUpdateRequest $request,
        PatientMessage $patientMessage
    ) {
        $this->authorize('update', $patientMessage);

        $validated = $request->validated();

        $patientMessage->update($validated);

        return redirect()
            ->route('patient-messages.edit', $patientMessage)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientMessage $patientMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PatientMessage $patientMessage)
    {
        $this->authorize('delete', $patientMessage);

        $patientMessage->delete();

        return redirect()
            ->route('patient-messages.index')
            ->withSuccess(__('crud.common.removed'));
    }
}