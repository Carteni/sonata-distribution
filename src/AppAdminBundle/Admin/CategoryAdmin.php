<?php

namespace AppAdminBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * Class CategoryAdmin
 *
 * @package AppAdminBundle\Admin
 */
class CategoryAdmin extends AbstractAdmin
{
	// Fields to be shown create/edit forms.
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper->add('name');
	}

	// Fields to be shown on filter forms.
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper->add('name');
	}

	// Fields to be shown on lists.
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper->addIdentifier('name')
				   ->add('_actions', 'actions', array(
					   'actions' => array('edit' => array()),
				   ));

	}

}