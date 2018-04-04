<table border="1">
        <thead>
                <tr>
                        <th>Login</th>
                        <th>User name</th>
                        <th>Email</th>
                </tr>
        </thead>
        <tbody>
                <?php foreach($usuarios as $usuario) : ?>
                <tr>
                        <td><?php echo $usuario->username; ?></td>
                        <td><?php echo $usuario->name; ?></td>
                        <td><?php echo $usuario->email; ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
</table>