<?php
    include_once '../Model/food.php';

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
$method = $_SERVER['REQUEST_METHOD'];
$format = isset($_REQUEST['format']) ? $_REQUEST['format'] : 'web';
$view 	= null;

switch ($action . '_' . $method) {
	case 'create_GET':
		$model = Food::Blank();
		$view = "food/edit.php";
		break;
	case 'save_POST':
			$sub_action = empty($_REQUEST['Food_id']) ? 'Created_at' : 'Updated_at';
			$errors = Food::Validate($_REQUEST);
			if(!$errors){
				$errors = Food::Save($_REQUEST);
			}
			
			if(!$errors){
				if($format == 'json'){
					header("Location: ?action=edit&format=json&id=$_REQUEST[Food_id]");
				}else{
					header("Location: ?sub_action=$sub_action&id=$_REQUEST[Food_id]");
				}
				die();
			}else{
				//my_print($errors);
				$model = $_REQUEST;
				$view = "food/edit.php";		
			}
			break;
	case 'edit_GET':
		$model = Food::Get($_REQUEST['Food_id']);
		$view = "food/edit.php";		
		break;
	case 'delete_GET':
		$model = Food::Get($_REQUEST['Food_id']);
		$view = "food/delete.php";		
		break;
	case 'delete_POST':
		$errors = Food::Delete($_REQUEST['Food_id']);
		if($errors){
				$model = Food::Get($_REQUEST['Food_id']);
				$view = "food/delete.php";
		}else{
				header("Location: ?sub_action=$sub_action&id=$_REQUEST[Food_id]");
				die();			
		}
		break;
	case 'search_GET':
		$model = Food::Search($_REQUEST['q']);
		$view = 'food/index.php';		
		break;
	case 'index_GET':
	default:
		$model = Food::Get();
		$view = 'food/index.php';		
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

