<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantsAndDomainsSeeder extends Seeder
{
    public function run()
    {
        // Create tenants
        $tenants = [1, 2];
        
        foreach ($tenants as $id) {
            DB::table('tenants')
                ->insertOrIgnore([
                    'id' => $id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }

        // Create domains
        $domains = [
            // Existing local domains
            [
                'domain' => 'foo.test.local',
                'tenant_id' => 1,
            ],
            [
                'domain' => 'bar.test.local',
                'tenant_id' => 2,
            ],
            // New EC2 IP-based domains
            [
                'domain' => 'foo.3.250.89.236',
                'tenant_id' => 1,
            ],
            [
                'domain' => 'bar.3.250.89.236',
                'tenant_id' => 2,
            ]
        ];

        foreach ($domains as $domain) {
            DB::table('domains')->insertOrIgnore($domain);
        }
    }
}