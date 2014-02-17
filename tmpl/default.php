<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<form name="myform" action="<?php echo JURI::current() ?>" method="POST">
	Enter your booking ID: <br><input type="text" name = "bookingID" value="<?php echo $_POST["bookingID"]?>"><br>
	Enter your email address: <br><input type="text" name = "email" value="<?php echo $_POST["email"]?>"><br>

<?php if (isset($_POST['custom_name'])) : ?>
<?php $id = $_POST['custom_id'];?>
<?php for($temp_id =(intval($_POST['bookingID'])); ($temp_id < $id)&&($temp_id+5 >$id); ++$temp_id) : ?>
<?php modHelloWorldHelper::modifyDetails($temp_id, $_POST["$temp_id"][bod], $_POST["$temp_id"][telephone]);?>
<?php endfor;?>
<?php $id = $_POST['bookingID'];?>
<?php endif;?>

	<table>
<?php $data=modHelloWorldHelper::getData($_POST["bookingID"], $_POST["email"]);?>
<?php $leader = "Lead Booked Details";?>
<?php while (isset($data)) : ?>
	<?php $name=$data['Name'];
	  $id=intval($data['Unique_ID']);
	  $bodCard=$data['Bod_Card'];
	  $telephone=$data['Telephone'];
	  $email=$data['Email'];
	  $amountPaid= $data['Amount_Paid'] ? $data['Amount_Paid']: $amountPaid;
	  $paymentMethod=isset($data['Payment_Method']) ? $data['Payment_Method'] : $paymentMethod;
	  $totalAmountDue=isset($data['Total_Amount_Due']) ? $data['Total_Amount_Due'] : $totalAmountDue;
	?>
		<tr>
			<td><b><?php echo $leader?></b></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>Name</td>
			<td><?php echo $name?></td>
		</tr>
		<tr>	
			<td></td>
			<td>Email Address</td>
			<td><?php echo $email?></td>
		</tr>
		<tr>
			<td></td>
			<td>Bod Card Number</td>
			<td><input value="<?php echo $bodCard?>" type="text" name="<?php echo $id?>[bod]"></td>
		</tr>
		<tr>	<td></td>
			<td>Telephone Number</td>
			<td> <input value="<?php echo $telephone?>" type="text" name="<?php echo $id?>[telephone]"?></td>
		</tr>
<input type="hidden" name="payment_method" value="<?php echo $paymentMethod?>" />
<input type="hidden" name="amount_to_pay" value="<?php echo $totalAmountDue?>" />
<?php $leader = "Guest Details" ?>
<?php $data=modHelloWorldHelper::getData(++$id);?>
<?php endwhile; ?>
	</table>
<input type="hidden" name="custom_id" value="<?php echo $id?>" />
<input type="hidden" name="custom_name" value="<?php echo $name?>"/>
<input type="button" value="Submit">
<?php if (isset($paymentMethod)): ?>
	<input type="button" value="Continue to Payment">
<?php endif; ?>
</form>
<script type="text/javascript">
jQuery(function($) {
    var form = document.myform;
    $(form).find("input[type='button']").click(function() {
        form.action = this.value == 'Submit' ? "<?php echo JURI::current()?>" : "<?php echo JURI::current()."2"?>";
        form.submit();
        return false;
    });
});
</script>
