<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class TheQualityOfAnItemIsNeverMoreThan50 implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        if ($item->quality > 50) {
            $item->quality = 50;
        }
    }
}
