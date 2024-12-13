<!-- head.php -->
<?php include 'nama_halaman.php'; ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/gml.png">
    <title>
        Halaman <?php echo getPageTitle(); ?> | Gereja Moria Liliba
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../assets/css/loading.css">
    <link rel="stylesheet" href="../../assets/css/poup_profile.css">
    <link rel="stylesheet" href="../../css/profile.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Custom CSS for Modal -->

    <?php
    $current_page = basename($_SERVER['PHP_SELF'], ".php");

    // Array mapping halaman ke stylesheet khusus
    $stylesheets = [
        'jenis_pelayanan' => 'pop_up_jenis_pelayanan.css',
        'permohonan_pelayanan' => 'pop_up_permohonan_pelayanan.css',
        'dashboard' => 'card_dasboard.css'
    ];

    // Include stylesheet khusus jika ada di array
    if (array_key_exists($current_page, $stylesheets)) {
        echo '<link rel="stylesheet" href="../../assets/css/' . $stylesheets[$current_page] . '">';
    }

    // Include stylesheet pop_up.css jika bukan halaman jenis_pelayanan atau permohonan_pelayanan
    if (!in_array($current_page, ['jenis_pelayanan', 'permohonan_pelayanan'])) {
        echo '<link rel="stylesheet" href="../../assets/css/pop_up.css">';
    }
    ?>
</head>