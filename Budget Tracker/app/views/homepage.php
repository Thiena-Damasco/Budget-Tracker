<?php
include APP_DIR.'views/templates/header.php';
?>
<body>
    <div id="app">
    <?php
    include APP_DIR.'views/templates/nav.php';
    ?>  
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h2>Budget Overview</h2>
    <?php if (!empty($budget_overview)) : ?>
        <?php foreach ($budget_overview as $row) : ?>
            <p>Budget ID: <?= $row['budget_id'] ?></p>
            <p>Category Name: <?= $row['category_name'] ?></p>
            <p>Amount Limit: <?= $row['amount_limit'] ?></p>
            <p>Total Spent: <?= $row['total_spent'] ?></p>
            <p>Remaining Budget: <?= $row['remaining_budget'] ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No budget data available.</p>
    <?php endif; ?>

    <h2>Goal Progress</h2>
    <?php if (!empty($goal_progress)) : ?>
        <?php foreach ($goal_progress as $row) : ?>
            <p>Goal Name: <?= $row['goal_name'] ?></p>
            <p>Target Amount: <?= $row['target_amount'] ?></p>
            <p>Saved Amount: <?= $row['saved_amount'] ?></p>
            <p>Start Date: <?= $row['start_date'] ?></p>
            <p>End Date: <?= $row['end_date'] ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No goal data available.</p>
    <?php endif; ?>

    <h2>Recent Transactions</h2>
    <?php if (!empty($recent_transactions)) : ?>
        <?php foreach ($recent_transactions as $row) : ?>
            <p>Transaction ID: <?= $row['transaction_id'] ?></p>
            <p>Category: <?= $row['category_name'] ?></p>
            <p>Amount: <?= $row['amount'] ?></p>
            <p>Date: <?= $row['date'] ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No recent transactions available.</p>
    <?php endif; ?>

    <h2>Spending Notifications</h2>
    <?php if (!empty($spending_notifications)) : ?>
        <?php foreach ($spending_notifications as $row) : ?>
            <p>Notification: <?= $row['message'] ?></p>
            <p>Status: <?= $row['is_sent'] ? 'Sent' : 'Not Sent' ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No spending notifications available.</p>
    <?php endif; ?>

    <h2>Feedback and Ratings</h2>
    <?php if (!empty($feedbacks_and_ratings)) : ?>
        <p>Average Rating: <?= $feedbacks_and_ratings[0]['average_rating'] ?></p>   
        <?php foreach ($feedbacks_and_ratings as $row) : ?>
            <p>Feedback: <?= $row['feedback_text'] ?></p>
            <p>Rating: <?= $row['rating'] ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No feedback available.</p>
    <?php endif; ?>


    <h2>Login History</h2>
    <?php if (!empty($login_history)) : ?>
        <?php foreach ($login_history as $row) : ?>
            <p>Login Time: <?= $row['login_time'] ?></p>
            <p>Logout Time: <?= $row['logout_time'] ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No login history available.</p>
    <?php endif; ?>


    <h2>Profile Summary</h2>
    <?php if (!empty($profile_summary)) : ?>
        <?php foreach ($profile_summary as $row) : ?>
            <p>First Name: <?= $row['firstname'] ?></p>
            <p>Last Name: <?= $row['lastname'] ?></p>
            <p>Email: <?= $row['email'] ?></p>
            <p>Gender: <?= $row['gender'] ?></p>
            <hr>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No profile summary available.</p>
    <?php endif; ?>

</body>
</html>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>