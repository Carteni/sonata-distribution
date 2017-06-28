<?php
namespace AppAdminBundle\Block;

use AppBundle\Repository\CommentRepository;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FeaturedPostBlock
 *
 * @package AppAdminBundle\Block
 */
class FeaturedPostBlock extends AbstractPostBlock
{
    /**
     * FeaturedPostBlock constructor.
     *
     * @param null $name
     * @param EngineInterface|null $templating
     * @param CommentRepository $repo
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
        parent::configureSettings($resolver);

        $resolver->setDefaults([
                                   'template' => '@AppAdmin/Block/block_featured_post.html.twig',
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
     * @return array
     */
    protected function getPosts($settings = null)
    {
        return $this->repo->getFeatured();
    }
}
