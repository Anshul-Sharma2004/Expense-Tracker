<!DOCTYPE html>
<html>
<head>
    <title>Budget Reminder</title>
</head>
<body>
    <p>Dear {{ $user->name }},</p>
    <p>It's the beginning of a new month ({{ $month }}/{{ $year }}). Please fill in your budget for this month to start tracking your expenses.</p>
    <p>Thank you!</p>
</body>
</html>
