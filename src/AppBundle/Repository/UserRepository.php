<?php
/*********************************************************************************
 * Developed by Maxx Ng'ang'a
 * (C) 2017 Crysoft Dynamics Ltd
 * Karbon V 2.1
 * User: Maxx
 * Date: 6/12/2017
 * Time: 3:17 PM
 ********************************************************************************/

namespace AppBundle\Repository;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function findNrUsers(){
        $nrUsers= $this->createQueryBuilder('user')
            ->select('count(user.id)')
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrUsers){
            return $nrUsers;
        }else{
            return 0;
        }
    }
    
     public function findNrUsersByYear($year){
        $nrUsers= $this->createQueryBuilder('user')
            ->select('count(user.id)')
            ->andWhere('YEAR(user.accountCreatedAt) = :year')
            ->setParameter('year', $year)
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrUsers){
            return $nrUsers;
        }else{
            return 0;
        }

    }

    public function findLastMembershipOrderByDate(){

        return $this->createQueryBuilder('profile')
            ->orderBy('profile.memberNumber','DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->execute();
    }

    public function findNrUsersByRegion($region){
        $nrUsers= $this->createQueryBuilder('user')
            ->select('count(user.id)')
            ->andWhere('user.region = :region')
            ->setParameter('region', $region)
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrUsers){
            return $nrUsers;
        }else{
            return 0;
        }

    }
    
    public function findNrUsersByCategory($category){
        $nrUsers= $this->createQueryBuilder('user')
            ->select('count(user.id)')
            ->andWhere('user.userType = :userType')
            ->setParameter('userType', $category)
	    ->andWhere('user.middleName != :name')
            ->setParameter('name', "Admin")
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrUsers){
            return $nrUsers;
        }else{
            return 0;
        }

    }
    
     /**
     * @return User[]
     */
    public function findAllUserLogs(){

        return $this->createQueryBuilder('user')
            ->andWhere('user.lastLoginTime IS NOT NULL')
            ->andWhere('user.roles = :isUser')
            ->setParameter(':isUser','["ROLE_USER"]')
            ->orderBy('user.lastLoginTime','DESC')
            ->getQuery()
            ->execute();
    }
    
    public function findNrPendingUsers(){
        $nrUsers= $this->createQueryBuilder('user')
            ->select('count(user.id)')
            ->andWhere('user.isPasswordCreated = :passwordCreated')
            ->setParameter(':passwordCreated',false)
            ->getQuery()
            ->getSingleScalarResult();
        if ($nrUsers){
            return $nrUsers;
        }else{
            return 0;
        }
    }
    
    /**
     * @return User[]
     */
    public function findAllUsers(){

        return $this->createQueryBuilder('user')
            ->andWhere('user.roles = :userRole')
            ->setParameter(':userRole','["ROLE_USER"]')
            ->getQuery()
            ->execute();
    }
    
    /**
     * @return User[]
     */
    public function findAllAdministratorUsers(){

        return $this->createQueryBuilder('user')
            ->orWhere('user.roles != :isAdmin')
            ->setParameter(':isAdmin','["ROLE_USER"]')
            ->getQuery()
            ->execute();
    }
    
    /**
     * @return User[]
     */
    public function findAllPendingUsers(){

        return $this->createQueryBuilder('user')
            ->andWhere('user.isPasswordCreated = :passwordCreated')
            ->setParameter(':passwordCreated',false)
            ->getQuery()
            ->execute();
    }
    
    /**
     * @return User[]
     */
    public function findAllPendingAdminUsers(){

        return $this->createQueryBuilder('user')
            ->andWhere('user.isPasswordCreated = :passwordCreated')
            ->setParameter(':passwordCreated',false)
            ->andWhere('user.roles = :isAdmin')
            ->setParameter(':isAdmin','["ROLE_ADMIN"]')
            ->getQuery()
            ->execute();
    }
}
