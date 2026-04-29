<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Admin\CustomDashboardController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\ManageInstituteController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\JobOpeningController;
use App\Http\Controllers\DocumentController;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Admin\JobApplicationController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\UploadDocumentController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\InstitutePlanController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OtpLoginController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ReviewController;





Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('about-us', [FrontController::class, 'aboutus'])->name('about-us');
Route::get('advertise-with-us', [FrontController::class, 'advertiseWithUs'])->name('advertise-with-us');
Route::get('blogs', [FrontController::class, 'blogs'])->name('blogs');
Route::get('institute-benifit', [FrontController::class, 'instituteBenifit'])->name('institute-benifit');
Route::get('terms-conditions', [FrontController::class, 'termsCondition'])->name('terms-conditions');
Route::get('why-us', [FrontController::class, 'whyus'])->name('why-us');

Route::get('blog/{slug}', [FrontController::class, 'blogDetails'])->name('blog-details');

Route::get('faqs', [FrontController::class, 'faqs'])->name('faqs');
Route::get('plans', [FrontController::class, 'plans'])->name('plans');
Route::post('/upgrade-plan', [InstitutePlanController::class, 'upgradePlan']);

Route::get('contact-us', [ContactController::class, 'index'])->name('contact-us');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('seller-supports', [FrontController::class, 'sellerSupports'])->name('seller-supports');

Route::get('/career', [FrontController::class, 'jobOpenings'])->name('career');

Route::get('job-opening-details/{slug}', [FrontController::class, 'jobOpeningDetails'])
    ->name('job-opening-details');

// OTP
Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send-otp');
Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('verify-otp');


Route::get('/institutes/check-mobile', function (Illuminate\Http\Request $request) {
    return \App\Models\Institute::where('mobile', $request->mobile)->exists();
});

Route::get('/institutes/check-whatsapp', function (Illuminate\Http\Request $request) {
    $exists = \App\Models\Institute::where('whatsapp', $request->whatsapp)->exists();
    return response()->json($exists ? 1 : 0);
});


// Step forms
Route::post('/step1-save', [InstituteController::class, 'step1'])->name('step1-save');
Route::post('/step2-save', [InstituteController::class, 'step2'])->name('step2-save');
Route::post('/step3-save', [InstitutePlanController::class, 'save'])->name('step3-save');
Route::post('/step4-save', [InstituteController::class, 'step4'])->name('step4-save');

// Payment
Route::post('/create-payment', [PaymentController::class, 'create'])->name('create-payment');
Route::match(['get', 'post'], '/cashfree-callback', [PaymentController::class, 'callback'])->name('cashfree-callback');

Route::get('/get-states/{country_id}', [LocationController::class, 'getStates']);
Route::get('/get-cities/{state_id}', [LocationController::class, 'getCities']);
Route::get('/get-subcategories/{category_id}', [LocationController::class, 'getSubcategory']);

Route::get('/list-your-institute', [FrontController::class, 'listyourinstitute'])->name('list-your-institute');
Route::get('/get-course/{course_id}', [FrontController::class, 'getcourseById'])->name('get-course-by-id');

Route::get('/thank-you', function () {
    if (!session('payment_success')) {
        return redirect('/');
    }
    return view('front.thank-you');
})->name('thank-you');

Route::get('/free-plan-complete', [PaymentController::class, 'freePlanComplete'])->name('free-plan-complete');

Route::post('review/send-otp', [ReviewController::class, 'sendOtp'])->name('review.send-otp');
Route::post('review/verify-otp', [ReviewController::class, 'verifyOtp'])->name('review.verify-otp');
Route::post('review/submit-review', [ReviewController::class, 'submitReview'])->name('review.submit-review');
Route::post('enquiry/send-otp', [ReviewController::class, 'sendOtpEnquiry'])->name('enquiry.send.otp');
Route::post('enquiry/verify-otp', [ReviewController::class, 'verifyOtpEnquiry'])->name('enquiry.verify.otp');
Route::post('admission-enquiry', [ReviewController::class, 'submitEnquiry'])->name('admission.enquiry.submit');
Route::post('/track-call-click', [ReviewController::class, 'trackCall'])
    ->name('track.call');
Route::post('/track-whatsapp-click', [ReviewController::class, 'trackWhatsapp'])
    ->name('track.whatsapp');

Route::get('/login', function () {
    return view('front.login');
})->name('login');

Route::middleware(['auth:institute'])->group(function () {
    Route::get('/institute/profile', [InstituteController::class, 'profile'])->name('institute.profile');
    Route::get('/institute/dashboard', [InstituteController::class, 'dashboard'])->name('institute.dashboard');
    Route::get('institute/check-slug', [InstituteController::class, 'checkSlug'])->name('institute.check-slug');
    Route::post('institute/save-slug', [InstituteController::class, 'saveSlug'])->name('institute.save-slug');
    Route::post('institute/update-profile/{id}', [InstituteController::class, 'updateProfile'])->name('institute.update-profile');
    Route::post('institute/social-update/{id}', [InstituteController::class, 'socialUpdate'])->name('institute.social-update');
    Route::post('/institute/{institute_id}/timings/update', [InstituteController::class, 'updateTimings'])
        ->name('institute.timings.update');
    Route::post('/institute/profile/save', [InstituteController::class, 'saveProfile']);
    Route::post('/institute/courses/save', [InstituteController::class, 'saveCourses']);
    Route::post('/institute/timing/save', [InstituteController::class, 'saveTiming']);

    Route::post('/institute/save-courses', [InstituteController::class, 'addNewCourse'])
        ->name('institute.courses.save');

    Route::get('/institute/{id}/edit-courses', [InstituteController::class, 'editCourse'])
        ->name('institute.courses.edit');

    Route::post('/institute/update-courses', [InstituteController::class, 'updateCourses'])
        ->name('institute.courses.update');

    Route::delete('institute/courses/{id}', [InstituteController::class, 'destroyCourses'])
        ->name('institute.courses.destroy');

    Route::post('institute/gallery/upload', [InstituteController::class, 'storegallery'])->name('gallery.storegallery');
    Route::delete('institute/gallery/{id}', [InstituteController::class, 'destroyGallery'])->name('gallery.delete');

    Route::post('/institute/banners', [InstituteController::class, 'storeBanners'])->name('institute.banners.store');
    Route::delete('/institute/banners/{id}', [InstituteController::class, 'destroyBanners'])->name('institute.banners.destroy');

    // Send verification email
    Route::post('/institute/email/verification-notification', function (Request $request) {
        $request->user('institute')->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent to your email!');
    })->name('institute.verification.send')->middleware('throttle:6,1');

    // Click verification link
    Route::get('/institute/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('institute.dashboard')->with('verified', true);
    })->middleware(['auth:institute', 'signed'])->name('institute.verification.verify');

    Route::post('request-update/send-otp', [InstituteController::class, 'sendOtpRequest'])->name('request-update.send-otp');
    Route::post('request-update/verify-update', [InstituteController::class, 'verifyAndUpdate'])->name('request-update.verify-update');
    Route::post('/notifications/{id}/read', [InstituteController::class, 'markAsRead'])
        ->name('notifications.read');

    Route::post('/institute/logout', [OtpLoginController::class, 'logout'])->name('institute.logout');
});

Route::post('/otp/send', [OtpLoginController::class, 'sendOtp'])->name('otp.send');
Route::post('/otp/verify', [OtpLoginController::class, 'verifyOtp'])->name('otp.verify');
Route::get('legal-policies/{slug}', [FrontController::class, 'page'])
    ->name('page.show');



/*
|--------------------------------------------------------------------------
| Admin Custom Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {

    Route::get('profile-setting', [CustomDashboardController::class, 'profileSetting'])
        ->name('admin.profile.setting');

    Route::post('profile-setting', [CustomDashboardController::class, 'updateProfileSetting'])
        ->name('admin.profile.setting.update');

    Route::get('dashboard', [CustomDashboardController::class, 'index'])
        ->name('voyager.dashboard');

    Route::resource('manage-categories', CategoryController::class)
        ->names('admin.manage-categories');

    Route::resource('manage-states', StateController::class)
        ->names('admin.manage-states');

    Route::resource('manage-cities', CityController::class)
        ->names('admin.manage-cities');

    Route::resource('manage-packages', PackageController::class)
        ->names('admin.manage-packages');

    Route::get('manage-packages/features/{id}', [PackageController::class, 'getPackageFeatures']);

    Route::resource('manage-page', PageController::class)
        ->names('admin.manage-page');

    Route::resource('manage-blog', BlogController::class)
        ->names('admin.manage-blog');

    Route::resource('manage-faq', FaqController::class)
        ->names('admin.manage-faq');

    Route::resource('manage-institute', ManageInstituteController::class)
        ->names('admin.manage-institute');
    Route::post('/upgrade-plan', [ManageInstituteController::class, 'adminUpgradePlan']);

    Route::get('/invoice/{id}', [ManageInstituteController::class, 'showInvoice'])
        ->name('admin.invoice.show');

    Route::post(
        'manage-institute/{id}/approve',
        [ManageInstituteController::class, 'approve']
    )
        ->name('admin.manage-institute.approve');

    Route::post(
        'manage-institute/{id}/approve-review',
        [ManageInstituteController::class, 'approveReview']
    )
        ->name('admin.manage-institute.approve-review');

    Route::post('manage-institute/course/store', [ManageInstituteController::class, 'storeCourse'])->name('admin.manage-institute.course.store');
    Route::get('manage-institute/course/{id}/edit', [ManageInstituteController::class, 'editCourse'])->name('admin.manage-institute.course.edit');
    Route::post('manage-institute/course/update/{id}', [ManageInstituteController::class, 'updateCourse'])->name('admin.manage-institute.course.update');
    Route::delete('manage-institute/course/{id}', [ManageInstituteController::class, 'coursedestroy'])->name('admin.manage-institute.course.destroy');

    Route::post('manage-institute/gallery/store', [ManageInstituteController::class, 'storeGallery'])->name('admin.manage-institute.gallery.store');
    Route::delete('manage-institute/gallery/{id}', [ManageInstituteController::class, 'destroyGallery'])->name('admin.manage-institute.gallery.destroy');

    Route::post('manage-institute/banner/store', [ManageInstituteController::class, 'storeBanner'])->name('admin.manage-institute.banner.store');
    Route::delete('manage-institute/banner/{id}', [ManageInstituteController::class, 'destroyBanner'])->name('admin.manage-institute.banner.destroy');

    Route::post('manage-institute/timings/update', [ManageInstituteController::class, 'updateTimings'])->name('admin.manage-institute.timings.update');

    Route::delete('manage-institute/review/{id}', [ManageInstituteController::class, 'destroyReview'])->name('admin.manage-institute.review.destroy');
    Route::delete('manage-institute/lead/{id}', [ManageInstituteController::class, 'destroyLead'])->name('admin.manage-institute.lead.destroy');

    Route::get('manage-institute/create', [ManageInstituteController::class, 'createFullForm'])->name('admin.institutes-full.create');
    Route::post('manage-institute', [ManageInstituteController::class, 'storeFullForm'])->name('admin.institutes-full.store');

    Route::get('/institutes-full/{id}/edit', [ManageInstituteController::class, 'edit'])->name('admin.institutes-full.edit');
    Route::put('/institutes-full/{id}', [ManageInstituteController::class, 'update'])->name('admin.institutes-full.update');

    Route::get('get-cities/{state}', [ManageInstituteController::class, 'getCities']);
    Route::get('get-subcategories/{category}', [ManageInstituteController::class, 'getSubcategories']);
    Route::get('/institutes/check-mobile', function (Illuminate\Http\Request $request) {
        return \App\Models\Institute::where('mobile', $request->mobile)->exists();
    });

    Route::get('/institutes/check-whatsapp', function (Illuminate\Http\Request $request) {
        $exists = \App\Models\Institute::where('whatsapp', $request->whatsapp)->exists();
        return response()->json($exists ? 1 : 0);
    });
    Route::get('/get-institute-profile/{id}', [ManageInstituteController::class, 'getProfileData']);
    Route::post('/update-institute-profile', [ManageInstituteController::class, 'updateProfile'])
        ->name('admin.institute.profile.update');
    Route::resource('manage-jobs', JobOpeningController::class)->names('admin.manage-jobs');



});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});




// Home Page filtered by city
Route::get('/educational-institute-in-{city}', [FrontController::class, 'home'])->name('home.city');

// Explore Institutes page (no category/city)
Route::get('/explore-institutes', [FrontController::class, 'explore'])
    ->name('listing.explore');

Route::get('/explore-institutes-in-{city}', [FrontController::class, 'explore'])->name('listing.explore.city');

Route::get('{category}-institutes', [FrontController::class, 'listing'])
    ->where([
        'category' => '[a-z0-9\-]+'
    ])
    ->name('listing');

Route::get('{category}-institutes-in-{city}', [FrontController::class, 'listing'])
    ->where([
        'category' => '[a-z0-9\-]+',
        'city' => '[a-z0-9\-]+'
    ])
    ->name('listing.city');


Route::get('/{slug}', [FrontController::class, 'details'])
    ->where('slug', '^(?!.*-institutes)(?!legal-policies$)[a-z0-9\-]+$')
    ->name('details.show');


