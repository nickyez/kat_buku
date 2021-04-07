<?php
    session_start();
    include('../koneksi/koneksi.php');
    if(isset($_SESSION['id_buku'])){
    $id_buku = $_SESSION['id_buku'];
    $id_kategori_buku = $_POST['kategori_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $id_penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $sinopsis = addslashes($_POST['sinopsis']);
    $tag = $_POST['tag'];
    $lokasi_file = $_FILES['cover']['tmp_name'];
    $nama_file = $_FILES['cover']['name'];
    $direktori = 'cover/'.$nama_file;
    //get cover
    $sql_f = "SELECT `cover` FROM `buku` WHERE `id_buku`='$id_buku'";
    $query_f = mysqli_query($koneksi,$sql_f);
    while($data_f = mysqli_fetch_row($query_f)){
        $cover = $data_f[0];
        //echo $foto;
    }
    if(empty($id_kategori_buku)){
        header("Location:editbuku.php?data=$id_buku&notif=editkosong&jenis=Kategori Buku");
    }else if(empty($judul)){
        header("Location:editbuku.php?data=$id_buku&notif=editkosong&jenis=Judul");
    }else if(empty($pengarang)){
        header("Location:editbuku.php?data=$id_buku&notif=editkosong&jenis=Pengarang");
    }else if(empty($id_penerbit)){
        header("Location:editbuku.php?data=$id_buku&notif=editkosong&jenis=Penerbit");
    }else if(empty($tahun_terbit)){
        header("Location:editbuku.php?data=$id_buku&notif=editkosong&jenis=Tahun Terbit");
    }else if(empty($tag)){
        header("Location:editbuku.php?data=$id_buku&notif=editkosong&jenis=Tag");
    }else{
        $lokasi_file = $_FILES['cover']['tmp_name'];
        $nama_file = $_FILES['cover']['name'];
        $direktori = 'cover/'.$nama_file;
        if(move_uploaded_file($lokasi_file,$direktori)){
        if(!empty($cover)){ unlink("cover/$cover");
        }
        $sql = "UPDATE `buku` SET
        `id_kategori_buku`='$id_kategori_buku',`judul`='$judul',
        `pengarang`='$pengarang',`id_penerbit`='$id_penerbit',
        `tahun_terbit`='$tahun_terbit',`sinopsis`='$sinopsis',
        `cover`='$nama_file'
        WHERE `id_buku`='$id_buku'";
        mysqli_query($koneksi,$sql);
    }else{
        $sql = "UPDATE `buku` set
        `id_kategori_buku`='$id_kategori_buku',`judul`='$judul',
        `pengarang`='$pengarang',`id_penerbit`='$id_penerbit',
        `tahun_terbit`='$tahun_terbit',`sinopsis`='$sinopsis'
        WHERE `id_buku`='$id_buku'";
        mysqli_query($koneksi,$sql);
    } 
    //hapus tag
    $sql_d = "delete from `tag_buku` where `id_buku`='$id_buku'";
    mysqli_query($koneksi,$sql_d);
    //tambah tag
    if(!empty($_POST['tag'])){
        foreach($_POST['tag'] as $id_tag){
            $sql_t = "INSERT INTO `tag_buku` (`id_buku`, `id_tag`) VALUES ('$id_buku', '$id_tag')";
            mysqli_query($koneksi,$sql_t);
        }
    }
    header("Location:buku.php?notif=editberhasil");
    } }
?>