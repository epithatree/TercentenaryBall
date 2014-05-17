<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<?php $mainframe =& JFactory::getApplication(); ?>

<?php $data=modHelloWorldHelper::getData($_GET["bookingID"], $_GET["email"]);?>

<form name="myform" action="<?php echo JURI::current() ?>" method="GET">

<?php if (!isset($data)) : ?>
        Enter your booking ID: <br><input type="text" name = "bookingID" value="<?php echo $_GET["bookingID"]?>"><br>
	Enter your email address: <br><input type="text" name = "email" value="<?php echo $_GET["email"]?>"><br>
<?php endif;?>
<?php if (isset($data)) : ?>
        <table>
        <tr>
	<td>Enter your booking ID:</td><td> <?php echo $_GET["bookingID"]?></td></tr>
	<td>Enter your email address:</td><td><?php echo $_GET["email"]?></tr>
        </table>
        <?php $id = $_GET['bookingID'];?>
        <?php $leadID = $id;?>
        <input type="hidden" name="custom_id" value="<?php echo $id?>" />
<?php endif;?>
	<table>
<?php if (!isset($data) && isset($_GET["bookingID"])) : ?>
        <p>These details are not correct.</p>
<?php endif;?>
<?php $leader = "Lead Booker Details";?>
<?php while (isset($data)) : ?>
	<?php 
	  $id=intval($data['Unique_ID']);
          $status=$data['Status'];
          $dining=$data['Dining'];
          $name=$data['Name'];
	  $email=$data['Email'];
	  $bodCard=$data['Bod_Card'];
	  $telephone=$data['Telephone'];
          $groupID=$data['Group_ID'];
	?>
		<tr>
			<td><b><?php echo $leader?></b></td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td>Name</td>
			<td><input value="<?php echo $name?>" type="text" name="<?php echo $id?>[name]"></td>
		</tr>
		<tr>	
			<td></td>
			<td>Email Address</td>
			<td><input value="<?php echo $email?>" type="text" name="<?php echo $id?>[email]"></td>
		</tr>
		<tr>
			<td></td>
			<td>Bod Card Number</td>
			<td><input value="<?php echo $bodCard?>" type="text" name="<?php echo $id?>[bod]"></td>
		</tr>
		<tr>	<td></td>
			<td>Telephone Number</td>
			<td><input value="<?php echo $telephone?>" type="text" name="<?php echo $id?>[telephone]"?></td>
		</tr>
                <tr>
                        <td></td>
                        <td>Dining</td>
                        <td><?php echo $dining?></td>
                </tr>
                <tr>
                        <td></td>
                        <td>Over 18</td>
                        <td><select name="<?php echo $id?>[over18]"?>
                          <option value="Please Select">Please Select</option>
                          <option value="Over 18">Over 18</option>
                          <option value="Under 18">Under 18</option>
                          </select>
                          <i>Please note, people under the age of 18 are not allowed to enter the ball.</i>
                        </td>
                </tr>
<?php $leader = "Guest Details" ?>
<?php $data=modHelloWorldHelper::getData(++$id, NULL, $leadID);?>
<?php endwhile; ?>
	</table>
<?php if (!isset($email)): ?>
       <input type="button" value="Submit" name="currentPage">
<?php endif; ?>
<?php if (isset($email)): ?>
       <p> If you believe the number or type of tickets you have been allocated is incorrect, please email secretary@thetercentenaryball.co.uk</p>
        <input type="button" value="Submit" name="nextPage">
<?php endif; ?>
</form>
<script type="text/javascript">
jQuery(function($) {
    var form = document.myform;
    $(form).find("input[type='button']").click(function() {
        form.action = this.name == 'currentPage' ? "<?php echo JURI::current()?>" : "<?php echo JURI::current()."2"?>";
        form.submit();
        return false;
    });
});
</script>
