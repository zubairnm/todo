<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Todo;

class TodoController extends Controller
{
    public function home(){
        //$title = "Todo | Home";
        //return view('home',['name'=>'Zubair','title'=>$title]);

        $todos = Todo::all();
        //dd($todos);

        return view('home',['todos'=>$todos]);
    }

    public function store(Request $request){
        //dd($request);
        //dd($request->post('title'));
        $validateData = $request->validate([
            'title'=>'required|max:124'
        ]);          
        //dd($validateData);

       /* $todo = new Todo();
        $todo->title = $request->post('title');
        $todo->save();*/
        Todo::create($validateData);
        
        //return redirect('/');
        return redirect(route('home'));
        //return back();
    }

    public function edit($id){
        //dd($id);

        //$todo = Todo::find($id);
        $todo = Todo::findOrFail($id);
       // if(!$todo) return abort(404);
        //dd($todo);
        return view('update',compact('todo'));

    }
    /*public function edit(Todo $id){
        dd($id);        
        return view('update',compact('todo'));

    }*/

    public function update(Request $request, Todo $todo){
        $validateData = $request->validate([
            'title'=>'required|max:124'
        ]);          
       //dd($validateData);
        //$todo->title = $validateData['title'];
        //$todo->save();
        $todo->update($validateData);
        return redirect(route('home'));

    }
    
    public function delete(Todo $todo){
        $todo->delete();
        return back();
    }
    
}
