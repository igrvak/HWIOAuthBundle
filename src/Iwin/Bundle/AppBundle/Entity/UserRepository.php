<?php
namespace Iwin\Bundle\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Репозитарий Entity\User.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class UserRepository extends EntityRepository
{
    /**
     * @param string $social
     * @param string $user
     * @return User|null
     * @throws NonUniqueResultException
     */
    public function findBySocial($social, $user)
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.socials', 'us')
            ->leftJoin('us.social', 's')
            ->where('s.type = :social')
            ->andWhere('us.idSocial = :user')
            ->setParameter('social', $social)
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
