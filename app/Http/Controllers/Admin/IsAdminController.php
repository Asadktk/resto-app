<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IsAdmin;
use Illuminate\Http\Request;

class IsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index');
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
    public function show(IsAdmin $isAdmin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IsAdmin $isAdmin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IsAdmin $isAdmin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IsAdmin $isAdmin)
    {
        //
    }
}
