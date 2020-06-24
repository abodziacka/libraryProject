<?php


//********* Autor: Aleksandra Bodziacka **********


namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

     /**
     * @return Book[] Returns an array of Book objects
      */

    public function findAvailable()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.isOrder = false')
            ->orderBy('b.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOrder($user_id)
    {
        return $this->createQueryBuilder('b')
            ->innerJoin('b.orderedbooks', 'u')
            ->andWhere('u.id = :user_id')
            ->setParameter('user_id', $user_id)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findUsersOrder()
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.isOrder = true')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?Book
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
