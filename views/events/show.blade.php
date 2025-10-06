<!doctype html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>กำลังจอง</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
  <style>
    body {font-family:'Kanit',sans-serif;background:#EBE6E0;margin:0;padding:0}
    header{background:#A88E7A;color:#fff;display:flex;justify-content:space-between;align-items:center;padding:15px 40px;height:80px;box-shadow:0 4px 10px rgba(0,0,0,0.1)}
    header h1{font-size:28px;margin:0;letter-spacing:1px}
    .nav{display:flex;align-items:center;gap:25px}
    .nav a{color:#fff;text-decoration:none;font-weight:500;font-size:16px;padding:8px 15px;border-radius:10px;transition:.3s}
    .nav a:hover{background:#E8D9C2;color:#4B3F36}
    .dropdown{position:relative}
    .dropdown .menu{display:none;position:absolute;top:100%;left:0;background:#F8F3EF;min-width:150px;box-shadow:0 2px 8px rgba(0,0,0,0.2);border-radius:10px;overflow:hidden;z-index:10}
    .dropdown .menu a{display:block;color:#4B3F36;padding:10px 15px;text-decoration:none}
    .dropdown .menu a:hover{background:#E8D9C2}
    .dropdown:hover .menu{display:block}
    .logout{background:none;border:none;color:#fff;font-size:16px;font-weight:500;font-family:'Kanit',sans-serif;padding:8px 15px;border-radius:10px;cursor:pointer}
    .logout:hover{background:#E8D9C2;color:#4B3F36}
    .wrap{max-width:1120px;margin:18px auto 28px;padding:0 14px}
    .grid{display:grid;grid-template-columns:370px 1fr;gap:28px}
    .card{background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.08);padding:18px}
    .poster{width:100%;aspect-ratio:4/3;background:#eee;object-fit:cover;border-radius:8px;display:block}
    .title{font-weight:700;font-size:18px;margin:12px 0 6px}
    .meta{color:#6b6b6b;font-size:14px;margin:4px 0}
    .desc{font-size:14px;line-height:1.55;margin-top:10px}
    .back{display:inline-block;margin-top:20px;color:#6a5f56;text-decoration:none;font-size:14px;margin-left:100px}
    .stage{background:#9e9e9e;color:#fff;font-weight:800;text-align:center;padding:26px 0;border-radius:8px;font-size:28px;letter-spacing:1px;margin-bottom:18px}
    .seats{display:grid;grid-template-columns:1fr 60px 1fr;gap:18px;align-items:stretch}
    .pillar{background:#9e9e9e;border-radius:8px;margin-top:-40px}
    .zone{background:#ddd;border-radius:12px;box-shadow:0 2px 6px rgba(0,0,0,.08);display:flex;align-items:center;justify-content:center;text-align:center;padding:26px 6px;border:2px solid transparent;transition:.15s;cursor:pointer;position:relative}
    .zone:hover{transform:translateY(-1px);box-shadow:0 6px 14px rgba(0,0,0,.10)}
    .zone-title{font-weight:700;font-size:18px}
    .sub{font-size:14px;margin-top:4px;opacity:.85}
    .foot{display:flex;justify-content:space-between;align-items:center;margin-top:14px}
    .legend{font-size:13px;color:#6b6b6b;display:flex;gap:14px;align-items:center}
    .dot{width:12px;height:12px;border-radius:6px;display:inline-block;margin-right:6px}
    .btn{background:#c5a182;color:#fff;border:0;padding:12px 20px;border-radius:10px;font-weight:800;cursor:pointer}
    .btn:not(:disabled):hover{background:#b58a69}
    .zone input {display: none;}
    .a { background-color: #f7c9e9; } 
    .b { background-color: #bfe3fb; } 
    .c { background-color: #f2a9a1; } 
    .a:has(input:checked) { background-color: #fde6f5; } 
    .b:has(input:checked) { background-color: #d8efff; } 
    .c:has(input:checked) { background-color: #ffd1cc; } 
    .zone:has(input:checked) {outline: 1px solid #cccc;outline-offset: 2px;transform: scale(1);transition: 0.1s;}
    .card1{background:#fff;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,.08);padding:24px 22px 70px;position:relative;min-height:76%}
    .btn1{background:#c5a182;color:#fff;border:none;padding:12px 26px;border-radius:10px;font-weight:800;cursor:pointer;transition:.3s;position:absolute;bottom:24px;right:22px;box-shadow:0 4px 10px rgba(0,0,0,0.1)}
    .btn1:hover{background:#b58a69}
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
      <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf
        <button class="logout" type="submit">Logout</button>
      </form>
    @else
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
    @endauth
  </nav>
</header>

<a href="{{ route('home') }}" class="back"><< หน้าแรก</a>

<div class="wrap">
  <div class="grid">
    <div class="card">
      @if(isset($event->poster_path))
        <img class="poster" src="{{ asset($event->poster_path) }}" alt="poster">
      @else
        <div class="poster" style="display:flex;align-items:center;justify-content:center;color:#888">No Poster</div>
      @endif

      <div class="title">
        {{ $event->events_name ?? $event->name ?? '-' }}
      </div>

      <div class="meta">
        {{ date('Y-m-d', strtotime($event->start_at)) }}
        &nbsp;&nbsp;{{ date('H:i', strtotime($event->start_at)) }}–{{ date('H:i', strtotime($event->end_at)) }}
      </div>

      @if(isset($artistName))
        <div class="meta">ผู้จัด: {{ $artistName }}</div>
      @endif

      @if(isset($event->description))
        <div class="desc">{{ $event->description }}</div>
      @endif
    </div>

    <!-- พื้นที่จอง (ขวา) -->
    <div>

      @if($isHall)
        <!-- --------------------------แบบใช้ Hall: มีผังเวที (radio) ----------------- -->
        <div class="stage">STAGE</div>

        <form method="POST" action="{{ route('bookings.store', $event->id) }}">
          @csrf
          {{-- บอกคอนโทรลเลอร์ว่านี่คือจองใน Hall --}}
          <input type="hidden" name="type_hall" value="Yes">
          <input type="hidden" name="qty" value="1">

          <div class="seats">
            <!-- A ซ้าย -->
            @if(isset($zoneA))
              <label class="zone a">
                <input type="radio" name="zone_id" value="{{ $zoneA->id }}" required>
                <span class="inner">
                  <div class="zone-title">A</div>
                  <div class="sub">{{ sprintf('%02d', $zoneA->used ?? 0) }}/{{ $zoneA->zones_capacity ?? '20' }}</div>
                </span>
              </label>
            @endif

            <div class="pillar"></div>

            @if(isset($zoneA))
              <label class="zone a">
                <input type="radio" name="zone_id" value="{{ $zoneA->id }}" required>
                <span class="inner">
                  <div class="zone-title">A</div>
                  <div class="sub">{{ sprintf('%02d', $zoneA->used ?? 0) }}/{{ $zoneA->zones_capacity ?? '20' }}</div>
                </span>
              </label>
            @endif

             <!-- B เต็ม -->
            @if(isset($zoneB))
              <label class="zone b" style="grid-column:1 / -1">
                <input type="radio" name="zone_id" value="{{ $zoneB->id }}" required>
                <span class="inner">
                  <div class="zone-title">B</div>
                  <div class="sub">{{ sprintf('%02d', $zoneB->used ?? 0) }}/{{ $zoneB->zones_capacity ?? '40' }}</div>
                </span>
              </label>
            @endif

            <!-- C เต็ม -->
            @if(isset($zoneC))
              <label class="zone c" style="grid-column:1 / -1">
                <input type="radio" name="zone_id" value="{{ $zoneC->id }}" required>
                <span class="inner">
                  <div class="zone-title">C</div>
                  <div class="sub">{{ sprintf('%02d', $zoneC->used ?? 0) }}/{{ $zoneC->zones_capacity ?? '40' }}</div>
                </span>
              </label>
            @endif
          </div>

          <div class="foot">
            <div class="legend">
              <span><span class="dot" style="background:#f7c9e9"></span> A - Front Zone</span>
              <span><span class="dot" style="background:#bfe3fb"></span> B - Middle Zone</span>
              <span><span class="dot" style="background:#f2a9a1"></span> C - Back Zone</span>
            </div>
            <button class="btn" type="submit">จอง</button>
          </div>
        </form>

      @else
<!-- การจองนอก Hall -->
        <div class="card1">
          <div class="title" style="margin-top:0">รายละเอียดการเข้าชม (นิทรรศการ)</div>
          <div class="meta">ไม่มีการเลือกที่นั่ง/โซน (ยืน/เดินชม)</div>
          <div class="desc" style="margin-top:8px">
            กด “จอง” เพื่อยืนยันการเข้าชมนิทรรศการนี้ ระบบจะบันทึกการจองของคุณโดยไม่มีโซนที่นั่ง
          </div>
          <form method="POST" action="{{ route('bookings.store', $event->id) }}" style="margin-top:14px">
            @csrf
            <input type="hidden" name="type_hall" value="No">
            <input type="hidden" name="qty" value="1">
            <button class="btn1" type="submit">จอง</button>
          </form>
        </div>
      @endif

    </div>
  </div>
</div>
</body>
</html>
