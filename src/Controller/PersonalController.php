<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserToFriends;
use App\Form\PictureFormType;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonalController extends AbstractController
{
    /**
     * @Route("/personal/{id}", name="personal")
     */
    public function showuser($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id); //нужен редирект на 404
        }
// Проверка есть ли другах
        $user_authorized_id = $this->getUser()->getId();

        $friends = $this->getDoctrine()->getRepository(User::class)->findAll();
        $users_to_friends = $this->getDoctrine()->getRepository(UserToFriends::class)->findAll();

        foreach ($friends as $friend) // проверка есть ли в друзьях или нет при загрузке страницы
        {
            $friend_id = $friend->getId();
            foreach ($users_to_friends as $user_to_friend) {
                if ($user_authorized_id == $user_to_friend->getUser() && $friend_id == $user_to_friend->getFriend()) {
                    $friend->setIsFriend(true);
                    break;
                } else {
                    $friend->setIsFriend(false);
                }

            }
        }

// обновление картинки
            $user_authorized_id = $this->getUser()->getId();
            $user_id = $user->getId();

            $form = $this->createForm(PictureFormType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // encode the plain password

                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $user->getPicture();
                $fileName = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $file->move(
                    $this->getParameter('pictures_directory'),
                    $fileName
                );
                $user->setPicture($fileName);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();


            }


            return $this->render('personal/index.html.twig', [
                'controller_name' => 'PersonalController', 'user' => $user, 'PictureForm' => $form->createView(), 'user_authorized_id' => $user_authorized_id]);


        }


        /**
         * @return string
         */
        private
        function generateUniqueFileName()
        {
            //добавляем метод генерации имени файла
            // md5() уменьшает схожесть имён файлов, сгенерированных
            // uniqid(), которые основанный на временных отметках
            return md5(uniqid());
        }
    }

