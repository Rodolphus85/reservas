<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TableController extends Controller
{
    public function index(): View
    {
        $tables = Table::orderBy('location_id', 'asc')->get();
        $users = Table::orderBy(
            Location::select('code')
                ->limit(1),
            'asc'
        )->get();

        return view('tables.index', compact('tables'));
    }

    /*public function show(): View
    {
        return view('tables.show');
    }*/

    public function create(): View
    {
        $locationOptions = Location::pluck('id', 'code');

        return view('tables.create', compact('locationOptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'location' => 'required',
            'number' => 'required',
            'guest_count' => 'required',
        ]);

        Table::create([
            'location_id' => $validatedData['location'],
            'number' => $validatedData['number'],
            'guest_count' => $validatedData['guest_count']
        ]);

        return redirect()->route('tables.index');
    }

    public function edit($id)
    {
        $table = Table::findOrFail($id);

        $locationOptions = Location::pluck('id', 'code');

        return view('tables.edit', compact('table', 'locationOptions'));
    }

    public function update($id, Request $request)
    {
        $table = Table::findOrFail($id);

        $validatedData = $request->validate([
            'location' => 'required',
            'number' => 'required',
            'guest_count' => 'required',
        ]);

        $table->update([
            'location_id' => $validatedData['location'],
            'number' => $validatedData['number'],
            'guest_count' => $validatedData['guest_count'],
        ]);

        return redirect()->route('tables.index');
    }

    public function destroy($id)
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect()->route('tables.index');
    }
}
