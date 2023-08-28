<?php

    // require_once('db.php');
    // require_once('../model/Task.php');
    require_once('../model/Response.php');
    $currentFolder = "kamery";
    $imageAmount = 40;

    if(array_key_exists('directory',$_GET)) {
        $dir = $_GET['directory'];

        if ($dir == '') {
            $response = new Response();
            $response->setHttpStatusCode(400);
            $response->setSuccess(false);
            $response->addMessage("Directory cannot be blank");
            $response->send();
            exit;
        }

        $dirParent = dirname(__DIR__) . "/" . $currentFolder;
        $dirParentFiles = array_diff(scandir($dirParent), array('..', '.'));
        $retrieved_ParentDirs = array();
        foreach($dirParentFiles as $file) {
            if (is_dir("$dirParent/$file")) {
                array_push($retrieved_ParentDirs, $file);
            }
        }
        
        if (!in_array($dir, $retrieved_ParentDirs)) {
            $response = new Response();
            $response->setHttpStatusCode(400);
            $response->setSuccess(false);
            $response->addMessage("Directory does not exist");
            $response->send();
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            try{
                $dirCam   = dirname(__DIR__) . "/" . $currentFolder . "/" . $dir;

                $dirCamFiles = array_diff(scandir($dirCam, SCANDIR_SORT_DESCENDING), array('..', '.'));
                $retrieved_files = array();
                $retrieved_dirs = array();
                foreach($dirCamFiles as $file) {
                    if (is_file("$dirCam/$file")) {
                        // array_push($retrieved_files, "/" . $currentFolder . "/" . $dir . "/" . $file);
                        $retrieved_files += [$file => "/" . $currentFolder . "/" . $dir . "/" . $file];
                    } elseif (is_dir("$dirCam/$file")) {
                        array_push($retrieved_dirs, $file);
                    }
                }

                if (!$retrieved_dirs && !$retrieved_files) {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage("No images found");
                    $response->send();
                    exit;
                }

                $rep = 0;
                do {
                    $dirCam = dirname(__DIR__) . "/" . $currentFolder . "/" . $dir . "/" . date("Ymd", strtotime("-$rep days"));
                    if (file_exists($dirCam)) {
                        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirCam));
                        foreach ($iterator as $key => $child){
                            if ($child->isFile()){
                                $name = substr($child->getPathname(), strpos($child->getPathname(), $currentFolder) - 1);
                                // array_push($retrieved_files, $name);
                                $retrieved_files += [$child->getFilename() => $name];
                            }
                        }
                    }
                    $rep++;
                } while (count($retrieved_files) < $imageAmount);

                // print_r($retrieved_files);

                krsort($retrieved_files);
                // array_values($retrieved_files);
                $retrieved_files = array_slice($retrieved_files, 0, $imageAmount);
                $output_array = [];     // This is where your output will be stored.
                foreach ($retrieved_files as $k => $v){
                    array_push($output_array, $v);
                }


                $returnData = array();
                $returnData['todays_date'] = date("Ymd");
                $returnData['parent_directory'] = $dir;
                $returnData['number_of_retrieved_items'] = count($retrieved_files);
                $returnData['retrieved_items'] = $output_array;

                $response = new Response();
                $response->setHttpStatusCode(200);
                $response->setSuccess(true);
                $response->toCache(true);
                $response->setData($returnData);
                $response->send();
                exit;

            }
            catch (Exception $ex) {
                // error_log('Database query error - '.$ex, 0);
                $response = new Response();
                $response->setHttpStatusCode(500);
                $response->setSuccess(false);
                $response->addMessage($ex->getMessage());
                // $response->addMessage('Bart Failed to get Task');
                $response->send();
                exit();
            }
        } else {
            $response = new Response();
            $response->setHttpStatusCode(405);
            $response->setSuccess(false);
            $response->addMessage('Request method not allowed');
            $response->send();
            exit;
        }
    } elseif (empty($_GET)) {
        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            try{
                $dirCam    = dirname(__DIR__) . "/" . $currentFolder;
                $dirCamFiles = array_diff(scandir($dirCam, SCANDIR_SORT_DESCENDING), array('..', '.'));
                $retrieved_dirs = array();
                foreach($dirCamFiles as $file) {
                    if (is_dir("$dirCam/$file")) {
                        array_push($retrieved_dirs, $file);
                    }
                }
                sort($retrieved_dirs);

                $returnData = array();
                $returnData['todays_date'] = date("Ymd");
                $returnData['parent_directory'] = substr($dirCam, strrpos($dirCam, '/') + 1);
                $returnData['number_of_retrieved_items'] = count($retrieved_dirs );
                $returnData['retrieved_items'] = $retrieved_dirs;

                $response = new Response();
                $response->setHttpStatusCode(200);
                $response->setSuccess(true);
                $response->toCache(true);
                $response->setData($returnData);
                $response->send();
                exit;

            }
            catch (Exception $ex) {
                // error_log('Database query error - '.$ex, 0);
                $response = new Response();
                $response->setHttpStatusCode(500);
                $response->setSuccess(false);
                $response->addMessage($ex->getMessage());
                // $response->addMessage('Bart Failed to get Task');
                $response->send();
                exit();
            }

        } else {
            $response = new Response();
            $response->setHttpStatusCode(405);
            $response->setSuccess(false);
            $response->addMessage('Request method not allowed');
            $response->send();
            exit;
        }
    } else {
        $response = new Response();
        $response->setHttpStatusCode(404);
        $response->setSuccess(false);
        $response->addMessage('Endpoint not found');
        $response->send();
        exit;
    }


?>