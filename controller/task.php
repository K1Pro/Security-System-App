<?php

    // require_once('db.php');
    require_once('../model/Task.php');
    require_once('../model/Response.php');

<<<<<<< HEAD
    if(array_key_exists('directory',$_GET)) {
        $dir = $_GET['directory'];

        if ($dir == '') {
=======
    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    // try{
    //     $writeDB = DB::connectWriteDB();
    //     $readDB = DB::connectReadDB();

    // }
    // catch(PDOException $ex){
    //     error_log('Connection error - '.$ex, 0);
    //     $response = new Response();
    //     $response->setHttpStatusCode(500);
    //     $response->setSuccess(false);
    //     $response->addMessage('Database connection error');
    //     $response->send();
    //     exit();
    // }

    if(array_key_exists('directory',$_GET)) {
        $dir = $_GET['directory'];

        if ($dir == '') {
            // $response = new Response();
            // $response->setHttpStatusCode(400);
            // $response->setSuccess(false);
            // $response->addMessage("Task ID cannot be blank or must be numeric");
            // $response->send();
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] === 'GET') {
            try{
                $dirCam   = dirname(__DIR__) . "/kamery/" . $dir;
                $dirCamFiles = array_diff(scandir($dirCam, SCANDIR_SORT_DESCENDING), array('..', '.'));
                $scanned_dirs = array();
                $scanned_files = array();
                $repDir = 0;
                $repFile = 0;
                foreach($dirCamFiles as $file) {
                    if (is_dir("$dirCam/$file") && $repDir < 10) {
                        $repDir++;
                        array_push($scanned_dirs, $file);
                    } elseif (!is_dir("$dirCam/$file") && $repFile < 10) {
                        $repFile++;
                        array_push($scanned_files, $file);
                    }
                }

                if (!$scanned_files) {
                    $dirDate    = dirname(__DIR__) . "/kamery/" . $dir . "/" . $scanned_dirs[0];
                    $dirDateFiles = array_diff(scandir($dirDate, SCANDIR_SORT_DESCENDING), array('..', '.'));
                    $dirTime    = dirname(__DIR__) . "/kamery/" . $dir . "/" . $scanned_dirs[0] . "/" . $dirDateFiles[0];
                    $dirTimeFiles = array_diff(scandir($dirTime, SCANDIR_SORT_DESCENDING), array('..', '.'));

                    $repFile = 0;
                    foreach($dirTimeFiles as $file) {
                        if (!is_dir("$dirTime/$file") && $repFile < 10) {
                            $repFile++;
                            array_push($scanned_files, $file);
                        }
                    }
                }

                $returnData = array();
                $returnData['number_of_directories'] = count($scanned_dirs);
                $returnData['parent_directory'] = "$dirCam";
                $returnData['most_recent_directory'] = $scanned_dirs[0];
                $returnData['most_recent_file'] = $scanned_files[0];
                $returnData['directories'] = $scanned_dirs;
                $returnData['files'] = $scanned_files;

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
            // try{
            //     $query = $readDB->prepare('select id, title, description, DATE_FORMAT(deadline, "%d/%m/%Y %H:%i") as deadline, completed from tbltasks where id = :taskid');
            //     $query->bindParam(':taskid', $taskid, PDO::PARAM_INT);
            //     $query->execute();

            //     $rowCount = $query->rowCount();

            //     if($rowCount === 0) {
            //         $response = new Response();
            //         $response->setHttpStatusCode(404);
            //         $response->setSuccess(false);
            //         $response->addMessage('Task not found');
            //         $response->send();
            //         exit;
            //     }

            //     while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            //         $task = new Task($row['id'], $row['title'], $row['description'], $row['deadline'], $row['completed']);
            //         $taskArray[] = $task->returnTaskAsArray();
            //     }
            //     $returnData = array();
            //     $returnData['rows_returned'] = $rowCount;
            //     $returnData['tasks'] = $taskArray;

            //     $response = new Response();
            //     $response->setHttpStatusCode(200);
            //     $response->setSuccess(true);
            //     $response->toCache(true);
            //     $response->setData($returnData);
            //     $response->send();
            //     exit;
            // }
            // catch(TaskException $ex){
            //     $response = new Response();
            //     $response->setHttpStatusCode(500);
            //     $response->setSuccess(false);
            //     $response->addMessage($ex->getMessage());
            //     $response->send();
            //     exit;
            // }
            // catch(PDOException $ex){
            //     error_log('Database query error - '.$ex, 0);
            //     $response = new Response();
            //     $response->setHttpStatusCode(500);
            //     $response->setSuccess(false);
            //     $response->addMessage('Failed to get Task');
            //     $response->send();
            //     exit();
            // }
        } 
        elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            try{
                $query = $writeDB->prepare('delete from tbltasks where id = :taskid');
                $query->bindParam(':taskid', $taskid, PDO::PARAM_INT);
                $query->execute();

                $rowCount = $query->rowCount();

                if($rowCount === 0) {
                    $response = new Response();
                    $response->setHttpStatusCode(404);
                    $response->setSuccess(false);
                    $response->addMessage('Task not found');
                    $response->send();
                    exit;
                }

                $response = new Response();
                $response->setHttpStatusCode(200);
                $response->setSuccess(true);
                $response->addMessage("Task deleted");
                $response->send();
                exit;
            }
            catch(PDOException $ex) {
                $response = new Response();
                $response->setHttpStatusCode(500);
                $response->setSuccess(false);
                $response->addMessage('Failes to delete taks');
                $response->send();
                exit;
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'PATCH') {

            try {
                if($_SERVER['CONTENT_TYPE'] !== 'application/json') {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage('Content Type header not set to JSON');
                    $response->send();
                    exit;
                }

                $rawPatchData = file_get_contents('php://input');

                if(!$jsonData = json_decode($rawPatchData)) {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage('Request body is not valid JSON');
                    $response->send();
                    exit;
                }

                $title_updated = false;
                $description_updated = false;
                $deadline_updated = false;
                $completed_updated = false;

                $queryFields = '';

                if(isset($jsonData->title)) {
                    $title_updated = true;
                    $queryFields .= 'title = :title, ';
                }

                if(isset($jsonData->description)) {
                    $description_updated = true;
                    $queryFields .= 'description = :description, ';
                }

                if(isset($jsonData->deadline)) {
                    $deadline_updated = true;
                    $queryFields .= "deadline = STR_TO_DATE(:deadline, '%d/%m/%Y %H:%i'), ";
                }

                if(isset($jsonData->completed)) {
                    $completed_updated = true;
                    $queryFields .= 'completed = :completed, ';
                }

                $queryFields = rtrim($queryFields, ", ");

                if($title_updated === false && $description_updated === false && $deadline_updated === false && $completed_updated === false){
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage('No task fields provided');
                    $response->send();
                    exit;
                }

                $query = $writeDB->prepare('select id, title, description, DATE_FORMAT(deadline, "%d/%m/%Y %H:%i") as deadline, completed from tbltasks where id = :taskid');
                $query->bindParam(':taskid', $taskid, PDO::PARAM_INT);
                $query->execute();

                $rowCount = $query->rowCount();

                if($rowCount === 0) {
                    $response = new Response();
                    $response->setHttpStatusCode(404);
                    $response->setSuccess(false);
                    $response->addMessage('No tasks found to update');
                    $response->send();
                    exit;
                }

                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $task = new Task($row['id'], $row['title'], $row['description'], $row['deadline'], $row['completed']);
                }

                $queryString = "update tbltasks set ".$queryFields." where id = :taskid";
                $query = $writeDB->prepare($queryString);

                if($title_updated === true){
                    $task->setTitle($jsonData->title);
                    $up_title = $task->getTitle();
                    $query-> bindParam(':title', $up_title, PDO::PARAM_STR);
                }

                if($description_updated === true){
                    $task->setDescription($jsonData->description);
                    $up_description = $task->getDescription();
                    $query-> bindParam(':description', $up_description, PDO::PARAM_STR);
                }

                if($deadline_updated === true){
                    $task->setDeadline($jsonData->deadline);
                    $up_deadline = $task->getDeadline();
                    $query-> bindParam(':deadline', $up_deadline, PDO::PARAM_STR);
                }

                if($completed_updated === true){
                    $task->setCompleted($jsonData->completed);
                    $up_completed = $task->getCompleted();
                    $query-> bindParam(':completed', $up_completed, PDO::PARAM_STR);
                }

                $query->bindParam(':taskid', $taskid, PDO::PARAM_INT);
                $query->execute();

                $rowCount = $query->rowCount();

                if($rowCount === 0) {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage('Task not updated');
                    $response->send();
                    exit;
                }

                $query = $writeDB->prepare('select id, title, description, DATE_FORMAT(deadline, "%d/%m/%Y %H:%i") as deadline, completed from tbltasks where id = :taskid');
                $query->bindParam(':taskid', $taskid, PDO::PARAM_INT);
                $query->execute();

                $rowCount = $query->rowCount();

                if($rowCount === 0) {
                    $response = new Response();
                    $response->setHttpStatusCode(404);
                    $response->setSuccess(false);
                    $response->addMessage('No task found after update');
                    $response->send();
                    exit;
                }

                $taskArray = array();
                
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $task = new Task($row['id'], $row['title'], $row['description'], $row['deadline'], $row['completed']);
                    $taskArray[] = $task->returnTaskAsArray();
                }

                $returnData = array();
                $returnData['rows_returned'] = $rowCount;
                $returnData['tasks'] = $taskArray;

                $response = new Response();
                $response->setHttpStatusCode(200);
                $response->setSuccess(true);
                $response->addMessage('Task updated');
                $response->setData($returnData);
                $response->send();
                exit;
            }
            catch(TaskException $ex){
                $response = new Response();
                $response->setHttpStatusCode(400);
                $response->setSuccess(false);
                $response->addMessage($ex->getMessage());
                $response->send();
                exit;
            }
            catch(PDOException $ex){
                error_log('Database query error - '.$ex, 0);
                $response = new Response();
                $response->setHttpStatusCode(500);
                $response->setSuccess(false);
                $response->addMessage('Failed to update task - check your data for errors');
                $response->send();
                exit;
            }
        } else {
            $response = new Response();
            $response->setHttpStatusCode(405);
            $response->setSuccess(false);
            $response->addMessage('Request method not allowed');
            $response->send();
            exit;
        }
    } 
    elseif (array_key_exists('completed', $_GET)){
        $completed = $_GET['completed'];

        if($completed !== 'Y' && $completed !== 'N'){
>>>>>>> 54869f45668609d44ff2ba5db29367bb90a1783d
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
<<<<<<< HEAD
                sort($scanned_dirs);
=======
>>>>>>> 54869f45668609d44ff2ba5db29367bb90a1783d

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
<<<<<<< HEAD
=======
                $response = new Response();
                $response->setHttpStatusCode(500);
                $response->setSuccess(false);
                $response->addMessage($ex->getMessage());
                // $response->addMessage('Bart Failed to get Task');
                $response->send();
                exit();
            }

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

            try {
                if($_SERVER['CONTENT_TYPE'] !== 'application/json') {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage('Content type header is not set to JSON');
                    $response->send();
                    exit;
                }

                $rawPOSTData = file_get_contents('php://input');

                if(!$jsonData = json_decode($rawPOSTData)){
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    $response->addMessage('Request body is not valid JSON');
                    $response->send();
                    exit;
                }

                if(!isset($jsonData->title) || !isset($jsonData->completed)) {
                    $response = new Response();
                    $response->setHttpStatusCode(400);
                    $response->setSuccess(false);
                    (!isset($jsonData->title) ? $response->addMessage('Title field is mandatory and must be provided') : false);
                    (!isset($jsonData->completed) ? $response->addMessage('Completed field is mandatory and must be provided') : false);
                    $response->send();
                    exit;
                }

                $newTask = new Task(null, $jsonData->title, (isset($jsonData->description) ? $jsonData->description : null), (isset($jsonData->deadline) ? $jsonData->deadline : null), $jsonData->completed);

                $title = $newTask->getTitle();
                $description = $newTask->getDescription();
                $deadline = $newTask->getDeadline();
                $completed = $newTask->getCompleted();

                $query = $writeDB->prepare('insert into tbltasks (title, description, deadline, completed) values (:title, :description, STR_TO_DATE(:deadline, \'%d/%m/%Y %H:%i\'), :completed)');
                $query->bindParam(':title', $title, PDO::PARAM_STR);
                $query->bindParam(':description', $description, PDO::PARAM_STR);
                $query->bindParam(':deadline', $deadline, PDO::PARAM_STR);
                $query->bindParam(':completed', $completed, PDO::PARAM_STR);
                $query->execute();

                $rowCount = $query->rowCount();

                if($rowCount === 0) {
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage('Failed to create task');
                    $response->send();
                    exit;
                }
                
                $lastTaskID = $writeDB->lastInsertId();

                $query = $writeDB->prepare('select id, title, description, DATE_FORMAT(deadline, "%d/%m/%Y %H:%i") as deadline, completed from tbltasks where id = :taskid');
                $query->bindParam(':taskid', $lastTaskID, PDO::PARAM_INT);
                $query->execute();

                $rowCount = $query->rowCount();

                if($rowCount === 0) {
                    $response = new Response();
                    $response->setHttpStatusCode(500);
                    $response->setSuccess(false);
                    $response->addMessage('Failed to retrieve task after creation');
                    $response->send();
                    exit;
                }

                $taskArray = array();

                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $task = new Task($row['id'], $row['title'], $row['description'], $row['deadline'], $row['completed']);

                    $taskArray[] = $task->returnTaskAsArray();
                }

                $returnData = array();
                $returnData['rows_returned'] = $rowCount;
                $returnData['tasks'] = $taskArray;
                
                $response = new Response();
                $response->setHttpStatusCode(201);
                $response->setSuccess(true);
                $response->addMessage('Task created');
                $response->setData($returnData);
                $response->send();
                exit;


            }
            catch(TaskException $ex) {
                $response = new Response();
                $response->setHttpStatusCode(400);
                $response->setSuccess(false);
                $response->addMessage($ex->getMessage());
                $response->send();
                exit;
            }
            catch(PDOException $ex){
                error_log('Database query error -'.$ex, 0);
>>>>>>> 54869f45668609d44ff2ba5db29367bb90a1783d
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