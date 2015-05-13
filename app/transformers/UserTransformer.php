<?php

class UserTransformer extends \League\Fractal\TransformerAbstract
{
    public function transform(\User $user)
    {
        return [
            'id'        => intval($user->id),
            'name'      => $user->getFullName(),
            'group'     => $user->getGroups()[0],
            'createdAt' => $user->created_at->formatLocalized('%d. %B %Y')
        ];
    }
}