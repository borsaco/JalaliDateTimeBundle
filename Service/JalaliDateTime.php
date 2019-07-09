<?php

namespace Borsaco\JalaliDateTimeBundle\Service;

use Borsaco\jalaliDateTime\JDateTime;

class JalaliDateTime {

	private $jalaliDateTime;

	public function __construct() {
		$this->jalaliDateTime = new JDateTime(true, true, 'Asia/Tehran' );
	}

	public function date($format = 'YYYY-MM-DD HH:MM:SS', $stamp = false, $convert = null, $jalali = null, $timezone = null)
	{
		return $this->jalaliDateTime::date($format, $stamp, $convert, $jalali, $timezone);
	}
	
	public function getDate($timestamp = null)
	{
		return $this->jalaliDateTime::getdate($timestamp);
	}
	
	public function checkDate($month, $day, $year, $jalali = null)
	{
		return $this->jalaliDateTime::checkdate($month, $day, $year, $jalali);
	}
	
	public function convertFormatToFormat($jalaliFormat, $georgianFormat, $timeString, $timezone=null)
	{
		return $this->jalaliDateTime::convertFormatToFormat($jalaliFormat, $georgianFormat, $timeString, $timezone);
	}
	
	public function gDate($format, $stamp = false, $timezone = null)
	{
		return $this->jalaliDateTime::gDate($format, $stamp, $timezone);
	}
	
	public function makeTime($hour, $minute, $second, $month, $day, $year, $jalali = null, $timezone = null)
	{
		return $this->jalaliDateTime::mktime($hour, $minute, $second, $month, $day, $year, $jalali, $timezone);
	}
	
	public function strFormatTrim($format, $stamp = false, $convert = null, $jalali = null, $timezone = null)
	{
		return $this->jalaliDateTime::strftime($format, $stamp, $convert, $jalali, $timezone);
	}
	
	public function toGregorian($jalali_year, $jalali_month, $jalali_day)
	{
		return $this->jalaliDateTime::toGregorian($jalali_year, $jalali_month, $jalali_day);
	}
	
	public function toJalali($gregorian_year, $gregorian_month, $gregorian_day)
	{
		return $this->jalaliDateTime::toJalali($gregorian_year, $gregorian_month, $gregorian_day);
	}
}
