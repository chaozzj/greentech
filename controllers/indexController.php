<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 18/11/2017
 * Time: 21:54
 */
class indexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        Sessions::acceso('Digitador');
        $this->_view->titulo=APP_NAME;
        $this->_view->tagline=APP_SLOGAN;
        $this->_view->company=APP_COMPANY;
        $this->_view->renderizar('index');
    }
}