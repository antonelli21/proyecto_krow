<?php
/**
 * login_process.php
 * Valida el correo/CUIT y contraseña contra la base de datos MySQL
 */

session_start();
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Por favor completa todos los campos';
        header('Location: ../vistas/auth/login.php');
        exit;
    }
    
    try {
        // Buscar usuario en la base de datos
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($password, $usuario['password'])) {
            // Login exitoso
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_tipo'] = $usuario['tipo']; // 'estudiante' o 'empresa'
            
            // Redirigir según el tipo de usuario
            $redirectTo = $usuario['tipo'] === 'empresa' ? 
                '../vistas/empresa/home-empresa.php' : 
                '../vistas/estudiante/home-estudiante.php';
            
            header("Location: $redirectTo");
            exit;
        } else {
            $_SESSION['error'] = 'Credenciales inválidas';
            header('Location: ../vistas/auth/login.php');
            exit;
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error en la base de datos';
        header('Location: ../vistas/auth/login.php');
        exit;
    }
}
?>
