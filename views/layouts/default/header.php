<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->titulo .' '. $this->company . ' | ' . $this->tagline ;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- Loading Bootstrap -->
    <link href="<?php echo $_layoutParams['ruta_css']?>bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo $_layoutParams['ruta_css']?>bootstrap-responsive.min.css" rel="stylesheet"/>
    <!-- Loading Template CSS -->

    <link href="<?php echo $_layoutParams['ruta_css']?>datepicker.css" rel="stylesheet" />
    <link href="<?php echo $_layoutParams['ruta_css']?>uniform.css" rel="stylesheet" />
    <link href="<?php echo $_layoutParams['ruta_css']?>select2.css" rel="stylesheet" />
    <link href="<?php echo $_layoutParams['ruta_css']?>maruti-style.css" rel="stylesheet" />
    <link href="<?php echo $_layoutParams['ruta_css']?>maruti-media.css" rel="stylesheet" class="skin-color"/>

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src=<?php echo $_layoutParams['ruta_js']."jquery.table2excel.min.js"?>></script>
    <!-- Font Favicon -->
    <!--<link rel="shortcut icon" href="images/favicon.ico">-->

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src=<?php echo $_layoutParams['ruta_js']."html5shiv.js;"?></script>
    <script src=<?php echo $_layoutParams['ruta_js']."respond.min.js;"?></script>
    <![endif]-->
    <?php if(isset($_layoutParams['JS']) && count($_layoutParams['JS'])):?>
        <?php for($i=0;$i<count($_layoutParams['JS']);$i++):?>
            <script src="<?php echo $_layoutParams['JS'][$i];?>" type="text/javascript"></script>
        <?php endfor;?>
    <?php endif;?>
    <!--headerIncludes-->
</head>
<body>
<!--begin top-intro -->
<!--Header-part-->
<div id="header">
    <h1><a href="<?php echo BASE_URL;?>"><?php echo APP_NAME;?></a></h1>
</div>
<!--close-Header-part-->

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <?php if(!Sessions::get('autenticado')):?>
            <li class=""><a title="" href="<?php echo BASE_URL. 'login';?>"><i class="icon icon-user"></i> <span class="text">Iniciar Sesión</span></a></li>
        <?php else:?>
        <li class=""><a title="" href="<?php echo BASE_URL. 'login/logout';?>"><i class="icon icon-share-alt"></i> <span class="text">Salir</span></a></li>
        <?php endif;?>
    </ul>
</div>
<!--close-top-Header-menu-->

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li class="active"><a href="<?php echo BASE_URL;?>"><i class="icon icon-home"></i> <span>Inicio</span></a> </li>
        <?php if(Sessions::get('level')=='Administrador'):?>
            <li class="active"><a href="<?php echo BASE_URL.'configuracion';?>"><i class="icon icon-cog"></i> <span>Configuraciones</span></a> </li>
        <?php endif;?>
<!--        <li> <a href="charts.html"><i class="icon icon-signal"></i> <span>Charts &amp; graphs</span></a> </li>-->
<!--        <li> <a href="widgets.html"><i class="icon icon-inbox"></i> <span>Widgets</span></a> </li>-->
<!--        <li><a href="tables.html"><i class="icon icon-th"></i> <span>Tables</span></a></li>-->
<!--        <li><a href="grid.html"><i class="icon icon-fullscreen"></i> <span>Full width</span></a></li>-->
<!--        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Forms</span> <span class="label label-important">3</span></a>-->
<!--            <ul>-->
<!--                <li><a href="form-common.html">Basic Form</a></li>-->
<!--                <li><a href="form-validation.html">Form with Validation</a></li>-->
<!--                <li><a href="form-wizard.html">Form with Wizard</a></li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li><a href="buttons.html"><i class="icon icon-tint"></i> <span>Buttons &amp; icons</span></a></li>-->
<!--        <li><a href="interface.html"><i class="icon icon-pencil"></i> <span>Eelements</span></a></li>-->
<!--        <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Addons</span> <span class="label label-important">4</span></a>-->
<!--            <ul>-->
<!--                <li><a href="index2.html">Rendimiento</a></li>-->
<!--                <li><a href="gallery.html">Gallery</a></li>-->
<!--                <li><a href="calendar.html">Calendar</a></li>-->
<!--                <li><a href="chat.html">Chat option</a></li>-->
<!--            </ul>-->
<!--        </li>-->
    </ul>
</div>
<div id="content">
    <div id="content-header">
        <!--<div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>-->
    </div>
    <div class="container-fluid">
        <div class="quick-actions_homepage">
            <?php if(Sessions::get('autenticado')):?>
                <ul class="quick-actions">
                <li> <a href="<?php echo BASE_URL.'rendimiento'?>"> <i class="icon-dashboard"></i> Rendimiento </a> </li>
                <li> <a href="<?php echo BASE_URL.'desperdicio'?>"> <i class="icon-graph"></i> Desperdicio de Caña</a> </li>
                <li> <a href="<?php echo BASE_URL.'materia'?>"> <i class="icon-book"></i> Materia Extraña </a> </li>
            </ul>
            <?php endif;?>
        </div>
<!--end header -->