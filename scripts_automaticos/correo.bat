rem envio de correos de notificacion para bansefi
:LOOP

::pause or sleep x seconds also valid
    php envio_correo.php >>envio.log 2>>envio.err
timeout /T 10 /NOBREAK 
goto :LOOP

