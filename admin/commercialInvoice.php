<?php
/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 3/20/2016
 * Time: 10:00 AM
 */

include_once('headerpage_admin.php');
include_once('utils.php');
include('connect.php');

$custId = @$_GET['custId'];

alert('Customer with Id : '.$custId.' has signed in');

if(isset($_POST['submit']))
{
  //  alert('Invoice created');
  //  var_dump($_POST);
    $itemNo = $_POST['itemNo'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $unitprice   = $_POST['unitprice'];
    $extprice = $_POST['extprice'];
    $consignee = $_POST['consignee'];
    $consignor = $_POST['consignor'];
    $invoiceDate = $_POST['invoiceDate'];
    $invoiceNum = $_POST['invoiceNum'];
    $grandTotal  = $_POST['grandtotal'];
    $waybill = $_POST['waybill'];

    //save the data to the database
    //create new connection object
    $invCon = new Connection();
    $invInsertQry = 'insert into commercialInvoice(custId, waybill, invoiceDate,consignee, consignor, fob, insurance, freight, cif) '.
                    ' values(?,?,?,?,?,?,?,?, ?)';
    $stmt = $invCon->mysql->prepare($invInsertQry);

    if(!$stmt)
    {
        alert('Failed to create invoice');
    }
    else{

        //$stmt->bind_param()
    }

}

?>
<style>
    span{
        display: inline;
        font-size: 1.25em;
        font-weight: bold;
        padding-bottom: 10px;
    }
</style>
<div style="border: thin blue solid; width: 1000px; margin-bottom: 10px; margin-top: 10px;">
    <h1>Commercial Invoice</h1>
    <span>WayBill &nbsp;&nbsp;: </span>
    <span><input type="text" name="waybill" id="waybill" class="" placeholder="Shipping number"/></span>

</div>

<div>

    <form id="commercialInvoice" method="post" action="" name="commercialInvoice" enctype="application/x-www-form-urlencoded">
        <div id="commInvLeft">
            <table>
                <tr>
                    <td><b>Consignee</b></td>
                    <td><input type="text" name="consignee" id="consignee" class="invHeaderItems"/></td>
                </tr>
                <tr>
                    <td><b>Invoice Date</b></td>
                    <td><input type="text" name="invoiceDate" id="invoiceDate" value="<?php echo date('Y-m-d'); ?>"/></td>
                </tr>
            </table>
        </div>
        <div id="commInvRight" style="width: 45%;" >
            <table>
                <tr>
                    <td><b>Consignor</b></td>
                    <td><input type="text" name="consignor" id="consignor" class="invHeaderItems"/></td>
                </tr>
                <tr>
                    <td><b>Invoice No.</b></td>
                    <td><input type="text" name="invoiceNum" id="invoiceNum"/></td>
                </tr>
            </table>
        </div>
        <div id="clear_div" style="clear: both;"></div>
        <div id="lineItems">
            <table id="invoiceItems">
                <tr>
                    <td><b>Item No.</b></td>
                    <td><b>Description</b></td>
                    <td><b>Quantity</b></td>
                    <td><b>Unit Price</b></td>
                    <td><b>Ext. Price</b></td>
                </tr>
                <tr>
                    <td><input type="text" name="itemNo[]" id="itemNo"/></td>
                    <td><input type="text" name="description[]" id="description"/></td>
                    <td><input type="text" name="quantity[]" id="quantity"/></td>
                    <td><input type="text" name="unitprice[]" id="unitprice"/></td>
                    <td><input type="text" name="extprice[]" id="total"/></td>
                </tr>
            </table>

        </div>
        <div>
            <table>
                <tr>
                    <td><b>Grand Total</b></td>
                    <td><b><input type="text" name="grandtotal" id="grandtotal"/></b></td>
                </tr>
            </table>
            <table>
                <tr>
                    <td><b><button type="button" name="createRow" id="createRow" class="invoiceButtons">+</button></b></td>
                    <td><b><button type="button" name="removeRow" id="removeRow" class="invoiceButtons">-</button></b></td>
                </tr>

            </table>
            <table style="text-align: left;">
                <th><b>Terms Of Payments</b></th>
                <tr>
                    <td><b>FOB</b></td>
                    <td><input type="text" name="fob" id="fob"></td>
                </tr>
                <tr>
                     <td><b>INS</b></td>
                    <td><input type="text" name="ins" id="ins"/></td>
                </tr>
                <tr>
                    <td><b>Freight</b></td>
                    <td><input type="text" name="freight" id="freight"/></td>
                </tr>
                <tr>
                    <td><b>Total CIF</b></td>
                    <td><input type="text" name="totalcif" id="totalcif"/></td>
                </tr>
            </table>
        </div>
        <div id="buttons">
            <?php include_once('buttons.php') ?>
        </div>
    </form>

    <script src="../jQueryUI/jquery-ui.js" type="text/javascript"></script>
    <script src="../js/validationRules.js" type="text/javascript"></script>
    <script type="text/javascript">

        $(function(){
            //alert('About to launch date picker');

            $('#createRow').click(function(){
             //   alert('Adding a new row');

                //  alert("i "+ (i +1));
                $('#invoiceItems').append(
                '<tr>'+
                '<td><input type="text" name="itemNo[]" id="itemNo"/></td>'
                + '<td><input type="text" name="description[]" id="description"/></td>'
                + '<td><input type="text" name="quantity[]" id="quantity"/></td>'
                + '<td><input type="text" name="unitprice[]" id="unitprice"/></td>'
                + '<td><input type="text" name="extprice[]" id="total"/></td>'
                + '</tr>');
               // '<tr id="salaryComponentRow"><td><input name="salaryComponent[]" /></td><td><input name="amount[]" id="amount"/></td><td><input name="salaryComponentDesc[]" /></td></tr>');

            });

            $('#removeRow').click(function(){
              //  alert('Removing  a new row');
                // $('#salaryComponent').remove('(tr :last');
                var table = document.getElementById('invoiceItems');
                table.deleteRow(-1);
            });

            $('#calcIncomeTax').click(function(){
                alert('Calculating income tax');
                var table = document.getElementById('salaryComponent');
                var basicWage = 0.0;
                var len = table.rows.length;

                var cellsUnitPrice = $('table#invoiceItems tr td input#unitprice');
                var cellsQuantity = $('table#invoiceItems tr td input#quantity');

                var lengt = _cells.length;//$('table#salaryComponent tr td input#amount').length;
                // for(var i=1; i < len; i++)
                // alert(lengt+' Input elements');

                //var nextRow = _rows.next('tr:eq(1)');
                var _grossMonthlySalary = 0.0;
                for(var i=0; i < lengt; i++)
                {
                    _grossMonthlySalary += parseFloat(_cells.eq(i).val());
                    //  alert('Amount '+ _grossMonthlySalary); //+ _cells[i].val());
                    // alert('Next row '+nextRow.find('td input#amount').val());
                    //
                    // _cells.next();
                }

                //make an Ajax call
                $.ajax({
                    type:"POST",
                    data: {basicSalary: _grossMonthlySalary},
                    url:"http://localhost/globetekhrm/admin/calculateIncomeTax.php",
                    success:function(data, status){
                        $('#incomeTax').val(parseFloat(data).toFixed(2));
                        // alert('Incoming data '+data);
                    }
                });
                //  {
                //  alert('i '+i);
                // alert('Amount '+table.rows[i].cells[1].innerHTML);
                /*alert('Number of rows '+$('td[id=amount]').length);
                 $('td#amount').each(function(){
                 alert('Amount '+ $(this).val());*/

//update the total salary
                $('#grossSalary').val(_grossMonthlySalary.toFixed(2));

            });

            $('#calcIncomeTaxPercentage').click(function(){
                alert('Calculating income tax');
                var table = document.getElementById('salaryComponent');
                var basicWage = 0.0;
                var len = table.rows.length;

                var _cells = $('table#salaryComponent tr td input#amount');

                var lengt = _cells.length;//$('table#salaryComponent tr td input#amount').length;
                // for(var i=1; i < len; i++)
                // alert(lengt+' Input elements');

                //var nextRow = _rows.next('tr:eq(1)');
                var _grossMonthlySalary = 0.0;
                for(var i=0; i < lengt; i++)
                {
                    _grossMonthlySalary += parseFloat(_cells.eq(i).val());
                    //  alert('Amount '+ _grossMonthlySalary); //+ _cells[i].val());
                    // alert('Next row '+nextRow.find('td input#amount').val());
                    //
                    // _cells.next();
                }

                //make an Ajax call
                $.ajax({
                    type:"POST",
                    data: {basicSalary: _grossMonthlySalary},
                    url:"http://localhost/globetekhrm/admin/calculateIncomeTaxPercentage.php",
                    success:function(data, status){

                        $('#incomeTaxPercent').val(parseFloat(data).toFixed(2));
                        //alert('Incoming data '+data);
                    }
                });
                //  {
                //  alert('i '+i);
                // alert('Amount '+table.rows[i].cells[1].innerHTML);
                /*alert('Number of rows '+$('td[id=amount]').length);
                 $('td#amount').each(function(){
                 alert('Amount '+ $(this).val());*/



            });




        });
    </script>



</div>