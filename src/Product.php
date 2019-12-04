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
        @pid := product.product_id as product_id,
        name,
        description,
        price,
        (SELECT @img_id := image_id FROM product_image WHERE product_id = @pid LIMIT 1) as image_id,
        (SELECT image_file_name FROM image WHERE image_id = @img_id) as image
        FROM product
        WHERE active = 1
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