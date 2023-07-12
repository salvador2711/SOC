<?php 
include 'head.php';
include 'core.php';
$core = new core();
$dataOrders=$core->getAllOrdersActives();
?>
				
	
		<br>
		<h4>Este módulo permite ver las solicitudes que existen en el sistema</h4>
    	<br><br>
		<a href="addOrder.php" class="btn btn-primary"> Agregar Solicitud</a>
		<br><br>
			<table class="table table-striped">
				<caption>Listado de solicitudes Aprobadas</caption>
				<thead>
					<th>Folio</th>
					<th>Nombre Completo</th>
					<th>Destino</th>
					<th>Fecha Registro</th>
					<th>Opciones</th>
				</thead>
				<tbody>
				<?php foreach($dataOrders AS $DO)
				{
				?>
					<tr>
						<td><?php echo $DO['idOrder'];?></td>
						<td><?php echo $DO['nameApp'].' '.$DO['lastName'];?></td>
						<td><?php echo $DO['name'];?></td>
						<td><?php echo $DO['createRegister'];?></td>
						
						<td>
							<form name="submitForm" id="submitForm" method="POST" action="editOrder.php">
								<input type="hidden" name="orderId" value="<?php echo $DO['idOrder'];?>">
								<input type="submit" value="Editar Solicitud" class="btn btn-primary" >
							</form>
						</td>
					</tr>
				<?php
				}
				?>
				
				</tbody>
			</table>
	<?php include 'footer.php';?>

 

  