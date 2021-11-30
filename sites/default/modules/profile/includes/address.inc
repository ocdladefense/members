<?php

function profile_address($pf) {

	$content = profile_content();
	$address1 = $pf["address_line_1"];
	$address2 = $pf["address_line_2"];
	$city = $pf["address_city"];
	$county = $pf["address_county"];
	$state = $pf["address_state"];
	$zip = $pf["address_zip"];
	$id = $pf["addid"];
	$fm_record_id = $pf["addid"];

	
	$content .= <<<EOF
<input type="hidden" name="ocdla_id" value="ocdla_profiles_addresses" />
<input type="hidden" name="ocdla_profiles_addresses_action" value="submit" />
<input type="hidden" name="id" value="$id" />
			<tr> 
				<td align="right">Address Line 1:</td><td><input type="text" name="address1" value="$address1" /></td>
			</tr>
			<tr>
				<td align="right">Address Line 2:</td><td><input type="text" name="address2" value="$address2" /></td>
			</tr>
			<tr>
				<td align="right">City:</td><td><input type="text" name="city" value="$city" size="17" /></td>
			</tr>
			<tr>
				<td align="right">State:</td><td><select name="state"><option value="{$state}" SELECTED>{$state}</option><option value="OR">OR</option><option value="WA">WA</option><option value="CA">CA</option></select></td>
			</tr>
			<tr>
				<td align="right">Zip:</td><td><input type="text" name="zip" value="$zip" size="11" /></td>
			</tr>
			<tr>
				<td align="right">County:</td><td><input type="text" name="county" value="$county" size="14" /></td>
			</tr>
			<input type="hidden" name="fm_record_id" value="$fm_record_id" />
EOF;
			
			$content .="<tr style='padding-top:7px;'><td>&nbsp;</td><td><input type='submit' name='submit' value='Update' /></td></tr></table></form>";
			return $content;
}


