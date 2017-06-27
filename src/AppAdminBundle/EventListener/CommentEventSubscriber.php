<?php

namespace AppAdminBundle\EventListener;

use AppBundle\Entity\Comment;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class CommentEventSubscriber
 *
 * @package AppAdminBundle\EventListener
 */
class CommentEventSubscriber implements EventSubscriber
{

    public function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            'prePersist',
            'preUpdate',
        ];
    }

    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     */
    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        /** @var Comment $entity */
        $entity = $eventArgs->getEntity();

        if ($entity instanceof Comment) {
            $now = new \DateTime();
            $entity->setCreatedAt($now);
            $this->clearComment($entity);
        }
    }

    private function clearComment(Comment $entity)
    {
        $entity->setComment(\strip_tags($entity->getComment(),
                                        '<a><abbr><acronym><b><blockquote><cite><code><del><em><i><q><strike><strong>'));
    }

    /**
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
     */
    public function preUpdate(LifecycleEventArgs $eventArgs)
    {
        /** @var Comment $entity */
        $entity = $eventArgs->getEntity();

        if ($entity instanceof Comment) {
            $this->clearComment($entity);
        }
    }
}
