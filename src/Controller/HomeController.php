<?php

namespace App\Controller; // create namespace//

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController //create class HomeController without extends abstract and later we will use this easy abstractController method to use the esay process//
{

    // // add the route and private $twig and lanch the web page (Yes its working but its too much code!! go back to service.yaml at line 40)
    // /**
    //  * @var Environment
    //  */
    // private $twig; 


    // public function __construct(Environment $twig) // create function construct and add a parameter ($twig)=> $twig is an object//
    // {
    //     $this->twig = $twig; // here we will initial the $twig //
    // }

    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return Response
     */

    public function index(PropertyRepository $repository): Response //create index function with : Response (Response is the type of answer to be return)
    {
        $properties = $repository->findLatest(); // we will show latest annonce at our home page so here we placed (PropertyRepository $repository) inside the index argument and we placed ->findLatest() method but this method is not still created so let's create it in Repository / PropertyRepository!! and after come back here to make its ->render view!!

        return $this->render('pages/home.html.twig',[
            'properties' => $properties
        ]); //create an subfolder called pages inside the templates and create the file called home.html.twig write there <h1>welcome ... //
    }

    // ooppss fatal error!! route is not working! go to service.yaml and add configure your chemin in line 34//

    


}