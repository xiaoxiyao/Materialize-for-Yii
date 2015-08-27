<?php
/**
 * Created by PhpStorm.
 * User: xiyao
 * Date: 15-5-1
 * Time: 下午7:32
 */

class Materialize extends CApplicationComponent {
    public $minify = true;
    public $forceCopyAssets=false;
    public $tooltipSelector = '[data-tooltip]';
    private $_cs;
    private $_assetsUrl;
    public function init()
    {
        $this->setRootAliasIfUndefined();
        if (!$this->_cs) {
            $this->_cs = Yii::app()->getClientScript();
        }
        $this->registerScript();
        parent::init();
    }

    protected function setRootAliasIfUndefined()
    {
        if (Yii::getPathOfAlias('md') === false) {
            //设置路径别名
            Yii::setPathOfAlias('md', realpath(dirname(__FILE__) . '/..'));
        }
    }

    protected function registerScript()
    {
        $jsPath = $this->getAssetsUrl().'/materialize/js/'.($this->minify ? 'materialize.min.js' : 'materialize.js');
        $cssPath = $this->getAssetsUrl().'/materialize/css/'.($this->minify ? 'materialize.min.css' : 'materialize.css');
        $this->_cs->registerCssFile($cssPath);
        $this->_cs->registerCoreScript('jquery');
        $this->_cs->registerScriptFile($jsPath, CClientScript::POS_END);
        $this->registerTooltipJs();
    }
    protected function registerTooltipJs() {
        $this->_cs->registerScript($this->getUniqueScriptId(), "jQuery('$this->tooltipSelector').tooltip({delay:50});");
    }
    protected function getAssetsUrl()
    {
        if (isset($this->_assetsUrl)) {
            return $this->_assetsUrl;
        } else {
            return $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('md.assets'), false, -1, $this->forceCopyAssets);
        }
    }
    protected function getUniqueScriptId() {
        return uniqid(__CLASS__ . '#', true);
    }
}