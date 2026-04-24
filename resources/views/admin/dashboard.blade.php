@include('admin.top-header')

@section('page_title', 'Dashboard')

<style>
    body {
        background: #ffffff !important;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 18px;
        padding: 22px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        border: 1px solid #f1f5f9;
        margin-bottom: 25px;
    }

    .summary-card {
        border-left: 5px solid;
        min-height: 130px;
    }

    .summary-blue {
        border-color: #93c5fd;
        background: #eff6ff;
    }

    .summary-green {
        border-color: #86efac;
        background: #f0fdf4;
    }

    .summary-yellow {
        border-color: #fde68a;
        background: #fffbeb;
    }

    .summary-pink {
        border-color: #f9a8d4;
        background: #fdf2f8;
    }

    .summary-card h3 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .summary-card p {
        color: #64748b;
        font-size: 15px;
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 18px;
        color: #1e293b;
    }

    .chart-box {
        height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 16px;
        border: 2px dashed #e2e8f0;
        border-radius: 14px;
    }

    .table thead {
        background: #f8fafc;
    }

    .activity-item {
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }
</style>

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="breadcrumbs-top d-flex align-items-center bg-light mb-3">

            <div class="breadcrumb-wrapper">
                <ol class="breadcrumb bg-transparent mb-0">

                    <li class="breadcrumb-item">
                        <a href="{{ route('voyager.dashboard') }}">Dashboard</a>
                    </li>

                </ol>
            </div>

        </div>


        <div class="content-wrapper pb-4">


            <!-- Summary Cards -->
            <div class="row">

                <div class="col-md-3">
                    <div class="dashboard-card summary-card summary-blue">
                        <h3>{{$totalListings}}</h3>
                        <p>Total Listings</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card summary-card summary-green">
                        <h3>{{$freeListings}}</h3>
                        <p>Free Listing</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card summary-card summary-yellow">
                        <h3>{{$standardListings}}</h3>
                        <p>Standard Plan</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card summary-card summary-pink">
                        <h3>{{$premiumListings}}</h3>
                        <p>Premium Plan</p>
                    </div>
                </div>

            </div>

            <!-- Charts -->
            <div class="row">

                <div class="col-md-5">
                    <div class="dashboard-card">
                        <div class="section-title">Listing Distribution</div>
                        <div class="chart-box">
                            Pie Chart Here
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="dashboard-card">
                        <div class="section-title">
                            Revenue / Listing Analytics
                            <div style="float:right;">
                                <button class="btn btn-xs btn-default">7 Days</button>
                                <button class="btn btn-xs btn-default">15 Days</button>
                                <button class="btn btn-xs btn-default">Month</button>
                            </div>
                        </div>
                        <div class="chart-box">
                            Revenue Graph Here
                        </div>
                    </div>
                </div>

            </div>

            <!-- Recent Entries + Tickets -->
            <div class="row">

                <div class="col-md-8">
                    <div class="dashboard-card">
                        <div class="section-title">Recent Entries</div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Plan</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>ABC Institute</td>
                                    <td>Coaching</td>
                                    <td>Premium</td>
                                    <td>Today</td>
                                </tr>
                                <tr>
                                    <td>XYZ Traders</td>
                                    <td>Business</td>
                                    <td>Free</td>
                                    <td>Yesterday</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="dashboard-card">
                        <div class="section-title">Recent Tickets</div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Issue</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Listing Approval</td>
                                    <td>Open</td>
                                </tr>
                                <tr>
                                    <td>Payment Query</td>
                                    <td>Pending</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

            <!-- Recent Activities -->
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-card">
                        <div class="section-title">Recent Activities</div>

                        <div class="activity-item">New premium listing added</div>
                        <div class="activity-item">Package updated successfully</div>
                        <div class="activity-item">New institute registered</div>
                        <div class="activity-item">Support ticket received</div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

@include('admin.footer')