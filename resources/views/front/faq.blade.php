@extends('layouts.app')
@section('title', 'FAQs')

@section('content')
<style>
    .faq-container {
    width: 60%;
    max-width: 1200px;
    margin: auto;
    display: grid;
    grid-template-columns: 1fr !important;
    gap: 40px;
}
@media (max-width: 768px) {
    .faq-container {
        width: 95%;
        max-width: 1200px;
        margin: auto;
        display: grid;
        grid-template-columns: 1fr !important;
        gap: 40px;
    }
    .faq-section {
    background: #f4f8f4;
    padding: 0px 0;
    margin-top: 20px;
}
}
  </style>
<section class="faq-section">
    <div class="faq-container">
        <!-- LEFT SIDE FAQ -->
        <div class="faq-left">
            <h2 class="faq-title">Frequently Asked Questions</h2>
            <div class="faq-box">

 @foreach($faqs as $faq)

                <div class="faq-item">
                    <div class="faq-question-row">
                        <h3 class="faq-question">{{ $faq->question }}</h3>
                        <span class="faq-icon">+</span>
                    </div>

                    <div class="faq-answer">
                        {!! $faq->answer !!}
                    </div>
                </div>

                @endforeach
                
            
            

            </div>
        </div>

       
        
    </div>
</section>
@endsection