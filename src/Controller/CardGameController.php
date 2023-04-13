<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card_start")]
    public function home(): Response
    {
        $card = new CardGraphic();

        $data = [
            "card" => $card->draw(),
            "cardGraphic" => $card->getAsString(),
            "cardValue" => $card->getValue(),
            "cardSuit" => $card->getSuit()
        ];

        return $this->render('card/home.html.twig', $data);
    }

    #[Route("/card/deck", name: "deck")]
    public function showDeck(): Response
    {
        $deck = new DeckOfCards();
        $deck->createDeck(new CardGraphic());

        $data = [
            "cardDraw" => $deck->getAsString()
        ];

        return $this->render('card/deck.html.twig', $data);
    }





    #[Route("/card/test/deck", name: "test_deck")]
    public function testDeck(): Response
    {
        $deck = new DeckOfCards();
        $deck->createDeck(new Card());

        $data = [
            "num_cards" => $deck->getNumCards(),
            "cardDraw" => $deck->getAsString()
        ];

        return $this->render('card/test/deck.html.twig', $data);
    }


    #[Route("/card/test/deckhand/{num<\d+>}", name: "test_dicehand")]
    public function testDeckHand(int $num): Response
    {
        if ($num > 52) {
            throw new \Exception("There is not more than 52 cards in a deck.");
        }

        $hand = new CardHand();
        for ($i = 1; $i <= $num; $i++) {
            $hand->add(new CardGraphic());
        }

        $hand->draw();

        $data = [
            "num_cards" => $hand->getNumCards(),
            "cardDraw" => $hand->getAsString()
        ];

        return $this->render('card/test/cardhand.html.twig', $data);
    }


}