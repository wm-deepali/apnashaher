@extends('layouts.app')
@section('title', 'Packages')
@push('styles')
<style>
  .thank-you-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0f7ff 0%, #e3f2fd 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
  }

  .thank-you-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(21, 101, 192, 0.15);
    overflow: hidden;
    max-width: 580px;
    width: 100%;
    border: 1px solid #bbdefb;
  }

  .success-header {
    background: linear-gradient(90deg, #1565c0, #42a5f5);
    padding: 30px 30px;
    text-align: center;
    color: white;
  }

  .celebration-emoji {
    font-size: 5rem;
    margin-bottom: 20px;
  }

  .success-title {
    font-size: 2.4rem;
    font-weight: 800;
    margin-bottom: 16px;
    line-height: 1.2;
  }

  .success-message {
    font-size: 1.15rem;
    opacity: 0.95;
    line-height: 1.5;
  }

  .success-details {
    padding: 30px;
    background: #f8fbff;
  }

  .detail-row {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
  }

  .detail-item {
    flex: 1;
    background: white;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e3f2fd;
    text-align: center;
  }

  .detail-label {
    display: block;
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 8px;
  }

  .detail-value {
    font-size: 1.6rem;
    font-weight: 700;
    color: #1565c0;
  }

  .detail-value.success {
    color: #2e7d32;
  }

  .action-buttons {
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 0 30px 30px;
  }

  .btn-primary,
  .btn-secondary {
    display: block;
    padding: 16px;
    font-size: 1.15rem;
    font-weight: 600;
    text-align: center;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s ease;
  }

  .btn-primary {
    background: #1565c0;
    color: white;
  }

  .btn-primary:hover {
    background: #0d47a1;
    transform: translateY(-2px);
  }

  .btn-secondary {
    background: white;
    color: #1565c0;
    border: 2px solid #1565c0;
  }

  .btn-secondary:hover {
    background: #f0f7ff;
    transform: translateY(-2px);
  }

  .small-note {
    text-align: center;
    font-size: 0.95rem;
    color: #666;
    padding: 0 30px 40px;
    line-height: 1.6;
  }

  /* Responsive */
  @media (max-width: 640px) {
    .detail-row {
      flex-direction: column;
      gap: 16px;
    }
    .success-title {
      font-size: 2rem;
    }
    .small-note {
    text-align: center;
    font-size: 0.95rem;
    color: #666;
    padding: 0 20px 26px;
    line-height: 1.6;
}
  }
</style>
@endpush
@section('content')
<!-- ==================== THANK YOU SUCCESS CARD ==================== -->
<section class="thank-you-section">
  <div class="thank-you-card">
    <div class="success-header">
      <div class="celebration-emoji">🎉</div>
      <h1 class="success-title">Your Institute Profile Has Been Created!</h1>
      <p class="success-message">
        It is currently visible to you.<br>
        Our team reviews listings before making them public.
      </p> <p>Approval usually takes 24 - 48 hours</p>
    </div>

    <div class="success-details">
      <div class="detail-row">
        <div class="detail-item">
          <span class="detail-label">Listing ID</span>
          <span class="detail-value">#{{ session('listing_id') }}</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">Order ID</span>
          <span class="detail-value">#{{ session('order_id') }}</span>
        </div>
      </div>

      <div class="detail-row">
        <div class="detail-item">
          <span class="detail-label">Payment Method</span>
          <span class="detail-value">{{ session('payment_method') }}</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">Payment Status</span>
          @if(session('payment_status') != 'N/A')
          <span class="detail-value success">
            {{ session('payment_status') }} <i class="fas fa-check-circle"></i>
          </span>
          @else
            <span class="detail-value">
            {{ session('payment_status') }}
          </span>
          @endif
        </div>
      </div>
    </div>

    <div class="action-buttons">
      <a href="{{route('institute.dashboard')}}" class="btn-primary">View Your Listing</a>
      <a href="{{route('institute.profile')}}" class="btn-secondary">Complete Profile</a>
    </div>

    <p class="small-note">
      You will receive an email confirmation shortly.<br>
      Thank you for choosing <span style="color:blue;">ApnaShaher!</span>
    </p>
  </div>
</section>

<!-- ==================== CUSTOM CSS (ONLY CLASSES) ==================== -->
@endsection