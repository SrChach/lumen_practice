<?php 

function NOWDT(){
	return date("Y-m-d H:i:s");
} @srand((double)microtime()*1000000);

function microtime_float(){
		list($usec, $sec) = explode(" ", microtime());
		return  (float)((float)$usec + (float)$sec);
}


function COMLOGVIS($msg, $debugging = false){
	if(!$debugging)
		return;
	$now = NOWDT();   
	$salida="\n\n[mem:".memory_get_usage ()."][".sprintf("%10.012f",microtime_float())."][$now][**.|.|.**]\n  $msg ---\n";
	echo $salida;
}


function COMLOGVISHTML($msg,$etq=''){
	
	$microNow=microtime_float();
	if( $GLOBALS['_TMICROANT'] *1 === 0 )
		$GLOBALS['_TMICROANT'] = $microNow;
	$dif = $microNow-$GLOBALS['_TMICROANT'];
	$GLOBALS['_TMICROANT'] = $microNow;
	
	$now=NOWDT();
	$salida="<!-- $etq [".number_format ($microNow,15,".","")."][$now][M:". memory_get_usage()."][**.|.|.**] $msg -- ". number_format ($dif,8)." -->\n";
	echo $salida;
}
function COMLOG($msg,$dir='')
{
	GLOBAL $_LOG_PROCESOS;
	GLOBAL $_KEYCOMLOG;
	if($_LOG_PROCESOS)
	{
		$now=NOWDT();   
		$salida="\n\n[$_KEYCOMLOG][".sprintf("%10.012f",microtime_float())."][M:". memory_get_usage()."][**.|.|.**]\n[$now] \n  $msg ---";
		file_put_contents($_LOG_PROCESOS,$salida,  FILE_APPEND );
		if($dir)echo $salida;
		
	}
}

function smicrotime_float(){
	return sprintf("%10.012f",microtime_float());
}


function estaUrl(){
	return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}

function esteDominio(){
		if(isset($_SERVER['HTTPS'])){
				$protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
		}
		else{
				$protocol = 'http';
		}
		return   $_SERVER['HTTP_HOST'];
}

function microtimefloat(){
	$microtime2=microtime();
	$microtime2=explode(" ",$microtime2);
	return $microtime2[1]+$microtime2[0];
}
 
function insertReg($Link,$tabla,$Datos ,&$Ops){
	//GLOBAL $Link;
//  if(!$link){   GLOBAL $Link;   $link=$Link; }
	
	$qr=" INSERT INTO  $tabla ( ";
	$n=0;
	foreach($Datos as $cmp => $val)
	{
		$cmp=trim($cmp);
	if($n>0)$qr.=",";
	$qr.=" $cmp ";
	$n++;
	}
	
	$qr.=" ) VALUES (";
	
	$n=0;
	foreach($Datos as $cmp => $val)
	{
	if(!mb_detect_encoding($val, 'utf-8', true))
	{
		$val = addslashes( utf8_decode($val));
	}
	else
	{
		$val = addslashes($val);
	}
		$cmp=trim($cmp);
	if($n>0)$qr.=",";
	$qr.=" '".$val."' ";
	$n++;
	}  
	$qr.=" ); ";
	$res=Qr($Link,$qr);
	
	if(!$res)
	{
		$Ops['ERRORNO']=mysql_errno($Link);
		$Ops['ERROR']=mysql_error($Link);
	}
	$LLI=QTXT($Link," SELECT LAST_INSERT_ID( )  ");
	
	$Ops['LII']=$LLI;
	$Ops['QR']=$qr;
	return $res;
}
 
function insertRegX($Link,$tabla,$Datos ,&$Ops,$auto='')
{ // idReg,idCliente
	//GLOBAL $Link;
//  if(!$link){   GLOBAL $Link;   $link=$Link; }
	
	$qr=" INSERT INTO  $tabla ( ";
	$n=0;
	foreach($Datos as $cmp => $val)
	{
		$cmp=trim($cmp);
	if($n>0)$qr.=",";
	$qr.=" $cmp ";
	$n++;
	}
	
	$qr.=" ) VALUES (";
	
	$n=0;
	foreach($Datos as $cmp => $val)
	{
	if(!mb_detect_encoding($val, 'utf-8', true))
	{
		$val = addslashes( utf8_decode($val));
	}
	else
	{
		$val = addslashes($val);
	}
		$cmp=trim($cmp);
	if($n>0)$qr.=",";
	$qr.=" '".$val."' ";
	$n++;
	}  
	$qr.=" ); ";
	$res=Qr($Link,$qr);
	
	if(!$res)
	{
		$Ops['ERRORNO']=mysql_errno($Link);
		$Ops['ERROR']=mysql_error($Link);
	}
	$LLI=QTXT($Link," SELECT LAST_INSERT_ID( )  ");
	
	$Ops['LII']=$LLI;
	$Ops['QR']=$qr;
	return $res;
	
	
}
function updateReg($link,$tabla,$where,$Datos,$campos,&$ops)
{
	$qr=" UPDATE $tabla SET ";
	
	$campos=explode(",",$campos);
	$n=0;
	//pr($Datos);
	foreach($campos as $cmp)
	{
	if(!mb_detect_encoding($Datos[$cmp], 'utf-8', true))
	{
		$Datos[$cmp] = addslashes( utf8_decode($Datos[$cmp]));
	}
	else
	{
		$Datos[$cmp] = addslashes($Datos[$cmp]);
	}
		$cmp=trim($cmp);
	if($n>0)$set.=",";
	$set.=" $cmp='".  $Datos[$cmp]."' ";
	$n++;
	
	}
	
	$qr.= $set. " WHERE  $where  \n";
	$res=Qr($link,$qr);
	$ops['qr']=$qr;
	$ops['res']=$res;
	$ops['afectadas'] = mysql_affected_rows();
	return $res;
	//echo " $qr ";
}
function updateRegV2($link,$tabla,$where,$Datos,$campos,&$ops)
{
	$qr=" UPDATE $tabla SET ";
	
	$campos=explode(",",$campos);
	$n=0;
	//pr($Datos);
	foreach($campos as $cmp)
	{
	if(!mb_detect_encoding($Datos[$cmp], 'utf-8', true))
	{
		$Datos[$cmp] = utf8_decode( addslashes($Datos[$cmp]));
	}
	else
	{
		$Datos[$cmp] = addslashes($Datos[$cmp]);
	}
		$cmp=trim($cmp);
	if($n>0)$set.=",";
	$set.=" $cmp='".  $Datos[$cmp]."' ";
	$n++;
	
	}
	
	$qr.= $set. " WHERE  $where  \n";
	$res=Qr($link,$qr);
	$ops['qr']=$qr;
	$ops['res']=$res;
	$ops['afectadas'] = mysql_affected_rows();
	return $res;
	//echo " $qr ";
}
function loadRegsQr($Link,$qr,&$Datos,&$Ops)
{
	//if(!$Link)die("no link en loadRegsQr de grFun de admin");
	$Datos=array();
	$Ops=array();
	$Ops['QR']=$qr;   //pr($Ops);
	$res=Qr($Link,$qr);
	$Ops['mnr']=mnr($res);
	if($Ops['mnr'])
	{
		$i=0; 
	while($rens=mysql_fetch_array($res,MYSQL_ASSOC))
	{
		$Datos[$i]=$rens;
		$i++;
	}
	$Datos = utf8_converter($Datos);
	return 1;
	}
	return 0;
}

function loadRegs($Link,$tabla,$where,&$Datos,&$Ops,$Campos='')
{
	
	if(!$Campos)
	$qr="SELECT * FROM $tabla ";
	else
	$qr="SELECT $Campos FROM $tabla ";
	
	if($where)
	{
		$qr.=" WHERE $where ";
	
	}
	
	$Ops['QR']=$qr;
	
	$res=Qr($Link,$qr);
	
	
	$Ops['mnr']=mnr($res);
	
	
	if($Ops['mnr'])
	{
	
		$i=0;
	
	while($rens=mfa($res))
	{
		$Datos[$i]=$rens;
		
		$i++;
	}
	return 1;
	}
	
	return 0;
	
	
	
	
}

 
function SUMAR($qr){
	 GLOBAL $Link;
	 $res = Qr($Link,$qr);
	 while($rens=mfa($res)){$TOTALAQUI+=$rens[0];}
	 return $TOTALAQUI;
}



function MesesEspanol($ME_NumMes){
	switch ($ME_NumMes)
	{
		case '01': return('Enero'); break;
	case '02': return('Febrero'); break;
	case '03': return('Marzo'); break;
	case '04': return('Abril'); break;
	case '05': return('Mayo'); break;
	case '06': return('Junio'); break;
	case '07': return('Julio'); break;
	case '08': return('Agosto'); break;
	case '09': return('Septiembre'); break;
	case '10': return('Octubre'); break;
	case '11': return('Noviembre'); break;
	case '12': return('Diciembre'); break;
	default: return('No num');
	}
}
	
function QuitarAcentos2($s) {
	$s=decodeVacio($s);
	$s = ereg_replace("[áàâãª]","a",$s);
	$s = ereg_replace("[ÁÀÂÃ]","A",$s);
	$s = ereg_replace("[ÍÌÎ]","I",$s);
	$s = ereg_replace("[íìî]","i",$s);
	$s = ereg_replace("[éèê]","e",$s);
	$s = ereg_replace("[ÉÈÊ]","E",$s);
	$s = ereg_replace("[óòôõº]","o",$s);
	$s = ereg_replace("[ÓÒÔÕ]","O",$s);
	$s = ereg_replace("[úùû]","u",$s);
	$s = ereg_replace("[ÚÙÛ]","U",$s);
	$s = str_replace("ç","c",$s);
	$s = str_replace("Ç","C",$s);
	return $s;
}
	
function elimina_acentos($cadena){
	$tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	$replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
	return(strtr($cadena,$tofind,$replac));
}
 
 function mfa($res)
 {
	 return mysql_fetch_array($res);
 }
 
// nacho ver
 function lii($Link)
 {
	 return QTXT($Link," SELECT LAST_INSERT_ID( )  ");
 }
 
 function guardaQr($qr,$Link)
 {
	 GLOBAL $_LOGSQL;
	 
	 if($_LOGSQL)
	 {
			 if( strpos($qr, "INSERT ")===false )
			 {}
			 else
			 {
				 $LLI=QTXT($Link," SELECT LAST_INSERT_ID( )  "); 
				 
			 }
				
			 
			 if
			 ( strpos($qr, "UPDATE")===false and
				 strpos($qr, "DELETE")===false and
				 strpos($qr, "INSERT")===false and
				 strpos($qr, "ALERT TABLE")===false and
				 strpos($qr, "CREATE TABLE")===false 
			 )
			 {}
			 else
			 {
				 $qrok="\n/*".sprintf("%10.012f",microtime_float())."*/  $qr -- $LLI";
				 file_put_contents($_LOGSQL,$qrok,FILE_APPEND);
			 }     
			 
			 
	 }
	 
 }
 
 
 function Qr($Link,$qr,$noSave=0)
	{
	 // GLOBAL $Link;
	 //echo $Link."************";exit(1);
	 $res = mysql_query($qr,$Link);
	 if(!$noSave)guardaQr($qr,$Link);
	 if(!$res)
	 {
		 //COMLOG(var_dump(debug_backtrace()));
	 }
	return $res;
			
	}  
	function mnr($res)
	{
		return @mysql_num_rows($res);
	}
	
	function Exs($Link,$qr,&$res)
	{
		GLOBAL $Link;
	$res=Qr($Link,$qr);
	if(!$res)
	{
		return 0;
	}
	return mysql_num_rows($res);
	}  
						
 function Qtxt($Link,$qr)
 {
//    GLOBAL $Link;
	$res=Qr($Link,$qr);
	$ren=mysql_fetch_array($res);
	return $ren[0];
	}
	

function validarCadenaBasica($cad)
{
	for($i=0;$i<strlen($cad);$i++)
	{
		$ok=0;
		if($cad[$i]>='a' and $cad[$i]<='z')$ok=1;
		if($cad[$i]>='A' and $cad[$i]<='Z')$ok=1;
		if($cad[$i]>='0' and $cad[$i]<='9')$ok=1;
		if($cad[$i]=='-' )$ok=1;
		if($cad[$i]=='/' )$ok=1;
		if($cad[$i]=='%' )$ok=1;
		if($cad[$i]=='+' )$ok=1;
		if(!$ok)return 0;
	}
	return 1;
}




function shutdown()
{
	if ( ! $err = error_get_last()) {
		return;
	}
	$fatals = array(
		E_USER_ERROR      => 'Fatal Error',
		E_ERROR           => 'Fatal Error',
		E_PARSE           => 'Parse Error', 
		E_CORE_ERROR      => 'Core Error',
		E_CORE_WARNING    => 'Core Warning',
		E_COMPILE_ERROR   => 'Compile Error',
		E_COMPILE_WARNING => 'Compile Warning'
	);
	if (isset($fatals[$err['type']])) {
		$msg = $fatals[$err['type']] . ': ' . $err['message'] . ' in ';
		$msg.= $err['file'] . ' on line ' . $err['line'];
		error_log($msg."\n\n\n".pr( debug_backtrace() ) );
	}
}


function reghlog($mod,$cad,$data='')
{
	GLOBAL $_REGHLOG,$SESUS_login,$_KEYCOMLOG,$_SESIP;
	//echo $mod;
	if($_REGHLOG)
	{
		$now=NOWDT();
		//$salida="[*||*][MOD:$mod][$_SESIP][".sprintf("%10.012f",microtime_float())."][$now][$SESUS_login]\n".$cad;
		$salida="[*||*][MOD:$mod][$_SESIP][".sprintf("%10.012f",microtime_float())."][$now][$SESUS_login]".$cad."\n";
		file_put_contents($_REGHLOG,$salida,  FILE_APPEND );
	}
}

function crearInsertArray($tabla,&$regs)
{
	$columns = implode(", ",array_keys($regs[0]));
	$sql=" INSERT INTO $tabla ($columns) VALUES ";
	$prim=0;
	foreach($regs as $reg)
	{     
		if($prim)$sql.=", ";
		
		$prim=1;
		$escaped_values = array_map('mysql_real_escape_string', array_values($reg));  
		
		$values  = "'".implode("', '", $escaped_values)."'";  
		$sql.=" ($values) ";
	}
	return $sql;
	
}

/**
 * Funcion getIntervalDate
 * @descripcion       Obtiene el intervalo de tienpo entre 2 fechas
 * @author Julio Cesar Ayala Ramos (julioayala.cheap@gmail.com)
 * @param  [string] $fecha_1        fecha 1
 * @param  [string] $fecha_1        fecha 2
 * @return [string]                 Objeto de tipo interval
 */
function getIntervalDate($fecha_1, $fecha_2)
{
	$datetime1 = new DateTime($fecha_1);
	$datetime2 = new DateTime($fecha_2);
	$interval = $datetime1->diff($datetime2);
	return $interval;
}


?>