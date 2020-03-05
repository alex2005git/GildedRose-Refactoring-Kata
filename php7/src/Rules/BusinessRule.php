<?php

declare(strict_types=1);

namespace App\Rules;

use App\Item;

interface BusinessRule
{
    public function updateQuality(Item $item): void;
}
