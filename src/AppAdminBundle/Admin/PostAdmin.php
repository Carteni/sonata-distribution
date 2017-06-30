<?php

namespace AppAdminBundle\Admin;

use AppBundle\Entity\Post;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class PostAdmin
 *
 * @package AppBundle\Admin
 */
class PostAdmin extends AbstractAdmin
{
    /**
     * @var array
     */
    protected $datagridValues = [
        '_sort_order' => 'DESC',
        '_sort_by' => 'last_modified',
    ];
    protected $baseRouteName = 'app_post';
    protected $baseRoutePattern = 'post';
    protected $translationDomain = 'SonataAdminBundle';

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title', null, ['advanced_filter' => false])
            ->add('comments_enabled',
                  null,
                  [
                      'advanced_filter' => false,
                      'operator_type' => 'sonata_type_boolen',
                  ])
            ->add('status',
                  'doctrine_orm_string',
                  [
                      'advanced_filter' => false,
                  ],
                  'choice',
                  [
                      'choices' => Post::getStatusList(),
                      'translation_domain' => 'SonataAdminBundle',
                  ])
            ->add('category',
                  null,
                  ['advanced_filter' => false],
                  'entity',
                  [
                      'class' => 'Application\Sonata\ClassificationBundle\Entity\Category',
                      'choice_label' => 'name',
                  ])
        ;
    }

    // Fields to be shown create/edit forms.

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('title')
            ->add('content',
                  CKEditorType::class,
                  [
                      'required' => false,
                      'config_name' => 'default',
                  ])
            ->add('comments_enabled')
            ->add('status',
                  'choice',
                  [
                      'choices' => Post::getStatusList(),
                      'translation_domain' => 'SonataAdminBundle',
                  ])
            ->add('category',
                  'sonata_type_model',
                  [
                      'required' => false,
                      'btn_add' => 'Add New Category',
                      'btn_delete' => false,
                      'expanded' => false,
                      'placeholder' => 'No Category selected',
                  ])
        ;
    }

    // Fields to be shown on filter forms.

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title')
            ->add('comments',
                  'integer',
                  [
                      'template' => '@AppAdmin/post_comment_count_list_field.html.twig',
                      'sortable' => true,
                  ])
            ->add('last_modified')
            ->add('comments_enabled', 'boolean')
            ->add('status',
                  'string',
                  [
                      'template' => '@AppAdmin/status_list_field.html.twig',
                  ])
            ->add('category.name')
            ->add('_actions',
                  'actions',
                  [
                      'actions' => [
                          'edit' => [],
                          'delete' => [],
                          'comments' => ['template' => '@AppAdmin/post_comment_action_list_field.html.twig'],
                      ],
                  ])
        ;
    }

    // Fields to be shown on lists.

    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!in_array($action, ['edit'])) {
            return;
        }

        $menu->addChild('comments',
                        [
                            'attributes' => ['dropdown' => true],
                            'label' => 'post.comment.label',
                        ])
            ->setExtra('translation_domain', 'SonataAdminBundle')
        ;

        $menu['comments']->addChild('list',
                                    [
                                        'uri' => $this->generateUrl(CommentAdmin::class.".list",
                                                                    [
                                                                        'id' => $this->getSubject()
                                                                            ->getId(),
                                                                    ]),
                                        'label' => 'post.comment.list',
                                    ]);

        $menu['comments']->addChild('create',
                                    [
                                        'uri' => $this->generateUrl(CommentAdmin::class.".create",
                                                                    [
                                                                        'id' => $this->getSubject()
                                                                            ->getId(),
                                                                    ]),
                                        'label' => 'post.comment.create',
                                    ]);
    }

    // https://stackoverflow.com/questions/26745512/sonata-symfony-parent-child-structure-setup

    public function toString($object)
    {
        return $object instanceof Post ? $object->getTitle() : 'Blog Post'; // shown in the breadcrumb on the create view
    }
}

