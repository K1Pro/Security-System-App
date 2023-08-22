<?php

    // require_once('db.php');
    require_once('../model/Task.php');
    require_once('../model/Response.php');

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

        $dirParent    = dirname(__DIR__) . "/kamery";
        $dirParentFiles = array_diff(scandir($dirParent), array('..', '.'));
        $scanned_ParentDirs = array();
        foreach($dirParentFiles as $file) {
            if (is_dir("$dirParent/$file")) {
                array_push($scanned_ParentDirs, $file);
            }
        }
        
        if (!in_array($dir, $scanned_ParentDirs)) {
            $response = new Response();
            $response->setHttpStatusCode(400);
            $response->setSuccess(false);
            $response->addMessage("Directory does not exist");
            $response->send();
            exit;
        }


        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            try{
                $dirCam   = dirname(__DIR__) . "/kamery/" . $dir;
                $scanned_files = array();
                $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dirCam));
                foreach ($iterator as $key => $child)
                {
                    if ($child->isFile()){
                        $name = $child->getPathname();
                        array_push($scanned_files, $name);
                    }
                }
                rsort($scanned_files);
                $scanned_files = array_slice($scanned_files, 0, 10);

                $returnData = array();
                $returnData['number_of_directories'] = count($scanned_dirs);
                $returnData['parent_directory'] = $dirCam;
                $returnData['most_recent_files'] = $scanned_files;

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
                $dirCam    = dirname(__DIR__) . "/kamery";
                $dirCamFiles = array_diff(scandir($dirCam, SCANDIR_SORT_DESCENDING), array('..', '.'));
                $scanned_dirs = array();
                foreach($dirCamFiles as $file) {
                    if (is_dir("$dirCam/$file")) {
                        array_push($scanned_dirs, $file);
                    }
                }
                sort($scanned_dirs);

                $returnData = array();
                $returnData['number_of_directories'] = count($scanned_dirs);
                $returnData['parent_directory'] = $dirCam;
                $returnData['directories'] = $scanned_dirs;

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