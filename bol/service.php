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

/**
* 
*/
class OWMYCOOKIE_BOL_Service
{
  const PLUGIN_NAME = 'owmycookie';
  const PLUGIN_VER = 'v1.0.0';
  protected static $classInstance = null;

  public static function getInstance() {
    if ( null === self::$classInstance ) {
      self::$classInstance = new self();
    }
    return self::$classInstance;
  }

  /**
   * ============= UTILITIES FUNCTIONS =============
   */
  public static function getPlugin() {
    return OW::getPluginManager()->getPlugin(self::PLUGIN_NAME);
  }

  public static function getJsUrl($filename) {
    return self::getPlugin()->getStaticJsUrl() . $filename . '.js';
  }

  public static function getImgUrl($filename) {
    return self::getPlugin()->getStaticUrl() . 'img/' . $filename;
  }

  public static function getCssUrl($filename) {
    return self::getPlugin()->getStaticCssUrl() . $filename . '.css';
  }

  public static function getRoute() {
    $route = OW::getRequestHandler()->getHandlerAttributes();
    if (is_array($route)) {
      return $route;
    }
    return false;
  }

  public static function isPluginInstalled( $key ) {
    try {
      OW::getPluginManager()->getPlugin($key);
      return true;
    } catch (Exception $e) {  }
    return false;
  }

  /**
   *
   */
  public static function isRoute( $controller, $action = null ) {
    $route = self::getRoute();

    if ( !$route )
      return false;

    if ( $route["controller"] == $controller ) {
      if ( $route["action"] == $action || !$action ) {
        return true;
      }
    }

    return false;
  }

}
