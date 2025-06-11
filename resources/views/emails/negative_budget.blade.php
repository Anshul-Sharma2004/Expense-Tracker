<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Negative Budget Alert</title>
</head>
<body>
    <h2>Budget Alert for {{ $budget->month }}/{{ $budget->year }}</h2>
    <p>Dear User,</p>
    <p>Your expenses have exceeded your budget of ₹{{ number_format($budget->amount, 2) }}.</p>
    <p>Please review your expenses and consider adjusting your budget.</p>
    <p>Thank you,</p>
    <p><strong>Expense Tracker Team</strong></p>
</body>
</html>
