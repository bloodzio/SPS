<?php

namespace SpsBundle\Entity\Repository\Types;

use Doctrine\ORM\EntityRepository;

/**
 * KabelTypRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class KabelTypRepository extends EntityRepository
{
	

	public function getAll(){
	
		$qb = $this->getEntityManager()
		->createQuery(
				'SELECT k.name, k.id
				FROM SpsBundle:KabelTyp k'
				
	
		);
	
		return $qb->getResult();
	}
	
	
	
}
