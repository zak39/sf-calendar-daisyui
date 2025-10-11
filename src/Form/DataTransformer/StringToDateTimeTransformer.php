<?php

namespace App\Form\DataTransformer;

use App\Entity\Reservation;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;

class StringToDateTimeTransformer implements DataTransformerInterface
{
    public function transform(mixed $value): mixed
    {
        // Transform the DateTime object to a string (e.g., 'Y-m-d' format)

        if ($value instanceof \DateTime) {
            return $value->format('Y-m-d');
        }

        return $value;
    }

    public function reverseTransform(mixed $value): mixed
    {
        // Transform the string back to a DateTime object
        if (is_string($value)) {
            return new \DateTime($value);
        }

        return $value;
    }
}
