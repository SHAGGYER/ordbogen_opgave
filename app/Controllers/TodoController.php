<?php
namespace App\Controllers;

use App\Lib\Authentication;
use App\Lib\Controller;
use App\Lib\Request;
use App\Lib\Response;
use App\Models\Todo;

class TodoController extends Controller
{
    public function create()
    {
        $user = Authentication::newSession();
        $todo = new Todo();
        $todo->user_id = $user->id;
        $todo->title = Request::body("title");
        $todo->completed = 0;
        $todo->save();

        return Response::json(["content" => $todo], 201);
    }

    public function deleteTodo($id) {
        Todo::delete()->where([
            ["id", "=", $id],
        ])->execute();

        return Response::json(["content" => "Todo deleted"], 200);
    }

    public function list() {
        $user = Authentication::newSession();
        $todos = Todo::where([
            ["user_id", "=", $user->id],
        ])->get();

        return Response::json(["content" => $todos], 200);
    }

    public function markComplete($id) {
        $todo = Todo::where([
            ["id", "=", $id],
        ])->first();

        $todo->completed = 1;
        $todo->save();

        return Response::json(["content" => $todo], 200);
    }
}