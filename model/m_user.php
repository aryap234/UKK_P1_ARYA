<?php
//memanggil koneksi kedatabase
include_once "m_koneksi.php";

// membuat kelas user 
class m_user 
{
  
  // membuat fungsi untuk menampilkan semua data dari tabel user
  public function user() {
    
 
    // membuat objek dari kelas m_koneksi
    $conn = new m_koneksi ();
    
    
    //membuat query untuk menampilkan semua data dari tabel user
      $sql = "SELECT * FROM user";
      
      //menjalankan perintah untuk menjalankan query diatas
     $post = mysqli_query($conn->koneksi, $sql);
     
     // mengecek apakah variabel $post ada datanya atau tidak
     if($post->num_rows > 0){
       //merubah data dari variabel $post menjadi data berbentuk objek 
       
       while ($data = mysqli_fetch_object($post)) {// menyimpan data objek kedalam variabel $result yang berbentuk array $result [] = $data;
       }
       // kembalikan nilai nya
       return $result;
       }else {
         echo "tidak ada data";
       
     }
  }
}