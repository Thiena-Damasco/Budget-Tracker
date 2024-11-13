<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Dashboard_model extends Model {
    
    public function __construct()
    {
        parent::__construct();
    }

    public function get_budget_overview($user_id) {
        // Start building the query
        return $this->db->raw("
                SELECT 
                    b.budget_id,
                    b.amount_limit,
                    b.duration,
                    c.name AS category_name,
                    COALESCE(SUM(t.amount), 0) AS total_spent,
                    (b.amount_limit - COALESCE(SUM(t.amount), 0)) AS remaining_budget
                FROM 
                    budgets AS b
                JOIN 
                    categories AS c ON b.category_id = c.category_id
                LEFT JOIN 
                    transactions AS t ON b.category_id = t.category_id AND t.user_id = b.user_id
                WHERE 
                    b.user_id = ? 
                    AND (
                        (b.duration = 'monthly' AND t.date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) OR
                        (b.duration = 'weekly' AND t.date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK))
                    )
                GROUP BY 
                    b.budget_id
            ", array($user_id), PDO::FETCH_ASSOC);  

            
    }

    public function get_goal_progress($user_id) {
        return $this->db->raw("
                SELECT 
                    goal_id,
                    goal_name,
                    target_amount,
                    saved_amount,
                    ROUND((saved_amount / target_amount) * 100, 2) AS progress_percentage,
                    start_date,
                    end_date
                FROM 
                    goals
                WHERE 
                    user_id = ?
            ", array($user_id), PDO::FETCH_ASSOC);  
    }

    public function get_recent_transactions($user_id) {
        return $this->db->raw("
                SELECT 
                    t.transaction_id,
                    c.name AS category_name,
                    t.amount,
                    t.date,
                    t.recurring,
                    t.created_at
                FROM 
                    transactions t
                JOIN 
                    categories c ON t.category_id = c.category_id
                WHERE 
                    t.user_id = ?
                ORDER BY 
                    t.created_at DESC
                LIMIT 10; 
            ", array($user_id), PDO::FETCH_ASSOC);
    }

    public function get_spending_notification($user_id){
        return $this->db->raw("
                SELECT 
                    notification_id,
                    type,
                    message,
                    date,
                    is_sent
                FROM 
                    notifications
                WHERE 
                    user_id = ?
                    AND is_sent = 0
                ORDER BY 
                    date DESC;
            ", array($user_id), PDO::FETCH_ASSOC);
    }

    public function get_feedback_and_ratings($user_id) {
        $result = $this->db->raw("
            SELECT 
                feedback_id,
                feedback_text,
                rating,
                submitted_at,
                (SELECT AVG(CAST(rating AS UNSIGNED)) FROM user_feedback WHERE user_id = ?) AS average_rating
            FROM 
                user_feedback
            WHERE 
                user_id = ?
            ORDER BY 
                submitted_at DESC
            LIMIT 5;
        ", array($user_id, $user_id), PDO::FETCH_ASSOC);
    
        // Fetch all results as an associative array
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function get_login_history($user_id) {
        return $this->db->raw("
                SELECT 
                    log_id,
                    login_time,
                    logout_time
                FROM 
                    log_history
                WHERE 
                    user_id = ?
                ORDER BY 
                    login_time DESC
                LIMIT 5; 

            ", array($user_id), PDO::FETCH_ASSOC);
    }

    public function get_profile_summary($user_id) {
        return $this->db->raw("
                SELECT 
                    user_id,
                    firstname,
                    lastname,
                    gender,
                    email,
                    created_at
                FROM 
                    users
                WHERE 
                    user_id = ?

            ", array($user_id), PDO::FETCH_ASSOC);
    }
}
?>
