<?php

namespace Eckinox\TinymceBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TinymceType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options): void
	{
		// Default fields: latitude, longitude
		$builder
			->add($options['lat_name'], $options['type'], array_merge($options['options'], $options['lat_options']))
			->add($options['lng_name'], $options['type'], array_merge($options['options'], $options['lng_options']));
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			// 'type' => HiddenType::class,
		]);
	}

	/**
	 * @SuppressWarnings(PHPMD.UnusedFormalParameter)
	 */
	public function buildView(FormView $view, FormInterface $form, array $options): void
	{
		// $view->vars['api_key'] = $options['api_key'];
	}

	public function getParent(): string
	{
		return FormType::class;
	}

	public function getName(): string
	{
		return 'tinymce';
	}

	public function getBlockPrefix(): string
	{
		return 'tinymce';
	}
}
