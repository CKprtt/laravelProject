<!doctype html>
<html lang="th">
<head>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการจอง</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
  <style>
    body {font-family: 'Kanit', sans-serif;background-color: #EBE6E0;margin: 0;padding: 0;}
      /* ส่วน Header */
      header {background-color: #A88E7A;color: white;display: flex;justify-content: space-between;align-items: center;padding: 15px 40px;height: 80px;box-shadow: 0 4px 10px rgba(0,0,0,0.1);}
      header h1 { font-size: 28px;margin: 0;letter-spacing: 1px;}
      /* เมนูหลัก */
      .nav {display: flex;align-items: center;gap: 25px;}
      .nav a {color: white;text-decoration: none;font-weight: 500;font-size: 16px;padding: 8px 15px;border-radius: 10px;transition: all 0.3s ease;}
      .nav a:hover {background-color: #E8D9C2;color: #4B3F36;}
      /* Dropdown */
      .dropdown {position: relative;}
      .dropdown .menu {display: none;position: absolute;top: 100%;left: 0;background-color: #F8F3EF;min-width: 150px;box-shadow: 0 2px 8px rgba(0,0,0,0.2);border-radius: 10px;overflow: hidden;z-index: 10;}
      .dropdown .menu a {display: block;color: #4B3F36;padding: 10px 15px;text-decoration: none;transition: background-color 0.2s ease;}
      .dropdown .menu a:hover {background-color: #E8D9C2;}
      /* แสดงเมนูเมื่อ hover */
      .dropdown:hover .menu {display: block;}
      .logout {background: none;border: none;color: white;font-size: 16px;font-weight: 500;font-family: 'Kanit', sans-serif;padding: 8px 15px;border-radius: 10px;cursor: pointer;transition: all 0.3s ease;}
      /* เมื่อเอาเมาส์ชี้ */
      .logout:hover {background-color: #E8D9C2;color: #4B3F36;}
    .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
    .card { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1); display: flex; flex-direction: column; transition: transform 0.2s ease; }
    .card:hover { transform: translateY(-4px); }
    .poster { width: 100%; aspect-ratio: 16 / 9; background-color: #ddd; overflow: hidden; }
    .poster img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .content { padding: 16px; display: flex; flex-direction: column; gap: 8px; }
    .title { font-weight: 700; font-size: 18px; }
    .meta { font-size: 14px; color: #666; }
    .btn { align-self: flex-start; margin-top: 10px; background-color: #f2e2cc; padding: 8px 16px; border-radius: 8px; font-size: 14px; color: #333; text-decoration: none; font-weight: 600; transition: all 0.2s ease-in-out; border: 1px solid #e0c9a6; cursor: pointer; }
    .btn:hover { background-color: #e0c9a6; color: #222; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,0,0,0.15); }
    .empty { grid-column: 1 / -1; text-align: center; font-size: 18px; color: #777; margin-top: 40px; }
    .branner { display:flex; justify-content:center; align-items:center; margin: 20px auto; max-width: 1000px; overflow:hidden; }
    .branner img { width:100%; max-width:500px; max-height:150px; object-fit:cover; border-radius:10px; box-shadow:0 4px 12px rgba(0,0,0,0.2); }
    .search { display:flex; max-width:600px; width:90%; box-shadow:0 4px 12px rgba(0,0,0,0.1); border-radius:10px; overflow:hidden; margin-left: 450px; }
    .search input { flex:1; padding:12px 16px; border:1px solid #ccc; border-right:none; font-size:16px; outline:none; }
    .search button { padding:12px 20px; border:none; background:#e0c9a6; font-size:16px; cursor:pointer; color:#000; }
    .search button:hover { background:#dcb478ff; }
    .eventHall{ margin-left:100px; }
  </style>
</head>
<body>
<header>
  <h1>Hor Sin !</h1>
  <nav class="nav">
    <a href="{{ route('home') }}">Home</a>
    <div class="dropdown">
      <a href="#">Booking ▾</a>
      <div class="menu">
        <a href="{{ route('home') }}">Hall</a>
        <a href="{{ route('home') }}">Souvenir</a>
      </div>
    </div>
    <div class="dropdown">
      <a href="#">My Bookings ▾</a>
      <div class="menu">
        <a href="{{ route('bookings.index') }}">Hall</a>
        <a href="#">Souvenir</a>
      </div>
    </div>
    @auth
      <form method="POST" action="{{ route('logout') }}" style="display:inline">
        @csrf
        <button class ="logout" type="submit">Logout</button>
      </form>
    @else
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
    @endauth
  </nav>
</header>

<div class='branner'>
  <img src="https://pbs.twimg.com/media/D5d2aEkUwAEmcbE?format=jpg&name=4096x4096" alt="">
</div>

<div class="search">
  <input type="text" name="search" value="" placeholder="ค้นหา.....">
  <button>ค้นหา</button>
</div>
{{------------------------------------- ใช้ Hall----------------------------}}
<div class="eventHall"><h3>จองตั๋วเข้าชมโรงละคร</h3></div>
<div class="container">
  @if($hallEvents->isEmpty())
    <p class="empty">ยังไม่มีงานแสดง</p>
  @else
    @foreach($hallEvents as $e)
      <div class="card">
        <div class="poster">
          @if(isset($e->poster_path))
            <img src="{{ Str::startsWith($e->poster_path, ['http://','https://']) ? $e->poster_path : asset($e->poster_path) }}" alt="poster">
          @else
            <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#999;">ไม่มีรูปภาพ</div>
          @endif
        </div>
        <div class="content">
          <div class="title">{{ $e->events_name ?? $e->name ?? '-' }}</div>
          <div class="meta">
            {{ date('Y-m-d', strtotime($e->start_at)) }} {{ date('H:i', strtotime($e->start_at)) }} - {{ date('H:i', strtotime($e->end_at)) }}
          </div>
          <div class="meta">ผู้จัด: {{ $e->artist_name ?? '-' }}</div>
          <a class="btn" href="{{ route('events.show', $e->id) }}">เพิ่มเติม</a>
        </div>
      </div>
    @endforeach
  @endif
</div>

{{------------------------------- นิทรรศการ (นอก Hall) -----------------------------------}}
<div class="eventHall"><h3>จองตั๋วงานชมนิทรรศการ</h3></div>
<div class="container">
  @if($nonHallEvents->isEmpty())
    <p class="empty">ยังไม่มีงานแสดง</p>
  @else
    @foreach($nonHallEvents as $e)
      <div class="card">
        <div class="poster">
          @if(isset($e->poster_path))
            <img src="{{ Str::startsWith($e->poster_path, ['http://','https://']) ? $e->poster_path : asset($e->poster_path) }}" alt="poster">
          @else
            <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#999;">ไม่มีรูปภาพ</div>
          @endif
        </div>
        <div class="content">
          <div class="title">{{ $e->events_name ?? $e->name ?? '-' }}</div>
          <div class="meta">
            {{ date('Y-m-d', strtotime($e->start_at)) }}  {{ date('H:i', strtotime($e->start_at)) }} - {{ date('H:i', strtotime($e->end_at)) }}
          </div>
          <div class="meta">ผู้จัด: {{ $e->artist_name ?? '-' }}</div>
          <a class="btn" href="{{ route('events.show', $e->id) }}">เพิ่มเติม</a>
        </div>
      </div>
    @endforeach
  @endif
</div>

</body>
</html>