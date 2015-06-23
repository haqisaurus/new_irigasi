<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>SimpleBlog</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/css/SimpleBlog.css') ?>" type="text/css" />
</head>
<body>
    <div id="wrap">
        <div id="header">
            <h1 id="logo">Sistem Informasi <span class="gray">OP Irigasi</span></h1>
            <h2 id="slogan">Informasi irigasi yogyakarta...</h2>
            <div id="searchform">

            </div>
        </div>
        <div id="menu">
            <?php echo $menuTop ?>
        </div>
        <div id="content-wrap">
            <?php   echo $sideBar ?>
            <?php   echo $content; ?>
        </div>
        <div id="footer">
            <p> &copy; 2006 <strong>Fakultas Teknologi Pertanian Universitas Gadjah Mada</strong> &nbsp;&nbsp; Design by: haqisaurus
            </div>
        </div>
