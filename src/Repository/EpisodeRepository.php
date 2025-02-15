<?php

namespace App\Repository;

use App\Entity\BaseMedia;
use App\Entity\Episode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Episode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Episode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Episode[]    findAll()
 * @method Episode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpisodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Episode::class);
    }

    public function findOneByShowAndNumber(BaseMedia $show, int $season, int $episode): ?Episode
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.show = :show')->setParameter('show', $show)
            ->andWhere('e.season = :season')->setParameter('season', $season)
            ->andWhere('e.episode = :episode')->setParameter('episode', $episode)
            ->getQuery()
            ->enableResultCache()
            ->getOneOrNullResult()
        ;
    }
}
