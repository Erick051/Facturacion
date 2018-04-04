<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Configuracion del portal
|--------------------------------------------------------------------------
|
| Constantes para identificar el tipo de configuracion de portal que se tiene
|
*/
// 1 autofactura, 2 boveda, 3 portal contadores, 4 Clientes
defined('TIPO_PORTAL_PSS') OR define('TIPO_PORTAL_PSS', "1");
defined('TIPO_PORTAL_BOVEDA') OR define('TIPO_PORTAL_BOVEDA', "2");
defined('TIPO_PORTAL_CONTADORES') OR define('TIPO_PORTAL_CONTADORES', "3");
defined('TIPO_PORTAL_CLIENTES') OR define('TIPO_PORTAL_CLIENTES', "4");
defined('TIPO_PORTAL') OR define('TIPO_PORTAL', TIPO_PORTAL_PSS); //
// tasa maxima de envio por email | tamano maximo de paquete enviado
defined('PSS_TASA_MAXIMA_ENVIO_EMAIL') OR define('PSS_TASA_MAXIMA_ENVIO_EMAIL', 5); //

/*
|--------------------------------------------------------------------------
| Configuracion de la forma de inicio de sesion
|--------------------------------------------------------------------------
|
| Constantes para identificar el tipo de configuracion de portal que se tiene
|
*/
// 1 autofactura, 2 boveda, 3 portal contadores
defined('CONTROL_ACCESO_LOGIN_CONTRASENA') OR define('CONTROL_ACCESO_LOGIN_CONTRASENA', "1");
defined('CONTROL_ACCESO_CORREO_CONTRASENA') OR define('CONTROL_ACCESO_CORREO_CONTRASENA', "2");
defined('CONTROL_ACCESO_SOLO_LOGIN') OR define('CONTROL_ACCESO_SOLO_LOGIN', "3");
defined('CONTROL_ACCESO_SOLO_LOGIN_RFC') OR define('CONTROL_ACCESO_SOLO_LOGIN_RFC', "4");


/*
|--------------------------------------------------------------------------
| Perfiles del portal
|--------------------------------------------------------------------------
|
| Constantes para identificar el tipo de configuracion de portal que se tiene
|
*/
// 1 administrador STO, 2 Administrador portal,  3 Operador portal,  4 Cliente
defined('PERFIL_USUARIO_ADMON_STO') OR define('PERFIL_USUARIO_ADMON_STO', "1");
defined('PERFIL_USUARIO_ADMON_PORTAL') OR define('PERFIL_USUARIO_ADMON_PORTAL', "2");
defined('PERFIL_USUARIO_OPERADOR') OR define('PERFIL_USUARIO_OPERADOR', "3");
defined('PERFIL_USUARIO_CLIENTE') OR define('PERFIL_USUARIO_CLIENTE', "4");

/*
|--------------------------------------------------------------------------
| STOFactura generales
|--------------------------------------------------------------------------
|
| URLs de navegacion interna de STOFactura
|
*/
defined('URL_CERRAR_SESION') OR define('URL_CERRAR_SESION', "cerrar_sesion");
defined('URL_RECUPERAR_CONTRASENA') OR define('URL_RECUPERAR_CONTRASENA', "login/recuperar_contrasena");
defined('URL_CAMBIAR_MI_CONTRASENA') OR define('URL_CAMBIAR_MI_CONTRASENA', "usuarios/cambiar_contrasena_usuario");
defined('URL_CUENTA_BLOQUEADA') OR define('URL_CUENTA_BLOQUEADA', "cuenta_bloqueada");
defined('URL_PANTALLA_PRINCIPAL') OR define('URL_PANTALLA_PRINCIPAL', "principal_ss");
defined('URL_MIS_COMPROBANTES_PSS') OR define('URL_MIS_COMPROBANTES_PSS', "mis_comprobantes_pss");
defined('URL_MIS_COMPROBANTES_BOVEDA') OR define('URL_MIS_COMPROBANTES_BOVEDA', "mis_comprobantes_boveda");
defined('URL_MIS_TRANSACCIONES') OR define('URL_MIS_TRANSACCIONES', "mis_transacciones");
defined('URL_CONSULTA_COMPROBANTES') OR define('URL_CONSULTA_COMPROBANTES', "consulta_comprobantes");
defined('URL_CONSULTA_REPORTES') OR define('URL_CONSULTA_REPORTES', "consulta_comprobantes/descargar_reportes");
defined('URL_MI_PERFIL') OR define('URL_MI_PERFIL', "mi_perfil");
defined('URL_BITACORA') OR define('URL_BITACORA', "bitacora");
defined('URL_SERVICIOS') OR define('URL_SERVICIOS', "servicios");
defined('URL_COMPROBANTES') OR define('URL_COMPROBANTES', "comprobantes");
defined('URL_CORREO') OR define('URL_CORREO', "correo");
defined('URL_USUARIOS') OR define('URL_USUARIOS', "usuarios");
defined('URL_FACTURAR') OR define('URL_FACTURAR', "facturar");

/*
|--------------------------------------------------------------------------
| CONSTANTES PARA DEFINICION DE ACCIONES QUE SE REGISTRAN EN BITACORA
|--------------------------------------------------------------------------
| Estas constantes son fijas y estan declaradas en la tabla c_acciones_bitacora
|
*/
defined('INICIO_DE_SESION')                         OR define ('INICIO_DE_SESION', 1);
defined('CIERRE_DE_SESION')                         OR define ('CIERRE_DE_SESION', 2);
defined('CAMBIO_DE_CONTRASENA')                     OR define ('CAMBIO_DE_CONTRASENA', 3);
defined('CONSULTA_DE_PERFIL')                       OR define ('CONSULTA_DE_PERFIL', 4);
defined('ACTUALIZACION_DE_DATOS_DE_PERFIL')         OR define ('ACTUALIZACION_DE_DATOS_DE_PERFIL', 5);
defined('CONSULTA_DE_DOCUMENTOS')                   OR define ('CONSULTA_DE_DOCUMENTOS', 6);
defined('DESCARGA_DE_XML')                          OR define ('DESCARGA_DE_XML', 7);
defined('DESCARGA_DE_PDF')                          OR define ('DESCARGA_DE_PDF', 8);
defined('EXTRACCION_DE_REPORTE')                    OR define ('EXTRACCION_DE_REPORTE', 9);
defined('ALTA_DE_USUARIO')                          OR define ('ALTA_DE_USUARIO',10);
defined('CAMBIO_DE_USUARIO')                        OR define ('CAMBIO_DE_USUARIO',11);
defined('DESBLOQUEO_DE_USUARIO')                    OR define ('DESBLOQUEO_DE_USUARIO',12);
defined('CAMBIO_DE_CONTRASENA_DE_USUARIO')          OR define ('CAMBIO_DE_CONTRASENA_DE_USUARIO',13);
defined('INICIA_RECUPERACION_DE_CONTRASENA')        OR define ('INICIA_RECUPERACION_DE_CONTRASENA',14);
defined('ERROR_EN_RECUPERACION_DE_CONTRASENA')      OR define ('ERROR_EN_RECUPERACION_DE_CONTRASENA',15);
defined('RECUPERACION_DE_CONTRASENA_EXITOSO')       OR define ('RECUPERACION_DE_CONTRASENA_EXITOSO',16);
defined('BLOQUEO_DE_USUARIO')                       OR define ('BLOQUEO_DE_USUARIO',17);
defined('CAMBIO_DE_CONTRASENA_DE_USUARIO_EXITOSO')  OR define ('CAMBIO_DE_CONTRASENA_DE_USUARIO_EXITOSO',18);
defined('CAMBIO_DE_CONTRASENA_DE_USUARIO_ERROR')    OR define ('CAMBIO_DE_CONTRASENA_DE_USUARIO_ERROR',19);
defined('CONSULTAR_MIS_COMPROBANTES')               OR define ('CONSULTAR_MIS_COMPROBANTES',20);
defined('INICIO_DE_SESION_BLOQUEADO')               OR define ('INICIO_DE_SESION_BLOQUEADO',21);
defined('INICIO_DE_SESION_CONTRASENA_ERRONEA')      OR define ('INICIO_DE_SESION_CONTRASENA_ERRONEA',22);
defined('EJECUCION_BITACORA')                       OR define ('EJECUCION_BITACORA',23);
defined('CONSULTA_BITACORA')                        OR define ('CONSULTA_BITACORA',24);
defined('REPORTE_BITACORA')                         OR define ('REPORTE_BITACORA',25);



/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
