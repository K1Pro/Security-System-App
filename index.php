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

<style>

.bartkacamone img {
	/* border-style: solid;
 	border-color: white;
	border-width: 0.25vw;
	position: absolute;
	left: 0vw;
	top: 0vh;
	width: 33vw;
	height: 32vh; */
}
.bartkacamtwo img {
	border-style: solid;
 	border-color: white;
	border-width: 0.25vw;
	position: absolute;
	left: 34vw;
	top: 0vh;
	width: 33vw;
	height: 32vh;
}
.bartkacamthree img {
	border-style: solid;
 	border-color: white;
	border-width: 0.25vw;
	position: absolute;
	left: 34vw;
	top: 33vh;
	width: 33vw;
	height: 32vh;
}
.bartkacamfour img {
	/* display:none; */
	border-style: solid;
 	border-color: white;
	border-width: 0.25vw;
	position: absolute;
	left: 0vw;
	top: 33vh;
	width: 33vw;
	height: 32vh;
}
.bartkacamfive img {
	border-style: solid;
 	border-color: white;
	border-width: 0.25vw;
	position: absolute;
	left: 66vw;
	top: 66vh;
	width: 33vw;
	height: 32vh;
}
.bartkacamsix img {
	border-style: solid;
 	border-color: white;
	border-width: 0.25vw;
	position: absolute;
	left: 0vw;
	top: 66vh;
	width: 33vw;
	height: 32vh;
}

</style>

 </head>
<!-- <body style="margin:0;padding:0"> -->
<body>
	<div class="container-fluid text-center">
		<div class="row">
			<div 
			id="cam1GridBox"
			class="col-12 col-md-4 thirdPageHeight bg-primary overflow-hidden"
			style="padding: 5px; --bs-bg-opacity: 0.5"
			>

<?php

$filePaths = array(
	array("/kamery/BundleGlowna/", "PTZ"),
	array("/kamery/BUNDLE-DRZWI/", "Dome"),
	array("/kamery/PolskaBartka/", "PTZ"), 

	array("/kamery/HaniGaraz/", "PTZ"), 
	array("/kamery/HaniDrzwi/", "PTZ"), 
	array("/kamery/CHICAGO-DRZWI/", "Dome"),

	array("/kamery/FLORYDAAUTO/", "Dome"),
	array("/kamery/FlorydaTylnyPokoj/", "PTZ"),
	array("/kamery/ChicagoSypialnia/", "PTZ")
);
foreach ($filePaths as $value) {
    console_log($value);
}

//Chicago Sypialnia Kamera
$ChiDrzwiCamPath = "/kamery/ChicagoSypialnia/" ;
$ChiDrzwiCamDir = realpath('.') . $ChiDrzwiCamPath ;
$scanned_ChiDrzwiCamFirstDir = array_diff(scandir($ChiDrzwiCamDir), array('..', '.'));
arsort($scanned_ChiDrzwiCamFirstDir);

//Hani Garaz Kamera
$ChiKuchniaCamPath = "/kamery/HaniGaraz/" ;
$ChiKuchniaCamDir = realpath('.') . $ChiKuchniaCamPath ;
$scanned_ChiKuchniaCamFirstDir = array_diff(scandir($ChiKuchniaCamDir), array('..', '.'));
arsort($scanned_ChiKuchniaCamFirstDir);

//Floryda Tylna Kamera
$FLTylnyCamPath = "/kamery/FlorydaTylnyPokoj/" ;
$FLTylnyCamDir = realpath('.') . $FLTylnyCamPath ;
$scanned_FLTylnyCamFirstDir = array_diff(scandir($FLTylnyCamDir), array('..', '.'));
arsort($scanned_FLTylnyCamFirstDir);

//Bundle Glowna Kamera
$PLSalonCamPath = "/kamery/BundleGlowna/" ;
$PLSalonCamDir = realpath('.') . $PLSalonCamPath ;
$scanned_PLSalonCamFirstDir = array_diff(scandir($PLSalonCamDir), array('..', '.'));
arsort($scanned_PLSalonCamFirstDir);

//Bundle Drzwi Kamera
$PLSypialniaCamPath = "/kamery/BUNDLE-DRZWI/" ;
$PLSypialniaCamDir = realpath('.') . $PLSypialniaCamPath ;
$scanned_PLSypialniaCamFirstDir = array_diff(scandir($PLSypialniaCamDir), array('..', '.'));
arsort($scanned_PLSypialniaCamFirstDir);

//Floryda Auto Kamera
$FLAutoCamPath = "/kamery/FLORYDAAUTO/" ;
$FLAutoCamDir = realpath('.') . $FLAutoCamPath ;
$scanned_FLAutoCamFirstDir = array_diff(scandir($FLAutoCamDir), array('..', '.'));
arsort($scanned_FLAutoCamFirstDir);


$r = 0;
$rr = 0;
$rrr = 0;
$s = 0;
$ss = 0;
$sss = 0;
$t = 0;
$tt = 0;
$ttt = 0;

$u = 0;
$uu = 0;
$uuu = 0;
$v = 0;
$vv = 0;
$vvv = 0;
$w = 0;
$ww = 0;
$www = 0;
$x = 0;
$xx = 0;
$xxx = 0;
$y = 0;
$yy = 0;
$yyy = 0;
$z = 0;
$zz = 0;
$zzz = 0;

//Chicago Drzwi Kamera
// foreach( $scanned_ChiDrzwiCamFirstDir as $ChiDrzwiCamFirstFolders ) {
// 	if     (strpos($ChiDrzwiCamFirstFolders, '.'     ) !== FALSE) {} 
// 	elseif (strpos($ChiDrzwiCamFirstFolders, '@eaDir') !== FALSE) {} 
// 	elseif (strpos($ChiDrzwiCamFirstFolders, 'misc'  ) !== FALSE) {} 
// 	else {
// 		$u++; 
// 		if ($u == 1) {
// 			$ChiDrzwiCamSecondDir = $ChiDrzwiCamDir . $ChiDrzwiCamFirstFolders;
// 			$scanned_ChiDrzwiCamSecondDir = array_diff(scandir($ChiDrzwiCamSecondDir), array('..', '.'));
// 			arsort($scanned_ChiDrzwiCamSecondDir);

// 			foreach( $scanned_ChiDrzwiCamSecondDir as $ChiDrzwiCamSecondFolders ) {
// 				$uu++;
// 				if ($uu == 1) {
// 					$ChiDrzwiCamThirdDir = $ChiDrzwiCamSecondDir . "/" . $ChiDrzwiCamSecondFolders;
// 					$scanned_ChiDrzwiCamThirdDir = array_diff(scandir($ChiDrzwiCamThirdDir), array('..', '.'));
// 					arsort($scanned_ChiDrzwiCamThirdDir);

// 					foreach( $scanned_ChiDrzwiCamThirdDir as $ChiDrzwiCamPhotoFile ) {
// 						$uuu++;
// 						$ChiDrzwiCamFinalDir = $ChiDrzwiCamPath . $ChiDrzwiCamFirstFolders . "/" . $ChiDrzwiCamSecondFolders;
// 						$totalChiDrzwiCamVidFiles  = count( glob(substr($ChiDrzwiCamFinalDir, 1) . "/*.jpg") );
// 						if ($totalChiDrzwiCamVidFiles == 1) {
// 							$totalChiDrzwiCamVidFiles = 1;
// 						} elseif ($totalChiDrzwiCamVidFiles > 7) {
// 							$totalChiDrzwiCamVidFiles = 7;
// 						}
// 						if ($uuu > 1 && $uuu <= $totalChiDrzwiCamVidFiles) {
// 							echo ("<div class='bartkacamfive'>");
// 							echo ("\n");
// 							echo("<img src='$ChiDrzwiCamPath$ChiDrzwiCamFirstFolders/$ChiDrzwiCamSecondFolders/$ChiDrzwiCamPhotoFile' id='camfive$uuu' alt='camfive$uuu' width=500>");
// 							echo ("\n");
// 							echo ("</div>");
// 							echo ("\n");
// 						}
// 					}
// 				}
// 			}
// 		}
// 	}
			
// }
//Chicago Kuchnia Kamera
// foreach( $scanned_ChiKuchniaCamFirstDir as $ChiKuchniaCamFirstFolders ) {
// 	if     (strpos($ChiKuchniaCamFirstFolders, '.'     ) !== FALSE) {} 
// 	elseif (strpos($ChiKuchniaCamFirstFolders, '@eaDir') !== FALSE) {} 
// 	elseif (strpos($ChiKuchniaCamFirstFolders, 'misc'  ) !== FALSE) {} 
// 	else {
// 		$v++; 
// 		if ($v == 1) {
// 			$ChiKuchniaCamSecondDir = $ChiKuchniaCamDir . $ChiKuchniaCamFirstFolders;
// 			$scanned_ChiKuchniaCamSecondDir = array_diff(scandir($ChiKuchniaCamSecondDir), array('..', '.'));
// 			arsort($scanned_ChiKuchniaCamSecondDir);

// 			foreach( $scanned_ChiKuchniaCamSecondDir as $ChiKuchniaCamSecondFolders ) {
// 				$vv++;
// 				if ($vv == 1) {
// 					$ChiKuchniaCamThirdDir = $ChiKuchniaCamSecondDir . "/" . $ChiKuchniaCamSecondFolders;
// 					$scanned_ChiKuchniaCamThirdDir = array_diff(scandir($ChiKuchniaCamThirdDir), array('..', '.'));
// 					arsort($scanned_ChiKuchniaCamThirdDir);

// 					foreach( $scanned_ChiKuchniaCamThirdDir as $ChiKuchniaCamPhotoFile ) {
// 						$vvv++;
// 						$ChiKuchniaCamFinalDir = $ChiKuchniaCamPath . $ChiKuchniaCamFirstFolders . "/" . $ChiKuchniaCamSecondFolders;
// 						$totalChiKuchniaCamVidFiles  = count( glob(substr($ChiKuchniaCamFinalDir, 1) . "/*.jpg") );
// 						if ($totalChiKuchniaCamVidFiles == 1) {
// 							$totalChiKuchniaCamVidFiles = 1;
// 						} elseif ($totalChiKuchniaCamVidFiles > 7) {
// 							$totalChiKuchniaCamVidFiles = 7;
// 						}
// 						if ($vvv > 1 && $vvv <= $totalChiKuchniaCamVidFiles) {
// 							echo ("<div class='bartkacamsix'>");
// 							echo ("\n");
// 							echo("<img src='$ChiKuchniaCamPath$ChiKuchniaCamFirstFolders/$ChiKuchniaCamSecondFolders/$ChiKuchniaCamPhotoFile' id='camsix$vvv' alt='camsix$vvv' width=500>");
// 							echo ("\n");
// 							echo ("</div>");
// 							echo ("\n");
// 						}
// 					}
// 				}
// 			}
// 		}
// 	}
			
// }
//Polska Salon Kamera
foreach( $scanned_PLSalonCamFirstDir as $PLSalonCamFirstFolders ) {
	if     (strpos($PLSalonCamFirstFolders, '.'     ) !== FALSE) {} 
	elseif (strpos($PLSalonCamFirstFolders, '@eaDir') !== FALSE) {} 
	elseif (strpos($PLSalonCamFirstFolders, 'misc'  ) !== FALSE) {} 
	else {
		$x++; 
		if ($x == 1) {
			$PLSalonCamSecondDir = $PLSalonCamDir . $PLSalonCamFirstFolders;
			$scanned_PLSalonCamSecondDir = array_diff(scandir($PLSalonCamSecondDir), array('..', '.'));
			arsort($scanned_PLSalonCamSecondDir);

			foreach( $scanned_PLSalonCamSecondDir as $PLSalonCamSecondFolders ) {
				$xx++;
				if ($xx == 1) {
					$PLSalonCamThirdDir = $PLSalonCamSecondDir . "/" . $PLSalonCamSecondFolders;
					$scanned_PLSalonCamThirdDir = array_diff(scandir($PLSalonCamThirdDir), array('..', '.'));
					arsort($scanned_PLSalonCamThirdDir);

					foreach( $scanned_PLSalonCamThirdDir as $PLSalonCamPhotoFile ) {
						$xxx++;
						$PLSalonCamFinalDir = $PLSalonCamPath . $PLSalonCamFirstFolders . "/" . $PLSalonCamSecondFolders;
						$totalPLSalonCamVidFiles  = count( glob(substr($PLSalonCamFinalDir, 1) . "/*.jpg") );
						if ($totalPLSalonCamVidFiles == 1) {
							$totalPLSalonCamVidFiles = 1;
						} elseif ($totalPLSalonCamVidFiles > 7) {
							$totalPLSalonCamVidFiles = 7;
						}
						if ($xxx > 1 && $xxx <= $totalPLSalonCamVidFiles) {
							// echo ("<div class='bartkacamone'>");
							// echo ("\n");
							echo("<img src='$PLSalonCamPath$PLSalonCamFirstFolders/$PLSalonCamSecondFolders/$PLSalonCamPhotoFile' id='camone$xxx' alt='camone$xxx' height='100%' width='100%' style='display: none' class='camoneClass'>");
							// echo("<img src='$PLSalonCamPath$PLSalonCamFirstFolders/$PLSalonCamSecondFolders/$PLSalonCamPhotoFile' id='camone$xxx' alt='camone$xxx' width=500>");
							echo ("\n");
							// echo ("</div>");
							// echo ("\n");
						}
					}
				}
			}
		}
	}
			
}
// Bundle Drzwi Kamera
// foreach( $scanned_PLSypialniaCamFirstDir as $PLSypialniaCamFirstFolders ) {
// 	if (strpos($PLSypialniaCamFirstFolders, '.jpg'  ) !== FALSE) {
// 		$y++; 
// 		if ($y > 1 && $y <= 7) {
// 			echo ("<div class='bartkacamtwo'>");
// 			echo ("\n");
// 			echo("<img src='$PLSypialniaCamPath$PLSypialniaCamFirstFolders' id='camtwo$y' alt='camtwo$y' width=500>");
// 			echo ("\n");
// 			echo ("</div>");
// 			echo ("\n");
// 		}


// 	} elseif (strpos($PLSypialniaCamFirstFolders, '@eaDir') !== FALSE) {} 
// 	elseif (strpos($PLSypialniaCamFirstFolders, 'misc'  ) !== FALSE) {} 
// 	else {

// 	}

// }

//Polska Sypialnia Kamera Not being used right now 2023_06_22
// foreach( $scanned_PLSypialniaCamFirstDir as $PLSypialniaCamFirstFolders ) {
// 	if     (strpos($PLSypialniaCamFirstFolders, '.'     ) !== FALSE) {} 
// 	elseif (strpos($PLSypialniaCamFirstFolders, '@eaDir') !== FALSE) {} 
// 	elseif (strpos($PLSypialniaCamFirstFolders, 'misc'  ) !== FALSE) {} 
// 	else {
// 		$y++; 
// 		if ($y == 1) {
// 			$PLSypialniaCamSecondDir = $PLSypialniaCamDir . $PLSypialniaCamFirstFolders;
// 			$scanned_PLSypialniaCamSecondDir = array_diff(scandir($PLSypialniaCamSecondDir), array('..', '.'));
// 			arsort($scanned_PLSypialniaCamSecondDir);

// 			foreach( $scanned_PLSypialniaCamSecondDir as $PLSypialniaCamSecondFolders ) {
// 				$yy++;
// 				if ($yy == 1) {
// 					$PLSypialniaCamThirdDir = $PLSypialniaCamSecondDir . "/" . $PLSypialniaCamSecondFolders;
// 					$scanned_PLSypialniaCamThirdDir = array_diff(scandir($PLSypialniaCamThirdDir), array('..', '.'));
// 					arsort($scanned_PLSypialniaCamThirdDir);

// 					foreach( $scanned_PLSypialniaCamThirdDir as $PLSypialniaCamPhotoFile ) {
// 						$yyy++;
// 						$PLSypialniaCamFinalDir = $PLSypialniaCamPath . $PLSypialniaCamFirstFolders . "/" . $PLSypialniaCamSecondFolders;
// 						$totalPLSypialniaCamVidFiles  = count( glob(substr($PLSypialniaCamFinalDir, 1) . "/*.jpg") );
// 						if ($totalPLSypialniaCamVidFiles == 1) {
// 							$totalPLSypialniaCamVidFiles = 1;
// 						} elseif ($totalPLSypialniaCamVidFiles > 7) {
// 							$totalPLSypialniaCamVidFiles = 7;
// 						}
// 						if ($yyy > 1 && $yyy <= $totalPLSypialniaCamVidFiles) {
// 							echo ("<div class='bartkacamtwo'>");
// 							echo ("\n");
// 							echo("<img src='$PLSypialniaCamPath$PLSypialniaCamFirstFolders/$PLSypialniaCamSecondFolders/$PLSypialniaCamPhotoFile' id='camtwo$yyy' alt='camtwo$yyy' width=500>");
// 							echo ("\n");
// 							echo ("</div>");
// 							echo ("\n");
// 						}
// 					}
// 				}
// 			}
// 		}
// 	}
			
// }

//Floryda Tylna Kamera
// foreach( $scanned_FLTylnyCamFirstDir as $FLTylnyCamFirstFolders ) {
// 	if     (strpos($FLTylnyCamFirstFolders, '.'     ) !== FALSE) {} 
// 	elseif (strpos($FLTylnyCamFirstFolders, '@eaDir') !== FALSE) {} 
// 	elseif (strpos($FLTylnyCamFirstFolders, 'misc'  ) !== FALSE) {} 
// 	else {
// 		$w++; 
// 		if ($w == 1) {
// 			$FLTylnyCamSecondDir = $FLTylnyCamDir . $FLTylnyCamFirstFolders;
// 			$scanned_FLTylnyCamSecondDir = array_diff(scandir($FLTylnyCamSecondDir), array('..', '.'));
// 			arsort($scanned_FLTylnyCamSecondDir);

// 			foreach( $scanned_FLTylnyCamSecondDir as $FLTylnyCamSecondFolders ) {
// 				$ww++;
// 				if ($ww == 1) {
// 					$FLTylnyCamThirdDir = $FLTylnyCamSecondDir . "/" . $FLTylnyCamSecondFolders;
// 					$scanned_FLTylnyCamThirdDir = array_diff(scandir($FLTylnyCamThirdDir), array('..', '.'));
// 					arsort($scanned_FLTylnyCamThirdDir);

// 					foreach( $scanned_FLTylnyCamThirdDir as $FLTylnyCamPhotoFile ) {
// 						$www++;
// 						$FLTylnyCamFinalDir = $FLTylnyCamPath . $FLTylnyCamFirstFolders . "/" . $FLTylnyCamSecondFolders;
// 						$totalFLTylnyCamVidFiles  = count( glob(substr($FLTylnyCamFinalDir, 1) . "/*.jpg") );
// 						if ($totalFLTylnyCamVidFiles == 1) {
// 							$totalFLTylnyCamVidFiles = 1;
// 						} elseif ($totalFLTylnyCamVidFiles > 7) {
// 							$totalFLTylnyCamVidFiles = 7;
// 						}
// 						if ($www > 1 && $www <= $totalFLTylnyCamVidFiles) {
// 							echo ("<div class='bartkacamthree'>");
// 							echo ("\n");
// 							echo("<img src='$FLTylnyCamPath$FLTylnyCamFirstFolders/$FLTylnyCamSecondFolders/$FLTylnyCamPhotoFile' id='camthree$www' alt='camthree$www' width=500>");
// 							echo ("\n");
// 							echo ("</div>");
// 							echo ("\n");
// 						}
// 					}
// 				}
// 			}
// 		}
// 	}
			
// }

//Floryda Auto Kamera
// foreach( $scanned_FLAutoCamFirstDir as $FLAutoCamFirstFolders ) {
// 	if (strpos($FLAutoCamFirstFolders, '.jpg'  ) !== FALSE) {
// 		$z++; 
// 		if ($z > 1 && $z <= 7) {
// 			echo ("<div class='bartkacamfour'>");
// 			echo ("\n");
// 			echo("<img src='$FLAutoCamPath$FLAutoCamFirstFolders' id='camfour$z' alt='camfour$z' width=500>");
// 			echo ("\n");
// 			echo ("</div>");
// 			echo ("\n");
// 		}


// 	} elseif (strpos($FLAutoCamFirstFolders, '@eaDir') !== FALSE) {} 
// 	elseif (strpos($FLAutoCamFirstFolders, 'misc'  ) !== FALSE) {} 
// 	else {

// 	}

// }
?>

</div>
        <div
          class="col-12 col-md-4 thirdPageHeight bg-secondary"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          2 of 9
        </div>
        <div
          class="col-12 col-md-4 thirdPageHeight bg-success"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          3 of 9
        </div>
      </div>
      <div class="row">
        <div
          class="col-12 col-md-4 thirdPageHeight bg-danger"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          4 of 9
        </div>
        <div
          class="col-12 col-md-4 thirdPageHeight bg-warning"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          5 of 9
        </div>
        <div
          class="col-12 col-md-4 thirdPageHeight bg-info"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          6 of 9
        </div>
      </div>
      <div class="row">
        <div
          class="col-12 col-md-4 thirdPageHeight bg-dark"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          7 of 9
        </div>
        <div
          class="col-12 col-md-4 thirdPageHeight bg-primary"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          8 of 9
        </div>
        <div
          class="col-12 col-md-4 thirdPageHeight bg-secondary"
          style="padding: 10px; --bs-bg-opacity: 0.5"
        >
          9 of 9
        </div>

		</div>
    </div>

<script>

	<?php
		// for($i = 2; $i <= $totalChiKuchniaCamVidFiles; $i++){
		// 	echo("function camsixfun$i(){ ");
		// 	echo("document.getElementById('camsix$i').style.zIndex= '$i';");
		// 	echo(" }\n");
		// }
	?>

	<?php
		// for($i = 2; $i <= $totalChiKuchniaCamVidFiles; $i++){
		// 	$time = ($i - 1) * 1000;
		// 	echo("setTimeout(camsixfun$i, $time);\n");
		// }
	?>

	<?php
		// for($i = 2; $i <= $totalChiDrzwiCamVidFiles; $i++){
		// 	echo("function camfivefun$i(){ ");
		// 	echo("document.getElementById('camfive$i').style.zIndex= '$i';");
		// 	echo(" }\n");
		// }
	?>

	<?php
		// for($i = 2; $i <= $totalChiDrzwiCamVidFiles; $i++){
		// 	$time = ($i - 1) * 1000;
		// 	echo("setTimeout(camfivefun$i, $time);\n");
		// }
	?>


	<?php
		// for($i = 2; $i <= $totalPLSalonCamVidFiles; $i++){
		// 	echo("function camonefun$i(){ ");
		// 	echo("document.getElementById('camone$i').style.zIndex= '$i';");
		// 	echo(" }\n");
		// }
	?>

	<?php
		// for($i = 2; $i <= $totalPLSalonCamVidFiles; $i++){
		// 	$time = ($i - 1) * 1000;
		// 	echo("setTimeout(camonefun$i, $time);\n");
		// }
	?>
let i =0
Array.from(document.querySelectorAll(".camoneClass")).reverse().forEach(element => {
	i++
	setTimeout(function(){
		element.style.display = "block";
		if (document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`)) {
			document.getElementById(`${element.id.slice(0,-1)}${Number(element.id.slice(-1))+1}`).style.display = "none";
		}


	}, i*1000);
});
// for (let i = 2; i < 7; i++) {
	
// 	setTimeout(function(){
// 		console.log(`is this working? ${i}`)
// 		document.getElementById(`camone${i}`).style.display = "block";
// 	}, i*1000);
// }


<?php
		// for($i = 2; $i <= 7; $i++){
		// 	echo("function camtwofun$i(){ ");
		// 	echo("document.getElementById('camtwo$i').style.zIndex= '$i';");
		// 	echo(" }\n");
		// }
	?>

	<?php
		// for($i = 2; $i <= 7; $i++){
		// 	$time = ($i - 1) * 1000;
		// 	echo("setTimeout(camtwofun$i, $time);\n");
		// }
	?>

<?php
		// for($i = 2; $i <= $totalFLTylnyCamVidFiles; $i++){
		// 	echo("function camthreefun$i(){ ");
		// 	echo("document.getElementById('camthree$i').style.zIndex= '$i';");
		// 	echo(" }\n");
		// }
	?>

	<?php
		// for($i = 2; $i <= $totalFLTylnyCamVidFiles; $i++){
		// 	$time = ($i - 1) * 1000;
		// 	echo("setTimeout(camthreefun$i, $time);\n");
		// }
	?>

<?php
		// for($i = 2; $i <= 7; $i++){
		// 	echo("function camfourfun$i(){ ");
		// 	echo("document.getElementById('camfour$i').style.zIndex= '$i';");
		// 	echo(" }\n");
		// }
	?>

	<?php
		// for($i = 2; $i <= 7; $i++){
		// 	$time = ($i - 1) * 1000;
		// 	echo("setTimeout(camfourfun$i, $time);\n");
		// }
	?>


</script>

</body>
</html>
