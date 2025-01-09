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
            [
                'domain' => 'foo.test.local',
                'tenant_id' => 1,
            ],
            [
                'domain' => 'bar.test.local',
                'tenant_id' => 2,
            ]
        ];

        foreach ($domains as $domain) {
            DB::table('domains')
                ->updateOrInsert(
                    ['domain' => $domain['domain']], // The unique identifier
                    [
                        'tenant_id' => $domain['tenant_id'],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
        }
    }
}