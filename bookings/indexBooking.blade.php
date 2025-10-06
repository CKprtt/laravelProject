<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจองของฉัน</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/indexBooking.css') }}">
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

<div class="booking-tabs">
  <a href="{{ route('bookings.indexBooking')}}" class="tab active">จองเข้าชม</a>
  <a href="{{ route('souvenirs.indexSouvenir')}}" class="tab">จองของที่ระลึก</a>
</div>

<a href="{{ route('home') }}" class='came'><< กลับหน้าแรก</a> <br>

@if(session('ok'))   <div class="success">{{ session('ok') }}</div> @endif
@if(session('err'))  <div class="error">{{ session('err') }}</div>  @endif

<!-- ---------------- ประวัติ: จองเข้าชม (Hall) ------------ -->
<h2 class="came1">ประวัติ: จองเข้าชม (Hall)</h2>

@if(empty($hallBookings))
  <p class="came">ยังไม่มีการจองแบบ Hall</p>
@else
  @foreach($hallBookings as $b)
    <div class="card">
      <img src="{{ $b->event->poster_path }}" alt="event image" style="width:180px; border-radius:6px;">
      <div class="info">
        <h2>
          {{ $b->event->events_name ?? '-' }}
          <span class="badge badge-hall">Hall</span>
        </h2>
        <div class="haed">
          {{ $b->event->start_at ?? '' }} - {{ $b->event->end_at ?? '' }}
        </div>
        <div class="details">
          ผู้จอง: {{ $b->user->name ?? '-' }}<br>
          Email: {{ $b->user->email ?? '-' }}<br>
          Ticket Number: {{ $b->tracking_number }}<br>
          โซน: {{ $b->zone->zones_name ?? '-' }}
        </div>
      </div>

      <div class="actions">
        <!-- เปลี่ยนโซนได้เฉพาะ Hall -->
        <form method="POST" action="{{ route('bookings.updateZone', $b->id) }}">
          @csrf
          <label for="zone_{{ $b->id }}">ต้องการเปลี่ยนโซน :</label>
          <select id="zone_{{ $b->id }}" name="zone_id" required>
            @foreach($zones as $z)
              <option value="{{ $z->id }}" {{ $b->zone_id == $z->id ? 'selected' : '' }}>
                โซน : {{ $z->zones_name }} (ความจุ {{ $z->zones_capacity }})
              </option>
            @endforeach
          </select>
          <button type="submit" class="btn-green">แก้ไข</button>
        </form>

        <form method="POST" action="{{ route('bookings.destroy', $b->id) }}" onsubmit="return confirm('ยืนยันการยกเลิก?')">
          @csrf
          <button type="submit" class="btn-red">ยกเลิก</button>
        </form>
        <div class="note">1 การจอง = 1 ที่นั่ง (แก้ได้เฉพาะโซน)</div>
      </div>
    </div>
  @endforeach
@endif


<!-- --------------- ประวัติ: จองนิทรรศการ (นอก Hall) ------------- -->
<h2 class="came1">ประวัติ: จองนิทรรศการ (นอก Hall)</h2>

@if(empty($nonHallBookings))
  <p class="came">ยังไม่มีการจองแบบนิทรรศการ (นอก Hall)</p>
@else
  @foreach($nonHallBookings as $b)
    <div class="card">
      <img src="{{ $b->event->poster_path }}" alt="event image" style="width:180px; border-radius:6px;">
      <div class="info">
        <h2>
          {{ $b->event->events_name ?? '-' }}
          <span class="badge badge-out">นิทรรศการ</span>
        </h2>
        <div class="haed">
          {{ $b->event->start_at ?? '' }} - {{ $b->event->end_at ?? '' }}
        </div>
        <div class="details">
          ผู้จอง: {{ $b->user->name ?? '-' }}<br>
          Email: {{ $b->user->email ?? '-' }}<br>
          Ticket Number: {{ $b->tracking_number }}<br>
          โซน: - 
        </div>
      </div>

      <div class="actions">
        <!-- นอก Hall: ยกเลิกเท่านั้น -->
        <form method="POST" action="{{ route('bookings.destroy', $b->id) }}" onsubmit="return confirm('ยืนยันการยกเลิก?')">
          @csrf
          <button type="submit" class="btn-red">ยกเลิก</button>
        </form>
      </div>
    </div>
  @endforeach
@endif


</body>
</html>