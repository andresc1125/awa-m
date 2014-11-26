<?php

namespace Awa\BussinessBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ReferedAplicationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReferedAplicationRepository extends EntityRepository
{
  public function findAppsReferedBy($plan)
  {
    $query = $this->getEntityManager()->createQuery("SELECT app FROM AwaBussinessBundle:AAplication app 
      LEFT JOIN AwaBussinessBundle:ReferedAplication ra WITH  ra.bussinessCategory = :plan
      where app = ra.aplication");
    $query->setParameter('plan', $plan);
    $apps = $query->getResult();
    return $apps;
  }
}
