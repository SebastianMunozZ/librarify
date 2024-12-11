<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;    
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    #[Route('/library/list', name: 'library_list')]
    public function list(Request $request)
    {
        $title = $request->query->get('title');
        $response = new JsonResponse();
        $response->setData([
            "success" => true,
            "data" => [
                [
                    'id' => 1,
                    'title' => "Libro1"
                ],    
                [
                    'id' => 2,
                    'title' => "Libro2"
                ],
                [
                    'id' => 3,
                    'title' => $title
                ]
            ]
        ]);
        
        return $response;

    }
}