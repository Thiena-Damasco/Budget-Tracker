<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Dashboard_controller extends Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->call->model('dashboard_model');
    }

    
    public function get_dashboard($user_id) {
        $data = [
            'budget_overview' => $this->dashboard_model->get_budget_overview($user_id),
            'goal_progress' => $this->dashboard_model->get_goal_progress($user_id),
            'recent_transactions' => $this->dashboard_model->get_recent_transactions($user_id),
            'spending_notifications' => $this->dashboard_model->get_spending_notification($user_id),
            'feedbacks_and_ratings' => $this->dashboard_model->get_feedback_and_ratings($user_id),
            'login_history' => $this->dashboard_model->get_login_history($user_id),
            'profile_summary' => $this->dashboard_model->get_profile_summary($user_id),
        ];
        return $this->call->view('user/dashboard', $data);
    }
}
?>
