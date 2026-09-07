<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = [
        'name',
        'target_amount',
        'current_amount',
        'target_date',
        'notes',
    ];

    protected $casts = [
        'target_amount' => 'float',
        'current_amount' => 'float',
        'target_date' => 'date',
    ];

    /**
     * Hitung persentase progres tabungan (0 - 100%).
     */
    public static function calculateProgress(float $current, float $target): float
    {
        if ($target <= 0) {
            return 0.0;
        }

        $percentage = ($current / $target) * 100;
        return (float) min(100, round($percentage, 1));
    }

    /**
     * Hitung sisa target dana yang perlu dikumpulkan.
     */
    public static function calculateRemaining(float $current, float $target): float
    {
        return (float) max(0, $target - $current);
    }

    /**
     * Cek apakah target tabungan sudah tercapai.
     */
    public function isReached(): bool
    {
        return $this->target_amount > 0 && $this->current_amount >= $this->target_amount;
    }

    /**
     * Accessor untuk persentase progres.
     */
    public function getProgressPercentageAttribute(): float
    {
        return self::calculateProgress($this->current_amount, $this->target_amount);
    }

    /**
     * Accessor untuk sisa dana yang perlu dikumpulkan.
     */
    public function getRemainingAmountAttribute(): float
    {
        return self::calculateRemaining($this->current_amount, $this->target_amount);
    }

    /**
     * Accessor status teks tabungan.
     */
    public function getStatusLabelAttribute(): string
    {
        if ($this->isReached()) {
            return 'Tercapai';
        }

        if ($this->current_amount > 0) {
            return 'Sedang Berjalan';
        }

        return 'Belum Dimulai';
    }
}
