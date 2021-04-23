<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApprovalLevelRequest;
use App\Models\ApprovalLevel;
use Illuminate\Http\Request;

class ApprovalLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = ApprovalLevel::all();

        return view('crud.approval_levels.index', compact('items'))
            ->with('pageTitle', 'Approval Levels');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $approval_level = new ApprovalLevel;

        return view('crud.approval_levels.form', compact('approval_level'))
            ->with('pageTitle', 'Add Approval Level')
            ->with('route', route('admin.approval_levels.store'))
            ->with('method', 'POST');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ApprovalLevelRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'name'  => 'required|string|unique:approval_levels',
        ]);

        ApprovalLevel::create($validatedData);

        return redirect()->route('admin.approval_levels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ApprovalLevel $approvalLevel)
    {
      return view('crud.approval_levels.form')
        ->with('pageTitle', 'Edit Approval Level')
        ->with('approval_level', $approvalLevel)
        ->with('method', 'PATCH')
        ->with('route', route('admin.approval_levels.update', $approvalLevel->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApprovalLevel $approvalLevel)
    {
        $validatedData = $request->validate([
          'name'  => 'required|string',
        ]);

        $approvalLevel->update($validatedData);

        return redirect()->route('admin.approval_levels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApprovalLevel $approvalLevel)
    {
        $appapprovalLevel->delete();

        return redirect()->route('admin.approval_levels.index');
    }
}