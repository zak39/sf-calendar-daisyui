<?php

namespace App\Service;

use App\Entity\Refuge;
use App\Repository\RefugeRepository;

class DateService {
    public function __construct(
        private RefugeRepository $repository
    )
    {
    }
    
    public function getDatesBlocked(): array {
        $refuges = $this->repository->findAll();
        $datesBlocked = array_map(function (Refuge $refuge) {
            $reservation = $refuge->getReservations()[0];
            return [
                'dateStart' => $reservation?->getDateStart(),
                'dateEnd' => $reservation?->getDateEnd(),
            ];
        }, $refuges);

            // Format the dates to match FullCalendar's expected format
        $datesBlocked = array_map(function ($dates) {
            $dates['start'] = $dates['dateStart']->format('F j, Y');
            $dates['end'] = $dates['dateEnd']->format('F j, Y');
            return $dates;
        }, $datesBlocked);

        return $datesBlocked;
    }
}
