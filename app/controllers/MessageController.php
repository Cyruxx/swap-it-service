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
                ->orderBy('id', 'asc')
                ->where('from_user_id', '=', Input::get('userId'))
                ->orWhere('to_user_id', '=', Input::get('userId'))
                ->get(),
            new MessageTransformer
        );
    }

    public function showByConversation($iConvId)
    {
        return $this->response->collection(
            Message::with('fromUser', 'toUser')
                ->orderBy('id', 'asc')
                ->where('conversation_id', '=', $iConvId)
                ->get(),
            new MessageTransformer
        );
    }

    public function store()
    {
        //TODO: create conversation
        $oMessage = Message::create([
            'from_user_id'    => Input::get('fromUserId'),
            'to_user_id'      => Input::get('toUserId'),
            'message'         => Input::get('message'),
            'conversation_id' => Input::get('conversationId'),
        ]);

        return $this->response->item($oMessage, new MessageTransformer);
    }
}