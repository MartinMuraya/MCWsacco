<div style="padding: 5rem 0; background: var(--bg-main); min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="width: 100%; max-width: 500px; padding: 3rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div class="logo-icon" style="margin: 0 auto 1.5rem auto;">
                <i class="ph-fill ph-leaf"></i>
            </div>
            <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-main);">Join the SACCO</h2>
            <p style="color: var(--text-gray); margin-top: 0.5rem;">Become a member and start your financial journey</p>
        </div>

        <form wire:submit.prevent="register">
            <div class="form-group">
                <label style="color: var(--text-main);">Full Name</label>
                <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Jane Doe">
                @error('name') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label style="color: var(--text-main);">Email Address</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="jane@example.com">
                @error('email') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label style="color: var(--text-main);">Password</label>
                    <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                    @error('password') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label style="color: var(--text-main);">Confirm Password</label>
                    <input type="password" wire:model="password_confirmation" class="form-control" placeholder="••••••••">
                </div>
            </div>

            <div class="form-group">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.9rem; color: var(--text-main);">
                    <input type="checkbox" required>
                    <span>I agree to the <a href="#" style="color: var(--primary);">Terms & Conditions</a></span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">
                Create Account <i class="ph ph-user-plus"></i>
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem; border-top: 1px solid var(--border); padding-top: 2rem;">
            <p style="color: var(--text-gray); font-size: 0.95rem;">
                Already have an account? 
                <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 600;">Sign In Instead</a>
            </p>
        </div>
    </div>
</div>
