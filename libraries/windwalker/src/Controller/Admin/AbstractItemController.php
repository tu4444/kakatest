<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\Controller\Admin;

use Windwalker\String\StringInflector as Inflector;;
use Windwalker\Helper\ArrayHelper;
use Windwalker\Helper\ContextHelper;

/**
 * The Controller to handle single item.
 *
 * @since  2.0
 */
abstract class AbstractItemController extends AbstractAdminController
{
	/**
	 * Record ID.
	 *
	 * @var mixed
	 */
	protected $recordId = null;

	/**
	 * An array of input data.
	 *
	 * @var array
	 */
	protected $data = null;

	/**
	 * Instantiate the controller.
	 *
	 * @param   \JInput           $input   The input object.
	 * @param   \JApplicationCms  $app     The application object.
	 * @param   array             $config  The config object.
	 */
	public function __construct(\JInput $input = null, \JApplicationCms $app = null, $config = array())
	{
		parent::__construct($input, $app, $config);

		// Guess the item view as the context.
		$this->viewItem = $this->viewItem ? : ArrayHelper::getValue($config, 'view_item', $this->getName());

		// Guess the list view as the plural of the item view.
		$this->viewList = $this->viewList ? : ArrayHelper::getValue($config, 'view_list');

		if (empty($this->viewList))
		{
			$inflector = Inflector::getInstance();

			$this->viewList = $inflector->toPlural($this->viewItem);
		}
	}

	/**
	 * Prepare execute hook.
	 *
	 * @return void
	 */
	protected function prepareExecute()
	{
		$this->context = ContextHelper::fromController($this, 'edit');

		parent::prepareExecute();

		$this->recordId = $this->input->get($this->urlVar);

		// Populate the row id from the session.
		$this->data[$this->key] = $this->recordId;
	}


	/**
	 * Method to add a record ID to the edit list.
	 *
	 * @param   string   $context  The context for the session storage.
	 * @param   integer  $id       The ID of the record to add to the edit list.
	 *
	 * @return  void
	 */
	protected function holdEditId($context, $id)
	{
		$values = (array) $this->app->getUserState($context . '.id');

		// Add the id to the list if non-zero.
		if (!empty($id))
		{
			array_push($values, $id);
			$values = array_unique($values);
			$this->app->setUserState($context . '.id', $values);

			if (defined('JDEBUG') && JDEBUG)
			{
				\JLog::add(
					sprintf(
						'Holding edit ID %s.%s %s',
						$context,
						$id,
						str_replace("\n", ' ', print_r($values, 1))
					),
					\JLog::INFO,
					'controller'
				);
			}
		}
	}

	/**
	 * Method to check whether an ID is in the edit list.
	 *
	 * @param   string   $context  The context for the session storage.
	 * @param   integer  $id       The ID of the record to add to the edit list.
	 *
	 * @return  void
	 */
	protected function releaseEditId($context, $id)
	{
		$values = (array) $this->app->getUserState($context . '.id');

		// Do a strict search of the edit list values.
		$index = array_search($id, $values, true);

		if (is_int($index))
		{
			unset($values[$index]);
			$this->app->setUserState($context . '.id', $values);

			if (defined('JDEBUG') && JDEBUG)
			{
				\JLog::add(
					sprintf(
						'Releasing edit ID %s.%s %s',
						$context,
						$id,
						str_replace("\n", ' ', print_r($values, 1))
					),
					\JLog::INFO,
					'controller'
				);
			}
		}
	}

	/**
	 * Method to check whether an ID is in the edit list.
	 *
	 * @param   string   $context  The context for the session storage.
	 * @param   integer  $id       The ID of the record to add to the edit list.
	 *
	 * @return  boolean  True if the ID is in the edit list.
	 */
	protected function checkEditId($context, $id)
	{
		if ($id)
		{
			$values = (array) $this->app->getUserState($context . '.id');

			$result = in_array($id, $values);

			if (defined('JDEBUG') && JDEBUG)
			{
				\JLog::add(
					sprintf(
						'Checking edit ID %s.%s: %d %s',
						$context,
						$id,
						(int) $result,
						str_replace("\n", ' ', print_r($values, 1))
					),
					\JLog::INFO,
					'controller'
				);
			}

			return $result;
		}
		else
		{
			// No id for a new item.
			return true;
		}
	}

	/**
	 * Set redirect URL for action success.
	 *
	 * @return  string  Redirect URL.
	 */
	public function getSuccessRedirect()
	{
		return \JRoute::_($this->getRedirectItemUrl($this->recordId, $this->urlVar), false);
	}

	/**
	 * Set redirect URL for action failure.
	 *
	 * @return  string  Redirect URL.
	 */
	public function getFailRedirect()
	{
		return \JRoute::_($this->getRedirectListUrl(), false);
	}
}
