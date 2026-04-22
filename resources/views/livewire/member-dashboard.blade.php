<div>
    <h1 class="page-title">Welcome back, {{ auth()->user()->name }} 👋</h1>

    @if(!$member)
        <div class="card" style="border-left: 4px solid var(--secondary-color); margin-bottom: 2rem;">
            <h3>Complete Your Registration</h3>
            <p style="color: var(--text-secondary); margin-top: 0.5rem; margin-bottom: 1rem;">You need to complete your member profile before you can access all SACCO features.</p>
            <button class="btn btn-primary">Complete Profile</button>
        </div>
    @endif

    <div class="grid-cards">
        <div class="card stat-card">
            <div class="stat-icon primary">
                <i class="ph ph-piggy-bank"></i>
            </div>
            <div class="stat-content">
                <h3>Total Savings</h3>
                <div class="value">KES {{ number_format($totalSavings, 2) }}</div>
            </div>
        </div>

        <div class="card stat-card">
            <div class="stat-icon success">
                <i class="ph ph-chart-line-up"></i>
            </div>
            <div class="stat-content">
                <h3>Share Capital</h3>
                <div class="value">KES {{ number_format($totalShares, 2) }}</div>
            </div>
        </div>

        <div class="card stat-card">
            <div class="stat-icon warning">
                <i class="ph ph-hand-coins"></i>
            </div>
            <div class="stat-content">
                <h3>Active Loans</h3>
                <div class="value">KES {{ number_format($activeLoanBalance, 2) }}</div>
            </div>
        </div>
    </div>

    <div class="grid-cards" style="grid-template-columns: 2fr 1fr;">
        <!-- Recent Transactions -->
        <div class="card" style="background: var(--bg-card);">
            <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem; color: var(--text-main);">Recent Transactions</h3>
            
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <!-- Placeholder for transactions -->
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(16, 185, 129, 0.1); color: var(--secondary); display: flex; align-items: center; justify-content: center;">
                            <i class="ph ph-arrow-down-left"></i>
                        </div>
                        <div>
                            <div style="font-weight: 500; color: var(--text-main);">Monthly Contribution</div>
                            <div style="font-size: 0.85rem; color: var(--text-gray);">Today, 10:24 AM</div>
                        </div>
                    </div>
                    <div style="font-weight: 600; color: var(--secondary);">+ KES 5,000.00</div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid var(--border);">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(239, 68, 68, 0.1); color: #EF4444; display: flex; align-items: center; justify-content: center;">
                            <i class="ph ph-arrow-up-right"></i>
                        </div>
                        <div>
                            <div style="font-weight: 500; color: var(--text-main);">Loan Repayment</div>
                            <div style="font-size: 0.85rem; color: var(--text-gray);">Yesterday</div>
                        </div>
                    </div>
                    <div style="font-weight: 600; color: #EF4444;">- KES 12,500.00</div>
                </div>
            </div>
            
            <a href="#" style="display: block; text-align: center; margin-top: 1.5rem; color: var(--primary); text-decoration: none; font-weight: 500;">View All Transactions</a>
        </div>

        <!-- Quick Actions -->
        <div class="card" style="background: linear-gradient(135deg, var(--primary), var(--primary-hover)); color: white;">
            <h3 style="margin-bottom: 1.5rem; color: white;">Quick Actions</h3>
            
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <a href="{{ route('loans.apply') }}" class="btn" style="background: rgba(255,255,255,0.2); color: white; justify-content: flex-start; padding: 1rem;">
                    <i class="ph ph-hand-coins" style="font-size: 1.5rem;"></i>
                    Apply for a Loan
                </a>
                <a href="{{ route('hostels.book') }}" class="btn" style="background: rgba(255,255,255,0.2); color: white; justify-content: flex-start; padding: 1rem;">
                    <i class="ph ph-buildings" style="font-size: 1.5rem;"></i>
                    Book a Hostel Room
                </a>
                <button class="btn" style="background: rgba(255,255,255,0.2); color: white; justify-content: flex-start; padding: 1rem;">
                    <i class="ph ph-wallet" style="font-size: 1.5rem;"></i>
                    Make a Deposit
                </button>
            </div>
        </div>
    </div>
</div>
