<?php
class AdminDashboardModel {
    private $conn;
    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getSumByStatus($status) {
        $query = $this->conn->prepare("SELECT total_price FROM orders WHERE payment_status = ?");
        $query->bind_param("s", $status);
        $query->execute();
        $result = $query->get_result();
        $sum = 0;
        while ($row = $result->fetch_assoc()) {
            $sum += $row['total_price'];
        }
        return $sum;
    }

    public function countRows($table, $where = "") {
        $queryStr = "SELECT * FROM $table" . ($where ? " WHERE $where" : "");
        $result = mysqli_query($this->conn, $queryStr);
        return mysqli_num_rows($result);
    }
}
?>