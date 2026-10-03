<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $home = Home::firstOrCreate(
            [],
            [
                'title' => 'Haz click para editar el titulo',
                'body' => 'Escribe aqui el contenido principal de tu pagina...'
            ]
        );
        return view('admin.home.index', compact('home'));
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
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        $validated = $request -> validate([
            'title' => 'nullable|string|max:255',
            'body' => 'nullable|string'
        ]);

        $home->update(array_filter($validated, fn($value) => !is_null($value)));

        return response()->json([
            'success' => true,
            'message' => 'Titulo actualizado correctamente',
            'home' => $home,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }

    public function updateTitle(Request $request, Home $home)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $home->update([
            'title' => $request->title,
        ]);

        return response()->json(['message' => 'Titulo actualizado con exito']);
    }
}
