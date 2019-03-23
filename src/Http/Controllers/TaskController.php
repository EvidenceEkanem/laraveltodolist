<?php

namespace evidenceekanem\laravelTodoList\Controllers;

use Alert;
use Illuminate\Http\Request;
use evidenceekanem\laravelTodoList\Controllers\Controller;
use evidenceekanem\laravelTodoList\Models\Task;
use evidenceekanem\laravelTodoList\Models\Category;

class TaskController extends Controller
{
    function __construct() {
        return $this->middleware('web');
    }

    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->get('category')) {
            $currentCat = $request->get('category');
            $currentCat = Category::where('id', $currentCat)->first();
            $tasksForCurrentCat = $currentCat->tasks ?? null;
        }
        return view('laraveltodolist::tasks', ['categories' => $categories, 'tasks' => $tasksForCurrentCat ?? null, 'current_cat' => $currentCat ?? null]);
    }

    public function addTask(Request $request)
    {
        $tasks = new Task;
        $tasks->name = $request->name;
        $tasks->category_id = $request->category_id;
        $tasks->save();

        Alert::success('Task successfully added!')->persistent("OK");
        
        return back();
    }

    public function addCategory(Request $request)
    {
        $categories = new Category;
        $categories->categories = $request->categories;
        
        $categories->save();

        Alert::success('Category successfully added!')->persistent("OK");

        return redirect('tasks');
    }
   
    public function updateCategories(Request $request, $id)
    {
        $categories = Category::find($id);
        $categories->categories = $request->categories;
        
        $categories->save();

        Alert::success('Category successfully updated!')->persistent("OK");

        return back();
    }

    public function deleteTask($id)
    {
        $tasks = Task::Find($id);
        $tasks->delete();

        Alert::success('Task successfully deleted!')->persistent("OK");
        
        return back();
    }

    public function deleteCategory($id)
    {
        $categories = Category::find($id);
        $categories->delete();

        Alert::success('Category successfully deleted!')->persistent("OK");
        
        return back();
    }

    public function updateTaskStatus(Request $request)
    {

        $task = Task::findOrFail($request->taskId);
        
        if($task->completed == false)
        {
            $task->completed = true;
            $task->save();
        }
        else{
            $task->completed = 0;
            $task->save();
        }

        return $task;
    }
}
