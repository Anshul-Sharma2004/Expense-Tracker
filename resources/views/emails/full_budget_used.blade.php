<!DOCTYPE html>
<html>
<head>
    <title>Full Budget Used</title>
</head>
<body>
    <h1>Budget Alert</h1>
    <p>You have used 100% of your budget for {{ $month }}/{{ $year }}.</p>
    <p>Budget amount: ₹{{ number_format($budgetAmount, 2) }}</p>
    <p>Please stop adding new expenses or increase your budget.</p>
</body>
</html>
