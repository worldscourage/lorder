<?php

namespace App\Services\Order;

use App\Models\User;

class OrderCreator
{
    protected User $user;
    protected OrderRequestDto $requestDto;

    public function __construct(
        User $user,
        OrderRequestDto $requestDto
    ) {
        $this->user = $user;
        $this->requestDto = $requestDto;
    }
}
