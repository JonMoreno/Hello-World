<?php   
 
namespace App\Core; 

use \PDO;
  
class QueryBuilder
{
    /*
    |---------------------------------------------------------------------------
    | Class QueryBuilder
    |---------------------------------------------------------------------------
    | Purpose: 
    | Creates Sql commands using PDO consistent interface for
    | accessing database.
    | 
    |       
    */
    

    /**
    * Store Database object.
    *
    * @var object.
    */
    protected $pdo;
    protected $query;
    protected $stmt;
    protected $records;


    /**
    * Create Database object.
    * 
    * @param Mysql PDO
    */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    
    /**
    * Returns records
    * Work in correleation with method 'selectAll'.
    * 
    * @return type json 
    */
    public function records() 
    {
        return $this->{$this->stmt}();
    }
    
    
    /**
    * Creates a select statement for desired table.
    * Notifies property wich method will handle the statement.
    * 
    * @param $table type string.
    * @return self object.
    */
    public function selectAll($table)
    {
        $this->query = " SELECT * FROM {$table} ";
        $this->stmt  = 'execute'. __FUNCTION__;
        return $this;
    }
    
    
    /**
    * Selects from desired table.
    * Works in correlation with method selectAll().
    *
    * @return json.
    */
    public function executeSelectAll() 
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        $results =  $statement->fetchAll(PDO::FETCH_ASSOC); 
        $json = json_encode($results );
        $statement->closeCursor();
        
        return $json;
    }
    
        
    /**
    * Inserts records into desired table 
    * with as many fields as needed.
    * 
    * @param $table type string.
    * @param $values type assoc array. (rowName => rowValue)
    */
    public function saveAll($table , $values) 
    {
        // Table headers.
        $rowNames = implode(' , ' , array_keys($values));

        // Binding Values.
        $altInput= [];
        foreach($values as $key => $val) {
            $stripVal = preg_replace('/[$]/', '', $val);
            $altInput[':'.$key] = $stripVal;
        }
        $bindVals = implode(' , ', array_keys($altInput));
        
        // SQL Query.
        $this->query = "INSERT INTO {$table} ( {$rowNames} ) VALUES ( {$bindVals} )";
        

        $statement = $this->pdo->prepare($this->query);
        
        foreach($altInput as $key => $val){
            
            
                $statement->bindValue($key , $val);
     
        }
        $statement->execute();
        $statement->closeCursor();
    }
 
    /**
    * Delete a single row by a primary key or 
    * a unique identifier.
    * 
    * @param type $table string
    * @param type $primaryKey string
    * @param type $id  string
    */
    public function delete($table, $primaryKey , $id)
    {
        $this->query = "DELETE FROM {$table} WHERE {$primaryKey} = :{$primaryKey}";
        $statement = $this->pdo->prepare($this->query);
        $statement->bindValue(":{$primaryKey}", $id);
        $statement->execute();
        $statement->closeCursor();
    }
    
    
    /**
     * Validate values on two desired rows.
     * Best used for log in credentials.
     * 
     * @param type $table string
     * @param type $values array
     * @return boolean
     */
    public function validator($table, $values)
    {

          $row = array_keys($values);
          $val = array_values($values);
          
          $username = $val[0];
          $password = sha1($val[0].$val[1]);
          
          
          $this->query = "SELECT * FROM {$table} WHERE {$row[0]} = :{$row[0]}
                       AND {$row[1]} = :{$row[1]}" ;
                       
          $statement = $this->pdo->prepare($this->query);
          $statement->bindValue( ":{$row[0]}" , $username );
          $statement->bindValue( ":{$row[1]}" , $password );
          $statement->execute();
          $valid = ($statement->rowCount() == 1);
          
          $statement->closeCursor();
          
          return $valid;
    }
   
    
    /**
    * Order query column by ascending or descending
    * 
    * @param $columnName type string.
    * @param $ascdesc type string.
    * @return self object.
    */
    public function orderBy($columnName, $ascdesc)
    {
        $this->query .= " ORDER BY {$columnName} {$ascdesc} ";
        return $this;
    }
      
    
   
}