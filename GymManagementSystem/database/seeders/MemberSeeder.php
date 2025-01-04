<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GymMember;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea 20 miembros usando la factory
        GymMember::factory(100)->create();
    }
}
