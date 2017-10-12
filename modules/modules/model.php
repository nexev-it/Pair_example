<?php

/**
 * @version	$Id$
 * @author	Viames Marino
 */

use Pair\Form;
use Pair\Model;

class ModulesModel extends Model {
	
	public function getModuleForm() {
	
		$form = new Form();
		$form->addInput('package')->setType('file')->setRequired();
		return $form;
	
	}
	
}
