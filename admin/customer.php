<?php
include_once('headerpage_admin.php');
include_once('utils.php');
include('connect.php');
?>

<?php $mysqlCon = new Connection(); ?> 
<?php if(!isset($_POST['submit'])) 
{ 
    //hide image 
   // alert('hiding image');
   // hide();
} 
?> 
<?php
   /* if(isset($_POST['submit']))
    {
        //get the posted data
        $custId = substr($_POST['first-name'], 0, 1) . substr($_POST['sur-name'], 0, 1).rand(10, 100000);
    //    alert($custId);
        $firstName = $_POST['first-name'];
        $surName = $_POST['sur-name'];
        $mobileNo = $_POST['mobile-no'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $occupation = $_POST['occupation'];
        $address = $_POST['address'];
        
        
       // alert('Showing image');
       
        //get the picture file details
        $filename = $_FILES['customer-pic']['name'];
        $filesize = $_FILES['customer-pic']['size'];
        $fileType = $_FILES['customer-pic']['type'];
       // $image = fopen($_FILES['customer-pic']['tmp_name'], 'rb');
        //print_r($image);
         //check for the accepted file extension
         $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
        // alert($fileExtension);
        /// if($fileType == 'jpg' || $fileType == 'png' )
        // {
            //store file in Dbe database
            
           // print_r($mysqlCon);
            $mysqlcon = new Connection();
	        $query_str = 'insert into customers(custId, firstName,surName, email, mobileNo, countryName, residentAddr, occupation)'. 
                         ' values(?, ?, ?, ?, ?, ?, ?, ?)';
            //alert($query_str);
            $stmt_insert = $mysqlcon->mysql->prepare($query_str);
            //print_r($stmt_insert);
            if(!$stmt_insert)
            {
            alert($mysqlcon->mysql->error);
          //  print_r($stmt_insert);
          }
          else{
            $stmt_insert->bind_param('ssssssss', $custId, $firstName, $surName, $email, $mobileNo, $country, $address, $occupation);
            $stmt_insert->execute();
           // print_r($query_status);
            if($stmt_insert->affected_rows > 0) 
            {
                alert('Customer Data inserted '.$stmt_insert->affected_rows.' rows inserted');
            }
          }
            
       //  }
        
        //save the infomation to the database
        
        
        //build the insertstring
        //INSERT INTO `cms`.`pics` (`custId`, `picId`, `fileSize`, `fileType`, `image`) VALUES ('PK0987', NULL, '45589', 'jpg',
        $pic_insert_str = 'insert into pics(custId, fileName, fileSize, fileType, image) values(?,?,?,?,?)';
        $stmt_insert_pic = $mysqlcon->mysql->prepare($pic_insert_str);
        //check if the prepared statement failed
        if(!$stmt_insert_pic)
        {
            alert($mysqlcon->mysql->error);
        }
        else{
            $image = null;
            $stmt_insert_pic->bind_param('ssisb',$custId,$filename, $filesize, $fileType, $image);
            $stmt_insert_pic->send_long_data(4, file_get_contents($_FILES['customer-pic']['tmp_name']));
            $stmt_insert_pic->execute();
            if($stmt_insert_pic->affected_rows > 0) 
            {
                alert('Pic Data saved '.$stmt_insert_pic->affected_rows.' rows inserted');
                alert($_FILES['customer-pic']['tmp_name'].'  ../scandocs/'.$filename);
                move_uploaded_file($_FILES['customer-pic']['tmp_name'], '../scandocs/'.$filename);
   header('Location:http://localhost/admin/commercialInvoice.php');

            }
        }
        
        

          
        //show the picture  
       // slideDown('../scandocs/'.$filename); //--'../scandocs/beauty.jpg'
        //insert the picture into the database
        
    }*/
header('Location:http://localhost/admin/commercialInvoice.php');
 ?>


<div id="main-content" style="width: 1000px; text-align: left;"> 
<div id="left-div" style="float: left; width: 50%;"> 
<form name="submitForm" enctype="multipart/form-data" id="submitForm" action="" method="post"> 
<table> 
<tr> 
<th> 
<h3>Customer Registration form</h3> </th> 
</tr> 
<tr> 
<td><input type="hidden" name="custId" id="custId"/>
</td> 
</tr> 
<tr> 
<td><b>First Name</b></td> 
<td><input type="text" name="first-name" id="first-name"/></td> 
</tr> 
<tr> 
<td><b>Sur Name</b></td> 
<td><input type="text" name="sur-name" id="sur-name"/></td> 
</tr> 
<tr> <td><b>Mobile No</b></td> 
<td><input type="text" name="mobile-no" id="mobile-no"/>
</td> 
</tr> 
<tr> 
<td><b>Email</b></td> 
<td><input type="text" name="email" id="email"/></td> 
</tr> 
<tr> <td><b>Country</b></td> <td> 
<select name="country" id="country"> 
<?php 
    $query_str = 'select countryName from country'; 
    $stmt = $mysqlCon->mysql->query($query_str);
    
    while($result = $stmt->fetch_assoc())
    {
        echo '<option value="'.$result['countryName'].'">'.$result['countryName'].'</option>';
    }
    

?> 
</select> 
</td> 
</tr> 
<tr> 
<td><b>Occupation</b></td> 
<td><input type="text" name="occupation" id="occupation"/></td> 
</tr> 
<tr> <td><b>Address</b></td> 
<td><textarea name="address" id="address"></textarea>
</td> 
</tr> 
<tr>
<td><b>Upload Pic</b></td>
<td><input type="file" name="customer-pic-file" id="customer-pic-file"/></td>
</tr>
</table> 
<?php include_once('buttons.php'); ?>
</form> 
</div> 
<div id="right-div" style="float: right; width: 45%;">
<img src="../images/tn_no-image.jpg" name="customer-pic" id="customer-pic" alt="" width="300px" height="300px"/>
</div>
</div><!--main-div-->
<script src="../js/upload.js"></script>
<script type="text/javascript">

//moveImage();
</script>
<?php include_once('../home/footerpage.php') ?>