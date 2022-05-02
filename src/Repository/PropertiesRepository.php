<?php

namespace App\Repository;

use App\Entity\Search;
use Doctrine\ORM\Query;
use App\Entity\Properties;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Properties>
 *
 * @method Properties|null find($id, $lockMode = null, $lockVersion = null)
 * @method Properties|null findOneBy(array $criteria, array $orderBy = null)
 * @method Properties[]    findAll()
 * @method Properties[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Properties::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Properties $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Properties $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }


    public function findAvailableQuery(Search $search): Query
    {
        $query = $this->findAvailable();

        if ($search->getMinrooms()){
            $query = $query
            ->andWhere('p.rooms >= :minrooms')
            ->setParameter('minrooms', $search->getMinrooms());
        }

        if ($search->getMaxrooms()){
            $query = $query
            ->andWhere('p.rooms <= :maxrooms')
            ->setParameter('maxrooms', $search->getMaxrooms());
        }
        
        if ($search->getMinsurface()){
            $query = $query
            ->andWhere('p.surface >= :minsurface')
            ->setParameter('minsurface', $search->getMinsurface());
        }
                
        if ($search->getMaxsurface()){
            $query = $query
            ->andWhere('p.surface <= :maxsurface')
            ->setParameter('maxsurface', $search->getMaxsurface());
        }

        if ($search->getMinPrice()){
            $query = $query
            ->andWhere('p.price >= :minprice')
            ->setParameter('minprice', $search->getMinprice());
        }

        if ($search->getMaxprice()){
            $query = $query
            ->andWhere('p.price <= :maxprice')
            ->setParameter('maxprice', $search->getMaxprice());
        }

        return $query->getQuery();
    }

    public function findLatestFive(): array
    {
        return $this->findAvailable()
        ->setMaxResults(5)
        ->getQuery()
        ->getResult();
    }

    private function findAvailable(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
        ->where('p.status = true')
        ->orderBy('p.id', 'DESC'); 
    }
    
    // /**
    //  * @return Properties[] Returns an array of Properties objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Properties
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
