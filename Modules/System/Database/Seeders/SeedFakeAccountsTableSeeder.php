<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\System\Entities\Account;
use Hash;
class SeedFakeAccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Account::create([
            'first_name' => 'Admin First Name',
            'last_name' => 'Admin Last Name',
            'username' => 'username',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'), // Replace 'password' with desired password
            'account_level' => 'admin',
            'account_status' => 'active',
        ]);
        
        
        
        
        
        
        
        // $this->call("OthersTableSeeder");
    }
}
