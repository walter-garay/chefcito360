<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Sucursales;
use Illuminate\Http\Request;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Obtener todas las mesas con su relación de sucursal
    $mesas = Mesa::with('sucursal')->get();

    // Obtener todas las sucursales
    $sucursales = Sucursales::all();

    // Pasar los datos a la vista
    return view('mesas.index', compact('mesas', 'sucursales'));
}


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /*
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Mesa $mesa)
    {
        // Devolver los detalles de la mesa en un formato JSON (para usar en modales, etc.)

    }

    public function edit(Mesa $mesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mesa $mesa)
    {
        // Validar los datos

    }

    public function destroy(Mesa $mesa)
    {

    }

}
