<?php
/**
 *kenny
 */


include ('../../config.php');

/*$nombres = $_POST['nombres'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];
$rol = $_POST['rol'];

if($password_user == ""){
    if($password_user == $password_repeat){
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios
    SET nombres=:nombres,
        email=:email,
        id_rol=:id_rol,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario = :id_usuario ");

        $sentencia->bindParam('nombres',$nombres);
        $sentencia->bindParam('email',$email);
        $sentencia->bindParam('id_rol',$rol);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_usuario',$id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo al usuario de la manera correcta";
        $_SESSION['icono'] = "success";
        header('Location: '.$URL.'/usuarios/');

    }else{*/
        // echo "error las contraseñas no son iguales";
        /*session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no son iguales";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }

}else{
    if($password_user == $password_repeat){
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("UPDATE tb_usuarios
    SET nombres=:nombres,
        email=:email,
        id_rol=:id_rol,
        password_user=:password_user,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario = :id_usuario ");

        $sentencia->bindParam('nombres',$nombres);
        $sentencia->bindParam('email',$email);
        $sentencia->bindParam('id_rol',$rol);
        $sentencia->bindParam('password_user',$password_user);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
        $sentencia->bindParam('id_usuario',$id_usuario);
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizo al usuario de la manera correcta";
        $_SESSION['icono'] = "success";
        header('Location: '.$URL.'/usuarios/');

    }else{
        // echo "error las contraseñas no son iguales";
        session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no son iguales";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }

}*/


$cedula=$_POST['cedula'];
$nombres=$_POST['nombres'];
$apellidos=$_POST['apellidos'];
$telefono_empl=$_POST['telefono_empl'];
$email=$_POST['email'];
$direccion_emple=$_POST['direccion_emple'];
$password_user=$_POST['password_user'];
$password_repeat=$_POST['password_repeat'];

$id_usuario=$_POST['id_usuario'];
$rol = $_POST['rol'];


if($password_user ==""){
    if($password_user == $password_repeat){
    
        $password_user= password_hash($password_user, PASSWORD_DEFAULT);//mas largo y con contador de las veces que ha encriptado esta contraseña y si se encripta cambia las veces que se acttualize
        
        $sentencia=$pdo->prepare("UPDATE tb_usuarios 
        SET cedula=:cedula,
            nombres=:nombres,
            apellidos=:apellidos,
            telefono_empl=:telefono_empl,
            email=:email,
            direccion_emple=:direccion_emple,
            id_rol=:id_rol,
            /*password_user=:password_user,*/
            fyh_actualizacion=:fyh_actualizacion 
        WHERE id_usuario=:id_usuario");
    
        $sentencia->bindParam('cedula',$cedula);
        $sentencia->bindParam('nombres',$nombres);
        $sentencia->bindParam('apellidos',$apellidos);
        $sentencia->bindParam('telefono_empl',$telefono_empl);
        $sentencia->bindParam('email',$email);
        $sentencia->bindParam('direccion_emple',$direccion_emple);
        /*$sentencia->bindParam('password_user',$password_user);*/
        $sentencia->bindParam('id_rol',$rol);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
    
        $sentencia->bindParam('id_usuario',$id_usuario);
        $sentencia->execute();
    
        session_start();
        $_SESSION['mensaje']="Se actualizo al usuario de la manera correcta";
    
        $_SESSION['icono']="success";
    
        header('Location:'.$URL.'/usuarios/');
    
    }else{
        
        session_start();
        $_SESSION['mensaje']="Error las contraseñas no son iguales";
        $_SESSION['icono']="error";
    
        header('Location:'.$URL.'/usuarios/update.php?id='.$id_usuario);
    
    }


}else{
    if($password_user == $password_repeat){
    
        $password_user= password_hash($password_user, PASSWORD_DEFAULT);//mas largo y con contador de las veces que ha encriptado esta contraseña y si se encripta cambia las veces que se acttualize
        
        $sentencia=$pdo->prepare("UPDATE tb_usuarios 
        SET cedula=:cedula,
            nombres=:nombres,
            apellidos=:apellidos,
            telefono_empl=:telefono_empl,
            email=:email,
            direccion_emple=:direccion_emple,
           
            password_user=:password_user,
            id_rol=:id_rol,
            fyh_actualizacion=:fyh_actualizacion 
        WHERE id_usuario=:id_usuario");
    
        $sentencia->bindParam('cedula',$cedula);
        $sentencia->bindParam('nombres',$nombres);
        $sentencia->bindParam('apellidos',$apellidos);
        $sentencia->bindParam('telefono_empl',$telefono_empl);
        $sentencia->bindParam('email',$email);
        $sentencia->bindParam('direccion_emple',$direccion_emple);
        
        $sentencia->bindParam('password_user',$password_user);
        $sentencia->bindParam('id_rol',$rol);
        $sentencia->bindParam('fyh_actualizacion',$fechaHora);
    
        $sentencia->bindParam('id_usuario',$id_usuario);
        $sentencia->execute();
    
        session_start();
        $_SESSION['mensaje']="Se actualizo al usuario de la manera correcta";
    
        $_SESSION['icono']="success";
    
        header('Location:'.$URL.'/usuarios/');
    
    }else{
        
        session_start();
        $_SESSION['mensaje']="Error las contraseñas no son iguales";
        $_SESSION['icono']="error";
    
        header('Location:'.$URL.'/usuarios/update.php?id='.$id_usuario);
    
    }
}




?>

