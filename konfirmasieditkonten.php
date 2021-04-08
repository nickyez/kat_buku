<?php
    session_start();
    include('../koneksi/koneksi.php');
    if(isset($_SESSION['id_konten'])){
        $id_konten = $_SESSION['id_konten'];
        $judul = $_POST['judul'];
        $isi = $_POST['isi'];
        $tanggal = $_POST['tanggal'];
        
        if(empty($judul)){
            header("Location:editkonten.php?data=$id_konten&notif=editkosong&jenis=Judul");
        }else if(empty($isi)){
            header("Location:editkonten.php?data=$id_konten&notif=editkosong&jenis=Isi");
        }else if(empty($tanggal)){
            header("Location:editkonten.php?data=$id_konten&notif=editkosong&jenis=Tanggal");
        }else{
            $sql = "UPDATE `konten` 
                    SET `judul`='$judul', `isi`='$isi', `tanggal`='$tanggal'
                    WHERE `konten`.`id_konten`='$id_konten'";
            mysqli_query($koneksi,$sql);
            header("Location:konten.php?notif=editberhasil");
        }
    }
?>