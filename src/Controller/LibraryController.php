<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;    
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LibraryController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    #[Route('/library/list', name: 'library_list')]
    public function list(Request $request)
    {
        $title = $request->query->get('title', 'libro por defecto');
        $this->logger->info('Hola mundo');
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