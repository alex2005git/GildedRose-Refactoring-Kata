<?php

namespace App;

use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testThatOnceTheSellByDateHasPassedQualityDegradesTwiceAsFast(): void
    {
        $items = [new Item("foo", 0, 6)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(4, $items[0]->quality);

        $gildedRose->updateQuality();
        $this->assertEquals(2, $items[0]->quality);
    }

    public function testThatTheQualityOfAnItemIsNeverNegative(): void
    {
        $items = [new Item("foo", 0, 0)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testThatAgedBrieActuallyIncreasesInQualityTheOlderItGets(): void
    {
        $items = [new Item("Aged Brie", 1, 0)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(1, $items[0]->quality);
    }

    public function testThatTheQualityOfAnItemIsNeverMoreThan50(): void
    {
        $items = [new Item("Aged Brie", 1, 50)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->quality);

        $items = [new Item("Aged Brie", 0, 50)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $items[0]->quality);
    }

    public function testThatSulfurasBeingALegendaryItemNeverHasToBeSoldOrDecreasesInQuality(): void
    {
        $items = [new Item("Sulfuras, Hand of Ragnaros", 1, 1)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(1, $items[0]->sell_in);
        $this->assertEquals(1, $items[0]->quality);

        $items = [new Item("Sulfuras, Hand of Ragnaros", -1, 1)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(-1, $items[0]->sell_in);
        $this->assertEquals(1, $items[0]->quality);

        $items = [new Item("Sulfuras, Hand of Ragnaros", 1, 80)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(1, $items[0]->sell_in);
        $this->assertEquals(80, $items[0]->quality);
    }

    public function testThatBackstagePassesLikeAgedBrieIncreasesInQualityAsItsSellInValueApproaches(): void
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 11, 1)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(2, $items[0]->quality);

        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 10, 1)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(3, $items[0]->quality);

        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 6, 1)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(3, $items[0]->quality);

        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 5, 1)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(4, $items[0]->quality);

        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 0, 5)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $items[0]->quality);
    }

    public function testThatConjuredItemsDegradeInQualityTwiceAsFastAsNormalItems(): void
    {
        $items = [new Item("Conjured Mana Cake", 11, 6)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(4, $items[0]->quality);

        $items = [new Item("Conjured Mana Cake", 0, 6)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $this->assertEquals(2, $items[0]->quality);
    }
}
