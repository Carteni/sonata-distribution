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
    }
