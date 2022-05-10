<?php

namespace Eckinox\TinymceBundle\Form\Type;

use Eckinox\TinymceBundle\Util\TinymceConfigurator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TinymceType extends AbstractType
{
	public function __construct(
		private TinymceConfigurator $tinyMceConfigurator
	)
	{
	}

	public function configureOptions(OptionsResolver $resolver): void
	{
		$resolver->setDefaults([
			'compound' => false,
			'attr' => $this->tinyMceConfigurator->getGlobalAttributes()
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
