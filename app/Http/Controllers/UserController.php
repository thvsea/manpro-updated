<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = User::where('is_admin', 0)->get();
        return view('admin.users.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $model = new User();
        return view('admin.users.form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $model = User::create($request->all());
        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = User::findOrFail($id);
        return view('admin.users.form', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model = User::findOrFail($id);
        $model->update($request->all());
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::findOrFail($id);
        $model->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
