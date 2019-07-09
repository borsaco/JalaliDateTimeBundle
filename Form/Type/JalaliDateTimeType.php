<?php

namespace Borsaco\JalaliDateTimeBundle\Form\Type;

use Borsaco\JalaliDateTimeBundle\Form\DataTransformer\DateTimeToStringTransformer;
use Borsaco\JalaliDateTimeBundle\Service\JalaliDateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\ReversedTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JalaliDateTimeType extends AbstractType
{
	private $jalaliDatetime;

	public function __construct()
	{
		$this->jalaliDatetime = new JalaliDateTime();
	}

	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->addViewTransformer(new DateTimeToStringTransformer());
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'widget' => 'single_text',
			'format' => 'yyyy-MM-dd HH:mm',
		]);
	}

	public function getParent()
	{
		return DateTimeType::class;
	}
}
