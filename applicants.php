<?php 
include 'head.php';
include 'core.php';
$core = new core();
$dataAplicant=$core->getAllApplicant();
?>
				
	
		<br>
		<h4>Este módulo permite ver los solicitantes que existen en el sistema</h4>
    	<br><br>
		<a href="addApplicants.php" class="btn btn-primary"> Agregar solicitante</a>
		<br>
		<br>
			<table class="table table-striped">
				<caption>Listado de solicitudes</caption>
				<thead>
					<th>Nombre</th>
					<th>Apellidos</th>
					<th>CURP</th>
					<th>correo</th>
					<th>Nuevo Ingreso</th>
					<th>Listado Ingresos</th>

				</thead>
				<tbody>
				<?php foreach($dataAplicant AS $DA)
				{
				?>
					<tr>
						<td><?php echo $DA['nameApp'];?></td>
						<td><?php echo $DA['lastName'];?></td>
						<td class="curp"><?php echo $DA['CURP'];?></td>
						<td><?php echo $DA['emailApp'];?></td>
						<td>
							<form name="submitForm" id="submitForm" method="POST" action="addIncome.php">
								<input type="hidden" name="curpApp" value="<?php echo $DA['CURP'];?>">
								<input type="submit" value="Nuevo Ingreso" title="Añadir Ingreso" class="btn btn-primary" >
							</form>
						</td>
						<td>
							<form name="submitForm" id="submitForm" method="POST" action="Incomes.php">
								<input type="hidden" name="curp" value="<?php echo $DA['CURP'];?>">
								<input type="submit" value="Ingresos" title="Ver Ingresos" class="btn btn-primary" >
							</form>
						</td>
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
	<?php include 'footer.php';?>

 

  