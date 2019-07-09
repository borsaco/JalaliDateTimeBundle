<?php

namespace Borsaco\JalaliDateTimeBundle\Form\DataTransformer;

use Borsaco\JalaliDateTimeBundle\Service\JalaliDateTime;
use Symfony\Component\Form\DataTransformerInterface;

class DateTimeToStringTransformer implements DataTransformerInterface
{
    private $jalaliDateTime;

    public function __construct()
    {
        $this->jalaliDateTime = new JalaliDateTime();
    }

    public function transform( $dateTime )
    {
        if(empty($dateTime)){
            return '';
        }

        $dateTime = $this->changeNumbers($dateTime);

        try {

            return $this->jalaliDateTime->date('Y/m/d H:i:s', strtotime($dateTime));
        }
        catch (\Exception $exception){
            return null;
        }
    }

    public function reverseTransform( $dateTime )
    {
        if(empty($dateTime)){
            return '';
        }

        $dateTime = $this->changeNumbers($dateTime);

        try{
            $date = explode(' ', $dateTime)[0];
            $time = explode(' ', $dateTime)[1];

            # jalali
            list($year, $month, $day) = explode('/', $date);
            list($hour, $minute) = explode(':', $time);


            $month = sprintf("%02d", $month);
            $day = sprintf("%02d", $day);

            # gregorian
            list($year, $month, $day) = $this->jalaliDateTime->toGregorian($year, $month, $day);

            return "$year-$month-$day $hour:$minute";
        } catch (\Exception $exception){
            return null;
        }
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
