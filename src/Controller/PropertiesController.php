<?php

namespace App\Controller;

use App\Entity\Search;
use App\Form\SearchType;
use App\Entity\Properties;
use App\Form\PropertyType;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertiesController extends AbstractController
{
    #[Route('/properties', name: 'app_properties')]
    public function index(ManagerRegistry $manager): Response
    {
        return $this->render('properties/index.html.twig', [
            'propertiesList' => $manager->getRepository(Properties::class)->findAll()
        ]);
    }

    #[Route('properties/all', name: 'app_catalog', methods: ['GET'])]    
    public function all(ManagerRegistry $manager, Request $request, PaginatorInterface $paginator): Response
    {

        $search = new Search;
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        $properties = $paginator->paginate(
            $manager->getRepository(Properties::class)->findAvailableQuery($search),
            $request->query->getInt('page', 1),
            8
        );
        
        return $this->renderForm('properties/catalog.html.twig',[
            'current_menu' => 'properties',
            'form' => $form,
            'propertiesList' => $properties
        ]);

    }

    #[Route('properties/{id}', name: 'app_single', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function single(int $id, ManagerRegistry $manager):Response
    {
        $properties = $manager->getRepository(Properties::class)->find($id);

        return $this->render('properties/single.html.twig', [
            'properties' => $properties
        ]);
    }

    #[Route('/properties/add', name: 'add_property', methods: ['GET', 'POST'])]
    public function add(ManagerRegistry $manager, Request $request): Response
    {
        $property = new Properties;
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $photo = $form->get('photo')->getData();
            $property->setPhoto($photo->getClientOriginalName());

            $options = $form->get('option')->getData();
            foreach ($options as $value) {
                $property->addOption($value);
            }

            $om = $manager->getManager();
            $om->persist($property);
            $om->flush();
            $this->addFlash('success', 'New property added to the list');

            return $this->redirectToRoute('app_properties');
        }

        return $this->renderForm('properties/add.html.twig', ['form' => $form]);
    }

    #[Route('/properties/{id}/update', name:'update_property', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function update(int $id, ManagerRegistry $manager, request $request): Response
    {
        $property = $manager->getRepository(Properties::class)->find($id);

        if($property){
            $photoName = $property->getPhoto();
            $property->setPhoto(new File($this->getParameter('property_dir').'/'. $property->getPhoto()));
            $form = $this->createForm(PropertyType::class, $property);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $photo = $form->get('photo')->getData();
                
                if ($photo) {
                    $property->setPhoto($photo->getClientOriginalName());
                } else {
                    $property->setPhoto($photoName);
                }
                $om = $manager->getManager();
                $om->persist($property);
                $om->flush();
                $this->addFlash('success', 'Property updated successfully');

                return $this->redirectToRoute('app_properties');
            }
            
            return $this->renderForm('properties/update.html.twig', [
                'form' => $form
            ]);

        } else {

            $this->addFlash('danger', 'Property not found');

            return $this->redirectToRoute('app_properties');
        }
    }

    #[Route('properties/{id}/delete', name: "delete_property", methods: ['GET'], requirements: ['id' => '\d+'])]
    public function delete(int $id, ManagerRegistry $manager): Response
    {
        $property = $manager->getRepository(Properties::class)->find($id);

        if ($property) {
            $om = $manager->getManager();
            $om->remove($property);
            $om->flush();
            $this->addFlash('success', 'Property removed from the list');
        } else {
            $this->addFlash('danger', "Couldn't find the property to be removed");
        }

        return $this->redirectToRoute('app_properties');
    }

}