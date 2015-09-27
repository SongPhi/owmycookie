<?php
/**
 * Copyright 2015 SongPhi
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
 */

try {
	OW::getPluginManager()->addPluginSettingsRouteName('owmycookie', 'owmycookie.admin');
} catch (Exception $e) { }

try {
	BOL_LanguageService::getInstance()->addPrefix('owmycookie','Cookie Consent');
} catch (Exception $e) { }

$path = dirname(__FILE__) . DS . 'langs.zip';
BOL_LanguageService::getInstance()->importPrefixFromZip($path, 'owmycookie');