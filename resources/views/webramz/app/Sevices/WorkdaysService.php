<?php

namespace App\Services;

use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Exception;
use Carbon\Carbon;

class WorkdaysService
{
    /**
     * محاسبه تاریخ پایان بر اساس تاریخ شروع و تعداد روزهای کاری
     *
     * @param string $startDate
     * @param int $workingDays
     * @return string
     * @throws Exception
     */
    public function calculateEndDate(string $startDate, int $workingDays): string
    {
        try {
            // تبدیل تاریخ شروع به تاریخ شمسی
            $startDate = Jalalian::fromDateTime($startDate);
        } catch (Exception $e) {
            throw new Exception('فرمت تاریخ شروع نامعتبر است: ' . $startDate);
        }

        // اطمینان از مثبت بودن تعداد روزهای کاری
        if ($workingDays < 0) {
            throw new Exception('تعداد روزهای کاری نمی‌تواند منفی باشد');
        }

        // محاسبه تاریخ پایان
        $currentWorkingDays = 0;
        $currentDate = $startDate;

        while ($currentWorkingDays < $workingDays) {
            $currentDate = $currentDate->addDay();

            // چک کردن اینکه روز تعطیل یا آخر هفته (پنج‌شنبه/جمعه) نیست
            if (!$this->isWeekend($currentDate) && !$this->isHoliday($currentDate)) {
                $currentWorkingDays++;
            }
        }

        return $currentDate->format('Y-m-d'); // خروجی به فرمت شمسی
    }

    /**
     * چک کردن اینکه تاریخ جزو آخر هفته (پنج‌شنبه یا جمعه) است یا خیر
     *
     * @param Jalalian $date
     * @return bool
     */
    private function isWeekend(Jalalian $date): bool
    {
        // تبدیل تاریخ جلالی به Carbon
        $carbonDate = $date->toCarbon();

        // پنج‌شنبه (4) یا جمعه (5)
        return $carbonDate->dayOfWeek === 4 || $carbonDate->dayOfWeek === 5;
    }

    /**
     * چک کردن تعطیل بودن یک تاریخ از API
     *
     * @param Jalalian $date
     * @return bool
     */
    private function isHoliday(Jalalian $date): bool
    {
        // کش کردن نتیجه برای تاریخ خاص (مثلاً ۳۰ روز)
        return Cache::remember("holiday_{$date->toDateString()}", now()->addDays(30), function () use ($date) {
            try {
                // ساخت URL برای API
                $url = "https://holidayapi.ir/jalali/{$date->getYear()}/{$date->getMonth()}/{$date->getDay()}";
                $response = Http::get($url);
                $data = $response->json();

                if ($response->failed() || !isset($data['is_holiday'])) {
                    \Log::warning("خطا در دریافت وضعیت تعطیلات برای {$date->toDateString()}");
                    return false; // در صورت خطا، فرض می‌کنیم تعطیل نیست
                }

                return $data['is_holiday'] === true;
            } catch (Exception $e) {
                \Log::warning("خطا در چک کردن تعطیلات برای {$date->toDateString()}: " . $e->getMessage());
                return false; // در صورت خطا، فرض می‌کنیم تعطیل نیست
            }
        });
    }
}
