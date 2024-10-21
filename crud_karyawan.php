<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Karyawan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
            color: #333;
        }

        h2 {
            color: #000000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #66b3ff;
            color: white;
        }

        a {
            text-decoration: none;
            padding: 8px;
            margin: 5px;
            border-radius: 3px;
            font-weight: bold;
        }

        a.input-btn {
            background-color: #66b3ff;
            color: #fff;
        }

        a.edit-btn {
            background-color: #ff9900;
            color: #fff;
        }

        a.delete-btn {
            background-color: #ff6666;
            color: #fff;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"], input[type="radio"], input[type="submit"] {
            margin-bottom: 10px;
            padding: 12px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #66b3ff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container">

    <?php
    require("config.php");
    $hub = open_connection();
    $a = @$_GET["a"];
    $id = @$_GET["id"];
    $sql = @$_POST["sql"];
    switch ($sql) {
        case "create":
            create_karyawan();
            break;
        case "update":
            update_karyawan();
            break;
        case "delete":
            delete_karyawan();
            break;
    }
    switch ($a) {
        case "list":
            read_data();
            break;
        case "input":
            input_data();
            break;
        case "edit":
            edit_data($id);
            break;
        case "hapus":
            hapus_data($id);
            break;
        default:
            read_data();
            break;
    }
    mysqli_close($hub);
    ?>

    <?php
    function read_data() {
        global $hub;
        $query = "select * from karyawan";
        $result = mysqli_query($hub, $query);
        ?>
        <h2>Daftar karyawan</h2>
        <a class="input-btn" href="crud_karyawan.php?a=input">Input Data</a>
        <table>
            <tr>
                <th>Id</th>
                <th>Nama </th>
                <th>Tanggal Lahir</th>
                <th>Gaji</th>
                <th>Action</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td><?php echo $row['Id']; ?></td>
                    <td><?php echo $row['Nama']; ?></td>
                    <td><?php echo $row['Tgl_Lahir']; ?></td>
                    <td><?php echo $row['Gaji']; ?></td>
                    <td>
                        <a class="edit-btn" href="crud_karyawan.php?a=edit&id=<?php echo $row['Id']; ?>">Edit</a>
                        <a class="delete-btn" href="crud_karyawan.php?a=hapus&id=<?php echo $row['Id']; ?>">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }
    ?>

    <?php
    function input_data() {
        $row = array(
            "Nama" => "",
            "Tgl_Lahir" => "",
            "Gaji" => "",
            "id_tlog" => ""
        );
        ?>
        <h2>Input Data karyawan</h2>
        <form action="crud_karyawan.php?a=list" method="post">
            <input type="hidden" name="sql" value="create">
            Nama
            <input type="text" name="Nama" maxlength="6" size="6" value="<?php echo trim($row["Nama"]) ?>" /><br>
            Tanggal Lahir
            <input type="text" name="Tgl_Lahir" maxlength="70" size="70" value="<?php echo trim($row["Tgl_Lahir"]) ?>" /><br>
            Gaji
            <input type="text" name="Gaji" maxlength="70" size="70" value="<?php echo trim($row["Gaji"]) ?>" /><br>
            Id_tlog
            <input type="text" name="id_prodi" maxlength="70" size="70" value="<?php echo trim($row["id_tlog"]) ?>" /><br>
            <input type="submit" name="action" value="Simpan"><br>
            <a href="crud_karyawan.php?a=list">Batal</a>
        </form>
        <?php
    }
    ?>

    <?php
    function edit_data($id) {
        global $hub;
        $query = "select * from karyawan where id = $id";
        $result = mysqli_query($hub, $query);
        $row = mysqli_fetch_array($result);
        ?>
        <h2>Edit Data karyawan</h2>
        <form action="crud_karyawan.php?a=list" method="post">
            <input type="hidden" name="sql" value="update">
            <input type="hidden" name="id_mhs" value="<?php echo trim($id) ?>">
            Nama
            <input type="text" name="nim" maxlength="6" size="6" value="<?php echo trim($row["nama"]) ?>" /><br>
            Tanggal Lahir
            <input type="text" name="nama" maxlength="70" size="70" value="<?php echo trim($row["Tgl_Lahir"]) ?>" /><br>
            Gaji
            <input type="text" name="alamat" maxlength="70" size="70" value="<?php echo trim($row["Gaji"]) ?>" /><br>
            Id_tlog
            <input type="text" name="id_prodi" maxlength="70" size="70" value="<?php echo trim($row["Id_tlog"]) ?>" /><br>
           <input type="submit" name="action" value="Simpan"><br>
            <a href="crud_karyawan.php?a=list">Batal</a>
        </form>
        <?php
    }
    ?>

    <?php
    function hapus_data($id) {
        global $hub;
        $query = "select * from karyawan where id = $id";
        $result = mysqli_query($hub, $query);
        $row = mysqli_fetch_array($result);
        ?>
        <h2>Hapus Data karyawan</h2>
        <form action="crud_karyawan.php?a=list" method="post">
            <input type="hidden" name="sql" value="delete">
            <input type="hidden" name="id_mhs" value="<?php echo trim($id) ?>">
            <table>
                <tr><td width=100>Nama</td><td><?php echo trim($row["Nama"]) ?></td></tr>
                <tr><td>Tanggal Lahir</td><td><?php echo trim($row["Tgl_Lahir"]) ?></td></tr>
                <tr><td>Gaji</td><td><?php echo trim($row["Gaji"]) ?></td></tr>
                <tr><td>Id_tlog</td><td><?php echo trim($row["Id_tlog"]) ?></td></tr>
            </table>
            <br><input type="submit" name="action" value="Hapus"><br>
            <a href="crud_karyawan.php?a=list">Batal</a>
        </form>
        <?php
    }
    ?>

    <?php
    function create_karyawan()
    {
        global $hub;
        global $_POST;
        $query = "insert into mahasiswa (Nama, Tgl_Lahir, Id_tlog) values ";
        $query .= " ('" . $_POST["Nama"] . "', '" . $_POST["Tgl_Lahir"] . "', , '" . $_POST["Gaji"] . "', '" . $_POST["Id_tlog"] . "')";
        mysqli_query($hub, $query) or die(mysql_error());
    }

    function update_karyawan()
{
    global $hub;
    global $_POST;

    $Id = $_POST["Id"];
    $Nama = $_POST["Nama"];
    $Tanggal Lahir= $_POST["Tgl_Lahir"];
    $Gaji = $_POST["Gaji"];
    $Id_tlog = $_POST["Id_tlog"];

    // Periksa apakah kunci `Id_tlog` ada dalam array
    if (!array_key_exists("Id_tlog", $_POST)) {
        // Ubah pengecualian menjadi `false`
        return false;
    }

    // Periksa apakah nilai kunci `Id_tlog` valid
    if (!is_numeric($_POST["Id_tlog"]) || !mysqli_num_rows(mysqli_query($hub, "SELECT * FROM tlog WHERE Id_tlog = " . $_POST["Id_tlog"]))) {
        // Ubah pengecualian menjadi `false`
        return false;
    }

    // Perbarui data Karyawan
    $query = "UPDATE karyawan SET
        Nama = '$Nama',
        Tgl_Lahir= '$Tgl_Lahir',
        Gaji= '$Gaji',
        Id_tlog = '$Id_tlog'
        WHERE id = '$id'";
    mysqli_query($hub, $query);

    // Kembalikan `true`
    return true;
}


    function delete_karyawan()
    {
        global $hub;
        global $_POST;
        $query = "DELETE FROM karyawan ";
        $query .= " WHERE id = " . $_POST["id"];
        mysqli_query($hub, $query) or die(mysql_error());
    }
    ?>
    
</div>

</body>
</html>