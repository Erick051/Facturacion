<html>
<body>
<table border="1">
        <thead>
                <tr>
                        <th>ID</th>
                        <th>No enciptado</th>
                        <th>Encriptado</th>
                </tr>
        </thead>
        <tbody>
                <?php foreach($encriptados as $encriptado) { ?>
                <tr>
                        <td><?php echo $encriptado->id_encriptado; ?></td>
                        <td><?php echo $encriptado->campo_no_encriptado; ?></td>
                        <td><?php echo $encriptado->campo_encriptado; ?></td>
                </tr>
                <?php } ?>
        </tbody>
</table>
</body>
</html>