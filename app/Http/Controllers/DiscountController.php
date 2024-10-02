<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function applyDiscount(Request $request)
    {
        $user = $request->user();
        $booking = $request->booking;

        // Apply family member discount
        $familyDiscount = Discount::where('type', 'family')->first();
        if ($this->checkFamilyMember($user, $booking)) {
            $discountAmount = $this->calculateDiscount($familyDiscount, $booking);
            $booking->applyDiscount($discountAmount);
        }

        // Apply recurring discount
        $recurringDiscount = Discount::where('type', 'recurring')->first();
        if ($this->checkRecurring($user, $booking)) {
            $discountAmount = $this->calculateDiscount($recurringDiscount, $booking);
            $booking->applyDiscount($discountAmount);
        }

        return response()->json(['message' => 'Discount applied successfully', 'booking' => $booking]);
    }

    private function calculateDiscount($discount, $booking)
    {
        if ($discount->amount_type == 'percentage') {
            return min(($discount->amount / 100) * $booking->total_cost, $discount->max_discount_amount);
        } else {
            return min($discount->amount, $discount->max_discount_amount);
        }
    }

    private function checkFamilyMember($user, $booking)
    {
        // Logic to check if a family member has booked the same schedule
    }

    private function checkRecurring($user, $booking)
    {
        // Logic to check for recurring booking
    }
}
