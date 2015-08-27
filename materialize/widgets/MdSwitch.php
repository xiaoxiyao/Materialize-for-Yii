<?php
/**
 * Created by PhpStorm.
 * User: XIYAO
 * Date: 2015/5/5 0005
 * Time: 14:12
 */

class MdSwitch extends MdWidget
{
    public $onLabel = 'on';
    public $offLabel = 'off';
    public $options = array();

    public function init()
    {
        if (!isset($this->options['groupOptions']))
            $this->options['groupOptions'] = array();
        $this->addCssClass($this->options['groupOptions'],'switch');
        if (!isset($this->options['inputOptions']))
            $this->options['inputOptions'] = array();
        $this->options['inputOptions']['id']=$this->getId();
        parent::init();
    }

    public function run()
    {
        echo CHtml::openTag('div',$this->options['groupOptions']);
        echo CHtml::openTag('label');
        echo $this->offLabel;
        echo CHtml::checkBox('',false,$this->options['inputOptions']);
        echo '<span class="lever"></span>';
        echo $this->onLabel;
        echo CHtml::closeTag('label');
        echo CHtml::closeTag('div');
    }
}