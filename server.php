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

	$query_tampil_user = mysqli_query($con,"SELECT * FROM user") or die (mysqli_error($con));
	$data_array = array();

	while ($data = mysqli_fetch_assoc($query_tampil_user)) {
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

	case "get_user_by_id":
	@$id =(int)$_GET['id'];
	$query_tampil_user = mysqli_query($con, "SELECT * FROM user WHERE id='$id'") or die (mysqli_error($con));
	$data_array = array();
	$data_array = mysqli_fetch_assoc($query_tampil_user);
	echo "[" .json_encode ($data_array) . "]";
	break;

	case "edit_data";
	@$id = $_GET['id'];
	@$nama = $_GET['nama'];
	@$alamat = $_GET['alamat'];
	@$email = $_GET['email'];
	@$image = $_GET['image'];
	@$password = $_GET['password'];
	@$role_id = $_GET['role_id'];
	@$is_active = $_GET['is_active'];
	@$tanggal_input = $_GET['tanggal_input'];

	$query_update_user = mysqli_query($con, "UPDATE user SET id='$id', nama='$nama', alamat='$alamat', email='$email', image='$image', password='$password', role_id='$role_id', is_active='$is_active', tanggal_input='$tanggal_input' WHERE id='$id'");

	if ($query_update_user) {
			echo " Update Data Berhasil YEAAAAYY";
	}
	else {
		echo mysqli_error($con);
	}
	break;

	case "hapus";
	@$id = $_GET['id'];
	$query_delete_user = mysqli_query($con, "DELETE FROM user WHERE id='$id'");

	if ($query_delete_user) {
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
