<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\System\Entities\Customer;
use Hash;
class SeedFakeCustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::create([
            'first_name' => 'Customer First Name',
            'last_name' => 'Customer Last Name',
            'username' => 'customer',
            'email' => 'customer@example.com',
            'password' => Hash::make('customer'), // Replace 'password' with desired password
            'account_level' => 'customer',
            'account_status' => 'active',
        ]);
        
        
    }
}
