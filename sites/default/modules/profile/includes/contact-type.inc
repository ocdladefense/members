<?php

//display table for contact types
function profile_contact_type($pf,$occupation)
{
	
	$content = profile_content();

	$note 							= $occupation["note"];
	$contact_id 				= $occupation["member_id"];
	$id 								= $occupation["id"];
	
	$content .=
	"
	<input type='hidden' name='ocdla_profiles_contact_type_action' value='submit' />
	<tr>
		<td width='50px'>&nbsp;</td>
		<td width='150px' align='left'>
			Occupation / Field:
		</td>
		<td align='right'>
			<select name='occupation' />".getContactTypes($note, false, $pf['member_status'] )."</select>
		</td>
		<td>
			<input type='hidden' name='occupationId' value='$id' />
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align='right'>
			<input type='hidden' name='ocdla_id' value='ocdla_profiles_contact_types' />
			<input type='submit' name='p_submit' value='Update' />
		</td>
	</tr>
	</table>
	</form>";

	return $content;
}

function occupation_load($memberId=null)
{
	global $user;
	if(!isset($memberId))
	{
		$memberId=$user->getMemberId();
	}
	$results = db_query('SELECT * FROM {member_interests} WHERE member_id=:1 AND note_type=:2', array($memberId,PROFILE_CONTACT_TYPE));

	return $results->fetch_assoc();
}