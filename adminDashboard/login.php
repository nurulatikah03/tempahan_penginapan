<?php
session_start();
require_once 'require/UserFunctions.php';

if (isset($_SESSION['username'])) {
  header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $username = htmlspecialchars($_POST['username']);
  $password = htmlspecialchars($_POST['userpass']);


  $user = checkUser($username, $password);
  if ($user) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $user['role'];
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    header('Location: index.php');
  } else {
    $_SESSION['error'] = 'Username atau password salah';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Login LKTN INSKET</title>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link rel="icon" type="image/x-icon" href="assets/images/logo/logo2.png">


  <!-- MDB -->
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css"
    rel="stylesheet" />
</head>
<style>
  body {
    font-family: 'Poppins';
  }
</style>

<body>
  <!-- Start your project here-->
  <section class="vh-100" style="background-color:#254222;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="m-5 col col-xl-7">
          <div class="card text-center" style="border-radius: 1rem; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            <div class="card-body p-4 p-lg-5 text-black overflow-hidden">
              <div class="d-flex align-items-center mb-3 pb-1">
                <img src="assets\images\logo\logo2.png" class="img-fluid me-3" style="max-height: 90px; max-width: 90px;" alt=" kerajaan" />
                <span class="h1 fw-bold mb-0 d-none d-lg-block" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">LEMBAGA KENAF DAN TEMBAKAU NEGARA</span>
                <span class="h2 fw-bold mb-0 d-none d-md-block d-lg-none" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">LEMBAGA KENAF DAN TEMBAKAU NEGARA</span>
                <span class="h4 fw-bold mb-0 d-block d-md-none" style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">LEMBAGA KENAF DAN TEMBAKAU NEGARA</span>
              </div>

              <form method="POST">
                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">LOGIN KE SISTEM TEMPAHAN INSKET</h5>

                <div class="form-outline mb-4">
                  <input type="text" id="username" name="username" class="form-control form-control-lg" required />
                  <label class="form-label" for="username">Nama Pengguna</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" name="userpass" id="userPass" class="form-control form-control-lg" required />
                  <label class="form-label" for="userPass">Kata Laluan</label>
                </div>
                <?php if (isset($_SESSION['error'])) { ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= $_SESSION['error'] ?>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                  </div>
                  <?php unset($_SESSION['error']); ?>
                <?php } ?>

                <div class="pt-1 mb-5">
                  <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                  <a class="d-block text-center mt-3 small" href="#">Lupa Kata Laluan? Hubungi admin</a>
                </div>
                <hr>
                <div class="d-flex justify-content-center">
                  <p class="text-decoration-none text-dark">Sistem Tempahan Institut Latihan Kenaf dan Tembakau (INSKET) LKTN @ <strong>Padang Pak Amat, 16800 Pasir Puteh, Kelantan</strong> </p>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End your project here-->
  <script type="text/javascript" src="assets/js/mdb.min.js"></script>

</body>

</html>