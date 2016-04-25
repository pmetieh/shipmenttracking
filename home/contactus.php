<?php
	session_start();
include_once('../admin/connect.php');
?>
<?php
	include_once('headerpage.php');
?>

<?php
	if(isset($_POST["message"]) && isset($_POST["email"]))
    {
	   //echo $_POST['message'];
        //save the enquiry to the database
        $enquiry = $_POST["message"];
        $from = "From: adonzo@wacaflibinc.com";
        mail($_POST["email"], "Service Enquiry", $_POST["message"], $from); // pmetieh@globetekserviceslib.com
	}
    
?>

<h1>Please make an enquiry</h1>
<div id="contact_main">

<div id="contactform" class="contentLeft">

<form id="contactus" name="contactus" action="contactus.php" method="post">
<!--<input type="text" name="message" style="height:200px; width:300px; margin-top: 10px; padding: 0px;" />-->
<table>
<tr>
<td><b>Email:</b></td>
<td><input type="text" name="email" id="email"/></td>
</tr>
<tr>
<td colspan="5"><textarea rows="15" cols="40" name="message" class="textwrap">Type message here</textarea></td>
<td colspan="5"></td>
</tr>
<tr>
<td><input type="submit" name="submit" value="Submit" /> </td>
<td colspan="5"></td>
<td><input type="reset" name="cancel" value="Cancel"/></td>

</tr>
</table>

</form>
</div>

<div id="contactInfo" class="contentRight">
<table>
<tr>
<td  style="vertical-align: text-top;"><b>Address</b></td>
<td>
    Sareta House, 18th Street, Sinkor, Tubman Boulevard
    Monrovia, Liberia Tel #: 0886432870, 0888259813, 0886399178

    Platinum Logistics Inc<br />
18th Street Sinkor<br />
Monrovia, Liberia<br />
</td>
</tr>
<tr><td><b>Mobile1</b></td>
<td>088259813</td>
</tr>
<tr><td><b>Mobile2</b></td>
<td>0886399178</td>
</tr>
<!--<tr>
<td><b>Mobile3</b></td>
<td></td>
</tr>-->
</table>
</div>

</div>
<script type="text/javascript">
moveImage();
</script>
<?php
	include_once('footerpage.php')
?>

