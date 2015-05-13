<?php

class Conversation extends Eloquent {
    protected $table = 'conversations';

    protected $guarded = [];

    public function swap()
    {
        return $this->hasOne('Swap', 'id', 'swap_id');
    }

    public function messages()
    {
        return $this->hasMany('Message', 'conversation_id', 'id');
    }
}