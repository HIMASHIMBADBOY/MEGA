<?php
require_once "../config/dbh.classes.php";

class feedback extends Db{

  protected function getFeedback($user_id) {
    $sql = "SELECT feedbacks.message, feedbacks.confirmation_letter, applications.field_id, applications.user_id
            FROM feedbacks 
            JOIN applications ON feedbacks.application_id = applications.id
            WHERE applications.user_id = ?;";
    $stmt = $this->connection()->prepare($sql);
    $params = array($user_id);
    $stmt->execute($params);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
     //var_dump($result);
    // return $results;
    // var_dump($result[0]["field_id"]);
    $results = [];
    if($result){
       foreach($result as $row)
       {
        $query = "SELECT fields.field_name FROM fields
        JOIN applications ON applications.field_id = fields.field_id
        WHERE fields.field_id =" .$row["field_id"] .";";

    
        $stm = $this->connection()->prepare($query);
        $stm->execute();
        $res = $stm->fetchAll(PDO::FETCH_ASSOC);
        
        if($res)
      {
        $row['field_name'] = $res[0]['field_name'];
        $results[] = $row; // Append each notification to results
        //var_dump($results);
      }
      }
     
      

      }
      return $results; // Return all notifications
    }

      }
     
      

    
