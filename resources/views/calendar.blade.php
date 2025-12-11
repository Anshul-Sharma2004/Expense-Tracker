<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Calendar | Financial Tracker</title>
    <style>
     /* Base Styles */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    color: #333;
}

/* Header Navigation */
.header-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
    color: #cbd5e0
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    color: #ffff;
    margin: 0;
}

.button-group {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Card Styles */
.card {
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin-bottom: 2rem;
}

.card-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    color: #2d3748;
}

.month-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
    gap: 1rem;
}

/* Form Styles */
.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: #4a5568;
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    font-size: 1rem;
    transition: border-color 0.2s;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Button Styles */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
    font-size: 1rem;
    line-height: 1.5;
    cursor: pointer;
    transition: all 0.2s;
    gap: 0.5rem;
}

.btn-primary {
    background-color: #667eea;
    color: white;
    border: 1px solid transparent;
}

.btn-primary:hover {
    background-color: #5a67d8;
}

.btn-outline {
    background-color: transparent;
    color: #667eea;
    border: 1px solid #667eea;
}

.btn-outline:hover {
    background-color: rgba(102, 126, 234, 0.1);
}

.btn-danger {
    background-color: #e53e3e;
    color: white;
    border: 1px solid transparent;
}

.btn-danger:hover {
    background-color: #c53030;
}

/* Alert Styles */
.alert {
    padding: 1rem;
    border-radius: 0.375rem;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.alert-danger {
    background-color: #fff5f5;
    color: #e53e3e;
    border-left: 4px solid #e53e3e;
}

.alert-success {
    background-color: #f0fff4;
    color: #38a169;
    border-left: 4px solid #38a169;
}

.alert svg {
    width: 1.5rem;
    height: 1.5rem;
}

/* Table Styles */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

th, td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

th {
    background-color: #f7fafc;
    color: #4a5568;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.05em;
}

tr:hover {
    background-color: #f8fafc;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 2rem;
    color: #718096;
}

.empty-state-icon {
    margin-bottom: 1rem;
}

.empty-state-icon svg {
    width: 3rem;
    height: 3rem;
    color: #cbd5e0;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 0.5rem;
}

/* Modal Styles */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s;
}

.modal.active {
    opacity: 1;
    pointer-events: all;
}

.modal-content {
    background: rgb(202, 171, 171);
    border-radius: 0.5rem;
    width: 100%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 10px 15px -3px rgba(197, 43, 43, 0.1), 0 4px 6px -2px rgba(242, 6, 6, 0.05);
    transform: translateY(20px);
    transition: transform 0.3s;
}

.modal.active .modal-content {
    transform: translateY(0);
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    color: #2d3748;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: #718096;
    padding: 0.25rem;
    line-height: 1;
}

.modal-close:hover {
    color: #4a5568;
}

.modal-body {
    padding: 1.5rem;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .header-nav {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .card {
        padding: 1.5rem;
    }
    
    .btn {
        padding: 0.625rem 1.25rem;
        font-size: 0.875rem;
    }
}

@media (max-width: 480px) {
    .modal-content {
        margin: 0 1rem;
    }
}
    </style>
</head>
<body>
    <x-app-layout>
        <div class="container">
            <!-- Header Navigation -->
            <nav class="header-nav">
                <h1 class="page-title">Expense Calendar</h1>
                <div class="button-group">
                    <button 
                        onclick="openSearchModal()"
                        class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                        Search Expenses
                    </button>
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                        </svg>
                        Go To Dashboard
                    </a>
                </div>
            </nav>

            <!-- Flash Messages -->
            @if(session('alert'))
                <div class="alert alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('alert') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Expense Form -->
            <div class="card">
                <h2 class="card-title">Add New Expense</h2>
                <form method="POST" action="{{ route('expenses.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="calendar">Date</label>
                        <input 
                            type="date" 
                            id="calendar" 
                            name="calendar" 
                            class="form-control" 
                            required 
                            value="{{ old('calendar') }}" 
                            max="{{ date('Y-m-d') }}"
                        />
                        <input type="hidden" name="date" id="expense_date" />
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <input 
                            type="text" 
                            id="category" 
                            name="category" 
                            class="form-control" 
                            required 
                            placeholder="e.g. Groceries, Transport" 
                            value="{{ old('category') }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="amount">Amount (₹)</label>
                        <input 
                            type="number" 
                            id="amount" 
                            name="amount" 
                            class="form-control" 
                            required 
                            placeholder="0.00" 
                            step="0.01" 
                            min="0" 
                            value="{{ old('amount') }}"
                        />
                    </div>

                    <div class="form-group">
                        <label for="description">Description (Optional)</label>
                        <input 
                            type="text" 
                            id="description" 
                            name="description" 
                            class="form-control" 
                            placeholder="Additional details"
                            value="{{ old('description') }}"
                        />
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Add Expense
                    </button>
                </form>
            </div>



            <!-- Search Result View -->
            @if(request('month') && request('year') && isset($expensesFlat))
                <div class="card">
                    <div class="month-header">
                        <h2 class="card-title">
                            Search Results: {{ \Carbon\Carbon::createFromDate(request('year'), request('month'), 1)->format('F Y') }}
                        </h2>
                        
                        @if(count($expensesFlat))
                            <form method="GET" action="{{ route('expenses.download') }}" target="_blank">
                                <input type="hidden" name="month" value="{{ request('month') }}">
                                <input type="hidden" name="year" value="{{ request('year') }}">
                                <button type="submit" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Download PDF
                                </button>
                            </form>
                        @endif
                    </div>

                    @if(count($expensesFlat))
                        @php
                            $sortedExpenses = $expensesFlat->sortBy('date');
                            $remaining = $totalBudget ?? 0;
                            $first = true;
                        @endphp

                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Amount (₹)</th>
                                        <th>Remaining (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sortedExpenses as $expense)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M Y') }}</td>
                                            <td>{{ $expense->category }}</td>
                                            <td>{{ $expense->description ?? '-' }}</td>
                                            <td>₹{{ number_format($expense->amount, 2) }}</td>
                                            <td>
                                                @php
                                                    if ($first) {
                                                        echo '<strong>₹'.number_format($totalBudget, 2).'</strong>';
                                                        $first = false;
                                                    } else {
                                                        $remaining -= $expense->amount;
                                                        echo '<strong>₹'.number_format($remaining, 2).'</strong>';
                                                    }
                                                @endphp
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="section-title">No Expenses Found</h3>
                            <p>No expenses recorded for the selected month and year.</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Search Modal -->
        <div id="searchModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Search Expenses</h3>
                    <button onclick="closeSearchModal()" class="modal-close">
                        &times;
                    </button>
                </div>
                <form method="GET" action="{{ route('expenses.search') }}">
                    <div class="form-group">
                        <label for="month">Month</label>
                        <select name="month" id="month" class="form-control" required>
                            <option value="">Select Month</option>
                            @foreach ([
                                '01' => 'January', '02' => 'February', '03' => 'March', 
                                '04' => 'April', '05' => 'May', '06' => 'June', 
                                '07' => 'July', '08' => 'August', '09' => 'September', 
                                '10' => 'October', '11' => 'November', '12' => 'December'
                            ] as $key => $value)
                                <option 
                                    value="{{ $key }}" 
                                    {{ request('month') == $key ? 'selected' : '' }}
                                >
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select name="year" id="year" class="form-control" required>
                            <option value="">Select Year</option>
                            @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                                <option 
                                    value="{{ $y }}" 
                                    {{ request('year') == $y ? 'selected' : '' }}
                                >
                                    {{ $y }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="button-group" style="margin-top: 2rem;">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                            Search
                        </button>
                        <button 
                            type="button" 
                            onclick="closeSearchModal()" 
                            class="btn btn-danger"
                        >
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            // Date handling
            document.getElementById('calendar').addEventListener('change', function() {
                document.getElementById('expense_date').value = this.value;
            });

            // Set initial date if exists
            window.addEventListener('DOMContentLoaded', function() {
                const calendar = document.getElementById('calendar');
                if (calendar.value) {
                    document.getElementById('expense_date').value = calendar.value;
                }
            });

            // Modal control functions
            function openSearchModal() {
                document.getElementById('searchModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeSearchModal() {
                document.getElementById('searchModal').classList.remove('active');
                document.body.style.overflow = '';
            }

            // Close modal when clicking outside
            document.getElementById('searchModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeSearchModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSearchModal();
                }
            });
        </script>
    </x-app-layout>
</body>
</html>