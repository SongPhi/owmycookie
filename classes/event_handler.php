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

/**
* 
*/
class OWMYCOOKIE_CLASS_EventHandler
{
	
	function injectCookieConsent() {
		if (OW::getRequest()->isPost()) return;
        if (OW::getRequest()->isAjax()) return;
        // if (OW::getUser()->isAuthenticated()) return;

        $configs = OWMYCOOKIE_BOL_Configs::getInstance();
		$language = OW::getLanguage();

		$text = array(
			'learn_more' => $language->text('owmycookie','learn_more'),
			'dismiss' => $language->text('owmycookie','dismiss'),
			'message' => $language->text('owmycookie','message'),
		);

        OW::getDocument()->addScript( OWMYCOOKIE_URL_STATIC . 'bower_components/cookieconsent2/cookieconsent.js');

        OW::getDocument()->addScriptDeclaration(<<<JSCRIPT
    window.cookieconsent_options = {
    	theme: '{$configs->get('theme')}',
        learnMore: '{$text['learn_more']}',
        dismiss: '{$text['dismiss']}',
        message: '{$text['message']}',
        link: '{$configs->get('link')}'
    };
JSCRIPT
);

	}
}