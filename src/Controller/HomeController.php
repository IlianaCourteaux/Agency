<?php

namespace App\Controller;

use App\Entity\Properties;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    // public function index(ManagerRegistry $manager): Response
    // {
    //     $properties = $manager->getRepository(Properties::class)->findAll();

    //     return $this->render('home/index.html.twig', [
    //         'properties' => $properties,
    //     ]);
    // }

    public function index(ManagerRegistry $manager): Response
    {
        return $this->render('home/index.html.twig', [
            'properties' => $manager->getRepository(Properties::class)->findAll()
        ]);
    }

}
