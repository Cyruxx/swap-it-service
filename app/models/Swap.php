<?php

class Swap extends Eloquent {
    protected $table = 'swaps';

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }

    public function offers()
    {
        return $this->hasMany('Offer')->orderBy('accepted', 'desc')->orderBy('id', 'desc');
    }
}