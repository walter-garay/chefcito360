<?php

namespace App\Http\Controllers;

use App\Models\Ordenes;
use Illuminate\Http\Request;

class OrdenesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('ordenes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordenes $ordenes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordenes $ordenes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordenes $ordenes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordenes $ordenes)
    {
        //
    }
}
