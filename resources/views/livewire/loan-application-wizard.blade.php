<div>
    <section class="section-header">
        <div class="container">
            <h1 style="font-size: 3rem; font-weight: 800;">Loan <span>Products</span></h1>
            <p style="color: var(--text-gray); font-size: 1.1rem; max-width: 600px; margin: 1rem auto;">Explore our flexible loan options designed to support your growth. Members can apply instantly.</p>
        </div>
    </section>

    <div class="container" style="margin-bottom: 5rem;">
        @if ($step === 4)
            <div class="card" style="text-align: center; padding: 4rem 2rem;">
                <div style="width: 80px; height: 80px; background: #ECFDF5; color: var(--secondary); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 3rem; margin: 0 auto 2rem auto;">
                    <i class="ph ph-check-circle"></i>
                </div>
                <h2 style="font-size: 1.75rem; margin-bottom: 1rem;">Application Submitted!</h2>
                <p style="color: var(--text-gray); margin-bottom: 2rem;">Your application is being reviewed. We will notify you shortly.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            </div>
        @else
            <div class="grid-cards">
                @foreach($products as $product)
                    <div class="card {{ $loan_product_id == $product->id ? 'active' : '' }}" 
                         @auth wire:click="$set('loan_product_id', {{ $product->id }})" @endauth
                         style="cursor: @auth pointer @else default @endauth; border-color: {{ $loan_product_id == $product->id ? 'var(--primary)' : 'var(--border)' }}; position: relative;">
                        
                        <div class="feature-icon" style="background: rgba(79, 70, 229, 0.1); color: var(--primary);">
                            <i class="ph ph-hand-coins"></i>
                        </div>
                        
                        <h3 style="margin-bottom: 0.5rem;">{{ $product->name }}</h3>
                        <p style="color: var(--text-gray); font-size: 0.9rem; margin-bottom: 1.5rem;">{{ $product->description }}</p>
                        
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; border-top: 1px solid var(--border); padding-top: 1rem;">
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                <span style="color: var(--text-light);">Interest Rate</span>
                                <span style="font-weight: 700;">{{ $product->interest_rate }}%</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 0.85rem;">
                                <span style="color: var(--text-light);">Max Amount</span>
                                <span style="font-weight: 700;">KES {{ number_format($product->maximum_amount) }}</span>
                            </div>
                        </div>

                        @if($loan_product_id == $product->id)
                            <div style="position: absolute; top: 1rem; right: 1rem; color: var(--primary);">
                                <i class="ph-fill ph-check-circle" style="font-size: 1.5rem;"></i>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @guest
                <div class="card" style="text-align: center; padding: 3rem; background: linear-gradient(135deg, rgba(79, 70, 229, 0.05), transparent); border: 2px dashed var(--primary);">
                    <i class="ph ph-lock-key" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h3>Member Exclusive</h3>
                    <p style="color: var(--text-gray); margin-bottom: 2rem; max-width: 400px; margin-left: auto; margin-right: auto;">
                        Full loan applications are available to registered SACCO members only. Sign in to your account or join us today to apply.
                    </p>
                    <div style="display: flex; gap: 1rem; justify-content: center;">
                        <a href="{{ route('login') }}" class="btn btn-primary">Sign In to Apply</a>
                        <a href="{{ route('register') }}" class="btn btn-outline">Become a Member</a>
                    </div>
                </div>
            @else
                <div class="card" style="margin-top: 3rem; border-top: 4px solid var(--primary);">
                    <form wire:submit.prevent="{{ $step === 3 ? 'submit' : 'nextStep' }}">
                        @if($step === 1)
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                                <div class="form-group">
                                    <label>Amount Requested (KES)</label>
                                    <input type="number" wire:model="amount_requested" class="form-control" placeholder="e.g. 50000">
                                    @error('amount_requested') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Repayment Period (Months)</label>
                                    <input type="number" wire:model="period_months" class="form-control" placeholder="e.g. 12">
                                    @error('period_months') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @elseif($step === 2)
                             <div class="form-group">
                                <label>Loan Purpose</label>
                                <textarea wire:model="purpose" class="form-control" rows="4" placeholder="Briefly describe what you intend to use this loan for..."></textarea>
                                @error('purpose') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                            </div>
                        @endif

                        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                            @if($step > 1)
                                <button type="button" wire:click="previousStep" class="btn btn-outline">Back</button>
                            @endif
                            <button type="submit" class="btn btn-primary">
                                {{ $step === 3 ? 'Confirm & Submit' : 'Continue' }} <i class="ph ph-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            @endguest
        @endif
    </div>
</div>
