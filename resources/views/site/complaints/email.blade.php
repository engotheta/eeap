<!DOCTYPE html>
<html>
<body>
	<div style="padding:10px 7px; font-weight:bold">
		<h3>FEEDBACK, COMPLAINT or OPINION</h3>
	</div>
	<table>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">NAME:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $names !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">EMAIL:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $email !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">ORGANIZATION:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $organization !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">PHONE:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $phone !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">SUBJECT:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! $subject !!}</td>
		</tr>
		<tr style="">
			<td style="padding:5px; border-bottom:1px solid #ccc">MESSAGE:</td>
			<td style="padding:5px; border-bottom:1px solid #ccc">{!! nl2br($text) !!}</td>
		</tr>
		<tr style="color:#aaa; font-weight:600">
			<td colspan="2" style="padding:10px 5px; border-bottom:1px solid #ccc">
				This email is meant for GBT Complaints.<b>
				If you received it by mistake, please ignore it.
			</td>
		</tr>
	</table>
</body>
</html>