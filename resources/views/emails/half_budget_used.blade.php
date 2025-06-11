<!DOCTYPE html>
<html>
<head>
    <title>Half Budget Used</title>
</head>
<body>
    <h1>Budget Alert</h1>
    <p>You have used 50% of your budget for {{ $month }}/{{ $year }}.</p>
    <p>Budget amount: ₹{{ number_format($budgetAmount, 2) }}</p>
    <p>Please keep track of your expenses.</p>
</body>
</html>
