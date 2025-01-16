<!DOCTYPE html>
<html>
<head>
    <title>PLDS {{ $userName }} Transaction History</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            font-weight: 700;
            color: #dc3545;
            margin-bottom: 20px;
        }

        p {
            font-weight: 600;
            margin-bottom: 10px;
            color: #555;
        }

        .user-details {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: 600;
        }

        td {
            color: #333;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 3px;
            text-transform: uppercase;
        }

        .badge-success {
            background-color: #28a745;
            color: #fff;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #fff;
        }

        .badge-failed {
            background-color: #dc3545;
            color: #fff;
        }

        .total {
            text-align: right;
            font-size: 16px;
            font-weight: 700;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>PLDS TRANSACTION HISTORY</h1>

    <div class="user-details">
        <p><strong>User Name:</strong> {{ $userName }}</p>
        <p><strong>User ID:</strong> {{ $userId }}</p>
    </div>

    <h2>Completed Payout Requests</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payoutRequests as $request)
                <tr>
                    <td>{{ $request->id }}</td>
                    <td>{{ number_format($request->amount, 2) }}</td>
                    <td>
                        <span class="badge badge-success">Approved</span>
                    </td>
                    <td>{{ $request->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Payout Amount: PKR {{ number_format($totalAmount, 2) }}</p>
</body>
</html>
