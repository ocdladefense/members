<?php

function profile_ldoc_disclaimer($pf,$ldoc)
{
	// profile_udpate();

	$has_accepted = !empty($pf['ldoc_flag']);

$content = <<<EOF


<div id="ldoc_disclaimer" style="width:90%; height:200px; margin-top:15px; overflow:scroll; border:1px solid #666666;">
<h3 style="margin-bottom:8px;">Legal Document Library Disclaimer</h3>

<p>The material contained in the Legal Document Library is not reviewed by OCDLA for accuracy prior to posting. Please check all items in the Legal Document Library for accuracy and understand you use the material at your own risk. Use of the briefs presented in this format is for reference purposes only and not as a substitute for original research and writing. The briefs represent the work product of the attorney of record in each case, and the current state of the law may have changed since the brief was submitted.</p>

<p>The briefs provided are not part of the official court record. Official copies of the briefs are available at the court in which the brief was filed.</p>

<p>OCDLA is not responsible for the content of the briefs and makes no representations regarding the identity of any person named in the briefs and does not assume any liability resulting from the release or use of any information.</p>

<p>OCDLA makes no warranties about the accuracy, reliability, completeness, or timeliness of the material in this Legal Document Library.</p>

<p>Disclaimer of consequential damages: Except as otherwise required by applicable law, neither OCDLA nor its directors, employees, content providers, or other representatives will be liable for any damages whatsoever, including without limitation any direct, indirect, incidental, consequential, special and exemplary damages, arising from the use or performance of the Legal Document Library, even if OCDLA has been advised of the possibility of such damages.</p>

<p>Remedy: If you are dissatisfied with this Legal Document Library, or any portion thereof, your exclusive remedy shall be to cease using the Legal Document Library.</p>
</div><!-- end of disclaimer -->

EOF;

if ( !$has_accepted ) {
	$content .= <<<EOF
<br />
<form id="ocdla_ldoc_disclaimer" action="/profile/ldoc-disclaimer" method="post" onsubmit="">
<input type="hidden" name="ocdla_id" value="ocdla_ldoc_disclaimer" />
<input type="hidden" name="ocdla_ldoc_disclaimer_action" value="submit" />
<br />
I Agree: <input type="checkbox" name="ocdla_ldoc_disclaimer_i_agree" value="0" />&nbsp;&nbsp;&nbsp;
<input type="submit" name="ocdla_ldoc_disclaimer_submit" value="Submit" disabled="disabled" />
&nbsp;&nbsp;
<input type="submit" name="ocdla_ldoc_disclaimer_cancel" value="Cancel" />


</form>
EOF;
} else {
	$content .= <<<EOF
<br />
<form id="ocdla_ldoc_disclaimer" action="/profile/ldoc-disclaimer" method="post" onsubmit="">
<input type="hidden" name="ocdla_id" value="ocdla_ldoc_disclaimer" />
<input type="hidden" name="ocdla_ldoc_disclaimer_action" value="submit" />
<br />
</form>
EOF;

	$content .= "<p class=\"msg\">You've already accepted the Legal Document Library disclaimer.  Continue to the <a href=\"https://www.ocdla.org/members_only/ldoclib_newocdla.cfm\">Legal Document Library</a></p>";
}

	return $content;
}


function ldoc_load($memberId)
{
	return array();
}