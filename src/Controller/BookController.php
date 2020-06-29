<?php

//********* Autor: Aleksandra Bodziacka **********


namespace App\Controller;

use App\Entity\Book;
use App\Entity\User;

use ContainerLUwWOzD\getBookControllerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private $repository;
    private $userRepository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->repository = $em->getRepository(Book::class);
        $this->userRepository=$em->getRepository(User::class);

    }


    /**
     * @Route("/books", name="books")
     */
    public function index()
    {
        $list= $this->repository->findAvailable();


        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'booklist'=>$list
        ]);
    }

    /**
     * @Route("/books/confirm/{id}", name="confirm")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function confirm(int $id)
    {
        $book= $this->repository->find($id);

        return $this->render('book/confirm.html.twig', [
            'controller_name' => 'BookController',
            'id'=>$id,
            'book'=>$book
        ]);
    }

    /**
     * @Route("/myBooks", name="myBooks")
     */

    public function myBooks()
    {

        $user=$this->getUser();

        $booklist=$this->repository->findOrder($user->getId());


        return $this->render('book/myBooks.html.twig', [
            'controller_name' => 'BookController',
            'bookList'=>$booklist
        ]);
    }

    /**
     * @Route("/userBooks", name="userBooks")
     */

    public function userBooks()
    {
        $userBooklist=$this->repository->findUsersOrder();

        return $this->render('book/userOrderBooks.html.twig', [
            'controller_name' => 'BookController',
            'bookList'=>$userBooklist
        ]);
    }

    /**
     * @Route("/returnBook/{id}", name="returnBook")
     */

    public function returnBooks(int $id)
    {
        $book= $this->repository->find($id);
        $entityManager = $this->getDoctrine()->getManager();


        $userName=$this->getUser()->getUsername();
        $user=$this->userRepository->findByUsername($userName);

        $book->setIsOrder(0);
        $book->removeOrderedbook($user);
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('userBooks');
    }


    /**
     * @Route("/orderBook/{id}", name="orderBook")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function orderBook(int $id)
    {
        $book= $this->repository->find($id);
        $entityManager = $this->getDoctrine()->getManager();

        $userName=$this->getUser()->getUsername();
        $user=$this->userRepository->findByUsername($userName);

        $book->setIsOrder(1);
        $book->addOrderedbook($user);
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('books');
    }
}
