<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Log;
use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
{
	$user_id = Auth::id();
	Log::info('user_id: $user_id');
	Log::info("user_id: $user_id");
	
	//$users = User::where("id", $user_id)->get();
	//$user = $users[0];

	$user = User::where("id", $user_id)->first();


    //Log::info("hello");
    //Log::info(print_r($user, true));
    $tasks = Task::where("user_id", $user_id)->get();
    Log::info(print_r($tasks, true));
    return view('tasks.index', [
    	"user" => $user,
    	"tasks" => $tasks
    ]);

}
 public function store(Request $request){
 	$name = $request->name;
 	$newtask = new Task;
 	$newtask->name = $name;
	$user_id = Auth::id();
	$newtask->user_id = $user_id;
	Log::info('user_id: $user_id');
	Log::info("user_id: $user_id");
 	$newtask->save();



 	return redirect('tasks');
 }


  public function destroy(Request $request, Task $task){
  	// return $task;
  	// return $task_id;
 	 $this->authorize('destroy', $task);
 	 $task->delete();
 	 return redirect('/tasks');
 	// return redirect('tasks');
 }
}

