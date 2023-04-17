<?php

namespace App\Card;

use App\Card\Card;

// Class DeckOfCards represent the whole deck
class DeckOfCards
{
    private $deck = [];

    public function createDeck(Card $card): void
    {
        $suits = ['spades', 'hearts', 'diamonds', 'clovers'];
        $values = ['ace', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'jack', 'queen', 'king'];

        $className = get_class($card);

        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $card = new $className();
                $card->setSuit($suit);
                $card->setValue($value);
                $this->deck[] = $card;
            }
        }
    }

    public function getNumCards(): int
    {
        return count($this->deck);
    }

    public function getAsString(): array
    {
        $result = [];
        foreach ($this->deck as $card) {
            $result[] = $card->getAsString();
        }

        return $result;
    }

    public function shuffleDeck(): void
    {
        shuffle($this->deck);
    }

    public function drawCard(int $numDraws = 1): array
    {
        $draws = [];

        for ($i = 0; $i < $numDraws; $i++) {
            if (!empty($this->deck)) {
                $draws[] = array_pop($this->deck);
            } else {
                break;
            }
        }

        return $draws;
    }
}