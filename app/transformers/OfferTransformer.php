<?php

class OfferTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user'
    ];

    public function transform(\Offer $offer)
    {
        return [
            'id'        => intval($offer->id),
            'image'     => strlen($offer->image) > 0 ? url('images/' . $offer->image) : null,
            'message'   => $offer->comment,
            'accepted'  => boolval($offer->accepted),
            'createdAt' => $offer->created_at->formatLocalized('%d. %B %Y')
        ];
    }


    public function includeUser(\Offer $offer)
    {
        $oUser = $offer->user;
        return $this->item($oUser, new UserTransformer);
    }
}