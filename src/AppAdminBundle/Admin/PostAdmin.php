<?php

namespace AppAdminBundle\Admin;

use AppBundle\Entity\Post;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class PostAdmin
 *
 * @package AppBundle\Admin
 */
class PostAdmin extends AbstractAdmin
{
	/*protected $datagridValues = array(
		'comments_enabled' => array(
			'type'  => EqualType::TYPE_IS_EQUAL,
			// => 1
			'value' => BooleanType::TYPE_NO
			// => 1
		),
	);*/

	public function toString($object)
	{
		return $object instanceof Post ? $object->getTitle() : 'Blog Post'; // shown in the breadcrumb on the create view
	}

	// Fields to be shown create/edit forms.

	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper->add('title')
				   ->add('content', null, array('required' => false))
				   ->add('comments_enabled')
				   ->add('status', ChoiceType::class, array(
					   'choices' => $this->getPostStatus(),
				   ))
				   ->add('category', 'sonata_type_model', array(
					   'required'    => false,
					   'btn_add'     => 'Add New Category',
					   'btn_delete'  => false,
					   'expanded'    => false,
					   'placeholder' => 'No Category selected',
				   ));
	}

	// Fields to be shown on filter forms.

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper->add('title', null, array('advanced_filter' => false))
					   ->add('comments_enabled', null, array(
						   'advanced_filter' => false,
						   'operator_type'   => 'sonata_type_boolen',
					   ))
					   ->add('status', 'doctrine_orm_string', array(
						   'advanced_filter' => false,
					   ), ChoiceType::class, array('choices' => $this->getPostStatus(),))
					   ->add('category', null, array('advanced_filter' => false), 'entity', array(
						   'class'        => 'Application\Sonata\ClassificationBundle\Entity\Category',
						   'choice_label' => 'name',
					   ));
	}

	// Fields to be shown on lists.

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper->addIdentifier('title')
				   ->add('slug')
				   ->add('last_modified')
				   ->add('comments_enabled', 'boolean')
				   ->add('status')
				   ->add('category.name')
				   ->add('_actions', 'actions', array(
					   'actions' => array(
						   'edit'   => array(),
						   'delete' => array(),
					   ),
				   ));

	}

	private function getPostStatus()
	{
		return array(
			'Draft'     => Post::POST_DRAFT,
			'Published' => Post::POST_PUBLISHED,
		);
	}

	// Applica il filtro al caricamento della lista.
	/*public function configureDefaultFilterValues(array &$filterValues)
	{
		$filterValues['comments_enabled'] = array(
				'type'  => EqualType::TYPE_IS_EQUAL,
				'value' => BooleanType::TYPE_YES,
		);
	}*/
}
