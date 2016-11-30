<?php

$name_error='';

if(!empty($_POST['submitted']))
{//if submitted, then validate

	$event = trim($_POST['event']);

	$address = trim($_POST['address']);

	$time = trim($_POST['time']);
	
	$error = false;
	
	if(empty($event))
	{
		$event_error='Class name is empty. Please enter your class name.';
		$error=true;
	}

	if(empty($address))
	{
		$address_error='Location name is empty. Please enter location name.';
		$error=true;
	}
	
	if(empty($_POST['time']))
	{
		$time_error ="Please select a time from the list";
		$error=true;
	}
	else
	{
		$time = $_POST['time'];
	}
	
	if(count($_POST['Dates']) != 1)
	{
		$dates_error = "Please select one date slot";
		$error=true;
	}

	$dates = $_POST['Dates'];
	
	if(empty($_POST['agree']))
	{
		$terms_error = "If you agree to the terms, please check the box below";
		$error=true;
	}
	else
	{
		$agree = $_POST['agree'];
	}
	
	if(false === $error)
	{
		//Validation Success!
		//Do form processing like email, database etc here
		
		header('Location: thank-you.html');
	}
}
?>
<!DOCTYPE html>
<html >
<head>
    <title>Cake Form</title>
    <link href="cakeform.css" rel="stylesheet" type="text/css" />
</head>
	<body >
    <div id="wrap">
        <form method="post" action='?' id="cakeform" >
        <div>
            	<div class="cont_order">
               <fieldset>
                <div class='field_container'>
                    <label for="time">Select time:</label >
					<span class='error'><?php echo $time_error?></span>
                    <select id="time" name='time' >
                    <option value="">Select time</option>
                    <option <?php echo $time=='1'?'selected':''; ?> >8:00–9:05</option><!-- MWF START -->
                    <option <?php echo $time=='2'?'selected':''; ?> >9:20-10:25</option>
                    <option <?php echo $time=='3'?'selected':''; ?> >10:40–11:45</option>
                    <option <?php echo $time=='4'?'selected':''; ?> >12:00–1:05</option>
                    <option <?php echo $time=='5'?'selected':''; ?> >1:20–2:25</option>
                    <option <?php echo $time=='6'?'selected':''; ?> >2:40–3:45</option>
                    <option <?php echo $time=='7'?'selected':''; ?> >4:00–5:05</option>
                    <option <?php echo $time=='8'?'selected':''; ?> >5:20–6:55</option> <!-- MWF END -->
                    <option <?php echo $time=='9'?'selected':''; ?> >8:00–9:35</option> <!-- MW START -->
                    <option <?php echo $time=='10'?'selected':''; ?> >7:10–8:45</option> <!-- MW END -->
                    <option <?php echo $time=='11'?'selected':''; ?> >8:00–9:35</option> <!-- TTH START -->
                    <option <?php echo $time=='12'?'selected':''; ?> >9:50–11:25</option>
                    <option <?php echo $time=='13'?'selected':''; ?> >11:40–1:15</option>
                    <option <?php echo $time=='14'?'selected':''; ?> >1:30–3:05</option>
                    <option <?php echo $time=='15'?'selected':''; ?> >3:20–4:55</option>
                    <option <?php echo $time=='16'?'selected':''; ?> >5:20–6:55</option>
                    <option <?php echo $time=='17'?'selected':''; ?> >7:10–8:45</option> <!-- TTH END -->
                   </select>
                </div>
                <div class='field_container'>
                    <label >Dates:</label>
					<span class='error'><?php echo $dates_error ?></span>
					
                    <label><input type="checkbox" value="M-W-F" name='Dates[]' 
					<?php echo (in_array('M-W-F',$dates)) ?'checked':'' ?> />M-W-F</label>
					
                    <label><input type="checkbox" value="T-TH" name='Dates[]' 
					<?php echo (in_array('T-Th',$dates)) ?'checked':'' ?> />T-TH</label>
					
                    <label><input type="checkbox" value="M-W" name='Dates[]' 
					<?php echo (in_array('M-W',$dates)) ?'checked':'' ?> />M-W</label>
               </div>
              </fieldset>
              </div>
            </div>
            
        	<div class="cont_details">
            	<fieldset>
                <legend>Contact Details</legend>
                <label for='event'>Class Name</label>
                <input type="text" id="event" name='event' 
				value='<?php echo htmlentities($event) ?>' />
				
				<span class='error'><?php echo $event_error ?></span>
                <br/>
                <label for='address'>Location</label>
                <input type="text" id="address" name='address' 
                value='<?php echo htmlentities($address) ?>' />
                <span class='error'><?php echo $address_error ?></span>
                <br/>
                </fieldset>
            </div>
            <input type='submit' name='submitted' id='submit' value='Submit'  />
        </div>  
       </form>
	</div>

</body>
</html>