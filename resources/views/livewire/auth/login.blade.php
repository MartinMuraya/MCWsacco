<div style="padding: 5rem 0; background: var(--bg-light); min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 3rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div class="logo-icon" style="margin: 0 auto 1.5rem auto;">
                <i class="ph-fill ph-leaf"></i>
            </div>
            <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-dark);">Welcome Back</h2>
            <p style="color: var(--text-gray); margin-top: 0.5rem;">Sign in to manage your SACCO accounts</p>
        </div>

        <form wire:submit.prevent="login">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="jane@example.com">
                @error('email') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <label style="margin-bottom: 0;">Password</label>
                    <a href="{{ route('password.request') }}" style="font-size: 0.875rem; color: var(--primary); text-decoration: none; font-weight: 500;">Forgot password?</a>
                </div>
                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                @error('password') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem;">
                    <input type="checkbox" wire:model="remember">
                    <span>Remember me for 30 days</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">
                Sign In <i class="ph ph-arrow-right"></i>
            </button>

            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="{{ route('home') }}" style="color: var(--text-gray); text-decoration: none; font-size: 0.9rem; font-weight: 500;">
                    <i class="ph ph-eye"></i> Navigate as Visitor
                </a>
            </div>
        </form>

        <div style="text-align: center; margin-top: 2rem; border-top: 1px solid var(--border); padding-top: 2rem;">
            <p style="color: var(--text-gray); font-size: 0.95rem;">
                Don't have an account? 
                <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">Join the SACCO</a>
            </p>
        </div>
    </div>
</div>
