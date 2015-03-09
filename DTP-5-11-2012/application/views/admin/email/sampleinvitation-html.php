<p>Dear <?php echo $emaildata['firstname']; ?>,</p>

<p>You previously registered as a willing person to receive a Free bottle of wine for the purpose of presenting your opinion on the value of the wine with Ditch the Pitch.</p>

<p>It is our pleasure to advise you that we have now been presented a wine for sample distribution that is reasonably close to your preferred wine style preference.</p>

<p>Before sending you the sample, we require a few things from you.</p>

<p>1.	Your sample receipt postal details and<br>
2.	Your confirmation that you are willing to receive the sample bottle of wine according to the terms and conditions of the valuation exercise.</p>

<p>If you are familiar with our terms and conditions, the on-line process is reasonably straight forward.</p>
<p>
1. Follow the link for <a href="<?php echo site_url('sampleregistration/activate'). '/'. $emaildata['user_id'] . '/' . $emaildata['activationcode']; ?>">Ditchthepitch</a>.<br>
2. Locate the titled Confirm Sample Receipt<br>
3. Enter your email, <br>
4. Enter your password and<br>
5. The following unique code <b><?php echo $emaildata['activationcode']; ?></b>
 </p>

<p>From the time that we transmitted this email, you will have 96 hours to visit the website to complete the information that we require and confirm your participation. Should this time expire without us receiving your confirmation, then we will be unable to send you the wine for evaluation.</p>

<p>We look forward to receiving your confirmation of participation and postal details.</p>
<p>
Best wishes,<br>
The Ditch the pitch team.
</p>
