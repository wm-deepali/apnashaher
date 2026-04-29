@include('admin.top-header')

@section('page_title', 'Order Detail')

<div class="main-section">
    @include('admin.header')

    <div class="app-content content container-fluid">

        <div class="card">
            <div class="card-body">

                <h4 class="mb-4">Order Detail</h4>

                <div class="row">

                    <!-- CUSTOMER -->
                    <div class="col-md-6">
                        <div class="card p-3 mb-3">
                            <h5>Customer Info</h5>

                            <strong>{{ $payment->institute->name }}</strong>
                            {{ $payment->institute->mobile }}<br>
                            {{ $payment->institute->owner_email }}

                            {{ $payment->institute->city->name ?? '' }},
                            {{ $payment->institute->state->name ?? '' }}
                        </div>
                    </div>

                    <!-- PLAN -->
                    <div class="col-md-6">
                        <div class="card p-3 mb-3">
                            <h5>Subscription</h5>

                            Plan: {{ $payment->instituteplan->plan->name ?? '-' }}<br>

                            Start:
                            {{ optional($payment->instituteplan)->start_date?->format('d M Y') }}<br>

                            Expiry:
                            {{ optional($payment->instituteplan)->expiry_date?->format('d M Y') }}
                        </div>
                    </div>

                </div>

                <!-- PAYMENT INFO -->
                <div class="card p-3 mb-3">
                    <h5>Payment Detail</h5>

                    Order ID: {{ $payment->order_id }} <br>
                    Payment ID: {{ $payment->payment_id ?? '-' }} <br>
                    Method: {{ ucfirst($payment->method ?? '-') }} <br>

                    Status:
                    @if($payment->status == 'success')
                        <span class="badge badge-success">Success</span>
                    @else
                        <span class="badge badge-danger">Failed</span>
                    @endif
                </div>

                <!-- INVOICE INFO -->
                @if($invoice)
                    <div class="card p-3 mb-3">
                        <h5>Invoice Info</h5>

                        Invoice No: {{ $invoice->invoice_number }} <br>
                        Type: {{ $invoice->invoice_type }}
                    </div>
                @endif

                <!-- PRICE -->
                <div class="card p-3">

                    <h5>Amount Breakdown</h5>

                    <table class="table">

                        <tr>
                            <td>Base Amount</td>
                            <td>₹{{ number_format($payment->amount, 2) }}</td>
                        </tr>

                        @if($payment->cgst > 0)
                            <tr>
                                <td>CGST</td>
                                <td>₹{{ number_format($payment->cgst, 2) }}</td>
                            </tr>

                            <tr>
                                <td>SGST</td>
                                <td>₹{{ number_format($payment->sgst, 2) }}</td>
                            </tr>
                        @endif

                        @if($payment->igst > 0)
                            <tr>
                                <td>IGST</td>
                                <td>₹{{ number_format($payment->igst, 2) }}</td>
                            </tr>
                        @endif

                        <tr>
                            <th>Total</th>
                            <th>₹{{ number_format($payment->total, 2) }}</th>
                        </tr>

                    </table>

                </div>

                <!-- ACTION -->
                <div class="mt-3">

                    @if($invoice)
                        <a href="{{ route('admin.invoice.show', $payment->id) }}" class="btn btn-primary">
                            View Invoice
                        </a>
                    @endif

                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        Back
                    </a>

                </div>

            </div>
        </div>

    </div>
</div>

@include('admin.footer')