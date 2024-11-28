<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use App\Models\Sucursales;


class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los productos con sus relaciones sucursal y proveedor
        $productos = Productos::with(['sucursal', 'proveedor'])->get();

        $sucursales = Sucursales::all(); // Obtener todas las sucursales
        $proveedores = Proveedores::all(); // Obtener todos los proveedores

        // Pasar los datos a la vista
        return view('productos.index', compact('productos', 'sucursales', 'proveedores'));
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
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $productos)
    {
        //
    }
}
