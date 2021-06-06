<?php

namespace App\Http\Controllers;

use App\Models\Outbound;
use App\Models\Keydate;
use Illuminate\Http\Request;
use App\Http\Requests\OutboundStoreRequest;
use App\Http\Requests\OutboundUpdateRequest;

class OutboundController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Outbound::class);

        $search = $request->get('search', '');

        $outbounds = Outbound::search($search)
            ->latest()
            ->paginate(5);

        return view('app.outbounds.index', compact('outbounds', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Outbound::class);

        $keydates = Keydate::pluck('type', 'id');

        return view('app.outbounds.create', compact('keydates'));
    }

    /**
     * @param \App\Http\Requests\OutboundStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OutboundStoreRequest $request)
    {
        $this->authorize('create', Outbound::class);

        $validated = $request->validated();

        $outbound = Outbound::create($validated);

        return redirect()
            ->route('outbounds.edit', $outbound)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Outbound $outbound
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Outbound $outbound)
    {
        $this->authorize('view', $outbound);

        return view('app.outbounds.show', compact('outbound'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Outbound $outbound
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Outbound $outbound)
    {
        $this->authorize('update', $outbound);

        $keydates = Keydate::pluck('type', 'id');

        return view('app.outbounds.edit', compact('outbound', 'keydates'));
    }

    /**
     * @param \App\Http\Requests\OutboundUpdateRequest $request
     * @param \App\Models\Outbound $outbound
     * @return \Illuminate\Http\Response
     */
    public function update(OutboundUpdateRequest $request, Outbound $outbound)
    {
        $this->authorize('update', $outbound);

        $validated = $request->validated();

        $outbound->update($validated);

        return redirect()
            ->route('outbounds.edit', $outbound)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Outbound $outbound
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Outbound $outbound)
    {
        $this->authorize('delete', $outbound);

        $outbound->delete();

        return redirect()
            ->route('outbounds.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
