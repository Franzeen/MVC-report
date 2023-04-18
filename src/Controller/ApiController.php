<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    #[Route("/api/quote", name: "api_quote")]
    public function quote(): JsonResponse
    {
        $quotes = [
            "We are the masters of the unsaid words, but slaves of those we let slip out.",
            "A gentleman does not have a ham sandwich without mustard.",
            "I always arrive late at the office, but I make up for it by leaving early",
            "Knowledge is knowing a tomato is a fruit; wisdom is not putting it in a fruit salad.",
            "He who laughs last didn’t get the joke."
        ];

        $randomNumber = rand(0, count($quotes) - 1);
        $quote = $quotes[$randomNumber];

        $data = [
            'quote' => $quote,
            'date' => date('Y-m-d'),
            'timestamp' => time()
        ];

        return new JsonResponse($data);
    }

    #[Route("api/deck", name: "api_deck")]
    public function APIshowDeck(): JsonResponse
    {
        $deck = new DeckOfCards();
        $deck->createDeck(new CardGraphic());

        $data = [
            'deck' => $deck->getAsString()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("api/deck/shuffle", name: "api_deck_shuffle", methods: ['POST'])]
    public function APIshuffleDeck(Request $request): JsonResponse
    {
        $session = $request->getSession();

        $deck = new DeckOfCards();
        $deck->createDeck(new CardGraphic());
        $deck->shuffleDeck();

        $session->set('deck', $deck);

        $data = [
            "shuffledDeck" => $deck->getAsString()
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("api/deck/draw/{num<\d+>}", name: "api_deck_draw", methods: ['POST'])]
    public function APIdrawCard(Request $request, int $num = 1): JsonResponse
    {
        $session = $request->getSession();

        if (!$session->has('deck')) {
            $deck = new DeckOfCards();
            $deck->createDeck(new CardGraphic());
            $deck->shuffleDeck();
            $session->set('deck', $deck);
        } else {
            $deck = $session->get('deck');
        }

        $drawCard = $deck->drawCard($num);

        $cardHand = new CardHand();

        foreach ($drawCard as $card) {
            $cardHand->add($card);
        }

        $session->set('deck', $deck);

        $remainingCards = $deck->getNumCards();

        $drawCardStrings = [];
        foreach ($drawCard as $card) {
            $drawCardStrings[] = $card->getAsString();
        }

        $data = [
            "drawCard" => $drawCardStrings,
            "cardLeft" => $remainingCards,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}