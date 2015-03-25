
	    <div class="row vertical-offset-100">
	    	<div class="col-md-12" style="background: white;">
	    			<div class="row">
	    				<div class="col-md-9">
	    					<a href="user/insert" class="btn btn-default">Insertar nuevo</a>
	    				</div>
	    			</div>
	    		<table class="table">
	    			<thead>
	    				<tr>
	    					<th>Nombre</th>
	    					<th>Apellido</th>
	    					<th>Usuario</th>
	    					<th>Contrasena</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				<?php foreach ($users as $line): ?>
	    					<tr>
	    						<td> <?php echo $line['firstName'] ?> </td>
	    						<td> <?php echo $line['lastName'] ?> </td> 
	    						<td> <?php echo $line['user'] ?> </td>
	    						<td> <?php echo $line['password'] ?> </td>
	    					</tr>
	    				<?php endforeach ?>
	    			</tbody>
	    		</table>
	    	</div>
		</div>