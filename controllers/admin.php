<?php
/**
 * Copyright (c) 2015 thaolt@songphi.com
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 **/

class OWMYCOOKIE_CTRL_Admin extends ADMIN_CTRL_Abstract
{
    
    private $menu = null;

    private $themes = array(
        'dark-bottom',
        'dark-floating',
        'dark-floating-tada' => array(
            'icon' => 'dark-floating',
            'preview' => 'dark-floating',
            'desc' => 'dark-floating with tada special effect'
        ),
        'dark-top',
        'light-bottom',
        'light-top',
        'light-floating',
    );
    
    public function __construct() {
        $this->menu = $this->getMenu();
        $this->addComponent('menu', $this->menu);
        parent::__construct();
    }
    
    public function setPageHeading($heading) {
    	if (strlen($heading)>0)
        	$heading = 'Cookie Consent :: ' . $heading;
        else
        	$heading = 'Cookie Consent';
        
        return parent::setPageHeading($heading);
    }
    
    public function index() {
        $language = OW::getLanguage();
        $this->setPageHeading('');

    }

    public function appearance() {
        $language = OW::getLanguage();
        $this->setPageHeading($language->text('owmycookie','setting_appearance'));

        OW::getDocument()->addScript( OW::getPluginManager()->getPlugin('admin')->getStaticUrl() . 'js/theme_select.js');

        $themesInfo = array();

        $langData = array(
            'deleteConfirmMsg' => $language->text('admin', 'themes_choose_delete_confirm_msg'),
            'deleteActiveThemeMsg' => $language->text('admin', 'themes_cant_delete_active_theme')
        );

        foreach ($variable as $key => $value) {
            # code...
        }

        /* @var $theme BOL_Theme */
        foreach ( $this->themes as $key => $theme)
        {
            if (!is_array($theme)) {
                $key = $theme;
                $theme = array();
                $theme['icon'] = $key;
                $theme['preview'] = $key;
                $theme['desc'] = $key;
            }

            $themesInfo[$key]['description'] = '';
            $themesInfo[$key]['key'] = $key;
            $themesInfo[$key]['title'] = $key;
            $themesInfo[$key]['iconUrl'] = OWMYCOOKIE_BOL_Service::getInstance()->getImgUrl('themeicons/'.$theme['icon'].'.png');
            $themesInfo[$key]['previewUrl'] = OWMYCOOKIE_BOL_Service::getInstance()->getImgUrl('themeicons/'.$theme['preview'].'.png');
            $themesInfo[$key]['active'] = false;
            $themesInfo[$key]['changeUrl'] = '';
            $themesInfo[$key]['update_url'] = '';            
        }

        $this->assign('themesInfo',$themesInfo);
        $themesInfo = json_encode($themesInfo);

        $langData = json_encode($langData);

        OW::getDocument()->addOnloadScript(<<<JSCRIPT

        window.cookieconsent_theme = new ThemesSelect({$themesInfo},{$langData});

JSCRIPT
        );
    }
    
    private function getMenu() {
        $language = OW::getLanguage();
        
        $menu = new BASE_CMP_ContentMenu();
        $menuItems = array();
        
        $item = new BASE_MenuItem();
        $item->setLabel($language->text('owmycookie', 'adm_menu_settings'));
        $item->setUrl(OW::getRouter()->urlForRoute('owmycookie.admin'));
        $item->setKey('setting');
        $item->setIconClass('ow_ic_gear_wheel');
        $item->setOrder(0);
        $menuItems[] = $item;

        $item = new BASE_MenuItem();
        $item->setLabel($language->text('owmycookie', 'adm_menu_appearance'));
        $item->setUrl(OW::getRouter()->urlForRoute('owmycookie.admin_appearance'));
        $item->setKey('appearance');
        $item->setIconClass('ow_ic_monitor');
        $item->setOrder(1);
        $menuItems[] = $item;
        
        $item = new BASE_MenuItem();
        $item->setLabel($language->text('owmycookie', 'adm_menu_help'));
        $item->setUrl(OW::getRouter()->urlForRoute('owmycookie.admin_help'));
        $item->setKey('help');
        $item->setIconClass('ow_ic_help');
        $item->setOrder(2);
        $menuItems[] = $item;
        
        $menu->setMenuItems($menuItems);
        $menu->deactivateElements();
        
        return $menu;
    }
    
    public function help() {
        $language = OW::getLanguage();
        $this->setPageHeading($language->text('owmycookie', 'adm_menu_help'));
    }
    
    public function saveconfig(array $params) {
        $configs = SPVIDEOLITE_BOL_Configs::getInstance();
        $configs->set($_POST['key'], $_POST['value']);
        die('aaa');
    }
}



/**
 * Save Configurations form class
 */
class OWMYCOOKIE_ConfigForm extends Form
{

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        parent::__construct('configForm');

        $language = OW::getLanguage();

        // player width Field
        $linkField = new TextField('link');
        $linkField->addValidator($wValidator);
        $this->addElement($linkField);        

        // submit
        $submit = new Submit('save');
        $submit->setValue($language->text('owmycookie', 'btn_save'));
        $this->addElement($submit);
    }

    /**
     * Updates video plugin configuration
     *
     * @return boolean
     */
    public function process()
    {
        $values = $this->getValues();

        $config = OWMYCOOKIE_BOL_Configs::getInstance();

        $config->set('link',$values['link']);

        return array('result' => true);
    }
}


