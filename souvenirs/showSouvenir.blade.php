<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>จองของที่ระลึก</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" href="{{ asset('css/showSouvenir.css') }}">
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
        <a href="{{ route('souvenirs.indexSouvenir') }}">Souvenir</a> <!--หน้าโชว์ รายการของที่รับมา-->
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
  <a href="{{ route('bookings.indexBooking')}}" class="tab">จองเข้าชม</a>
  <a href="{{ route('souvenirs.indexSouvenir')}}" class="tab active">จองของที่ระลึก</a>
</div>

<a href="{{ route('home') }}" class='came'><< กลับหน้าแรก</a> <br>

@if(session('ok'))   <div class="success">{{ session('ok') }}</div> @endif
@if(session('err'))  <div class="error">{{ session('err') }}</div>  @endif

<h2 class="came1">ประวัติ: จองของที่ระลึก (Souvenir)</h2>

@if($orders->isEmpty())
  <p class="came">ยังไม่มีการจองของที่ระลึก</p>
@else
  @foreach($orders as $o)
    <div class="card">
      @if(!empty($o->souvenir->image_path))
        <img src="{{ asset($o->souvenir->image_path) }}" alt="souvenir image">
      @endif


      <div class="info">
        <h2>
          {{ $o->souvenir->souvenirs_name ?? '-' }}
          <span class="badge badge-hall">Souvenir</span>
        </h2>
        <div class="meta">
          จำนวนที่จอง: {{ $o->quantity }} ชิ้น<br>
          วันที่จอง: {{ $o->created_at->format('d/m/Y H:i') }}
        </div>
        <div class="details">
          รายละเอียด: {{ $o->souvenir->description ?? '-' }}<br>
          เหลือในสต็อก: {{ $o->souvenir->quantity_left ?? 0 }}
        </div>
      </div>

        <form method="POST" action="{{ route('souvenirs.destroy', $o->id) }}" onsubmit="return confirm('ยืนยันการยกเลิกการจองของที่ระลึกนี้หรือไม่?')">
          @csrf
          <button type="submit" class="btn-red">ยกเลิก</button>
          <div class="note1">1 การจอง = 1 ของที่ระลึก</div>
        </form>

      </div>
    </div>
  @endforeach
@endif

</body>
</html>
