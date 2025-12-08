<?php

namespace App\Validator;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class DateAvailabilityValidator extends ConstraintValidator
{
    public function __construct(
        private ReservationRepository $reservationRepository
    )
    {
    }

    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var DateAvailability $constraint */
        if (null === $value || '' === $value) {
            return;
        }

        if (!$value instanceof ArrayCollection) {
            return;
        }

        if (!$value[0] instanceof Reservation) {
            throw new UnexpectedValueException($value, Reservation::class);
        }

        $reservation = $value[0];

        $dateStart = $reservation->getDateStart();
        $dateEnd = $reservation->getDateEnd();

        $isAvailable = $this->reservationRepository->rangeDateAvailable($dateStart, $dateEnd);

        $datesBlocked = $this->reservationRepository->getReservationsBlocked($dateStart, $dateEnd);

        $datesBlocked = array_map(fn ($date) => [ 'start' => $date->getDateStart()->format('d F Y'), 'end' => $date->getDateEnd()->format('d F Y') ], $datesBlocked);
        $datesBlocked = array_map(fn ($date) => "- between $date[start] and $date[end]", $datesBlocked);
        $datesBlocked = implode("\n", $datesBlocked);
        $message = $constraint->message;
        $message .= "\n\nThese dates are not possible:\n\n$datesBlocked";


        if ($isAvailable) {
            return;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($message)
            ->setParameter('{{ start }}', $dateStart->format('d F Y'))
            ->setParameter('{{ end }}', $dateEnd->format('d F Y'))
            ->atPath('[0].dateStart')
            ->addViolation()
        ;
    }
}
