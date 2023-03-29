<?php

require('includes/config.php');
require('Header.php');


function escape_string($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

?>





<body class="log">

        <form action="home.php" method="post" class="formlog">
            <h2 class="h2for">lOGIN</h2>
            <input type="text" name="Username" placeholder="Username" class="infor"><br>

            <input type="Password" name="Pass" placeholder="Password" class="infor"><br>

            <button class="btfor" type="submit" name="send">LOGIN</button>
            
            <?php

              if(isset($_POST['send'])){
    
                $Username=$_POST['Username'];
                $Pass=$_POST['Pass'];
                
                $sql="SELECT * FROM users WHERE Username='$Username'AND Pass='$Pass' limit 1";
                
                $res= mysqli_query($connection, $sql);
                
                $row = mysqli_fetch_array($res);
                if(is_array($row))
                {
                 
                  $_SESSION['Username']=$row['Username'];
                  $_SESSION['Pass']=$row['Pass'];
                   header("location:home.php");
                  

                }
                else{
                  echo '<div id="error">Worng Username Or Password</div>';
                }

                
             
                    
            }
            ?>
        </form>
</body>