<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * Typecho灯箱插件。
 *
 * @package PhotoSwipe
 * @author 王小明
 * @version 1.0.0
 * @link https://saikou.net
 */
class PhotoSwipe_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate(){
		// Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('PhotoSwipe_Plugin','btn_parse');
		Typecho_Plugin::factory('Widget_Archive')->header = array('PhotoSwipe_Plugin','header');
		Typecho_Plugin::factory('Widget_Archive')->footer = array('PhotoSwipe_Plugin','footer');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){
	    $jquery = new Typecho_Widget_Helper_Form_Element_Radio(
        'jquery', array('0'=> '手动加载', '1'=> '自动加载'), 0, 'jQuery',
            '“手动加载”需要你手动加载jQuery，若选择“自动加载”，插件会自动加载jQuery，版本为1.9.1。');
        $form->addInput($jquery);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 插件实现方法
     *
     * @access public
     * @param Widget_Archive $archive
     * @return void
     */
	public static function btn_parse($content,$widget,$lastResult)
	{
		return $content;
	}
	/**
	 * 头部css挂载
	 * 
     * @access public
	 * @return void
	 */
    public static function header(){
		// if(Typecho_Widget::widget('Widget_Options')->Plugin('Swipebox')->jquery=='1'){
		// 	echo '<script src="//lib.sinaapp.com/js/jquery/1.9.1/jquery-1.9.1.min.js"></script>';
		// }
	    echo '<link href="'.Helper::options()->pluginUrl.'/PhotoSwipe/lib/photoswipe.css" rel="stylesheet">';
        echo '<link href="'.Helper::options()->pluginUrl.'/PhotoSwipe/lib/default-skin/default-skin.css" rel="stylesheet">';
    }
	/**
	 * 尾部js挂载
	 *
     * @access public
	 * @return void
	 */
    public static function footer(){
        echo <<< html
        <!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. 
            PhotoSwipe keeps only 3 of them in the DOM to save memory.
            Don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="关闭 (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="分享"></button>

                <button class="pswp__button pswp__button--fs" title="全屏"></button>

                <button class="pswp__button pswp__button--zoom" title="缩放"></button>

                <!-- Preloader demo https://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="上一个 ←">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="下一个 →">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

        </div>

    </div>

</div>
html;
        echo '<script src="' . Helper::options()->pluginUrl . '/PhotoSwipe/lib/photoswipe.min.js"></script>';
        echo '<script src="' . Helper::options()->pluginUrl . '/PhotoSwipe/lib/photoswipe-ui-default.min.js"></script>';
        echo '<script src="' . Helper::options()->pluginUrl . '/PhotoSwipe/custom/init.js"></script>';
	}

}
