<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(5);
        return view('departments.index', compact('departments'));
    }
    public function create()
    {
        return view('departments.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255',
        ]);
        Department::create($request->all());
        return redirect()->route('departments.index');
    }
    public function show(string $id)
    {
        $department = Department::find($id);
        return view('departments.show', compact('department'));
    }
    public function edit(string $id)
    {
        $department = Department::find($id);
        return view('departments.edit', compact('department'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:255',
        ]);
        $department = Department::findOrFail($id);
        $department->update($request->only([
            'nama_departemen',
        ]));
        return redirect()->route('departments.index');
    }
    public function destroy(string $id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('departments.index');
    }
}
