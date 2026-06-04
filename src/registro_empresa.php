<?php
/**
 * registro_empresa.php
 * Guarda la empresa en la BD con aprobada = false
 */

session_start();
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_empresa = trim($_POST['nombre_empresa'] ?? '');
    $cuit = trim($_POST['cuit'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Validaciones
    if (empty($nombre_empresa) || empty($cuit) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'Por favor completa todos los campos';
        header('Location: ../vistas/auth/registro-empresa.php');
        exit;
    }
    
    if ($password !== $confirmPassword) {
        $_SESSION['error'] = 'Las contraseñas no coinciden';
        header('Location: ../vistas/auth/registro-empresa.php');
        exit;
    }
    
    if (strlen($password) < 6) {
        $_SESSION['error'] = 'La contraseña debe tener al menos 6 caracteres';
        header('Location: ../vistas/auth/registro-empresa.php');
        exit;
    }
    
    try {
        // Verificar si el email ya existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = 'El email ya está registrado';
            header('Location: ../vistas/auth/registro-empresa.php');
            exit;
        }
        
        // Insertar nueva empresa
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, password, tipo, nombre_empresa, cuit, aprobada) VALUES (?, ?, 'empresa', ?, ?, false)");
        
        $stmt->execute([$email, $hashedPassword, $nombre_empresa, $cuit]);
        
        $_SESSION['success'] = 'Registro exitoso. Por favor espera la aprobación del administrador.';
        header('Location: ../vistas/auth/login.php');
        exit;
        
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Error al registrar la empresa: ' . $e->getMessage();
        header('Location: ../vistas/auth/registro-empresa.php');
        exit;
    }
}
?>
