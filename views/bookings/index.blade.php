<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจองของฉัน</title>
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
      .dropdown:hover .menu {display: block;}
      .logout {background: none;border: none;color: white;font-size: 16px;font-weight: 500;font-family: 'Kanit', sans-serif;padding: 8px 15px;border-radius: 10px;cursor: pointer;transition: all 0.3s ease;}
      .logout:hover {background-color: #E8D9C2;color: #4B3F36;}
      h1 { margin: 20px }
      .came{ margin:50px; text-decoration: none; color:#6e6e6e }
      .came1{ margin:20px;  color:black }
      .card {background: white;border-radius: 10px;padding: 16px;margin: 20px;display: flex;gap: 20px;align-items: flex-start;box-shadow: 0 2px 6px rgba(0,0,0,0.1);}
      .card img { width: 180px; border-radius: 6px; }
      .card .info { flex: 1; }
      .card .info h2 { margin: 0; font-size: 18px; }
      .card .info .meta { font-size: 14px; color: #555; margin-top: 4px; }
      .card .info .details { font-size: 14px; margin-top: 10px; line-height: 1.5; }
      .card .actions { width: 220px; display: flex; flex-direction: column; gap: 10px; }
      .card .actions form { display: flex; flex-direction: column; gap: 6px; }
      select, button { padding: 6px 10px; font-size: 14px; }
      .btn-green { background: green; color: white; border: none; border-radius: 4px; }
      .btn-red { background: red; color: white; border: none; border-radius: 4px; }
      .note { font-size: 12px; color: #666; }
      .success {color: #2e7d32; background-color: #d9f2da;  border-left: 5px solid #4caf50; padding: 10px 15px;border-radius: 6px;margin: 10px 50px;font-weight: 500;display: inline-block;}
      .error {color: #b71c1c; background-color: #f8d7da;  border-left: 5px solid #f44336; padding: 10px 15px;border-radius: 6px;margin: 10px 50px;font-weight: 500;display: inline-block;}
      .booking-tabs { display: flex; justify-content: center; margin: 30px auto; gap: 20px; }
      .booking-tabs .tab {flex: 1; max-width: 500px; text-align: center; padding: 14px 0;border-radius: 25px; font-size: 18px; font-weight: 600; text-decoration: none;transition: all 0.3s ease;}
      .booking-tabs .tab:first-child { background: #a38674; color: #fff; }
      .booking-tabs .tab:last-child { background: #fff; border: 2px solid #d9bca5; color: #000; }
      .booking-tabs .tab:hover { transform: translateY(-2px); }
      .booking-tabs .tab.active { box-shadow: 0 3px 8px rgba(0,0,0,0.15); }

      .badge {display:inline-block; padding:3px 8px; border-radius:12px; font-size:12px; font-weight:700;background:#eee; color:#333; margin-left:6px;}
      .badge-hall { background:#fff4d9; color:#a66b00; }
      .badge-out { background:#fff4d9; color:#a66b00; }
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


<div class="booking-tabs">
  <a href="{{ route('bookings.index')}}" class="tab active">จองเข้าชม</a>
  <a href="#" class="tab">จองของที่ระลึก</a>
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
      <img src="{{ asset('images/sample-event.jpg') }}" alt="event image">
      <div class="info">
        <h2>
          {{ $b->event->events_name ?? '-' }}
          <span class="badge badge-hall">Hall</span>
        </h2>
        <div class="meta">
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
        <form method="POST" action="{{ route('bookings.update_zone', $b->id) }}">
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

        <form method="POST" action="{{ route('bookings.cancel', $b->id) }}" onsubmit="return confirm('ยืนยันการยกเลิก?')">
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
      <img src="{{ asset('images/sample-event.jpg') }}" alt="event image">
      <div class="info">
        <h2>
          {{ $b->event->events_name ?? '-' }}
          <span class="badge badge-out">นิทรรศการ</span>
        </h2>
        <div class="meta">
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
        <form method="POST" action="{{ route('bookings.cancel', $b->id) }}" onsubmit="return confirm('ยืนยันการยกเลิก?')">
          @csrf
          <button type="submit" class="btn-red">ยกเลิก</button>
        </form>
      </div>
    </div>
  @endforeach
@endif

</body>
</html>