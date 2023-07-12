<?php 
include 'head.php';
include 'core.php';
if(isset($_POST['curp']))
{
    $core = new core();
    $dataIncomes=$core->getIncomesbyapplicant($_POST['curp']);    
?>
				
	
		<br>
		<h4>Este modulo permite ver los Ingresos de un solicitante</h4>
    	<br><br>
		<br>
		<br>
			<table class="table table-striped">
				<caption>Listado de ingresos</caption>
				<thead>
					<th>Nombre Sol</th>
					<th>Apellidos Sol</th>
					<th>CURP Sol</th>
					<th>Empresa</th>
					<th>Sueldo Bruto</th>
					<th>Sueldo Neto</th>
					<th>Fecha Alta</th>
				
                </thead>
				<tbody>
				<?php foreach($dataIncomes AS $DA)
				{
				?>
					<tr>
						<td><?php echo $DA['nameApp'];?></td>
						<td><?php echo $DA['lastName'];?></td>
						<td><?php echo $DA['CURP'];?></td>
						<td><?php echo $DA['nameCompany'];?></td>
						<td><?php echo $DA['fullIncome'];?></td>
						<td><?php echo $DA['netIncome'];?></td>
						<td><?php echo $DA['startEmployment'];?></td>
						
					</tr>
				<?php
				}
				?>
				</tbody>
			</table>
            <br>
            <a href="applicants.php" class="btn btn-success"> Regresar</a>
		
	<?php include 'footer.php';
	
}
else
{
	header( 'refresh:5;url=applicants.php' ); //Send dashboard

?>
<br>
	<div class="alert alert-danger">
		<button type="button" aria-hidden="true" class="close">×</button>
		<span><b> Error - </b> Información del solicitante no existe</span>
				</div>
	
				<?php
			
}
?>

 

  