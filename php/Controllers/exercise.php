<?php
    include_once '../Model/exercise.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$method = $_SERVER['REQUEST_METHOD'];
$format = isset($_REQUEST['format']) ? $_REQUEST['format'] : 'web';
$view 	= null;

switch ($action . '_' . $method) {
	case 'create_GET':
		$model = Exercise::Blank();
		$view = "exercise/edit.php";
		break;
	case 'save_POST':
			$sub_action = empty($_REQUEST['Exercise_id']) ? 'Created_at' : 'Updated_at';
			$errors = Exercise::Validate($_REQUEST);
			if(!$errors){
				$errors = Exercise::Save($_REQUEST);
			}
			
			if(!$errors){
				if($format == 'json'){
					header("Location: ?action=edit&format=json&id=$_REQUEST[Exercise_id]");
				}else{
					header("Location: ?sub_action=$sub_action&id=$_REQUEST[Exercise_id]");
				}
				die();
			}else{
				//my_print($errors);
				$model = $_REQUEST;
				$view = "exercise/edit.php";		
			}
			break;
	case 'edit_GET':
		$model = Exercise::Get($_REQUEST['Exercise_id']);
		$view = "exercise/edit.php";		
		break;
	case 'delete_GET':
		$model = Exercise::Get($_REQUEST['Exercise_id']);
		$view = "exercise/delete.php";		
		break;
	case 'delete_POST':
		$errors = Exercise::Delete($_REQUEST['Exercise_id']);
		if($errors){
				$model = Exercise::Get($_REQUEST['Exercise_id']);
				$view = "exercise/delete.php";
		}else{
				header("Location: ?sub_action=$sub_action&id=$_REQUEST[Exercise_id]");
				die();			
		}
		break;
	case 'search_GET':
		$model = Exercise::Search($_REQUEST['q']);
		$view = 'exercise/index.php';		
		break;
	case 'index_GET':
	default:
		$model = Exercise::Get();
		$view = 'exercise/index.php';		
		break;
}

switch ($format) {
	case 'json':
		echo json_encode($model);
		break;
	case 'plain':
		include __DIR__ . "/../Views/$view";		
		break;		
	case 'web':
	default:
		include __DIR__ . "/../Views/shared/_template.php";		
		break;
}
