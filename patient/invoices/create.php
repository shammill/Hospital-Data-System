<?php
ini_set("display_errors", 1);
error_reporting(-1);

include('../../.views/header.php');

/*
if($staff->permissions()->has('CREATE_INVOICE', 'name')==false){
    echo '<div class="alert alert-danger"><center>';
    echo 'Sorry, you do not have permission to access this resource.';
    echo '</center></div>';
    die;
}
*/

require_once('../../.class/patient.class.php');
require_once('../../.class/billable.class.php');
require_once('../../.class/invoice.class.php');

$invoice = new invoice();
$patient = new patient();
$patient->getCurrentPatient();

if($_POST){
    $invoice->medicare_provided = $patient->medicare != '';
    $invoice->status = 0;
    $invoice->save();

    foreach($_POST['item'] as $item){
        $invoice->items()->add(new billable($item));
    }
	echo "<a href='view.php?invoice=".$invoice->id()."'>View the invoice here!</a>";
    //header('view.php?invoice=');
    die;
}

$billable = new billable();
$billable_items = $billable->all();

?>
    <div class="container">
        <div style="float:left;">
            <h2>Invoice for <?=$patient->first_name?> <?=$patient->last_name?></h2>
            <?if($patient->medicare == ''){?>
                <h4>Medicare not provided</h4>
            <?} else {?>
                <h4>Medicare provided (<?=$patient->medicare?>)</h4>
            <?}?>
        </div>
        <div style="clear:both;"></div>
        <select id="addBillable">
<           <? foreach($billable_items as $item){?>
                <option value="<?=$item->id()?>"><?=$item->item?></option>
            <? } ?>
        </select>
        <input type="button" id="addButton" value="Add Billable">

        <form name="update_invoice" method="post">
            <table style="width:100%; display:none; padding:10px" id="invoice_table">
                <thead>
                    <tr style="font-weight:bold;">
                        <td></td>
                        <td>Billable Item</td>
                        <td>Price</td>
                        <td>Tax</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                    <tr style="font-weight: bold">
                        <td colspan="2" align="right">Total:</td>
                        <td id="total_price"></td>
                        <td id="total_tax"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Create Invoice">
        </form>
    </div>
<script>
    var billableItems = new Array();
    <? foreach($billable_items as $item){?>
    billableItems[<?=$item->id()?>] = new Array();
    billableItems[<?=$item->id()?>]['id'] = '<?=$item->id()?>';
    billableItems[<?=$item->id()?>]['item'] = '<?=$item->item?>';
    billableItems[<?=$item->id()?>]['description'] = '<?=$item->description?>';
    billableItems[<?=$item->id()?>]['price'] = <?=$item->price?>;
    billableItems[<?=$item->id()?>]['tax'] = <?=$item->tax?>;
    billableItems[<?=$item->id()?>]['medicare_price'] = <?=$item->medicare_price?>;
    billableItems[<?=$item->id()?>]['medicare_tax'] = <?=$item->medicare_tax?>;
    <? } ?>

    function dollar(string){
       string = string.toString();
       return '$' + string.substring(0, string.length - 2) + '.' + string.substring(string.length - 2, string.length);
    }

    var items = new Array();
    var total = 0;
    var tax_total = 0;
    var medicare = <?=$patient->medicare==''? 'false' : 'true'?>;

    $("#invoice_table").delegate('#removeRow','click',function(event) {
        event.preventDefault();
        var row = $(this).closest('tr');
        var id_type = row.find('td').first().html();

        var item = billableItems[id_type];

        var remove_price = item['price'];
        var remove_tax = item['tax'];

        if(medicare){
            remove_price = item['medicare_price'];
            remove_tax = item['medicare_tax'];
        }

        total = total - remove_price;
        tax_total = tax_total - remove_tax;

        $('#total_price').html(dollar(total));
        $('#total_tax').html(dollar(tax_total));

        row.remove();

        if(total==0){
            $('#invoice_table').hide();
        }
    });

    $("#addButton").click(function(){
        $('#invoice_table').show(100);
        var item = billableItems[$('#addBillable').val()];
        items.push(item);

        var add_price = item['price'];
        var add_tax = item['tax'];

        if(medicare){
            add_price = item['medicare_price'];
            add_tax = item['medicare_tax'];
        }

        total = total + add_price;
        tax_total = tax_total + add_tax;

        $('#total_price').html(dollar(total));
        $('#total_tax').html(dollar(tax_total));

        $('#invoice_table tbody').prepend('<tr><td>' + item['id'] + '</td><td><input type="hidden" name="item[]" value="' + item['id'] + '">' + item['item'] + '</td><td>' + dollar(add_price) + '</td><td>'+ dollar(add_tax) + '</td><td><a href="#" id="removeRow">Remove</a></td></tr>');
    });

</script>
<?PHP include("../../.views/footer.php"); ?>