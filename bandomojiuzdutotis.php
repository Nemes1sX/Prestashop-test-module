<?php
# /modules/bandomojiuzdutotis/bandomojiuzdutotis.php

/**
 * Bandomoji uzduotis - A Prestashop Module
 * 
 * Test
 * 
 * @author Kazimieras Stonkus <kazstonk@gmail.com>
 * @version 0.0.1
 */

if (!defined('_PS_VERSION_')) exit;

// We look for our model since we want to install its SQL from the module install
require_once(__DIR__ . '/models/UzduotisModel.php');

class BandomojiUzdutotis extends Module
{
	const DEFAULT_CONFIGURATION = [
		// Put your default configuration here, e.g :
		// 'BANDOMOJIUZDUTOTIS_BACKGROUND_COLOR' => '#eee',
	];

	public function __construct()
	{
		$this->initializeModule();
	}

	public function install()
	{

        $sql = "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."customers`(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `first_name` VARCHAR(256) NOT NULL, `last_name` VARCHAR(256) NOT NULL)";

        if (!$result = Db::getInstance()->execute($sql)) {
            return false;
        }

		return
			parent::install()
			&& $this->installTab()
			&& $this->initDefaultConfigurationValues()
			&& UzduotisModelModel::installSql()
		;
	}

	public function uninstall()
	{
		return
			parent::uninstall()
			&& $this->uninstallTab()
            && UzduotisModelModel::uninstallSql()
		;
	}
	
	/** Module configuration page */
	public function getContent()
	{
		return 'Bandomoji uzduotis configuration page !'.$this->displayForm();
	}

    public function displayForm()
    {
        // Get default language
        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');

        //Option values
        $options = array(
            array(
                'id_option' => 1,
                'name' => 'Lengva'
            ),
            array(
                'id_option' => 2,
                'name' => 'Vidutiniskai sunki'
            ),
            array(
                'id_option' => 3,
                'name' => 'Sunki'
            ),
        );


        // Init Fields form array
        $fieldsForm[0]['form'] = [
            'legend' => [
                'title' => $this->l('Settings'),
            ],
            'input' => [
                [
                    'type' =>  'text',
                    'label' => $this->l('Uzduoties pavadinimas'),
                    'name' => 'UZD_PAV',
                    'size' => 20,
                    'required' => true,
                ],
                [
                    'type' => 'select',
                    'label' => $this->l('Uzduoties sunkumas'),
                    'options' => array(
                        'query' => $options,
                        'id' => 'id_option',
                        'name' => 'name',
                    ),
                    'name' => 'UZD_SUN',
                    'size' => 20,
                    'required' => true
                ]
            ],
            'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            ]
        ];

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $helper->default_form_language = $defaultLang;
        $helper->allow_employee_form_lang = $defaultLang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                    '&token='.Tools::getAdminTokenLite('AdminModules'),
            ],
            'back' => [
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            ]
        ];

        // Load current value
        $helper->fields_value['UZD_PAV'] = Tools::getValue('UZD_PAV', Configuration::get('UZD_PAV'));
        $helper->fields_value['UZD_SUN'] = Tools::getValue('UZD_SUN', Configuration::get('UZD_SUN'));


        return $helper->generateForm($fieldsForm);
    }

	/** Initialize the module declaration */
	private function initializeModule()

	{
		$this->name = 'bandomojiuzdutotis';
		$this->tab = 'front_office_features';
		$this->version = '0.0.1';
		$this->author = 'Kazimieras Stonkus';
		$this->need_instance = 0;
		$this->ps_versions_compliancy = [
			'min' => '1.6',
			'max' => _PS_VERSION_,
		];
		$this->bootstrap = true;
		
		parent::__construct();

		$this->displayName = $this->l('Bandomoji uzduotis');
		$this->description = $this->l('Test');
		$this->confirmUninstall = $this->l('Are you sure you want to uninstall this module ?');
	}

	/** Set module default configuration into database */
	private function initDefaultConfigurationValues()
	{
		foreach (self::DEFAULT_CONFIGURATION as $key => $value) {
			if (!Configuration::get($key)) {
				Configuration::updateValue($key, $value);
			}
		}

		return true;
	}

	/** Install module tab, to your admin controller */
	private function installTab()
	{
		$languages = Language::getLanguages();
		
		$tab = new Tab();
		$tab->class_name = 'AdminUzduotisAdmin';
		$tab->module = $this->name;
		$tab->id_parent = (int)Tab::getIdFromClassName('DEFAULT');

		foreach ($languages as $lang) {
			$tab->name[$lang['id_lang']] = 'Bandomoji uzduotis';
		}

		try {
			$tab->save();
		} catch (Exception $e) {
			return false;
		}

		return true;
	}

	/** Uninstall module tab */
	private function uninstallTab()
	{
		$tab = (int)Tab::getIdFromClassName('AdminUzduotisAdmin');

		if ($tab) {
			$mainTab = new Tab($tab);

			try {
				$mainTab->delete();
			} catch (Exception $e) {
				echo $e->getMessage();

				return false;
			}
		}

		return true;
	}
}

