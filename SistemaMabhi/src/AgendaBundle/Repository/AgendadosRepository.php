<?php

namespace AgendaBundle\Repository;

use AgendaBundle\Entity\Agendados;
use Doctrine\ORM\EntityRepository;

/**
 * AgendadosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AgendadosRepository extends EntityRepository
{
//    POR DQL
//    public function findAllOrderedByName()
//    {
//        return $this->getEntityManager()
//            ->createQuery(
//                "SELECT DATE_FORMAT(`a.data_agendado`, '%d') 'dia', DATE_FORMAT(`a.data_agendado`, '%m') 'mes', DATE_FORMAT(`a.data_agendado`, '%y') 'ano' FROM AgendaBundle:Agendados a Where a.status = 1"
////                "SELECT a FROM AgendaBundle:Agendados a Where a.status = 1"
//            )
//            ->getResult();
//    }

//  POR QUERY BUILDER
    public function findAllOrderedByName($dia,$mes,$ano)
    {

        $data = ''.$ano.'/'.$mes.'/'.$dia." 00:00:00";
        $data = \DateTime::createFromFormat('Y/m/d H:i:s', $data);
//        var_dump($data);exit();
        //2019-02-06 05:51:02.000000
        //2019-02-06 00:00:00.000000
        //
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select("a")
            ->from('AgendaBundle\Entity\Agendados', 'a')
            ->where( "a.data_agendado = :data" )
            ->andwhere( "a.status = 1" )
            ->setParameter(':data',$data)
            ;
//            ->where('u.id = ?1')
//            ->orderBy('u.name', 'ASC');
        $query = $qb->getQuery();
        return $query->getResult();

    }
}