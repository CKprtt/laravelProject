@extends('admin_nav')

@section('title', 'จัดการคำร้อง(Admin)')

@section('content')
    <h2>จัดการคำร้องขอจัดนิทรรศการ</h2>
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
                        <img src="{{ $r->poster_path }}" alt="poster" width="100">
                    @else
                    @endif
                </td>
                <td>{{ $r->event_status }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.requests.approve', $r->event_requests_id) }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-success">อนุมัติ</button>
                    </form>
                    <form method="POST" action="{{ route('admin.requests.reject', $r->event_requests_id) }}" style="display:inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">ปฏิเสธ</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

