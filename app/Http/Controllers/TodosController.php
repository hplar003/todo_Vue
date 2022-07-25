<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return Inertia::render('Todos/Index', ['todos' => Todo::all()->map(function ($todo) {
            return [
                'id' => $todo->id,
                'title' => $todo->title,
                'completed' => $todo->completed,
                'completed_at' => $todo->completed_at
            ];
        })]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('todos/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],

        ])->validate();
        $data = $request->all();
        $date['completed'] = false;
        $data['completed_at'] = date('Y-m-d H:i:s', strtotime($data['completed_at']));

        Todo::create($data);


        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        return Inertia::render('Todos/Edit', ['todo' => $todo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
            'completed_at' => ['required'],
        ])->validate();
        Todo::find($id)->update($request->all());
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect()->route('todos.index');
    }
    public function isDone(Request $request, $id)
    {
        if ($request['completed']) {

            Todo::find($id)->update($request['completed'] = true);
            return redirect()->route('todos.index');
        }
    }
}
