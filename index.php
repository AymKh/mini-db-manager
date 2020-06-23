<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="AymKh">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DB VIEWER</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <div id="left">
            <h1>Database Viewer</h1>
            <p>This tool was coded by <a href="https://github.com/aymkh/" target="_blank">AymKh</a> to monitor and manage an sql DB hosted on <a href="https://www.clever-cloud.com/en/" target="_blank">Clever Cloud</a></p>
            <p>This tool has been deployed to <a href="https://www.heroku.com/" target="_blank">Heroku</a>.</p>
            <p>Please keep in mind this is an open source tool, so feel free to fork the code on github</p>

            <form action="index.php" method="POST">
                <input type="text" name="id-input" placeholder="ID">
                <div id="buttons">
                    <input type="submit" value="Refresh DB" name="refresh-button">
                    <input type="submit" value="Empty DB" name="empty-button">
                    <input type="submit" value="Delete ID" name="delete-button">
                </div>
            </form>
        </div>
        <div id="right">
            <?php
            
                include('inc/connection.inc.php');
            
                
                if (isset($_POST['empty-button'])){
                    $emptyTable = " DELETE FROM `people` WHERE 1";
                    $db->query($emptyTable);
                }
                if (isset($_POST['delete-button'])){
                    $id = $_POST['id-input'];
                    $deleteID = " DELETE FROM `people` WHERE `id` = $id ";
                    $db->query($deleteID);
                }

                if (isset($_POST['refresh-button'])){
                    $updateQuery = "SELECT * FROM `people`";
                    $execUpdate = $db->query($updateQuery);
                    echo "<table>
                            <tr>
                                <td class='title'>ID</td>
                                <td class='title'>Name</td>
                            </tr>";
                    while( $data = $execUpdate->fetch() ){
                        echo "<tr><td>".$data['id']."</td><td>".$data['naame']."</td></tr>";
                    }
                    echo "</table>";
                }

            ?>
            
        </div>
    </main>
</body>
</html>