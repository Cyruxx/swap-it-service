<?php
class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Create the user
        $user = Sentry::createUser(array(
            'email'     => 'mahrt95@gmail.com',
            'password'  => 'test123',
            'first_name' => 'Alexander',
            'last_name' => 'Mahrt',
            'activated' => true,
        ));

        // Find the group using the group id
        $adminGroup = Sentry::findGroupById(1);

        // Assign the group to the user
        $user->addGroup($adminGroup);

        // Create the user
        $user = Sentry::createUser(array(
            'email'     => 'peterlustig@gmail.com',
            'password'  => 'test123',
            'first_name' => 'Peter',
            'last_name' => 'Lustig',
            'activated' => true,
        ));

        // Find the group using the group id
        $adminGroup = Sentry::findGroupById(3);

        // Assign the group to the user
        $user->addGroup($adminGroup);

    }
}