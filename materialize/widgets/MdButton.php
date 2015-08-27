<?php
Yii::import('md.widgets.MdWidget');
/**
 * Created by PhpStorm.
 * User: XIYAO
 * Date: 2015/5/5 0005
 * Time: 15:21
 */

class MdButton extends MdWidget
{
    //button type
    const BUTTON_LINK = 'link';
    const BUTTON_BUTTON = 'button';
    const BUTTON_SUBMIT = 'submit';
    const BUTTON_RESET = 'reset';
    //button style
    const BUTTON_DEFAULT = 'default';
    const BUTTON_CIRCLE = 'circle';
    const BUTTON_FLAT = 'flat';
    //wave colors
    protected static $colorClasses = array(
        'default'=>'',
        'light'=>'waves-light',
        'red'=>'waves-red',
        'yellow'=>'waves-yellow',
        'orange'=>'waves-orange',
        'purple'=>'waves-purple',
        'green'=>'waves-green',
        'teal'=>'waves-teal',
    );

    public $buttonType = self::BUTTON_BUTTON; //button类型
    public $buttonStyle = self::BUTTON_DEFAULT;//button样式
    public $large = false; //是否大尺寸button
    public $label;//按钮文字
    public $url; //for link
    public $htmlOptions = array();
    public $leftIcon;
    public $rightIcon;
    public $icon; //for circle
    public $wave = true;
    public $waveColor = 'default';
    public $disabled = false;

    public function init()
    {
        if (!isset($this->htmlOptions['id'])) {
            $this->htmlOptions['id'] = $this->getId();
        }

        if($this->wave)
        {
            $this->addCssClass($this->htmlOptions,'waves-effect');
            $this->addCssClass($this->htmlOptions,self::$colorClasses[$this->waveColor]);
        }

        if($this->buttonStyle === self::BUTTON_CIRCLE)
        {
            if($this->large)
            {
                $this->addCssClass($this->htmlOptions,'btn-large');
            }
            if($this->wave)
            {
                $this->addCssClass($this->htmlOptions,'waves-circle');
            }
            $this->label= CHtml::tag('i',array('class'=>$this->icon),'');
            $this->addCssClass($this->htmlOptions,'btn-floating');
        }
        elseif($this->buttonStyle === self::BUTTON_FLAT)
        {
            //flat large 无效
//            if($this->large)
//            {
//                $this->addCssClass($this->htmlOptions,'btn-large');
//            }
            $this->addCssClass($this->htmlOptions,'btn-flat');
        }
        else{
            if($this->large)
            {
                $this->addCssClass($this->htmlOptions,'btn-large');
            }
            else{
                $this->addCssClass($this->htmlOptions,'btn');
            }
        }

        if(isset($this->leftIcon))
        {
            $this->label = CHtml::tag('i',array('class'=>$this->leftIcon.' left'),'').$this->label;
        }
        if(isset($this->rightIcon))
        {
            $this->label = CHtml::tag('i',array('class'=>$this->rightIcon.' right'),'').$this->label;
        }

        if($this->disabled)
        {
            $this->addCssClass($this->htmlOptions,'disabled');
        }
        parent::init();
    }

    public function run()
    {
        switch($this->buttonType)
        {
            case self::BUTTON_LINK:
                echo CHtml::link($this->label,$this->url,$this->htmlOptions)."\n";
                break;
            case self::BUTTON_BUTTON:
                echo CHtml::htmlButton($this->label, $this->htmlOptions)."\n";
                break;
            case self::BUTTON_RESET:
                $this->htmlOptions['type'] = 'reset';
                echo CHtml::htmlButton($this->label, $this->htmlOptions)."\n";
                break;
            case self::BUTTON_SUBMIT:
                $this->htmlOptions['type'] = 'submit';
                echo CHtml::htmlButton($this->label, $this->htmlOptions)."\n";
                break;
            default:
                throw new CHttpException(500,'this type of button is not defined');
        }
    }

}