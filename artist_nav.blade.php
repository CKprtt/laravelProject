<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Hall Management')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #EBE6E0;
            margin: 0;
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        header {
            height: 100px;
            background-color: #A88E7A;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h3 {
            color: white;
            margin: 0;
        }

        header nav ul {
            display: flex;
            gap: 20px;
            padding: 0;
            margin: 0;
        }

        header nav li {
            list-style: none;
        }

        header nav li a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }

        header nav li a:hover {
            color: black;
            background-color: #E8D9C2;
        }

        .container {
            flex: 1;
            padding: 20px;
        }

        footer {
            background-color: #A88E7A;
            color: white;
            text-align: center;
            padding: 30px 20px;
            margin-top: auto;
        }

        footer .p1 {
            font-size: 2em;
            font-weight: bold;
            margin: 0;
        }

        footer .p2 {
            font-size: 1em;
            margin: 5px 0 0 0;
        }
    </style>
</head>

<body>

    <header>
        <h3>Welcome Artist!</h3>
        <nav>
            <ul class="nav align-items-center">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="requestDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Request</a>
                    <ul class="dropdown-menu" aria-labelledby="requestDropdown" style="background-color: #F8F4EF;">
                        <li><a class="dropdown-item" href="{{ url('/artist/request/create') }}">ส่งคำขอจัดนิทัศการ</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ url('/artist/s/request/create') }}">ส่งคำขอแจกของที่ระลึก</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="sDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">My Request</a>
                    <ul class="dropdown-menu" aria-labelledby="requestDropdown" style="background-color: #F8F4EF;">
                        <li><a class="dropdown-item" href="{{ url('/artist/my_requests') }}">สถานะคำร้องขอจัดนิทัศการ</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('/artist/s/my_requests') }}">สถานะคำร้องขอแจกของที่ระลึก</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
        data-bs-toggle="dropdown" aria-expanded="false">
        Profile
    </a>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li>
            <a class="dropdown-item" href="{{ route('profile') }}">ดูโปรไฟล์</a>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">ออกจากระบบ</button>
            </form>
        </li>
    </ul>
</li>

            </ul>
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <p class="p1">Hor Sin!</p>
        <p class="p2">&copy; 2025 IT06. All Rights Reserved.</p>
    </footer>

</body>

</html>
