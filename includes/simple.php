<?php
/**
 * simple.php is a postback application designed to provide a 
 * contact form for users to email our clients.  
 * 
 * simple.php provides a typical feedback form for a website
 *
 * @package nmCAPTCHA2
 * @author Bill & Sara Newman <williamnewman@gmail.com>
 * @version 1.01 2015/11/17
 * @link http://www.newmanix.com/
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see contact_include.php 
 * @see recaptchalib.php
 * @see util.js 
 * @todo none
 */

#EDIT THE FOLLOWING:
$toAddress = "soph.m.allen@gmail.com";  //place your/your client's email address here
$toName = "Memories Webmaster"; //place your client's name here
$website = "blaszcak.family";  //place NAME of your client's website here
#--------------END CONFIG AREA ------------------------#
$sendEmail = TRUE; //if true, will send an email, otherwise just show user data.
$dateFeedback = true; //if true will show date/time with reCAPTCHA error - style a div with class of dateFeedback
include_once 'config.php'; #site keys go inside your config.php file
include 'contact_include.php'; #complex unsightly code moved here
$response = null;
$reCaptcha = new ReCaptcha($secretKey);
if (isset($_POST["g-recaptcha-response"]))
{// if submitted check response
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
if ($response != null && $response->success)
    {#reCAPTCHA agrees data is valid (PROCESS FORM & SEND EMAIL)
        handle_POST($skipFields,$sendEmail,$toName,$fromAddress,$toAddress,$website,$fromDomain);             #Here we can enter the data sent into a database in a later version of this file
    ?>
    <!-- START HTML FEEDBACK -->
    <main class="inner">
        <h1>Thank You!</h1>
        <p>Your contribution has been sent. Please be patient while our webmaster (i.e. Sophie) adds your stories and suggestions to the site.</p>
        <p>If you have a pressing concern, or spot a bug in the website, please let Sophie know by <a href="mailto:soph.m.allen@gmail.com">sending her an email</a>. Thanks!</p>
        <p>Click <a href="index.html">here</a> to return to Julia's home page.</p>
    </main>    
    <!-- END HTML FEEDBACK -->        
    <?php
}else{#show form, either for first time, or if data not valid per reCAPTCHA 
    if($response != null && !$response->success)
    {
        $feedback = dateFeedback($dateFeedback);
        send_POSTtoJS($skipFields); #function for sending POST data to JS array to reload form elements
    }//end failure feedback
 
?>
	<!-- START HTML FORM -->
	<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="post">
    <h1>Send in a Contribution</h1>
	<div>
		<label>
			Name <br /><input type="text" name="Name" required="required" placeholder="Your name (will be used as author name, if sharing a story)" title="Name is required" tabindex="10" size="44"/>
		</label>
	</div>
    <div>
        <label>
            Relationship to Julia <br /><input type="text" name="Relationship" placeholder="Ex: Son, Granddaughter, Friend" title="optional" tabindex="10" size="44"/>
        </label>
    </div>
	<div>	
		<label>
			Email:<br /><input type="email" name="Email" required="required" placeholder="Where should we send follow-up questions?" title="A valid email is required" tabindex="20" size="44" />
		</label>
	</div>
	<!-- below change the HTML to your form elements - only 'Name' & 'Email' (above) are significant -->
	<div>	
		<label>
			What would you like to share? <br /><textarea name="Content" rows="8" placeholder="Write your memory, recipe, story or anything else you'd like to add to the website." tabindex="30"></textarea>
		</label>
	</div>	
    <div>
        <label>
            How should we categorize your contribution?<br/>
            <select name="Category">
                <option value="memory">Memory/Story</option>
                <option value="biography">Biographical Information</option>
                <option value="recipe">Recipe</option>
                <option value="other">Other (specify in instructions below)</option>
            </select>
        </label>
    </div>
    <div>
        <label>
            Special Instructions <br/>
            <textarea name="Instructions" rows="8" placeholder="Write your special instructions here. Ex: 'Please include a link to the photo of her in her white Navy uniform.' Or 'Put the words 'fifteen years old' in bold." tabindex="30"></textarea>
        </label>
    </div>
	<div><?=$feedback?></div>
    <div class="g-recaptcha" data-sitekey="<?=$siteKey;?>"></div> 
	<div>
		<input type="submit" value="Submit" />
	</div>
    </form>
	<!-- END HTML FORM -->
    <script type="text/javascript"
        src="https://www.google.com/recaptcha/api.js?hl=en">
    </script>
<?php
}
?>