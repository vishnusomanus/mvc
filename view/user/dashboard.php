<div class="dashboard_body">
	<div class="alert alert-success">
		Hi <?=$user->name ?>, Welcome
	</div>

	<table class="admin">
		<tr>
			<th>Total Hrs Completed in</th>
			<td>Total Time</td>
		</tr>
		<tr>
			<th>Analyst Hours</th>
			<td><?= $analyst_worksheet['total_analyst_hours']; ?></td>
		</tr>
		<tr>
			<th>Image Specialist Hours</th>
			<td><?= $analyst_worksheet['image_specialist_hours']; ?></td>
		</tr>
		<tr>
			<th>Medical Director Hours</th>
			<td><?= $analyst_worksheet['medical_director_hours']; ?></td>
		</tr>
	</table>
</div>