<?php

namespace AppAdminBundle\Admin;

use AppBundle\Entity\Comment;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CommentAdmin
 *
 * @package AppAdminBundle\Admin
 */
class CommentAdmin extends AbstractAdmin
{
    /**
     * @var array
     */
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by' => 'created_at',
    ];
    protected $baseRoutePattern = 'comment';
    protected $baseRouteName = 'comment';
    protected $translationDomain = 'SonataAdminBundle';
    protected $parentAssociationMapping = 'post';

    public function toString($object)
    {
        return $object instanceof Comment ? $object->getId() : 'Comment'; // shown in the breadcrumb on the create view
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('comment')
            ->add('author', 'sonata_type_model', ['btn_add' => false,])
            ->add('post',
                  'sonata_type_model_list',
                  [
                      'btn_add' => false,
                      'btn_delete' => false,
                  ])
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('id')
            ->add('comment',
                  'string',
                  [
                      'template' => '@AppAdmin/comment_list_field.html.twig',
                  ])
            ->add('post.title')
            ->add('created_at')
            ->add('author',
                  null,
                  [
                      'label' => 'Author',
                      'template' => '@AppAdmin/author_list_field.html.twig',
                  ])
        ;
    }
}
