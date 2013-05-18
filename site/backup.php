<?php
/**
 * @version     1.0.0
 * @package     com_backup
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Julio Delgado <pbass98@gmail.com> - http://
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

// Execute the task.
$controller	= JControllerLegacy::getInstance('Backup');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
