<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Traits\GlobalHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GlobalHelper;

    protected $notification;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->sendNotifications($this->notification);
        //treba ti slanje mejla
    }
}
