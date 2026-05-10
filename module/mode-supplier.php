<?php

if (userLogin()['level'] == 3) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data)
{
    global $koneksi;

    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $telpon = mysqli_real_escape_string($koneksi, $data['telpon']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $ket = mysqli_real_escape_string($koneksi, $data['ket']);

    $sqlSupplier = "INSERT INTO tbl_supplier VALUES (null,
                '$nama', '$telpon', '$ket', '$alamat')";

    mysqli_query($koneksi, $sqlSupplier);

    return mysqli_affected_rows($koneksi);

}

function delete($id)
{
    global $koneksi;

    $sqlDelete = "DELETE FROM tbl_supplier WHERE id_supplier = $id";

    mysqli_query($koneksi, $sqlDelete);

    return mysqli_affected_rows($koneksi);
}

?>