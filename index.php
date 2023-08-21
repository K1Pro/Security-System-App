<?php
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }
  ?>
<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta http-equiv="refresh" content="7" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./www/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="./www/CSS/camera.css" />
    <title>Kamery</title>
</head>
<body>
<script>let i = 0;</script>

<?php
$filePaths = array(
	array("/kamery/BundleGlowna/", "PTZ"),
	array("/kamery/BUNDLE-DRZWI/", "Dome"),
	array("/kamery/ChicagoSypialnia/", "PTZ"),
	// array("/kamery/PolskaBartka/", "PTZ"), 

	array("/kamery/HaniGaraz/", "PTZ"), 
	array("/kamery/HaniDrzwi/", "PTZ"), 
	array("/kamery/CHICAGO-DRZWI/", "Dome"),

	array("/kamery/FLORYDAAUTO/", "Dome"),
	array("/kamery/FlorydaTylnyPokoj/", "PTZ"),
	array("/kamery/PolskaSalon/", "PTZ")
);
$rep = 0;
echo '<div class="container-fluid text-center">';
foreach ($filePaths as $camPaths) {
	$rep++;
	if ($rep == 1 || $rep == 4 || $rep == 7){echo '<div class="row">';}
	echo '<div class="col-12 col-md-4 thirdPageHeight bg-light" style="padding: 5px; --bs-bg-opacity: 0.5">';
	if($camPaths[1] == "PTZ") {
		$CamPath = $camPaths[0] ;
		$CamDir = realpath('.') . $CamPath ;
		$scanned_CamFirstDir = array_diff(scandir($CamDir), array('..', '.'));
		arsort($scanned_CamFirstDir);

		$x = 0;
		$xx = 0;
		$xxx = 0;
		
		foreach( $scanned_CamFirstDir as $CamFirstFolders ) {
			if     (strpos($CamFirstFolders, '.'     ) !== FALSE) {} 
			elseif (strpos($CamFirstFolders, '@eaDir') !== FALSE) {} 
			elseif (strpos($CamFirstFolders, 'misc'  ) !== FALSE) {} 
			else {
				$x++; 
				if ($x == 1) {
					$CamSecondDir = $CamDir . $CamFirstFolders;
					$scanned_CamSecondDir = array_diff(scandir($CamSecondDir), array('..', '.'));
					arsort($scanned_CamSecondDir);
		
					foreach( $scanned_CamSecondDir as $CamSecondFolders ) {
						$xx++;
						if ($xx == 1) {
							$CamThirdDir = $CamSecondDir . "/" . $CamSecondFolders;
							$scanned_CamThirdDir = array_diff(scandir($CamThirdDir), array('..', '.'));
							arsort($scanned_CamThirdDir);
		
							foreach( $scanned_CamThirdDir as $CamPhotoFile ) {
								$xxx++;
								$CamFinalDir = $CamPath . $CamFirstFolders . "/" . $CamSecondFolders;
								$totalCamVidFiles  = count( glob(substr($CamFinalDir, 1) . "/*.jpg") );
								if ($totalCamVidFiles == 1) {
									$totalCamVidFiles = 1;
								} elseif ($totalCamVidFiles > 7) {
									$totalCamVidFiles = 7;
								}
								if ($xxx > 1 && $xxx <= $totalCamVidFiles) {
									echo'<img src="'.$CamPath.$CamFirstFolders.'/'.$CamSecondFolders.'/'.$CamPhotoFile.'" id="camPTZ'.$rep.'pic'.$xxx.'" alt="PTZ'.$rep.'pic'.$xxx.'" style="display: none" class="camPTZ'.$rep.'Class">';
									echo ("\n");
								}
							}
						}
						
					}
					echo '<script>';
					echo	'i =0;';
					echo 	'Array.from(document.querySelectorAll(".camPTZ'.$rep.'Class")).reverse().forEach(element => {';
					echo		'i++;';
					echo		'setTimeout(function(){';
					echo			'element.style.display = "block";';
					echo			'if (document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`)) {';
					echo				'document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`).style.display = "none";';
					echo			'};';
					echo		'}, i*1000);';
					echo 	'});';
					echo '</script>';
				}
			}
		}
	} else if($camPaths[1] == "Dome") {
		$CamPath = $camPaths[0] ;
		$CamDir = realpath('.') . $CamPath ;
		$scanned_CamFirstDir = array_diff(scandir($CamDir), array('..', '.'));
		arsort($scanned_CamFirstDir);

		$y = 0;
		$yy = 0;
		$yyy = 0;

		foreach( $scanned_CamFirstDir as $CamFirstFolders ) {
			if (strpos($CamFirstFolders, '.jpg'  ) !== FALSE) {
				$y++; 
				if ($y > 1 && $y <= 7) {
					$yy++;
					echo'<img src="'.$CamPath.$CamFirstFolders.'" id="camDome'.$rep.'pic'.$y.'" alt="camDome'.$rep.'pic'.$y.'" style="display: none" class="camDome'.$rep.'Class">';
					echo ("\n");
					if ($yy == 6) {
						echo '<script>';
						echo	'i =0;';
						echo 	'Array.from(document.querySelectorAll(".camDome'.$rep.'Class")).reverse().forEach(element => {';
						echo		'i++;';
						echo		'console.log(element);';
						echo		'setTimeout(function(){';
						echo			'element.style.display = "block";';
						echo			'if (document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`)) {';
						echo				'document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`).style.display = "none";';
						echo			'};';
						echo		'}, i*1000);';
						echo 	'});';
						echo '</script>';
					}
				}
			} elseif (strpos($CamFirstFolders, '@eaDir') !== FALSE) {} 
			elseif (strpos($CamFirstFolders, 'misc'  ) !== FALSE) {} 
			else {

			}

		}
	}
	echo '</div>';
	if ($rep == 3 || $rep == 6 || $rep == 9){echo '</div>';}
}

// This is the final javascript
// <script>
//     let i =0
//     Array.from(document.querySelectorAll(".camoneClass")).reverse().forEach(element => {
//         i++
//         setTimeout(function(){
//             element.style.display = "block";
//             if (document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`)) {
//                 document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`).style.display = "none";
//             }
//         }, i*1000);
//     });
// </script>

?>

</body>
</html>
