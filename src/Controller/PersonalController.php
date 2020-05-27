<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Entity\User;

class PersonalController extends AbstractController
{
    /**
     * @Route("/personal/{id}", name="personal")
     */
    public function index($id)
    {
        $doctrine = $this->getDoctrine();
    	$user = $doctrine->getRepository(User::class)->find($id);       
        return $this->render('personal/index.html.twig', [
            'controller_name' => 'PersonalController', 'user' => $user
        ]);
    }
}
