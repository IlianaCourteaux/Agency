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

    public function home(ManagerRegistry $manager): Response
    {
        $properties = $manager->getRepository(Properties::class)->getLatestFive();

        return $this->render('home/index.html.twig', [
            'propertiesList' => $properties,
        ]);
    }

}
