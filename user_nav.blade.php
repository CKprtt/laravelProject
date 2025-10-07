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
    font-family: 'Kanit', sans-serif;
    background-color: #EBE6E0;
    margin: 0;
    padding: 0;
}

/* ส่วน Header */
header {
    background-color: #A88E7A;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 40px;
    height: 80px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

header h1 {
    font-size: 28px;
    margin: 0;
    letter-spacing: 1px;
}

/* เมนูหลัก */
.nav {
    display: flex;
    align-items: center;
    gap: 25px;
}

.nav a {
    color: white;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
    padding: 8px 15px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.nav a:hover {
    background-color: #E8D9C2;
    color: #4B3F36;
}

/* Dropdown */
.dropdown {
    position: relative;
}

.dropdown .menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #F8F3EF;
    min-width: 150px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    overflow: hidden;
    z-index: 10;
}

.dropdown .menu a  {
    display: block;
    color: #4B3F36;
    padding: 10px 15px;
    text-decoration: none;
    transition: background-color 0.2s ease;
}
.menu form button{
    color: #4B3F36;

}


.dropdown .menu a:hover {
    background-color: #E8D9C2;
}

.dropdown:hover .menu {
    display: block;
}

.logout {
    background: none;
    border: none;
    color: white;
    font-size: 16px;
    font-weight: 500;
    font-family: 'Kanit', sans-serif;
    padding: 8px 15px;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.logout:hover {
    background-color: #E8D9C2;
    color: #4B3F36;
}
    </style>
</head>
<body>
<header>
  <h3>Hor Sin !</h3>
  <nav class="nav">
    <a href="{{ route('home') }}">หน้าหลัก</a>
    <div class="dropdown">
      <a href="#">จองตั๋ว ▾</a>
      <div class="menu">
        <a href="{{ route('home') }}">จองตั๋ว</a>
        <a href="{{ route('souvenirs.indexSouvenir') }}">ของที่ระรึก</a>
      </div>
    </div>
    <div class="dropdown">
      <a href="#">ประวัติการจอง ▾</a>
      <div class="menu">
        <a href="{{ route('bookings.indexBooking') }}">ตั๋วของฉัน</a>
        <a href="{{ route('souvenirs.showSouvenir') }}">ของที่ระรึก</a>
      </div>
    </div>
    @auth
    <div class="dropdown">
        <a href="{{route('profile') }}">โปรไฟล์</a>
        <div class="menu">
            <form method="POST" action="{{ route('logout') }}" style="display:inline" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?')">
                @csrf
            <button class ="logout" type="submit">ออกจากระบบ</button>
            </form>
          </div>
    </div>
    @else
    <div class="dropdown">
        <a href="{{ route('login')}}">โปรไฟล์</a>
        <div class="menu">
            <a href="{{ route('login') }}">เข้าสู่ระบบ</a>
            <a href="{{ route('register') }} " >ออกจากระบบ</a>
        </div>
    </div>
    @endauth
  </nav>
</header>
<body>

    <div class="container">
        @yield('content')
    </div>
</body>

</html>
