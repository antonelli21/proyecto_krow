CREATE DATABASE IF NOT EXISTS krow;
USE krow;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM(
        'admin',
        'estudiante',
        'empresa'
    ) NOT NULL,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE carrera (
    id_carrera INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);


CREATE TABLE estudiante (
	id_estudiante INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNIQUE NOT NULL,
    
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    
    dni INT UNSIGNED UNIQUE NOT NULL,
    legajo VARCHAR(20) UNIQUE NOT NULL,
    
	fecha_nacimiento DATE,

    telefono VARCHAR(15),
    
    id_carrera INT NOT NULL,
    
    descripcion TEXT,
    
    modalidad_deseada ENUM(
    	'Full-Time',
        'Part-Time',
        'Hibrido',
        'Remoto'
    ),
    
 	disponibilidad_horaria VARCHAR(100),

    foto_perfil VARCHAR(255),

    cv VARCHAR(255),

    portfolio VARCHAR(255),

    linkedin VARCHAR(255),

    github VARCHAR(255),

    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario),
    
    FOREIGN KEY (id_carrera)
	REFERENCES carrera(id_carrera)
);


CREATE TABLE empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT UNIQUE NOT NULL,

    nombre_empresa VARCHAR(100) NOT NULL,
    razon_social VARCHAR(150) NOT NULL,

    cuit BIGINT UNSIGNED UNIQUE NOT NULL,

    rubro VARCHAR(100) NOT NULL,

    direccion VARCHAR(200),

    telefono VARCHAR(20) NOT NULL,

    email_contacto VARCHAR(100) NOT NULL,

    sitio_web VARCHAR(255),

    descripcion TEXT,

    logo VARCHAR(255),

    representante VARCHAR(100) NOT NULL,

    email_representante VARCHAR(100) NOT NULL,

    tamano_empresa ENUM(
        'Microempresa',
        'Pequena',
        'Mediana',
        'Grande'
    ),

    linkedin VARCHAR(255),
    instagram VARCHAR(255),
    facebook VARCHAR(255),

    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuario)
    REFERENCES usuario(id_usuario)
);


CREATE TABLE oferta (
    id_oferta INT AUTO_INCREMENT PRIMARY KEY,

    id_empresa INT NOT NULL,

    titulo VARCHAR(100) NOT NULL,

    descripcion TEXT NOT NULL,

    requisitos TEXT,

    area varchar(50),

    experiencia_requerida ENUM(
        'Sin Experiencia',
        'Junior',
        'Semi Senior',
        'Senior'
    ) NOT NULL,

    tipo_oferta ENUM(
        'Pasantia',
        'Practica Profesional',
        'Part-Time',
        'Full-Time'
    ) NOT NULL,

    modalidad ENUM(
        'Presencial',
        'Remoto',
        'Hibrido'
    ) NOT NULL,

    salario_min INT UNSIGNED,
	salario_max INT UNSIGNED,
    
    
      id_localidad INT,
    ),

    fecha_publicacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    fecha_cierre DATE,

    estado ENUM(
        'Activa',
        'Pausada',
        'Cerrada'
    ) DEFAULT 'Activa',

    FOREIGN KEY (id_empresa)
    REFERENCES empresa(id_empresa)
    FOREIGN KEY (id_localidad)
    REFERENCES localidad(id_localidad
);


CREATE TABLE oferta_carrera (
    id_oferta INT,
    id_carrera INT,

    PRIMARY KEY(id_oferta, id_carrera),

    FOREIGN KEY (id_oferta)
        REFERENCES oferta(id_oferta),

    FOREIGN KEY (id_carrera)
        REFERENCES carrera(id_carrera)
);


CREATE TABLE postulacion (
    id_postulacion INT AUTO_INCREMENT PRIMARY KEY,

    id_estudiante INT NOT NULL,
    id_oferta INT NOT NULL,

    fecha_postulacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    estado ENUM(
        'Postulado',
        'En Revision',
        'Preseleccionado',
        'En Contacto',
        'Rechazado'
    ) DEFAULT 'Postulado',

    observaciones TEXT,

    UNIQUE(id_estudiante, id_oferta),
    
    FOREIGN KEY (id_estudiante)
        REFERENCES estudiante(id_estudiante),

    FOREIGN KEY (id_oferta)
        REFERENCES oferta(id_oferta)
);

CREATE TABLE chat (
    id_chat INT AUTO_INCREMENT PRIMARY KEY,

    id_usuario_1 INT NOT NULL,
    id_usuario_2 INT NOT NULL,

    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuario_1)
        REFERENCES usuario(id_usuario),

    FOREIGN KEY (id_usuario_2)
        REFERENCES usuario(id_usuario)
);

CREATE TABLE mensaje (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,

    id_chat INT NOT NULL,

    id_remitente INT NOT NULL,

    contenido TEXT NOT NULL,

    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,

    leido BOOLEAN DEFAULT FALSE,

    FOREIGN KEY (id_chat)
        REFERENCES chat(id_chat),

    FOREIGN KEY (id_remitente)
        REFERENCES usuario(id_usuario)
);

CREATE TABLE ticket_soporte (
    id_ticket INT AUTO_INCREMENT PRIMARY KEY,

    id_usuario INT NOT NULL,

    asunto VARCHAR(100) NOT NULL,

    descripcion TEXT NOT NULL,

    estado ENUM(
        'Abierto',
        'En Proceso',
        'Resuelto'
    ) DEFAULT 'Abierto',

    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_usuario)
        REFERENCES usuario(id_usuario)
);

CREATE TABLE habilidad (
    id_habilidad INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE estudiante_habilidad (
    id_estudiante INT,
    id_habilidad INT,

    PRIMARY KEY(id_estudiante,id_habilidad),

    FOREIGN KEY (id_estudiante)
        REFERENCES estudiante(id_estudiante),

    FOREIGN KEY (id_habilidad)
        REFERENCES habilidad(id_habilidad)
);

CREATE TABLE oferta_habilidad (
    id_oferta INT,
    id_habilidad INT,

    PRIMARY KEY(id_oferta,id_habilidad),

    FOREIGN KEY (id_oferta)
        REFERENCES oferta(id_oferta),

    FOREIGN KEY (id_habilidad)
        REFERENCES habilidad(id_habilidad)
);

CREATE TABLE provincia (
    id_provincia INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) UNIQUE NOT NULL
);

CREATE TABLE localidad (
    id_localidad INT AUTO_INCREMENT PRIMARY KEY,

    id_provincia INT NOT NULL,

    nombre VARCHAR(100) NOT NULL,

    FOREIGN KEY (id_provincia)
        REFERENCES provincia(id_provincia)
);

alter table empresa add column id_localidad INT,
    add foreign key (id_localidad) 
    references localidad(id_localidad)
);

alter table empresa add column id_provincia INT,
    add foreign key (id_provincia) 
    references provincia(id_provincia)
);

alter table estudiante add column id_localidad INT,
    add foreign key (id_localidad) 
    references localidad(id_localidad)
);

alter table estudiante add column id_provincia INT,
    add foreign key (id_provincia) 
    references provincia(id_provincia)
);

alter table oferta add column id_provincia INT,
    add foreign key (id_provincia) 
    references provincia(id_provincia)
);

alter table oferta add column id_localidad INT,
    add foreign key (id_localidad) 
    references localidad(id_localidad)
);

commit;