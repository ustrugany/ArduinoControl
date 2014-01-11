<?php

namespace KGzocha\ArduinoBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PinRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PinRepository extends EntityRepository
{

    /**
     * @return mixed
     */
    public function findFirst()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.systemId', 'asc')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
