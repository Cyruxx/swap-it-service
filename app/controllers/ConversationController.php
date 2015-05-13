<?php

class ConversationController extends BaseController
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
            Conversation::with(['messages' => function($oQuery) {
                $oQuery->where('from_user_id', '=', Input::get('userId'))
                    ->orWhere('to_user_id', '=', Input::get('userId'))
                    ->orderBy('id', 'desc');
            }, 'messages.fromUser', 'messages.toUser', 'swap'])
                ->orderBy('id', 'desc')
                ->get(),
            new ConversationTransformer
        );
    }
}