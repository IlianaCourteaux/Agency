<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_users')]
    public function index(ManagerRegistry $manager): Response
    {
        return $this->render('user/index.html.twig', [
            'userList' => $manager->getRepository(User::class)->findAll()
        ]);
    }

    #[Route('/user/add', name: 'add_user', methods: ['GET', 'POST'])]
    public function add(ManagerRegistry $manager, Request $request): Response
    {
        $user = new User;
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $om = $manager->getManager();
            $om->persist($user);
            $om->flush();
            $this->addFlash('success', 'New user added to the list');

            return $this->redirectToRoute('app_users');
        }
        return $this->renderForm('user/add.html.twig', ['form' => $form]);
    }

    #[Route('/user/{id}/update', name:'update_user', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function update(int $id, ManagerRegistry $manager, request $request): Response
    {
        $user = $manager->getRepository(User::class)->find($id);

        if($user){
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $om = $manager->getManager();
                $om->persist($user);
                $om->flush();
                $this->addFlash('success', 'User updated successfully');

                return $this->redirectToRoute('app_users');
            }
            
            return $this->renderForm('user/update.html.twig', [
                'form' => $form
            ]);

        } else {

            $this->addFlash('danger', 'User not found');

            return $this->redirectToRoute('app_users');
        }
    }

    #[Route('user/{id}/delete', name: "delete_user", methods: ['GET'], requirements: ['id' => '\d+'])]
    public function delete(int $id, ManagerRegistry $manager): Response
    {
        $user = $manager->getRepository(User::class)->find($id);

        if ($user) {
            $om = $manager->getManager();
            $om->remove($user);
            $om->flush();
            $this->addFlash('success', 'User removed from the list');
        } else {
            $this->addFlash('danger', "Couldn't find the user to be removed");
        }

        return $this->redirectToRoute('app_users');
    }
}
