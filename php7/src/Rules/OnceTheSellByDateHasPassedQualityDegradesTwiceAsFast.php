<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class OnceTheSellByDateHasPassedQualityDegradesTwiceAsFast implements BusinessRule
{
    protected int $multiplier;

    public function __construct(int $multiplier = 1)
    {
        $this->multiplier = $multiplier;
    }

    public function updateQuality(Item $item): void
    {
        $item->quality -= 1 * $this->multiplier;

        if ($item->sell_in < 0) {
            $item->quality -= 1 * $this->multiplier;
        }
    }
}
