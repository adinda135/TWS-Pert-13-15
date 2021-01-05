<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "pustaka";
$con = mysqli_connect($server, $username, $password) or die("<h1>Koneksi Mysqli Error : </h1>" . mysqli_connect_error());
mysqli_select_db($con, $database) or die ("<h1>Koneksi Kedatabse Error : </h1>". mysqli_error($con));

@$operasi = $_GET['operasi'];

switch ($operasi) {

	case "lihat":

	$query_tampil_buku = mysqli_query($con,"SELECT * FROM buku") or die (mysqli_error($con));
	$data_array = array();

	while ($data = mysqli_fetch_assoc($query_tampil_buku)) {
		$data_array[]=$data;
	}
	echo json_encode($data_array);

	break;

	case "tambah_data":
	@$id = $_POST['id'];
	@$nama = $_POST['nama'];
	@$alamat = $_POST['alamat'];
	@$email = $_POST['email'];
	@$image = $_POST['image'];
	@$password = $_POST['password'];
	@$role_id = $_POST['role_id'];
	@$is_active = $_POST['is_active'];
	@$tanggal_input = $_POST['tanggal_input'];

	$query_tambah_data = mysqli_query($con, "INSERT INTO user (id, nama, alamat, email, image, password, role_id, is_active, tanggal_input) VALUES('$id', '$nama', '$alamat', '$email', '$image', '$password', '$role_id', '$is_active', '$tanggal_input')");

	if ($query_tambah_data) {
		echo "Data Berhasil Disimpan YEAAYY";
	}
	else {
		echo "Maaf Data yang ditambahkan ke dalam database ERROR" . mysqli_error($con);
	}

	break;

	case "get_buku_by_id":
	@$id =(int)$_GET['id'];
	$query_tampil_buku = mysqli_query($con, "SELECT * FROM buku WHERE id='$id'") or die (mysqli_error($con));
	$data_array = array();
	$data_array = mysqli_fetch_assoc($query_tampil_buku);
	echo "[" .json_encode ($data_array) . "]";
	break;

	case "edit_data";
	@$id = $_GET['id'];
	@$judul_buku = $_GET['judul_buku'];
	@$id_kategori = $_GET['id_kategori'];
	@$pengarang = $_GET['pengarang'];
	@$penerbit = $_GET['penerbit'];
	@$tahun_terbit = $_GET['tahun_terbit'];
	@$isbn = $_GET['isbn'];
	@$stok = $_GET['stok'];
	@$dipinjam = $_GET['dipinjam'];
	@$dibooking = $_GET['dibooking'];
	@$image = $_GET['image'];

	$query_update_buku = mysqli_query($con, "UPDATE buku SET id='$id', judul_buku='$judul_buku', id_kategori='$id_kategori', pengarang='$pengarang', penerbit='$penerbit', tahun_terbit='$tahun_terbit', isbn='$isbn', stok='$stok', dipinjam='$dipinjam', dibooking='$dibooking', image='$image' WHERE id='$id'");

	if ($query_update_buku) {
			echo " Update Data Berhasil YEAAAAYY";
	}
	else {
		echo mysqli_error($con);
	}
	break;

	case "hapus";
	@$id = $_GET['id'];
	$query_delete_buku = mysqli_query($con, "DELETE FROM buku WHERE id='$id'");

	if ($query_delete_buku) {
		echo "Data Berhasil Dihapus :((";
	}
	else {
		echo mysqli_error($con);
	}
	break;

default:
break;
}
?>
