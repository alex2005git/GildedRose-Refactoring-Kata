<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class BackstagePassesQualityDropsTo0AfterTheConcert implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
            throw new \Exception('Not Backstage passes to a TAFKAL80ETC concert');
        }

        if ($item->sell_in >= 0) {
            return;
        }

        $item->quality = 0;
    }
}
