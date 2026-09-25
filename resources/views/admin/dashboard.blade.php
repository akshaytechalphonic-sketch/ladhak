@extends('admin.layouts.app')

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
    <div>
        <h2 class="fw-bold mb-1">Welcome back, Admin!</h2>
        <p class="text-muted mb-0">Here's what's happening in your hotel system today.</p>
    </div>
    <!--<div class="d-flex gap-2">-->
    <!--    <button class="btn btn-light rounded-pill px-4 shadow-soft border-0 fw-bold">Download Report</button>-->
    <!--    <button class="btn btn-primary btn-modern rounded-pill px-4 shadow-sm fw-bold">New Booking</button>-->
    <!--</div>-->
</div>

<!-- KPI Stats -->
<div class="row g-4 mb-5">
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-soft h-100 bg-glass p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-primary bg-opacity-10 p-2 text-primary me-3">
                    <i class="bi bi-buildings fs-4"></i>
                </div>
                <h6 class="text-muted mb-0 small fw-bold">Total Hotels</h6>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h3 class="fw-bold mb-0">{{ $stats['total_hotels'] }}</h3>
                <span class="text-success small fw-bold"><i class="bi bi-arrow-up me-1"></i> 12%</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-soft h-100 bg-glass p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-success bg-opacity-10 p-2 text-success me-3">
                    <i class="bi bi-calendar-check fs-4"></i>
                </div>
                <h6 class="text-muted mb-0 small fw-bold">Bookings</h6>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h3 class="fw-bold mb-0">{{ $stats['total_bookings'] }}</h3>
                <span class="text-success small fw-bold"><i class="bi bi-arrow-up me-1"></i> 5%</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-soft h-100 bg-glass p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-warning bg-opacity-10 p-2 text-warning me-3">
                    <i class="bi bi-hourglass-split fs-4"></i>
                </div>
                <h6 class="text-muted mb-0 small fw-bold">Pending</h6>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h3 class="fw-bold mb-0">{{ $stats['pending_bookings'] }}</h3>
                <span class="text-danger small fw-bold"><i class="bi bi-exclamation-circle me-1"></i> Attention</span>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-soft h-100 bg-glass p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-info bg-opacity-10 p-2 text-info me-3">
                   <i class="bi bi-currency-rupee fs-4"></i>
                </div>
                <h6 class="text-muted mb-0 small fw-bold">Revenue</h6>
            </div>
            <div class="d-flex align-items-end justify-content-between">
                <h3 class="fw-bold mb-0">₹{{ number_format($stats['total_revenue'], 2) }}</h3>
                <span class="text-muted small">Total</span>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Activity Timeline (Sharing the look from PMS Dashboard) -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-soft p-4 bg-glass h-100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-body">Recent System Activity</h5>
                
            </div>
            <div class="timeline ps-3 border-start border-2 border-light position-relative">
                @forelse($recentActivities as $activity)
                    @if($activity->activity_type === 'booking')
                        <div class="timeline-item {{ $loop->last ? '' : 'mb-4' }} position-relative">
                            <div class="bg-primary rounded-circle position-absolute" style="width: 12px; height: 12px; left: -22px; top: 6px; border: 2px solid white;"></div>
                            <div class="ps-1">
                                <small class="text-muted d-block mb-1">{{ $activity->created_at->diffForHumans() }}</small>
                                <p class="mb-0 fs-6 fw-medium"><strong>{{ $activity->name }}</strong> booked <strong>{{ $activity->room->room_type ?? 'a room' }}</strong> at {{ $activity->room->hotel->name ?? 'our hotel' }}.</p>
                                <small class="text-primary fw-bold">New Booking</small>
                            </div>
                        </div>
                    @elseif($activity->activity_type === 'enquiry')
                        <div class="timeline-item {{ $loop->last ? '' : 'mb-4' }} position-relative">
                            <div class="bg-warning rounded-circle position-absolute" style="width: 12px; height: 12px; left: -22px; top: 6px; border: 2px solid white;"></div>
                            <div class="ps-1">
                                <small class="text-muted d-block mb-1">{{ $activity->created_at->diffForHumans() }}</small>
                                <p class="mb-0 fs-6 fw-medium">New enquiry received from <strong>{{ $activity->name }}</strong>.</p>
                                <small class="text-warning fw-bold">Customer Enquiry</small>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="text-muted small">No recent activity found.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions / Users -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-soft p-4 bg-glass mb-4">
            <h6 class="fw-bold mb-4">System Overview</h6>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-2 rounded me-3 text-muted"><i class="bi bi-people"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold small">Total Users</h6>
                            <small class="text-muted">{{ $stats['total_users'] }} members</small>
                        </div>
                    </div>
                    <span class="badge-soft badge-soft-primary rounded-pill small px-2">+2 today</span>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="bg-light p-2 rounded me-3 text-muted"><i class="bi bi-chat-left-dots"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold small">Enquiries</h6>
                            <small class="text-muted">{{ $stats['total_enquiries'] }} pending</small>
                        </div>
                    </div>
                    <i class="bi bi-chevron-right text-muted small"></i>
                </div>
            </div>
            <!--<button class="btn btn-light w-100 rounded-pill mt-4 fw-bold shadow-none border-0 text-primary small">Full Stats Report</button>-->
        </div>

      
    </div>
</div>
@endsection
