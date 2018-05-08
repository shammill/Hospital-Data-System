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
$invoice->getCurrentInvoice();

$patient = new patient($invoice->patient_id);

if($invoice->id()==0){
    die('Invoice does not exist.');
}

function dollar($string){

    return '$'.substr($string, 0, strlen($string) - 2).'.'.substr($string, strlen($string) - 2);

}

?>
    <div class="container">
        <h2>Invoice for <?=$patient->first_name?> <?=$patient->last_name?></h2>
        <?if($patient->medicare == ''){?>
            <h4>Medicare not provided</h4>
        <?} else {?>
            <h4>Medicare provided (<?=$patient->medicare?>)</h4>
        <?}?>
        <table style="width:100%; padding:10px" id="invoice_table">
            <thead>
            <tr style="font-weight:bold;">
                <td>Billable Item</td>
                <td>Price</td>
                <td>Tax</td>
            </tr>
            </thead>
            <tbody>
            <?
            $total = 0;  $tax = 0;
            foreach($invoice->items()->get() as $item){?>
                <tr>
                    <td><?=$item->item?></td>
                    <? if($patient->medicare==''){ ?>
                        <td><?=dollar($item->price)?></td>
                        <td><?=dollar($item->tax)?></td>
                        <? $total += $item->price; $tax += $item->tax; ?>
                    <? } else { ?>
                        <td><?=dollar($item->medicare_price)?></td>
                        <td><?=dollar($item->medicare_tax)?></td>
                        <? $total += $item->medicare_price; $tax += $item->medicare_tax; ?>
                    <? } ?>
                </tr>
            <? } ?>
            <tr style="font-weight: bold">
                <td align="right">Total:</td>
                <td id="total_price"><?=dollar($total)?></td>
                <td id="total_tax"><?=dollar($tax)?></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
<?PHP include("../../.views/footer.php"); ?>