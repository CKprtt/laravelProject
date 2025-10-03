@extends('artist_nav')

@section('title', 'คำร้องของฉัน')

@section('content')
    <h2>ติดตามสถานะคำร้อง</h2>
    <table class="table table-bordered">
        <tr>
            <th>ชื่องาน</th>
            <th>วันที่เริ่ม</th>
            <th>วันที่สิ้นสุด</th>
            <th>ต้องการใช้โรงละคร</th>
            <th>รูปที่อัปโหลด</th>
            <th>สถานะ</th>
            <th>การจัดการ</th>
        </tr>
        @foreach ($requests as $r)
            <tr>
                <td>{{ $r->event_name }}</td>
                <td>{{ $r->start_date }}</td>
                <td>{{ $r->end_date }}</td>
                <td>{{ $r->type_hall === 'Yes' ? 'ใช้' : 'ไม่ใช้' }}</td>
                <td>
                    @if($r->poster_path)
                        <a href="{{ $r->poster_path }}" target="_blank">
                            <img src="{{ $r->poster_path }}" alt="poster" width="100">
                        </a>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $r->event_status }}</td>
                <td>
                    <form action="{{ route('artist.requests.destroy', $r->event_requests_id) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบคำร้องนี้?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">ลบ</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection