<?php

namespace App\Http\Controllers;

use App\Http\Requests\TableRequest;
use App\Models\Location;
use App\Models\Table;
use Illuminate\Http\RedirectResponse;
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

    public function create(): View
    {
        $locationOptions = Location::pluck('id', 'code');

        return view('tables.create', compact('locationOptions'));
    }

    public function store(TableRequest $request): RedirectResponse
    {
        Table::create([
            'location_id' => $request->location,
            'number' => $request->number,
            'guest_count' => $request->guest_count,
        ]);

        return redirect()->route('tables.index');
    }

    public function edit(int $id): View
    {
        $table = Table::findOrFail($id);

        $locationOptions = Location::pluck('id', 'code');

        return view('tables.edit', compact('table', 'locationOptions'));
    }

    public function update(int $id, TableRequest $request): RedirectResponse
    {
        $table = Table::findOrFail($id);

        $table->update([
            'location_id' => $request->location,
            'number' => $request->number,
            'guest_count' => $request->guest_count,
        ]);

        return redirect()->route('tables.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        $table = Table::findOrFail($id);
        $table->delete();

        return redirect()->route('tables.index');
    }
}
