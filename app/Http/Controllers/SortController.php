<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Sort;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sorts = Sort::all();
        return view('sorts.index', compact('sorts')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sorts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'planted' => 'required|numeric|min:0', // Валидация для поля 'посажено'
        ]);

        Sort::create(['title' => $request->title, 'planted' => $request->planted, 'user_id' => Auth::id()]);
        return redirect()->route('sorts.index')->with('success', 'Сорт успешно добавлен!');
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
        $sort = Sort::findOrFail($id);
        $sort->delete();

        return redirect()->route('sorts.index')->with('success', 'Сорт успешно удален!');
    }

    public static function recalculateOrdered($id) {
        $totalOrdered = OrderDetail::where('sort_id', $id)->sum('count');
        Sort::where('id', $id)->update(['ordered' => $totalOrdered]);
        return response()->json([
            'message' => 'Ordered count recalculated',
            'sort_id' => $id,
            'ordered' => $totalOrdered,
        ]);
    }
}
