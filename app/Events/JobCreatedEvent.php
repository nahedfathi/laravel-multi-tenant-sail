<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Job;
use Illuminate\Foundation\Queue\Queueable;

class JobCreatedEvent implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    public Job $job;

    public function __construct(Job $job)
    {
        $this->job = $job;
    }
}
