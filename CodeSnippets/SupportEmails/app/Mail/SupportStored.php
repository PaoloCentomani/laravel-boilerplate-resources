<?php

namespace App\Mail;

use App\Http\Requests\StoreSupport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportStored extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The request instance.
     *
     * @var \App\Http\Requests\StoreSupport
     */
    public $request;

    /**
     * Create a new message instance.
     *
     * @param  \App\Http\Requests\StoreSupport  $request
     * @return void
     */
    public function __construct(StoreSupport $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(config('mail.from.address'), config('mail.from.name'))
            ->replyTo($this->request->input('email'), $this->request->input('name'))
            ->subject(__('messages.support.subject', ['name' => $this->request->input('name')]))
            ->markdown('emails.support');
    }
}
