<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    #[Route("/", name: "home")]
    public function me(): Response
    {
        $name = "Adam Franzén";
        $image = "img/adam_250.jpg";

        $data = [
            'name' => $name,
            'image' => $image
        ];

        return $this->render('home.html.twig', $data);
    }

    #[Route("/about", name: "about")]
    public function about(): Response
    {
        $gitCourse = "https://github.com/dbwebb-se/mvc";
        $gitMe = "https://github.com/Franzeen/mvc-report";
        $image = "img/symfony.jpg";

        $data = [
            'gitCourse' => $gitCourse,
            'gitMe' => $gitMe,
            'image' => $image
        ];

        return $this->render('about.html.twig', $data);
    }

    #[Route("/report/{kmom}", name: "report_kmom")]
    public function reportKmom(string $kmom): Response
    {
        return $this->render('report.html.twig#kmom'.$kmom);
    }


    #[Route("/report", name: "report")]
    public function report(): Response
    {
        return $this->render('report.html.twig');
    }

    #[Route("/lucky", name: "lucky")]
    public function lucky(): Response
    {
        $luckyNumber = random_int(0, 100);

        $randomNumber = rand(1, 4);
        $image = "img/yawn" . $randomNumber . ".jpg";

        $data= [
            'luckyNumber' => $luckyNumber,
            'image' => $image
        ];

        return $this->render('lucky.html.twig', $data);
    }

    #[Route("/api", name: "api_landing")]
    public function home(): Response
    {
        return $this->render('api/home.html.twig');
    }
}
