<?php 
include 'core.php';
$core= new core();
include 'head.php';
$msg='';
if (isset($_POST['applicant']) && isset($_POST['destiny']) ) 
{
	$dataDestiny=$core->getDataDestiny($_POST['destiny']);
	$dataNetIncome=$core->getSumNetIncome($_POST['applicant']);
	$Amount    =  $_POST['Amount'] ; 
    $duration=$_POST['duration'];
		if($Amount<=$dataDestiny['maxAmount'])
		{
			if($dataNetIncome['Sum']>=$dataDestiny['netMinAmount'])
			{
				$validateOrder=$core->validateExistOrder($_POST['destiny'],$_POST['applicant']);
				if(sizeof($validateOrder)<1)
				{
					$res=$core->InsertOrder($duration,$Amount,$_POST['destiny'],$_POST['applicant']);
					if($res>0)
					{
						$msg    = 'Hecho!';
						$Resultado1='00Felicidades se ah concretado de manera correcta tu solicitud, número de folio : '.$res;					
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
					$Resultado1='01Ya existe una solicitud con el numero de folio : '.$validateOrder['idOrder'];	
				}
							
			}
			else
			{
				$msg    = 'Error';
				$Resultado1='01El salario minimo neto para la operación es: '.$dataDestiny['netMinAmount'];				
			}
				
		}
		else
		{
			$msg    = 'Error';
			$Resultado1='01El monto maximo a solicitar es : '.$dataDestiny['maxAmount'];				
		}
}
$dataDestiny=$core->getAllDestinity();
$applicants=$core->getApplicantbynetIncome();

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
		<h4>Este módulo permite realizar solicitudes de creditos para los solicitantes</h4>
    	<br>
        <div class="container-fluid">
				<form method="POST" action="addOrder.php">
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Nombre Solicitante:</label>
						</div>
						<div class="col-lg-10">
							<select class="form-control" name="applicant" required>
								<?php foreach($applicants AS $AP){
								?>
								<option value="<?php echo $AP['CURP']; ?>"><?php echo $AP['nameApp'].' '.$AP['lastName']; ?></option>
								<?php } ?>
            				</select>
                		</div>
					</div>
					<br>
					
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Destino</label>
						</div>
						<div class="col-lg-10">
							<select class="form-control" name="destiny" required>
								<?php foreach($dataDestiny AS $DA){
								?>
								<option value="<?php echo $DA['id']; ?>"><?php echo $DA['name']; ?></option>
								<?php } ?>
            				</select>
                		</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">plazo en años</label>
						</div>
						<div class="col-lg-10">
							<select class="form-control" name="duration" required>
                            <?php for($i=1;$i<=10;$i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
            	
							</select>
                		</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Monto:</label>
						</div>
						<div class="col-lg-10">
							<input type="number" required class="form-control" min="1" max="999999999" step="0.01" name="Amount" maxlength="9" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
						</div>
					</div>
					<br>					
					
					
					<br><br>
					<div class="row">
						<div class="col-lg-4">
						<a href="index.php" class="btn btn-success"> Regresar</a>
		
						<input type="submit" value="Guardar" class="btn btn-primary" ></button>
						</div>
					</div>
                </div> 
                </form>
	<?php include 'footer.php';?>

 

  