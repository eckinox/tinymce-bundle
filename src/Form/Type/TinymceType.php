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
	/**
	 * @param array<string,string> $defaultAttributes
	 */
	public function __construct(
		private array $defaultAttributes = []
	)
	{
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$attributes = [
			'plugins' => "advlist autolink link image media table lists",
			'menubar' => "false",
			'toolbar' => "bold italic underline | bullist numlist | table quickimage link",
			'height' => "12em",
			'images_upload_credentials' => "true",
		];

		$resolver->setDefaults([
			'attr' => array_merge($attributes, $this->defaultAttributes)
		]);
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
