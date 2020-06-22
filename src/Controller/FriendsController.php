<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\UserToFriends;

class FriendsController extends AbstractController
{
    /**
     * @Route("/friends", name="friends")
     */
    public function index()
    {
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


        return $this->render('friends/index.html.twig', [
            'controller_name' => 'FriendsController', 'friends' => $friends,'user_authorized_id' => $user_authorized_id
        ]);


    }

    /**
     * @Route("/addFriends", name="addFriends" )
     */
    public function addFriends(Request $request): Response

    {
        $user_authorized_id = $this->getUser()->getId();

        $friends = $this->getDoctrine()->getRepository(User::class)->findAll();
        $users_to_friends = $this->getDoctrine()->getRepository(UserToFriends::class)->findAll();
// проверка есть ли в друзьях или нет при загрузке страницы
        foreach ($friends as $friend)
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
            // ДОбавление в друзья ( запись в бд)
            $friend_id = $request->query->get('id');
            $user_id = $this->getUser()->getId();
            $entityManager = $this->getDoctrine()->getManager();
            $UserToFriends = new UserToFriends();
            // добавление 1 записи где user - friend
            $UserToFriends->setUser($user_id);
            $UserToFriends->setFriend($friend_id);
            $entityManager->persist($UserToFriends);
            $entityManager->flush();
            // добавление 2 записи где friend- user
            $UserToFriends = new UserToFriends();
            $UserToFriends->setUser($friend_id);
            $UserToFriends->setFriend($user_id);
            $entityManager->persist($UserToFriends);
            $entityManager->flush();

            $friends = $this->getDoctrine()->getRepository(User::class)->findAll();
            return $this->render('friends/index.html.twig', [
                'controller_name' => 'FriendsController', 'friends' => $friends,'user_authorized_id' => $user_authorized_id
            ]);

        }
    }
}

