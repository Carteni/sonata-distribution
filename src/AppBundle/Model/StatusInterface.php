<?php
namespace AppBundle\Model;

/**
 * Interface StatusInterface
 *
 * @package AppBundle\Model
 */
interface StatusInterface
{
    const DRAFT = "status.draft";
    const PUBLISHED = "status.published";

    /**
     * @return array
     */
    public static function getStatusList();
}