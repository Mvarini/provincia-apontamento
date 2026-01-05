<?php

namespace App\Jobs;

use App\Mail\SendEmailWelcome;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmailWelcomeJob implements ShouldQueue
{
    use Queueable;


    /**
     * Create a new job instance.
     */
    public function __construct(public User $user)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        // Enviar e-mail após o novo usuário se cadastrar no sistema
        Mail::to($this->user->email, $this->user->name)->send(new SendEmailWelcome($this->user));
    }
}
