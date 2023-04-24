<?php

namespace App\Jobs;

use App\Mail\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $text;
    public function __construct($text)
    {
        $this->text = $text;
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mail = new SendEmail();
        Mail::to ($this->text['email'])->send($mail);
        //
    }
    /**
     *
     *  public function handle(): void
    {
       // $mail = new SendEmail();
        //dd($this->text['image_base64']);
        //Mail::to ($this->text['email'])->send($mail);
        Mail::to($this->text['email'])->send(new SendEmail($this->text));
        //
    }
     */
}
