<?php

namespace App\Observers;

use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskObserver
{
    public function created(Task $task)
    {
        Log::info("Створено нове завдання: ID {$task->id}, Назва: {$task->title}");
    }

    public function updated(Task $task)
    {
        if ($task->wasChanged('status')) {
            Log::info("Статус завдання ID {$task->id} змінено з '{$task->getOriginal('status')}' на '{$task->status}'");
        }
    }

    public function deleted(Task $task)
    {
        Log::info("Видалено завдання: ID {$task->id}");
    }
}

