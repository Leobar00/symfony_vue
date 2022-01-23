<?php

namespace App\Repository;

use App\Entity\Colonna;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Colonna|null find($id, $lockMode = null, $lockVersion = null)
 * @method Colonna|null findOneBy(array $criteria, array $orderBy = null)
 * @method Colonna[]    findAll()
 * @method Colonna[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColonnaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Colonna::class);
    }

    // /**
    //  * @return Colonna[] Returns an array of Colonna objects
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
    public function findOneBySomeField($value): ?Colonna
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
