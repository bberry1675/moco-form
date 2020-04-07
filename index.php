<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <title>Petition Form</title>
</head>

<body>
    <div class="container-md mt-5">

        <h1>Sign the Petition</h1>
        <p>Use this form to download a petition with your name filled in.</p>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col-md">Last Name</th>
                        <th scope="col-md">First Name</th>
                        <th scope="col-md">House Number</th>
                        <th scope="col-md">City</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <input class="form-control" type="text">
                        </th>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                        <td>
                            <input class="form-control" type="text">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="ml-3">
            <input class="form-check-input" type="checkbox" name="checkall">
            <label class="form-check-label">Select All</label>
        </div>
        <div class="row table-responsive container mt-1">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Print</th>
                        <th scope="col">First,Middle,Last Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Birth Year</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                </tbody>
            </table>
        </div>
        <div class="row">
            <button id="create-button" class="btn btn-primary btn-block btn-large" type="button"
                data-toggle="manual">Create</button>
        </div>
        <form id="hidden-form" style="display:none;" method="POST" action="/create.php">
            <input id="hidden-input" name="responses">
        </form>
    </div>

    <script>
        let table_rows = [
            ['John Adam Smith I', '12345 MAIN STREET MOCOTOWN 00001', 1990],
            ['John Adam Smith II', '12345 MAIN STREET MOCOTOWN 00002', 1991],
            ['John Adam Smith III', '12345 MAIN STREET MOCOTOWN 00003', 1992],
            ['John Adam Smith IV', '12345 MAIN STREET MOCOTOWN 00004', 1993],
            ['John Adam Smith V', '12345 MAIN STREET MOCOTOWN 00005', 1994],
            ['John Adam Smith VI', '12345 MAIN STREET MOCOTOWN 00006', 1995],
            ['John Adam Smith VII', '12345 MAIN STREET MOCOTOWN 00007', 1996],
            ['John Adam Smith VIII', '12345 MAIN STREET MOCOTOWN 00008', 1997],
            ['John Adam Smith IX', '12345 MAIN STREET MOCOTOWN 00009', 1998],

        ];

        table_rows.forEach(row => {
            $('#table-body').append(
                `<tr>
                        <th>
                            <input class="form-check-input ml-2" name="${row[0]}" address="${row[1]}" year="${row[2]}" type="checkbox">
                        </th>
                        <td>
                            ${row[0]}
                        </td>
                        <td>
                            ${row[1]}
                        </td>
                        <td>
                            ${row[2]}
                        </td>
                </tr>`
            );
        });

        function button_popover(title, content) {
            let button = $('#create-button');
            button.attr('data-title', title);
            button.attr('data-content', content);
            button.popover('show');
            setTimeout(() => {
                button.popover('hide');
            }, 5000);

        }

        $('#create-button').on('click', event => {

            let responses = $('th>input:checked').map((index, domElement) => {
                let ele = $(domElement);
                return {
                    name: ele.attr('name'),
                    address: ele.attr('address'),
                    year: ele.attr('year')
                };
            }).get()


            if (responses.length > 0) {

                $('#hidden-input').val(JSON.stringify(responses));
                $('#hidden-form').submit();
                
            } else {
                button_popover('Error', 'Please select atleast one');
            }
        })
    </script>
</body>

</html>