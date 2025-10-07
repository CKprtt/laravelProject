<!doctype html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการจอง</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/indexEvent.css') }}">
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
                    <a href="{{ route('souvenirs.indexSouvenir') }}">Souvenir</a>
                </div>
            </div>
            <div class="dropdown">
                <a href="#">My Bookings ▾</a>
                <div class="menu">
                    <a href="{{ route('bookings.indexBooking') }}">Hall</a>
                    <a href="{{ route('souvenirs.showSouvenir') }}">Souvenir</a>
                </div>
            </div>
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button class="logout" type="submit">Logout</button>
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
        <input type="text" name="search" placeholder="ค้นหา.....">
        <button>ค้นหา</button>
    </div>

    <!------------------------------------- ใช้ Hall---------------------------- -->
    <div class="eventHall">
        <h3>จองตั๋วเข้าชมโรงละคร</h3>
    </div>
    <div class="container">
        @if (!isset($hallEvents) || $hallEvents->isEmpty())
            <p class="empty">ยังไม่มีงานแสดง</p>
        @else
            @foreach ($hallEvents as $e)
                <div class="card">
                    <div class="poster">
                        @if (!empty($e->poster_path))
                            <img src="{{ $e->poster_path }}" alt="poster" style="width:180px; border-radius:6px;">
                        @else
                            <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#999;">
                                ไม่มีรูปภาพ
                            </div>
                        @endif
                    </div>
                    <div class="content">
                        <div class="title">{{ $e->events_name ?? '-' }}</div>
                        <div class="meta">
                            {{ $e->start_date }} - {{ $e->end_date }}
                        </div>
                        <div class="meta">ประเภท: {{ $e->type_hall }}</div>
                        <a class="btn" href="{{ route('events.showEvent', $e->events_id) }}">เพิ่มเติม</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <!------------------------------- นิทรรศการ (นอก Hall) ----------------------------------->
    <div class="eventHall">
        <h3>จองตั๋วงานชมนิทรรศการ</h3>
    </div>
    <div class="container">
        @if (!isset($nonHallEvents) || $nonHallEvents->isEmpty())
            <p class="empty">ยังไม่มีงานแสดง</p>
        @else
            @foreach ($nonHallEvents as $e)
                <div class="card">
                    <div class="poster">
                        @if (!empty($e->poster_path))
                            <img src="{{ $e->poster_path }}" alt="poster" style="width:180px; border-radius:6px;">
                        @else
                            <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#999;">
                                ไม่มีรูปภาพ
                            </div>
                        @endif
                    </div>
                    <div class="content">
                        <div class="title">{{ $e->events_name ?? '-' }}</div>
                        <div class="meta">
                            {{ $e->start_date }} - {{ $e->end_date }}
                        </div>
                        <div class="meta">ประเภท: {{ $e->type_hall }}</div>
                        <a class="btn" href="{{ route('events.showEvent', $e->events_id) }}">เพิ่มเติม</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>

</html>
