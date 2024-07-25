<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCriteriaRequest;
use App\Models\Criteria;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Dapatkan semua kriteria
        $criterias = Criteria::all();
        return view('criterias.index', compact('criterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('criterias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCriteriaRequest $request)
    {
        // Simpan kriteria baru
        $criteria = Criteria::create($request->validated());

        // Buat nama kolom baru berdasarkan nama kriteria, misalnya c12
        $newColumnName = 'c' . $criteria->id;

        // Tambahkan kolom baru ke tabel alternatives
        Schema::table('alternatives', function (Blueprint $table) use ($newColumnName) {
            $table->float($newColumnName)->nullable();
        });

        return redirect()->route('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        return view('criterias.edit', compact('criteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'weight' => 'required|numeric',
        ]);

        $criteria->update($validated);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criteria)
    {
        $criteria->delete();

        return redirect()->route('dashboard');
    }
}
