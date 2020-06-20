<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
class PersonalController extends AbstractController
{
    /**
     * @Route("/personal/{id}", name="personal")
     */
    public function showuser($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        if (!$user) {
            throw $this->createNotFoundException(
                'No product found for id ' . $id); //нужен редирект на 404
        }
        return $this->render('personal/index.html.twig', [
            'controller_name' => 'PersonalController', 'user' => $user]);
            }
}
