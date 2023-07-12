<?php 
include 'core.php';
$core= new core();
include 'head.php';
$msg='';
$fecha1=date("Y-m-d",strtotime(date("Y-m-d")."- 18 years"));
    
$vname=$vlastname=$vage=$vCurp=$vCP=$Vstate=$VCity=$Vaddress=$vemail='';
if (isset($_POST['nameApp']) && isset($_POST['lastname']) ) 
{
	$inputName    =  htmlentities($_POST['nameApp']) ; 
    $inputlastName = htmlentities( $_POST['lastname'] );  
	$inputAge = $_POST['age'] ; 
    $inputsex = $_POST['sex'] ; 
	$inputdatebirth = $_POST['datebirth'] ; 
	$inputCurp = $_POST['curp'] ;
    $inputemail      =  $_POST['email'] ;
    $inputCity            = htmlentities( $_POST['city'] );
    $inputState            = htmlentities( $_POST['state'] );
    $inputCP            = $_POST['zip'];
    $inputAddress            = htmlentities( $_POST['address'] );
	
	if(filter_var($inputemail, FILTER_VALIDATE_EMAIL))
	{
		if(strlen($inputName)>3 && strlen($inputName)<61)
		{
			if(strlen($inputlastName)>10 && strlen($inputName)<201)
			{
				if(strlen($inputCurp)==18)
				{
					if(strlen($inputCity)>3 && strlen($inputCity)<81)
					{
						if(strlen($inputState)>3 && strlen($inputState)<41)
						{
							if(strlen($inputAddress)>20 && strlen($inputAddress)<251)
							{
								if(strlen($inputemail)>10 && strlen($inputAddress)<101)
								{
									if($inputAge>18)
									{
										if(sizeof($core->validateCurp($inputCurp))<1)
										{
											if(sizeof($core->validateemail($inputemail))<1)
											{
												$res=$core->InsertApplicant(html_entity_decode($inputName),html_entity_decode($inputlastName),$inputAge,$inputdatebirth,$inputsex,$inputCurp,html_entity_decode($inputAddress),html_entity_decode($inputCity),html_entity_decode($inputState),$inputCP,$inputemail);
												if($res)
												{
													$msg    = 'Hecho!';
													$Resultado1='00Alta de solicitante correcto';					
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
												$Resultado1='01El correo ingresado ya existe, es necesario cambiarlo';	
											}	
										}
										else
										{
											$msg    = 'Error';
											$Resultado1='01La CURP ingresada ya existe, es necesario cambiarlo';	
										}
									}
									else
									{
										$msg    = 'Error';
										$Resultado1='01Debes ser mayor de edad para registrarte';	
										}
		
								}
								else
								{
									$msg    = 'Error';
									$Resultado1='Tamaño del campo correo no valido';	
								}
							}
							else
							{
								$msg    = 'Error';
								$Resultado1='01Tamaño del campo dirección no válido';				
							}
						}
						else
						{
							$msg    = 'Error';
							$Resultado1='01Tamaño del campo estado no válido';				
						}
					}
					else
					{
						$msg    = 'Error';
						$Resultado1='01Tamaño del campo ciudad no válido';				
					}
					
				}
				else
				{
					$msg    = 'Error';
					$Resultado1='01Tamaño del CURP no válido';				
				}
			}
			else
			{
				$msg    = 'Error';
				$Resultado1='01Tamaño de los apellidos no válido';				
			}
				
		}
		else
		{
			$msg    = 'Error';
			$Resultado1='01Tamaño del nombre no válido';				
		}
	}
	else
	{
		$msg    = 'Error';
		$Resultado1='01Formato de correo no válido';
	}
	if(substr($Resultado1, 0, 2) <> '00' )
    {
        $vname=$inputName;
        $vlastname=$inputlastName;
        $vage=$inputAge;
        $vCurp=$inputCurp;
        $vCP=$inputCP;
        $Vstate=$inputState;
        $VCity=$inputCity;
        $Vaddress=$inputAddress;
	    $vemail=$inputemail;
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
		<h4>Este módulo permite dar de alta a los solicitantes</h4>
    	<br>
        <div class="container-fluid">
				<form method="POST" action="addApplicants.php">
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Nombre:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" required class="form-control" value="<?php echo $vname; ?>" name="nameApp" >
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Apellidos:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" required class="form-control" value="<?php echo $vlastname; ?>" name="lastname">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Edad:</label>
						</div>
						<div class="col-lg-10">
							<input type="number" required class="form-control" min="1" max="130" step="1" value="<?php echo $vage; ?>" name="age" maxlength="3" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
						</div>
					</div>
					<br>					
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Fecha de nacimiento:</label>
						</div>
						<div class="col-lg-10">
							<input type="date" required max="<?php echo $fecha1; ?>" min="1890-01-01" class="form-control" name="datebirth">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Sexo</label>
						</div>
						<div class="col-lg-10">
							<select class="form-control" id="sex" name="sex" required>
                                <option value="M">Masculino</option>
							    <option value="F">Femenino</option>
							</select>
                		</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">CURP:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" required class="form-control" value="<?php echo $vCurp; ?>" name="curp" maxlength="18" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Correo:</label>
						</div>
						<div class="col-lg-10">
							<input type="email" required class="form-control" value="<?php echo $vemail; ?>" name="email">
						</div>
					</div>				
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Código postal:</label>
						</div>
						<div class="col-lg-10">
							<input type="number" max="99999" min="1111" value="<?php echo $vCP; ?>" class="form-control" name="zip" maxlength=5" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Estado:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" value="<?php echo $Vstate; ?>" name="state">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Ciudad:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" value="<?php echo $VCity; ?>" name="city">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-lg-2">
							<label class="control-label">Dirección:</label>
						</div>
						<div class="col-lg-10">
							<input type="text" class="form-control" value="<?php echo $Vaddress; ?>" name="address">
						</div>
					</div>

					
					<br><br>
					<div class="row">
						<div class="col-lg-4">
						<a href="applicants.php" class="btn btn-success"> Regresar</a>
		
						<input type="submit" value="Guardar" class="btn btn-primary" ></button>
						</div>
					</div>
                </div> 
                </form>
	<?php include 'footer.php';?>

 

  