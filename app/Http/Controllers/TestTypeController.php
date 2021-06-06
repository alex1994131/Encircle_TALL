<?php

namespace App\Http\Controllers;

use App\Models\TestType;
use App\Models\Trust;
use Illuminate\Http\Request;
use App\Http\Requests\TestTypeStoreRequest;
use App\Http\Requests\TestTypeUpdateRequest;
use Auth;

class TestTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', TestType::class);

        $search = $request->get('search', '');
        $trusts = Trust::all();
        if(Auth::user()->isTrustAdmin())
        {
            $testTypes = TestType::search($search)
                ->where('trust_id', null)
                ->orWhere('trust_id', Auth::user()->trust_id)
                ->latest()
                ->paginate(5);
        }
        else
        {
            $testTypes = TestType::search($search)
                ->latest()
                ->paginate(5);
        }

        return view('app.test_types.index', compact('testTypes', 'search', 'trusts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', TestType::class);

        return view('app.test_types.create');
    }

    /**
     * @param \App\Http\Requests\TestTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestTypeStoreRequest $request)
    {
        $this->authorize('create', TestType::class);

        $validated = $request->validated();

        $testType = TestType::create($validated);
        if(Auth::user()->isTrustAdmin())
            $testType->trust_id = Auth::user()->trust_id;
        $testType->save();
        return redirect()
            ->route('test-types.edit', $testType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TestType $testType)
    {
        $this->authorize('view', $testType);

        return view('app.test_types.show', compact('testType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, TestType $testType)
    {
        $this->authorize('update', $testType);

        return view('app.test_types.edit', compact('testType'));
    }

    /**
     * @param \App\Http\Requests\TestTypeUpdateRequest $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function update(TestTypeUpdateRequest $request, TestType $testType)
    {
        $this->authorize('update', $testType);

        $validated = $request->validated();

        $testType->update($validated);

        return redirect()
            ->route('test-types.edit', $testType)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\TestType $testType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TestType $testType)
    {
        $this->authorize('delete', $testType);

        $testType->delete();

        return redirect()
            ->route('test-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}