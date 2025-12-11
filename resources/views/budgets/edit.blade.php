<button onclick="openBudgetModal()" class="trigger-btn">Edit Budget</button>

<div id="budgetModal" class="modal-overlay">
  <div class="modal-container">
    <div class="modal-header">
      <h3>Update Budget</h3>
    </div>
    
    <form action="{{ route('budgets.update', $budget->id) }}" method="POST" class="modal-form">
      @csrf
      @method('PUT')
      
      <div class="form-group">
        <label for="amount">Budget Amount (₹)</label>
        <input type="number" step="0.01" class="form-input" 
               id="amount" name="amount" 
               value="{{ old('amount', $budget->amount) }}" 
               placeholder="Enter budget amount" required>
      </div>
      
      <div class="form-actions">
        <button type="submit" class="submit-btn">Update Budget</button>
      </div>
    </form>
  </div>
</div>

<style>
/* Modal Overlay - Background Dimmer */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  opacity: 0;
  visibility: hidden;
  transition: all 0.3s ease;
}

/* Active Modal State */
.modal-overlay.active {
  opacity: 1;
  visibility: visible;
}

/* Modal Container */
.modal-container {
  background: white;
  border-radius: 8px;
  width: 90%;
  max-width: 400px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  transform: translateY(-20px);
  transition: transform 0.3s ease;
  overflow: hidden;
}

.modal-overlay.active .modal-container {
  transform: translateY(0);
}

/* Modal Header */
.modal-header {
  padding: 1.25rem;
  background: #f8fafc;
  border-bottom: 1px solid #e2e8f0;
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.modal-header h3 {
  margin: 0;
  font-size: 1.25rem;
  color: #1e293b;
  font-weight: 600;
}

/* Form Styles */
.modal-form {
  padding: 1.5rem;
}

.form-group {
  margin-bottom: 1.25rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-size: 0.875rem;
  color: #334155;
  font-weight: 500;
}

.form-input {
  width: 100%;
  padding: 0.625rem 0.75rem;
  border: 1px solid #cbd5e1;
  border-radius: 6px;
  font-size: 1rem;
  transition: all 0.2s;
}

.form-input:focus {
  outline: none;
  border-color: #6366f1;
  box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Form Actions */
.form-actions {
  display: flex;
  justify-content: flex-end;
  margin-top: 1.5rem;
}

.submit-btn {
  padding: 0.625rem 1.25rem;
  background-color: #6366f1;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 0.9375rem;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s;
}

.submit-btn:hover {
  background-color: #4f46e5;
}

/* Responsive Adjustments */
@media (max-width: 480px) {
  .modal-container {
    width: 95%;
  }
  
  .modal-form {
    padding: 1.25rem;
  }
}

/* Trigger button style */
.trigger-btn {
  padding: 0.625rem 1.25rem;
  background-color: #6366f1;
  color: white;
  border: none;
  border-radius: 6px;
  font-size: 0.9375rem;
  font-weight: 500;
  cursor: pointer;
  transition: background-color 0.2s;
}

.trigger-btn:hover {
  background-color: #4f46e5;
}
</style>

<script>
// Open modal function
function openBudgetModal() {
  document.getElementById('budgetModal').classList.add('active');
}

// Close modal function
function closeBudgetModal() {
  document.getElementById('budgetModal').classList.remove('active');
}

// Close when clicking outside modal
document.getElementById('budgetModal').addEventListener('click', function(e) {
  if (e.target === this) {
    closeBudgetModal();
  }
});

// Close with Escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeBudgetModal();
  }
});
</script>