<?php

namespace AppAdminBundle\Block;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractPostBlock
 *
 * @package AppAdminBundle\Block
 */
class AbstractPostBlock extends AbstractAdminBlockService
{
    protected $repo;

    /**
     * AbstractPostBlock constructor.
     *
     * @param null $name
     * @param EngineInterface|null $templating
     */
    public function __construct($name = null, EngineInterface $templating = null)
    {
        parent::__construct($name, $templating);
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                                   'title' => $this->getName(),
                                   'catalogue' => 'SonataAdminBundle',
                               ]);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        // merge settings
        $settings = $blockContext->getSettings();

        return $this->renderResponse($blockContext->getTemplate(),
                                     [
                                         'block' => $blockContext->getBlock(),
                                         'settings' => $settings,
                                         'posts' => static::getPosts($settings),
                                     ],
                                     $response);
    }
}
