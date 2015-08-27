<?php
/**
 * Created by PhpStorm.
 * User: xiyao
 * Date: 15-5-2
 * Time: 下午1:32
 */

class MdActiveFrom extends CActiveForm {

    public function init()
    {
        $this->errorMessageCssClass = 'red-text';
        $this->clientOptions['inputContainer'] = 'div.input-field';
        parent::init();
    }

    public function textFieldGroup($model, $attribute, $options = array()){
        $this->initOptions($options);
        $fieldData=array(array($this,'textField'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function passwordFieldGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        $fieldData=array(array($this,'passwordField'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function emailFieldGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        $fieldData=array(array($this,'emailField'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function urlFieldGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        $fieldData=array(array($this,'urlField'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function telFieldGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        $fieldData=array(array($this,'telField'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function numberFieldGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        $fieldData=array(array($this,'numberField'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function textAreaGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        $this->addCssClass($options['inputOptions'],'materialize-textarea');
        $fieldData=array(array($this,'textArea'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function dropDownGroup($model, $attribute,$options = array())
    {
        $this->initOptions($options);
        if (!isset($options['data']))
            $options['data'] = array();
        $options['prefix'] = null;       //prefix无效
        $fieldData=array(array($this,'dropDownList'),array($model,$attribute,$options['data'],$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
        Yii::app()->clientScript->registerScript(
            __CLASS__.CHtml::activeId($model,$attribute),
            "$('select').material_select();");
    }

    public function radioButtonGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        if(isset($options['gap']) && $options['gap'])
        {
            $this->addCssClass($options['inputOptions'],'with-gap');
        }
        $options['prefix'] = null;       //prefix无效
        $fieldData = array(array($this,'radioButton'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function radioButtonListGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        if (!isset($options['data']))
            $options['data'] = array();
        if(isset($options['gap']) && $options['gap'])
        {
            $this->addCssClass($options['inputOptions'],'with-gap');
        }
        $options['prefix'] = null;       //prefix无效
        $options['inputOptions']['template']='<p>{input} {label}</p>';
        $options['inputOptions']['separator']='';
        $options['inputOptions']['container']='div';
        $id = CHtml::activeId($model, $attribute);
        Yii::app()->clientScript->registerCss(__CLASS__.$id,
            '.input-field > div#'.$id.'{padding-top:2rem;}
            .input-field > div#'.$id.' > p > label{top:0;}');
        $fieldData=array(array($this,'radioButtonList'),array($model,$attribute,$options['data'],$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function checkBoxGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        if(isset($options['fill']) && $options['fill'])
        {
            $this->addCssClass($options['inputOptions'],'filled-in');
        }
        $options['prefix'] = null;       //prefix无效
        $fieldData = array(array($this,'checkBox'),array($model,$attribute,$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function checkBoxListGroup($model, $attribute, $options = array())
    {
        $this->initOptions($options);
        if (!isset($options['data']))
            $options['data'] = array();
        if(isset($options['fill']) && $options['fill'])
        {
            $this->addCssClass($options['inputOptions'],'filled-in');
        }
        $options['prefix'] = null;       //prefix无效
        $options['inputOptions']['template']='<p>{input} {label}</p>';
        $options['inputOptions']['separator']='';
        $options['inputOptions']['container']='div';
        $id = CHtml::activeId($model, $attribute);
        Yii::app()->clientScript->registerCss(__CLASS__.$id,
            '.input-field > div#'.$id.'{padding-top:2rem;}
            .input-field > div#'.$id.' > p > label{top:0;}');
        $fieldData=array(array($this,'checkBoxList'),array($model,$attribute,$options['data'],$options['inputOptions']));
        $this->fieldGroup($fieldData,$model,$attribute,$options);
    }

    public function fileFieldGroup($model, $attribute, $options = array())
    {
        if (!isset($options['groupOptions']))
            $options['groupOptions'] = array();
        $this->addCssClass($options['groupOptions'],'file-field input-field');
        if (!isset($options['buttonOptions']))
            $options['buttonOptions'] = array();
        $this->addCssClass( $options['buttonOptions'],'btn');
        if (!isset($options['inputOptions']))
            $options['inputOptions'] = array();

        echo CHtml::openTag('div',$options['groupOptions']);
        echo CHtml::textField('','',array('class'=>'file-path','readonly'=>'readonly'));
        echo CHtml::openTag('div',$options['buttonOptions']);
        echo '<span>'.isset($options['buttonOptions']['label']) ? $options['buttonOptions']['label'] : '打开'.'</span>';
        echo $this->fileField($model,$attribute,$options['inputOptions']);
        echo CHtml::closeTag('div');
        echo CHtml::closeTag('div');
    }

    public function dateFieldGroup($model, $attribute, $options = array())
    {
        if (!isset($options['groupOptions']))
            $options['groupOptions'] = array();
        if (!isset($options['labelOptions']))
            $options['labelOptions'] = array();
        if (!isset($options['inputOptions']))
            $options['inputOptions'] = array();
        $this->addCssClass($options['inputOptions'],'datepicker');

        echo CHtml::openTag('p',$options['groupOptions']);
        if(isset($options['label']) && $options['label'])
        {
            echo CHtml::label($options['label'], CHtml::activeId($model, $attribute), $options['labelOptions']);
        }
        elseif(!isset($options['label']))
        {
            echo $this->label($model,$attribute,$options['labelOptions']);
        }
        else{}//不渲染label
        echo $this->dateField($model,$attribute,$options['inputOptions']);
        echo CHtml::closeTag('p');
        Yii::app()->clientScript->registerScript(
            __CLASS__.CHtml::activeId($model,$attribute),
            "$('.datepicker').pickadate({
                monthsFull: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
                monthsShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
                weekdaysFull: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
                weekdaysShort: ['日', '一', '二', '三', '四', '五', '六'],
                showMonthsShort: false,
                showWeekdaysShort: true,
                today: '今天',
                clear: '清除',
                close: '关闭',
                labelMonthNext: '下一月',
                labelMonthPrev: '上一月',
                labelMonthSelect: '选择月份',
                labelYearSelect: '选择年份',
                selectYears: true,
                selectMonths: true,
                format: 'yyyy/mm/dd'
            });");
    }

    public function rangeFieldGroup($model, $attribute, $options = array())
    {
        if (!isset($options['groupOptions']))
            $options['groupOptions'] = array();
        $this->addCssClass($options['groupOptions'],'range-field');
        if (!isset($options['labelOptions']))
            $options['labelOptions'] = array();

        if (!isset($options['inputOptions']))
            $options['inputOptions'] = array();

        echo CHtml::openTag('p',$options['groupOptions']);
        if(isset($options['label']) && $options['label'])
        {
            echo CHtml::label($options['label'], CHtml::activeId($model, $attribute), $options['labelOptions']);
        }
        elseif(!isset($options['label']))
        {
            echo $this->label($model,$attribute,$options['labelOptions']);
        }
        else{}//不渲染label
        echo $this->rangeField($model,$attribute,$options['inputOptions']);
        echo CHtml::closeTag('p');
    }

    public function switchGroup($model, $attribute, $options = array())
    {
        if (!isset($options['labelOptions']))
            $options['labelOptions'] = array();
        if (!isset($options['groupOptions']))
            $options['groupOptions'] = array();
        $this->addCssClass($options['groupOptions'],'switch');
        if (!isset($options['inputOptions']))
            $options['inputOptions'] = array();
        $options['onLabel']= 'on';
        $options['offLabel']= 'off';
        if(!isset($options['label']))
        {
            $options['label']=$attribute;
        }
        echo CHtml::label($options['label'],'', $options['labelOptions']);
        echo CHtml::openTag('div',$options['groupOptions']);
        echo CHtml::openTag('label');
        echo $options['offLabel'];
        echo $this->checkBox($model, $attribute,$options['inputOptions']);
        echo '<span class="lever"></span>';
        echo $options['onLabel'];
        echo CHtml::closeTag('label');
        echo CHtml::closeTag('div');
    }

    protected function fieldGroup($fieldData,$model, $attribute, $options){
        echo CHtml::openTag('div',$options['groupOptions']);
        if(isset($options['prefix']))
        {
            echo CHtml::openTag('i',array('class'=>$options['prefix']));
            echo CHtml::closeTag('i');
        }
        echo call_user_func_array($fieldData[0],$fieldData[1]);

        if(isset($options['label']) && $options['label'])
        {
            echo CHtml::label($options['label'], CHtml::activeId($model, $attribute), $options['labelOptions']);
        }
        elseif(!isset($options['label']))
        {
            echo $this->label($model,$attribute,$options['labelOptions']);
        }
        else{}//不渲染label
        echo CHtml::closeTag('div');
    }

    protected function initOptions(&$options){
        if (!isset($options['float']))
        {
            $options['float']= true;
        }
        if (!isset($options['groupOptions']))
            $options['groupOptions'] = array();

        $this->addCssClass($options['groupOptions'],'input-field');

        if (!isset($options['labelOptions']))
            $options['labelOptions'] = array();

        if (!isset($options['inputOptions']))
            $options['inputOptions'] = array();

        $this->addCssClass($options['inputOptions'],'validate');

        if(!$options['float']){
            $this->addCssClass($options['labelOptions'],'active');
        }
    }

    protected function addCssClass(&$srcArray,$class)
    {
        if(isset($srcArray['class']))
        {
            $srcArray['class'].=' '.$class;
        }
        else{
            $srcArray['class'] = $class;
        }
    }
}