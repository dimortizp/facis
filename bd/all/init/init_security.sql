--CREANDO ROLES

DROP ROLE administrador;
DROP ROLE socio;
DROP ROLE cajero;

CREATE ROLE administrador;
CREATE ROLE socio;
CREATE ROLE cajero;

--ANIADIENDO PRIVILEGIOS A LOS ROLES SOBRE TABLAS

GRANT CONNECT TO administrador;
GRANT SELECT ON TIPO_CREDITO TO administrador;
GRANT SELECT,UPDATE,INSERT ON SOCIO TO administrador;
GRANT SELECT,UPDATE,INSERT ON CREDITO TO administrador;
GRANT SELECT ON RENDIMIENTO TO administrador;
GRANT SELECT ON PLANPAGOS TO administrador;
GRANT SELECT,INSERT ON PAGO TO administrador;
GRANT SELECT ON GANANCIA TO administrador;
GRANT SELECT ON GANANCIARENDIMIENTO TO administrador;
GRANT SELECT,INSERT ON FORMAPAGO TO administrador;
GRANT SELECT,INSERT ON DESCRIPCIONAPORTE TO administrador;
GRANT SELECT,INSERT ON DESCRIPCION_TIPO_CREDITO TO administrador;
GRANT SELECT,INSERT,UPDATE ON CUENTA TO administrador;
GRANT SELECT,INSERT ON APORTE TO administrador;
GRANT EXECUTE ON pk_creditos TO administrador;
GRANT EXECUTE ON pk_aportes TO administrador;
GRANT EXECUTE ON pk_rendimientos TO administrador;

GRANT CONNECT TO socio;
GRANT SELECT ON TIPO_CREDITO TO socio;
GRANT SELECT,UPDATE ON SOCIO TO socio;
GRANT SELECT ON CREDITO TO socio;
GRANT SELECT ON PLANPAGOS TO socio;
GRANT SELECT ON PAGO TO socio;
GRANT SELECT ON GANANCIA TO socio;
GRANT SELECT ON GANANCIARENDIMIENTO TO socio;
GRANT SELECT ON FORMAPAGO TO socio;
GRANT SELECT ON DESCRIPCIONAPORTE TO socio;
GRANT SELECT ON DESCRIPCION_TIPO_CREDITO TO socio;
GRANT SELECT ON APORTE TO socio;

GRANT CONNECT TO cajero;
GRANT SELECT ON TIPO_CREDITO TO cajero;
GRANT SELECT ON SOCIO TO cajero;
GRANT SELECT,UPDATE,INSERT ON CREDITO TO cajero;
GRANT SELECT ON PLANPAGOS TO cajero;
GRANT SELECT,INSERT ON PAGO TO cajero;
GRANT SELECT ON GANANCIA TO cajero;
GRANT SELECT ON GANANCIARENDIMIENTO TO cajero;
GRANT SELECT ON FORMAPAGO TO cajero;
GRANT SELECT,INSERT ON DESCRIPCIONAPORTE TO cajero;
GRANT SELECT,INSERT ON DESCRIPCION_TIPO_CREDITO TO cajero;
GRANT SELECT ON CUENTA TO cajero;
GRANT SELECT,INSERT ON APORTE TO cajero;

GRANT SELECT ON seq_credito TO administrador;
GRANT SELECT ON seq_ganancia TO administrador;
GRANT SELECT ON seq_formapago TO administrador;
GRANT SELECT ON seq_tipo_credito TO administrador;
GRANT SELECT ON seq_descripcion_tipo_credito TO administrador;
GRANT SELECT ON seq_descripcion_aporte TO administrador;
GRANT SELECT ON seq_rendimiento TO administrador;
GRANT SELECT ON seq_planpagos TO administrador;

GRANT execute ON pk_creditos TO cajero;
GRANT execute ON pk_creditos TO administrador;

--PAQUETE DE RENDIMIENTOS

GRANT execute ON pk_rendimientos TO administrador;

GRANT SELECT ON seq_credito TO cajero;
GRANT SELECT ON seq_ganancia TO cajero;
GRANT SELECT ON seq_formapago TO cajero;
GRANT SELECT ON seq_tipo_credito TO cajero;
GRANT SELECT ON seq_descripcion_tipo_credito TO cajero;
GRANT SELECT ON seq_descripcion_aporte TO cajero;
GRANT SELECT ON seq_rendimiento TO cajero;
GRANT execute ON pk_creditos TO cajero;
GRANT execute ON pk_creditos TO administrador;

--PAQUETE DE RENDIMIENTOS

GRANT execute ON pk_rendimientos TO administrador;

GRANT SELECT ON seq_planpagos TO cajero;
--CREANDO USUARIOS

DROP USER admin1;
DROP USER admin2;
DROP USER caj1;

CREATE USER admin1 IDENTIFIED BY admin1 
DEFAULT TABLESPACE facis
TEMPORARY TABLESPACE tempfacis
QUOTA UNLIMITED ON facis;

CREATE USER admin2 IDENTIFIED BY admin2
DEFAULT TABLESPACE facis
TEMPORARY TABLESPACE tempfacis
QUOTA UNLIMITED ON facis;

CREATE USER caj1 IDENTIFIED BY caj1
DEFAULT TABLESPACE facis
TEMPORARY TABLESPACE tempfacis
QUOTA UNLIMITED ON facis;

--ADICIONANDO ROLES A USUARIOS

GRANT administrador to admin1;
GRANT administrador to admin2;
GRANT cajero to caj1;

--CONCEDIENTO PERMISOS A admin1, admin2 Y facis SOBRE EL DIRECTORIO
--DE ESTADOS DE CUENTA

GRANT read, write ON DIRECTORY dir_estados_cuenta TO admin1;
GRANT read, write ON DIRECTORY dir_estados_cuenta TO admin2;
GRANT read, write ON DIRECTORY dir_estados_cuenta TO facis;