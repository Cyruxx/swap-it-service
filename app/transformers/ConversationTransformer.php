<?php

class ConversationTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes
        = [
            'messages',
            'swap'
        ];

    public function transform(\Conversation $conversation)
    {
        return [
            'id'        => $conversation->id,
            'subject'   => $conversation->subject,
            'createdAt' => $conversation->created_at->formatLocalized('%d. %B %Y')
        ];
    }

    public function includeMessages(\Conversation $conversation)
    {
        return $this->collection($conversation->messages, new MessageTransformer);
    }

    public function includeSwap(\Conversation $conversation)
    {
        return $this->item($conversation->swap, new SwapTransformer);
    }
}