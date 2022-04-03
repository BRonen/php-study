<table>
    <thead>
        <th>Username</th>
        <th>Email</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?php
            $users = $DB->getUsers();
            
            if(count($users) == 0){
                echo '<tr><p>NONE USERS IN DATABASE</p></tr>';
            }
            foreach( $users as $k) {
                echo '<tr>
                    <td>' . $k['username'] . '</td>
                    <td>' . $k['email'] . '</td>
                    <td>
                        <a href="/index.php?email='. $k['email'] .'">
                            Delete
                        </a>
                    </td>
                </tr>';
            }
        ?>
    </tbody>
</table>