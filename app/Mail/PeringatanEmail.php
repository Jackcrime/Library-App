<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PeringatanEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $denda;
    public $peringatan;

    public function __construct($user, $denda, $peringatan)
    {
        $this->user = $user;
        $this->denda = $denda;
        $this->peringatan = $peringatan;
    }

    public function build()
    {
        return $this->subject("Peringatan Denda - Perpustakaan")
                    ->view('emails.peringatan');
    }
}
