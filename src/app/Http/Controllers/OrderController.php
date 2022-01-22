<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use services\Order\OrderCreator;
use services\Order\OrderRequestDto;

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
        var_dump($request->country);
        var_dump($request->products);
        var_dump(json_encode([['cnd'=> 1, 'id' => 1]]));
        var_dump(json_decode($request->products, 1));
        exit;
        //$dto = new OrderRequestDto(, $request->)
        //$orderCreator = new OrderCreator($user, );
    }

}
