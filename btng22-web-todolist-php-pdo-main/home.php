<?php
require_once __DIR__ . '/function.php';

if (isset($_POST['delete'])) {
    # code...
    if (isset($_GET['idTodo'])) {
        delete($_GET['idTodo']);
    }

    header("location: home.php", true);
}

if (isset($_POST['tambahTodo'])) {

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
        $data = [
            'nama_tugas' => htmlspecialchars($_POST['nama_tugas']),
            'deadline'   => htmlspecialchars($_POST['deadline'])
        ];

        // olah ada masukkan ke dalam datanbase
        add($data);

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
                            <input type="text" class="form-control" name="nama_tugas" id="tugas" placeholder="Masukkan tugas kamu">
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" placeholder="Masukkan deadline kamu">
                        </div>
                        <button type="submit" name="tambahTodo" class="btn btn-sm btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- End Form Input Todo List  -->


        <!-- Start table data todo -->
        <section class="data-table mt-4">
            <div class="col-md-8 mx-auto">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tugas saya</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach (getAll() as $todo) : ?>
                            <tr>
                                <th scope="row"><?php echo $no++ ?></th>
                                <td><?php echo $todo['nama_tugas'] ?></td>
                                <td><?php echo date('d F Y', strtotime($todo['deadline'])) ?></td>
                                <td><span class="badge rounded-pill text-bg-warning">on progress</span></td>
                                <td>

                                    <a href="edit.php?id=<?php echo $todo['id'] ?>" class="badge rounded-pill text-bg-warning">Edit</a>
                                    <a href="" class="badge rounded-pill text-bg-primary">Done</a>

                                    <!-- <a href="index.php?delete=<?php echo $todo['id'] ?>" class="badge rounded-pill text-bg-danger" onclick="return confirm('Anda yakin ingin menghapus data ini ?')">Delete</a> -->
                                    <form action="?idTodo=<?php echo $todo['id'] ?>" method="post">
                                        <!-- <input type="hidden" name="id" value="<?= $todo['id'] ?>"> -->
                                        <button type="submit" name="delete" onclick="return confirm('Anda yakin ingin menghapus data ini ?')" class="badge rounded-pill text-bg-danger border-0">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </section>
        <!-- End table data todo -->


    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</html>