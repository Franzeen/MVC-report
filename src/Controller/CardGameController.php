<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardGraphic;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardGameController extends AbstractController
{
    #[Route("/card", name: "card_start")]
    public function home(): Response
    {
        $image_card = "img/cards.jpg";
        $image_UML = "img/UMLclass.png";

        $data = [
            'imageCard' => $image_card,
            'imageUML' => $image_UML,
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

    #[Route("/card/deck/shuffle", name: "deck_shuffle")]
    public function shuffleDeck(Request $request): Response
    {
        $session = $request->getSession();

        $deck = new DeckOfCards();
        $deck->createDeck(new CardGraphic());
        $deck->shuffleDeck();

        $session->set('deck', $deck);

        $data = [
            "shuffledDeck" => $deck->getAsString()
        ];

        return $this->render('card/deck_shuffle.html.twig', $data);
    }

    #[Route("/card/deck/draw/{num<\d+>}", name: "deck_draw", methods: ['GET'])]
    public function drawCard(Request $request, int $num = 1): Response
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

        // Save the updated deck to the session
        $session->set('deck', $deck);

        // Remaning cards
        $remainingCards = $deck->getNumCards();


        $drawCardStrings = [];
        foreach ($drawCard as $card) {
            $drawCardStrings[] = $card->getAsString();
        }

        $data = [
            "drawCard" => $drawCardStrings,
            "cardLeft" => $remainingCards,
        ];

        return $this->render('card/deck_draw.html.twig', $data);
    }
}
