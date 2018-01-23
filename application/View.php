<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 17/11/2017
 * Time: 00:16
 */
class View
{
    private $_controlador;
    private $_js;

    public function __construct(Request $peticion)
    {
        $this->_controlador = $peticion->getControlador();
        $this->_js=array();
    }

    public function renderizar($vista, $item = false)
    {

        $menu= array(
            array(
                'id'=> 'inicio',
                'titulo'=> 'Inicio',
                'enlace'=> BASE_URL),
            array(
                'id'=> 'inicio',
                'titulo'=> 'Orientación Financiera',
                'enlace'=> BASE_URL .'orientacion'),
            array(
                'id'=> 'inicio',
                'titulo'=> 'Abrir Cuenta',
                'enlace'=> BASE_URL. 'account')
            );

        $js=array();

        if(count($this->_js)){
            $js=$this->_js;
        }

        $_layoutParams = array(
            'ruta_css' => BASE_URL . 'views/layouts/'. DEFAULT_LAYOUT . '/css/',
            'ruta_js' => BASE_URL . 'views/layouts/'. DEFAULT_LAYOUT . '/js/',
            'ruta_img' => BASE_URL . 'views/layouts/'. DEFAULT_LAYOUT . '/img/',
            'ruta_revs_css' => BASE_URL . 'views/layouts/'. DEFAULT_LAYOUT . '/revs/css/',
            'ruta_revs_fonts' => BASE_URL . 'views/layouts/'. DEFAULT_LAYOUT . '/revs/fonts/',
            'ruta_revs_js' => BASE_URL . 'views/layouts/'. DEFAULT_LAYOUT . '/revs/js/',
            'ruta_revs_assets' => BASE_URL . 'views/layouts/'. DEFAULT_LAYOUT . '/revs/assets/',
            'menu'=>$menu,
            'JS'=> $js
        );

        $rutaView = ROOT.'views'.DS.$this->_controlador.DS.$vista.'.phtml';

        if(is_readable($rutaView)) {
            include_once ROOT . 'views'.DS.'layouts'.DS.DEFAULT_LAYOUT.DS.'header.php';
            include_once $rutaView;
            include_once ROOT . 'views'.DS.'layouts'.DS.DEFAULT_LAYOUT.DS.'footer.php';
        }
        else{
            throw new Exception('Error de vista.');
        }
    }
    public function setJs(array $js)
    {
        if(is_array($js) && count($js)){
            for($i=0;$i<count($js);$i++){
                $this->_js[]= BASE_URL.'views/'.$this->_controlador.'/js/'.$js[$i].'.js';
            }
        }
        else{
            throw new Exception('Js Not Found');
        }
    }
}