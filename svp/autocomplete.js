let selectedIndex = -1; // Menyimpan indeks opsi yang dipilih
let suggestions = document.querySelectorAll('.list-group-item');

// Keyboard navigation
document.addEventListener('keydown', function(event) {
    if (event.key === 'ArrowUp') {
        event.preventDefault(); // Prevent scrolling
        selectedIndex = selectedIndex > 0 ? selectedIndex - 1 : suggestions.length - 1;
        highlightOption(suggestions);
    } else if (event.key === 'ArrowDown') {
        event.preventDefault(); // Prevent scrolling
        selectedIndex = selectedIndex < suggestions.length - 1 ? selectedIndex + 1 : 0;
        highlightOption(suggestions);
    } else if (event.key === 'Enter') {
        if (selectedIndex > -1) {
            selectSuggestion(selectedIndex);
            event.preventDefault(); // Prevent form submission if in a form
        }
    }
});

document.getElementById("search_term").addEventListener("input", function(event) {
    let term = this.value;
    if (term.length >= 2) {
        fetch("autocomplete.php?term=" + term)
            .then(response => response.text())
            .then(data => {
                // Replace the options with the newly fetched options
                document.getElementById("autocomplete-options").innerHTML = data;

                // Show the autocomplete options
                document.getElementById("autocomplete-options").style.display = '';
                
                // Update suggestions with new elements
                suggestions = document.querySelectorAll('.list-group-item');
            })
            .catch(error => {
                console.error('Error fetching autocomplete options:', error);
            });
    } else {
        // Hide autocomplete options if the input length is less than 2 characters
        document.getElementById("autocomplete-options").style.display = 'none';
    }
});

// Fungsi untuk menyoroti opsi yang dipilih
function highlightOption(suggestions) {
    suggestions.forEach((suggestion, index) => {
        if (index === selectedIndex) {
            suggestion.classList.add('active'); // Menyoroti opsi yang dipilih
        } else {
            suggestion.classList.remove('active'); // Menghapus penyorotan dari opsi lain
        }
    });
}

// Fungsi untuk memilih opsi yang dipilih
function selectSuggestion(index) {
    if (index > -1 && index < suggestions.length) {
        document.getElementById("search_term").value = suggestions[index].getAttribute('data-value');
        document.getElementById("autocomplete-options").style.display = 'none';
        selectedIndex = -1; // Reset indeks opsi yang dipilih
    }
}
