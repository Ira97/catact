<?php

namespace App\Repository;

use App\Entity\UserToFriends;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserToFriends|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserToFriends|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserToFriends[]    findAll()
 * @method UserToFriends[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserToFriendsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserToFriends::class);
    }

    // /**
    //  * @return UserToFriends[] Returns an array of UserToFriends objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserToFriends
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
