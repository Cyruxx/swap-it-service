<?php

class Message extends Eloquent {
    protected $table = 'messages';

    protected $guarded = [];

    public function fromUser()
    {
        return $this->hasOne('User', 'id', 'from_user_id');
    }

    public function toUser()
    {
        return $this->hasOne('User', 'id', 'to_user_id');
    }

    public function swap()
    {
        return $this->hasOne('Swap', 'id', 'swap_id');
    }
}