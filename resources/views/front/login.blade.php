@extends('layouts.app')
@section('title', 'Login')
@push('styles')
<!-- ==================== FIXED & PREMIUM CSS ==================== -->
<style>
  .login-section {
    background: linear-gradient(135deg, #f0f7ff 0%, #e3f2fd 100%);
    padding: 40px 20px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .login-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(21, 101, 192, 0.15);
    padding: 50px 40px;
    max-width: 460px;
    width: 100%;
    border: 1px solid #bbdefb;
  }

  .login-title {
    font-size: 2.1rem;
    font-weight: 800;
    color: #0d1117;
    text-align: center;
    margin-bottom: 12px;
  }

  .login-subtitle {
    text-align: center;
    color: #555;
    font-size: 1.05rem;
    margin-bottom: 40px;
  }

  .form-group {
    margin-bottom: 24px;
  }

  .form-label {
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
    display: block;
    font-size: 0.98rem;
  }

  .phone-input-group {
    display: flex;
    gap: 12px;
    align-items: stretch;
  }

  .country-code {
    padding: 14px 12px;
    border: 1.5px solid #bbdefb;
    border-radius: 10px;
    font-size: 1rem;
    background: white;
    min-width: 90px;
    appearance: none;
  }

  .mobile-input {
    flex: 1;
    padding: 14px 16px;
    border: 1.5px solid #bbdefb;
    border-radius: 10px;
    font-size: 1rem;
  }

  .mobile-input:focus,
  .country-code:focus {
    border-color: #1565c0;
    outline: none;
    box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.12);
  }

  .btn-send-otp {
    width: 100%;
    background: #1565c0;
    color: white;
    border: none;
    padding: 16px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s;
  }

  .btn-send-otp:hover {
    background: #0d47a1;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(21, 101, 192, 0.3);
  }

  /* OTP Container */
  .otp-container {
    margin-top: 30px;
    animation: fadeIn 0.5s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .otp-inputs {
    display: flex;
    gap: 12px;
    justify-content: center;
    margin-bottom: 20px;
  }

  .otp-box {
    width: 50px;
    height: 50px;
    text-align: center;
    font-size: 1.8rem;
    font-weight: 700;
    border: 1.5px solid #bbdefb;
    border-radius: 12px;
    transition: border 0.2s, box-shadow 0.2s;
    background: #f8fbff;
  }

  .otp-box:focus {
    border-color: #1565c0;
    outline: none;
    box-shadow: 0 0 0 3px rgba(21, 101, 192, 0.12);
  }

  .resend-timer {
    text-align: center;
    font-size: 0.95rem;
    color: #555;
    margin: 16px 0;
  }

  #resendLink {
    color: #1565c0;
    font-weight: 600;
    cursor: pointer;
    text-decoration: underline;
  }

  .terms-checkbox {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin: 20px 0;
    font-size: 0.95rem;
    color: #444;
  }

  .terms-checkbox input {
    margin-top: 4px;
  }

  .terms-link {
    color: #1565c0;
    text-decoration: underline;
  }

  .btn-submit {
    width: 100%;
    background: linear-gradient(90deg, #1565c0, #42a5f5);
    color: white;
    border: none;
    padding: 16px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 12px;
  }

  .btn-submit:disabled {
    background: #ccc;
    cursor: not-allowed;
  }

  .btn-submit:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(21, 101, 192, 0.3);
  }

  .success-message {
    text-align: center;
    color: #2e7d32;
    font-size: 1.2rem;
    margin-top: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    animation: fadeIn 0.6s ease;
  }

  .success-icon {
    font-size: 2.5rem;
  }

  /* Responsive */
  @media (max-width: 480px) {
    .login-card {
      padding: 40px 24px;
    }
    .otp-box {
      width: 42px;
      height: 42px;
      font-size: 1.5rem;
    }
    .phone-input-group {
      /*flex-direction: column;*/
      gap: 12px;
    }
    .country-code {
      width: 100%;
    }
  }
  .notfound
  {
    color:red;
    display:none;
  }
</style>
@endpush
@section('content')
<!-- ==================== MOBILE OTP LOGIN CARD - FIXED & PREMIUM ==================== -->
<section class="login-section">
  <div class="login-card">
    <h2 class="login-title">Login / Sign Up</h2>
    <p class="login-subtitle">Enter your mobile number to receive OTP</p>

    <form class="login-form" id="otpLoginForm">
      <!-- Mobile Number -->
      <div class="form-group">
        <label class="form-label">Mobile Number *</label>
        <div class="phone-input-group">
          <select class="country-code" id="countryCode" required style="width: 25%;">
            <option value="+91">🇮🇳 +91</option>
          </select>
          <input 
            type="tel" 
            class="form-input mobile-input" 
            id="mobileNumber" 
            placeholder="Enter 10-digit number" 
            maxlength="10" 
            pattern="[0-9]{10}" 
            required
            autocomplete="tel"
          >
        </div>
      </div>
      <div class="form-group">
        <p class="notfound" id="mobileNotFoundMsg" style="display:none;">Mobile Number entered does not exist, Please <a style="color:#1565c0;" href="{{route('list-your-institute')}}">click here</a> to List your Institute</p>
      </div>

      <!-- Send OTP Button -->
      <button type="button" class="btn-send-otp" id="sendOtpBtn">
        Send OTP
      </button>

      <!-- OTP Input (hidden initially) -->
      <div class="otp-container" id="otpContainer" style="display: none;">
        <label class="form-label">Enter 6-digit OTP *</label>
        <div class="otp-inputs">
          <input type="text" class="otp-box" maxlength="1" pattern="[0-9]" required autofocus>
          <input type="text" class="otp-box" maxlength="1" pattern="[0-9]" required>
          <input type="text" class="otp-box" maxlength="1" pattern="[0-9]" required>
          <input type="text" class="otp-box" maxlength="1" pattern="[0-9]" required>
          <input type="text" class="otp-box" maxlength="1" pattern="[0-9]" required>
          <input type="text" class="otp-box" maxlength="1" pattern="[0-9]" required>
        </div>

        <!-- Resend Timer -->
        <div class="resend-timer">
          <span id="resendText">Resend OTP in <b id="countdown">60</b> seconds</span>
          <a href="#" id="resendLink" style="display:none;" onclick="resendOtp(); return false;">
            Resend OTP
          </a>
        </div>

        <!-- Terms & Conditions -->
        <div class="terms-checkbox">
          <input type="checkbox" id="agreeTerms" required>
          <label for="agreeTerms">
            I agree to the 
            <a href="{{url('legal-policies/terms-and-condition')}}" target="_blank" class="terms-link">Terms & Conditions</a> 
            and 
            <a href="{{url('legal-policies/privacy-policy')}}" target="_blank" class="terms-link">Privacy Policy</a>
          </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-submit" id="submitOtpBtn" >
          Verify & Login
        </button>
      </div>
    </form>

    <!-- Success Message -->
    <div class="success-message" id="successMsg" style="display:none;">
      <i class="fas fa-check-circle success-icon"></i>
      <p>Login Successful! Redirecting...</p>
    </div>
  </div>
</section>




@endsection
@push('after-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>       
<script>
  
const otpInputs = document.querySelectorAll('.otp-box');

// OTP auto-focus & paste handling (same as your code)
otpInputs.forEach((input, index) => {
  input.addEventListener('input', (e) => {
    if (e.target.value.length === 1 && index < otpInputs.length - 1) {
      otpInputs[index + 1].focus();
    }
    checkOtpComplete();
  });

  input.addEventListener('keydown', (e) => {
    if (e.key === 'Backspace' && e.target.value === '' && index > 0) {
      otpInputs[index - 1].focus();
    }
  });

  input.addEventListener('paste', (e) => {
    e.preventDefault();
    const pasteData = e.clipboardData.getData('text').trim();
    if (pasteData.length === 6 && /^\d+$/.test(pasteData)) {
      otpInputs.forEach((inp, i) => inp.value = pasteData[i] || '');
      checkOtpComplete();
    }
  });
});

function checkOtpComplete() {
  const otpFilled = Array.from(otpInputs).every(inp => inp.value.length === 1);
  const termsChecked = document.getElementById('agreeTerms').checked;

  document.getElementById('submitOtpBtn').disabled = !(otpFilled && termsChecked);
}

document.getElementById('agreeTerms').addEventListener('change', checkOtpComplete);

// ------------------- Send OTP -------------------
document.getElementById('sendOtpBtn')?.addEventListener('click', () => {
  const notFoundMsg = document.getElementById('mobileNotFoundMsg');
  notFoundMsg.style.display = 'none';

  const mobile = document.getElementById('mobileNumber').value.trim();
  if (mobile.length !== 10 || !/^\d+$/.test(mobile)) {
    toastr.error("Please enter a valid 10-digit mobile number");
    return;
  }
   let sendurl = "{{ url('/otp/send') }}";

    // Send fetch request
    fetch(sendurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json' // Important: tells Laravel to return JSON
        },
        body: JSON.stringify({ mobile })
    })
    .then(async res => {
        // Check if response is JSON
        const contentType = res.headers.get('content-type');
        if(contentType && contentType.includes('application/json')) {
            return res.json();
        } else {
            // If HTML is returned, log it for debugging
            const text = await res.text();
            console.error("Unexpected HTML response:", text);
            throw new Error("Server did not return JSON. Check route or middleware.");
        }
    })
    .then(data => {
        if(data.status === 'success'){
            toastr.success(data.message);
            document.getElementById('otpContainer').style.display = 'block';
            document.getElementById('sendOtpBtn').style.display = 'none';
            startResendTimer();
        } else if(data.status === 'not_found'){
            // Show the message if number not found
            notFoundMsg.style.display = 'block';
        }  else {
            toastr.error(data.message);
        }
    })
    .catch(err => {
        console.error("Error sending OTP:", err);
        toastr.error("Something went wrong while sending OTP. Please try again.");
    });

});

function resendOtp() {
    const mobile = document.getElementById('mobileNumber').value.trim();
    const notFoundMsg = document.getElementById('mobileNotFoundMsg');
    notFoundMsg.style.display = 'none'; // hide first

    if (mobile.length !== 10 || !/^\d+$/.test(mobile)) {
        toastr.error("Please enter a valid 10-digit mobile number");
        return;
    }

    let sendurl = "{{ url('/otp/send') }}";

    fetch(sendurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ mobile })
    })
    .then(async res => {
        const contentType = res.headers.get('content-type');
        if(contentType && contentType.includes('application/json')) {
            return res.json();
        } else {
            const text = await res.text();
            console.error("Unexpected HTML response:", text);
            throw new Error("Server did not return JSON. Check route or middleware.");
        }
    })
    .then(data => {
        if(data.status === 'success'){
            toastr.success("OTP resent successfully!");
            startResendTimer();
        } else if(data.status === 'not_found') {
            notFoundMsg.style.display = 'block';
        } else {
            toastr.error(data.message);
        }
    })
    .catch(err => {
        console.error("Error resending OTP:", err);
        toastr.error("Something went wrong while resending OTP.");
    });
}

// ------------------- Resend Timer -------------------
function startResendTimer() {
  let time = 60;
  const countdown = document.getElementById('countdown');
  const resendText = document.getElementById('resendText');
  const resendLink = document.getElementById('resendLink');

  resendText.style.display = 'inline';
  resendLink.style.display = 'none';

  const timer = setInterval(() => {
    time--;
    countdown.textContent = time;
    if (time <= 0) {
      clearInterval(timer);
      resendText.style.display = 'none';
      resendLink.style.display = 'inline';
    }
  }, 1000);
}

// ------------------- Verify OTP -------------------
document.getElementById('otpLoginForm')?.addEventListener('submit', (e) => {
  e.preventDefault();
  const mobile = document.getElementById('mobileNumber').value.trim();
  const otp = Array.from(document.querySelectorAll('.otp-box')).map(inp => inp.value).join('');
 let verifyurl = "{{ url('/otp/verify') }}";
  fetch(verifyurl, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({ mobile, otp })
  })
  .then(res => res.json())
  .then(data => {
    if(data.status === 'success'){
      document.getElementById('successMsg').style.display = 'flex';
      setTimeout(() => window.location.href = '{{url("institute/dashboard")}}', 1500); // redirect after 1.5s
    } else {
      toastr.error(data.message);
    }
  })
  .catch(err => console.error(err));
});
</script>
@endpush