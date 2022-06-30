<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $skills = Skill::all();
        return view('skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $skill = Skill::create($request->all());
        if ($skill) {
            return redirect()->route('skills.index')->with('success', 'Skill created successfully');
        } else {
            return  redirect()->route('skills.index')->with('error', 'Skill creation failed');
        }
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
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);

        if ($skill) {
            return view('skills.edit', compact('skill'));
        } else {
            return redirect(url()->previous());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);
        if ($skill) {
            $skill->update($request->all());
            return redirect()->route('skills.index')->with('success', 'update skill successfully');
        } else {
            return redirect(url()->previous())->with('error', 'There was an error updating');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);

        if ($skill) {
            $skill->delete();
            return redirect()->route('skills.index')->with('success', 'delete skill successfully');
        } else {
            return redirect(url()->previous())->with('error', 'There was an error deleting');
        }
    }
}
