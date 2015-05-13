<?php
class GroupTableSeeder extends Seeder
{
    public function run()
    {
        // Create the group
        $groupAdmin = Sentry::createGroup(array(
            'name'        => 'Admin',
            'permissions' => array(
                'admin' => 1,
                'vip'   => 1,
                'users' => 1,
            ),
        ));
        // Create the group
        $groupVip = Sentry::createGroup(array(
            'name'        => 'VIP',
            'permissions' => array(
                'admin' => 0,
                'vip'   => 1,
                'users' => 1,
            ),
        ));
        // Create the group
        $group = Sentry::createGroup(array(
            'name'        => 'Benutzer',
            'permissions' => array(
                'admin' => 0,
                'vip'   => 0,
                'users' => 1,
            ),
        ));
    }
}