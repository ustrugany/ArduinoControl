<?php
/**
 * @author Krzysztof Gzocha <krzysztof.gzocha@xsolve.pl>
 */

namespace KGzocha\ArduinoBundle\Service\Statistics;

use Doctrine\ORM\EntityManager;
use KGzocha\ArduinoBundle\Model\StatisticableRepository;
use KGzocha\ArduinoBundle\Service\Statistics\Model\ChartVariables;
use KGzocha\ArduinoBundle\Service\Statistics\Model\StatisticsException;
use KGzocha\ArduinoBundle\Service\Statistics\Model\Variable2D;

class DataBaseStatisticsGiver implements StatisticsGiverInterface
{

    /**
     * @var EntityManager
     */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     */
    public function giveStatistics($entity, $id)
    {
        $repository = $this->entityManager->getRepository($entity);
        if (!$repository instanceof StatisticableRepository) {
            throw new StatisticsException('Given entity doesnt have proper repository');
        }

        $result = new ChartVariables();
        foreach ($repository->getValues($id) as $variable) {
            if (array_key_exists('x', $variable) && array_key_exists('y', $variable)) {
                $result->insert((new Variable2D())
                        ->setX($variable['x'])
                        ->setY($variable['y']));
            }
        }

        return $result;
    }
}