<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaboratoryRequest;
use App\Http\Requests\UpdateLaboratoryRequest;
use App\Models\Laboratory;
use Inertia\Inertia;

class LaboratoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laboratories = Laboratory::with(['equipment' => function ($query) {
            $query->select('id', 'laboratory_id', 'status');
        }])
        ->latest()
        ->paginate(12);

        return Inertia::render('laboratories/index', [
            'laboratories' => $laboratories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('laboratories/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLaboratoryRequest $request)
    {
        $laboratory = Laboratory::create($request->validated());

        return redirect()->route('laboratories.show', $laboratory)
            ->with('success', 'Laboratory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laboratory $laboratory)
    {
        $laboratory->load(['equipment' => function ($query) {
            $query->with(['loanRequestItems' => function ($q) {
                $q->whereHas('loanRequest', function ($lq) {
                    $lq->whereIn('status', ['approved', 'checked_out']);
                });
            }]);
        }]);

        return Inertia::render('laboratories/show', [
            'laboratory' => $laboratory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laboratory $laboratory)
    {
        return Inertia::render('laboratories/edit', [
            'laboratory' => $laboratory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaboratoryRequest $request, Laboratory $laboratory)
    {
        $laboratory->update($request->validated());

        return redirect()->route('laboratories.show', $laboratory)
            ->with('success', 'Laboratory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laboratory $laboratory)
    {
        $laboratory->delete();

        return redirect()->route('laboratories.index')
            ->with('success', 'Laboratory deleted successfully.');
    }
}