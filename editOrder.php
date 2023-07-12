<?php 
include 'core.php';
$core= new core();
include 'head.php';
$msg='';
$vname=$VNetIncome=$VfullIncome='';
if (isset($_POST['orderId'])  ) 
{
    $id=$_POST['orderId'];
	if(isset($_POST['duration']) )
	{

				$res=$core->updatePeriod($_POST['duration'],$id);
				if($res)
				{
					$msg    = 'Hecho!';
					$Resultado1='00Actualización del periodo de forma correcta';					
				}
				else
				{
					$msg    = 'Error';
					$Resultado1='01No es posible realizar la actualización intente mas tarde';		
				}
	}
    $dataOrd=$core->getOrdersbyId($id);
    $nombreFull=$destino=$monto=$Folio=$periodo='';
	if(sizeof($dataOrd)>0)
	{
        $Folio=$id;
		$nombreFull=$dataOrd['nameApp'].' '.$dataOrd['lastName'];	
		$destino=$dataOrd['name'];	
		$monto=$dataOrd['amount'];	
		$periodo=$dataOrd['period'];	
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
				<form method="POST" action="editOrder.php">
					
                    <div class="row">
						<div class="col-lg-2">
							<label class="control-label">Folio:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" disabled required class="form-control" value="<?php echo $Folio; ?>" name="nameApp" >
						</div>
					</div>
					<br>
					
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
							<label class="control-label">Destino:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" required class="form-control" disabled value="<?php echo $destino; ?>" name="nameCompany" >
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Monto:</label>
						</div>
						<div class="col-lg-10">
							<input type="number"disabled value="<?php echo $monto; ?>" class="form-control" name="fullIncome" >
							<input type="hidden" value="<?php echo $Folio; ?>" class="form-control" name="orderId" >
						
                        </div>
					</div>
					<br>
					
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">plazo en años</label>
						</div>
						<div class="col-lg-10">
							<select class="form-control" name="duration" required>
                            <option value="<?php echo $periodo; ?>"><?php echo $periodo; ?></option>
							
                            <?php for($i=1;$i<=10;$i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
            	
							</select>
                		</div>
					</div>
					<br>
					
				
					<br><br>
					<div class="row">
						<div class="col-lg-4">
						<a href="index.php" class="btn btn-success"> Regresar</a>
		
						<input type="submit" value="Actualizar" class="btn btn-primary" >
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

 

  