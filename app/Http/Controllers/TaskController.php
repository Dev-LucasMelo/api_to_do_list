<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(){

        //todas as tarefas do usuario autenticado

        $user = Auth::user(); //user autenticado e logado pelo sanctum 
        $tasks = task::where('user_id',$user->id)->get();
        return response()->json($tasks, 200);
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
    public function task($id){
        //tarefa especifica de um usuario autenticado 

        $user = Auth::user();

        $task = task::where('user_id',$user->id)->get(); //todas as tasks do usuario autenticado
        // assim somente o usuario que possui as tarefas podem acessar, outro usuario autenticado nao pode 

        foreach($task as $t){
            if($t->id == $id){
                return response()->json($t, 200); //procurando task alvo caso nao ache retorna que nao foi encontrada
            }
        }

        return response()->json('tarefa nao encontrada',400);

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
