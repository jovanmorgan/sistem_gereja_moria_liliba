// bulat login
document.addEventListener('mousemove', (event) => {
    const x = event.clientX;
    const y = event.clientY;
    const width = window.innerWidth;
    const height = window.innerHeight;

    const bg1 = document.getElementById('animated-bg-1');
    const bg2 = document.getElementById('animated-bg-2');
    const bg3 = document.getElementById('animated-bg-3');

    const moveFactor1 = 0.92;
    const moveFactor2 = 0.95;
    const moveFactor3 = 0.99;

    const translateX1 = (x - width / 2) * moveFactor1;
    const translateY1 = (y - height / 2) * moveFactor1;

    const translateX2 = (x - width / 2) * moveFactor2;
    const translateY2 = (y - height / 2) * moveFactor2;

    const translateX3 = (x - width / 2) * moveFactor3;
    const translateY3 = (y - height / 2) * moveFactor3;

    bg1.style.transform = `translate(${translateX1}px, ${translateY1}px)`;
    bg2.style.transform = `translate(${translateX2}px, ${translateY2}px)`;
    bg3.style.transform = `translate(${translateX3}px, ${translateY3}px)`;
});


document.getElementById("login").addEventListener("submit", function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../keamanan/proses_login", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                var responseArray = response.split(':');
                if (responseArray[0].trim() === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login berhasil!',
                        text: 'Selamat datang ' + responseArray[1],
                        timer: 2000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    }).then((result) => {
                        switch (responseArray[2].trim()) {
                            case "admin":
                                window.location.href = "../pengguna/admin/";
                                break;
                            case "rayon":
                                window.location.href = "../pengguna/rayon/";
                                break;
                            case "kepala_keluarga":
                                window.location.href = "../pengguna/jemaat/";
                                break;
                            case "pendeta":
                                window.location.href = "../pengguna/pendeta/";
                                break;
                            default:
                                window.location.href = "login";
                                break;
                        }
                    });

                    if (rememberMe) {
                        var username = formData.get('username');
                        var password = formData.get('password');
                        document.cookie = "username=" + encodeURIComponent(
                            username) + "; path=/";
                        document.cookie = "password=" + encodeURIComponent(password) + "; path=/";
                    }
                } else if (responseArray[0].trim() === "error_password") {
                    Swal.fire("Error", "Password yang dimasukkan salah", "error");
                } else if (responseArray[0].trim() === "error_username") {
                    Swal.fire("Error", "Username tidak ditemukan", "error");
                } else if (responseArray[0].trim() === "username_tidak_ada") {
                    Swal.fire("Info", "Username belum diisi", "info");
                } else if (responseArray[0].trim() === "password_tidak_ada") {
                    Swal.fire("Info", "Password belum diisi", "info");
                } else if (responseArray[0].trim() === "tidak_ada_data") {
                    Swal.fire("Info", "Username dan Password belum diisi", "info");
                } else {
                    Swal.fire("Error", "Terjadi kesalahan saat proses login", "error");
                }
            } else {
                Swal.fire("Error", "Gagal", "error");
            }
        }
    };
    xhr.onerror = function () {
        Swal.fire("Error", "Gagal melakukan request", "error");
    };
    xhr.send(formData);
});