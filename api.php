<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Country and State Selection</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Country and State Selection</h1>
    <form>
        <label for="country">Country:</label>
        <select id="country" name="country" required>
            <option value="">Select a country</option>
        </select>

        <label for="state">State:</label>
        <select id="state" name="state" required>
            <option value="">Select a state</option>
        </select>

        <button type="submit">Submit</button>
    </form>

    <script>
        // Load country data on page load
        $(document).ready(function() {
            $.ajax({
                url: 'https://restcountries.com/v3.1/all',
                dataType: 'json',
                success: function(data) {
                    var countries = data;
                    var countrySelect = $('#country');

                    // Populate country dropdown
                    $.each(countries, function(index, country) {
                        countrySelect.append('<option value="' + country.cca2 + '">' + country.name.common + '</option>');
                    });
                }
            });
        });

        // Handle country selection change
        $('#country').change(function() {
            var countryCode = $(this).val();
            var stateSelect = $('#state');

            // Clear previous state options
            stateSelect.empty();

            // Fetch states based on selected country
            if (countryCode) {
                $.ajax({
                    url: 'https://restcountries.com/v3.1/alpha/' + countryCode,
                    dataType: 'json',
                    success: function(data) {
                        var states = data[0].regions;

                        // Populate state dropdown
                        $.each(states, function(code, name) {
                            stateSelect.append('<option value="' + code + '">' + name + '</option>');
                            console.log(name);
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>
