<?php
namespace AppAdminBundle\Block;

use AppBundle\Repository\CommentRepository;
use AppBundle\Repository\PostRepository;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FeaturedPostBlock
 *
 * @package AppAdminBundle\Block
 */
class FeaturedPostBlock extends AbstractAdminBlockService
{
    /**
     * @var CommentRepository
     */
    private $repo;

    /**
     * FeaturedPostBlock constructor.
     *
     * @param null $name
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface|null $templating
     * @param \AppBundle\Repository\CommentRepository $repo
     */

    public function __construct($name = null, EngineInterface $templating = null, CommentRepository $repo)
    {
        parent::__construct($name, $templating);

        $this->repo = $repo;
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                                   'title' => $this->getName(),
                                   'template' => '@AppAdmin/Block/block_featured_post.html.twig',
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
                                         'posts' => $this->repo->getFeatured(),
                                     ],
                                     $response);
    }
}
