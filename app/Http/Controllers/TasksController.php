<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = [];
        if( \Auth::check() ){
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at','desc')->paginate( 10 );

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];

        }
        return view('welcome', $data );

        /*
        $tasks = Task::all();

        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
        */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if( Auth::check() ){
            $task = new Task;

            return view('tasks.create', [
                'task' => $task,
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request )
    {
        $this->validate( $request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191'
        ]);

        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->user_id = Auth::id();
        $task->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id )
    {
        if( Auth::check() ){
            $task = Task::find( $id );

            return view('tasks.show', [
                'task' => $task,
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        if( Auth::check() ){
            $task = Task::find( $id );

            return view('tasks.edit', [
                'task' => $task,
            ]);
        } else {
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id )
    {
        if( Auth::check() ){
            $this->validate( $request,[
                'status' => 'required|max:10',
                'content' => 'required|max:191',
            ]);

            $task = Task::find( $id );
            $task->status = $request->status;
            $task->content = $request->content;
            $task->save();

            return redirect('/');
        } else {
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        if( Auth::check() ){
            $task = Task::find( $id );
            $task->delete();

            return redirect('/');
        } else {
            return redirect('/');
        }
    }
}
