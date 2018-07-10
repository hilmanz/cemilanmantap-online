<?php

namespace App\Jobs;

use App\Mail\EmailVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendVerificationEmail implements ShouldQueue {
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	protected $user, $activation_code, $playload;
	public function __construct($user, $activation_code) {
		$this->user            = $user;
		$this->activation_code = $activation_code;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle() {
		$email = new EmailVerification($this->user, $this->activation_code);
		Mail::to($this->user->email)->send($email);
	}
}
