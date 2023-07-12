<?php 
include 'core.php';
$core= new core();
include 'head.php';
$msg='';
$vname=$VNetIncome=$VfullIncome='';
if (isset($_POST['curpApp'])  ) 
{
	$curp=$_POST['curpApp'];
	$dataapplicant=$core->validateCurp($curp);
	$nombreFull='';
	if(sizeof($dataapplicant)>0)
	{
		$nombreFull=$dataapplicant['nameApp'].' '.$dataapplicant['lastName'];
		
	}
	if(isset($_POST['nameCompany']) && isset($_POST['fullIncome']) && sizeof($dataapplicant)>0)
	{
		$inputName    =  htmlentities($_POST['nameCompany']) ; 
    	$fullIncome            = $_POST['fullIncome'];
    	$NetIncome            = $_POST['netIncome'];
		$typeIncome      =  $_POST['typeIncome'] ;
    	$documentIncome      =  htmlentities($_POST['documentIncome']) ;
		$startEmployee            =  $_POST['dateIncome']; 
		if(strlen($inputName)>3 && strlen($inputName)<201)
		{
			if($NetIncome<$fullIncome)
			{
			
				$res=$core->InsertIncome(html_entity_decode($inputName),$fullIncome,$NetIncome,$typeIncome,html_entity_decode($documentIncome),$startEmployee,$curp);
				if($res)
				{
					$msg    = 'Hecho!';
					$Resultado1='00Alta de ingreso correcto';					
				}
				else
				{
					$msg    = 'Error';
					$Resultado1='01No es posible realizar el alta intente mas tarde';		
				}
			}
			else
			{
				$msg    = 'Error';
				$Resultado1='01El salario neto no puede ser mayor al bruto';				
			}	
		}
		else
		{
			$msg    = 'Error';
			$Resultado1='01Tamaño del nombre de la empresa no válido';				
		}
	
		if(substr($Resultado1, 0, 2) <> '00' )
    	{
        $vname=$inputName;
        $VNetIncome=$NetIncome;
        $VfullIncome=$fullIncome;
		}
	}

?>
		<br>
		<?php if ( strlen( $msg ) == 6 ) { ?> 
    		<div class="alert alert-success">
                    <button type="button" aria-hidden="true" class="close">×</button>
                    <span><b> Exitoso - </b> <?php echo substr( $Resultado1, 2 ); ?></span>
                </div>
        <?php } elseif ( strlen( $msg ) == 5 ) { ?>
                <div class="alert alert-danger">
                    <button type="button" aria-hidden="true" class="close">×</button>
                    <span><b> Error - </b> <?php echo substr( $Resultado1, 2 ); ?></span>
                </div>
        <?php } ?>
		<br>
		<h4>Este módulo permite dar de alta los ingresos de un solicitante</h4>
    	<br>
        <div class="container-fluid">
				<form method="POST" action="addIncome.php">
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Nombre del solicitante:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" disabled required class="form-control" value="<?php echo $nombreFull; ?>" name="nameApp" >
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Nombre de la empresa:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" required class="form-control" value="<?php echo $vname; ?>" name="nameCompany" >
						</div>
					</div>
					<br>
									
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Fecha de Ingreso:</label>
						</div>
						<div class="col-lg-10">
							<input type="date" required  class="form-control" name="dateIncome">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Comprobante de Ingresos:</label>
						</div>
						<div class="col-lg-10">
							<select class="form-control" id="documentIncome" name="documentIncome" required>
                                <option value="Carta comprobante de ingresos">Carta comprobante de ingresos</option>
							    <option value="Recibos de nómina">Recibos de nómina</option>
								<option value="Recibos de pago por honorarios profesionales">Recibos de pago por honorarios profesionales</option>
								<option value="Recibos de pago por arrendamiento">Recibos de pago por arrendamiento</option>
								<option value="Movimiento de cuenta bancaria">Movimiento de cuenta bancaria</option>
							</select>
                		</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Tipo de empleo: </label>
						</div>
						<div class="col-lg-10">
							<select class="form-control" id="typeIncome" name="typeIncome" required>
                                <option value="Permanente">Permanente</option>
							    <option value="Por contrato">Por contrato</option>
								<option value="Independiente">Independiente</option>
								<option value="Informal">Informal</option>
							</select>
                		</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Salario bruto:</label>
						</div>
						<div class="col-lg-10">
							<input type="number" max="999999999" step="0.01" min="1" value="<?php echo $VfullIncome; ?>" class="form-control" name="fullIncome" >
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Salario neto:</label>
						</div>
						<div class="col-lg-10">
							<input type="number" max="999999999" step="0.01" min="1" value="<?php echo $VNetIncome; ?>" class="form-control" name="netIncome" >
							<input type="hidden" value="<?php echo $curp; ?>" class="form-control" name="curpApp" >
					
						</div>
					</div>
					<br>
				
				
					<br><br>
					<div class="row">
						<div class="col-lg-4">
						<a href="applicants.php" class="btn btn-success"> Regresar</a>
		
						<input type="submit" value="Guardar" class="btn btn-primary" >
						</div>
					</div>
                </div> 
                </form>
	<?php 
	
	include 'footer.php';
	
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

 

  