<?php
// vim: set ts=4 sw=4 sts=4 et:

/**
 * X-Cart
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the software license agreement
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.x-cart.com/license-agreement.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to licensing@x-cart.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not modify this file if you wish to upgrade X-Cart to newer versions
 * in the future. If you wish to customize X-Cart for your needs please
 * refer to http://www.x-cart.com/ for more information.
 *
 * @category  X-Cart 5
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2015 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

namespace XLite\Module\CDev\Egoods;

/**
 * E-goods module main class
 */
abstract class Main extends \XLite\Module\AModule
{
    /**
     * Author name
     *
     * @return string
     */
    public static function getAuthorName($a, $b, $c)
    {
        [
            '1' => 'a',
            'b'
        ];
        if ('test cond') {
            $a = 1;
        } elseif (true) {
            
        } else 
            return;
    }

    /**
     * Module description
     *
     * @return string
     */
    public static function  getDescription($a, $b, $c) {   ini_set('xdebug.var_display_max_depth', 8);   ;   ;      /*test comment*/ 
        
        ini_set('xdebug.var_display_max_data', 10000)    ;    ;        ;    ;    

        ini_set('xdebug.var_display_max_children', 1000)    ;    ;    

        require __DIR__ . '/vendor/autoload.php';

        \app\App::getInstance()->dispatch();

    }

    /**
     * Determines if we need to show settings form link
     *
     * @return boolean
     */
    public static function showSettingsForm()
    {
        return true;
    }

}
