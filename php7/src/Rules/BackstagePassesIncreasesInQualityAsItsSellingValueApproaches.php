<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class BackstagePassesIncreasesInQualityAsItsSellingValueApproaches implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        if ($item->name !== 'Backstage passes to a TAFKAL80ETC concert') {
            throw new \Exception('Not Backstage passes to a TAFKAL80ETC concert');
        }

        if ($item->sell_in < 0) {
            $item->quality = 0;
            return;
        }

        $item->quality++;

        if ($item->sell_in >= 11) {
            return;
        }

        $item->quality++;

        if ($item->sell_in >= 6) {
            return;
        }

        $item->quality++;
    }
}
