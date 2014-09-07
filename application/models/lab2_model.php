<?php

class Lab2Model {

   function __construct(Database $db) {
       try {
           $this->db = $db;
       } catch (PDOException $e) {
           exit('db connection could not be established.');
       }
   }

    public function getAllItems() {
        $sql = "SELECT id, author, product, manufactor, quantity, description, demand FROM Items";
        $query = $this->db->prepare($sql);
        $query->execute();
       
        return $query->fetchAll();
       
    }

    public function getById($id) {
        $sql = "SELECT * FROM Items WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }

    public function addItem() {
        
        if ( empty($_POST['author']) || strlen($_POST['author']) > 45 ) {
	        return false;
        } elseif ( empty($_POST['product']) ||  strlen($_POST['author']) > 45) {
	        return false;
	    } elseif ( empty($_POST['manufactor'])  || strlen($_POST['author']) > 45) {
		    return false;
	    } elseif ( empty($_POST['quantity']) || strlen($_POST['quantity']) > 6) {
		    return false;
	    } elseif ( strlen($_POST['description']) > 550 ) {
		    return false;
	    }
        
        
        $ownerId = Session::get('user_id');
        $author = strip_tags($_POST['author']);
        $product = strip_tags($_POST['product']);
        $manufactor = strip_tags($_POST['manufactor']);
        $quantity = strip_tags($_POST['quantity']);
        $description = strip_tags($_POST['description']);
		
		$demand = rand(2, 10) * $quantity;
		
        $sql = "INSERT INTO Items(author, product, ownerId, manufactor, quantity, description, demand) VALUES (:author, :product, :ownerId, :manufactor, :quantity, :description, :demand)";
        $query = $this->db->prepare($sql);
        $query->execute(array(':author'=>$author, ':product'=>$product, ':ownerId'=>$ownerId, ':manufactor'=>$manufactor, ':quantity'=>$quantity, ':description'=>$description, ':demand'=>$demand));
		
		
        
        $count = $query->rowCount();
        if ( $count == 1 ) {
            return true;
        }

        $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_CREATION_FAILED;
        return false;

    }

    public function deleteById($itemId) {
		
        $sql = "DELETE FROM Items WHERE id = :itemId";
        $query = $this->db->prepare($sql);
        $query->execute(array(':itemId' => $itemId));

        $count = $query->rowCount();

        if ( $count == 1 ) {
            return true;
        }

        $_SESSION["feedback_negative"][] = FEEDBACK_NOTE_DELETION_FAILED;
        return false;
    }
}


