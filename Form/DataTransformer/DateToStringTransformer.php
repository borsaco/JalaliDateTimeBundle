<?php

namespace Borsaco\JalaliDateTimeBundle\Form\DataTransformer;

use Borsaco\JalaliDateTimeBundle\Service\JalaliDateTime;
use Symfony\Component\Form\DataTransformerInterface;

class DateToStringTransformer implements DataTransformerInterface
{
    private $jalaliDateTime;

    public function __construct()
    {
        $this->jalaliDateTime = new JalaliDateTime();
    }

    public function transform( $date )
    {
        if(empty($date)){
            return '';
        }

        $date = $this->changeNumbers($date);

        return $this->jalaliDateTime->date('Y/m/d',strtotime($date));
    }

    public function reverseTransform( $date )
    {
        if(empty($date)){
            return '';
        }

        $date = $this->changeNumbers($date);

        # jalali
        list($year, $month, $day) = explode('/', $date);

        # gregorian
        list($year, $month, $day) = $this->jalaliDateTime->toGregorian($year, $month, $day);

        $month = sprintf("%02d", $month);
        $day = sprintf("%02d", $day);

        return "$year-$month-$day";
    }

    private function changeNumbers($string)
    {
        return str_replace(
            ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'],
            [0, 1, 2, 3 ,4 ,5 ,6 ,7 ,8 ,9],
            $string
        );
    }
}
