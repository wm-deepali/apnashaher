<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\VerifyInstituteEmail;
use Carbon\Carbon;

class Institute extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'name',
        'slug',
        'country',
        'listing_id',
        'state_id',
        'city_id',
        'mobile',
        'login_otp',
        'login_otp_sent_at',
        'mobile_verified',
        'owner_name',
        'designation',
        'owner_email',
        'established_year',
        'detailed_information',
        'website',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'twitter_url',
        'category_id',
        'subcategory_id',
        'description',
        'whatsapp',
        'gst_invoice',
        'gstin',
        'business_name',
        'profile_address',
        'billing_address',
        'invoice_email',
        'registration_complete',
        'approved_by',
        'approved_date',
        'profile_completed',
        'registration_number',
        'zipcode',
        'logo',
        'linkedin_url',
        'google_url',
        'rating',
        'views',
        'total_clicks',
        'total_calls',
        'whatsApp_connect',
        'status'
    ];

    protected $casts = [
        'mobile_verified' => 'boolean',
        'gst_invoice' => 'boolean',
    ];
    protected $dates = ['login_otp_sent_at']; // Carbon timestamps

    // Relationships
    public function plans()
    {
        return $this->hasMany(InstitutePlan::class);
    }
    public function latestPlan()
    {
        return $this->hasOne(InstitutePlan::class)->where('plan_status', 'completed')->latestOfMany();
    }
    public function activePlan()
    {
        return $this->hasOne(InstitutePlan::class)
            ->where('plan_status', 'completed')
            ->where('expiry_date', '>=', Carbon::now())
            ->latestOfMany();
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function leads()
    {
        return $this->hasMany(Enquiry::class);
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function timings()
    {
        return $this->hasMany(InstituteTiming::class);
    }
    public function reviews()
    {
        return $this->hasMany(InstituteReview::class);
    }
    public function courses()
    {
        return $this->hasMany(InstituteCourseProgram::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')
            ->whereNull('parent_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id')
            ->whereNotNull('parent_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
    public function analytics()
    {
        return $this->hasMany(InstituteAnalytics::class);
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($institute) {

            $institute->plans()->delete();
            $institute->payments()->delete();
            $institute->timings()->delete();
            $institute->gallery()->delete();
            $institute->leads()->delete();
            $institute->courses()->delete();
            $institute->reviews()->delete();
            $institute->analytics()->delete();

        });
    }

    // Email verification ke liye owner_email use hoga
    public function getEmailForVerification()
    {
        return $this->owner_email;
    }

    // Notification override for custom route
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyInstituteEmail());
    }

    public function banners()
    {
        return $this->hasMany(InstituteBanner::class);
    }
}
