<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CalendarController extends AbstractController
{
    #[Route('/', name: 'app_calendar')]
    public function index(): Response
    {
        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }

    #[Route('/dates-blocked', name: 'app_calendar_dates_blocked')]
    public function datesBlocked(): Response
    {
        return new JsonResponse([
            [
                'start' => 'August 1, 2025',
                'end' => 'August 14, 2025',
            ],
            [
                'start' => 'August 17, 2025',
                'end' => 'August 19, 2025',
            ]            
        ]);
    }
}
