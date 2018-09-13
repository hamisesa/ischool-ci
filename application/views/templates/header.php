<!DOCTYPE html>
<html>
<head>
  
  <title>iSCHOOL 1.0</title>
  <link rel="shortcut icon" href="..\files\images\icons\favicon.ico">
  <!-- bootstrap css -->
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- boostrap theme -->
  <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap-theme.min.css">
  <!-- datatables css -->
  <link rel="stylesheet" type="text/css" href="../assets/datatables/media/css/jquery.dataTables.min.css">
  <!-- fileinput css -->
  <link rel="stylesheet" type="text/css" href="../assets/fileinput/css/fileinput.min.css">
  <!-- fullcalendar css -->
  <link rel="stylesheet" type="text/css" href="../assets/fullcalendar/fullcalendar.min.css">  
  <!-- keith calendar css -->
  <link rel="stylesheet" type="text/css" href="../assets/keith-calendar/jquery.calendars.picker.css"> 

  <!-- custom css -->
  <link rel="stylesheet" type="text/css" href="../custom/css/custom.css"> 

  <!-- jquery -->
  <script type="text/javascript" src="../assets/jquery/jquery.min.js"></script>
  

</head>
<body>


<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url('dashboard') ?>">iSCHOOL</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li id="topNavDashboard"><a href="<?php echo base_url('dashboard') ?>"> <i class="glyphicon glyphicon-dashboard"></i> Halaman Utama <span class="sr-only">(current)</span></a></li>
        <!-- <li><a href="#">Class</a></li> -->
        <li class="dropdown" id="topClassMainNav">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-edit"></i> Kelas <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="topNavClass"><a href="<?php echo base_url('classes'); ?>">Kelola Kelas</a></li>                        
            <li id="topNavSection"><a href="<?php echo base_url('section') ?>">Kelola Sesi</a></li>                                 
            <li id="topNavSubject"><a href="<?php echo base_url('subject') ?>">Kelola Mata Pelajaran</a></li>           
          </ul>
        </li>
        <li class="dropdown" id="topStudentMainNav">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-list-alt"></i> Siswa <span class="caret"></span></a>

          <ul class="dropdown-menu">
            <li id="addStudentNav"><a href="<?php echo base_url('student?opt=addst') ?>">Tambah Siswa</a></li>                                              
            <li id="manageStudentNav"><a href="<?php echo base_url('student?opt=mgst') ?>">Kelola Siswa</a></li>           
          </ul>
        </li>
        <li id="topNavTeacher"><a href="<?php echo base_url('teacher') ?>"> <i class="glyphicon glyphicon-briefcase"></i> Guru</a></li>
		
        <li class="dropdown" id="topAccountMainNav">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-indent-left"></i> Peminjaman Buku<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li id="createStudentNav"><a href="<?php echo base_url('accounting?opt=crtpay') ?>">Meminjam Buku</a></li>                        
            <li id="managePayNav"><a href="<?php echo base_url('accounting?opt=mgpay') ?>">Kelola Peminjaman</a></li>                                  
          </ul>
        </li>
      </ul>      
      <ul class="nav navbar-nav navbar-right">        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li><a href="<?php echo base_url('setting') ?>">Pengaturan</a></li>                       
            <li><a href="<?php echo base_url('users/logout'); ?>">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="container-fluid">

  
