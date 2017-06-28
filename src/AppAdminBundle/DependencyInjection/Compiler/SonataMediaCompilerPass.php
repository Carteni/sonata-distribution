<?php
namespace AppAdminBundle\DependencyInjection\Compiler;

use Application\Sonata\MediaBundle\Admin\GalleryAdmin;
use Application\Sonata\MediaBundle\Admin\ORM\MediaAdmin;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class SonataMediaCompilerPass
 *
 * @package AppAdminBundle\DependencyInjection\Compiler
 */
class SonataMediaCompilerPass implements CompilerPassInterface
{
    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('sonata.media.admin.media')) {
            $container->findDefinition('sonata.media.admin.media')
                ->setClass(MediaAdmin::class)
            ;
        }

        if ($container->hasDefinition('sonata.media.admin.gallery')) {
            $container->findDefinition('sonata.media.admin.gallery')
                ->setClass(GalleryAdmin::class)
            ;
        }
    }
}
