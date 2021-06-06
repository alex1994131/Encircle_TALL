<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\PatientCampaign;
use App\Http\Requests\PatientCampaignStoreRequest;
use App\Http\Requests\PatientCampaignUpdateRequest;

class PatientCampaignController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', PatientCampaign::class);

        $search = $request->get('search', '');

        $patientCampaigns = PatientCampaign::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.patient_campaigns.index',
            compact('patientCampaigns', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', PatientCampaign::class);

        $patients = Patient::pluck('name', 'id');
        $campaigns = Campaign::pluck('title', 'id');

        return view(
            'app.patient_campaigns.create',
            compact('patients', 'campaigns')
        );
    }

    /**
     * @param \App\Http\Requests\PatientCampaignStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientCampaignStoreRequest $request)
    {
        $this->authorize('create', PatientCampaign::class);

        $validated = $request->validated();

        $patientCampaign = PatientCampaign::create($validated);

        return redirect()
            ->route('patient-campaigns.edit', $patientCampaign)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientCampaign $patientCampaign
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, PatientCampaign $patientCampaign)
    {
        $this->authorize('view', $patientCampaign);

        return view('app.patient_campaigns.show', compact('patientCampaign'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientCampaign $patientCampaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, PatientCampaign $patientCampaign)
    {
        $this->authorize('update', $patientCampaign);

        $patients = Patient::pluck('name', 'id');
        $campaigns = Campaign::pluck('title', 'id');

        return view(
            'app.patient_campaigns.edit',
            compact('patientCampaign', 'patients', 'campaigns')
        );
    }

    /**
     * @param \App\Http\Requests\PatientCampaignUpdateRequest $request
     * @param \App\Models\PatientCampaign $patientCampaign
     * @return \Illuminate\Http\Response
     */
    public function update(
        PatientCampaignUpdateRequest $request,
        PatientCampaign $patientCampaign
    ) {
        $this->authorize('update', $patientCampaign);

        $validated = $request->validated();

        $patientCampaign->update($validated);

        return redirect()
            ->route('patient-campaigns.edit', $patientCampaign)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PatientCampaign $patientCampaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, PatientCampaign $patientCampaign)
    {
        $this->authorize('delete', $patientCampaign);

        $patientCampaign->delete();

        return redirect()
            ->route('patient-campaigns.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
