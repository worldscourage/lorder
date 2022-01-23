<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Models\User;
use App\Services\Order\Documents\DocumentFactory;
use App\Services\Order\Mailing\Mailing;
use App\Services\Order\OrderCreator;
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
        $orderCreator = new OrderCreator($user, $dto);
        $orderCreator->createOrder();
        $order = $orderCreator->getOrder();
        $documentGenerator = (new DocumentFactory())->getOrderDocumentGenerator($request->invoiceFormat, $order);
        $document = $documentGenerator->generate();
        if ($request->sendEmail) {
            $mailing = new Mailing($request->email, $document);
            $mailing->dispatch();
        }
        return \response($document, 200);
    }

}
