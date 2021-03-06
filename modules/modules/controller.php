<?php

use Pair\Breadcrumb;
use Pair\Controller;
use Pair\Module;
use Pair\Plugin;
use Pair\Upload;

class ModulesController extends Controller {

	/**
	 * This function being invoked before everything here.
	 * @see Controller::init()
	 */
	protected function init() {
		
		// removes files older than 30 minutes
		Plugin::removeOldFiles();
		
		$breadcrumb = Breadcrumb::getInstance();
		$breadcrumb->addPath('Moduli', 'modules/default');
		
	}
	
	public function downloadAction() {
		
		$object = $this->getObjectRequestedById('Pair\Module');
		$plugin = $object->getPlugin();
		$plugin->downloadPackage();
		
	}
	
	public function addAction() {
		
		$this->view = 'default';
	
		// collects file infos
		$upload = new Upload('package');

		// checks for common upload errors
		if ($upload->getLastError()) {
			$this->logError($this->lang('ERROR_ON_UPLOADED_FILE'));
			return;
		} else if ('zip'!=$upload->type) {
			$this->logError($this->lang('UPLOADED_FILE_IS_NOT_ZIP'));
			return;
		} 
		
		// saves the file on /temp folder
		$upload->save(APPLICATION_PATH . '/' . Plugin::TEMP_FOLDER);

		// installs the package
		$plugin = new Plugin();
		$res = $plugin->installPackage($upload->path . $upload->filename);
		
		if ($res) {
			$this->enqueueMessage($this->lang('MODULE_HAS_BEEN_INSTALLED_SUCCESFULLY'));
		} else {
			$this->enqueueError($this->lang('MODULE_HAS_NOT_BEEN_INSTALLED'));			
		}
		
	}
	
	public function deleteAction() {
		
		$module = $this->getObjectRequestedById('Pair\Module');
		
		if ($module->delete()) {
			$this->enqueueMessage($this->lang('MODULE_HAS_BEEN_REMOVED_SUCCESFULLY'));
			$this->redirect('modules/default');
		} else {
			$this->enqueueError($this->lang('MODULE_HAS_NOT_BEEN_REMOVED'));
			$this->view = 'default';
			$this->router->action = 'default';
			$this->router->resetParams();
		}

	}
	
}
