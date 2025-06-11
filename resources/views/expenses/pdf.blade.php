<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expenses PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-container img {
            height: 50px;
            margin-right: 15px;
        }
        .header-container h2 {
            margin: 0;
        }
    </style>
</head>
<body>

    <div class="header-container">
       {{-- <img src="{{ public_path('storage/images/expenseLogo.png') }}" alt="Logo" style="height: 50px;"> --}}
        <h2>
            Expense Report for {{ Auth::user()->name }} - {{ \Carbon\Carbon::createFromDate(null, $month)->format('F') }} {{ $year }}
        </h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Category</th>
                <th>Amount (₹)</th>
                <th>Total Budget (₹)</th>
                <th>Remaining Budget (₹)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $remaining = $totalBudget ?? 0;
                $first = true;
            @endphp

            @foreach ($expensesFlat as $expense)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                    <td>{{ $expense->category }}</td>
                    <td>₹{{ number_format($expense->amount, 2) }}</td>

                    @if($first)
                        <td><strong>₹{{ number_format($totalBudget, 2) }}</strong></td>
                        @php $first = false; @endphp
                    @else
                        <td></td>
                    @endif

                    @php $remaining -= $expense->amount; @endphp
                    <td><strong>₹{{ number_format($remaining, 2) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
