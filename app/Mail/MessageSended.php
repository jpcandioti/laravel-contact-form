<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Subject;
use App\Message;

class MessageSended extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The Message instance.
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = Subject::find($this->message->subjectId);
        return $this->subject($subject->description)
                    ->replyTo($this->message->fromEmail, $this->message->fromName)
                    ->view('emails.message')
                    ->with([
                        'message_addedOn' => $this->message->addedOn->format('d/m/Y H:i:s'),
                        'message_fromName' => $this->message->fromName,
                        'message_fromEmail' => $this->message->fromEmail,
                        'message_subject' => $subject->description,
                        'message_body' => $this->message->body,
                    ]);
    }
}
