<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class DecreaseSellIn implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        $item->sell_in--;
    }
}
