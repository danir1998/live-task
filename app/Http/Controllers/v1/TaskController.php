<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Database\Factories\TaskUsersFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Список базы всех задач
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function list()
    {
        return Task::with('category')->get();
    }

    /**
     * Генерить подборки для юзверов
     * p.s ставится на крон раз в сутки
     * @return array
     */
    public function taskToUser()
    {
        $report = [];

        foreach (User::all() as $user) {
            //генерим уникальные таски без повторений...
            $ids = array_map(function($category) use ($user) {
                return [
                    'task_id' => Task::where(['category_id' => $category['id']])->get()->random()->id, //достаем случайные таски
                    'user_id' => $user->id
                ];
            }, Category::all()->toArray());

            TaskUser::insert($ids);
            $report[] = $ids;
        }

        return $report;
    }

    /**
     * Генерить случайные 30 задач
     * @return void
     */
    public function fake()
    {
        Task::factory()->count(30)->create();
        response(["status" => "ok"], 200);
    }

    /**
     * Вывод подборки задач авторизованному юзверу
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function task()
    {
        $user = Auth::user();
        return TaskUser::with('task.category')->where(['user_id' => $user->id])->get();
    }

    /**
     * Установка задачи как выполнено
     * @param TaskUser $task
     * @return TaskUser
     */
    public function success(TaskUser $task)
    {
        $task->is_done = 1;
        $task->save();
        return $task;
    }

    /**
     * Замена выданной задачи
     * @param Request $request
     * @param TaskUser $task
     * @return bool
     */
    public function change(Request $request, TaskUser $task)
    {
        $newTaskId = $request->task_id;
        $task->task_id = $newTaskId;
        $task->save();

        return response(['message' => 'success'], 200);
    }
}
