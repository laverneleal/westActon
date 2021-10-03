<?php

class database{

    private $servername = "127.0.0.1";
    private $username ="root";
    private $password = "";
    private $databasename = "westacton";
    public $db;

    public function __construct(){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db = $conn;
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }

    public function read( $table ){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('SELECT * FROM '.$table.' ORDER BY id');
            $stmt->execute();
            return $stmt;
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }    
    }

    public function check_stocks( $table, $data){
        try {
            $check_stocks = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $check_stocks->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $check_stocks->prepare('SELECT stock,price FROM '.$table.' WHERE product = ? ');
            $stmt->execute([ $data['product'] ] );
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            return $product;
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }        
    }

    public function update_stock( $table, $data ){
        try{

            $check_stocks = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $check_stocks->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $check_stocks->prepare('SELECT stock,price FROM '.$table.' WHERE product = ? ');
            $stmt->execute([ $data['product'] ] );
            $stock = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $product = isset($data['product']) ? $data['product'] : '';
            $deduct = isset($data['stock']) ? $data['stock'] : '';
            $updated_at = date('Y-m-d h:i:s');
            $stocks =  (json_decode($stock['stock']) - $deduct);

            // Update the record
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $stmt = $conn->prepare('UPDATE '.$table.' SET stock = ?, updated_at = ? WHERE  product = ?'); 
            $stmt->execute([ $stocks , $updated_at, $product ]);


        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }  
    }

    public function insert( $table, $table2, $data ){
        try{

            //update stocks
            $check_stocks = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $check_stocks->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $check_stocks->prepare('SELECT stock,price FROM '.$table2.' WHERE product = ? ');
            $stmt->execute([ $data['product'] ] );
            $stock_count = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $product = isset($data['product']) ? $data['product'] : '';
            $deduct = isset($data['stock']) ? $data['stock'] : '';
            $updated_at = date('Y-m-d h:i:s');
            $stocks =  (json_decode($stock_count['stock']) - $deduct);

            // Update the record
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $stmt = $conn->prepare('UPDATE '.$table2.' SET stock = ?, updated_at = ? WHERE  product = ?'); 
            $stmt->execute([ $stocks , $updated_at, $product ]);

            
            $id = isset($data['id']) && !empty($data['id']) && $data['id'] != 'auto' ? $data['id'] : NULL;
            $product = isset($data['product']) ? $data['product'] : '';
            $stock = isset($data['stock']) ? $data['stock'] : '';
            $price = isset($data['price']) ? $data['price'] : '';
            $prices = (json_decode( $stock_count['price']) * $stock);
            $updated_at = date('Y-m-d H:i:s');

            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('INSERT INTO '.$table.' VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([ $id, $product, $stock, $prices, $updated_at ]); 

            header('Location: sales.php');
            exit;       
            
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }
    }

    public function displayRecord( $table, $id ){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare('SELECT * FROM '.$table.' WHERE id = ?');
            $stmt->execute( [ $id ] );
            $contact = $stmt->fetch(PDO::FETCH_ASSOC);
            return $contact;
        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }          
    }

    public function update($table, $id){
        try{
            $id = isset($_POST['id']) ? $_POST['id'] : NULL;
            $product = isset($_POST['product']) ? $_POST['product'] : '';
            $stock = isset($_POST['stock']) ? $_POST['stock'] : '';
            $price = isset($_POST['price']) ? $_POST['price'] : '';
            $updated_at = date('Y-m-d h:i:s');

            // Update the record
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $stmt = $conn->prepare('UPDATE '.$table.' SET id = ?, product = ?, stock = ?, price = ?, updated_at = ? WHERE id = ?'); //, created = ? 
            $stmt->execute([$id, $product, $stock, $price, $updated_at, $_GET['id']]); //$created,

            header('Location: sales.php');
            exit;

        }catch(PDOException $e){
            die("Failed to connect with MySQL: " . $e->getMessage());
        }    
    }

    public function delete( $table, $id){
        try{
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->databasename, $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            
            $stmt = $conn->prepare('DELETE FROM '.$table.' WHERE id = ?');
            $stmt->execute([$id]);
        }catch(PDOException $e){
            die("Failed to connect with MySQL: ". $e->getMessage());
        }
    }    


}

?>