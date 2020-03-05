<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class IncreasesInQualityTheOlderItGets implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        if ($item->name !== 'Aged Brie' && $item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
            throw new \Exception('Invalid item name');
        }

        $item->quality++;
    }
}
