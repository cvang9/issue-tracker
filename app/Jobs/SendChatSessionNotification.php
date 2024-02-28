<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\ChatSessionNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendChatSessionNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $timestamp;
    protected $resolverId;
    protected $user;

    public function __construct( User $user, $timestamp, $resolverId )
    {
        $this->user = $user;   
        $this->timestamp = $timestamp;
        $this->resolverId = $resolverId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->user->notify(new ChatSessionNotification($this->timestamp, $this->resolverId));
    }
}
