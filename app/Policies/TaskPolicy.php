<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;
use Log;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
     public function destroy(User $user, Task $task)
    {
        Log::info('destroy');
        Log::info(print_r($user->id, true));
        Log::info(print_r($task->user_id, true));
        return $user->id == $task->user_id;
    }
    public function __construct()
    {
        //
    }
}
