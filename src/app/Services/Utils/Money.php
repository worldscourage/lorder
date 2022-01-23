<?php

namespace App\Services\Utils;

class Money
{
    protected string $currency;
    protected float $amount = 0;

    public function __construct(
        string $currency,
        float $amount = 0
    ) {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function addFrom(self $money): self
    {
        if ($this->currency !== $money->currency) {
            throw new \LogicException("cannot add different currencies");
        }
        $this->amount += $money->amount;
        return $this;
    }

    public function times(float $times): self
    {
        $this->amount *= $times;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return float|int
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

}
