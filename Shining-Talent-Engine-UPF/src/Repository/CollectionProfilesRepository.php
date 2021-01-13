<?php

namespace App\Repository;

use App\Entity\CollectionProfiles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionProfiles|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionProfiles|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionProfiles[]    findAll()
 * @method CollectionProfiles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionProfilesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionProfiles::class);
    }

    // /**
    //  * @return CollectionProfiles[] Returns an array of CollectionProfiles objects
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
    public function findOneBySomeField($value): ?CollectionProfiles
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
