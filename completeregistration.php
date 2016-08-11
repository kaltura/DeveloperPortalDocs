---
layout: default
---
<?php 
$firstname='';
$lastname='';
$email='';
$company='';
if (isset($_GET['firstname'])){
	$firstname=$_GET['firstname'];
}
if (isset($_GET['lastname'])){
	$lastname=$_GET['lastname'];
}
if (isset($_GET['email'])){
	$email=$_GET['email'];
}
if (isset($_GET['company'])){
	$company=$_GET['company'];
}
?>

<div class="w-section vpaas-sign-up-section">
    <div class="w-container vpaas-signup-container">
	<h1 class="section-headings vpaas-signup-heading">Schedule a free consultation with our expert</h1>
        <div class="sml-circle-row-wrapper">
	       <div class="w-row sml-circle-row">
	           <div class="w-col w-col-3 sml-circle-column"></div>
	       </div>
        </div>

<div >
    <div class="radio-description">To improve your experience with Kaltura VPaaS, please tell us more about yourself.</br>We'll contact you for a free consulting session on how to best implement your project.</div>
</div>

<div class="w-form">
		
    <form id="register-form" name="register-form" data-name="Register Form" action="https://vpaas.kaltura.com:8443/post_completeregistration.php" method="post" onsubmit="return validate(event);">
 <legend class="form-labels"><b>About you</b></legend><hr>
    <input id="email" type="hidden" value="<?php echo $email;?>"  name="email" >
    <input id="firstname" type="hidden" value="<?php echo $firstname;?>"  name="firstname" >
    <input id="lastname" type="hidden" value="<?php echo $lastname;?>"  name="lastname" >
    <input id="company" type="hidden" value="<?php echo $company;?>"  name="company" >
<div class="w-row form-row">
    <div class="w-col w-col-6">
<label for="country" class="form-labels">Country</label>
<select id="country" name="country" data-name="Country" required="required" class="w-select input-light">
</select>
    </div>
    <script type="text/javascript">initCountry(""); </script>

    <div class="w-col w-col-6">
    <label for="Phone" class="form-labels">Phone</label>
    <input id="phone" type="text" placeholder="" name="phone" required="required" data-name="Phone" class="w-input input-light">
    </div>
<div class="w-row form-row">
    <div class="w-col w-col-6">
    <label for="title" class="form-labels">Job Title</label>
    <input id="jobtitle" type="text" name="jobtitle" class="w-input input-light">
    </div>


</div>

 <legend class="form-labels"><b>About your project</b></legend><hr>
<div class="w-row form-row">
    <div class="w-col w-col-6">
    <label for="other-platform" class="form-labels">Is there any other video platform you are using currently?</label>
    <textarea id="other-platform" name="other-platform" data-name="" class="w-input input-light"></textarea>
    </div>
    <div class="w-col w-col-6">
    <label for="specific-features" class="form-labels">Any specific features you are interested in?</label>
    <textarea id="specific-features" name="specific-features" class="w-input input-light"></textarea>
    </div>
</div>
<div class="w-row form-row">
    <div class="w-col w-col-6">
    <label for="what-are-you-building" class="form-labels">What are you building?</label>
    <textarea id="what-are-you-building" name="what-are-you-building" data-name="" class="w-input input-light"></textarea>
    </div>
</div>

 <legend class="form-labels"><b>Help us be better</b></legend><hr>
<div class="w-row form-row">
    <div class="w-col w-col-6">
    <label for="how-did-you-hear-about-us" class="form-labels">How did you hear about us?</label>
    <input id="how-did-you-hear-about-us" type="text" placeholder="" name="how-did-you-hear-about-us" data-name="" class="w-input input-light">
    </div>
    <div class="w-col w-col-6">
    <label for="additional-questions" class="form-labels">Any suggestions or comments about Kaltura VPaaS?</label>
    <input id="additional-questions" type="text" name="additional-questions" class="w-input input-light">
    </div>
</div>


<div class="w-row form-row no-column-padding">
	<div class="g-recaptcha" data-sitekey="6Lf2bx8TAAAAAFiXASujAbfTnbBr7H6cqUbHLnnE"></div>
</div>
</div>



</div>
<div class="button-center-div">
<input type="submit" id="submitButton" value="Submit" data-wait="Please wait..." data-ix="show-pick-account-type" class="w-button standard-button vpaas-signup-btn">
</div>
</form>
<div class="w-form-done"><p>Thank you! Your submission has been received!</p></div>
<div class="w-form-fail"><p>Oops! Something went wrong while submitting the form</p></div>
<script>

function validate(event)
{
    if (!verify_recapcha()){
	return false;
    }
    // this is needed only for browsers that do not support the HTML5 'required' attribute. AKA - Safari.
    $('[required]').each(function() {
	if ( this.id == 'email' ){
	    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;  
	    if(! $(this).val().match(mailformat)){
		alert("Please input a valid email address");  
		$(this).focus();
		event.preventDefault();
		return false;
	    }
	}

	if ( $(this).val() == '' ){
	    alert("Please fill all fields.");
	    $(this).focus();
	    event.preventDefault();
	    return false;
	}
    });  
	    $("#submitButton").prop('disabled', true);
	    $("#submitButton").prop('value', "Please wait...");
	return true;
}

</script>

