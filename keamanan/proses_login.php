<?php
include 'koneksi.php';

function checkpenggunahType($username)
{
    global $koneksi;
    $query_rayon = "SELECT * FROM rayon WHERE username = '$username'";
    $query_kepala_keluarga = "SELECT * FROM kepala_keluarga WHERE username = '$username'";
    $query_pendeta = "SELECT * FROM pendeta WHERE username = '$username'";

    $result_rayon = mysqli_query($koneksi, $query_rayon);
    $result_kepala_keluarga = mysqli_query($koneksi, $query_kepala_keluarga);
    $result_pendeta = mysqli_query($koneksi, $query_pendeta);

    if (mysqli_num_rows($result_rayon) > 0) {
        return "rayon";
    } elseif (mysqli_num_rows($result_kepala_keluarga) > 0) {
        return "kepala_keluarga";
    } elseif (mysqli_num_rows($result_pendeta) > 0) {
        return "pendeta";
    } else {
        return "not_found";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Lakukan validasi data
    if (empty($username) && empty($password)) {
        echo "tidak_ada_data";
        exit();
    }
    if (empty($username)) {
        echo "username_tidak_ada";
        exit();
    }

    if (empty($password)) {
        echo "password_tidak_ada";
        exit();
    }


    $penggunahType = checkpenggunahType($username);
    if ($penggunahType !== "not_found") {
        $query_penggunah = "SELECT * FROM $penggunahType WHERE username = '$username'";
        $result_penggunah = mysqli_query($koneksi, $query_penggunah);

        if (mysqli_num_rows($result_penggunah) > 0) {
            $row = mysqli_fetch_assoc($result_penggunah);
            $hashed_password = $row['password'];

            if ($password === $hashed_password) {

                // Process login for other penggunah types
                session_start();
                $_SESSION['username'] = $username;

                switch ($penggunahType) {
                    case "rayon":
                        $_SESSION['id_rayon'] = $row['id_rayon'];
                        $id_rayon = $row['id_rayon'];
                        break;
                    case "kepala_keluarga":
                        $_SESSION['id_kepala_keluarga'] = $row['id_kepala_keluarga'];
                        break;
                    case "pendeta":
                        $_SESSION['id_pendeta'] = $row['id_pendeta'];
                        break;
                    default:
                        break;
                }

                // Success response
                switch ($penggunahType) {
                    case "rayon":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../../pengguna/rayon/";
                        break;
                    case "kepala_keluarga":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../../pengguna/jemaat/";
                        break;
                    case "pendeta":
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../../pengguna/pendeta/";
                        break;
                    default:
                        echo "success:" . $username . ":" . $penggunahType . ":" . "../../berlangganan/login";
                        break;
                }
            } else {
                echo "error_password";
            }
        } else {
            echo "error_username";
        }
    } else {
        echo "error_username";
    }
}
