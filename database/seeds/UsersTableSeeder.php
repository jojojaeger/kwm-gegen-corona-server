<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $helpseeker= new App\User;
        $helpseeker->first_name='Helga';
        $helpseeker->last_name='Pichler';
        $helpseeker->type='helpseeker';
        $helpseeker->address='Hauptstraße 1, 3003 Purkersdorf';
        $helpseeker->email='helga.pichler@gmail.com';
        $helpseeker->password=bcrypt('covid19');
        $helpseeker->save();

        $helpseeker= new App\User;
        $helpseeker->first_name='Dawid';
        $helpseeker->last_name='Wieczorek';
        $helpseeker->type='helpseeker';
        $helpseeker->address='Lainzer Straße 25/4, 1010 Wien';
        $helpseeker->email='dawid.wieczorek@gmail.com';
        $helpseeker->password=bcrypt('dawid');
        $helpseeker->save();

        $volunteer= new App\User;
        $volunteer->first_name='Johanna';
        $volunteer->last_name='Jäger';
        $volunteer->type='volunteer';
        $volunteer->address='Sumersiedlung 27, 3021 Pressbaum';
        $volunteer->email='johanna.jaeger89@gmx.at';
        $volunteer->password=bcrypt('covid19');
        $volunteer->save();
    }
}
