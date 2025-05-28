# ❄️ Sistema Web para Venta y Mantenimiento de Aire Acondicionado

Sistema web completo para la **gestión integral de ventas, compras y mantenimiento de equipos de A/C**, ideal para empresas del sector técnico-comercial.

---

## 📌 Funcionalidades Principales

- 🛒 Registro de **compras a proveedores**
- 💰 Registro de **ventas a clientes**
- 🧰 Gestión de **órdenes de mantenimiento** de equipos
- ⏳ **Cálculo automático del próximo mantenimiento** (cada 6 meses)
- 📧 **Envío de correos automáticos** con PHPMailer
- 🔍 Filtros por **fechas** y **tipo de servicio** (Mantenimiento / Reparación)
- 📊 Reportes generados mediante **procedimientos almacenados**
- 💾 Integración completa con **base de datos MySQL**
- 👥 Módulo de **gestión de usuarios y roles**
- 🔐 Sistema de **asignación de módulos por rol** para seguridad y control de accesos

---

## 🛠️ Tecnologías Utilizadas

- 💻 **Frontend**:
  - HTML5
  - CSS3
  - JavaScript (Vanilla)
  - Bootstrap
  - SweetAlert2
  - DataTables

- ⚙️ **Backend**:
  - PHP puro (sin frameworks)
  - PHPMailer para envío de correos
  - MySQL con procedimientos almacenados

---

## 💻 Requisitos para Instalación Local

- XAMPP
- Visual Studio Code
- Git
- Navegador web moderno

---

## 🚀 Pasos para Instalar y Ejecutar Localmente

### 1️⃣ Clona el repositorio
```bash
git clone https://github.com/Jordan-dito/Sistema-Web-para-venta-y-mantenimiento-de-A-C.git
```

### 2️⃣ Copia el proyecto a la carpeta `htdocs` de XAMPP
Ejemplo de ruta:
```
C:\xampp\htdocs\Sistema-Web-para-venta-y-mantenimiento-de-A-C
```

### 3️⃣ Configura las credenciales  
Edita el archivo `config/config.php`:
```php
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','nombre_base_datos');

define('SMTP_HOST', 'smtp.tudominio.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'correo@tudominio.com');
define('SMTP_PASS', 'tupassword');
define('SMTP_FROM_NAME', 'Nombre del Remitente');

$URL = "http://localhost/Sistema-Web-para-venta-y-mantenimiento-de-A-C";
```

### 4️⃣ Importa la base de datos
- Accede a [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Crea una base de datos con el mismo nombre configurado en `config.php`
- Importa el archivo `.sql` desde la carpeta `/bd/` (si está disponible)

### 5️⃣ Inicia Apache y MySQL desde XAMPP
Asegúrate de que ambos servicios estén activos (verde)

### 6️⃣ Abre el sistema en tu navegador
```
http://localhost/Sistema-Web-para-venta-y-mantenimiento-de-A-C
```

---

## 🙋‍♂️ Autor

**Jordan Lapo** – *Ingeniero en Ciencias de la Computación*
