<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Password Generator</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://t3.ftcdn.net/jpg/06/04/74/88/360_F_604748806_gQSyPrazhAocHefqrUtieGBKK22PS5QZ.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            min-height: 100vh;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 20px;
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
        }

        h1 {
            text-align: center;
            color: #ffc107;
        }

        .strength {
            font-weight: bold;
        }

        .weak {
            color: red;
        }

        .moderate {
            color: orange;
        }

        .strong {
            color: green;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>SecurePass</h1>
        <form id="passwordForm" method="POST" action="{{ route('generate') }}">
            @csrf
            <div class="mb-3">
                <label for="length" class="form-label">Password Length</label>
                <input type="number" id="length" name="length" class="form-control" min="6" max="64" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" id="include_uppercase" name="include_uppercase" class="form-check-input" value="1">
                <label for="include_uppercase" class="form-check-label">Include Uppercase Letters</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" id="include_numbers" name="include_numbers" class="form-check-input" value="1">
                <label for="include_numbers" class="form-check-label">Include Numbers</label>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" id="include_symbols" name="include_symbols" class="form-check-input" value="1">
                <label for="include_symbols" class="form-check-label">Include Symbols</label>
            </div>
            <button type="submit" class="btn btn-primary">Generate Password</button>
        </form>

        <div id="result" class="mt-4"></div>

        <div id="strength" class="mt-3"></div>

        <!-- Button to fetch and toggle passwords -->
        <button id="showPasswordsBtn" class="btn btn-info mt-4">Show All Saved Passwords</button>

        <!-- Hidden passwords section -->
        <div id="allPasswords" class="mt-4" style="display: none;">
            <!-- "Delete Selected" button -->
            <button id="deleteSelectedBtn" class="btn btn-danger mb-3" style="display: none;">Delete Selected Passwords</button>
            <ul id="passwordList"></ul>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Submit form to generate password
        $('#passwordForm').on('submit', function (e) {
            e.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: "{{ route('generate') }}",
                method: "POST",
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#result').html(
                        `<div class="alert alert-success">
                            <strong>Generated Password:</strong> ${data.password}
                        </div>`
                    );

                    let strengthClass = '';
                    if (data.strength === 'Weak') {
                        strengthClass = 'weak';
                    } else if (data.strength === 'Moderate') {
                        strengthClass = 'moderate';
                    } else if (data.strength === 'Strong') {
                        strengthClass = 'strong';
                    }

                    $('#strength').html(
                        `<div class="strength ${strengthClass}">
                            <strong>Password Strength: </strong> ${data.strength}
                        </div>`
                    );
                },
                error: function () {
                    alert('An error occurred. Please check your inputs and try again.');
                }
            });
        });

        // Fetch and toggle passwords
        $('#showPasswordsBtn').on('click', function () {
            const allPasswordsDiv = $('#allPasswords');

            if (allPasswordsDiv.is(':visible')) {
                allPasswordsDiv.hide();
                $(this).text('Show All Saved Passwords');
            } else {
                if ($('#passwordList').children().length === 0) {
                    $.ajax({
                        url: "{{ route('showPasswords') }}",
                        method: "GET",
                        success: function (data) {
                            let passwordsHTML = '';
                            data.passwords.forEach(function (password) {
                                passwordsHTML += `
                                    <li>
                                        <input type="checkbox" class="passwordCheckbox" value="${password.id}"> 
                                        ${password.generated_password}
                                    </li>`;
                            });
                            $('#passwordList').html(passwordsHTML);
                            $('#deleteSelectedBtn').show();
                        },
                        error: function () {
                            alert('Failed to fetch passwords.');
                        }
                    });
                }
                allPasswordsDiv.show();
                $(this).text('Hide Saved Passwords');
            }
        });

        // Delete selected passwords
        $('#deleteSelectedBtn').on('click', function () {
            const selectedPasswords = $('.passwordCheckbox:checked')
                .map(function () {
                    return $(this).val();
                })
                .get();

            if (selectedPasswords.length === 0) {
                alert('Please select at least one password to delete.');
                return;
            }

            $.ajax({
                url: "{{ route('deletePasswords') }}",
                method: "POST",
                data: { ids: selectedPasswords },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function () {
                    alert('Selected passwords will be deleted.');
                    $('.passwordCheckbox:checked').closest('li').remove(); 
                    alert('Deleted successfully.');
                },
                error: function () {
                    alert('Failed to delete selected passwords.');
                }
            });
        });
    </script>
</body>
</html>
