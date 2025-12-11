<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Negative Budget Alert</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
            padding: 30px;
        }
        h2 {
            color: #d9534f;
            font-size: 22px;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
        }
        .budget-amount {
            color: #d9534f;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>🚨 Budget Alert for {{ $user->name }} / {{ $budget->month }} / {{ $budget->year }}</h2>

        <p>Dear {{ $user->name }},</p>

        <p>Your expenses have <strong>exceeded</strong> your budget of 
            <span class="budget-amount">₹{{ number_format($budget->amount, 2) }}</span>.</p>

        <p>Please review your expenses and consider adjusting your budget or spending habits accordingly.</p>

        <p>Thank you,<br>
        <strong>Expense Tracker Team</strong></p>

        <div class="footer">
            This is an automated message. Please do not reply directly to this email.
        </div>
    </div>
</body>
</html>
