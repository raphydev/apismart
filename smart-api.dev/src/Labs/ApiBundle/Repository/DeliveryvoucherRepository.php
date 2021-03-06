<?php

namespace Labs\ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DeliveryvoucherRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DeliveryvoucherRepository extends EntityRepository
{
    public function getCommandesContent($proforma)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->leftJoin('c.proforma','pro');
        $qb->addSelect('pro');
        $qb->leftJoin('pro.clients','clt');
        $qb->addSelect('clt');
        $qb->leftJoin('pro.proformasproducts','profprd');
        $qb->addSelect('profprd');
        $qb->leftJoin('profprd.products', 'prod');
        $qb->addSelect('prod');
        $qb->leftJoin('prod.stock','stock');
        $qb->addSelect('stock');
        $qb->leftJoin('stock.entrepot','ent');
        $qb->addSelect('ent');
        $qb->leftJoin('ent.site','site');
        $qb->addSelect('site');
        $qb->where($qb->expr()->eq('c.proforma',':proforma'));
        $qb->setParameter('proforma',$proforma);
        return $qb->getQuery()->getResult();
    }

    public function getCommandDemand($id, $reference)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->leftJoin('c.proforma','p');
        $qb->addSelect('p');
        $qb->leftJoin('p.clients', 'clt');
        $qb->addSelect('clt');
        $qb->leftJoin('p.services', 'ser');
        $qb->addSelect('ser');
        $qb->leftJoin('p.conditions', 'cdt');
        $qb->addSelect('cdt');
        $qb->leftJoin('p.compagny', 'cp');
        $qb->addSelect('cp');
        $qb->leftJoin('p.proformasproducts', 'prp');
        $qb->addSelect('prp');
        $qb->where($qb->expr()->eq('c.proforma', ':id'), $qb->expr()->eq('c.reference',':reference'));
        $qb->setParameter('id', $id);
        $qb->setParameter('reference', $reference);
        return $qb->getQuery()->getResult();
    }
}
