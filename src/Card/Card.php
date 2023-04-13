<?php

namespace app\Card;

// Klassen Card som representerar ett kort
class Card {
    protected $value;
    protected $suit;

    public function __construct()
    {
        $this->value = null;
        $this->suit = null;
    }

    public function draw(): array
    {
        $suits = array('hearts', 'diamonds', 'clovers', 'spades');
        $values = array('ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'jack', 'queen', 'king');
        
        $this->suit = $suits[array_rand($suits)];
        $this->value = $values[array_rand($values)];

        return array(
            'value' => $this->value,
            'suit' => $this->suit
        );
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
}