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

jimport('joomla.application.component.controllerform');

/**
 * Backup controller class.
 */
class BackupControllerBackup extends JControllerForm
{

    function __construct() {
        $this->view_list = 'backups';
        parent::__construct();
    }

}