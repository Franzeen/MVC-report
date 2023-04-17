<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiController
{
    #[Route("/api/quote", name: "api_quote")]
    public function quote(): Response
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
}