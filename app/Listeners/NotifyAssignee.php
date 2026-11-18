<?php

namespace App\Listeners;

use App\Events\TaskCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class NotifyAssignee
{
    public function handle(TaskCreated $event): void
    {
    $task = $event->task;

    if (!is_null($task->assigned_to)) {
        Log::info("Імітація сповіщення: Завдання '{$task->title}' призначено виконавцю ID {$task->assigned_to}.");
         }
    }
}