<?php

ini_set('max_execution_time',3000000000);
		$con = mysql_connect('202.67.13.34','ppsdm','ppsdM2014') or die("Unable to connect to MySQL");
		mysql_select_db('sigis_personalia', $con);
				if (mysql_error()) {
				exit('Connection to <b></b> failed.');
			}

$hw_id = '1';

$hardware_config_sql = "SELECT * FROM hardware WHERE id = '".$hw_id."'";
$hardware_result = mysql_query($hardware_config_sql);


$hw = mysql_fetch_array($hardware_result);


		$IP 	= $hw['ip_address'];
		$Key 	= $hw['key'];		

		$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
		
		if($Connect)
		{			
			$soap_request	="<GetAttLog>
									<ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
									<Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
								</GetAttLog>";			

			$newLine 		="\r\n";

			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
		    fputs($Connect, "Content-Type: text/xml".$newLine);
		    fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
		    fputs($Connect, $soap_request.$newLine);
									
			$buffer="";
			
			while($Response=fgets($Connect, 1024)){
				$buffer=$buffer.$Response;
			}
			
			
			
			echo 'SUCCESS';
			echo '<br/>';

		}

		else 
			echo "Koneksi Gagal";

			
			
		include("parse.php");
		$buffer=Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
		$buffer=explode("\r\n",$buffer);		
		
		for($a=0;$a<count($buffer);$a++)
		//for($a=count($buffer)-100;$a < count($buffer);$a++)
		{
		
			$data 		= Parse_Data($buffer[$a],"<Row>","</Row>");
			$PIN 		= Parse_Data($data,"<PIN>","</PIN>");
			$Time 		= Parse_Data($data,"<DateTime>","</DateTime>");
			$Verified 	= Parse_Data($data,"<Verified>","</Verified>");
			$Status 	= Parse_Data($data,"<Status>","</Status>");	
			$Workcode 	= Parse_Data($data,"<WorkCode>","</WorkCode>");	
			$Tanggal 	= substr($Time,0,10);
			$Waktu 		= substr($Time,10,10);
//echo 'PIN : ' . $PIN . ' Time : ' . strtotime($Time) . ' Verified : ' . $Verified . ' Status : ' . $Status . ' WorkCode : ' . $Workcode;
//echo strtotime($Time);

$Time2 = date('Y-m-d H:i:s', strtotime($Time));

//$Time2 = '2011-12-18 13:17:17';
$insert = 'insert into raw (hardware_id,pin,datetime,verified,status,workcode)values('.$hw_id.','.$PIN.',"'.$Time2.'",'.$Verified.','.$Status.','.$Workcode.')';
		$result = mysql_query($insert);


		}		
			

			
	mysql_close($con);	
	
			

?>
