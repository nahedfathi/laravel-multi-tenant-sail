<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Laravel\Passport\ClientRepository;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $tenants = [
            ['name' => 'Tenant 3'],
            ['name' => 'Tenant 4'],
        ];

        foreach ($tenants as $data) {
            $tenant = Tenant::create([
                    'name' => $data['name'],
            ]);
            $tenant->run(function () {
                $clientRepository = app(ClientRepository::class);
                $clientRepository->createPasswordGrantClient(
                    '',
                    'users',
                    url('/')
                );
                $clientRepository->createPersonalAccessGrantClient( '',
                    'users',
                    url('/'));
                
            });
        }
    }
}
