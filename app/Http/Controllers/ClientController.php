<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:11|unique:clients',
            'other_phone' => 'nullable|string|max:11|unique:clients',
            'comment' => 'nullable|string',
            'messenger' => 'nullable|string|max:255',
            'other_messenger' => 'nullable|string|max:255',
        ]);

         // Создание нового клиента
         Client::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'other_phone' => $validated['other_phone'] ?? null,
            'comment' => $validated['comment'] ?? null,
            'messenger' => $validated['messenger'] ?? null,
            'other_messenger' => $validated['other_messenger'] ?? null,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
