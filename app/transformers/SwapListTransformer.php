<?php

class SwapListTransformer extends \League\Fractal\TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'user'
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
            'id'         => intval($swap->id),
            'teaser'     => str_limit($swap->description),
            'image'      => strlen($swap->image) > 0 ? url('images/' . $swap->image) : null,
            'location'   => $swap->location,
            'accepted'   => $bAccepted,
            'offerCount' => count($swap->offers),
            'createdAt'  => $swap->created_at->formatLocalized('%d. %B %Y')
        ];
    }

    public function includeUser(\Swap $swap)
    {
        $oUser = $swap->user;

        return $this->item($oUser, new UserTransformer);
    }
}