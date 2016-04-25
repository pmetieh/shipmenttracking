<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 10/3/2014
 * Time: 8:46 AM
 */

include_once('connect.php');
include_once('utils.php');

$con = new Connection();
?>

<?php
if(isset($_POST['submit']))
{

    $passwd = $_POST['password'];
    $username = $_POST['userName'];
    headers_sent();
    $query = 'select username, password from users where password='.'"'.$passwd.'"'.' and '.
        'username='.'"'.$username.'"';


    $result = $con->mysql->query($query);
    if($result->num_rows == 1)
    {

        header("Location:http://www.cengovarsec.org/admin/index.php?userId=".$username);
    }

    else{
        alert('Login Failed');
    }


}
?>

    <style>
        body{
            background: navy;
        }
        img{
            margin-left: 150px;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        #main_div{
            margin-left: 210px;
            position: absolute;
            top: 200px;
            left: 250px;
            height: 220px;

            background-color: white;
        }
    </style>
    <div id="main_div">
        <div id="container" style="border: thin darkslateblue ridge; height: 100%; width: 100%;">
            <img src="../images/CFGRS.png" height="75px" width="75px">
            <form name="loginForm" id="loginForm" method="post" action="">
                <table>
                    <tr>
                        <td><b>User Name</b></td>
                        <td><input type="text" name="userName" id="userName"/> </td>
                    </tr>
                    <tr>
                        <td><b>Password</b></td>
                        <td><input type="password" name="password" id="password"/> </td>
                    </tr>
                    <!-- <tr>
                         <td><b>User Type</b></td>
                         <td>
                             <select name="userType" id="userType">
                                 <option value="Admin">Admin</option>
                                 <option value="HROp">HROp</option>
                                 <option value="Staff">Staff</option>
                             </select>
                         </td>
                     </tr>
                 <!--<tr>
                         <td><b></b></td>
                         <td><input type="text" name="" id=""/> </td>
                     </tr>
                     <tr>
                         <td><b></b></td>
                         <td><input type="text" name="" id=""/> </td>
                     </tr>
                     <tr>
                         <td><b></b></td>
                         <td><input type="text" name="" id=""/> </td>
                     </tr>
                     <tr>
                         <td><b></b></td>
                         <td><input type="text" name="" id=""/> </td>
                     </tr>-->
                </table>
                <br/>
                <?php
                include_once('buttons.php');
                ?>
            </form>
        </div>
        <script type="application/javascript">
            $(function(){
                alert('jQuery');
                $('#submit').click(function(){
                    var username = $('#userName').val();
                    var passwd = $('#password').val();

                    alert('username '+username + '\n' + 'password '+passwd);

                    if(username === 'admin' && passwd === 'password1234_')
                    {
                        window.location.replace("http://localhost/wacaflibinc/admin/commercialInvoice.php?custId="+username);
                        alert('Submiting data ...');
                    }




                    return false;
                })
            })
        </script>
    </div>

<?php
//  include_once('../admin/footerpage_admin.php');
?>