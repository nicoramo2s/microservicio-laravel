<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendOrderShippedEmail implements ShouldQueue
{
    use Queueable;

    public $order;
    public $fromAddress;
    public $toAddress;
    public $subject;
    public $contentBody;

    /**
     * Create a new job instance.
     */
    public function __construct($order, $fromAddress, $toAddress, $subject, $contentBody)
    {
        $this->order = $order;
        $this->fromAddress = $fromAddress;
        $this->toAddress = $toAddress;
        $this->subject = $subject;
        $this->contentBody = $contentBody;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->toAddress)->send(new OrderShipped($this->order, $this->fromAddress, $this->toAddress, $this->subject, $this->contentBody));
    }
}
