<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


use App\Task;



class TaskController extends Controller
{
    public function index(){
        $tasks = Task::select('id','name','description')->get();
        return view('tasks.index')->with('tasks',$tasks);
     }

     public function create(){
        return view('tasks.create');
     }

     public function store(Request $request){
        $data = $request->except('_method','_token','submit');

        $validator = Validator::make($request->all(), [
           'name' => 'required|string|min:3',
           'description' => 'required|string|min:3',
        ]);
        if ($validator->fails()) {
            return redirect()->Back()->withInput()->withErrors($validator);
         }

         if($record = Task::firstOrCreate($data)){
            Session::flash('message', 'Added Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('tasks');
         }else{
            Session::flash('message', 'Data not saved!');
            Session::flash('alert-class', 'alert-danger');
         }

         return Back();
      }
      public function edit($id){
        $task = Task::find($id);

        return view('tasks.edit')->with('task',$task);
     }
     public function update(Request $request,$id){
        $data = $request->except('_method','_token','submit');

        $validator = Validator::make($request->all(), [
           'name' => 'required|string|min:3',
           'description' => 'required|string|min:3',
        ]);

        if ($validator->fails()) {
           return redirect()->Back()->withInput()->withErrors($validator);
        }
        $task = Task::find($id);

        if($task->update($data)){

           Session::flash('message', 'Update successfully!');
           Session::flash('alert-class', 'alert-success');
           return redirect()->route('tasks');
        }else{
           Session::flash('message', 'Data not updated!');
           Session::flash('alert-class', 'alert-danger');
        }

        return Back()->withInput();
     }
     // Delete
     public function destroy($id){
        Task::destroy($id);

        Session::flash('message', 'Delete successfully!');
        Session::flash('alert-class', 'alert-success');
        return redirect()->route('tasks');
     }
  }
}
