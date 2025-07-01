<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;


class SubjectController extends Controller
{



    public function index()
    {
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }



    public function create()
    {
        return view('subjects.create');
    }




    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Subject::create($request->only('name', 'icon', 'color', 'description'));

        return redirect()->route('admin.subjects.index')->with('success', 'Materia creada correctamente.');

    }




    public function edit(Subject $subject)
    {
        return view('subjects.edit', compact('subject'));
    }





    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $subject->update($request->only('name', 'icon', 'color', 'description'));

        return redirect()->route('admin.subjects.index')->with('success', 'Materia actualizada correctamente.');
    }




    

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Materia eliminada correctamente.');
    }
}
