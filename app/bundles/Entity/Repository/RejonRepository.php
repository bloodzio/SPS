<?php

namespace SpsBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;


use SpsBundle\Entity\Kabel;
use SpsBundle\Entity\Mufa;
use SpsBundle\Entity\Rejon;


/**
 * RejonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RejonRepository extends EntityRepository
{
	public function getRejons($limit = null){
	
		$qb = $this->createQueryBuilder('b')
		->select('b')
		->addOrderBy('b.id');
		
		
		
		return $qb->getQuery()
		->getResult();
	
	}
	
	public function getBase(){
		 
		$qb = $this->getEntityManager()
		->createQuery('
   
    		SELECT r.id,r.kod,r.nazwa,
			(SELECT COUNT(mk.id) FROM SpsBundle:Rejon rk left join SpsBundle:Mufa mk with mk.id_rejon= rk.id WHERE rk.id = r.id) as c,

			(SELECT sum(ko.lenght) FROM SpsBundle:Rejon ro left join SpsBundle:Mufa mo with mo.id_rejon= ro.id left join SpsBundle:Kabel ko with ko.id_mufa_start =mo.id
 			WHERE ro.id = r.id) as l

    	FROM SpsBundle:Rejon r
    
		Order by r.id
    	');
		$result =$qb->getResult();
		 
		return $result;
	}
	

}