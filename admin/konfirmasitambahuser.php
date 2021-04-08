 <?php
    include('../koneksi/koneksi.php');
    $foto = $_POST['foto'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $user = mysqli_real_escape_string($koneksi, $username );
    $pass = mysqli_real_escape_string($koneksi, md5($password) );

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $direktori = 'foto/'.$nama_file;

    if (empty($nama)) {
        header("Location:tambahuser.php?data=$id_user&notif=tambahkosong&jenis=Nama");
    }else if (empty($email)) {
        header("Location:tambahuser.php?data=$id_user&notif=tambahkosong&jenis=Email");
    }else if (empty($username)) {
        header("Location:tambahuser.php?data=$id_user&notif=tambahkosong&jenis=Username");
    }else if (empty($password)) {
        header("Location:tambahuser.php?data=$id_user&notif=tambahkosong&jenis=Password");
    }else if ( move_uploaded_file($lokasi_file,$direktori)) {
        
         $sql = "INSERT INTO `user` (`foto`, `nama`, `email`, `username`, `password`, `level`) 
                VALUES('$nama_file', '$nama', '$email', '$user', '$pass', '$level')";
            
            mysqli_query($koneksi,$sql);
            header("Location:user.php?notif=tambahberhasil");
            
    }else if(empty($foto)) {
        header("Location:tambahuser.php?data=$id_user&notif=tambahkosong&jenis=Foto");
    }
?>