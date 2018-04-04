while :
do
  php envio_correo.php >correo.log 2>correo.err
  sleep 30
done
