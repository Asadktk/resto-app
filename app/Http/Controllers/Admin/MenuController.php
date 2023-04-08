<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $menues = Menu::all();
        return view('admin.menues.index', compact('menues'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $categories = Category::all();
        return view('admin.menues.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('menues', 'public');
        }

        Menu::create($formFields);

        return redirect()->route('menues.index')->with('success', 'Menue created successfully.');
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
    public function edit(Menu $menue)
    {
        $categories = Category::all();
        return view('admin.menues.edit', compact('menue', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menue)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('menues', 'public');
        }

        $menue->update($formFields);

        return redirect()->route('menues.index')->with('success', 'Menu updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menue)
    {
        $menue->delete();

        return redirect()->route('menues.index')->with('danger', 'Menu deleted successfully');
    }
}
