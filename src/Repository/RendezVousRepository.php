<?php

namespace App\Repository;

use App\Entity\RendezVous;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RendezVousRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RendezVous::class);
    }

    /**
     * Compter les rendez-vous par jour
     */
public function countRendezVousByDay(): array
{
    $conn = $this->getEntityManager()->getConnection();

    $sql = "
        SELECT 
            DATE(date) AS day,
            COUNT(*) AS total
        FROM rendez_vous
        GROUP BY DATE(date)
        ORDER BY DATE(date) ASC
    ";

    $stmt = $conn->prepare($sql);
    $result = $stmt->executeQuery();

    return $result->fetchAllAssociative();
}


}
