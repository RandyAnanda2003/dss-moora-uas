<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlternativeRequest;
use App\Models\Alternative;
use Illuminate\Http\Request;
use App\Models\Criteria;

class AlternativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Implementasi untuk menampilkan daftar alternatif jika diperlukan
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $criterias = Criteria::select('id', 'name', 'type', 'weight')->get();
        return view('alternatives.create', compact('criterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlternativeRequest $request)
    {
        $data = $request->validated();

        // Ambil kriteria dari database
        $criterias = Criteria::all();

        // Siapkan data untuk disimpan
        $alternativeData = ['name' => $data['name']];
        foreach ($criterias as $criteria) {
            $alternativeData['c' . $criteria->id] = $data['c' . $criteria->id];
        }

        // Simpan data alternatif
        Alternative::create($alternativeData);

        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alternative $alternative)
    {
        $criterias = Criteria::select('id', 'name', 'type', 'weight')->get();
        return view('alternatives.edit', compact('criterias', 'alternative'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternative $alternative)
    {
        $data = $request->all();

        // Ambil kriteria dari database
        $criterias = Criteria::all();

        // Siapkan data untuk diupdate
        $alternativeData = ['name' => $data['name']];
        foreach ($criterias as $criteria) {
            $alternativeData['c' . $criteria->id] = $data['c' . $criteria->id];
        }

        // Update data alternatif
        $alternative->update($alternativeData);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternative $alternative)
    {
        $alternative->delete();

        return redirect()->route('dashboard');
    }
}
