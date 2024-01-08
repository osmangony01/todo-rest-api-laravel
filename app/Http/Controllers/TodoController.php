<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::all();

        if($todos->count()>0){
            return response()->json([
                'status'=> 200,
                'todos'=> $todos
            ], 200);
        }
        else{
            return response()->json([
                'status'=> 404,
                'todos'=> 'No Records Found!!'
            ], 404);
        }
    }

    public function addTodo(Request $req)
    {
        // if($req->isMethod('post')){
        //     $data = $req->all();
        //     return $data;
        // }

        //return response()->json(['message' => 'i am post'], 200);

        $validator = Validator::make($req->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        } 
        else {
            $todo = new Todo();
            $todo->title = $req->title;
            $todo->description = $req->description;

            if ($todo->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Todo created successfully'
                ], 200);
            } 
            else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong!'
                ], 500);
            }
        }
    }
}
