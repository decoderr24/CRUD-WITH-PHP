<?php

require_once __DIR__ . '/koneksi.php';

$connection = koneksi();


// ambil semua data todolist
function getAll()
{
    global $connection;
    $sql = "SELECT * FROM tugas";
    return $connection->query($sql);
}


/**
 * ambil satu data todolist berdasarkan id
 * parameter $id = id
*/

function getOne($id)
{
    global $connection;
    $sql   = "SELECT * FROM tugas WHERE id = ? ";
    $stmt  = $connection->prepare($sql);
    $stmt->execute([$id]);
    return  $stmt->fetch();
}


// tambah data todolist ke dalam database
function add($data)
{
    global $connection;
    $sql  = "INSERT INTO tugas (nama_tugas,deadline) VALUES (?,?)";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$data['nama_tugas'], $data['deadline']]);
}


// edit data todolist ke dalam database

function edit($data, $id)
{
    global $connection;
    $sql  = "UPDATE tugas SET nama_tugas = ?, deadline = ? WHERE ? ";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$data['nama_tugas'], $data['deadline'], $id]);
}


// hapus data todolist
function delete($id)
{
    global $connection;
    $sql  = "DELETE FROM tugas WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->execute([$id]);
}
