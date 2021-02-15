<?php

    session_start();
    
    //connection db
    $conn = new mysqli('localhost', 'root', '', '5psolutions');
    if($conn->connect_error) {
        die("Connection Failed!" . $conn->connect_error);
    }

    //variables
    $update = false;
    $nume = '';
    $descriere = '';
    $pret = '';

    //actions
    if(isset($_POST['save'])) {
        $nume = $_POST['nume'];
        $descriere = $_POST['descriere'];
        $pret = $_POST['pret'];

        $stmt = $conn->prepare("INSERT INTO products (nume, descriere, pret) VALUES (?, ?, ?)");
        $stmt->bind_param("ssd", $nume, $descriere, $pret);
        $stmt->execute();
        $stmt->close();

        header('location: index.php');
    }

    if(isset($_GET['edit'])) {
        $update = true;
        $id = $_GET['edit'];
        $result = $conn->query("SELECT * FROM products WHERE id=$id") or die('Error1!');
        if(count(array($result))) {
            $row = $result->fetch_array();
            $nume = $row['nume'];
            $descriere = $row['descriere'];
            $pret = $row['pret'];
        }
    }

    if(isset($_POST['update'])) {
        $id = $_POST['id'];
        $nume = $_POST['nume'];
        $descriere = $_POST['descriere'];
        $pret = $_POST['pret'];
        $stmt = $conn->prepare("UPDATE products SET nume=?, descriere=?, pret=? WHERE id=$id");
        $stmt->bind_param("ssd", $nume, $descriere, $pret);
        $stmt->execute();

        header('location: index.php');
    }

    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $conn->query("DELETE FROM products WHERE id=$id") or die($mysqli->error());

        header('location: index.php');
    }