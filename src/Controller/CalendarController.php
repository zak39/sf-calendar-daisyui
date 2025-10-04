<?php

namespace App\Controller;

use App\Entity\Refuge;
use App\Form\RefugeType;
use App\Repository\RefugeRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
            ],
            [
                'start' => 'September 5, 2025',
                'end' => 'September 10, 2025',
            ],
            [
                'start' => 'September 15, 2025',
                'end' => 'September 20, 2025',
            ],
            [
                'start' => 'October 25, 2025',
                'end' => 'October 30, 2025',
            ],
            [
                'start' => 'October 9, 2025',
                'end' => 'October 10, 2025',
            ]
        ]);
    }

    #[Route('/refuges', name: 'app_refuge')]
    public function findRefuges(RefugeRepository $repository, EntityManagerInterface $em): Response
    {
        $refuges = $repository->findAll();

        if (empty($refuges)) {
            $refuge = new Refuge();
            $refuge
                ->setNom('Chalet des eaux')
                ->setAddress('au lac du boulevent')
                ->setDateStart(new DateTime('16 october 2025'))
                ->setDateEnd(new DateTime('19 october 2025'))
            ;

            $em->persist($refuge);
            $em->flush();
        }

        return $this->render('refuge/index.html.twig', [
            'refuges' => $refuges
        ]);
    }

    #[Route('/refuges/new', name: 'app_refuge_new')]
    public function newRefuge(Request $request, ?Refuge $refuge, EntityManagerInterface $em): Response
    {
        $refuge = new Refuge();

        $form = $this->createForm(RefugeType::class, $refuge);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($refuge);
            $em->flush();

            return $this->redirectToRoute('app_refuge');
        }

        return $this->render('refuge/new.html.twig', [
            'form' => $form
        ]);
    }
}
