<?php

namespace App\Http\Controllers;

use App\Models\Trust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TrustStoreRequest;
use App\Http\Requests\TrustUpdateRequest;

class TrustController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Trust::class);

        $search = $request->get('search', '');

        $trusts = Trust::search($search)
            ->latest()
            ->paginate(5);

        return view('app.trusts.index', compact('trusts', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Trust::class);

        return view('app.trusts.create');
    }

    /**
     * @param \App\Http\Requests\TrustStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrustStoreRequest $request)
    {
        $this->authorize('create', Trust::class);

        $validated = $request->validated();
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('public');
        }

        $trust = Trust::create($validated);

        return redirect()
            ->route('trusts.edit', $trust)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trust $trust
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Trust $trust)
    {
        $this->authorize('view', $trust);

        return view('app.trusts.show', compact('trust'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trust $trust
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Trust $trust)
    {
        $this->authorize('update', $trust);

        return view('app.trusts.edit', compact('trust'));
    }

    /**
     * @param \App\Http\Requests\TrustUpdateRequest $request
     * @param \App\Models\Trust $trust
     * @return \Illuminate\Http\Response
     */
    public function update(TrustUpdateRequest $request, Trust $trust)
    {
        $this->authorize('update', $trust);

        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            if ($trust->logo) {
                Storage::delete($trust->logo);
            }

            $validated['logo'] = $request->file('logo')->store('public');
        }

        $trust->update($validated);

        return redirect()
            ->route('trusts.edit', $trust)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Trust $trust
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Trust $trust)
    {
        $this->authorize('delete', $trust);

        if ($trust->logo) {
            Storage::delete($trust->logo);
        }

        $trust->delete();

        return redirect()
            ->route('trusts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
