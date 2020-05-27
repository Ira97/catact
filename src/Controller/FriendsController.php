<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManager;

class FriendsController extends AbstractController
{
    /**
     * @Route("/friends", name="friends")
     */
    public function index()
    {
    	$friends = $this->getDoctrine()->getRepository(User::class)->findall();
        return $this->render('friends/index.html.twig', [
            'controller_name' => 'FriendsController', 'friends' => $friends
        ]);
    }
}
