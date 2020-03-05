<?php

namespace App;

use App\BusinessRulesGetter;

final class GildedRose
{
    /** @var Item[] */
    private $items;

    /** @var BusinessRulesGetter */
    private $businessRulesGetter;

    public function __construct(array $items, BusinessRulesGetter $businessRulesGetter = null) {
        $this->items = $items;
        $this->businessRulesGetter = $businessRulesGetter ?? new BusinessRulesGetter();
    }

    public function updateQuality() {
        foreach ($this->items as $item) {
            foreach ($this->businessRulesGetter->byName($item->name) as $businessRule) {
                $businessRule->updateQuality($item);
            }
        }
    }
}

