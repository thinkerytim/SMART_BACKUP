<?php
/**
 * @version     1.0.0
 * @package     com_smart_backup
 * @copyright   Copyright (C) 2013. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      The Thinkery, LLC <info@thethinkery.net> - http://www.thethinkery.net
 */

// No direct access.
defined('_JEXEC') or die;

abstract class SmartBackup
{
	protected $database;
    protected $debug;

	public function __construct($debug = false) 
	{
        $this->database     = JFactory::getDBO();
        if($debug){
            $this->debug = true;
            JLog::addLogger( array('text_file' => 'smart_backup.log.php'));
            JLog::add("");
            JLog::add("********************* BEGINNING FILE HASH *******************");
            JLog::add("");
        }
	}
	
	/**
	 * Creates an ini file with path / hash pairs for all files in site.
	 *
	 * @param	array	Ignore list- array of directories to ignore.
	 * @return	string	Filename of new hashfile
	 * @since	1.0
	 */
	public static function createHashfile(){
		$i = 0;
		$d = 0;
		$start = microtime(true);
		$before = memory_get_usage();

		$file_hashes = new StdClass();
		$dir_hashes = new StdClass();

		$save_file = fopen(JPATH_COMPONENT_ADMINISTRATOR.'/hashfile.php', 'w');

		$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($site_root, FilesystemIterator::SKIP_DOTS));


		foreach ($files as $filename => $file) {
			//echo MD5_DIR($dir);
			 if(is_dir($file)){
					$dir_hashes->$filename = self::MD5_DIR( $file );
					$d++;
			 } else {
					$file_hashes->$filename = md5_file( $file );
					$i++;	
			 }
		}

		// first write the dirs
		foreach($dir_hashes as $k => $v){
			fwrite($save_file, $k.'='.$v."\n");
		}
		// then write the files
		foreach($file_hashes as $k => $v){
			fwrite($save_file, $k.'='.$v."\n");
		}

		fclose($save_file);
		$after = memory_get_usage();

		if($this->debug) JLog::add("Created hasfile: ".($after - $before) / 1024 / 1024 .' MB memory used');

		$end = microtime(true);
		$seconds = ($end - $start);
		if($this->debug) JLog::add($i." files, ".$d." directories processed in ".$seconds." seconds.");
		
	}
	
	private function MD5_DIR($dir)
	{
		if (!is_dir($dir))
		{
			return false;
		}

		$filemd5s = array();
		$d = dir($dir);

		while (false !== ($entry = $d->read()))
		{
			if ($entry != '.' && $entry != '..')
			{
				 if (is_dir($dir.'/'.$entry))
				 {
					 $filemd5s[] = MD5_DIR($dir.'/'.$entry);
				 }
				 else
				 {
					 $filemd5s[] = md5_file($dir.'/'.$entry);
				 }
			 }
		}
		$d->close();
		return md5(implode('', $filemd5s));
	}

}