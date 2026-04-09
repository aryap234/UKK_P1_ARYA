<?php

 // memanggil model user
 include_once "../model/m_user.php";
 
 // include_once "model/m_user.php";
 
 // membuat objek dari kelas user
 $user = new m_user;
 
 //memanggil fungsi tampil data yang ada pada kelas m_user
 $user->tampil_data_user();
 