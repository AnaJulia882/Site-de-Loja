<?php
class CartModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCartItems($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function updateQuantity($cart_id, $quantity) {
        $stmt = $this->conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $stmt->bind_param("ii", $quantity, $cart_id);
        return $stmt->execute();
    }

    public function removeItem($cart_id) {
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $cart_id);
        return $stmt->execute();
    }

    public function clearCart($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        return $stmt->execute();
    }

    public function getItemCount($user_id) {
        $res = mysqli_query($this->conn, "SELECT COUNT(*) as total FROM cart WHERE user_id = '$user_id'");
        return mysqli_fetch_assoc($res)['total'] ?? 0;
    }

    // ✅ Método que faltava
    public function handleAdd($user_id, $post_data, $wishlistModel = null) {
        $product_id = $post_data['product_id'];
        $product_name = $post_data['product_name'];
        $product_price = floatval(str_replace(',', '.', $post_data['product_price']));
        $product_image = $post_data['product_image'];
        $product_quantity = intval($post_data['product_quantity']);

        // Verificar se o item já está no carrinho
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return 'Produto já está no carrinho!';
        } else {
            $stmt = $this->conn->prepare("INSERT INTO cart (user_id, product_id, name, price, image, quantity) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("iisisi", $user_id, $product_id, $product_name, $product_price, $product_image, $product_quantity);

            if ($stmt->execute()) {
                return 'Produto adicionado ao carrinho com sucesso!';
            } else {
                return 'Erro ao adicionar ao carrinho.';
            }
        }
    }
}
?>
