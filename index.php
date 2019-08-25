<?php include_once 'dbconfig.php' ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css"> 
        <script src="jquery-3.2.1.min.js"></script>
        <script src="site.js" type="text/javascript"></script>
    </head>

    <body>
        <h2>Import CSV file into Mysql using PHP</h2>
        
        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
            <div class="outer-scontainer">
                <div class="row">

                    <form class="form-horizontal" action="" method="post"
                        name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                        <div class="input-row">
                            <label class="col-md-4 control-label">Choose CSV
                                File</label> <input type="file" name="file"
                                id="file" accept=".csv">
                            <button type="submit" id="submit" name="import"
                                class="btn-submit">Import</button>
                            <br />
                        </div>
                    </form>

                </div>

                <?php
                    $sqlSelect = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sqlSelect);
                    
                    if (mysqli_num_rows($result) > 0) {
                ?>

                    <table id='userTable'>
                        <thead>
                            <tr>
                                 <th>UID</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Birthday</th>
                                 <th>Update</th>
                                 <th>Description</th>
                            </tr>
                        </thead>

                <?php
                        
                        while ($row = mysqli_fetch_array($result)) {
                ?>
                            
                        <tbody>
                            <tr>
                                <td><?php  echo $row['uid']; ?></td>
                                <td><?php  echo $row['firstName']; ?></td>
                                <td><?php  echo $row['lastName']; ?></td>
                                <td><?php  echo $row['birthDay']; ?></td>
                                <td><?php  echo $row['dateChange']; ?></td>
                                <td><?php  echo $row['description']; ?></td>
                            </tr>
                <?php
                        }
                ?>
                        </tbody>
                    </table>
                <?php
                    }
                ?>
            </div>

    </body>

</html>