<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable {
	use Queueable, SerializesModels;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	protected $user, $activation_code;
	public function __construct($user, $activation_code) {
		$this->user            = $user;
		$this->activation_code = $activation_code;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build() {
		return $this->view('front.email.activate')->with([
				'user' => $this->user,
				'code' => $this->activation_code
			]);
	}
}
