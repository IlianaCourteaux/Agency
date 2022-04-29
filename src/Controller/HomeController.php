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
    public function index(ManagerRegistry $manager): Response
    {

        $properties = $manager->getRepository(Properties::class)->findAll();


        return $this->render('home/index.html.twig', [
            'properties' => $properties,
        ]);

        // $property = new Properties;
        // $om = $manager->getManager();
        // $om->persist($property);
        // $om->flush();

        // return $this->render('home/index.html.twig', [
        //     'controller_name' => 'HomeController',
        //     'propertiesList' => $manager->getRepository(Properties::class)->findAll()
        // ]);
    }
}
