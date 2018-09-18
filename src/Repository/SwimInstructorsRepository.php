<?php

namespace App\Repository;

use App\Entity\SwimInstructors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SwimInstructors|null find($id, $lockMode = null, $lockVersion = null)
 * @method SwimInstructors|null findOneBy(array $criteria, array $orderBy = null)
 * @method SwimInstructors[]    findAll()
 * @method SwimInstructors[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SwimInstructorsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SwimInstructors::class);
    }


//    /**
//     * @return SwimInstructors[] Returns an array of SwimInstructors objects
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
    public function findOneBySomeField($value): ?SwimInstructors
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
