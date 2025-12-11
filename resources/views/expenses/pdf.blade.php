<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Expenses PDF</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #111827;
            margin: 40px;
        }

        h2, h4 {
            margin: 0;
            padding: 0;
        }

        .header-container {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #4b5563;
        }

        .header-container h2 {
            font-size: 24px;
            color: #1e3a8a;
            margin-bottom: 8px;
        }

        .header-container h4 {
            font-size: 16px;
            font-weight: normal;
            color: #374151;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        thead {
            background-color: #f3f4f6;
        }

        th {
            padding: 10px;
            border: 1px solid #9ca3af;
            text-align: left;
            background-color: #e5e7eb;
            color: #111827;
        }

        td {
            padding: 9px 10px;
            border: 1px solid #d1d5db;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #f1f5f9;
        }

        strong {
            color: #1f2937;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            border-top: 1px solid #d1d5db;
            padding-top: 10px;
        }
    </style>
</head>
<body>

    <div class="header-container">
        {{-- <img src="{{ public_path('storage/images/expenseLogo.png') }}" alt="Logo" style="height: 50px;"> --}}
        <h2>
            Hey, {{ Auth::user()->name }}
        </h2>
        <h4>
            Your Monthly Budget of -- <b>{{ \Carbon\Carbon::createFromDate(null, $month)->format('F') }} {{ $year }}</b> is: <b>₹{{ number_format($totalBudget, 2) }}</b>
        </h4>
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

    <div class="footer">
        This PDF is generated from <strong>Expense Tracker</strong>.
    </div>

</body>
</html>
