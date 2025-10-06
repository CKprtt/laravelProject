<!doctype html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>จองของที่ระลึก</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="{{ asset('css/indexSouvenir.css') }}">
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

<div class="booking-tabs">
  <a href="{{ route('bookings.indexBooking')}}" class="tab">จองเข้าชม</a>
  <a href="{{ route('souvenirs.indexSouvenir')}}" class="tab active">จองของที่ระลึก</a>
</div>

<div class="container">
  @if($souvenirs->isEmpty())
    <p class="empty">ยังไม่มีของที่ระลึก</p>
  @else
    @foreach($souvenirs as $s)
      <div class="card">
        <div class="poster">
          @if(isset($s->image_path))
            <img src="{{ asset($s->image_path) }}" alt="souvenir image">
          @else
            <div style="display:flex;align-items:center;justify-content:center;height:100%;color:#999;">ไม่มีรูปภาพ</div>
          @endif
        </div>
        <div class="content">
          <div class="title">{{ $s->souvenirs_name }}</div>
          <div class="meta">รายละเอียด: {{ $s->description ?? '-' }}</div>
          <div class="meta">สถานะ: {{ ucfirst($s->status) }}</div>
          <div class="meta">เหลือในสต็อก: {{ $s->quantity_left }}</div>

          @if($s->status == 'approved' && $s->quantity_left > 0)
            <form method="POST" action="{{ route('souvenirs.store', $s->id) }}">
              @csrf
              <a type="submit" class="form-btn" href="{{ route('souvenirs.showSouvenir', $s->id) }}">จอง</a>
            </form>
          @else
            <span class="note">ไม่สามารถจองได้</span>
          @endif
        </div>
      </div>
    @endforeach
  @endif
</div>

</body>
</html>


