<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;    
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\BookRepository;
use App\Entity\Book;

class LibraryController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    #[Route('/books', name: 'books_get')]
    public function list(Request $request, BookRepository $bookRepository)
    {
        $title = $request->query->get('title', 'libro por defecto');
        $books = $bookRepository->findAll();
        $booksAsArray = [];
        foreach ($books as $book) {
            $booksAsArray[] = [
                'id' => $book->getId(),
                'title' => $book->getTitle(),
                'image' => $book->getImage()
            ];
        }
        $response = new JsonResponse();
        $response->setData([
            "success" => true,
            "data" => $booksAsArray
        ]);
        
        return $response;

    }

    #[Route('/book/create', name: 'create_book')]
    public function createBook(Request $request, EntityManagerInterface $entityManager) {
        $book = new Book;
        $response  = new JsonResponse();

        $title = $request->query->get('title', null);
        if (empty($title)) {
            $response->setData([
                'success' => false,
                'error' => 'Se requiere el titulo del libro',
                'data' => null
            ]);    
            return $response;
        }

        $book->setTitle($title);
        $entityManager->persist($book);
        $entityManager->flush();

        $response->setData([
            "success" => true,
            "data" => [
                [
                    'id' => $book->getId(),
                    'title' => $book->getTitle()
                ]
            ]
        ]);
        
        return $response;
    }
}