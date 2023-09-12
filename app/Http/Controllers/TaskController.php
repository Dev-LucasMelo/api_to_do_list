<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\task;

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
            'completed',
            'limit_date',
            'user_id' => 'required',
        ]);

        try {
            task::create($request->all())->save();
            return response()->json([
                'sucess' => true,
                'message' => 'tarefa criada com sucesso !'
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'sucess' => false,
                'message' => 'Error ao criar tarefa !'
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
