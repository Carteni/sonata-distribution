<?php

namespace Application\Sonata\MediaBundle\Controller;

use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MediaAdminController
 *
 * @package Application\Sonata\MediaBundle\Controller
 */
class MediaAdminController extends \Sonata\MediaBundle\Controller\MediaAdminController
{
	/**
	 * {@inheritdoc}
	 */
	public function listAction(Request $request = null)
	{
		$this->admin->checkAccess('list');

		if ($listMode = $request->get('_list_mode', 'mosaic')) {
			$this->admin->setListMode($listMode);
		}

		$datagrid = $this->admin->getDatagrid();

		$filters = $request->get('filter');

		// set the default context
		if (!$filters || !array_key_exists('context', $filters)) {
			$context = $this->admin->getPersistentParameter('context', $this->get('sonata.media.pool')
																			->getDefaultContext());
		} else {
			$context = $filters['context']['value'];
		}

		$datagrid->setValue('context', null, $context);

		$rootCategory = null;
		if ($this->has('sonata.classification.manager.category')) {
			$rootCategory = $this->get('sonata.classification.manager.category')
								 ->getRootCategoriesForContext($this->get('sonata.classification.manager.context')
																	->find($context));
		}

		if ((null !== $rootCategory && !empty($rootCategory)) && !$filters) {
			$datagrid->setValue('category', null, current($rootCategory)->getId());
		}
		if ($this->has('sonata.media.manager.category') && $request->get('category')) {
			$category = $this->get('sonata.media.manager.category')
							 ->findOneBy(array(
								 'id'      => (int)$request->get('category'),
								 'context' => $context,
							 ));

			if (!empty($category)) {
				$datagrid->setValue('category', null, $category->getId());
			} else {
				$datagrid->setValue('category', null, current($rootCategory)->getId());
			}
		}

		$formView = $datagrid->getForm()
							 ->createView();

		$this->setFormTheme($formView, $this->admin->getFilterTheme());

		return $this->render($this->admin->getTemplate('list'), array(
			'action'        => 'list',
			'form'          => $formView,
			'datagrid'      => $datagrid,
			'root_category' => $rootCategory,
			'csrf_token'    => $this->getCsrfToken('sonata.batch'),
		));
	}

	/**
	 * Sets the admin form theme to form view. Used for compatibility between Symfony versions.
	 *
	 * @param FormView $formView
	 * @param string $theme
	 */
	private function setFormTheme(FormView $formView, $theme)
	{
		$twig = $this->get('twig');

		// BC for Symfony < 3.2 where this runtime does not exists
		if (!method_exists('Symfony\Bridge\Twig\AppVariable', 'getToken')) {
			$twig->getExtension('Symfony\Bridge\Twig\Extension\FormExtension')->renderer->setTheme($formView, $theme);

			return;
		}
		$twig->getRuntime('Symfony\Bridge\Twig\Form\TwigRenderer')
			 ->setTheme($formView, $theme);
	}

}