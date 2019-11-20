<?php
namespace oldspice;

use oldspice\Database;
use \Exception;

class Product extends Database{
    public function __construct(){
        parent::__construct();  
    }

    public function getProdcuts(){
        $qurey = "
        SELECT
        product_id,
        name,
        description
        price
        FROM product
        ";

        try{
            $statement = $this -> connection -> prepare( $qurey );
            if( $statement -> execute() == false ){
                throw new Exception("query failed to execute");
            }
        }
        catch(Exception $exc){
            echo $exc;
        }
        $result = $statement -> get_result();
        //prodcut array
        $products = array();
        //loop through result and add to array
        while( $row = $result -> fetch_assoc()){
            array_push( $products, $row);
        }
        return $products;
    }
}

?>