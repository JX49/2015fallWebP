<?php
require_once '../inc/global.php';

class Food {
    public static function Get($id = null){
        $sql = "SELECT * FROM Food";
        
		if($id){
			$sql .= " WHERE Food_id=$id ";
			$ret = FetchAll($sql);
			return $ret[0];
		}else{
			return FetchAll($sql);			
		}
		
    }
    
    static public function Delete($id)
	{
		$conn = GetConnection();
		$sql = "DELETE FROM Food WHERE Food_id = $id";
		//echo $sql;
		$results = $conn->query($sql);
		$error = $conn->error;
		$conn->close();
		
		return $error ? array ('sql error' => $error) : false;
	}
	
	static public function Blank()
	{
		return array();
	}



		static public function Validate($row)
		{
			$errors = array();
			if(empty($row['Name'])) $errors['Name'] = "is required";
			if(strtotime($row['Time']) > time()) $errors['Time'] = "must be in the past";
			if(!is_numeric($row['Calories'])) $errors['Calories'] = "Calories must be a number";
			
			return count($errors) > 0 ? $errors : false ;
		}
	
		static public function Save(&$row)
		{
			$conn = GetConnection();
			
			$row2 = escape_all($row, $conn);
			$row2['Time'] = date( 'Y-m-d H:i:s', strtotime( $row2['Time'] ) );
			if (!empty($row['Food_id'])) {
				$sql = "Update Food
							Set Name='$row2[Name]', Time='$row2[Time]', Calories= '$row2[Calories]'
						WHERE Food_id = $row2[Food_id]
						";
			}else{
				$sql = "INSERT INTO Food
						(Name, Time, Created_at, Calories)
						VALUES ('$row2[Name]', '$row2[Time]', Now(), '$row2[Calories]' ) ";				
			}
			
			
			//my_print( $sql );
			
			$results = $conn->query($sql);
			$error = $conn->error;
			
			if(!$error && empty($row['Food_id'])){
				$row['Food_id'] = $conn->insert_id;
			}
			
			$conn->close();
			
			return $error ? array ('sql error' => $error) : false;
		}


}




