<!doctype html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>กำลังจอง</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="{{ asset('css/showEvent.css') }}">
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
        <button class ="logout" type="submit">Logout</button>
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

        <form method="POST" action="{{ route('bookings.storeZone', $event->id) }}">
          @csrf
          {{-- บอกคอนโทรลเลอร์ว่านี่คือจองใน Hall --}}
          <input type="hidden" name="type_hall" value="Yes">
          <input type="hidden" name="qty" value="1">

          <div class="seats">
            <!-- A -->
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

             <!-- B  -->
            @if(isset($zoneB))
              <label class="zone b" style="grid-column:1 / -1">
                <input type="radio" name="zone_id" value="{{ $zoneB->id }}" required>
                <span class="inner">
                  <div class="zone-title">B</div>
                  <div class="sub">{{ sprintf('%02d', $zoneB->used ?? 0) }}/{{ $zoneB->zones_capacity ?? '40' }}</div>
                </span>
              </label>
            @endif

            <!-- C -->
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
<!-- ----------------  การจองนอก Hall  ---------------------- -->
        <div class="card1">
          <div class="title" style="margin-top:0">รายละเอียดการเข้าชม (นิทรรศการ)</div>
          <div class="meta">ไม่มีการเลือกที่นั่ง/โซน (ยืน/เดินชม)</div>
          <div class="desc" style="margin-top:8px">
            กด “จอง” เพื่อยืนยันการเข้าชมนิทรรศการนี้ ระบบจะบันทึกการจองของคุณโดยไม่มีโซนที่นั่ง
          </div>
          <form method="POST" action="{{ route('bookings.storeZone', $event->id) }}" style="margin-top:14px">
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
