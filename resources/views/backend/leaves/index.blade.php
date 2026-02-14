@extends("backend.layouts.master")

@section("content")
<div class="content-wrapper">
    <div class="content-header sty-one">
        <h1>Leave Requests</h1>
    </div>

    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="bg-blue text-white">
                            <tr>
                                <th>Employee</th>
                                <th>Type</th>
                                <th>Duration</th>
                                <th>Days</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leaves as $leave)
                            <tr>
                                <td>{{ $leave->user->name ?? 'Unknown' }}</td>
                                <td><span class="label label-info">{{ $leave->leave_type }}</span></td>
                                <td>{{ $leave->start_date }} to {{ $leave->end_date }}</td>
                                <td>
                                    {{-- Calculation: Total Days --}}
                                    {{ \Carbon\Carbon::parse($leave->start_date)->diffInDays(\Carbon\Carbon::parse($leave->end_date)) + 1 }}
                                </td>
                                <td>
                                    @if($leave->status == 0)
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($leave->status == 1)
                                        <span class="badge badge-success">Approved</span>
                                    @else
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($leave->status == 0)
                                    <form action="{{ route('admin.leaves.status', $leave->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="1">
                                        <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.leaves.status', $leave->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <input type="hidden" name="status" value="2">
                                        <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                    </form>
                                    @else
                                        <span class="text-muted small">Processed</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection