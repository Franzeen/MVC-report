<?php

namespace App\Card;

use App\Card\Card;

// Class CardHand represent a hand of cards
class CardHand
{
    private $hand = [];

    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    public function getNumCards(): int
    {
        return count($this->hand);
    }

    public function getAsString(): array
    {
        $result = [];
        foreach ($this->hand as $card) {
            $result[] = $card->getAsString();
        }

        return $result;
    }
}