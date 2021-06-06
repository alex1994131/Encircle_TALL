<?php

namespace App\Http\Controllers;

use App\Models\TestType;
use App\Models\Keydate;
use Illuminate\Http\Request;
use App\Http\Requests\KeydateStoreRequest;
use App\Http\Requests\KeydateUpdateRequest;

class KeydateController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Keydate::class);

        $search = $request->get('search', '');

        $keydates = Keydate::search($search)
            ->latest()
            ->paginate(5);

        return view('app.keydates.index', compact('keydates', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Keydate::class);

        $testTypes = TestType::pluck('test_name', 'id');

        return view('app.keydates.create', compact('testTypes'));
    }

    /**
     * @param \App\Http\Requests\KeydateStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeydateStoreRequest $request)
    {
        $this->authorize('create', Keydate::class);

        $validated = $request->validated();

        $keydate = Keydate::create($validated);

        return redirect()
            ->route('keydates.edit', $keydate)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Keydate $Keydate
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Keydate $keydate)
    {
        $this->authorize('view', $keydate);

        return view('app.keydates.show', compact('keydate'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Keydate $Keydate
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Keydate $keydate)
    {
        $this->authorize('update', $keydate);

        $testTypes = TestType::pluck('test_name', 'id');

        return view('app.keydates.edit', compact('keydate', 'testTypes'));
    }

    /**
     * @param \App\Http\Requests\KeydateUpdateRequest $request
     * @param \App\Models\Keydate $Keydate
     * @return \Illuminate\Http\Response
     */
    public function update(
        KeydateUpdateRequest $request,
        Keydate $keydate
    ) {
        $this->authorize('update', $keydate);

        $validated = $request->validated();

        $keydate->update($validated);

        return redirect()
            ->route('keydates.edit', $keydate)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Keydate $Keydate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Keydate $keydate)
    {
        $this->authorize('delete', $keydate);

        $keydate->delete();

        return redirect()
            ->route('keydates.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
