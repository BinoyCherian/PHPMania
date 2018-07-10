<?php


require_once("database.php");

/** Access to the user table.
 * Put here the methods like insertforSomeCriteriaSEarch */
class UserModel {

    /** Get d data for id $personId
     * (here demo with a SQL request about an existing table)
     * @param int $personId id of the quizz to be retrieved
     * @return associative_array table row
     */
	 
	  public static function get($userId) {
        $db = Database::getConnection();
        $sql = "SELECT *
              FROM user
              WHERE user_id = :userid";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":userid", $userId);
        $ok = $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
	
	
    public static function register($firstname, $name, $email, $password, $token) {
        $db = Database::getConnection();
		
		$sql  = "SELECT MAX(user_id) as user_id FROM user;";
		$stmt = $db->prepare($sql);
		$ok = $stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		//echo $row['user_id'];
		
		$last_user_id = empty($row['user_id'])?0:$row['user_id'];
		$next_user_id = (int)($last_user_id+1);
		
				
		$insql ="INSERT INTO user(user_id,email,pwd,name,first_name,token,created_at) VALUES
		 ($next_user_id,'$email','$password', '$name', '$firstname', '$token', NOW())";
	  
		 $instmt = $db->prepare($insql);
		 /*
		$instmt->bindValue(":user_id", (int)$next_user_id);
        $instmt->bindValue(":email", $email);
		$instmt->bindValue(":password", $password);
		$instmt->bindValue(":first_name", $firstname);
		$instmt->bindValue(":name", $name);
		$instmt->bindValue(":token", $token); */
	
        return $instmt->execute();
		
    }

    public static function getByLoginPassword($email, $password) {
        $db = Database::getConnection();
        $sql = "SELECT *
            FROM member
            WHERE email = :email AND password = :password";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":password", $password);
        $ok = $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>