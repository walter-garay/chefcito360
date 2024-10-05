<?php

namespace App\Http\Controllers;

use App\Models\Platillo;
use App\Models\Sucursales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlatilloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los platillos con su relación sucursal
        $platillos = Platillo::with('sucursal')->get();
        $sucursales = Sucursales::all(); // Asegúrate de obtener todas las sucursales

        // Pasar los datos a la vista
        return view('platillos.index', compact('platillos', 'sucursales'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|in:entrada,principal,postre,bebida',
            'sucursal_id' => 'required|exists:sucursales,id',
        ]);

        // Subir imagen
        $path = $request->file('imagen')->store('platillos', 'public');

        // Crear el platillo
        Platillo::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $path,
            'categoria' => $request->categoria,
            'sucursal_id' => $request->sucursal_id,
        ]);

        return redirect()->back()->with('success', 'Platillo creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Platillo $platillo)
    {
        // Devolver los detalles del platillo en un modal
        return response()->json($platillo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Platillo $platillo)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|in:entrada,principal,postre,bebida',
            'sucursal_id' => 'required|exists:sucursales,id',
        ]);

        // Subir nueva imagen si existe
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior
            Storage::disk('public')->delete($platillo->imagen);
            // Guardar la nueva imagen
            $path = $request->file('imagen')->store('platillos', 'public');
            $platillo->imagen = $path;
        }

        // Actualizar los datos del platillo
        $platillo->update($request->only('nombre', 'descripcion', 'precio', 'categoria', 'sucursal_id'));

        return redirect()->back()->with('success', 'Platillo actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platillo $platillo)
    {
        // Eliminar la imagen del platillo
        Storage::disk('public')->delete($platillo->imagen);
        $platillo->delete();

        return redirect()->back()->with('success', 'Platillo eliminado con éxito');
    }
}
