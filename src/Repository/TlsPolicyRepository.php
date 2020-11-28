<?php

namespace App\Repository;

use App\Entity\TlsPolicy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TlsPolicy|null find($id, $lockMode = null, $lockVersion = null)
 * @method TlsPolicy|null findOneBy(array $criteria, array $orderBy = null)
 * @method TlsPolicy[]    findAll()
 * @method TlsPolicy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TlsPolicyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TlsPolicy::class);
    }

    // /**
    //  * @return TlsPolicy[] Returns an array of TlsPolicy objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TlsPolicy
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
