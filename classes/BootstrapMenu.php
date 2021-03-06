<?php

use Pair\Application;
use Pair\Menu;

/**
 * Create a side menu with Bootstrap classes and FontAwesome icons.
 */
class BootstrapMenu extends Menu {

	/**
	 * Builds HTML of this menu.
	 *
	 * @return string
	 */
	public function render(): string {
		
		$ret = '';
		
		$app = Application::getInstance();
		$this->activeItem = $app->activeMenuItem;

		foreach ($this->items as $item) {

			switch ($item->type) {

				// single menu item rendering
				case 'single':

					// check permissions
					if (!isset($item->url) or (is_a($app->currentUser, 'Pair\User') and !$app->currentUser->canAccess($item->url))) {
						continue 2;
					}
		
					$active = ($item->url == $this->activeItem ? ' class="active"' : '');

					$ret .= '<li' . $active . '><a href="' . $item->url . '"' . ($item->target ? ' target="' . $item->target . '"' : '') .
						'><i class="fa fa-lg fa-fw ' . $item->class . '"></i> <span class="nav-label">' . $item->title .'</span> ' .
						($item->badge ? '<span class="float-right label label-primary">' . $item->badge . '</span>' : '') . '</a></li>';

					break;

				// menu item with many sub-items rendering
				case 'multi':

					$links		= '';
					$menuClass	= '';
					$secLevel	= '';

					// builds each sub-item link
					foreach ($item->list as $i) {

						// check on permissions
						if (isset($i->url) and (!is_a($app->currentUser, 'Pair\User') or !$app->currentUser->canAccess($i->url))) {
							continue;
						}

						if ($i->url == $this->activeItem) {
							$active		= 'active';
							$menuClass	= 'active';
							$secLevel	= ' in';
						} else {
							$active		= '';
						}

						$links .=
							'<li class="' . $active . '"><a href="' . $i->url . '">' .
							'<i class="fa fa-fw ' . $i->class . '"></i>' . $i->title .
							($i->badge ? '<span class="float-right label label-primary">' . $i->badge . '</span>' : '') .
							'</a></li>';

					}

					// prevent empty multi-menu
					if ('' == $links) {
						break;
					}

					// assembles the multi-menu
					$ret .=
						'<li class="has-sub ' . $menuClass . '">' .
						'<a href="javascript:;">
								<i class="fa fa-fw ' . ($item->class ? $item->class : 'fa-th-large') . '"></i>
								<span class="nav-label">' . $item->title . '</span>
								<span class="fal fa-angle-down float-right"></span>
						</a>' .
						'<ul class="nav nav-second-level collapse">' . $links . '</ul></li>';
					break;

			}

		}

		return $ret;

	}

}
