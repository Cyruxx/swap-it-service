<?php

class SwapTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user',
        'offers'
    ];

    public function transform(\Swap $swap)
    {
        $bAccepted       = false;
        $bAnyHasAccepted = false;
        foreach ($swap->offers as $oOffer) {
            if (!$bAnyHasAccepted && $oOffer->accepted) {
                $bAccepted       = true;
                $bAnyHasAccepted = true;
            }
        }

        return [
            'id'          => intval($swap->id),
            'description' => $swap->description,
            'image'       => strlen($swap->image) > 0 ? url('images/' . $swap->image) : null,
            'location'    => $swap->location,
            'accepted'    => boolval($bAccepted),
            'createdAt'   => $swap->created_at->formatLocalized('%d. %B %Y')
        ];
    }

    public function includeUser(\Swap $swap)
    {
        $oUser = $swap->user;
        return $this->item($oUser, new UserTransformer);
    }

    public function includeOffers(\Swap $swap)
    {
        $oOffers = $swap->offers;
        return $this->collection($oOffers, new OfferTransformer);
    }
}