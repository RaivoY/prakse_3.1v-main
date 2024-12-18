<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Public Form submissions</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea, button, select {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        form button {
            background: #333;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background: #555;
        }
        select {
            appearance: none;
            background-color: #fff;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="none" stroke="%23000" stroke-width=".75" d="M2 0L0 2h4z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 8px 10px;
        }
        .radio-group {
            display: flex;
            justify-content: center;
            gap: 10px; /* Adjust this value to make the gaps smaller */
        }
        .radio-group label {
            display: flex;
            align-items: center;
        }
        .radio-group input {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Public Form submission</h1>
        <form action="/mainform" method="POST">
            @csrf
            <label for="email">Enter your email:</label>
            <input type="email" id="email" name="email" required>

            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments" rows="4" cols="40" required></textarea>

            <label for="topic">Select your topic: </label>
            <select name="topic" id="topic">
                <option value="tech">Technical support</option>
                <option value="sales">Sales</option>
                <option value="other">Other</option>
            </select>

            <label for="priority">Select your priority: </label>
            <div class="radio-group">
                <label for="low">
                    <input type="radio" id="low" name="priority" value="low">
                    Low
                </label>
                <label for="medium">
                    <input type="radio" id="medium" name="priority" value="medium">
                    Medium
                </label>
                <label for="high">
                    <input type="radio" id="high" name="priority" value="high">
                    High
                </label>
            </div>

            <button type="submit">Submit</button>
        </form>
        <a href="/admin">admin</a>
    </div>
</body>
</html>