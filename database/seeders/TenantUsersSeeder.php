<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Stancl\Tenancy\Tenancy;

class TenantUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = Tenant::all();

        foreach ($tenants as $tenant) {
            tenancy()->initialize($tenant);
            $user = User::factory()->create([
                'name' => "User_{$tenant->id}",
                'email' => "user@{$tenant->id}.com",
                'password' => bcrypt('secret'),
            ]);
            $this->command->info("Tenant {$tenant->id}: User {$user->email}");
        }
    }
}
