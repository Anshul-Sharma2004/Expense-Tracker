  <div class="card">
            <h3>Search Expenses by Month and Year</h3>
            <form method="GET" action="{{ route('expenses.calendar') }}" class="space-y-6" style="max-width: 400px;">
                <div>
                    <label for="month">Month</label>
                    <select id="month" name="month" required>
                        <option value="">-- Select Month --</option>
                        @foreach ([
                            '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                            '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                            '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December',
                        ] as $num => $name)
                            <option value="{{ $num }}" {{ request('month') == $num ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="year">Year</label>
                    <select id="year" name="year" required>
                        <option value="">-- Select Year --</option>
                        @for ($y = date('Y'); $y >= date('Y') - 10; $y--)
                            <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <button type="submit">Search</button>
                </div>
            </form>
        </div>