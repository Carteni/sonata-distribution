<?php

    namespace Application\Sonata\UserBundle\Admin;

    /**
     * Class GroupAdmin
     *
     * @package Application\Sonata\UserBundle\Admin
     */
    class GroupAdmin extends \Sonata\UserBundle\Admin\Entity\GroupAdmin
    {
        protected $baseRoutePattern = "group";

    }