<?php

namespace AppAdminBundle\EventListener;

use AppBundle\Entity\Post;
use Cocur\Slugify\SlugifyInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

/**
 * Class PostEventSubscriber
 *
 * @package AppAdminBundle\EventListener
 */
class PostEventSubscriber implements EventSubscriber
{
	/** @var  SlugifyInterface */
	private $slugify;

	public function __construct(SlugifyInterface $slugify)
	{
		$this->slugify = $slugify;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getSubscribedEvents()
	{
		return array(
			'prePersist',
			'preUpdate',
		);
	}

	/**
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 */
	public function prePersist(LifecycleEventArgs $eventArgs)
	{
		$entity = $eventArgs->getEntity();

		if ($entity instanceof Post) {
			$now = new \DateTime();
			$entity->setCreatedAt($now);
			$entity->setLastModified($now);
			$this->updateSlug($entity);
		}
	}

	/**
	 * @param \Doctrine\ORM\Event\LifecycleEventArgs $eventArgs
	 */
	public function preUpdate(LifecycleEventArgs $eventArgs)
	{
		$entity = $eventArgs->getEntity();

		if ($entity instanceof Post) {
			$entity->setLastModified(new \DateTime());
			$this->updateSlug($entity);
		}
	}


	private function updateSlug(Post $entity)
	{
		$entity->setSlug($this->slugify->slugify($entity->getTitle()));
	}
}
