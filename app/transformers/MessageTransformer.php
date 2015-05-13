<?php

class MessageTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes
        = [
            'fromUser',
            'toUser'
        ];

    public function transform(\Message $message)
    {
        return [
            'id'        => $message->id,
            'message'   => $message->message,
            'createdAt' => $message->created_at->formatLocalized('%d. %B %Y')
        ];
    }


    public function includeFromUser(\Message $message)
    {
        return $this->item($message->from_user, new UserTransformer);
    }

    public function includeToUser(\Message $message)
    {
        return $this->item($message->to_user, new UserTransformer);
    }
}