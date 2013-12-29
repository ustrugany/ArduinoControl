<?php

namespace KGzocha\ArduinoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use KGzocha\ArduinoBundle\Model\StatisticableRepositoryInterface;

/**
 * TemperatureLogRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TemperatureLogRepository extends EntityRepository implements StatisticableRepositoryInterface
{
    /**
     * Will return X and Y values
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getValues($id)
    {
        return $this->createQueryBuilder('tl')
            ->select('tl.date as x')
            ->addSelect('tl.value as y')
            ->join('tl.thermometer', 't')
            ->where('t.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getArrayResult();
    }

}
