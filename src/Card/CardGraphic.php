<?php

namespace App\Card;

// Class CardGraphic that handle graphic for the cards
class CardGraphic extends Card
{
    private $unicode = [
        'spades' => [
            'ace' => '&#x1F0A1;',
            '2' => '&#x1F0A2;',
            '3' => '&#x1F0A3;',
            '4' => '&#x1F0A4;',
            '5' => '&#x1F0A5;',
            '6' => '&#x1F0A6;',
            '7' => '&#x1F0A7;',
            '8' => '&#x1F0A8;',
            '9' => '&#x1F0A9;',
            '10' => '&#x1F0AA;',
            'jack' => '&#x1F0AB;',
            'queen' => '&#x1F0AD;',
            'king' => '&#x1F0AE;'
        ],
        'hearts' => [
            'ace' => '&#x1F0B1;',
            '2' => '&#x1F0B2;',
            '3' => '&#x1F0B3;',
            '4' => '&#x1F0B4;',
            '5' => '&#x1F0B5;',
            '6' => '&#x1F0B6;',
            '7' => '&#x1F0B7;',
            '8' => '&#x1F0B8;',
            '9' => '&#x1F0B9;',
            '10' => '&#x1F0BA;',
            'jack' => '&#x1F0BB;',
            'queen' => '&#x1F0BD;',
            'king' => '&#x1F0BE;'
        ],
        'diamonds' => [
            'ace' => '&#x1F0C1;',
            '2' => '&#x1F0C2;',
            '3' => '&#x1F0C3;',
            '4' => '&#x1F0C4;',
            '5' => '&#x1F0C5;',
            '6' => '&#x1F0C6;',
            '7' => '&#x1F0C7;',
            '8' => '&#x1F0C8;',
            '9' => '&#x1F0C9;',
            '10' => '&#x1F0CA;',
            'jack' => '&#x1F0CB;',
            'queen' => '&#x1F0CD;',
            'king' => '&#x1F0CE;'
        ],
        'clovers' => [
            'ace' => '&#x1F0D1;',
            '2' => '&#x1F0D2;',
            '3' => '&#x1F0D3;',
            '4' => '&#x1F0D4;',
            '5' => '&#x1F0D5;',
            '6' => '&#x1F0D6;',
            '7' => '&#x1F0D7;',
            '8' => '&#x1F0D8;',
            '9' => '&#x1F0D9;',
            '10' => '&#x1F0DA;',
            'jack' => '&#x1F0DB;',
            'queen' => '&#x1F0DD;',
            'king' => '&#x1F0DE;'
        ]
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function getAsString(): string
    {
        return html_entity_decode($this->unicode[$this->suit][$this->value], ENT_QUOTES, 'UTF-8');
    }
}