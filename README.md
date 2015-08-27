# Materialize-for-Yii
[Materialize](http://materializecss.com/)是一个Material Design风格的web前端框架，将其做成[Yii Framework](http://www.yiiframework.com/)的一个主题扩展，想必是极好的^_^

*该项目还在完善中，可能有较多问题*
***

###使用方法
1. 将下载的materialize文件夹放在你项目的extensions目录里
2. 配置文件如下：
```php
Yii::setPathOfAlias('md', realpath(dirname(__FILE__) . '/../extensions/materialize'));
return array(
    //......
    'preload' => array('log','md'),
    'import' => array(
        //......
        'md.components.*',
    ),
    'components' => array(
        'md'=>array(
            'class'=>'md.components.Materialize',
            'minify' => true,               //是否使用压缩的css js 文件
            'forceCopyAssets' => false,     //是否强制复制Assets
        ),
    ),
    //......
)
```
3. 目前可用的widgets有MdButon、MdSwitch、MdToast、MdActiveForm