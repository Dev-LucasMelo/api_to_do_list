<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(){
        //todas as tarefas
    }
    public function store(Request $request){

        //criando tarefa
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        try {
            $user = Auth::user();

            $task = new task;

            $task->title = $request->title;
            $task->description = $request->description;
            $task->completed = $request->completed;
            $task->limit_date = $request->limit_date;
            $task->user_id = $user->id;
        
            $task->save();

            return response()->json([
                'sucess' => true,
                'message' => 'tarefa criada com sucesso !'
            ],200);

        } catch (\Throwable $th) {

            return response()->json([
                'sucess' => false,
                'message' => 'Error ao criar tarefa !',
                
            ],400);
        }
         
       
       

    }
    public function task(){
        //tarefa especifica
    }
    public function updateTask(){
        //Atualizado tarefa
    }
    public function deleteTask(){
        //deletando tarefa
    }
    public function notification(){
        //enviando um email notificando que faltam 24 horas para concluir sua tarefa(caso não tenha sido concluida)
    }
}
