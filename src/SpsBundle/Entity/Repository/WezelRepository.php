<?php

namespace SpsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * WezelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class WezelRepository extends EntityRepository
{
	public function getWezelFomRejon($id_rejon,$object_tag='wezel'){
	
		$qb = $this->getEntityManager()
		->createQuery(
				"SELECT  w.id, w.name, w.opis,
							m.id as mid,
							m.kod as mkod,
							m.opis as mopis
				    FROM SpsBundle:Wezel w
					LEFT JOIN SpsBundle:Mufa m
						with m.id_wezel =  w.id
					LEFT JOIN SpsBundle:ObjectTyp o
						with m.id_object_type = o.id
					WHERE m.id_rejon=:id
					AND o.name =:w "
					)->setParameter('id', $id_rejon)
					->setParameter('w', $object_tag);
	
	
		return $qb->getResult();
	}
	
	
	public function getMufaInFomRejon($id_rejon,$id_wezel,$object_tag='trakt'){
	
		$qb = $this->getEntityManager()
		->createQuery(
				'SELECT  w.id , w.name, w.opis,
							m.id as mid,
							m.kod as mkod,
							m.opis as mopis,
							m.gps_e, m.gps_n
				    FROM SpsBundle:Wezel w
					LEFT JOIN SpsBundle:Mufa m
						with m.id_wezel =  w.id
					LEFT JOIN SpsBundle:ObjectTyp o
						with m.id_object_type = o.id
					WHERE m.id_rejon=:id
					AND o.name =:o
					AND w.id=:w'
		)->setParameter('id', $id_rejon)
		->setParameter('o', $object_tag)
		->setParameter('w', $id_wezel);
	
		return $qb->getResult();
	}
	
	
	public function getAllWezlyFromRejon($id_rejon){
	
		$qb = $this->getEntityManager()
		->createQuery(
				"SELECT  w.id, w.name, w.opis,
						m.id as mid,
						m.kod as mkod,
						m.opis as mopis,
						m.gps_e, m.gps_n,
						o.name as oname
			
				    FROM SpsBundle:Wezel w
					LEFT JOIN SpsBundle:Mufa m
						with m.id_wezel =  w.id
					LEFT JOIN SpsBundle:ObjectTyp o
					with m.id_object_type = o.id
					WHERE w.id_rejon=:id
					ORDER by w.id ASC"
		)->setParameter('id', $id_rejon);
	
	
		return $qb->getResult();
	}
	
	public function getLastIdFromRejon($id_rejon){
		
		$qb = $this->getEntityManager()
		->createQuery(
				'SELECT  MAX(w.id)
				FROM SpsBundle:Wezel w
					LEFT JOIN SpsBundle:Rejon r
				with w.id_rejon = r.id
				WHERE r.id =:id'
		)->setParameter('id', $id_rejon);
		
		return $qb->getSingleResult();
		
	}	
	
}
