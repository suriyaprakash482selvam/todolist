<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\Session;

class TodoController extends Controller
{
    // Method to display all todos
    public function index()
    {
        $todos = Todo::all();
        return view('index', compact('todos'));
    }

    // Method to display the form for creating a new todo
    public function create()
    {
        return view('create');
    }

    // Method to store a new todo
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => ($request->completed == 'on') ? 1 : 0,
        ]);

        session()->flash('success', 'Todo created successfully.');

        return redirect()->route('index');
    }

    // Method to display a specific todo
    public function show(Todo $todo)
    {
        return view('show', compact('todo'));
    }

    // Method to display the form for editing a todo
    public function edit(Todo $todo)
    {
        return view('edit', compact('todo'));
    }

    // Method to update a todo
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',

        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'completed' => ($request->completed == 'on') ? 1 : 0,
        ]);

        session()->flash('success', 'Todo updated successfully.');

        return redirect()->route('index');
    }

    //Method to delete page

    public function delete(Todo $todo)
    {
        return view('confirm-delete', compact('todo'));

    }

    // Method to delete a todo
    public function destroy(Todo $todo)
    {
        $todo->delete();

        session()->flash('success', 'Todo deleted successfully.');

        return redirect()->route('index');
    }
}
