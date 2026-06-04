# Krow - Plataforma de Empleo Comunitaria

## Descripción

Krow es una plataforma de empleo moderna basada en comunidad y sistema de reputación. Conecta estudiantes y profesionales con empresas, permitiendo que ambas partes construyan su credibilidad a través de votación comunitaria.

## Características

### Para Estudiantes
- 🔍 Buscar ofertas de empleo filtradas por modalidad (presencial, remoto, híbrido) y jornada
- 📝 Postularse a ofertas
- 💬 Mensajería con empresas
- ⭐ Sistema de reputación comunitaria
- 👤 Perfil personalizable
- 📋 Seguimiento de postulaciones

### Para Empresas
- 📢 Publicar ofertas de empleo
- 👥 Ver postulantes y filtrarlos
- 💬 Mensajería con candidatos
- 📊 Dashboard con estadísticas
- ⭐ Reputación basada en comunidad
- 🗂️ Base de datos de ofertas

## Estructura del Proyecto

```
krow-repository/
├── config/
│   └── conexion.php              # Conexión centralizada a la BD (PDO)
├── database/
│   └── krow_db.sql               # Script de la base de datos
├── includes/
│   ├── header.php                # Navbar reutilizable
│   ├── sidebar-filtros.php       # Filtros de modalidad y jornada
│   └── footer.php                # Pie de página
├── public/
│   ├── css/
│   │   └── styles.css            # Estilos en Modo Noche
│   ├── js/
│   │   └── main.js               # Lógica del front-end
│   └── img/
├── src/
│   ├── login_process.php         # Validación de login
│   ├── registro_empresa.php      # Registro de empresas
│   ├── crear_oferta.php          # Creación de ofertas
│   └── gestionar_voto.php        # Sistema de votos
├── vistas/
│   ├── auth/
│   │   ├── login.php
│   │   ├── registro-estudiante.php
│   │   └── registro-empresa.php
│   ├── estudiante/
│   │   ├── home-estudiante.php
│   │   ├── oferta-detalle.php
│   │   ├── perfil-estudiante.php
│   │   ├── mensajes-estudiante.php
│   │   ├── empresas-lista.php
│   │   └── postulaciones-lista.php
│   ├── empresa/
│   │   ├── home-empresa.php
│   │   ├── base-empresa.php
│   │   ├── mensajes-empresa.php
│   │   └── postulantes-empresa.php
│   ├── ayuda.php
│   └── configuracion.php
├── index.php                     # Landing page
└── README.md
```

## Requisitos

- **PHP 7.4+**
- **MySQL 5.7+**
- **Servidor web** (Apache, Nginx)
- **PDO para MySQL**

## Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tuusuario/krow-repository.git
   cd krow-repository
   ```

2. **Importar la base de datos**
   - Abre phpMyAdmin
   - Crea una nueva base de datos: `krow_db`
   - Importa el archivo `database/krow_db.sql`

3. **Configurar la conexión**
   - Edita `config/conexion.php`
   - Actualiza host, usuario, contraseña y nombre de BD según tu ambiente

4. **Configurar permisos**
   ```bash
   chmod -R 755 vistas/
   chmod -R 755 public/
   ```

5. **Iniciar servidor local**
   ```bash
   php -S localhost:8000
   ```

6. **Acceder a la aplicación**
   - Abre tu navegador en: `http://localhost:8000`

## Uso

### Registrarse
- Estudiante: Completa nombre, email y contraseña
- Empresa: Completa nombre de empresa, CUIT, email y contraseña

### Buscar Ofertas (Estudiante)
- Filtra por modalidad y jornada
- Haz clic en una oferta para ver detalles
- Presiona "Postularme" para aplicar

### Publicar Ofertas (Empresa)
- Ve a "Base de Ofertas"
- Completa los datos del puesto
- Publica la oferta
- Visualiza postulantes y contacta candidatos

## Base de Datos

### Tabla: usuarios
- `id` - PK
- `email` - Único
- `password` - Hash bcrypt
- `tipo` - 'estudiante' o 'empresa'
- `nombre` / `nombre_empresa`
- `telefono`
- `reputacion` - INT (votos positivos)
- `aprobada` - BOOLEAN (solo para empresas)

### Tabla: ofertas
- `id` - PK
- `empresa_id` - FK a usuarios
- `titulo`
- `descripcion`
- `modalidad` - presencial/remoto/hibrido
- `jornada` - completa/media/pasantia
- `experiencia`
- `salario`
- `estado` - activa/cerrada
- `fecha_creacion`

### Tabla: postulaciones
- `id` - PK
- `estudiante_id` - FK a usuarios
- `oferta_id` - FK a ofertas
- `estado` - pendiente/aceptada/rechazada
- `fecha_postulacion`

### Tabla: mensajes
- `id` - PK
- `remitente_id` - FK a usuarios
- `destinatario_id` - FK a usuarios
- `contenido`
- `fecha_mensaje`

### Tabla: votos
- `id` - PK
- `usuario_votante_id` - FK a usuarios
- `objeto_id` - ID del usuario votado
- `tipo_objeto` - 'usuario' o 'empresa'
- `tipo` - 'positivo' o 'negativo'
- `fecha_voto`

## Tecnologías Utilizadas

- **Backend**: PHP (PDO)
- **Frontend**: HTML5, CSS3, JavaScript
- **Diseño**: Bootstrap (personalizado - Modo Noche)
- **Base de Datos**: MySQL
- **Seguridad**: Password Hash (bcrypt), Session

## Seguridad

- ✅ Contraseñas hasheadas con bcrypt
- ✅ Prevención de inyección SQL (prepared statements)
- ✅ Validación de sesiones
- ✅ CSRF protection (sesiones)
- ✅ Sanitización de entrada HTML

## Contribuciones

Las contribuciones son bienvenidas. Por favor:
1. Fork el repositorio
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## Licencia

Este proyecto está bajo la Licencia MIT. Ver `LICENSE` para más detalles.

## Contacto

- 📧 Email: contacto@krow.com
- 🌐 Sitio Web: https://krow.com
- 📱 Redes Sociales: [@KrowApp](https://twitter.com/krowapp)

## Roadmap

- [ ] Sistema de recomendaciones basado en IA
- [ ] Videollamadas integradas
- [ ] Certificaciones comunitarias
- [ ] Análisis de tendencias de empleo
- [ ] App móvil (Android/iOS)
- [ ] Integración con LinkedIn

## Agradecimientos

Agradecemos a la comunidad por su feedback y contribuciones continuas.

---

**Última actualización**: Junio 2026
