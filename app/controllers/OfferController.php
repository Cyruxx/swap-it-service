<?php

class OfferController extends BaseController
{

    public function __construct()
    {
        # Parse includes for user
        $oFractal = new League\Fractal\Manager;
        $oFractal->parseIncludes(Input::get('include', ''));
    }

    public function store($iSwapId)
    {
        Offer::create([
            'user_id'    => Input::get('userId'),
            'swap_id'    => $iSwapId,
            'comment'    => Input::get('message'),
            'accepted'   => false,
            'created_at' => \Carbon\Carbon::now()
        ]);

        return $this->response->collection(Offer::with('user')->where('swap_id', '=', $iSwapId)->orderBy('id', 'desc')->get(),
            new OfferTransformer);
    }

    public function accept($iOfferId)
    {
        Offer::where('swap_id', '=', Input::get('swapId'))->update(['accepted' => false]);

        # TODO - Message area

        Offer::find($iOfferId)->update(['accepted' => true]);

        return $this->response->collection(Offer::with('user')->where('swap_id', '=', Input::get('swapId'))->orderBy('accepted', 'desc')->orderBy('id', 'desc')->get(),
            new OfferTransformer);
    }

    public function removeAccept($iSwapId)
    {

        Offer::where('swap_id', '=', $iSwapId)->update(['accepted' => false]);

        return $this->response->collection(Offer::with('user')->where('swap_id', '=', $iSwapId)->orderBy('accepted', 'desc')->orderBy('id', 'desc')->get(),
            new OfferTransformer);
    }
}