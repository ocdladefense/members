<?php

//display table for interests
function profile_interests($pf,$interests)
{
	
	// print entity_toString($interests);exit;
	$content = profile_content('interests');
	// this line won't work anyways
	// $content = preg_replace( '/width=\'\d+px\'/','width=525px',$content);
	
	$content .= <<<EOF
<input type="hidden" name="ocdla_id" value="ocdla_profiles_interests" />
<input type="hidden" name="ocdla_profiles_interests_action" value="submit" />
<tr>
	<th>&nbsp;</th>
	<th>Add</th>
	<th>Delete</th>
	<th>Change</th>
	<th>Current Interests</th>
</tr>
EOF;

		for ($i=0; $i<count($interests) && $i<5; $i++)
		{
			$aoi = $interests[$i];
			$note_description = $aoi["note"];
			$id = $aoi["id"];
			
			$content .=
			"<tr>
				<input type='hidden' name='p_aoi_id[$i]' value='$id' />
				<td width='125px'>Area of Interest ".($i+1)."</td>
				<td align='center'><input type='radio' name='p_action[$i]' value='add' disabled /></td>";
			$content .= "
				<td align='center'><input type='radio' name='p_action[$i]' value='delete' /></td>";
			$content .= "
				<td align='center'><input type='radio' name='p_action[$i]' value='change' /></td>";
			$content .= "
				<td align='right'><select name='p_aoi[$i]' onChange='validateSelect(this);' />".getInterests( $note_description, false )."</select></td>
			</tr>";


		}//for
	
	//second for-loop display empty interests
		for(;$i<5;$i++)
		{
			$content .=
			"<tr>
				<input type='hidden' name='p_fm_aoi_id[$i]' value='' />
				<input type='hidden' name='p_aoi_id[$i]' value='' />
				<td width='125px'>Area of Interest ".($i+1)."</td>
				<td align='center'><input type='radio' name='p_action[$i]' value='add' /></td>";
			$content .= "
				<td align='center'><input type='radio' name='p_action[$i]' value='delete' disabled /></td>";
			$content .= "
				<td align='center'><input type='radio' name='p_action[$i]' value='change' disabled /></td>";
			$content .= "
				<td align='right'><select name='p_aoi[$i]' onChange='validateSelect(this);' ><option value='Choose an Interest' SELECTED>Choose an Interest</option>".getInterests( null, false )."</select></td>
			</tr>";	
		}//for
	
	$content .= "
			<tr>
				<td colspan='4'>&nbsp;</td>

				<td align='right'><input type='reset' name='clear' value='Reset Form' />&nbsp;<input type='submit' name='p_submit' value='Update' />";
	if($post_test=="true") $content .= "<input type='hidden' name='post_test' value='true' />";
	$content .= "			
				</td>
			</tr>
		</table>
	</form>";

	$crumbtrail .= '&nbsp;<a href="#" onClick="openRequestedPopup(); return false;"><img src="../images/help.gif" width="15px" height="15px" style="border:none;" /></a>';	
	return $content;
}

function interests_load($memberId)
{
	global $user;
	if(!isset($memberId)) $memberId = $user->getMemberId();
	$stmt = db_query('SELECT * FROM member_interests WHERE member_id=:memberid AND note_type=:type AND (flag IS NULL OR flag="n")',
		array(':memberid'=>$memberId,
			':type' => PROFILE_AREA_OF_INTEREST),
		'pdo',
		false
	);
	
	return $stmt->fetchAll();
}