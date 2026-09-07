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
     * Hitung persentase progres tabungan saat ini terhadap target.
     */
    public function getProgressPercentageAttribute(): float
    {
        if ($this->target_amount <= 0) {
            return 0.0;
        }

        $percentage = ($this->current_amount / $this->target_amount) * 100;
        return (float) min(100, round($percentage, 1));
    }

    /**
     * Hitung sisa dana yang perlu dikumpulkan.
     */
    public function getRemainingAmountAttribute(): float
    {
        return (float) max(0, $this->target_amount - $this->current_amount);
    }
}
