<!DOCTYPE html>
<html>
<body>
	<div style="padding:10px 7px; font-weight:bold">
		<h3>WHISTLE BLOWER NOTIFICATION</h3>
	</div>
	<table>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">NAME:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $fullname !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">EMAIL:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $email !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">LOCATION:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $incident_location !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">EXTRA INFO:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $incident_extra_info !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">DESCRIPTION:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! nl2br($incident_description) !!}</td>
		</tr>
		<tr style="color:#aaa; font-weight:600">
			<td colspan="2" style="padding:10px 5px; border-bottom:1px solid #ccc">
				This email is meant for Gaming Board of Tanzania.<b>
				If you received it by mistake, please ignore it.
			</td>
		</tr>
	</table>
</body>
</html>