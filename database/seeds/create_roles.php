<?php

use Illuminate\Database\Seeder;

class create_roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new \App\Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description = 'User administrador de la plataforma'; // optional
        $admin->save();

        $owner = new \App\Role();
        $owner->name = 'user';
        $owner->display_name = 'Owner'; // optional
        $owner->description = 'usuario cliente de la plataforma'; // optional
        $owner->save();
    }
}
