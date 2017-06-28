<?php
namespace AppAdminBundle\Block;

use AppBundle\Repository\PostRepository;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class LatestPostBlock
 *
 * @package AppAdminBundle\Block
 */
class LatestPostBlock extends AbstractPostBlock
{
    /**
     * LatestPostBlock constructor.
     *
     * @param null $name
     * @param EngineInterface|null $templating
     * @param PostRepository $repo
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
        parent::configureSettings($resolver);

        $resolver->setDefaults([
                                   'template' => '@AppAdmin/Block/block_latest_post.html.twig',
                                   'max_posts' => 3,
                               ]);
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        return parent::execute($blockContext, $response);
    }

    /**
     * @param $settings
     *
     * @return \AppBundle\Entity\Post[]
     */
    protected function getPosts($settings = null)
    {
        return $this->repo->getLatest($settings['max_posts']);
    }
}
