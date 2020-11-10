<?php

namespace App\Repository;

use App\Entity\ReservationItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationItem[]    findAll()
 * @method ReservationItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationItem::class);
    }

    /**
     * @return ReservationItem[]
     */
    public function findItemsForToday($date): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            "SELECT ei FROM App\Entity\ReservationItem ei
            WHERE ei.date LIKE CONCAT(:chosenDate, '%')
            ORDER BY ei.date ASC"
        )->setParameter('chosenDate', $date);

        return $query->getArrayResult();
    }


}
