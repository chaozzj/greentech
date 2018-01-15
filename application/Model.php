<?php
/**
 * Created by PhpStorm.
 * User: lilsa
 * Date: 17/11/2017
 * Time: 00:15
 */
class Model{
    protected $_db;

    public function __construct()
    {
        $this->_db= new Database();
    }
}