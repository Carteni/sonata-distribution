<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 *
 * @package AppBundle\Repository
 */
class PostRepository extends EntityRepository
{
    /**
     * @param $max
     *
     * @return Post[]
     */
    public function getLatest($max)
    {
        return $this->findBy([], ['last_modified' => 'DESC'], $max);
    }
}
