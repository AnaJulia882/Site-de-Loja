<?php
class WishlistModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getWishlistByUserId($user_id) {
        return mysqli_query($this->conn, "SELECT * FROM wishlist WHERE user_id = '$user_id'");
    }

    public function deleteItem($id) {
        return mysqli_query($this->conn, "DELETE FROM wishlist WHERE id = '$id'");
    }

    public function deleteAllByUser($user_id) {
        return mysqli_query($this->conn, "DELETE FROM wishlist WHERE user_id = '$user_id'");
    }
}
?>