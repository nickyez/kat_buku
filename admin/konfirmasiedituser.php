<?php
    session_start();
    include('../koneksi/koneksi.php');
    if (isset($_SESSION['id_user'])) {
        $id_user =  $_SESSION['id_user'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];

        $sql_f = "SELECT `foto` FROM `user` WHERE `id_user`='$id_user'";
        $query_f=mysqli_query($koneksi,$sql_f);
        while ($data_f = mysqli_fetch_row($query_f)) {
            $foto = $data_f[0];
        }

        if (empty($nama)) {
            header("Location:edituser.php?data=$id_user&notif=editkosong&jenis=Nama");
        }elseif (empty($email)) {
            header("Location:edituser.php?data=$id_user&notif=editkosong&jenis=Email");
        }elseif (empty($username)) {
            header("Location:edituser.php?data=$id_user&notif=editkosong&jenis=Username");
        }else {
            $lokasi_file = $_FILES['foto']['tmp_name'];
            $nama_file = $_FILES['foto']['name'];
            $direktori = 'foto/'.$nama_file;

            if (move_uploaded_file($lokasi_file,$direktori)) {
                if (!empty($foto)) {
                    unlink("foto/$foto"); 
                }
                if (!empty($password)) {
                    $sql = "UPDATE `user` SET `nama`='$nama', `email`='$email', `username`='$username', `level`='$level', `password`=MD5('$password'), `foto`='$nama_file'
                    WHERE `id_user` = '$id_user'";
                    mysqli_query($koneksi,$sql);
                }else {
                    $sql = "UPDATE `user` SET `nama`='$nama', `email`='$email', `username`='$username', `level`='$level', `foto`='$nama_file'
                    WHERE `id_user` = '$id_user'";
                    mysqli_query($koneksi,$sql);
                }
            }else {
                if (!empty($password)) {
                    $sql = "UPDATE `user` SET `nama`='$nama', `email`='$email', `username`='$username', `level`='$level', `password`=MD5('$password')
                    WHERE `id_user` = '$id_user'";
                    mysqli_query($koneksi,$sql);
                }else {
                    $sql = "UPDATE `user` SET `nama`='$nama', `email`='$email', `username`='$username', `level`='$level'
                    WHERE `id_user` = '$id_user'";
                    mysqli_query($koneksi,$sql);
                }
            }
            header("Location:user.php?notif=editberhasil");
    }
}
?>