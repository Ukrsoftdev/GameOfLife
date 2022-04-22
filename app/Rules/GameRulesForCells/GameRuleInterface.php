<?php

namespace App\Rules\GameRulesForCells;

interface GameRuleInterface
{
    public function validate(): bool;

    public static function getNewStatus(): int;
}
