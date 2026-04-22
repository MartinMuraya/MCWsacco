<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LoanProduct;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Auth;

class LoanApplicationWizard extends Component
{
    public $step = 1;
    
    public $loan_product_id;
    public $amount_requested;
    public $period_months;
    public $purpose;
    
    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }
    
    public function previousStep()
    {
        $this->step--;
    }
    
    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'loan_product_id' => 'required|exists:loan_products,id',
                'amount_requested' => 'required|numeric|min:1000',
                'period_months' => 'required|integer|min:1',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'purpose' => 'required|string|min:10',
            ]);
        }
    }
    
    public function submit()
    {
        $this->validateStep();
        
        $user = Auth::user();
        if (!$user || !$user->member) {
            session()->flash('error', 'You must be a registered member to apply for a loan.');
            return;
        }

        $product = LoanProduct::find($this->loan_product_id);

        LoanApplication::create([
            'member_id' => $user->member->id,
            'loan_product_id' => $this->loan_product_id,
            'amount_requested' => $this->amount_requested,
            'period_months' => $this->period_months,
            'purpose' => $this->purpose,
            'interest_rate_used' => $product->interest_rate,
            'status' => 'pending',
            'application_date' => now(),
        ]);
        
        $this->step = 4; // Success step
    }

    public function render()
    {
        $products = LoanProduct::where('is_active', true)->get();
        return view('livewire.loan-application-wizard', [
            'products' => $products
        ]);
    }
}
