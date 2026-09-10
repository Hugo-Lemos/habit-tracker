<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function habitLogs(): HasMany
    {
        return $this->hasMany(HabitLog::class);
    }

    public function wasCompletedToday(): bool
    {
        return $this->habitLogs
            ->where('completed_at', \Carbon\Carbon::today()->toDateString())
            ->isNotEmpty();
    }

    public function wasCompletedOnDate(\Carbon\Carbon $date): bool
    {
        return $this->habitLogs
            ->where('completed_at', $date->toDateString())
            ->isNotEmpty();
    }

    public static function generateYearGrid(int $year): array
    {
        $startDate = \Carbon\Carbon::create($year, 1, 1);
        $endDate = \Carbon\Carbon::create($year, 12, 31, 23, 59, 59);

        $weeks = [];
        $currentWeek = [];

        // Preenche dias vazios no início (se o ano não começar no domingo)
        $firstDayOfWeek = $startDate->dayOfWeek;
        for ($i = 0; $i < $firstDayOfWeek; $i++) {
            $currentWeek[] = null; // Placeholder vazio
        }

        // Agrupa os dias em semanas (domingo a sábado)
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $currentWeek[] = $date->copy();

            // Fecha a semana no sábado ou no último dia
            if ($date->isSaturday() || $date->eq($endDate)) {
            $weeks[] = $currentWeek;
            $currentWeek = [];
            }
        }

        return $weeks;
    }
}
