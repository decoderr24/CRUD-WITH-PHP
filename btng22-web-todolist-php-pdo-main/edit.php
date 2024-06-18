<?php
require_once __DIR__ . '/function.php';

// jika parameter id itu tidak ada atau ada parameter id tp isinya kosong maka ..
if (!(isset($_GET['id'])) || $_GET['id'] == null) {

    //pindah atau lempar ke halaman home
    header("location: home.php", true);
}

// ambil ada berdasarkan id dan tampung datanya kedalam variabel
$data = getOne($_GET['id']);



if (isset($_POST['editTodo'])) {

    // untuk membuat validasi 

    // jika nama_tugas kosong maka ...
    if ($_POST['nama_tugas'] == "") {
        echo "<script>alert('Nama tugas wajib diisi !')</script>";
    }

    // jika deadline kosong maka ...
    if ($_POST['deadline'] == "") {
        echo "<script>alert('Deadline wajib diisi !')</script>";
    }

    // jika nama_tugas DAN deadline ada isinya atau tidak kosong maka ...
    if ($_POST['nama_tugas'] && $_POST['deadline']) {

        // simpan data request ke dalam array
        $dataEdit = [
            'nama_tugas' => htmlspecialchars($_POST['nama_tugas']),
            'deadline'   => htmlspecialchars($_POST['deadline'])
        ];

        // olah ada edit ke dalam database
        edit($dataEdit, $data['id']);

        // pindah ke halaman home
        header("location: home.php", true);
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi MyTodo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<style>
    .navbar {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>

<body>
    <div class="container">
        <!-- Start Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">MyTodo</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Todo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Finish</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Start Form Input Todo List  -->
        <section class="input-todo mt-5">
            <div class="card col-md-8 mx-auto">
                <div class="card-header">
                    Mau melakukan apa hari ini ?
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="tugas" class="form-label">Tugas</label>
                            <input type="text" name="nama_tugas" class="form-control" id="tugas" value="<?php echo $data['nama_tugas'] ?>" placeholder="Masukkan tugas kamu">
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" name="deadline" class="form-control" id="deadline" value="<?php echo $data['deadline'] ?>" placeholder="Masukkan deadline kamu">
                        </div>

                        <button type="submit" name="editTodo" class="btn btn-sm btn-primary">Edit</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- End Form Input Todo List  -->

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</html>