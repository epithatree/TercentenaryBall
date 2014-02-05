<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<form action="<?php echo JURI::current() ?>" method="POST">
	Enter your booking ID: <input type="text" name = "bookingID" value="<?php echo $_POST["bookingID"]?>"><br>
	Enter your email address: <input type="text" name = "email" value="<?php echo $_POST["email"]);?>"><br>
	<input type="submit" value="Submit">
</form>
<?php $data=modHelloWorldHelper::getData($_POST["bookingID"], $_POST["email"]);?>
<?php $leader = "Lead Booked Details";?>
<form action="<?php echo JURI::current() ?>" method="POST">
<?php while (isset($data)) : ?>
	<?php $name=$data['Name'];
	  $id=$data['Unique_ID'];
	  $bodCard=$data['Bod_Card'];
	  $telephone=$data['Telephone'];
	  $email=$data['Email'];
	  $amountPaid=$data['Amount_Paid'];
	  $paymentMethod=$data['Payment_Method'];
	  $totalAmountDue=$data['Total_Amount_Due'];
	?>
	<table>
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
			<td><input value="<?php echo $bodCard?>" type="text" name="<?php echo $id?>bod"></td>
		</tr>
		<tr>	<td></td>
			<td>Telephone Number</td>
			<td> <input value="<?php echo $telephone?>" type="text" name="<?php echo $id?>telephone"?></td>
		</tr>
	</table>
<?php $leader = "Guest Details" ?>
<?php $data=modHelloWorldHelper::getData(++$id);?>
<?php endwhile; ?>
<input type="submit" value="Submit">
</form>
<?php if (isset($id)) : ?>
<?php for($temp_id =$_POST['bookingID'], $temp_id <= $id, $temp_id++) : ?>
<?php endfor;?>
<?php endif;?>
