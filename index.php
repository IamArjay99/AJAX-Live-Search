<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Live Search</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <h1 class="text-center py-4">Live Search using AJAX</h1>
                <input type="text" id="search" name="search" placeholder="Search" class="form-control">
                <div id="loading" class="text-center align-content-center">
                    <img src="../img/loader.gif" class="w-25 rounded-circle" alt="">
                </div>
                <div id="result" class="mt-5"></div>
            </div>
        </div>
    </div>

    <script src="../js/jquery-3.3.1.min.js"></script>
    <script>
    
        $(document).ready(function() {

            load_data();

            function load_data(search) {
                $.ajax({
                    url     : "process.php",
                    type    : "post",
                    data    : {query : search},
                    beforeSend : function() {
                        $('#loading').show();
                    },
                    complete: function() {
                        $('#loading').hide();
                    },
                    success : function(data) {
                        $('#result').html(data);
                    },
                    error: function() {
                        $('#result').html("There was an error in fetching");
                    }
                });
            }

            $('#search').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    load_data(search)
                } else {
                    load_data();
                }
            });

        });

    </script>
</body>
</html>