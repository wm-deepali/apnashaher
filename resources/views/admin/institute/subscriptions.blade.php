@include('admin.top-header')

@section('page_title', 'Subscriptions')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="card">
            <div class="card-body">

                <!-- FILTER -->
                <form method="GET" class="mb-4">

                    <div class="row">

                        <div class="col-md-2">
                            <label>Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">All</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Sub Category</label>
                            <select name="subcategory_id" class="form-control">
                                <option value="">All</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Subscription</label>
                            <select name="package_id" class="form-control">
                                <option value="">All</option>
                                @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}" {{ request('package_id') == $pkg->id ? 'selected' : '' }}>
                                        {{ $pkg->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">All</option>
                                <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Success
                                </option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label>From</label>
                            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                        </div>

                        <div class="col-md-2">
                            <label>To</label>
                            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search name, mobile, email" value="{{ request('search') }}">
                        </div>

                        <div class="col-md-4">
                            <button class="btn btn-primary">Apply</button>
                            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                        </div>

                    </div>

                </form>

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Institute</th>
                            <th>Plan</th>
                            <th>Cost</th>
                            <th>Taxes</th>
                            <th>Billed Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($payments as $payment)

                            <tr>

                                <td>{{ $payment->created_at->format('d M Y, h:i A') }}</td>

                                <td>
                                    {{ $payment->institute->name ?? '-' }} <br>
                                    <small>{{ $payment->institute->mobile ?? '-' }}</small>
                                </td>

                                <td>{{ $payment->instituteplan->plan->name ?? '-' }}</td>

                                <td>₹{{ number_format($payment->amount, 2) }}</td>

                                <td>
                                    @if($payment->cgst > 0)
                                        CGST: ₹{{ number_format($payment->cgst, 2) }}<br>
                                        SGST: ₹{{ number_format($payment->sgst, 2) }}
                                    @endif

                                    @if($payment->igst > 0)
                                        IGST: ₹{{ number_format($payment->igst, 2) }}
                                    @endif
                                </td>

                                <td><strong>₹{{ number_format($payment->total, 2) }}</strong></td>

                                <td>
                                    @if($payment->status == 'success')
                                        <span class="badge badge-success">Success</span>
                                    @else
                                        <span class="badge badge-danger">Failed</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('admin.order.detail', $payment->id) }}"
                                        class="btn btn-sm btn-info">Order</a>

                                    <a href="{{ route('admin.invoice.show', $payment->id) }}"
                                        class="btn btn-sm btn-primary">Invoice</a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

                <div class="mt-3 d-flex justify-content-end">
    {{ $payments->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

            </div>
        </div>

    </div>
</div>

@include('admin.footer')