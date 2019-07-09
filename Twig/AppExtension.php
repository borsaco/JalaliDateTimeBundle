<?php

namespace Borsaco\JalaliDateTimeBundle\Twig;

use Borsaco\jalaliDateTime\JDateTime;

class AppExtension extends \Twig_Extension
{
	const DEFAULT_INTERVAL_FORMAT = '%d روز';
	const DEFAULT_DATE_FORMAT = 'l, d M Y H:i:s O';

	private $jalaliDate;

	public function __construct()
	{
		$this->jalaliDate = new JDateTime(true, true , 'Asia/Tehran');
	}

	public function getFilters()
	{
		return array(
			new \Twig_SimpleFilter( 'jalali_date', array( $this, 'jalaliDateFilter' ) ),
		);
	}

	public function jalaliDateFilter( $date, $format = null, $timezone = null )
	{
		if ( null === $format )
		{
			$format = $date instanceof \DateInterval ? self::DEFAULT_INTERVAL_FORMAT : self::DEFAULT_DATE_FORMAT;
		}

		if ( $date instanceof \DateInterval )
		{
			return $date->format( $format );
		}

		return $this->jalaliDateConverter( $date, $format, $timezone );
	}

	public function jalaliDateConverter( $date, $format, $timezone )
	{
		if ( false !== $timezone )
		{
			if ( null === $timezone )
			{
				$timezone = new \DateTimeZone( date_default_timezone_get() );
			}
			elseif ( ! $timezone instanceof \DateTimeZone )
			{
				$timezone = new \DateTimeZone( $timezone );
			}
		}

		if ( $date instanceof \DateTimeImmutable )
		{
			if ( false !== $timezone )
			{
				$date->setTimezone( $timezone );
			}

			return $this->jalaliDate->date( $format, $date->getTimestamp(), true, true );
		}

		if ( $date instanceof \DateTime || $date instanceof \DateTimeInterface )
		{
			$date = clone $date;
			if ( false !== $timezone )
			{
				$date->setTimezone( $timezone );
			}

			return $this->jalaliDate->date( $format, $date->getTimestamp(), true, true );
		}

		$date = new \DateTime( $date, $timezone );
		if ( false !== $timezone )
		{
			$date->setTimezone( $timezone );
		}

		return $this->jalaliDate->date( $format, $date->getTimestamp(), true, true );
	}

	public function getName()
	{
		return 'jalali_date_extension';
	}
}
