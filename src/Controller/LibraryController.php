<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;    
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    #[Route('/library/list', name: 'library_list')]
    public function list()
    {
        $response = new Response();
        $response->setContent('<div>Hola mundo </div>');
        
        return $response;

    }
}