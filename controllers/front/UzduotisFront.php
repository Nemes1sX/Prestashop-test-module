<?php
# /modules/bandomojiuzdutotis/controllers/front/UzduotisFront.php

/**
 * Bandomoji uzduotis - A Prestashop Module
 * 
 * Test
 * 
 * @author Kazimieras Stonkus <kazstonk@gmail.com>
 * @version 0.0.1
 */

if (!defined('_PS_VERSION_')) exit;

// You can now access this controller from /index.php?fc=module&module=bandomojiuzdutotis&controller=UzduotisFront
class BandomojiUzdutotisUzduotisFrontModuleFrontController extends ModuleFrontController
{
	public function __construct()
	{
		parent::__construct();
		// Do your stuff here
	}

	public function initContent()
	{
		$this->context->smarty->assign([
			'greetingsFront' => 'Hello Front from Bandomoji uzduotis !',
		]);

		$this->setTemplate('my-front-template.tpl');
		// Don't forget to create /modules/bandomojiuzdutotis/views/templates/front/my-front-template.tpl

		parent::initContent();
	}
}

