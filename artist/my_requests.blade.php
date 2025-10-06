@extends('artist_nav')

@section('title', 'คำร้องของฉัน')

@section('content')
    {{-- ตารางติดตามสถานะคำร้องขอจัดนิทรรศการ --}}
    <h2>ติดตามสถานะขอจัดนิทรรศการ</h2>
    <table class="table table-bordered text-center align-middle">
        <thead class="table-secondary">
            <tr>
                <th>ชื่องาน</th>
                <th>วันที่เริ่ม</th>
                <th>วันที่สิ้นสุด</th>
                <th>ต้องการใช้โรงละคร</th>
                <th>รูปที่อัปโหลด</th>
                <th>รายละเอียด</th>
                <th>สถานะ</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requests as $r)
                <tr>
                    <td>{{ $r->event_name }}</td>
                    <td>{{ $r->start_date }}</td>
                    <td>{{ $r->end_date }}</td>
                    <td>{{ $r->type_hall === 'Yes' ? 'ใช้' : 'ไม่ใช้' }}</td>
                    <td>
                        @if ($r->poster_path)
                            <a href="{{ $r->poster_path }}" target="_blank">
                                <img src="{{ $r->poster_path }}" alt="poster" width="100" class="rounded shadow-sm">
                            </a>
                        @endif
                    </td>
                    <td>{{ $r->proposal }}</td>
                    <td>
                        @if ($r->event_status === 'approved')
                            <span class="badge bg-success">อนุมัติแล้ว</span>
                        @elseif ($r->event_status === 'rejected')
                            <span class="badge bg-danger">ไม่อนุมัติ</span>
                        @else
                            <span class="badge bg-warning text-dark">รอดำเนินการ</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            {{-- ปุ่มแก้ไข --}}
                            @if ($r->event_status === 'approved')
                                <button class="btn btn-secondary btn-sm" disabled>แก้ไข</button>
                            @else
                                <a href="{{ route('artist.editRequest', $r->event_requests_id) }}"
                                   class="btn btn-warning btn-sm">แก้ไข</a>
                            @endif

                            {{-- ปุ่มลบ --}}
                            <form action="{{ route('artist.destroyRequest', $r->event_requests_id) }}" method="POST"
                                  onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบคำร้องนี้?')">
                                @csrf
                                @method('DELETE')
                                @if ($r->event_status === 'approved')
                                    <button class="btn btn-secondary btn-sm" disabled>ลบ</button>
                                @else
                                    <button type="submit" class="btn btn-danger btn-sm">ลบ</button>
                                @endif
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection