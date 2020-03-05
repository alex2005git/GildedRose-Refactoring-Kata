<?php

declare(strict_types=1);

namespace App;

use App\Rules\BackstagePassesIncreasesInQualityAsItsSellingValueApproaches;
use App\Rules\BackstagePassesQualityDropsTo0AfterTheConcert;
use App\Rules\ConjuredItemsDegradeInQualityTwiceAsFastAsNormalItems;
use App\Rules\DecreaseSellIn;
use App\Rules\IncreasesInQualityTheOlderItGets;
use App\Rules\OnceTheSellByDateHasPassedQualityDegradesTwiceAsFast;
use App\Rules\SulfurasBeingALegendaryItemNeverHasToBeSoldOrDecreasesInQuality;
use App\Rules\TheQualityOfAnItemIsNeverMoreThan50;
use App\Rules\TheQualityOfAnItemIsNeverNegative;

class BusinessRulesGetter
{
    protected const BUSINESS_RULES_ORDER = [
        -10 => BackstagePassesIncreasesInQualityAsItsSellingValueApproaches::class,
        0 => DecreaseSellIn::class,
        1 => SulfurasBeingALegendaryItemNeverHasToBeSoldOrDecreasesInQuality::class,
        5 => ConjuredItemsDegradeInQualityTwiceAsFastAsNormalItems::class,
        10 => IncreasesInQualityTheOlderItGets::class,
        11 => BackstagePassesQualityDropsTo0AfterTheConcert::class,
        15 => OnceTheSellByDateHasPassedQualityDegradesTwiceAsFast::class,
        50 => TheQualityOfAnItemIsNeverNegative::class,
        51 => TheQualityOfAnItemIsNeverMoreThan50::class,
    ];

    /**
     * @return BusinessRule[]
     */
    public function byName(string $itemName): \Generator
    {
        switch ($itemName) {
            default:
                $businessRules = $this->default();
                break;

            case 'Aged Brie':
                $businessRules = $this->agedBrie();
                break;

            case 'Sulfuras, Hand of Ragnaros':
                $businessRules = $this->sulfuras();
                break;

            case 'Backstage passes to a TAFKAL80ETC concert':
                $businessRules = $this->backstageConcert();
                break;

            case 'Conjured Mana Cake':
                $businessRules = $this->conjured();
                break;
        }

        // append these business rules for all
        $businessRules = array_merge(
            $businessRules,
            [
                new TheQualityOfAnItemIsNeverNegative(),
            ]
        );

        // yield the business rules while maintaining the right order
        foreach (static::BUSINESS_RULES_ORDER as $businessRuleClass) {
            foreach ($businessRules as $businessRule) {
                if (!($businessRule instanceof $businessRuleClass)) {
                    continue;
                }

                yield $businessRule;
            }
        }
    }

    protected function default(): array
    {
        return [
            new DecreaseSellIn(),
            new OnceTheSellByDateHasPassedQualityDegradesTwiceAsFast(),
            new TheQualityOfAnItemIsNeverMoreThan50(),
        ];
    }

    protected function agedBrie(): array
    {
        return [
            new DecreaseSellIn(),
            new IncreasesInQualityTheOlderItGets(),
            new TheQualityOfAnItemIsNeverMoreThan50(),
        ];
    }

    protected function sulfuras(): array
    {
        return [
            new SulfurasBeingALegendaryItemNeverHasToBeSoldOrDecreasesInQuality(),
        ];
    }

    protected function backstageConcert(): array
    {
        return [
            new BackstagePassesIncreasesInQualityAsItsSellingValueApproaches(),
            new DecreaseSellIn(),
            new BackstagePassesQualityDropsTo0AfterTheConcert(),
            new IncreasesInQualityTheOlderItGets(),
            new OnceTheSellByDateHasPassedQualityDegradesTwiceAsFast(),
            new TheQualityOfAnItemIsNeverMoreThan50(),
        ];
    }

    protected function conjured(): array
    {
        return [
            new DecreaseSellIn(),
            new ConjuredItemsDegradeInQualityTwiceAsFastAsNormalItems(),
            new TheQualityOfAnItemIsNeverMoreThan50(),
        ];
    }
}
