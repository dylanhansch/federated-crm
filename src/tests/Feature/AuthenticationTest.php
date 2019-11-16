<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase {
	use RefreshDatabase;

	/** @test */
	public function unauthenticatedUserIsRedirectedToLogin() {
		$this->get('/')
			 ->assertRedirect('/login');
	}

	/** @test */
	public function authenticatedUserCanAccessDashboard() {
		$user = factory('App\User')->create();

		$this->be($user);

		$this->get('/')
			 ->assertStatus(200);
	}
}
