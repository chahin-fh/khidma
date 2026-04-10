document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('date');
    const tdjInput = document.getElementById('TDJ');
    const sltSelect = document.getElementById('SLT');

    // Set min date to today
    if (dateInput) {
        const today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);

        // Prevent past dates
        dateInput.addEventListener('input', function() {
            const selected = new Date(this.value);
            const todayDate = new Date(today);
            if (selected < todayDate) {
                this.value = today; // Reset to today if past date selected
                alert('Date cannot be in the past. Set to today.');
            }
        });
    }

    // Only positive numbers for travail du jour
    if (tdjInput) {
        tdjInput.addEventListener('input', function() {
            const value = parseFloat(this.value);
            if (isNaN(value) || value < 0) {
                this.value = '';
                document.getElementById('er1').textContent = 'Must be a positive number';
            } else {
                document.getElementById('er1').textContent = '';
            }
        });
    }

    // Require vehicle selection
    if (sltSelect) {
        sltSelect.addEventListener('change', function() {
            if (this.value === '') {
                document.getElementById('er7').textContent = 'Please select a vehicle';
            } else {
                document.getElementById('er7').textContent = '';
            }
        });
    }

    // Enhanced form validation on submit
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const errors = {};

            // Date validation
            if (dateInput && (!dateInput.value || new Date(dateInput.value) < new Date().setHours(0,0,0,0))) {
                errors.date = 'Date must be today or in the future';
                isValid = false;
            }

            // Travail du jour validation
            if (tdjInput && (!tdjInput.value || parseFloat(tdjInput.value) < 0)) {
                errors.tdj = 'Travail du jour must be a positive number';
                isValid = false;
            }

            // Vehicle validation
            if (sltSelect && sltSelect.value === '') {
                errors.slt = 'Please select a vehicle';
                isValid = false;
            }

            // Show errors
            document.getElementById('er6').textContent = errors.date || '';
            document.getElementById('er1').textContent = errors.tdj || '';
            document.getElementById('er7').textContent = errors.slt || '';

            if (!isValid) {
                e.preventDefault();
            }
        });
    }
});
