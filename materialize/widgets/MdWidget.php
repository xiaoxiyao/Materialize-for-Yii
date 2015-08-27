<?php
/**
 * Created by PhpStorm.
 * User: XIYAO
 * Date: 2015/5/6 0006
 * Time: 16:19
 */

class MdWidget extends CWidget {
    protected static function addCssClass(&$htmlOptions, $class) {

        if (empty($class))
            return;

        if (isset($htmlOptions['class']))
            $htmlOptions['class'] .= ' ' . $class;
        else
            $htmlOptions['class'] = $class;
    }
}