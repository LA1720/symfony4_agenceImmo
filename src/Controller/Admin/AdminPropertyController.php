<?php
namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminPropertyController extends AbstractController
{
    public function __construct(PropertyRepository $repository, ObjectManager $em) //by repository we we get all datas from our database//
    {
        $this->repository = $repository;
        $this->em = $em;
        
    }

   

    /**
     * @Route("/admin", name="admin.property.index")
     * @return \symfony\Component\HttpFoundation\Response
     */

    public function index() //with function index we will get all data but we need repository for that so let's make an function __construct(PropertyRipository $repository above)
    {
        $properties = $this->repository->findAll(); //here function findAll() by repository we will stock in a variable called $properties // 
        return $this->render('admin/property/index.html.twig', compact('properties'));
    }


    /**
     * @Route("admin/property/create", name="admin.property.new")
     */

    public function new(Request $request)
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($property); //Pour traquer par tous 
            $this->em->flush();
            $this->addFlash('success', 'Bien crée avec succés');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'Property' => $property,
            'form' => $form->createView()
        ]);

       
        

    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succés');
            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/edit.html.twig', [
            'Property' => $property,
            'form' => $form->createView()
        ]);
        
    }

    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function delete(Property $property, Request $request){

        if($this->isCsrfTokenValid('delete'. $property->getId(), $request->get('_token'))){

            $this->em->remove($property);
            $this->em->flush();
            $this->addflash('success', 'bien supprimé avec succés');
           
        }
        return $this->redirectToRoute('admin.property.index');
    }
}