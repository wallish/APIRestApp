<h3>Liste users</h3>
<table>
	<?php foreach ($this->variables['users'] as $key => $value) :?>
		<tr>
			<td><?php echo $value['id']?></td>
			<td><?php echo $value['username']?></td>
			<td><?php echo $value['password']?></td>
			<td><?php echo $value['api_secret_key']?></td>
			<td><?php echo $value['api_key']?></td>
			<td><a href='<?php echo $this->path(array('index', 'show'), array('id' => $value['id'])); ?>'>Afficher</a></td>
		</tr>
	<?php endforeach;?>
	<tr></tr>
</table>
