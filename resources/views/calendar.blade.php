
    <style>
        /* Reset and base */
        * {
          box-sizing: border-box;
          margin: 0;
          padding: 0;
        }

        body {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          background-color: #f9fafb;
          color: #1f2937;
          line-height: 1.5;
          min-height: 100vh;
          padding: 2.5rem 1rem;
        }

        .dark {
          background-color: #111827;
          color: #d1d5db;
        }

        /* Container */
        .container {
          max-width: 80rem;
          margin-left: auto;
          margin-right: auto;
          padding-left: 1rem;
          padding-right: 1rem;
          display: flex;
          flex-direction: column;
          gap: 2.5rem;
        }

        /* Header */
        .page-header {
          font-weight: 700;
          font-size: 2rem;
          margin-bottom: 1rem;
          color: inherit;
        }

        /* Card */
        .card {
          background-color: #fff;
          border: 1px solid #d1d5db;
          border-radius: 1rem;
          padding: 2rem;
          box-shadow: 0 1px 3px rgba(0,0,0,0.1);
          transition: background-color 0.3s ease;
        }

        .dark .card {
          background-color: #1f2937;
          border-color: #374151;
          box-shadow: 0 1px 5px rgba(0,0,0,0.5);
        }

        /* Headings inside card */
        .card h3 {
          font-size: 1.25rem;
          margin-bottom: 1.5rem;
          font-weight: 700;
          color: #1e40af;
        }

        .dark .card h3 {
          color: #60a5fa;
        }

        /* Form */
        form {
          display: flex;
          flex-direction: column;
          gap: 1.5rem;
        }

        label {
          display: block;
          font-weight: 600;
          font-size: 0.875rem;
          margin-bottom: 0.25rem;
          color: #374151;
        }

        .dark label {
          color: #d1d5db;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
          width: 100%;
          padding: 0.5rem 0.75rem;
          font-size: 1rem;
          border-radius: 0.5rem;
          border: 1px solid #d1d5db;
          background-color: #fff;
          color: #111827;
          transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .dark input[type="text"],
        .dark input[type="number"],
        .dark input[type="date"],
        .dark select {
          background-color: #374151;
          border-color: #4b5563;
          color: #f9fafb;
        }

        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus {
          outline: none;
          border-color: #2563eb;
          box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.3);
        }

        .dark input[type="text"]:focus,
        .dark input[type="number"]:focus,
        .dark input[type="date"]:focus,
        .dark select:focus {
          border-color: #60a5fa;
          box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.5);
        }

        /* Button */
        button {
          background-color: #2563eb;
          color: white;
          font-weight: 600;
          padding: 0.5rem 1.25rem;
          border: none;
          border-radius: 0.75rem;
          cursor: pointer;
          box-shadow: 0 4px 6px rgba(37, 99, 235, 0.4);
          transition: background-color 0.2s ease, box-shadow 0.2s ease;
          font-size: 1rem;
          align-self: flex-start;
        }

        button:hover,
        button:focus {
          background-color: #1e40af;
          box-shadow: 0 6px 8px rgba(30, 64, 175, 0.6);
        }

        .dark button {
          background-color: #3b82f6;
          box-shadow: 0 4px 6px rgba(59, 130, 246, 0.6);
        }

        .dark button:hover,
        .dark button:focus {
          background-color: #2563eb;
          box-shadow: 0 6px 8px rgba(37, 99, 235, 0.8);
        }

        /* Table */
        table {
          width: 100%;
          border-collapse: collapse;
          font-size: 0.875rem;
          color: #374151;
        }

        .dark table {
          color: #d1d5db;
        }

        thead {
          background-color: #e5e7eb;
          text-transform: uppercase;
        }

        .dark thead {
          background-color: #374151;
        }

        th,
        td {
          border: 1px solid #d1d5db;
          padding: 0.75rem 1rem;
          text-align: left;
        }

        .dark th,
        .dark td {
          border-color: #4b5563;
        }

        tbody tr:hover {
          background-color: #f3f4f6;
          transition: background-color 0.3s ease;
        }

        .dark tbody tr:hover {
          background-color: #4b5563;
        }

        /* Scroll for tables */
        .overflow-x-auto {
          overflow-x: auto;
        }

        /* Spacing helpers */
        .mb-4 {
          margin-bottom: 1rem;
        }

        .mb-6 {
          margin-bottom: 1.5rem;
        }

        .mb-10 {
          margin-bottom: 2.5rem;
        }

        .space-y-6 > * + * {
          margin-top: 1.5rem;
        }

        /* Alert and Success Message Styling */
.alert-box {
    padding: 1rem 1.5rem;
    border-radius: 0.75rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
    border: 1px solid transparent;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    transition: background-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease;
}

.alert-danger {
    background-color: #fee2e2;
    color: #b91c1c;
    border-color: #fca5a5;
}

.alert-danger:hover {
    background-color: #fecaca;
    box-shadow: 0 6px 10px rgba(185, 28, 28, 0.15);
}

.alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border-color: #6ee7b7;
}

.alert-success:hover {
    background-color: #a7f3d0;
    box-shadow: 0 6px 10px rgba(6, 95, 70, 0.15);
}

/* Dark Mode Support */
.dark .alert-danger {
    background-color: #7f1d1d;
    color: #fee2e2;
    border-color: #ef4444;
}

.dark .alert-success {
    background-color: #064e3b;
    color: #d1fae5;
    border-color: #10b981;
}

    </style> 
   <x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">Expense Calendar & Search</h2>
        <button onclick="document.getElementById('searchModal').classList.remove('hidden')"
                class="ml-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
            Search Expenses
        </button>

  

    </x-slot>

    <!-- Flash Messages -->
          <div style="margin-bottom: 1rem;">
    <a href="{{ url('/dashboard') }}" class="btn-primary" style="display: inline-block; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none; color:#2563eb;">
        Go to Dashboard
    </a>
</div>
   @if(session('alert'))
    <div class="container">
        <div class="alert-box alert-danger">
            {{ session('alert') }}
        </div>
    </div>
@endif

@if(session('success'))
    <div class="container">
        <div class="alert-box alert-success">
            {{ session('success') }}
        </div>
    </div>
@endif


    <!-- Search Modal -->
    <div id="searchModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Search by Month & Year</h3>
            <form method="GET" action="{{ route('expenses.search') }}" class="space-y-4">
                <div>
                    <label for="month" class="block mb-1 text-sm font-medium">Month</label>
                    <select name="month" id="month" required class="w-full p-2 border rounded">
                        <option value="">-- Select Month --</option>
                        @foreach ([
                            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                        ] as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="year" class="block mb-1 text-sm font-medium">Year</label>
                    <select name="year" id="year" required class="w-full p-2 border rounded">
                        <option value="">-- Select Year --</option>
                        @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                            <option value="{{ $y }}">{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Search</button>
                    <button type="button" onclick="document.getElementById('searchModal').classList.add('hidden')"
                            class="text-red-600 font-semibold">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">

        <!-- Add Expense Form -->
        <div class="card">
            <h3>Add New Expense</h3>
            <form method="POST" action="{{ route('expenses.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="calendar">Select Date</label>
                    <input type="date" id="calendar" name="calendar" required value="{{ old('calendar') }}" />
                    <input type="hidden" name="date" id="expense_date" />
                </div>

                <div>
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" required placeholder="Groceries, Transport, etc." value="{{ old('category') }}" />
                </div>

                <div>
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount" required placeholder="Enter amount (₹)" step="0.01" min="0" value="{{ old('amount') }}" />
                </div>

                <div>
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" placeholder="Optional details" value="{{ old('description') }}" />
                </div>

                <div>
                    <button type="submit">Add Expense</button>
                </div>
            </form>
        </div>

        <!-- Monthly Grouped Expenses -->
        <div class="card">
            <h3>Your Expenses</h3>
            @if(count($expenses))
                @foreach ($expenses as $month => $monthlyExpenses)
                    <div class="mb-10">
                        <h4 class="mb-4">{{ $month }}</h4>
                        <div class="overflow-x-auto">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Amount (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($monthlyExpenses as $expense)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                                            <td>{{ $expense->category }}</td>
                                            <td>₹{{ number_format($expense->amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No expenses recorded yet.</p>
            @endif
        </div>

        <!-- Search Result View -->
  @if(request('month') && request('year') && isset($expensesFlat))
<div class="card">
    <h3>Search Results</h3>

    @if(count($expensesFlat))
        <!-- Download PDF Button -->
        <form method="GET" action="{{ route('expenses.download') }}" target="_blank" style="margin-bottom: 15px;">
            <input type="hidden" name="month" value="{{ request('month') }}">
            <input type="hidden" name="year" value="{{ request('year') }}">
            <button type="submit" class="btn btn-primary">Download PDF</button>
        </form>

        @php
            // Sort by date ascending (oldest first)
            $sortedExpenses = $expensesFlat->sortBy('date');
            $remaining = $totalBudget ?? 0;
            $first = true;
        @endphp

        <div class="overflow-x-auto">
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
                    @foreach ($sortedExpenses as $expense)
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

                            @php
                                $remaining -= $expense->amount;
                            @endphp
                            <td><strong>₹{{ number_format($remaining, 2) }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No results found for selected month and year.</p>
    @endif
</div>
@endif

</div>

<script>
    document.getElementById('calendar').addEventListener('change', function () {
        document.getElementById('expense_date').value = this.value;
    });
    window.addEventListener('DOMContentLoaded', function () {
        const calendar = document.getElementById('calendar');
        if (calendar.value) {
            document.getElementById('expense_date').value = calendar.value;
        }
    });
</script>

</x-app-layout>
