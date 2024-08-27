<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1>Coupons Data</h1>
    <table>
        <thead>
            <tr>
                <th>Code</th>
                <th>discount</th>
                <th>expiration_date</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
            <tr>
                <td>{{ $item->code }}</td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->expiration_date }}</td>
            
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>


