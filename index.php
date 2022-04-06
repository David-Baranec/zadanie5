<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script>
        $(function($) {
            $("#myPOST").click(function() {
                $.ajax({
                    type: 'POST',
                    url: 'https://site38.webte.fei.stuba.sk/zadanie5/inventors',
                    data: '{"name":"Daniel", "surname": "Baranec", "birth_date":"2000.04.28","birth_place":"Nova Bana", "description":"zadanie"}',
                    success: function(msg) {
                        $("#myDiv").html(msg);
                        console.log(msg);
                    }
                });
            });
            $("#myDELETE").click(function() {
                $.ajax({
                    type: 'DELETE',
                    url: 'https://site38.webte.fei.stuba.sk/zadanie5/inventors',
                    success: function(msg) {
                        $("#myDiv").html(msg);
                    }
                });
            });
            $("#myPUT").click(function() {
                $.ajax({
                    type: 'PUT',
                    url: 'https://site38.webte.fei.stuba.sk/zadanie5/inventors',
                    //data: '{"meno":"Mirco","vek":"22","pohlavie":"M","opis":"student"}',
                    success: function(msg) {
                        $("#myDiv").html(msg);
                    }
                });
            });
            $("#myGET").click(function() {
                $.ajax({
                    type: 'GET',
                    url: 'https://site38.webte.fei.stuba.sk/zadanie5/inventors',
                    //data: '{"meno":"Mirco","vek":"22","pohlavie":"M","opis":"student"}',
                    success: function(msg) {
                        $("#myDiv").html(msg);

                        console.log(msg);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <div id="buttons" class="container">
        <br>
        <button id="myPOST">Submit POST</button>
        <button id="myDELETE">Submit DELETE</button>
        <button id="myPUT">Submit PUT</button>
        <button id="myGET">Submit GET</button>
        <div id="myDiv"></div>
        <br>
    </div>
    <div id="inventor" class="container">
        <form>
        <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">Id </label>
            </div>
            <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">Inventors name </label>
            </div>
            <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">Inventors surname</label>
            </div>
            <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">Birth date</label>
            </div>
            <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">BirthPlace</label>
            </div>
            <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">Death date</label>
            </div>
            <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">Death place</label>
            </div>
            <div class="form-outline">
                <input type="text" id="form3Example1" class="form-control" />
                <label class="form-label" for="form3Example1">Description</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>