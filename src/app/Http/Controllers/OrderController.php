<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\User;
use App\Services\Order\OrderRequestDto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function create(CreateOrderRequest $request)
    {
        $user = User::find(1); //todo authentication
        $dto = new OrderRequestDto($request->country, json_decode($request->products, 1));
        //$orderCreator = new OrderCreator($user, $d);
    }

}
