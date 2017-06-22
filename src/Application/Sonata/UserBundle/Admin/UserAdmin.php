<?php

    namespace Application\Sonata\UserBundle\Admin;


    /**
     * Class UserAdmin
     *
     * @package Application\Sonata\UserBundle\Admin
     */
    class UserAdmin extends \Sonata\UserBundle\Admin\Entity\UserAdmin
    {
        protected $baseRoutePattern = "user";

    }