<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class TheQualityOfAnItemIsNeverNegative implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        if ($item->quality < 0) {
            $item->quality = 0;
        }
    }
}
