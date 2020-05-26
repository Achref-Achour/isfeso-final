<?php

namespace App\Repository;

use App\Entity\ContactIsfeso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ContactIsfeso|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactIsfeso|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactIsfeso[]    findAll()
 * @method ContactIsfeso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactIsfesoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactIsfeso::class);
    }

    // /**
    //  * @return ContactIsfeso[] Returns an array of ContactIsfeso objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContactIsfeso
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
