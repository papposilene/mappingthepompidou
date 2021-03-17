<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // First user
		$adminMail = env('ADMIN_EMAIL', 'example@example.com');
        $adminPassword = env('ADMIN_PASSWORD', 'laravel');
        $adminFname = env('ADMIN_FNAME', 'admin');
		$adminLname = env('ADMIN_LNAME', 'admin');

		// Drop the table
        DB::table('users')->delete();
        // Seed the table
        User::create(
            [
                'fname' => $adminFname,
                'lname' => $adminLname,
                'email' => $adminMail,
                'password' => Hash::make($adminPassword),
                'approved_at' => now(),
            ]
        );
        $user = User::where('email', $adminMail)->first();
        $user->assignRole('superAdmin');
    }
}
