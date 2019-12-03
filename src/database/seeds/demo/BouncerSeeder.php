<?php

namespace Seeds\Demo;

use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		\Bouncer::allow('superadmin')->everything();

		\Bouncer::allow('regional-marketing-manager')->to('view-reports');
		\Bouncer::allow('regional-marketing-manager')->to('view-cultivation-loop-statuses-report');
		\Bouncer::allow('regional-marketing-manager')->to('view-associations');
		\Bouncer::allow('regional-marketing-manager')->to('create-associations');
		\Bouncer::allow('regional-marketing-manager')->to('edit-associations');
		\Bouncer::allow('regional-marketing-manager')->to('destroy-associations');
		\Bouncer::allow('regional-marketing-manager')->to('view-regions');
		\Bouncer::allow('regional-marketing-manager')->to('create-regions');
		\Bouncer::allow('regional-marketing-manager')->to('edit-regions');
		\Bouncer::allow('regional-marketing-manager')->to('destroy-regions');
		\Bouncer::allow('regional-marketing-manager')->to('view-districts');
		\Bouncer::allow('regional-marketing-manager')->to('create-districts');
		\Bouncer::allow('regional-marketing-manager')->to('edit-districts');
		\Bouncer::allow('regional-marketing-manager')->to('destroy-districts');
		\Bouncer::allow('regional-marketing-manager')->to('view-territories');
		\Bouncer::allow('regional-marketing-manager')->to('create-territories');
		\Bouncer::allow('regional-marketing-manager')->to('edit-territories');
		\Bouncer::allow('regional-marketing-manager')->to('destroy-territories');
		\Bouncer::allow('regional-marketing-manager')->to('create-customers');
		\Bouncer::allow('regional-marketing-manager')->to('view-users');
		\Bouncer::allow('regional-marketing-manager')->to('create-users');
		\Bouncer::allow('regional-marketing-manager')->to('edit-users');
		\Bouncer::allow('regional-marketing-manager')->to('delete-users');
		\Bouncer::allow('regional-marketing-manager')->to('create-customer-contacts');
		\Bouncer::allow('regional-marketing-manager')->to('edit-customer-contacts');
		\Bouncer::allow('regional-marketing-manager')->to('destroy-customer-contacts');

		\Bouncer::allow('district-marketing-manager')->to('view-reports');
		\Bouncer::allow('district-marketing-manager')->to('view-cultivation-loop-statuses-report');
		\Bouncer::allow('district-marketing-manager')->to('view-associations');
		\Bouncer::allow('district-marketing-manager')->to('create-associations');
		\Bouncer::allow('district-marketing-manager')->to('edit-associations');
		\Bouncer::allow('district-marketing-manager')->to('destroy-associations');
		\Bouncer::allow('district-marketing-manager')->to('view-regions');
		\Bouncer::allow('district-marketing-manager')->to('create-regions');
		\Bouncer::allow('district-marketing-manager')->to('edit-regions');
		\Bouncer::allow('district-marketing-manager')->to('destroy-regions');
		\Bouncer::allow('district-marketing-manager')->to('view-districts');
		\Bouncer::allow('district-marketing-manager')->to('create-districts');
		\Bouncer::allow('district-marketing-manager')->to('edit-districts');
		\Bouncer::allow('district-marketing-manager')->to('destroy-districts');
		\Bouncer::allow('district-marketing-manager')->to('view-territories');
		\Bouncer::allow('district-marketing-manager')->to('create-territories');
		\Bouncer::allow('district-marketing-manager')->to('edit-territories');
		\Bouncer::allow('district-marketing-manager')->to('destroy-territories');
		\Bouncer::allow('district-marketing-manager')->to('create-customers');
		\Bouncer::allow('district-marketing-manager')->to('view-users');
		\Bouncer::allow('district-marketing-manager')->to('create-users');
		\Bouncer::allow('district-marketing-manager')->to('edit-users');
		\Bouncer::allow('district-marketing-manager')->to('delete-users');
		\Bouncer::allow('district-marketing-manager')->to('create-customer-contacts');
		\Bouncer::allow('district-marketing-manager')->to('edit-customer-contacts');
		\Bouncer::allow('district-marketing-manager')->to('destroy-customer-contacts');

		\Bouncer::allow('home-office-team')->to('view-associations');
		\Bouncer::allow('home-office-team')->to('create-associations');
		\Bouncer::allow('home-office-team')->to('edit-associations');
		\Bouncer::allow('home-office-team')->to('destroy-associations');
		\Bouncer::allow('home-office-team')->to('view-regions');
		\Bouncer::allow('home-office-team')->to('create-regions');
		\Bouncer::allow('home-office-team')->to('edit-regions');
		\Bouncer::allow('home-office-team')->to('destroy-regions');
		\Bouncer::allow('home-office-team')->to('view-districts');
		\Bouncer::allow('home-office-team')->to('create-districts');
		\Bouncer::allow('home-office-team')->to('edit-districts');
		\Bouncer::allow('home-office-team')->to('destroy-districts');
		\Bouncer::allow('home-office-team')->to('view-territories');
		\Bouncer::allow('home-office-team')->to('create-territories');
		\Bouncer::allow('home-office-team')->to('edit-territories');
		\Bouncer::allow('home-office-team')->to('destroy-territories');
		\Bouncer::allow('home-office-team')->to('create-customers');
		\Bouncer::allow('home-office-team')->to('create-customer-contacts');
		\Bouncer::allow('home-office-team')->to('edit-customer-contacts');
		\Bouncer::allow('home-office-team')->to('destroy-customer-contacts');

		\Bouncer::allow('marketing-representative')->to('view-associations');
		\Bouncer::allow('marketing-representative')->to('create-associations');
		\Bouncer::allow('marketing-representative')->to('edit-associations');
		\Bouncer::allow('marketing-representative')->to('create-customers');
		\Bouncer::allow('marketing-representative')->to('create-customer-contacts');
		\Bouncer::allow('marketing-representative')->to('edit-customer-contacts');
		\Bouncer::allow('marketing-representative')->to('destroy-customer-contacts');
	}
}
