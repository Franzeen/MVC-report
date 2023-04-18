<?php

namespace App\Card;

// Class Card represent one card
class Card
{
    protected $value;
    protected $suit;

    public function __construct()
    {
        $this->value = null;
        $this->suit = null;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getAsString(): string
    {
        return $this->value . ' of ' . $this->suit;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setSuit(string $suit): void
    {
        $this->suit = $suit;
    }
}
