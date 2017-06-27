<?php

namespace AppBundle\Model;

/**
 * Trait StatusTrait
 *
 * @package AppBundle
 */
trait StatusTrait
{
    /**
     * @return array
     */
    public static function getStatusList()
    {
        return [
            StatusInterface::DRAFT => 'status.draft',
            StatusInterface::PUBLISHED => 'status.published',
        ];
    }
}
