<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hall Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
    <style>

        body {
            font-family: 'kanit', sans-serif;
            background-color: #EBE6E0;
        }
        
        header nav ul {
            display: flex;
            gap: 20px;
            padding: 0;
            margin: 0;
        }

        header nav li {
            list-style: none;
            margin: 0 10px;
        }

        header nav li a  ,header nav li form button {
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 30px;
        }

        header nav li a:hover,header nav li button:hover  {
            color: black;
            background-color: #E8D9C2;
        }

        

        header {
            height: 100px;
            background-color: #A88E7A;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: white;
            margin: 0;
        }

        .container {
            padding: 20px;
        }
        button{
            background-color: #A88E7A;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 30px;
        }
    </style>
</head>

<body>

    <header>
        <h1>Welcome Super Admin!</h1>
        <nav>
            <ul>
                <li><a href= href="/dashboard">Home</a></li>
                <li><a href="{{ url('/admin/requests') }}">Request</a></li>
                <li><a href="{{ url('#') }}">Zone</a></li>
                <li><a href="/dashboard/manage">Management Account</a></li>
                <li><form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure you want logout')">Logout</button>
                </form></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>