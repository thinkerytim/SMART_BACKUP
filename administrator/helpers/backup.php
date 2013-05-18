<?php
/**
 * @version     1.0.0
 * @package     com_smart_backup
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      The Thinkery, LLC <info@thethinkery.net> - http://www.thethinkery.net
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Backup helper.
 */
class BackupHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('com_smart_backup_TITLE_BACKUPS'),
			'index.php?option=com_smart_backup&view=backups',
			$vName == 'backups'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_smart_backup';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
