
<?php 
include "../konfig.php";
include "excel_reader2.php";
?>
 
<?php
// upload file xls
$target = basename($_FILES['filexls']['name']) ;
move_uploaded_file($_FILES['filexls']['tmp_name'], $target);
 
// beri permisi agar file xls dapat di baca
chmod($_FILES['filexls']['name'],0777);
 
// mengambil isi file xls
$data = new Spreadsheet_Excel_Reader($_FILES['filexls']['name'],false);
// menghitung jumlah baris data yang ada
$jumlah_baris = $data->rowcount($sheet_index=0);
 
// jumlah default data yang berhasil di import
$berhasil = 0;
for ($i=2; $i<=$jumlah_baris; $i++){
 
	// menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
	$wa_no     = $data->val($i, 1);
	$wa_text   = $data->val($i, 2);
	$wa_media  = $data->val($i, 3);
	$wa_file   = $data->val($i, 4);
 
	if($wa_no != "" && $wa_text != ""){
		// input data ke database (table data_pegawai)
		mysqli_query($koneksi,"INSERT into multi (tipe, profil, wa_mode, wa_no, wa_text, wa_media, wa_file) values('D', '$profil', '3','$wa_no','$wa_text','$wa_media', '$wa_file')");
		$berhasil++;
	}
}
 
// hapus kembali file .xls yang di upload tadi
unlink($_FILES['filexls']['name']);
 
// alihkan halaman ke index.php
header("location:index.php?berhasil=$berhasil");
?>