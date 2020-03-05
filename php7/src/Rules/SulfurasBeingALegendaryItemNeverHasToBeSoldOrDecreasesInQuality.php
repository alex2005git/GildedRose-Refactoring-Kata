<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class SulfurasBeingALegendaryItemNeverHasToBeSoldOrDecreasesInQuality implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        if ($item->name !== 'Sulfuras, Hand of Ragnaros') {
            throw new \Exception('Not Sulfuras, Hand of Ragnaros');
        }
    }
}
