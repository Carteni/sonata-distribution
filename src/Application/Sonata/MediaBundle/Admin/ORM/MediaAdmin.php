<?php

namespace Application\Sonata\MediaBundle\Admin\ORM;

use Sonata\AdminBundle\Datagrid\DatagridMapper;

/**
 * Class MediaAdmin
 *
 * @package Application\Sonata\MediaBundle\Admin\ORM
 */
class MediaAdmin extends \Sonata\MediaBundle\Admin\ORM\MediaAdmin
{
    protected $baseRoutePattern = "media";

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        parent::configureDatagridFilters($datagridMapper);
    }

    public function getPersistentParameters()
    {
        if (!$this->getRequest()) {
            return [];
        }

        return array_merge(parent::getPersistentParameters(),
                           [
                               'provider' => $this->getRequest()
                                   ->get('provider'),
                               'context' => $this->getRequest()
                                   ->get('context', 'media'),
                           ]);
    }
}
