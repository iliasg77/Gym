<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Gym Application</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        // Όταν ολοκληρωθεί η φόρτωση της σελίδας
        $(document).ready(function() {
            // Φορτώστε τις χώρες από το REST API και προσθέστε τις στο drop-down
            $.ajax({
                url: 'https://restcountries.com/v3.1/all?fields=name,flags', 
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Προσθήκη των επιλογών στο drop-down της χώρας
                    var countryDropdown = $('#country');
                    $.each(data, function(index, country) {
                        countryDropdown.append('<option value="' + country.name.common + '">' + country.name.common + '</option>');
                    });
                }
            });

    
            
        });
    </script>
</head>
<body>


<form method="post" action="Register1.php">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name"><br>
  <label for="lname">Last Name:</label><br>
  <input type="text" id="lname" name="lname"><br>
  <label for="country">Country:</label><br>
<select id="country" name="country"></select><br>
<label for="city">City:</label><br>
  <input type="text" id="city" name="city"><br>
  <label for="address">Address:</label><br>
  <input type="text" id="address" name="address"><br>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="uname">Username:</label><br>
  <input type="text" id="uname" name="uname"><br>
  <label for="pass">Password:</label><br>
  <input type="password" id="pass" name="pass"><br>
  <label for="cpass">Confirm Password:</label><br>
  <input type="password" id="cpass" name="cpass"><br>
  <button type="submit" name="Submit">Submit</button>

 
 
 

</form>



</body>
</html>