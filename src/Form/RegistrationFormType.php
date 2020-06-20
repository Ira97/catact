<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
//добавляем новый тип для файлов
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\City;
use App\Entity\Gender;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login',TextType::class,[
                'label'  => 'Логин',
            ])
         ->add('city',EntityType::class,[
             'label'  => 'Город',
             'class' => city::class,
             'choice_label' => 'name_city',
             'choice_value' => function (City $city= null) {
                 return $city ? $city->getId() : '';}

           ])
            ->add('name',TextType::class,[
                'label'  => 'Имя',
            ])
            ->add('Birthday',DateType::class,[
                'label'  => 'Дата рождения',
            ])
            ->add('gender',EntityType::class,[
                'label'  => 'Пол',
                'class' => gender::class,
                'choice_label' => 'name_gender',
            ])
            //добавляем изображение на форму
            ->add('Picture',FileType::class,[
                'label'  => 'Изображение профиля'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label'  => 'Согласиться с условиями',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label'  => 'Пароль',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
