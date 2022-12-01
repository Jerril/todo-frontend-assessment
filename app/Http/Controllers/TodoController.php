<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TodoController extends Controller
{
    public function getTodos(Request $request){
        $response = Http::withToken($request->session()->get('token'))->get('https://todo-api-assessment-production.up.railway.app/todo');

        if($response->body() == "Unauthorized") return redirect()->route('login.get')->withErrors([ 'email' => "Session Expired. Kindly log in again" ]);

        if($response->failed()){
            // Return back with error
            return redirect()->route('dashboard')->withErrors([
                'msg' => $response['message']
            ]);
        }

        $todos = $response['todos'] ?? '';

        return view('layouts.main', compact('todos'));
    }

    //
    public function addTodo(Request $request)
    {
        // Validate incoming form data
        $credentials = $request->validate([
            'title' => ['required', 'String'],
            'description' => ['required', 'String'],
        ]);

        // Consume endpoint to create todo
        $response = Http::withToken($request->session()->get('token'))->post('https://todo-api-assessment-production.up.railway.app/todo', [
            "title" => $request->title,
            "description" => $request->description,
        ]);

        if($response->body() == "Unauthorized") return redirect()->route('login.get')->withErrors([ 'email' => "Session Expired. Kindly log in again" ]);

        if($response->failed()){
            // Return back with error
            return redirect()->route('dashboard')->withErrors([
                'msg' => $response['message']
            ]);
        }

        // Redirect to dashboard
        return redirect()->route('dashboard')->with('msg', "Todo Added successfully");
    }

    //
    public function updateTodo(Request $request, $id)
    {
        // Validate incoming form data
        $credentials = $request->validate([
            'title' => ['required', 'String'],
            'description' => ['required', 'String'],
        ]);

        // Consume endpoint to create todo
        $response = Http::withToken($request->session()->get('token'))->put('https://todo-api-assessment-production.up.railway.app/todo/'.$id, [
            "title" => $request->title,
            "description" => $request->description,
        ]);

        if($response->body() == "Unauthorized") return redirect()->route('login.get')->withErrors([ 'email' => "Session Expired. Kindly log in again" ]);

        if($response->failed()){
            // Return back with error
            return redirect()->route('dashboard')->withErrors([
                'msg' => $response['message']
            ]);
        }

        // Redirect to dashboard
        return redirect()->route('dashboard')->with('msg', "Todo Updated successfully");
    }

    //
    public function deleteTodo(Request $request, $id)
    {
        // Consume endpoint to delete todo
        $response = Http::withToken($request->session()->get('token'))->delete('https://todo-api-assessment-production.up.railway.app/todo/'.$id);

        if($response->body() == "Unauthorized") return redirect()->route('login.get')->withErrors([ 'email' => "Session Expired. Kindly log in again" ]);

        if($response->failed()){
            // Return back with error
            return redirect()->route('dashboard')->withErrors([
                'msg' => $response['message']
            ]);
        }

        // Redirect to dashboard
        return redirect()->route('dashboard')->with('msg', "Todo deleted successfully");
    }

}
