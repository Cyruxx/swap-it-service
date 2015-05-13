<?php

class Offer extends Eloquent {
    protected $table = 'offers';

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id');
    }
}