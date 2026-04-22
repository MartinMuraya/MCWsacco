<div style="padding: 5rem 0; background: var(--bg-light); min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="width: 100%; max-width: 450px; padding: 3rem;">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <div class="logo-icon" style="margin: 0 auto 1.5rem auto;">
                <i class="ph-fill ph-lock-key"></i>
            </div>
            <h2 style="font-size: 1.75rem; font-weight: 700; color: var(--text-dark);">Choose New Password</h2>
            <p style="color: var(--text-gray); margin-top: 0.5rem;">Set a secure password for your account</p>
        </div>

        <form wire:submit.prevent="resetPassword">
            <input type="hidden" wire:model="token">

            <div class="form-group">
                <label>Email Address</label>
                <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" readonly>
                @error('email') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>New Password</label>
                <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                @error('password') <span style="color: #EF4444; font-size: 0.85rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Confirm New Password</label>
                <input type="password" wire:model="password_confirmation" class="form-control" placeholder="••••••••">
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">
                Reset Password <i class="ph ph-check"></i>
            </button>
        </form>
    </div>
</div>
