<div style="padding: 5rem 0; background: var(--bg-light); min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 3rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div class="logo-icon" style="margin: 0 auto 1.5rem auto;">
                <i class="ph-fill ph-key"></i>
            </div>
            <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-dark);">Reset Password</h2>
            <p style="color: var(--text-gray); margin-top: 0.5rem;">Enter your email to receive a reset link</p>
        </div>

        @if ($status)
            <div style="background: #ECFDF5; color: #059669; padding: 1rem; border-radius: var(--radius-md); margin-bottom: 2rem; font-size: 0.9rem; text-align: center;">
                {{ $status }}
            </div>
        @endif

        <form wire:submit.prevent="sendResetLink">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="jane@example.com">
                @error('email') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">
                Send Reset Link <i class="ph ph-paper-plane-tilt"></i>
            </button>
        </form>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="{{ route('login') }}" style="color: var(--text-gray); text-decoration: none; font-size: 0.95rem; font-weight: 500;">
                <i class="ph ph-arrow-left"></i> Back to Sign In
            </a>
        </div>
    </div>
</div>
