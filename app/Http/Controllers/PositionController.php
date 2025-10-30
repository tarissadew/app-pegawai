<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->paginate(5);
        return view('positions.index', compact('positions'));
    }
    public function create()
    {
        return view('positions.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|string|max:50',
        ]);
        Position::create($request->all());
        return redirect()->route('positions.index');
    }
    public function show(string $id)
    {
        $position = Position::find($id);
        return view('positions.show', compact('position'));
    }
    public function edit(string $id)
    {
        $position = Position::find($id);
        return view('positions.edit', compact('position'));
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:255',
            'gaji_pokok' => 'required|string|max:50',
        ]);
        $position = Position::findOrFail($id);
        $position->update($request->only([
            'nama_jabatan',
            'gaji_pokok',
        ]));
        return redirect()->route('positions.index');
    }
    public function destroy(string $id)
    {
        $position = Position::find($id);
        $position->delete();
        return redirect()->route('positions.index');
    }
}
