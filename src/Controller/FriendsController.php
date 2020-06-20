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
        $friends = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('friends/index.html.twig', [
            'controller_name' => 'FriendsController','friends' => $friends
        ]);
    }
    /**
     * @Route("/addFriends", name="addFriends" )
     */
   public function addFriends(Request $request): Response
   {
       $friend_id = $request->query->get('id');
       $user_id = $this->getUser()->getId();
       $entityManager = $this->getDoctrine()->getManager();
       $UserToFriends = new UserToFriends();
       $UserToFriends->setUser($user_id);
       $UserToFriends->setFriend($friend_id);
       // tell Doctrine you want to (eventually) save the Product (no queries yet)
       $entityManager->persist($UserToFriends);
       // actually executes the queries (i.e. the INSERT query)
       $entityManager->flush();
       $friends = $this->getDoctrine()->getRepository(User::class)->findAll();
       return $this->render('friends/index.html.twig', [
           'controller_name' => 'FriendsController','friends' => $friends
       ]);
       // нужно пререписать
   }
}

