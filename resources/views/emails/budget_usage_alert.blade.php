<!DOCTYPE html>
<html>
<head>
    <title>Budget Usage Alert</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>

    @if ($percentage >= 100)
        <p><strong>Alert:</strong> Your budget has been fully used ({{ number_format($percentage, 2) }}%). Please review your expenses immediately.</p>
    @elseif ($percentage >= 50)
        <p>Notice: Your budget is {{ number_format($percentage, 2) }}% used. Consider reviewing your spending.</p>
    @endif

    <p>Thanks,<br>Your Expense Tracker App</p>
</body>
</html>
