<?php
/**
 * @version     1.0.0
 * @package     com_smart_backup
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      The Thinkery, LLC <info@thethinkery.net> - http://www.thethinkery.net
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JControllerLegacy::getInstance('Backup');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
