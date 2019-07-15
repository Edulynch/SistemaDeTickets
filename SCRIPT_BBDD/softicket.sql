DROP DATABASE tickets;

CREATE DATABASE tickets;

DROP TABLE tickets.usuarios;

CREATE TABLE tickets.usuarios (
    user_id INT NOT NULL AUTO_INCREMENT,
    user_nombre VARCHAR(50) NOT NULL,
    user_correo VARCHAR(255) NOT NULL,
    user_password VARCHAR(255) NOT NULL,
    user_empresa VARCHAR(50) NOT NULL,
    user_direccion VARCHAR(50) NOT NULL,
    user_telefono VARCHAR(15) NOT NULL,
    user_web_empresa VARCHAR(50) NOT NULL,
    user_cargo VARCHAR(50) NOT NULL,
    user_fecha_creacion date NOT NULL DEFAULT CURRENT_TIMESTAMP,
    priv_id INT NOT NULL,
    PRIMARY KEY (user_id)
);

DROP TABLE tickets.privilegios;

CREATE TABLE tickets.privilegios (
priv_id INT,
priv_titulo VARCHAR(50),
priv_descripcion VARCHAR(50),
PRIMARY KEY (priv_id)
);

INSERT INTO tickets.usuarios (user_id,user_nombre,user_correo,user_password,user_empresa,user_direccion,user_telefono,user_web_empresa,user_cargo,priv_id) 
value (null,"Administrador","admin@admin.com",PASSWORD("123456"),"Eware Consulting","Amunategui 20, Santiago","+56996630457","www.eware.com","Consultor Informático",1);

INSERT INTO tickets.usuarios (user_id,user_nombre,user_correo,user_password,user_empresa,user_direccion,user_telefono,user_web_empresa,user_cargo,priv_id) 
value (null,"Tecnico","tecnico@tecnico.com",PASSWORD("123456"),"Carcom","Quilicura 1234, Santiago","+56912345678","www.carcom.com","Soporte Informático",2);

INSERT INTO tickets.usuarios (user_id,user_nombre,user_correo,user_password,user_empresa,user_direccion,user_telefono,user_web_empresa,user_cargo,priv_id) 
value (null,"Usuario","usuario@usuario.com",PASSWORD("123456"),"Junaeb Consulting","Bandera 2331, Santiago","+56996612547","www.junaeb.com","Administrador DBA",3);

SELECT * FROM tickets.usuarios;

INSERT INTO tickets.privilegios (priv_id,priv_titulo,priv_descripcion)
value (1,"Administrador","Dios de la web"); 

INSERT INTO tickets.privilegios (priv_id,priv_titulo,priv_descripcion)
value (2,"Tecnico","Soporte TI");

INSERT INTO tickets.privilegios (priv_id,priv_titulo,priv_descripcion)
value (3,"Usuario","Usuario");

SELECT * FROM tickets.privilegios;

SELECT 
    user_id,
    user_nombre,
    user_correo,
    user_password,
    user_empresa,
    user_direccion,
    user_telefono,
    user_web_empresa,
    user_cargo,
    p.priv_id,
    priv_titulo,
    priv_descripcion
FROM
    tickets.usuarios u
        INNER JOIN
    tickets.privilegios p ON u.priv_id = p.priv_id;

CREATE TABLE tickets.gruposoporte (
gsoporte_id INT NOT NULL AUTO_INCREMENT,
gsoporte_titulo VARCHAR(50),
gsoporte_descripcion VARCHAR(50),
user_id INT,
PRIMARY KEY (gsoporte_id)
);

DROP TABLE tickets.ticket;

CREATE TABLE tickets.ticket (
  ticket_id INT NOT NULL AUTO_INCREMENT,
  ticket_titulo VARCHAR(100),
  user_id INT,
  gsoporte_id INT,
  ticket_descripcion VARCHAR(255),
  ticket_estado_id INT(1) NOT NULL DEFAULT '1',
  ticket_fecha_creacion datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  ticket_fecha_actualizado datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (ticket_id)
);

DROP TABLE tickets.ticket_estado;

CREATE TABLE tickets.ticket_estado (
ticket_estado_id INT NOT NULL AUTO_INCREMENT,
ticket_estado_titulo VARCHAR(10),
PRIMARY KEY (ticket_estado_id)
);

INSERT INTO tickets.ticket_estado (ticket_estado_id,ticket_estado_titulo)
value (1,"Abierto");
INSERT INTO tickets.ticket_estado (ticket_estado_id,ticket_estado_titulo)
value (2,"Cerrado");

SELECT 
    ticket_titulo,
    ticket_descripcion,
    gsoporte_titulo,
    te.ticket_estado_titulo,
    t.ticket_fecha_creacion,
    t.ticket_fecha_actualizado
FROM
    tickets.ticket t
        INNER JOIN
    tickets.ticket_estado te ON t.ticket_estado_id = te.ticket_estado_id
        INNER JOIN
    tickets.gruposoporte g ON g.gsoporte_id = t.gsoporte_id
WHERE
    ticket_titulo IS NOT NULL;

SELECT * FROM tickets.ticket_estado;

TRUNCATE TABLE tickets.gruposoporte_usuarios;

SELECT * FROM tickets.gruposoporte_usuarios;

CREATE TABLE tickets.gruposoporte_usuarios (
    gsoporte_usuarios_id INT NOT NULL AUTO_INCREMENT,
    gsoporte_id INT,
    user_id INT,
    PRIMARY KEY (gsoporte_usuarios_id)
);

CREATE UNIQUE INDEX idx_gruposoporte_usuarios
ON tickets.gruposoporte_usuarios(gsoporte_id,user_id);

DROP TABLE usuarios_historico;

CREATE TABLE `usuarios_historico` (
	`userhist_id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL,
    `user_nombre` VARCHAR(50) NOT NULL,
    `user_correo` VARCHAR(255) NOT NULL,
    `user_password` VARCHAR(255) NOT NULL,
    `user_empresa` VARCHAR(50) NOT NULL,
    `user_direccion` VARCHAR(50) NOT NULL,
    `user_telefono` VARCHAR(15) NOT NULL,
    `user_web_empresa` VARCHAR(50) NOT NULL,
    `user_cargo` VARCHAR(50) NOT NULL,
    `user_fecha_creacion` DATE NOT NULL,
    `priv_id` INT(11) NOT NULL,
    PRIMARY KEY(userhist_id)
);

CREATE TABLE `ticket_historico` (
  `ticket_id` int(11) NOT NULL,
  `ticket_titulo` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tecnico_id` int(11) DEFAULT NULL,
  `gsoporte_id` int(11) DEFAULT NULL,
  `ticket_descripcion` varchar(255) DEFAULT NULL,
  `ticket_estado_id` int(1) NOT NULL,
  `ticket_fecha_creacion` datetime NOT NULL ,
  `ticket_fecha_actualizado` datetime NOT NULL
);

CREATE TABLE `gruposoporte_historico` (
    `gsoporte_id` INT(11) NOT NULL,
    `gsoporte_titulo` VARCHAR(50) DEFAULT NULL,
    `gsoporte_descripcion` VARCHAR(50) DEFAULT NULL,
    `user_id` INT(11) DEFAULT NULL
);

DROP TABLE auditoria;

CREATE TABLE auditoria (
auditoria_id INT NOT NULL auto_increment,
modificador_id INT,
user_id INT,
ticket_id INT,
gsoporte_id INT,
auditoria_fecha_creacion datetime NOT NULL DEFAULT current_timestamp(),
PRIMARY KEY (auditoria_id)
);

