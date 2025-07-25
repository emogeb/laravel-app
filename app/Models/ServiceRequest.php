<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_type',
        'service_option',
        'name',
        'email',
        'phone',
        'address',
        'district',
        'description',
        'status',
        'admin_notes',
        'whatsapp_message_id',
        'request_number',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($serviceRequest) {
            // Talep numarası oluştur (YIL-AY-SIRA)
            $year = date('Y');
            $month = date('m');
            $lastRequest = self::whereYear('created_at', $year)
                             ->whereMonth('created_at', $month)
                             ->orderBy('id', 'desc')
                             ->first();
            
            $sequence = $lastRequest ? (int)substr($lastRequest->request_number, -4) + 1 : 1;
            $serviceRequest->request_number = sprintf('%s%s%04d', $year, $month, $sequence);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ServiceComment::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getStatusTextAttribute()
    {
        return match($this->status) {
            'pending' => 'Beklemede',
            'in_progress' => 'İşleme Alındı',
            'completed' => 'Tamamlandı',
            'cancelled' => 'İptal Edildi',
            default => 'Bilinmiyor'
        };
    }
} 