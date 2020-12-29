<?php

namespace App\Controller;


use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

////After to make this private $repository now we can use it below to get our datas form entity / property!!//





// Here create the Route and function index and lance the website and its working!! now go to routes.yaml and remove old route s //
// yaml style and create the easy style annotations @Route at homeComtroller at index function and then extends abstractController in HomeController and PropertyController class and remove the old method and add new easy method. let see in HomeController in index function and make new sub folder property and file called index.html.twig //

    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
//         $property = new Property(); //Make the new instance Entity / Property.php
//         $property-> setTitle("Mon premier bien")
//                  ->setPrice(2000)
//                  ->setRooms(4)
//                  ->setBedrooms(3)
//                  ->setDescription('lorem ipsum')
//                  ->setSurface(90)
//                  ->setFloor(4)
//                  ->setHeat(1)  //for heat maybe we can write our information in database or we can make const Heat = [0 => 'electric', 1 => 'gaz']; in our Entity / Property.php inside the class Property                   
//                  ->setCity('paris')
//                  ->setAddress('10, rue de paris')
//                  ->setPostalCode('75000');
//                   ->setCreatedAt() //For created_at we will make a __construct method in Entity /Property.php in private =created_at
                 
//                  $em = $this-> getDoctrine()->getManager(); // use Doctrine\Persistence\ObjectManager; //
//                  $em->persist($property);
//                  $em->flush();

//// after insert our data by ObjectManager we will remove or comments all of these code and we will make the process to show all data inserted below by using method Repository

            // $repository = $this->getDoctrine()->getRepository(Property::class);  //we can ckeck with an dump to see what will will get by this process from entity / table / class  Property!

            // dd($repository);  //here we will use another way to get datas from entity / table Property by make a new __construct method in this page with private $repository, let see at the top part of this PropertyController class

                 

                // $property = $this->repository
                //                             //  ->find(1); //find(1 or 2 or 3) will get datas by number of id, let check with dump()//
                //                             //  ->findAll(); //findAll will get all data;//
                //                              ->findOneBy(['floor'=>4]); // findOneBy(['']) we will get datas by critaire par exm. show all datas that gave critaire floor 4
                // dd($property); 

//after our example above now we will creat our own method to get our personalised datas. maybe we can make a method to get al the houses by not sold ({options=sold'false'})!! so this new method we have to create in our Repository / PropertyRepository.php with an alias or parameter ('p') where ...., Exp method findAllVisible() with queryBilder let's go there//
                 
                $properties = $paginator->paginate(
                    $this->repository->findAllVisibleQuery(),
                    $request->query->getInt('page', 1),
                     12
                );
                // dd($property);
                // $property[0]->setSold(true);
                // $this->em->flush();
//this method is make sold = false to true 


                 return $this->render('property/index.html.twig', [
                     'current_menu' => 'properties',
                     'properties' => $properties
                     ]);
    }


    // /**
    //  * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
    //  * @return Response
    //  */
    // public function show($slug, $id): Response  //to get all data by selected id, here we write 2 parameter in show ()//
    // {
    //     $property = $this->repository->find($id); // add this line to get info by selected id in show.html.twig//
    //     return $this->render('property/show.html.twig', [
    //         'property' => $property,  //add this line to get info from $property by selected id in show.html.twig// 
    //         'current_menu' => 'properties'
    //     ]);
    // }
    // //created by ali

    // //go to show.html.twig and make the page

       
     /**
      * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug":"[a-z0-9\-]*"})
      * @return Response
      */
    
    public function show(Property $property, string $slug): Response
       {
           if($property->getSlug() !== $slug) {
               return $this->redirectToRoute('property.show', [
                   'id' => $property->getId(),
                   'slug' => $property->getSlug()
               ], 301); 
           }
           return $this->render('property/show.html.twig',[
               'property' => $property,
               'current_menu' => 'properties'
           ]);
       } // this is the another way//







}