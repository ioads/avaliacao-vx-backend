<?php
namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
    * Execute the job.
    *
    * @param  User  $user
    * @return void
    */
    public function handle()
    {
        Mail::to('ioads@outlook.com')
        ->send(new NotificationEmail());
    }
}