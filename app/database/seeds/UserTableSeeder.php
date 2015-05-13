<?php
class UserTableSeeder extends Seeder
{
    public function run()
    {
        // Create the user
        $user = Sentry::createUser(array(
            'email'     => 'mahrt95@gmail.com',
            'password'  => 'test123',
            'activated' => true,
        ));

        // Find the group using the group id
        $adminGroup = Sentry::findGroupById(1);

        // Assign the group to the user
        $user->addGroup($adminGroup);
    }
}