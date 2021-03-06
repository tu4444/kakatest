<?php
/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2016 LYRASOFT. All rights reserved.
 * @license    GNU General Public License version 2 or later.
 */

namespace Windwalker\Controller\Edit;

use Windwalker\Controller\Admin\AbstractItemController;

defined('_JEXEC') or die;

/**
 * Cancel Controller
 *
 * @since 2.0
 */
class CancelController extends AbstractItemController
{
	/**
	 * Are we allow return?
	 *
	 * @var  boolean
	 */
	protected $allowReturn = true;

	/**
	 * Generic method to cancel
	 *
	 * @return  boolean  True on success.
	 */
	protected function doExecute()
	{
		// Attempt to check-in the current record.
		$data = array('cid' => array($this->recordId), 'quiet' => true);

		$this->fetch($this->prefix, $this->viewList . '.check.checkin', $data);

		// Clean the session data and redirect.
		$this->releaseEditId($this->context, $this->recordId);
		$this->app->setUserState($this->context . '.data', null);

		$this->setRedirect($this->getSuccessRedirect());

		return true;
	}

	/**
	 * Set redirect URL for action success.
	 *
	 * @return  string  Redirect URL.
	 */
	public function getSuccessRedirect()
	{
		$this->input->set('layout', null);

		return \JRoute::_($this->getRedirectListUrl(), false);
	}
}
