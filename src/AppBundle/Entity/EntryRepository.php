<?php

namespace AppBundle\Entity;

/**
 * EntryRepository
 */
class EntryRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllToPagination()
    {
        $sql = $this->createQueryBuilder('e')
            ->getQuery();

        return $sql;
    }
}
