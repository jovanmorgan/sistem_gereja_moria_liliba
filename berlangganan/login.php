<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Gereja Moria Liliba</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../css/login_pengguna.css">
    <link rel="icon" type="image/png" href="../assets/img/gml.png">
    <style>
        .password-container {
            position: relative;
        }

        .password-container input[type="text"] {
            padding-right: 30px;
            /* Berikan padding agar ikon mata tidak bertabrakan dengan teks */
        }

        .password-container .show-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body translate="no">
    <section class="container">
        <div class="animated-bg" id="animated-bg-1"></div>
        <div class="animated-bg" id="animated-bg-2"></div>
        <div class="animated-bg" id="animated-bg-3"></div>
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="circle circle-three"></div>
            <div class="form-container">
                <h1 class="opacity">LOGIN</h1>
                <form id="login" action="../keamanan/proses_login" method="POST">
                    <input type="text" name="username" placeholder="USERNAME" required />
                    <div class="password-container">
                        <input type="password" name="password" id="password-original" placeholder="Password" required style="display:none;">
                        <input type="text" name="password-display" id="password-display" placeholder="Password" required>
                        <i class="fa fa-eye show-password" aria-hidden="true" onclick="togglePasswordVisibility()"></i>
                    </div>
                    <button type="submit" class="opacity">SUBMIT</button>
                </form>
            </div>
            <div class="circle circle-two"></div>
            <div class="circle circle-for"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/login_pengguna.js"></script>
    <script>
        function togglePasswordVisibility() {
            var passwordOriginal = document.getElementById('password-original');
            var passwordDisplay = document.getElementById('password-display');
            var passwordIcon = document.querySelector('.show-password');

            if (passwordIcon.classList.contains("fa-eye")) {
                // Show text input and replace with stars
                passwordIcon.classList.remove("fa-eye");
                passwordIcon.classList.add("fa-eye-slash");

                // Store the original password value and display stars
                passwordOriginal.value = passwordDisplay.value;
                passwordDisplay.value = '*'.repeat(passwordOriginal.value.length);
            } else {
                // Show text input and restore original value
                passwordIcon.classList.remove("fa-eye-slash");
                passwordIcon.classList.add("fa-eye");

                // Restore the original password value
                passwordDisplay.value = passwordOriginal.value;
            }
        }

        // Ensure the correct password value is sent on form submission
        document.getElementById('login').addEventListener('submit', function(event) {
            var passwordOriginal = document.getElementById('password-original');
            var passwordDisplay = document.getElementById('password-display');

            if (passwordDisplay.value.length > 0) {
                passwordOriginal.value = passwordDisplay.value;
            }
        });
    </script>
</body>

</html>