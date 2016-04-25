<!--include a reference to the jQuery Library-->
<script type="text/javascript" src="../jQuery/jquery-1.11.0.js"></script>
    <style>
        span{
            display: none;
        }
    </style>
<?php

//session_start();
$_SESSION['appraisalId'] = session_id();
//alert('Appraisal Id '.$_SESSION['appraisalId']);
function alertphp($message)
    {
        echo '<script type="text/javascript" >';
        echo 'alert('.'\''. $message.'\''.');';
       // echo 'alert('.'\'' .  'Location: '. $_POST['location'].'\''.')';
        echo '</script>';
    }

function alert($message)
    {
        echo '<script type="text/javascript" >';
        echo 'alert('.'\''. $message.'\''.');';
        // echo 'alert('.'\'' .  'Location: '. $_POST['location'].'\''.')';
        echo '</script>';
    }

function show($picurl){
        
        echo '<script type="text/javascript">';
        echo 'alert("showing image");';
        echo '$(function(){';
        echo '$("#image")';
        echo '.attr("src", "'.$picurl.'").show()';
        echo '});';
        echo '</script>';
    }
    
function slideDown($picurl){
        
        echo '<script type="text/javascript">';
        echo 'alert("showing image");';
        echo '$(function(){';
        echo '$("#image")';
        echo '.attr("src", "'.$picurl.'").slideDown("slow")';
        echo '});';
        echo '</script>';
    }
    
function hide(){
        
          //    css('display', 'none')
  //  echo '<img id="image" src="../images/tn_no-image.jpg" width="150px" height="150px"/>';

     echo '<script type="text/javascript">';
     echo   'alert("hiding image");'; 
     echo '$(function(){';
     echo   '$("#image").hide();';
     echo '})';
     echo '</script>';
    }

function getSanitationStatus(Array $selectedValues){
    $status="";
    foreach($selectedValues as $value)
    {

        $status.=$value."_";

        echo $value. '<br/>';
    }
    $status = substr($status, 0, (strlen($status) - 1));
    echo $status;
    return $status;
}

function extractAddressDetails($address)
{
    $components = explode("-", $address);
    // var_dump($components);
    return $components;
}


function get_zone_name($zonecode, $countycode)
{
    $con = new Connection();

    $qry = 'select zonename from zones where zonecode='.'"'.$zonecode.'"'.' and countycode='.'"'.$countycode.'"';
    $stmt = $con->mysql->query($qry);
    $result = $stmt->fetch_assoc();
    //echo '<br/>';//'<b>Zone Name</b>'.
    //var_dump($result);
    return $result['zonename'];
}

function get_county_name($countycode)
{
    $con = new Connection();

    $qry = 'select countyname from county where countycode='.'"'.$countycode.'"';
    $stmt = $con->mysql->query($qry);
    $result = $stmt->fetch_assoc();
   // echo '<br/>';//'<b>County name</b> '.
    //var_dump($result);
    return $result['countyname'];
}

function get_community_name($zonecode, $commcode, $countycode)
{
    $con = new Connection();

    $qry = 'select commname from communities where commcode='.'"'.$commcode.'"'.' and countycode='.'"'.$countycode.'"'.
        ' and zonecode='.'"'.$zonecode.'"';
    $stmt = $con->mysql->query($qry);
    $result = $stmt->fetch_assoc();
   // echo '<br/>';//'<b>Community Name</b>'.
   // var_dump($result);
    return $result['commname'];
}

function get_volunteer($volunteerId)
{
    $con = new Connection();
    $qry = 'select fName, oName, sName,  houseAddress, volunteerType, mobileNo from volunteers where volunteerId='.'"'.$volunteerId.'"';
    $stmt = $con->mysql->query($qry);
    $result = $stmt->fetch_assoc();
   // echo '<b>Volunteer Details</b>'.'<br/>';
   // var_dump($result);
   // return $result[''];

   // print_r(extractAddressDetails($result['houseAddress']));
    $addressparts = extractAddressDetails($result['houseAddress']);
    //format the address
    //Volunteer Full Name
   // echo '<br/>';
  //  echo '<br/>';
    echo '<b>'.$result['fName'].' '.$result['oName'].' '.$result['sName'].'<br/>'.'</b>';
    echo $result['houseAddress'].'<br/>';
    //community name extracted from the house address
    $county = $addressparts[0];
    $zone = substr($addressparts[1], 0, 2);
    $community = substr($addressparts[1], 2, 2);
   // echo '<br/>';
   // echo 'community code'.$community;
   // echo '<br/>';
    $block = $addressparts[2];
   // echo '<br/>';
   // var_dump($addressparts);

    $zipCode = '1'.$county.$zone.'-'.$community; //$addressparts[3];//;$_POST['houseNo'];
    echo get_community_name($zone, $community,$county).'<br/>';
    echo get_zone_name((int)$zone, $county).'<br/>';
    echo get_county_name($county).' Co Liberia'.'  '.$zipCode.'<br/><br/>';
    echo '<span id='.'"role"'.' >'.'Role : '.'<b>'.$result['volunteerType'].'</b>'.'</span>';
    echo '<br/>';
    echo '<span id='.'"mobile"'.' >'.'Mobile : '.'<b>'.$result['mobileNo'].'</b>'.'</span>';
}

function get_employee($empId)
{
    $con = new Connection();
    $qry = 'select * from employees where employeeId='.'"'.$empId.'"';
    $stmt = $con->mysql->query($qry);
    $result = $stmt->fetch_assoc();
    // echo '<b>Volunteer Details</b>'.'<br/>';
     //var_dump($result);
     return $result;
}

function delete_employee($empId)
{
    //get the employee name
    $conn = new Connection();
    $qry = 'select firstName, otherName, surName from employees where employeeId='.'"'.$empId.'"';
    $stmt = $conn->mysql->query($qry);
    $result = $stmt->fetch_assoc();


    alert('About to delete '.$result['firstName'].' '.$result['otherName'].' '.$result['surName']);
    //delete the employee

    $con = new Connection();
    $qry = 'delete from employees where employeeId='.'"'.$empId.'"';
    alert($qry);
    $stmt_delete = $con->mysql->query($qry);
   // $result1 = $stmt_delete->fetch_assoc();
    if($con->mysql->affected_rows > 0)
    {
        alert('Employee successfully deleted');
    }
    else{
        alert('Delete failed!!');
        echo $con->mysql->error;
    }
}

function update_employee()
{

    alert('About to update employee with Id '.$_POST['employeeId']);
    /////////POST Data/////////////////
    $empId = $_POST['employeeId'];//'empId'.rand(100, 100000);//'empId00002';//$_POST['team-no'];
   // alert('empid to update '.$empId);
    // $reportNo = $_POST['report-no'];
    $firstName = $_POST['fName'];
    $otherName = $_POST['oName'];
    $surName = $_POST['sName'];
    $gender = $_POST['gender'];
    $mobileNo1 = $_POST['mobileNo1'];
    $email = $_POST['email'];
    // $gpseutm = $_POST['gps-eutm'];
    // $gpsnutm = $_POST['gps-nutm'];


    $mobileNo2 = $_POST['mobileNo2'];
    $hireDate = $_POST['hireDate'];
    $salary = $_POST['salary'];
    $jobId = $_POST['jobId'];
    $departmentId = $_POST['departmentId'];
    $managerId = $_POST['managerId'];
    // alert('Manager Id '.$managerId);

    $placeOfBirth = $_POST['placeOfBirth'];
    $dateOfBirth = date($_POST['dateOfBirth']);//date(mktime(0,0,0,5,3,1969));//date('l');//$_POST['dateOfBirth'];
    alert($dateOfBirth);
    $city = $_POST['city'];
    //  $state_province = $_POST['state_province'];
    $street1 = $_POST['street1'];
    $street2 = $_POST['street2'];
    $houseNo = $_POST['houseNo'];
    $country = $_POST['country'];
    $socialMediaId = $_POST['socialMediaId'];

    /////////POST DATA////////////////

    $con = new Connection();
    $qryEmpUpdate =  'update  employees  set firstName =?, otherName =?, surName =?, gender =?, email =?,
              mobileNo1 =?, mobileNo2 =?, hireDate =?, salary =?, jobId =?, departmentId =?, managerId =?,
              placeOfBirth =?, dateOfBirth =?, city =?, street1 =?, street2 =?, houseNo =?, country =?, socialMediaId =?'.
        ' where employeeId =?';
    $stmtEmpUpdate = $con->mysql->prepare($qryEmpUpdate);

    if(!$stmtEmpUpdate)
    {
        alert('Failed toUpdate Employee');
        echo $stmtEmpUpdate->error;
    }
    else{
        alert('About to Update employee');
        $stmtEmpUpdate->bind_param('ssssssssdssssssssisss', $firstName, $otherName, $surName,$gender,$email,
            $mobileNo1,$mobileNo2,$hireDate,$salary,$jobId,$departmentId,$managerId,$placeOfBirth,$dateOfBirth
            ,$city, $street1,$street2,$houseNo,$country,$socialMediaId, $empId);
        $stmtEmpUpdate->execute();
        //  alert('Insert statement');
        // print_r($stmt_insert);
        if($stmtEmpUpdate->affected_rows > 0)
        {
            alert('Employee successfully updated '.$stmtEmpUpdate->affected_rows.' row(s) updated');
        }
    }


}

function update_employee_selservice()
{

    alert('About to update employee wit Id '.$_POST['employeeId']);

    /////////POST Data/////////////////
    $empId = $_POST['employeeId'];//'empId'.rand(100, 100000);//'empId00002';//$_POST['team-no'];

    $mobileNo1 = $_POST['mobileNo1'];
    $email = $_POST['email'];
    $mobileNo2 = $_POST['mobileNo2'];

    $city = $_POST['city'];

    $street1 = $_POST['street1'];
    $street2 = $_POST['street2'];
    $houseNo = $_POST['houseNo'];
    $country = $_POST['country'];
    $socialMediaId = $_POST['socialMediaId'];

    /////////POST DATA////////////////

    $con = new Connection();
    /*$qryEmpUpdate =  'update  employees  set firstName =?, otherName =?, surName =?, gender =?, email =?,
              mobileNo1 =?, mobileNo2 =?, hireDate =?, salary =?, jobId =?, departmentId =?, managerId =?,
              placeOfBirth =?, dateOfBirth =?, city =?, street1 =?, street2 =?, houseNo =?, country =?, socialMediaId =?'.
        ' where employeeId =?';*/
    $qryEmpUpdate =  'update  employees  set email =?, mobileNo1 =?, mobileNo2 =?, city =?, street1 =?, street2 =?,
                      houseNo =?, country =?, socialMediaId =?'.' where employeeId =?';
    $stmtEmpUpdate = $con->mysql->prepare($qryEmpUpdate);

    if(!$stmtEmpUpdate)
    {
        alert('Employee update failed!');
        echo $stmtEmpUpdate->error;
    }
    else{
     //   alert('About to Update employee');
        $stmtEmpUpdate->bind_param('ssssssisss', $email,$mobileNo1,$mobileNo2,$city, $street1,$street2,$houseNo,$country,$socialMediaId, $empId);
        $stmtEmpUpdate->execute();
        //  alert('Insert statement');
        // print_r($stmt_insert);
        if($stmtEmpUpdate->affected_rows > 0)
        {
            alert(getEmpName($empId).' Bio Data successfully updated '.$stmtEmpUpdate->affected_rows.' row(s) updated');
        }
    }


}



function update_employee_pic()
{
    ////Update Employee Pic///

    $empId = $_POST['employeeId'];
    alert('About to update employee picture with Id '.$empId);

    /////////POST Data/////////////////

    //see if there was an uploaded pic
    $filesize = $_FILES['employee_pic']['size'];

    alert('The file is '.$filesize.' bytes');
    //alert('Showing image');
    if($filesize != 0) //if a picture is uploaded then update
    {
        //get the picture file details
        $filename = $_FILES['employee_pic']['name'];
        $filesize = $_FILES['employee_pic']['size'];
        $fileType = $_FILES['employee_pic']['type'];

        // $image = fopen($_FILES['employee_pic']['tmp_name'], 'rb');
        //print_r($image);
        //check for the accepted file extension
        $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
        alert($fileExtension);

        //save the infomation to the database


        //build the insert string
        $pic_con = new Connection();
        $qryUpdatePic = 'update pics set image = ?, fileName = ?, fileSize = ?, fileType = ? ' . ' where employeeId = ?';
        $stmtUpdatePic = $pic_con->mysql->prepare($qryUpdatePic);

        //check if the prepared statement failed
        if (!$stmtUpdatePic) {
            alert('Update failed');
            echo $pic_con->mysql->error;
        } else {
            $image = null;
            $stmtUpdatePic->bind_param('bsiss', $image, $filename, $filesize, $fileType, $empId);
            $stmtUpdatePic->send_long_data(0, file_get_contents($_FILES['employee_pic']['tmp_name']));
            $stmtUpdatePic->execute();
            if ($stmtUpdatePic->affected_rows > 0) {
                alert('Picture updated ' . $stmtUpdatePic->affected_rows . ' rows updated');
            }
        }

        //copy the file to the directory /scandocs
        alert($_FILES['employee_pic']['tmp_name'] . '  ../scandocs/' . $filename);
        move_uploaded_file($_FILES['employee_pic']['tmp_name'], '../scandocs/' . $filename);

        //show the picture
        //slideDown('../scandocs/'.$filename); //--'../scandocs/beauty.jpg'
    }
}

function insert_pic($empId)
{
    //Insert the uploaded picture into the database
    //hide image
        //hide();

    //alert('Showing image');

    //get the picture file details
        $filename = $_FILES['employee_pic']['name'];
        $filesize = $_FILES['employee_pic']['size'];
        $fileType = $_FILES['employee_pic']['type'];
    // $image = fopen($_FILES['employee_pic']['tmp_name'], 'rb');
    //print_r($image);
    //check for the accepted file extension
        $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
        alert($fileExtension);

    //save the infomation to the database


    //build the insert string
        $mysqlcon_pic = new Connection();
        $pic_insert_str = 'insert into pics(employeeId, fileName, fileSize, fileType, image) values(?,?,?,?,?)';
        $stmt_insert_pic = $mysqlcon_pic->mysql->prepare($pic_insert_str);
    //check if the prepared statement failed
        if(!$stmt_insert_pic)
        {
            alert($mysqlcon_pic->mysql->error);
            echo $mysqlcon_pic->mysql->error;
        }
        else{
            $image = null;
            $stmt_insert_pic->bind_param('ssisb',$empId,$filename, $filesize, $fileType, $image);
            $stmt_insert_pic->send_long_data(4, file_get_contents($_FILES['employee_pic']['tmp_name']));
            $stmt_insert_pic->execute();
            if($stmt_insert_pic->affected_rows > 0)
            {
                alert('Pic Data saved '.$stmt_insert_pic->affected_rows.' rows inserted');
            }
        }

    //copy the file to the file to the directory /scandocs
        alert($_FILES['employee_pic']['tmp_name'].'  ../scandocs/'.$filename);
        move_uploaded_file($_FILES['employee_pic']['tmp_name'], '../scandocs/'.$filename);

    //show the picture
    //slideDown('../scandocs/'.$filename); //--'../scandocs/beauty.jpg'


}


function insert_article_pic($articleId)
{
    //Insert the uploaded picture into the database
    //hide image
    //hide();

    //alert('Showing image');

    //get the picture file details
    $filename = $_FILES['employee_pic']['name'];
    $filesize = $_FILES['employee_pic']['size'];
    $fileType = $_FILES['employee_pic']['type'];
    // $image = fopen($_FILES['employee_pic']['tmp_name'], 'rb');
    //print_r($image);
    //check for the accepted file extension
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
    alert($fileExtension);

    //save the infomation to the database


    //build the insert string
    $mysqlcon_pic = new Connection();
    $pic_insert_str = 'insert into pics(employeeId, fileName, fileSize, fileType, image) values(?,?,?,?,?)';
    $stmt_insert_pic = $mysqlcon_pic->mysql->prepare($pic_insert_str);
    //check if the prepared statement failed
    if(!$stmt_insert_pic)
    {
        alert($mysqlcon_pic->mysql->error);
        echo $mysqlcon_pic->mysql->error;
    }
    else{
        $image = null;
        $stmt_insert_pic->bind_param('ssisb',$articleId,$filename, $filesize, $fileType, $image);
        $stmt_insert_pic->send_long_data(4, file_get_contents($_FILES['employee_pic']['tmp_name']));
        $stmt_insert_pic->execute();
        if($stmt_insert_pic->affected_rows > 0)
        {
            alert('Pic Data saved '.$stmt_insert_pic->affected_rows.' rows inserted');
        }
    }

    //copy the file to the file to the directory /scandocs
    alert($_FILES['employee_pic']['tmp_name'].'  ../scandocs/'.$filename);
    move_uploaded_file($_FILES['employee_pic']['tmp_name'], '../scandocs/'.$filename);

    //show the picture
    slideDown('../scandocs/'.$filename); //--'../scandocs/beauty.jpg'


}

function dryLatexConversionConst()
{
    $mysqlCon = new Connection();
    $queryConsts = 'select * from constants where constName = "drylatexConversionConst"';
    $stmt = $mysqlCon->mysql->query($queryConsts);
    $result = $stmt->fetch_assoc();
    echo $result['constValue'];
}

function drycupLumpsConversionConst()
{
    $mysqlCon = new Connection();
    $queryConsts = 'select * from constants where constName = "drycuplumpsConversionConst"';
    $stmt = $mysqlCon->mysql->query($queryConsts);
    $result = $stmt->fetch_assoc();
    echo $result['constValue'];
}

function calculate_taxes($employeeId)
{
    //calculate the tax and store it in the Deductions table
    //get the employee basic salary

    $incomeTaxPercent = $_POST['IncTax'] / 100;
    $nassconTaxPercent = $_POST['Nasccon'] / 100;
    $basicSalary = $_POST['salary'];


    $incomeTax = $incomeTaxPercent * $basicSalary;
    $nassconTax = $nassconTaxPercent * $basicSalary;

    //create an array to hold the taxes
    $taxesArray = array($incomeTax, $nassconTax);

   // echo '<br/><br/>';
   // var_dump($taxesArray);

    //get the names of the taxes and thier description
    $salCon = new Connection();
    $taxesQry = 'select taxType from taxes';
    $taxesStmt = $salCon->mysql->query($taxesQry);
    $resultTaxQuery = $taxesStmt->fetch_all(MYSQL_ASSOC);

    //var_dump($resultTaxQuery);


    $con = new Connection();
    $qryInsertTaxes = 'insert into deductions ( employeeId ,  deductionName ,  deductionDesc ,  deductionAmount)'.
                        ' values (?, ?, ?, ?)';

    $i = 0;

    foreach($resultTaxQuery as $x => $value)
    {

        $taxes = $taxesArray[$i];

        $qr1 = 'insert into deductions ( employeeId ,  deductionName ,  deductionDesc ,  deductionAmount)' .
            ' values (' . '"' . $employeeId . '"' . ',' . '"' . $value['taxType'] . '"' . ',' . '"' . 'taxes' . '"' . ',' . '"' . $taxes . '"' . ')';/**/

        $result = $con->mysql->query($qr1);

        if ($con->mysql->affected_rows > 0) {
            alert('Insert successful');
        }
        $i++;
    }
    /* }$stmtInsertTaxes = $con->mysql->prepare($qryInsertTaxes);

     $i = 0;
     if(!$stmtInsertTaxes)
     {
         alert('Failed to insert taxes');
         echo $con->mysql->error.'<br/>';
     }else{
         foreach($resultTaxQuery as $x => $value)
         {
             $taxes = $taxesArray[$i];
             echo 'Tax '.$taxes.'<br/>';

             $stmtInsertTaxes->bind_param('sssd', $employeeId, $value['taxtype'], 'taxes', 4.0);//$taxes
             $stmtInsertTaxes->execute();
             $i++;
             if($stmtInsertTaxes->affected_rows > 0)
             {
                 alert('Taxes successfully inserted for employeeId '.$employeeId);
             }
         }*/


}

function __update_loan($employeeId, $loanRepay,$amntPaid)
{
    $loanCon = new Connection();
    $qryLoan = 'update loans set loanAmount = '.'"'.$loanRepay.'"'.','.' amountPaid = '.'"'.$amntPaid.'"'.
        ' where employeeId = '.'"'.$employeeId.'"';
    $result = $loanCon->mysql->query($qryLoan);

    //alert('From loan update module'.$loan['loanAmount'] - round($loan['amountPaid'],0,PHP_ROUND_HALF_UP))
    if($loanCon->mysql->affected_rows > 0)
    {
       // alert('Loans successfully updated');
    }else{
        alert('Update failed');
        echo $loanCon->mysql->error;
    }
}

function update_loan($employeeId, $loanRepay,$amntPaid)
{

    $loanCon = new Connection();
    $qryLoan = 'update loans set loanAmount = ?'.','.' amountPaid = ?'.
        ' where employeeId = ?';
    $stmtLoan = $loanCon->mysql->prepare($qryLoan);
 var_dump($stmtLoan);
    if(!$stmtLoan)
    {
        alert('Update failed ..');
        echo $stmtLoan->error;
    }
    else{
        alert('Updating loan');
        $stmtLoan->bind_param('dds', $loanRepay, $amntPaid, $employeeId);
        $stmtLoan->execute();
        if($stmtLoan->affected_rows > 0)
        {
            alert('Loans successfully updated');
        }
    }

    //alert('From loan update module'.$loan['loanAmount'] - round($loan['amountPaid'],0,PHP_ROUND_HALF_UP))
    /* if($loanCon->mysql->affected_rows > 0)
     {
         // alert('Loans successfully updated');
     }else{
         alert('Update failed');
         echo $loanCon->mysql->error;
     }*/
}

function update_loan_status($employeeId)
{
    $loanCon = new Connection();
    $qryLoan = 'update loans set loanRepaymentStatus = '.'"'.'Complete'.'"'.' where employeeId = '.'"'.$employeeId.'"';
    $result = $loanCon->mysql->query($qryLoan);

    //alert('From loan update module'.$loan['loanAmount'] - round($loan['amountPaid'],0,PHP_ROUND_HALF_UP))
    if($loanCon->mysql->affected_rows > 0)
    {
        //alert('Loan Payment status successfully updated');
    }else{
        alert('Update failed');
        echo $loanCon->mysql->error;
    }
}



function processLoan($employeeId)
{
    $totalLoans = 0.0;
        try{


        $myloanCon = new Connection();
        $loanQry = 'select loanAmount, amountPaid, paymentRate, loanRepaymentStatus from loans '.
                    ' where employeeId = '.'"'.$employeeId.'"';
        $stmtLoan = $myloanCon->mysql->query($loanQry);
        if($stmtLoan->num_rows == 1)
        {
           // alert('Processing loan for EmployeeId '.$employeeId);
            $loan = $stmtLoan->fetch_assoc();
            $amountPaid = $loan['amountPaid'];
            $loanAmount = $loan['loanAmount'];
            $paymentRate = $loan['paymentRate'];
            alert('Employee loan detail '.'Loan Amnt : '.$loanAmount);

            $loanPaymentDiff = $loanAmount - $paymentRate;    //$loanAmount - round($amountPaid,0,PHP_ROUND_HALF_UP);
            //check if the employee has an unpaid loan
            if($loanPaymentDiff > 0 )
            {

                alert('Loan repayement diff '.$loanPaymentDiff);
                //set loan payment to Complete
                $amountPaid += $paymentRate;

               // $loanAmount -= $paymentRate;

               // alert('Loan amount '.$loanAmount);

                $totalLoans += $paymentRate;

                // alert('Amount Paid '.round($amountPaid,0,PHP_ROUND_HALF_UP));

                //update the loans table
                update_loan($employeeId, $loanPaymentDiff, $amountPaid);



            }else{
                //update loanrepaymentstatus to Complete
                alert('Loan completely paid');
                update_loan_status($employeeId);

            }
        }

        }catch(Exception $e){
            alert($e);
        }
    return $totalLoans;
}
function getEmpName($empId)
{
    /*$employeeNameQry = 'select getEmpName('.'"empId72166"'.') as FullName'.' from employees';*/
    $empNameCon = new Connection();
    $employeeNameQry = 'select getEmpName("'.$empId.'") as FullName'.' from employees';
    //$employeeNameQry = 'select getEmpName("'.'"'.$empId.'"'.'") as FullName'.' from employees';
    alert($employeeNameQry);
    $employeeNameStmt = $empNameCon->mysql->query($employeeNameQry);
    $empNameResult = $employeeNameStmt->fetch_assoc();
    return($empNameResult['FullName']);
}

function getEmailAddr($empId)
{
    /*$employeeNameQry = 'select getEmpName('.'"empId72166"'.') as FullName'.' from employees';*/
    $empNameCon = new Connection();
    $employeeNameQry = 'select getEmail("'.$empId.'") as Email'.' from employees';
    $employeeEmailStmt = $empNameCon->mysql->query($employeeNameQry);
    $employeeEmailResult = $employeeEmailStmt->fetch_assoc();
    return($employeeEmailResult['Email']);
}

function getManagerEmailAddr($empId)
{
    /*$employeeNameQry = 'select getEmpName('.'"empId72166"'.') as FullName'.' from employees';*/
    $empNameCon = new Connection();
    $employeeManagerEmailQry = 'select getManagerEmail("'.$empId.'") as ManagerEmail'.' from employees';
    $employeeManagerEmailStmt = $empNameCon->mysql->query($employeeManagerEmailQry);
    $employeeManagerEmailResult = $employeeManagerEmailStmt->fetch_assoc();
    return($employeeManagerEmailResult['ManagerEmail']);
}

function getManagerName($managerId)
{
    $Con = new Connection();

    $managerNameQry = 'select getManagerFullName('.'"'.$managerId.'"'.') ManagerFullName';
    $stmt = $Con->mysql->query($managerNameQry);
    $result = $stmt->fetch_assoc();
    return $result['ManagerFullName'];
}

function getHRManagerEmailAddr()
{
    /*$employeeNameQry = 'select getEmpName('.'"empId72166"'.') as FullName'.' from employees';*/
    $empNameCon = new Connection();
    $employeeManagerEmailQry = 'select getHRManagerEmail() as HRManagerEmail'; //.' from employees';
    $employeeManagerEmailStmt = $empNameCon->mysql->query($employeeManagerEmailQry);
    $employeeManagerEmailResult = $employeeManagerEmailStmt->fetch_assoc();
    return($employeeManagerEmailResult['HRManagerEmail']);
}

function notifyLeaveRequestManager($empId)
{
    ini_set('SMTP','localhost');
    ini_set('sendmail_from', 'paul@globetekservices.com');
    //get manager email address
    $to = getManagerEmailAddr($empId);
         alert('Manager Email address '.$to);//'tenneh@globetekservices.com';
    $subject = 'Leave Request';
    $htmlBody = '<html>
                <head>
                <title>Leave Request</title>
                </head>
                <body>';
    $approvalForm = 'Please follow this link to the aproval form '.'<a href="http://localhost/globetekhrm/admin/approveForLeave.php?emPid='.$empId.'">'.'Complete Task'.'</a>';
    $body = '<p>'.'Please approve leave for '.'<b>'.getEmpName($empId).'</b></p>'.
                  $approvalForm.'</body>
                </html>';
    $htmlBody = $htmlBody.$body;

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


    mail($to, $subject , $htmlBody, $headers);
}

function notifyLeaveRequestEmployee($empId)
{
    ini_set('SMTP','localhost');
    ini_set('sendmail_from', 'paul@globetekservices.com');

    //get employee email address
    $to = getEmailAddr($empId); //'tenneh@globetekservices.com';
    alert('Employee Email address '.$to);
    $subject = 'Leave Request Acknowledgement';
    $body = '<h1>'.'Your leave request form has been submitted and is pending approval\nThank you'.'</h1>';

    mail($to, $subject , $body);
}

function notifyHRManager($empId)
{
    ini_set('SMTP','localhost');
    ini_set('sendmail_from', 'paul@globetekservices.com');
    //get manager email address
    $to = getHRManagerEmailAddr();
    $cc = getEmailAddr($empId);
    alert('HR Manager Email address '.$to);//'tenneh@globetekservices.com';
    $subject = 'Leave Request';
    $htmlBody = '<html>
                <head>
                <title>Leave Approval</title>
                </head>
                <body>';
    $approvalForm = 'Please follow this link to the aproved leave list '.'<a href="http://localhost/globetekhrm/admin/viewReports.php">'.'Approved Leave List'.'</a>';
    $body = '<p>'.'This is to notify you that leave has been approved for '.'<b>'.getEmpName($empId).'</b></p>'.
        $approvalForm.'</body>
                </html>';
    $htmlBody = $htmlBody.$body;

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'Cc: '.$cc."\r\n";


    mail($to, $subject , $htmlBody, $headers);
}

//appraisal related section
function getQuestion($pageNo)
{
    $con = new Connection();
    $qryQuestion = 'select questionStatement from appraisalquestions where pageNo ='.'"'.$pageNo.'"';
    $stmtQ = $con->mysql->query($qryQuestion);
    $resultQ = $stmtQ->fetch_assoc();


   return $resultQ['questionStatement'];
}

function saveResponse($pageNo, $appraisalId, $appraiseeId, $response)
{
    $Con = new Connection();
    // $Qry = 'insert into pages(pageNo ,questionId, response, appraisalId) values (?, ?, ?, ?)';
    $Qry = 'insert into appraisalresponse(appraisalId, appraiseeId, response, pageNo) values (?, ?, ?, ?)';
    $Stmt = $Con->mysql->prepare($Qry);

    if(!$Stmt)
    {
        alert('Failed to add response');
        echo $Con->mysql->error;
    }
    else{
        /*   alert('About to add tax');*/
        $Stmt->bind_param('ssss', $appraisalId, $appraiseeId, $response, $pageNo);
        $Stmt->execute();
        if($Stmt->affected_rows > 0)
        {
            alert('Response successfully added.');
        }
    }
}

function getResponse($pageNo, $userId)
{
    $con = new Connection();
    $qryResponse = 'select response from appraisalresponse where pageNo ='.'"'.$pageNo.'"'.' and appraiseeId ='.
                    '"'.$userId.'"';
    $stmtR = $con->mysql->query($qryResponse);
    $resultR = $stmtR->fetch_assoc();
    return $resultR['response'];
}

function updateResponse($pageNo, $userId, $response)
{
    $con = new Connection();
    $updateResponse = 'update appraisalresponse set response ='.'"'.$response.'"'.' where pageNo = '.'"'.$pageNo.'"'.
    ' and appraiseeId = '.'"'.$userId.'"';
     $stmt = $con->mysql->query($updateResponse);
    if($con->mysql->affected_rows == 1)
    {
        alert('Response successfully updated');
    }
    else{
        alert('Update failed, creating new response');
        //insert a new response
        //get the appraisalId from the session variable
        $appraisalId = $_SESSION['appraisalId'];
        saveResponse($pageNo, $appraisalId, $userId, $response);

        $con->mysql->error;
    }

}


function save_session_data($sessionId, $variableName, $variableValue)
{
    $con = new Connection();
    $saveQry = 'insert into sessondata(sessionId, variableName,variableValue ) values(?, ?, ?)';
    $stmt = $con->mysql->prepare($saveQry);
    if(!$stmt)
    {
        alert('Cannot save session variable');
        echo $con->mysql->error;
    }else{
        $stmt->bind_param('sss',$sessionId, $variableName, $variableValue);
        $stmt->execute();
        if($stmt->affected_rows == 1)
        {
            alert('Session data successfully saved');
        }
    }
}

function checkSession()
{
    if(!isset($_SESSION))
    {
        alert('Session not set');
        session_start();
        $empId = $_SESSION['userId'];
    }
    $empId = @$_SESSION['userId']; //suppress any errors
    if($empId == '')
        header('Location:http://localhost/globetekhrm/login.php');

}

function getDept($empId)
{
    $mysqlConDpt = new Connection();
    $query_str = 'select departmentId from employees where employeeId='.'"'.$empId.'"';
    $stmt = $mysqlConDpt->mysql->query($query_str);
    $result = $stmt->fetch_assoc();
    return $result['departmentId'];
}

function getJob($empId)
{
    $mysqlConDpt = new Connection();
    $query_str = 'select jobId from employees where employeeId='.'"'.$empId.'"';
    $stmt = $mysqlConDpt->mysql->query($query_str);
    $result = $stmt->fetch_assoc();
    return $result['jobId'];
}
?>

