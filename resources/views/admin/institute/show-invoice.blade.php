<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        .invoice-wrapper {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: #1565c0;
            color: #fff;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content {
            padding: 30px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .box {
            background: #f9fafc;
            padding: 15px;
            border-radius: 8px;
        }

        .box h4 {
            margin-bottom: 8px;
            color: #1565c0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background: #1565c0;
            color: #fff;
            padding: 10px;
        }

        table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .total {
            text-align: right;
            margin-top: 20px;
            font-size: 15px;
        }

        .footer {
            padding: 20px 30px;
            background: #f9fafc;
            display: flex;
            justify-content: space-between;
        }

        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .paid {
            background: #28a745;
            color: #fff;
        }

        .pending {
            background: #ffc107;
        }

        .print-btn {
            background: #1565c0;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="invoice-wrapper">

        <!-- HEADER -->
        <div class="header">

            <div>
                <h2>{{ $invoice->invoice_type }}</h2>
                <small>Invoice No: {{ $invoice->invoice_number }}</small><br>
                <small>Date: {{ $invoice->created_at->format('d M Y') }}</small>
            </div>

            @php
                $logo = $invoice->company_logo ?? $setting->company_logo ?? null;
            @endphp

            @if($logo)
                <img src="{{ asset('storage/' . $logo) }}" height="60">
            @endif

        </div>

        <!-- CONTENT -->
        <div class="content">

            <div class="grid">

                <!-- COMPANY -->
                <div class="box">
                    <h4>Company Details</h4>

                    <strong>{{ $invoice->company_name ?? $setting->company_name }}</strong><br>

                    {{ $invoice->company_address ?? $setting->company_address }}<br>

                    @if($setting->city || $setting->state || $setting->company_pincode)
                        {{ optional($setting->city)->name ?? ''}},
                        {{ optional($setting->state)->name ?? ''}}
                        - {{ $setting->company_pincode ?? '' }}<br>
                    @endif

                    @if($setting->company_phone)
                        Phone: {{ $setting->company_phone }}<br>
                    @endif

                    @if($invoice->company_gstin ?? $setting->company_gstin)
                        GSTIN: {{ $invoice->company_gstin ?? $setting->company_gstin }}
                    @endif
                </div>

                <!-- CUSTOMER -->
                <div class="box">
                    <h4>Billing Details</h4>

                    {{ $invoice->customer_name }}<br>

                    @if($invoice->customer_gstin)
                        GSTIN: {{ $invoice->customer_gstin }}<br>
                    @endif

                    {{ $invoice->billing_address }}
                    {{ $invoice->billing_email ?? ''}}
                </div>

            </div>

            <!-- PLAN -->
            <table>
                <thead>
                    <tr>
                        <th>Plan</th>
                        <th>Duration</th>
                        <th>Base Amount</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>{{ $invoice->payment->instituteplan->plan->name ?? '-' }}</td>

                        <td>
                            {{ optional($invoice->payment->instituteplan)->start_date?->format('d M Y') }}
                            -
                            {{ optional($invoice->payment->instituteplan)->expiry_date?->format('d M Y') }}
                        </td>

                        <td>₹{{ number_format($invoice->base_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- GST -->
            <div class="total">

                <div>Base: ₹{{ number_format($invoice->base_amount, 2) }}</div>

                @if($invoice->cgst > 0)
                    <div>CGST: ₹{{ number_format($invoice->cgst, 2) }}</div>
                    <div>SGST: ₹{{ number_format($invoice->sgst, 2) }}</div>
                @endif

                @if($invoice->igst > 0)
                    <div>IGST: ₹{{ number_format($invoice->igst, 2) }}</div>
                @endif

                <div style="margin-top:10px; font-size:18px;">
                    <strong>Total: ₹{{ number_format($invoice->total, 2) }}</strong>
                </div>

            </div>

            <!-- TERMS -->
            @if($invoice->terms_conditions)
                <div style="margin-top:30px;">
                    <h4>Terms & Conditions</h4>
                    {!! $invoice->terms_conditions !!}
                </div>
            @endif

        </div>

        <!-- FOOTER -->
        <div class="footer">

            <div>
                Method: {{ ucfirst($invoice->payment->method ?? 'Online') }}<br>
                Payment ID: {{ $invoice->payment->payment_id ?? '-' }}
            </div>

            <div>
                Status:
                <span class="badge {{ $invoice->payment->status == 'paid' ? 'paid' : 'pending' }}">
                    {{ ucfirst($invoice->payment->status) }}
                </span>
            </div>

            <button class="print-btn" onclick="window.print()">Print</button>

        </div>

    </div>

</body>

</html>