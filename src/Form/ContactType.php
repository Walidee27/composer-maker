<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, [
                'label' => 'Votre Email'
            ])
            ->add('subject', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [
                'label' => 'Sujet'
            ])
            ->add('message', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class, [
                'label' => 'Message',
                'attr' => ['rows' => 5]
            ])
            ->add('captcha', \Gregwar\CaptchaBundle\Type\CaptchaType::class, [
                'label' => 'Code de sécurité',
                'width' => 200,
                'height' => 50,
                'length' => 6,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

        ]);
    }
}
