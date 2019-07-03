<?php

namespace App\Http\Controllers\Admin;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.tasks.index');
    }

    public function jsonIndex()
    {
        return response()->json([
            'data' => Task::orderBy('title')->with('user')->get()
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.tasks.create');
    // }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|min:2',
            'description' => 'nullable|min:5',
            'file' => 'nullable',
            'deadline' => 'required',
        ]);

        if($file = $request->file){
            $fileName = $this->fileUpload($file);
            $request['file'] = $fileName;
        }
        $request['user_id'] = $request->user;
        Task::create($request->all());
        return response()->json([
            'data' => 'done'
        ]);
    }
    public function fileUpload($file)
    {
        // extention
        $extention = explode('/', mime_content_type($file))[1];
        // file name
        $fileName = str_random(10).'.'.$extention;
        // file
        $file = str_replace(explode(',', $file)[0].',', '', $file);
        $file = str_replace(' ', '+', $file);
        // upload file
        \File::put('uploads' .'/' . $fileName, base64_decode($file));
        return $fileName;
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        unlink('uploads/'.$task->file);
        return response()->json([
            'data' => 'done'
        ]);
    }
}
