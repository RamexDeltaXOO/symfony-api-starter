<?php

namespace App\Repository;

use App\Entity\SecureNote;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SecureNote>
 */
class SecureNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecureNote::class);
    }
	
	public function findByOwner(User $user): array
	{
		return $this->createQueryBuilder('n')
			->andWhere('n.owner = :owner')
			->setParameter('owner', $user)
			->orderBy('n.createdAt', 'DESC')
			->getQuery()
			->getResult();
	}

//    /**
//     * @return SecureNote[] Returns an array of SecureNote objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SecureNote
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
