--CREANDO SINONIMOS DE TABLAS

DROP PUBLIC SYNONYM SOCIO;
DROP PUBLIC SYNONYM TIPO_CREDITO;
DROP PUBLIC SYNONYM RENDIMIENTO;
DROP PUBLIC SYNONYM PLANPAGOS;
DROP PUBLIC SYNONYM PAGO;
DROP PUBLIC SYNONYM GANANCIARENDIMIENTO;
DROP PUBLIC SYNONYM GANANCIA;
DROP PUBLIC SYNONYM FORMAPAGO;
DROP PUBLIC SYNONYM DESCRIPCIONAPORTE;
DROP PUBLIC SYNONYM DESCRIPCION_TIPO_CREDITO;
DROP PUBLIC SYNONYM CUENTA;
DROP PUBLIC SYNONYM CREDITO;
DROP PUBLIC SYNONYM APORTE;

CREATE PUBLIC SYNONYM SOCIO FOR FACIS.SOCIO;
CREATE PUBLIC SYNONYM TIPO_CREDITO FOR FACIS.TIPO_CREDITO;
CREATE PUBLIC SYNONYM RENDIMIENTO FOR FACIS.RENDIMIENTO;
CREATE PUBLIC SYNONYM PLANPAGOS FOR FACIS.PLANPAGOS;
CREATE PUBLIC SYNONYM PAGO FOR FACIS.PAGO;
CREATE PUBLIC SYNONYM GANANCIARENDIMIENTO FOR FACIS.GANANCIARENDIMIENTO;
CREATE PUBLIC SYNONYM GANANCIA FOR FACIS.GANANCIA;
CREATE PUBLIC SYNONYM FORMAPAGO FOR FACIS.FORMAPAGO;
CREATE PUBLIC SYNONYM DESCRIPCIONAPORTE FOR FACIS.DESCRIPCIONAPORTE;
CREATE PUBLIC SYNONYM DESCRIPCION_TIPO_CREDITO FOR FACIS.DESCRIPCION_TIPO_CREDITO;
CREATE PUBLIC SYNONYM CUENTA FOR FACIS.CUENTA;
CREATE PUBLIC SYNONYM CREDITO FOR FACIS.CREDITO;
CREATE PUBLIC SYNONYM APORTE FOR FACIS.APORTE;

--CREANDO SINONIMOS DE PAQUETES

DROP PUBLIC SYNONYM pk_rendimientos;
DROP PUBLIC SYNONYM pk_aportes;
DROP PUBLIC SYNONYM pk_creditos;
DROP PUBLIC SYNONYM pk_socios;

CREATE PUBLIC SYNONYM pk_rendimientos FOR facis.pk_rendimientos;
CREATE PUBLIC SYNONYM pk_aportes FOR facis.pk_aportes;
CREATE PUBLIC SYNONYM pk_creditos FOR facis.pk_creditos;
CREATE PUBLIC SYNONYM pk_socios FOR facis.pk_socios;