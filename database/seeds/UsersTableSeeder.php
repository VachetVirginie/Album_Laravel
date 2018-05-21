<?php
    use Illuminate\Database\Seeder;
    use App\Models\User;
    class UsersTableSeeder extends Seeder
    {
        public function run()
        {
            User::create([
                'name' => 'Vivi',
                'email' => 'vivi@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('azerty'),
                'settings' => '{"pagination": 8}',
            ]);
            User::create([
                'name' => 'Soso',
                'email' => 'soso@gmail.com',
                'password' => bcrypt('azerty'),
                'settings' => '{"pagination": 8}',
            ]);
        }
    }