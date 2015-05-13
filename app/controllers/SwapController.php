<?php
class SwapController extends BaseController {

    public function __construct()
    {
        # Parse includes for user
        $oFractal = new League\Fractal\Manager;
        $oFractal->parseIncludes(Input::get('include', ''));
    }

    public function index()
    {
        $oSwaps = Swap::with('user', 'offers')->orderBy('id', 'desc')->get();
        return $this->response->collection($oSwaps, new SwapListTransformer);
    }

    public function show($iSwapId)
    {
        $oSwap = Swap::with('user', 'offers', 'offers.user')->find($iSwapId);

        return $this->response->item($oSwap, new SwapTransformer);
    }

}