<?php
    class core 
    {

        protected $DBN      = 'SOC'; /*bd* */
        protected $dbUser   = 'adminmb';
        protected $dbPass   = 'eh+u|qpc*XpKPbrm1';
        protected $PDOCON   = NULL;

        public function __construct()
        {
            try 
            {
                $DSN            = 'mysql:host=localhost;dbname=' . $this->DBN;
                $DBH            = new PDO( $DSN, $this->dbUser, $this->dbPass );
                $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->PDOCON   = $DBH;
            } 
            catch ( PDOException $ex )
            {
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return FALSE;           
            }
        }

        /**Save data new applicant */
        public function InsertApplicant($nameApp,$lastName,$age,$birthdate,$gender,$CURP,$address,$city,$state,$zip,$email) /*Insert Peticion en DB* */
        {
            try
            {                
                $fecha=date('Y-m-d H:i:s');
                $Query      = "INSERT INTO `applicant`(`nameAPP`, `lastName`, `ageApp`, `birthDate`, `gender`,`CURP`,`address`, `city`,`state`, `zip`,`create_at`,`emailApp`) VALUES ( ?,?,?,?,?,?,    ?,?,?,?,?,?)";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $nameApp );
                $stmt->bindParam( 2, $lastName );
                $stmt->bindParam( 3, $age );
                $stmt->bindParam( 4, $birthdate );
                $stmt->bindParam( 5, $gender );
                $stmt->bindParam( 6, $CURP );
                $stmt->bindParam( 7, $address );
                $stmt->bindParam( 8, $city );
                $stmt->bindParam( 9, $state );
                $stmt->bindParam( 10, $zip );
                $stmt->bindParam( 11, $fecha );
                $stmt->bindParam( 12, $email );
                if($stmt->execute())
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            catch ( Exception $ex )
            {   
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return FALSE;
            }
        }

        /**Save data new income */
        public function InsertIncome($NameComp,$fullIncome,$netIncome,$typeEmployee,$documentIncome,$startEmloyee,$CURP) /*Insert Peticion en DB* */
        {
            try
            {                
                $fecha=date('Y-m-d H:i:s');
                $Query      = "INSERT INTO `income`(`idIncome`, `nameCompany`, `fullIncome`, `netIncome`, `typeEmployment`,`documentIncome`,`startEmployment`, `createRegister`,`curpEmployee`) VALUES ( NULL, ?,?,?,?, ?,?,?,?)";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $NameComp );
                $stmt->bindParam( 2, $fullIncome );
                $stmt->bindParam( 3, $netIncome );
                $stmt->bindParam( 4, $typeEmployee );
                $stmt->bindParam( 5, $documentIncome );
                $stmt->bindParam( 6, $startEmloyee );
                $stmt->bindParam( 7, $fecha );
                $stmt->bindParam( 8, $CURP );
                if($stmt->execute())
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
            catch ( Exception $ex )
            {   
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return FALSE;
            }
        }

        /**Save data new income */
        public function InsertOrder($period,$Amount,$idDestinity,$curp) /*Insert Peticion en DB* */
        {
            try
            {                
                $fecha=date('Y-m-d H:i:s');
                $Query      = "INSERT INTO `orderApp`(`idOrder`, `createRegister`, `period`, `amount`, `idDestiny`,`curpEmployee`) VALUES ( NULL, ?,?,?,?,?)";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $fecha );
                $stmt->bindParam( 2, $period );
                $stmt->bindParam( 3, $Amount );
                $stmt->bindParam( 4, $idDestinity );
                $stmt->bindParam( 5, $curp );
                if($stmt->execute())
                {
                    $lastId = $this->PDOCON->lastInsertId();
                    return $lastId;
                }
                else
                {
                    return 0;
                }
            }
            catch ( Exception $ex )
            {   
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return 0;
            }
        }

        /**Save data new income */
        public function updatePeriod($period,$idOrder) /*Insert Peticion en DB* */
        {
            try
            {  
                $Query      = "UPDATE `orderApp` SET `period`=? WHERE idOrder=?";          
            $stmt       = $this->PDOCON->prepare( $Query );
            $stmt->bindParam(1, $period);
            $stmt->bindParam(2, $idOrder);
            if($stmt->execute())
            {
                return true;
            }
            else
            {
                return false;
            }              
            }
            catch ( Exception $ex )
            {   
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return false;
            }
        }
        
        /*validate email applicant* */
        public function validateemail($email)
        {
            try
            {
                $Query      = "SELECT * FROM `applicant` WHERE emailApp=? limit 1";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $email );
                $stmt->execute();
                $Result     = $stmt->fetch(PDO::FETCH_ASSOC);
                $total=$stmt->rowCount();
                if($total<=0)// si no se encuentra registro
                {
                    $Result=[];
                }  
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*getData Destiny* */
        public function getDataDestiny($id)
        {
            try
            {
                $Query      = "SELECT * FROM `cat_destiny` WHERE id=? limit 1";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $id );
                $stmt->execute();
                $Result     = $stmt->fetch(PDO::FETCH_ASSOC);
                $total=$stmt->rowCount();
                if($total<=0)// si no se encuentra registro
                {
                    $Result=[];
                }  
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*getData Destiny* */
        public function getSumNetIncome($CURP)
        {
            try
            {
                $Query      = "SELECT SUM(netIncome) as 'Sum' FROM `income` WHERE curpEmployee=?";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $CURP );
                $stmt->execute();
                $Result     = $stmt->fetch(PDO::FETCH_ASSOC);  
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }
        
        /*get All aplicants* */
        public function getAllApplicant()
        {
            try
            {
                $Result=[];
                $Query      = "SELECT * FROM `applicant` WHERE 1";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                {
                    $Result[]=$row;
                }
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*get All Orders* */
        public function getAllOrdersActives()
        {
            try
            {
                $Result=[];
                $Query      = "SELECT A.name,B.idOrder,B.createRegister,B.period,B.curpEmployee,C.nameApp,C.lastName,B.amount FROM cat_destiny as A INNER JOIN `orderApp` AS B ON A.id=B.idDestiny INNER JOIN applicant AS C ON B.curpEmployee=C.CURP WHERE 1";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                {
                    $Result[]=$row;
                }
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*get All Orders* */
        public function getOrdersbyId($id)
        {
            try
            {
                $Result=[];
                $Query      = "SELECT A.name,B.idOrder,B.createRegister,B.period,B.curpEmployee,C.nameApp,C.lastName,B.amount FROM cat_destiny as A INNER JOIN `orderApp` AS B ON A.id=B.idDestiny INNER JOIN applicant AS C ON B.curpEmployee=C.CURP WHERE B.idOrder=?";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $id );
                $stmt->execute();
                $Result     = $stmt->fetch(PDO::FETCH_ASSOC);  
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }



        /*get All Destiny* */
        public function getAllDestinity()
        {
            try
            {
                $Result=[];
                $Query      = "SELECT * FROM `cat_destiny` WHERE 1";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                {
                    $Result[]=$row;
                }
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*Get Incomes applicant by Curp* */
        public function getIncomesbyapplicant($curp)
        {
            try
            {
                $Result=[];
                $Query      = "SELECT A.nameCompany,A.fullIncome,A.netIncome,A.typeEmployment,A.startEmployment,A.createRegister,B.CURP,B.nameApp,B.lastName FROM `income` as A INNER JOIN applicant AS B ON A.curpEmployee=B.CURP WHERE A.curpEmployee=?";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $curp );
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                {
                    $Result[]=$row;
                }
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*Get Incomes applicant by Curp* */
        public function getApplicantbynetIncome()
        {
            try
            {
                $Result=[];
                $Query      = "SELECT A.nameApp,A.lastName,A.CURP FROM `applicant` AS A INNER JOIN income AS B ON A.CURP=B.curpEmployee WHERE B.netIncome>0 GROUP BY A.nameApp,A.lastName,A.CURP";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                {
                    $Result[]=$row;
                }
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*validate curp register applicant* */
        public function validateCurp($curp)
        {
            try
            {
                $Query      = "SELECT * FROM `applicant` WHERE CURP=? limit 1";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $curp );
                $stmt->execute();
                $Result     = $stmt->fetch(PDO::FETCH_ASSOC);
                $total=$stmt->rowCount();
                if($total<=0)// si no se encuentra registro
                {
                    $Result=[];
                }  
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /*validate curp register applicant* */
        public function validateExistOrder($idDestinity,$curp)
        {
            try
            {
                $Query      = "SELECT * FROM `orderApp` WHERE idDestiny=? and curpEmployee=? limit 1";
                $stmt       = $this->PDOCON->prepare( $Query );
                $stmt->bindParam( 1, $idDestinity );
                $stmt->bindParam( 2, $curp ); 
                $stmt->execute();
                $Result     = $stmt->fetch(PDO::FETCH_ASSOC);
                $total=$stmt->rowCount();
                if($total<=0)// si no se encuentra registro
                {
                    $Result=[];
                }  
                return  $Result;
            }
            catch ( Exception $ex )
            {
                $Res=[];
                $msg=$ex->getMessage();
                $function=__CLASS__.'/'.__FUNCTION__;
                core::saveLog($msg,$function);
                return $Res;
            }
        }

        /**Save log errors */
        public function saveLog($msg,$function) 
        {
            $namel='Logs/errorFuctions'.date('ym').'.log';
            $archivo = fopen( $namel, 'a' );
            fwrite( $archivo, date('Y-m-d H:i:s'). ' - ' . $function . ' - ' . $msg. "\n");
            fclose( $archivo );
        }
    }
