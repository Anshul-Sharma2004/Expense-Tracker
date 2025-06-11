<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <style>
        /* Reset some basics */
        * {
            box-sizing: border-box;
            
        }
        body, input, select, button {
            font-family: Arial, sans-serif;
            /* background-color: #d1d5db; */
        }

        /* Header title */
        .header-title {
            font-weight: 600;
            font-size: 1.5rem; /* 24px */
            color: #1f2937; /* dark gray */
            line-height: 1.25;
            margin-bottom: 1rem;
            background-color: #d1d5db;
            
        }
        /* Dark mode support - you can toggle dark mode class on body */
        body.dark .header-title {
            color: #f9fafb; /* almost white */
            
        }

        /* Container and layout */
        .container {
            max-width: 960px;
            margin: 3rem auto;
            padding: 0 1rem;
            background-color: #d1d5db;
        }

        /* Card style */
        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 10px rgb(0 0 0 / 0.1);
            border: 1px solid #d1d5db; /* gray-300 */
        }
        body.dark .card {
            background-color: #1f2937; /* gray-900 */
            border-color: #374151; /* gray-700 */
            color: #e5e7eb; /* gray-200 */
        }

        /* Form styles */
        form {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        @media (min-width: 768px) {
            form {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        select, input[type="number"], input[type="text"] {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db; /* gray-300 */
            border-radius: 8px;
            background-color: #fff;
            color: #111827; /* gray-900 */
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        select:focus, input[type="number"]:focus, input[type="text"]:focus {
            border-color: #3b82f6; /* blue-500 */
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4);
        }
        body.dark select, 
        body.dark input[type="number"], 
        body.dark input[type="text"] {
            background-color: #374151; /* gray-700 */
            border-color: #4b5563; /* gray-600 */
            color: #f9fafb;
        }

        /* Submit button */
        .btn-primary {
            grid-column: 1 / -1; /* full width on small screens */
            justify-self: end;
            background-color: #2563eb; /* blue-600 */
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #1d4ed8; /* blue-700 */
        }

        /* Table styles */
        .table-container {
            overflow-x: auto;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            min-width: 600px;
            font-size: 0.9rem;
            color: #374151; /* gray-700 */
        }
        body.dark table {
            color: #d1d5db; /* gray-300 */
        }
        thead {
            background-color: #e5e7eb; /* gray-200 */
        }
        body.dark thead {
            background-color: #374151; /* gray-700 */
        }
        th, td {
            border: 1px solid #d1d5db; /* gray-300 */
            padding: 0.75rem 1rem;
            text-align: left;
        }
        body.dark th, body.dark td {
            border-color: #4b5563; /* gray-600 */
        }
        tbody tr:hover {
            background-color: #f3f4f6; /* gray-100 */
        }
        body.dark tbody tr:hover {
            background-color: #4b5563; /* gray-600 */
        }

        /* Headings */
        h3 {
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            color: #111827; /* gray-900 */
        }
        body.dark h3 {
            color: #f9fafb;
        }
        h4 {
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1rem;
            color: #111827;
        }
        body.dark h4 {
            color: #f9fafb;
        }

        /* Horizontal rule */
        hr {
            border: none;
            border-top: 1px solid #9ca3af; /* gray-400 */
            margin: 2rem 0;
        }
        body.dark hr {
            border-top-color: #374151;
        }

        /* Link style */
        .link {
            color: #2563eb; /* blue-600 */
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        .link:hover {
            color: #1d4ed8; /* blue-700 */
            text-decoration: underline;
        }
        body.dark .link {
            color: #3b82f6; /* lighter blue */
        }

        /* Error message */
        .error-message {
            color: #dc2626; /* red-600 */
            margin-bottom: 1rem;
        }
    </style>

    @if($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="container">

        <div style="margin-bottom: 1rem;">
    <a href="{{ url('/calendar') }}" class="btn-primary" style="display: inline-block; padding: 0.5rem 1rem; border-radius: 8px; text-decoration: none;">
        Go to Calendar
    </a>
</div>

        <div class="card">
            <h3>Set Monthly Budget</h3>

            <form method="POST" action="/budget">
                @csrf
                <select name="month" required>
                    <option value="">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <input type="number" name="year" placeholder="Year (e.g. 2025)" required>
                <input type="number" name="amount" placeholder="Monthly Budget (₹)" required>

                <button type="submit" class="btn-primary">Save Budget</button>
            </form>

            <hr>

            <h4>Saved Budgets</h4>

            @if(count($budgets))
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Year</th>
                                <th>Amount (₹)</th>
                                <th>Remaining Budget (₹)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($budgets->groupBy(function($b) { return $b->month . '/' . $b->year; }) as $key => $groupedBudgets)
                                @foreach($groupedBudgets as $budget)
                                    <tr>
                                        <td>{{ DateTime::createFromFormat('!m', $budget->month)->format('F') }}</td>
                                        <td>{{ $budget->year }}</td>
                                        <td>₹{{ number_format($budget->amount, 2) }}</td>
                                         <td>₹{{ number_format($budget->remaining, 2) }}</td> 
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>No budgets saved yet.</p>
            @endif

            <div style="margin-top: 1.5rem;">
                {{-- <a href="/tasks" class="link">View Tasks</a> --}}
            </div>
        </div>
    </div>
</x-app-layout>
