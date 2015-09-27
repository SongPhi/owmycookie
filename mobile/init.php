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

if (!defined('DS')) define('DS',DIRECTORY_SEPARATOR);
define('OWMYCOOKIE_DIR_ROOT', dirname(__FILE__));
define('OWMYCOOKIE_DIR_USERFILES', OW::getPluginManager()->getPlugin('owmycookie')->getUserFilesDir());
define('OWMYCOOKIE_DIR_PLUGINFILES', OW::getPluginManager()->getPlugin('owmycookie')->getPluginFilesDir());
define('OWMYCOOKIE_DIR_STATICURL', OW::getPluginManager()->getPlugin('owmycookie')->getStaticUrl());

$eventHandler = new OWMYCOOKIE_CLASS_EventHandler();

OW::getEventManager()->bind(OW_EventManager::ON_BEFORE_DOCUMENT_RENDER, array($eventHandler, 'injectCookieConsent'));