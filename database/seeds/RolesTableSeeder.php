<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin';
        $admin->save();

        $editor = new Role();
        $editor->name = 'editor';
        $editor->display_name = 'Editor';
        $editor->save();

        $author = new Role();
        $author->name = 'author';
        $author->display_name = 'Author';
        $author->save();

        $users = User::all();
        foreach ($users as $user){

            if ($user->id < 4)
                $user->attachRole($admin);
            elseif ($user->id >= 4 && $user->id <7)
                $user->attachRole($editor);
            else
                $user->attachRole($author);

        }
    }
}
