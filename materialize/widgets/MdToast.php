<?php
/**
 * Created by PhpStorm.
 * User: XIYAO
 * Date: 2015/5/7 0007
 * Time: 8:59
 */

class MdToast extends MdWidget
{
    public $msg;
    public $classType;
    public $duration = 5000;
    public $cssClass;
    public $callBack = 'function(){}';//js function
    protected $_class = array('success','error');

    public function run()
    {
        if(isset($this->msg) && isset($this->classType))
        {
            $this->msg = $this->getIcon($this->classType).' '.$this->msg;
            $this->msg = CJavaScript::encode($this->msg);
            $this->classType = CJavaScript::encode($this->classType);
            Yii::app()->clientScript->registerScript($this->id,"Materialize.toast($this->msg,$this->duration,$this->classType,$this->callBack);");
            return;
        }
        foreach ($this->_class as $class)
        {
            if(Yii::app()->user->hasFlash($class))
            {
                $this->msg = $this->getIcon($class).' '.Yii::app()->user->getFlash($class);
                $this->msg = CJavaScript::encode($this->msg);
                $class = CJavaScript::encode($class);
                Yii::app()->clientScript->registerScript($this->id,"Materialize.toast($this->msg,$this->duration,$class,$this->callBack);");
            }
        }
    }

    protected function getIcon($classType)
    {
        switch ($classType)
        {
            case 'success':
                $class = 'mdi-action-done left';
                break;
            case 'error':
                $class = 'mdi-alert-error left';
                break;
            default:
                throw new CHttpException(500,'未知的classType:'.$classType);
                break;
        }
        return "<i class='$class'></i>";
    }
}