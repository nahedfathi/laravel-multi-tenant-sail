<?php 
namespace App\Listensers;

use App\Events\JobCreatedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SyncJobListener implements ShouldQueue
{
    public function handle(JobCreatedEvent $event)
    {
        Log::info("Listener executed: Job '{$event->job->title}' was created.");
    }
}

