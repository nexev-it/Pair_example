<?php
		
/**
 * @version	$Id$
 * @author	Viames Marino
 */

use Pair\View;
use Pair\Widget;

class RulesViewDefault extends View {

	public function render() {

		$this->app->pageTitle		= $this->lang('RULES');
		$this->app->activeMenuItem	= 'rules/default';

		$widget = new Widget();
		$this->app->breadcrumbWidget = $widget->render('breadcrumb');
		
		$widget = new Widget();
		$this->app->sideMenuWidget = $widget->render('sideMenu');
		
		$this->pagination->count = $this->model->countModules();

		// get all rules
		$rules = $this->model->getAclModelRules();

		foreach ($rules as $rule) {
			$rule->adminIcon = $rule->admin_only ? '<i class="fa fa-check fa-lg text-success"></i>' : '';
		}
		
		$this->assign('rules', $rules);

	}

}