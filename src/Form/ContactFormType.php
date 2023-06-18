<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Neved:',
                'constraints' => [
                    new notBlank([
                        'message' => 'Kérjük töltse ki a mezőt.'
                    ]),
                    // new Length([
                    //     'min' => 3,
                    //     'minMessage' => 'Minimum 3 karakter szükséges.'
                    // ]),
                ],
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'E-mail címed',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Üzenet szövege:',
                // 'attr' => array('style' => 'width: 200px; height: 200px'),
                'constraints' => [
                    new notBlank([
                        'message' => 'Kérjük töltse ki a mezőt.'
                    ]),  
                ],
                'required' => false,


            ])
            ->add('Submit', SubmitType::class, [
                'label' => 'Küldés',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
