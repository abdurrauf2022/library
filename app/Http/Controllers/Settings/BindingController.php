<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\BindingRequest;
use App\Models\Binding;
use Illuminate\Http\Request;
use Session;

class BindingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['protect-all', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('pages.settings.binding.new_binding');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->noContent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BindingRequest $request)
    {
        Binding::create($request->validated());
        Session::flash('success-binding', trans('Dodali ste povez!'));

        return to_route('setting-binding');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->noContent();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit(Binding $binding)
    {
        return view('pages.settings.binding.edit_binding', compact('binding'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(BindingRequest $request, $id)
    {
        $binding = Binding::findOrFail($id);
        $binding->update($request->validated());

        return to_route('setting-binding')->with('binding-updated',
            'Uspješno ste izmijenili povez: '."\"$binding->name\".");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        $binding = Binding::findOrFail($id);

        return $binding->delete();
    }

    public function deleteMultiple(Request $request)
    {
        $ids = $request->ids;
        Binding::whereIn('id', explode(",", $ids))->delete();
    }
}
