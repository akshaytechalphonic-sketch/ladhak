@extends('pms.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <!-- KPI Cards -->
    <div class="col-md-3">
        <div class="card card-hover border-0 shadow-soft h-100 p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-primary bg-opacity-10 p-2 me-3">
                    <i class="bi bi-briefcase text-primary fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0 small uppercase fw-bold" style="letter-spacing: 0.5px;">Active Projects</h6>
                    <h3 class="mb-0 fw-bold">12</h3>
                </div>
            </div>
            <div class="progress" style="height: 6px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-success mt-2 d-inline-block"><i class="bi bi-graph-up-arrow me-1"></i> +8% from last month</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover border-0 shadow-soft h-100 p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-success bg-opacity-10 p-2 me-3">
                    <i class="bi bi-check2-circle text-success fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0 small uppercase fw-bold" style="letter-spacing: 0.5px;">Completed Tasks</h6>
                    <h3 class="mb-0 fw-bold">128</h3>
                </div>
            </div>
            <div class="progress" style="height: 6px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-success mt-2 d-inline-block"><i class="bi bi-graph-up-arrow me-1"></i> +12% from last week</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover border-0 shadow-soft h-100 p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-warning bg-opacity-10 p-2 me-3">
                    <i class="bi bi-clock-history text-warning fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0 small uppercase fw-bold" style="letter-spacing: 0.5px;">Hours Tracked</h6>
                    <h3 class="mb-0 fw-bold">482h</h3>
                </div>
            </div>
            <div class="progress" style="height: 6px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-muted mt-2 d-inline-block">Avg 32h per team member</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover border-0 shadow-soft h-100 p-3">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3 bg-danger bg-opacity-10 p-2 me-3">
                    <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-0 small uppercase fw-bold" style="letter-spacing: 0.5px;">Overdue Tasks</h6>
                    <h3 class="mb-0 fw-bold">5</h3>
                </div>
            </div>
            <div class="progress" style="height: 6px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <small class="text-danger mt-2 d-inline-block"><i class="bi bi-arrow-down-right me-1"></i> -2 from yesterday</small>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Charts Section -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-soft p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0 text-body">Task Completion Overview</h5>
                <select class="form-select form-select-sm w-auto border-0 bg-light shadow-none">
                    <option>Last 30 Days</option>
                    <option>Last 6 Months</option>
                    <option>This Year</option>
                </select>
            </div>
            <canvas id="taskCompletionChart" height="300"></canvas>
        </div>

        <div class="card border-0 shadow-soft p-4">
            <h5 class="fw-bold mb-4 text-body">Recent Projects</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-muted small">
                            <th>Project Name</th>
                            <th>Status</th>
                            <th>Team</th>
                            <th>Progress</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-2 bg-primary p-2 me-3 text-white" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-window-stack"></i>
                                    </div>
                                    <span class="fw-bold">Website Redesign</span>
                                </div>
                            </td>
                            <td><span class="badge-soft badge-soft-primary">In Progress</span></td>
                            <td>
                                <div class="avatar-group">
                                    <img src="https://i.pravatar.cc/150?u=1" class="avatar avatar-sm rounded-circle" data-bs-toggle="tooltip" title="Alice">
                                    <img src="https://i.pravatar.cc/150?u=2" class="avatar avatar-sm rounded-circle" data-bs-toggle="tooltip" title="Bob">
                                    <span class="avatar avatar-sm rounded-circle bg-light d-flex align-items-center justify-content-center border-0 text-muted small fw-bold" style="margin-left: -10px;">+2</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar bg-primary" style="width: 65%"></div>
                                    </div>
                                    <small class="fw-bold">65%</small>
                                </div>
                            </td>
                            <td class="text-muted small">Oct 12, 2025</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-2 bg-success p-2 me-3 text-white" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-phone"></i>
                                    </div>
                                    <span class="fw-bold">Mobile App v2.0</span>
                                </div>
                            </td>
                            <td><span class="badge-soft badge-soft-success">Completed</span></td>
                            <td>
                                <div class="avatar-group">
                                    <img src="https://i.pravatar.cc/150?u=3" class="avatar avatar-sm rounded-circle" data-bs-toggle="tooltip" title="Charlie">
                                    <img src="https://i.pravatar.cc/150?u=4" class="avatar avatar-sm rounded-circle" data-bs-toggle="tooltip" title="David">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                    </div>
                                    <small class="fw-bold">100%</small>
                                </div>
                            </td>
                            <td class="text-muted small">Sep 28, 2025</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-2 bg-warning p-2 me-3 text-white" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-database"></i>
                                    </div>
                                    <span class="fw-bold">Cloud Migration</span>
                                </div>
                            </td>
                            <td><span class="badge-soft badge-soft-warning">Paused</span></td>
                            <td>
                                <div class="avatar-group">
                                    <img src="https://i.pravatar.cc/150?u=5" class="avatar avatar-sm rounded-circle" data-bs-toggle="tooltip" title="Eve">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 42%"></div>
                                    </div>
                                    <small class="fw-bold">42%</small>
                                </div>
                            </td>
                            <td class="text-muted small">Nov 05, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Sidebar (Activity & Timeline) -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-soft p-4 mb-4">
            <h5 class="fw-bold mb-4 text-body">Activity Feed</h5>
            <div class="timeline ps-3 border-start border-2 border-light" style="position: relative;">
                <!-- Timeline Items -->
                <div class="timeline-item mb-4" style="position: relative;">
                    <div class="bg-primary rounded-circle" style="width: 12px; height: 12px; position: absolute; left: -22px; top: 6px; border: 2px solid white;"></div>
                    <div class="ps-1">
                        <small class="text-muted d-block mb-1">Just now</small>
                        <p class="mb-0 fs-6 fw-medium"><strong>Alice</strong> added a new task to <span class="text-primary fw-bold">Design System</span></p>
                    </div>
                </div>
                <div class="timeline-item mb-4" style="position: relative;">
                    <div class="bg-success rounded-circle" style="width: 12px; height: 12px; position: absolute; left: -22px; top: 6px; border: 2px solid white;"></div>
                    <div class="ps-1">
                        <small class="text-muted d-block mb-1">2 hours ago</small>
                        <p class="mb-0 fs-6 fw-medium"><strong>Bob</strong> completed the <span class="text-success fw-bold">API Authentication</span> module</p>
                    </div>
                </div>
                <div class="timeline-item mb-4" style="position: relative;">
                    <div class="bg-warning rounded-circle" style="width: 12px; height: 12px; position: absolute; left: -22px; top: 6px; border: 2px solid white;"></div>
                    <div class="ps-1">
                        <small class="text-muted d-block mb-1">Yesterday</small>
                        <p class="mb-0 fs-6 fw-medium">Project <span class="text-warning fw-bold">Cloud Migration</span> status changed to Paused</p>
                    </div>
                </div>
                <div class="timeline-item" style="position: relative;">
                    <div class="bg-info rounded-circle" style="width: 12px; height: 12px; position: absolute; left: -22px; top: 6px; border: 2px solid white;"></div>
                    <div class="ps-1">
                        <small class="text-muted d-block mb-1">2 days ago</small>
                        <p class="mb-0 fs-6 fw-medium"><strong>Sys Admin</strong> added 3 new team members</p>
                    </div>
                </div>
            </div>
            <a href="#" class="btn btn-light w-100 rounded-pill mt-4 fw-bold">See All Activity</a>
        </div>

        <div class="card border-0 shadow-soft p-4 bg-primary text-white overflow-hidden" style="background: linear-gradient(135deg, var(--pms-primary), var(--pms-secondary)) !important;">
            <div style="position: relative; z-index: 2;">
                <h5 class="fw-bold mb-2">Upgrade to Pro</h5>
                <p class="small opacity-75 mb-4">Get unlimited projects, advanced charts and team collaboration tools.</p>
                <button class="btn btn-light rounded-pill px-4 fw-bold text-primary btn-sm">Upgrade Now</button>
            </div>
            <i class="bi bi-star-fill" style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.1; transform: rotate(-15deg);"></i>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('taskCompletionChart').getContext('2d');
    
    // Function to get theme colors
    const getColors = () => {
        const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        return {
            grid: isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)',
            text: isDark ? '#adb5bd' : '#8d99ae'
        };
    };

    let colors = getColors();

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Completed Tasks',
                data: [12, 19, 15, 25, 22, 30, 28],
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67, 97, 238, 0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#4361ee',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: colors.grid },
                    ticks: { color: colors.text, padding: 10 }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: colors.text, padding: 10 }
                }
            }
        }
    });

    // Handle theme change for chart
    document.addEventListener('themeChanged', function(e) {
        colors = getColors();
        chart.options.scales.y.grid.color = colors.grid;
        chart.options.scales.y.ticks.color = colors.text;
        chart.options.scales.x.ticks.color = colors.text;
        chart.update();
    });
});
</script>
@endpush
