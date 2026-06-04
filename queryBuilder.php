// src/Repository/ReservationRepository.php
namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * Recherche les réservations existantes qui chevauchent le créneau demandé.
     */
    public function findOverlappingReservations($resource, \DateTimeInterface $start, \DateTimeInterface $end): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.resource = :res')
            ->andWhere('r.startDate < :end')
            ->andWhere('r.endDate > :start')
            ->setParameter('res', $resource)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }
}