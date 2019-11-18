<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $dataMail
     */
    private $dataMail;

    /**
     * Create a new message instance.
     * @param $data
     */
    public function __construct($data)
    {
        $this->dataMail = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $content = view(config('settings.email_theme') . '.content_contact_me', ['dataMail' => $this->dataMail]);

        return $this
            ->to(config('settings.admin_mail'))
            ->from($this->dataMail['email'], $this->dataMail['name'])
            ->view('email.contact_me', ['content' => $content]);
    }
}
