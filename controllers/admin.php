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
    
    function __construct() {
        $this->menu = $this->getMenu();
        $this->addComponent('menu', $this->menu);
        parent::__construct();
    }
    
    function setPageHeading($heading) {
    	if (strlen($heading)>0)
        	$heading = 'Cookie Consent :: ' . $heading;
        else
        	$heading = 'Cookie Consent';
        
        return parent::setPageHeading($heading);
    }
    
    function index() {
        $language = OW::getLanguage();
        $this->setPageHeading('');
    }
    
    function getMenu() {
        $language = OW::getLanguage();
        
        $menu = new BASE_CMP_ContentMenu();
        $menuItems = array();
        
        $item = new BASE_MenuItem();
        $item->setLabel($language->text('owmycookie', 'adm_menu_settings'));
        $item->setUrl(OW::getRouter()->urlForRoute('owmycookie.admin'));
        $item->setKey('tweaks');
        $item->setIconClass('ow_ic_gear_wheel');
        $item->setOrder(0);
        $menuItems[] = $item;
        
        $item = new BASE_MenuItem();
        $item->setLabel($language->text('owmycookie', 'adm_menu_help'));
        $item->setUrl(OW::getRouter()->urlForRoute('owmycookie.admin_help'));
        $item->setKey('help');
        $item->setIconClass('ow_ic_help');
        $item->setOrder(1);
        $menuItems[] = $item;
        
        $menu->setMenuItems($menuItems);
        $menu->deactivateElements();
        
        return $menu;
    }
    
    function help() {
        $language = OW::getLanguage();
        $this->setPageHeading($language->text('owmycookie', 'adm_menu_help'));
    }
    
    public function saveconfig(array $params) {
        $configs = SPVIDEOLITE_BOL_Configs::getInstance();
        $configs->set($_POST['key'], $_POST['value']);
        die('aaa');
    }
}

