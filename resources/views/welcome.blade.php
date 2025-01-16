  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <style>
    /* General Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      line-height: 1.6;
      color: #000;
      background: #000;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      text-align: center;
      padding: 20px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      width: 90%;
    }

    .container h1 {
      font-size: 2.5rem;
      color: #000;
      margin-bottom: 20px;
    }

    .btn {
      display: inline-block;
      padding: 10px 20px;
      font-size: 1rem;
      color: #fff;
      background: #000;
      border: none;
      border-radius: 25px;
      text-decoration: none;
      transition: background 0.3s ease;
      cursor: pointer;
    }

    .btn:hover {
      background: #357ab7;
    }

    @media (max-width: 600px) {
      .container h1 {
        font-size: 2rem;
      }

      .container p {
        font-size: 0.9rem;
      }

      .btn {
        padding: 8px 16px;
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>
  <div class="container bg-black tex-white">
    <h1>Welcome to admin panel</h1>
    @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn">Log in</a>

                        <!-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif -->
                    @endauth
                </div>
            @endif
  </div>
</body>
</html>

