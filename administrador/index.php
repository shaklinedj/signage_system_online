
<!DOCTYPE html>
<html>
<head>
  <title>publicidad Dreams</title>
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../admin/styles.css">
  
</head>
<body>
  <?php include"../admin/navbar.php";
        include"../login-master/config.php";
  ?>
        
  <div class="text-center">
    <!-- Registro de Usuarios -->
    <a href="register.php" style="display: inline-block; margin-right: 20px;">
      <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
        <line x1="16" y1="11" x2="8" y2="11"/>
      </svg>
      <p class="font-italic isai5">Registro Usuarios</p>
    </a>
    
    <!-- Restablecimiento de Contraseñas -->
    <a href="reset-password.php" style="display: inline-block;">
      <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <line x1="15" y1="9" x2="9" y2="15"/>
        <line x1="9" y1="9" x2="15" y2="15"/>
      </svg>
      <p class="font-italic isai5">Reseteo Contraseñas</p>
    </a>
  </div>
</body>
</html>
