<?php

namespace App\Repository;

use App\Entity\SwimLevels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SwimLevels|null find($id, $lockMode = null, $lockVersion = null)
 * @method SwimLevels|null findOneBy(array $criteria, array $orderBy = null)
 * @method SwimLevels[]    findAll()
 * @method SwimLevels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwimLevelsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SwimLevels::class);
    }

//    /**
//     * @return SwimLevels[] Returns an array of SwimLevels objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SwimLevels
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
