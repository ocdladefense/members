<?php
//-------------------------------------------------------------
// show different kinds of data based on the requested page
//-------------------------------------------------------------


function profile_contact_info($pf,$contact)
{
	
	$content = profile_content();

	//display form for contact information
	$fm_record_id = $pf["fm_record_id"];
	$title = $pf["title"];
	$first = $pf["name_first"];
	$middle = $pf["name_middle"];	
	$last = $pf["name_last"];
	$suffix = $pf["suffix"];
	$company = $pf["name_company"];
	$bar = $pf["bar_number"];
	$psid = $pf["PSID"];
	$status = $pf["member_status"];
	$work = phoneNumberFormat( $contact['work']['value'] );
	$cell = phoneNumberFormat( $contact['cell']['value'] );
	$fax = phoneNumberFormat( $contact['fax']['value'] );
	$email = $contact['email']['value'];
	$pond_email = $pf["pond_email"];
	$www = $pf["address_www"];
	
	$email_id = $contact['email']['id'];
	$work_id = $contact['work']['id'];
	$cell_id = $contact['cell']['id'];
	$fax_id = $contact['fax']['id'];
	$pond_id = $pf["pond_email_id"];

		
		$content .= <<<EOF
<input type="hidden" name="ocdla_id" value="ocdla_profiles_contact" />
<input type="hidden" name="ocdla_profiles_contact_action" value="submit" />
<input type="hidden" name="fm_record_id" value="$fm_record_id" />
				<tr> 
					<td align='right' style="font-size:8pt;">Title:</td><td><input size="8" type="text" name="p_title" value="$title" readonly="readonly" style="background-color:#eee;" /></td>
				</tr>	
				<tr> 
					<td align='right' style="font-size:8pt;">First Name:</td><td><input type="hidden" name="p_fm_record_id" value="$fm_record_id" /><input size="10" type="text" name="p_first" value="$first" /></td>
				</tr>
				<tr> 
					<td align='right' style="font-size:8pt;">Middle Name:</td><td><input size="10" type="text" name="p_middle" value="$middle" /></td>
				</tr>
				<tr>
					<td align='right' style="font-size:8pt;">Last Name:</td><td><input size="11" type="text" name="p_last" value="$last" />&nbsp; &nbsp;Suffix:&nbsp;<input size="4" type="text" name="p_suffix" value="$suffix" /></td>
				</tr>
				<tr>
					<td align='right' style="font-size:8pt;"></td>
				</tr>
				<tr>
					<td align='right' style="font-size:8pt;">Company:</td><td><input type="text" name="p_company" value="$company" /></td>
				</tr>
				<tr>
					<td align='right' style="font-size:8pt;">Bar Number:</td><td><input size="7" type="text" name="p_bar" value="$bar" /></td>
				</tr>
				<tr>
					<td align='right' style="font-size:8pt;">DPSST:</td><td><input size="7" type="text" name="p_psid" value="$psid" /></td>
				</tr>
				<tr> 
					<td align='right'>Work Phone:</td><td><input size="13" id="p_work" type="text" name="p_work" value="$work" /><input type="hidden" name="p_work_id" value="$work_id" />&nbsp;&nbsp;<span style="font-size:8pt; font-style:italic;color:#666666;">e.g., (541) 123-4567</span></td>
				</tr>
				<tr>
					<td align='right'>Cell Phone:</td><td><input size="13" type="text" name="p_cell" value="$cell" /><input type="hidden" name="p_cell_id" value="$cell_id" /></td>
				</tr>
				<tr>
					<td align='right'>Fax Number:</td><td><input size="13" type="text" name="p_fax" value="$fax" /><input type="hidden" name="p_fax_id" value="$fax_id" /></td>
				</tr>
				<tr>
					<td align='right'>Email:</td><td><input type="text" name="p_email" value="$email" MAXLENGTH="75" /><input type="hidden" name="p_email_id" value="$email_id" />&nbsp;&nbsp;<span style="font-size:8pt; font-style:italic;color:#666666;">e.g., jdoe@example.com</span></td>
				</tr>
				<tr>
					<td align='right'>Pond Email:</td><td><input type="text" name="p_pond_email" value="$pond_email" MAXLENGTH="75"  /><input type="hidden" name="p_pond_email_id" value="$pond_id" /></td>
				</tr>
				<tr>
					<td align='right'>Web Address (URL):</td><td><input type="text" name="p_www" value="$www" />&nbsp;&nbsp;<span style="font-size:8pt; font-style:italic;color:#666666;">e.g., www.example.com</td><td class="demo" ></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>
						<input type='submit' name='p_submit' value='Update' />
					</td>
				</tr>
			</table>
		</form>
EOF;
	return $content;
}


function contact_info_load($memberId=null)
{
	global $user;
	if(!isset($memberId)) $memberId = $user->getMemberId();
	$stmt = db_query('SELECT * FROM {member_contact_info} WHERE contact_id=:contactId',
		array(':contactId'=>$memberId),
		'pdo',
		false);
	$results = $stmt->fetchAll();

	$contactInfo = array();
	foreach($results AS $result)
	{
		$contactInfo[$result['type']] = $result;
	}
	return $contactInfo;
}