<?php

class MessageController extends BaseController
{

    public function __construct()
    {
        # Parse includes for user
        $oFractal = new League\Fractal\Manager;
        $oFractal->parseIncludes(Input::get('include', ''));
    }

    public function index()
    {
        return $this->response->collection(
            Message::with('fromUser', 'toUser')
                ->orderBy('id', 'desc')
                ->where('from_user_id', '=', Input::get('userId'))
                ->orWhere('to_user_id', '=', Input::get('userId'))
                ->get(),
            new MessageTransformer
        );
    }
}