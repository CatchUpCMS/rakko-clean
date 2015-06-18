<?php
namespace App\Modules\General\Http\ViewComposers;

use App\Modules\General\Http\Domain\Models\Menu;
// use Page;
// use PhotoGallery;
// use FormPost;
use App\Modules\General\Http\Domain\Menu\MenuInterface;

/**
 * Class MenuComposer
 * @package Fully\Composers
 * @author Sefa Karagöz
 */
class MenuComposer {


	/**
	 * @var \Fully\Repositories\Menu\MenuInterface
	 */
	protected $menu;

	/**
	 * @param MenuInterface $menu
	 */
	public function __construct(MenuInterface $menu){

		$this->menu=$menu;
	}

	/**
	 * @param $view
	 */
	public function compose($view) {

		$items = $this->menu->all();
		$menus = $this->menu->getFrontMenuHTML($items);
		$view->with('menus', $menus);
	}


}
