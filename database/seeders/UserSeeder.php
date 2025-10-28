<?php

namespace App\Database\Seeders;

use App\Services\SqlEasy;

class UserSeeder
{
    private SqlEasy $sqlEasy;

    public function __construct()
    {
        $this->sqlEasy = SqlEasy::getInstance();
    }

    public function run(): void
    {
        echo "👥 Seeding users and roles...\n";
        
        // Seed roles
        $roles = [
            [
                'role_id' => 'ADM001',
                'name' => 'Super Admin',
                'description' => 'Full system access',
                'permissions' => json_encode(['all'])
            ],
            [
                'role_id' => 'EDT001',
                'name' => 'Editor',
                'description' => 'Content management access',
                'permissions' => json_encode(['posts', 'services', 'products'])
            ]
        ];

        foreach ($roles as $role) {
            $this->sqlEasy->insert('roles', $role);
        }

        // Seed users
        $users = [
            [
                'user_id' => 'ADM001',
                'name' => 'Admin',
                'surname' => 'User',
                'email' => 'admin@lexyhands.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role_id' => 'ADM001',
                'phone' => '+351 962 674 341',
                'status' => 'active',
                'email_verified_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_id' => 'EDT001',
                'name' => 'Editor',
                'surname' => 'User',
                'email' => 'editor@lexyhands.com',
                'password' => password_hash('editor123', PASSWORD_DEFAULT),
                'role_id' => 'EDT001',
                'phone' => '+351 962 674 341',
                'status' => 'active',
                'email_verified_at' => date('Y-m-d H:i:s')
            ]
        ];

        foreach ($users as $user) {
            $this->sqlEasy->insert('users', $user);
        }
        
        echo "✅ Users and roles seeded\n";
    }
}
