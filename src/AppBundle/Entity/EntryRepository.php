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
            ->join('e.addresses', 'a')
            ->join('e.emails', 'em')
            ->join('e.phones', 'p')
            ->getQuery();

        return $sql;
    }
}
