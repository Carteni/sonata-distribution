<?php
namespace AppAdminBundle\Block;

use AppBundle\Repository\PostRepository;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LatestPostBlock
 *
 * @package AppAdminBundle\Block
 */
class LatestPostBlock extends AbstractAdminBlockService
{
    /**
     * @var PostRepository
     */
    private $repo;

    /**
     * LatestPostBlock constructor.
     *
     * @param null $name
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface|null $templating
     * @param $repo
     */
    public function __construct($name = null, EngineInterface $templating = null, PostRepository $repo)
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
                                   'template' => '@AppAdmin/Block/block_latest_post.html.twig',
                                   'max_posts' => 3,
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
                                         'posts' => $this->repo->getLatest($settings['max_posts']),
                                     ],
                                     $response);
    }
}
