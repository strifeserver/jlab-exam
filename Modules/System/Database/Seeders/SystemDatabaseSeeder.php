<?php

namespace Modules\System\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SystemDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(SeedFakeAccountsTableSeeder::class);
        $this->call(SeedFakeCustomersTableSeeder::class);
        // $this->call("OthersTableSeeder");
    }
}
