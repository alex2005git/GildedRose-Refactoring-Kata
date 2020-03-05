<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

class ConjuredItemsDegradeInQualityTwiceAsFastAsNormalItems implements BusinessRule
{
    public function updateQuality(Item $item): void
    {
        if ($item->name !== 'Conjured Mana Cake') {
            throw new \Exception('Not Conjured Mana Cake');
        }

        $rule = new OnceTheSellByDateHasPassedQualityDegradesTwiceAsFast(2);
        $rule->updateQuality($item);
    }
}
