---
layout: default
---

<div class="w-section vpaas-sign-up-section">
    <div class="w-container vpaas-signup-container">
	<h1 class="section-headings vpaas-signup-heading">Sign Up &nbsp;<span class="divider-span">|</span> &nbsp;<span class="teal-span">Kaltura VPaaS</span></h1>
        <div class="sml-circle-row-wrapper">
	       <div class="w-row sml-circle-row">
	           <div class="w-col w-col-3 sml-circle-column"></div>
	       </div>
        </div>

<div >
<?php
require_once('/var/www/html/IP2Location-PHP-Module/IP2Location.php');
$signer_ip=$_SERVER['REMOTE_ADDR'];
$db = new \IP2Location\Database('/etc/IP2LOCATION-LITE-DB1.BIN', \IP2Location\Database::FILE_IO);
$excluded_countries=array('IR','SY','SD','CU','KP');
$records = $db->lookup($signer_ip, \IP2Location\Database::ALL);

if(in_array($records['countryCode'],$excluded_countries)){
    $msg='In compliance with U.S and applicable Export laws we are unable to process your request. Please contact legal@kaltura.com if you believe this to be an error.';
    die('<div class="radio-description">'.$msg.'</div>');
}
?>
    <div class="radio-description">Complete API access for all video workflows, player, widgets, SDKs, developer tools, forums &amp; Kaltura University. Create as many VPaaS Accounts as you need with centralized configuration &amp; consolidated billing across all accounts.</div>
</div>

<div class="w-form">
		
    <form id="register-form" name="register-form" data-name="Register Form" action="https://vpaas.kaltura.com:8443/post_register.php" method="post" onsubmit="return validate(event);">
<input type="hidden" id="ip" value="<?php echo $_SERVER['REMOTE_ADDR'];?>">
<div class="company-details-div">
<div class="w-row form-row">
<div class="w-col w-col-6">
    <label for="First-Name" class="form-labels">First Name</label>
    <input id="first-name" type="text" placeholder="Joe" name="first-name" data-name="First Name" required="required" class="w-input input-light">
    </div>
    <div class="w-col w-col-6">
    <label for="Last-Name" class="form-labels">Last Name</label>
    <input id="last-name" type="text" placeholder="Soap" name="last-name" required="required" data-name="Last Name" class="w-input input-light">
    </div>
</div>
<div class="w-row form-row">
    <div class="w-col w-col-6">
    <label for="email" class="form-labels">Work Email Address</label>
    <input id="email" type="email" placeholder="joesoap@mediaco.com" name="email" data-name="Email" required="required" class="w-input input-light">
    </div>
    <div class="w-col w-col-6">
    <label for="Company" class="form-labels">Company</label>
    <input id="company" type="text" placeholder="MediaCo Inc." name="company" required="required" data-name="Company" class="w-input input-light">
    </div>
</div>
<div class="w-row form-row">
    <!--div class="w-col w-col-6">
    <label for="title" class="form-labels">Job Title</label>
    <input id="jobtitle" type="text" name="jobtitle" class="w-input input-light">
    </div-->
    <div class="w-col w-col-6">
<label for="Industry" class="form-labels">Industry</label>
<select id="industry" name="industry" required="required" data-name="Industry" class="w-select input-light">
<option value="">Select one...</option>
<option value="Education or EdTech">Education or EdTech</option>
<option value="Media Owners &amp; Creators">Media Owners &amp; Creators</option>
<option value="Broadcasting">Broadcasting</option>
<option value="IPTV and Telcos">IPTV and Telcos</option>
<option value="AdTech / Advertising Agency">AdTech / Advertising Agency</option>
<option value="Health Care">Health Care</option>
<option value="Insurance">Insurance</option>
<option value="Retail / eCommerce">Retail / eCommerce</option>
<option value="FinTech / Investing / Banking">FinTech / Investing / Banking</option>
<option value="Real Estate">Real Estate</option>
<option value="Video Surveillance / Public Safety">Video Surveillance / Public Safety</option>
<option value="IoT / Smart Cities">IoT / Smart Cities</option>
<option value="Manufacturing">Manufacturing</option>
<option value="Construction">Construction</option>
<option value="Transportation / Utilities / Energy">Transportation / Utilities / Energy</option>
<option value="Government">Government</option>
<option value="Registered Not Profit Org">Registered Not for Profit Organization</option>
<option value="Software Provider / ISV">Software Provider / ISV</option>
<option value="Cloud, Hosting or Streaming Providers">Cloud, Hosting or Streaming Providers</option>
<option value="Systems Integrator">Systems Integrator</option>
</select>
    </div>
    <div class="w-col w-col-6">
    <!--label for="title" class="form-labels">Job Title</label>
    <input id="jobtitle" type="text" name="jobtitle" class="w-input input-light"-->

<label for="Tel-us-what-you-are-building" class="form-labels">Tell Us About What You Are Building</label>
    <input id="description" type="text" name="description" class="w-input input-light"-->

    </div>
</div>





<!--div class="w-row form-row no-column-padding">
<label for="Tel-us-what-you-are-building" class="form-labels">Tell Us About What You Are Building</label>
<textarea id="description" placeholder="What are you building, tell us about your team, how does video fit into your application, etc." name="description" data-name="Tel us what you are building" required="required" class="w-input input-light"></textarea>
</div-->
<div class="w-row form-row no-column-padding">
	<div class="g-recaptcha" data-sitekey="6Lf2bx8TAAAAAFiXASujAbfTnbBr7H6cqUbHLnnE"></div>
</div>
</div>



<div>
<div class="w-checkbox terms-checkbox">
<input id="Terms-Checkbox" type="checkbox" name="Terms-Checkbox" data-name="Terms Checkbox" required="required" class="w-checkbox-input">
<label for="Terms-Checkbox" class="w-form-label">Terms &amp; Conditions</label>
</div>
</div>
    <ul class="w-list-unstyled">
        <li class="temp-list"><span class="feature-bullets fa fa-chevron-right"></span>Pay-As-You-Go. For full pricing details, visit our <a class="pricing-pg-inline-link" href="pricing.html">Pricing Page</a>
        </li>
        <li class="temp-list"><span class="feature-bullets fa fa-chevron-right"></span>$400/month VPaaS credit for the first 12 months following sign-up (subject to conditions listed on the <a class="pricing-pg-inline-link" href="/pricing.html">Pricing Page</a>)</li>
        <li class="temp-list"><span class="feature-bullets fa fa-chevron-right"></span>You will be invoiced on a monthly basis for all usage generated via your VPaaS account(s) at the rates specified on the Pricing Page</li>
        <li class="temp-list"><span class="feature-bullets fa fa-chevron-right"></span>You agree to receive invoices at the e-mail address you have provided in the registration form</li>
    </ul>
<p class="signup-body">By checking the box above, you acknowledge that you have read and that you agree to the Kaltura VPaaS Customer Agreement available at: <a class="terms-link" href="http://vpaas.kaltura.com/Kaltura_VPaaS_Customer_Agreement.pdf">http://vpaas.kaltura.com/Kaltura_VPaaS_Customer_Agreement.pdf</a>, the terms and conditions described above, and the terms and conditions described on the <a class="pricing-pg-inline-link" href="/pricing.html">Pricing Page.</a></p>
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
	    $("#submitButton").prop('value', "We're creating your account, please wait...");
	return true;
}

</script>

