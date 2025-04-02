<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 10px;
        }
        .info {
            text-align: left;
            padding: 15px;
            background: #fafafa;
            border-radius: 5px;
            margin-top: 10px;
        }
        .info p {
            margin: 5px 0;
            font-size: 16px;
        }
        .info strong {
            color: #555;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>📩 New Contact Message</h2>
        <p>You have received a new message from the contact form.</p>

        <div class="info">
            <p><strong>👤 Name:</strong> {{ $data['name'] }}</p>
            <p><strong>📧 Email:</strong> <a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
            <p><strong>📝 Message:</strong></p>
            <p>{{ $data['message'] }}</p>
        </div>
    </div>

</body>
</html>