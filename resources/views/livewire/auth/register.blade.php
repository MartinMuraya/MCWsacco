<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle at top right, rgba(16, 185, 129, 0.05), transparent), radial-gradient(circle at bottom left, rgba(5, 150, 105, 0.05), transparent), var(--bg-main); padding: 2rem;">
    <div style="width: 100%; max-width: 520px; position: relative;">
        <!-- Decorative elements -->
        <div style="position: absolute; top: -30px; left: -30px; width: 120px; height: 120px; background: var(--primary); opacity: 0.1; filter: blur(45px); border-radius: 50%; z-index: 0;"></div>
        <div style="position: absolute; bottom: -30px; right: -30px; width: 150px; height: 150px; background: var(--secondary); opacity: 0.1; filter: blur(45px); border-radius: 50%; z-index: 0;"></div>

        <div class="card" style="position: relative; z-index: 1; padding: 3.5rem; border-radius: 2.5rem; border: 1px solid var(--border); background: var(--bg-card); box-shadow: var(--shadow-xl);">
            <div style="text-align: center; margin-bottom: 3rem;">
                <div style="width: 64px; height: 64px; background: var(--primary); color: white; border-radius: 1.25rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 1.5rem auto; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);">
                    <i class="ph-fill ph-user-plus"></i>
                </div>
                <h2 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); letter-spacing: -0.025em;">Join the <span style="color: var(--primary);">Sacco</span></h2>
                <p style="color: var(--text-gray); margin-top: 0.75rem; font-size: 1.05rem;">Start your journey to financial empowerment</p>
            </div>

            <form wire:submit.prevent="register" style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 600; font-size: 0.9rem; color: var(--text-main); margin-bottom: 0.5rem; display: block;">Full Name</label>
                    <div style="position: relative;">
                        <i class="ph ph-user" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: var(--text-gray); font-size: 1.2rem;"></i>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror" placeholder="Jane Doe" style="padding-left: 3.25rem; height: 3.5rem; border-radius: 1rem;">
                    </div>
                    @error('name') <span style="color: #EF4444; font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 600; font-size: 0.9rem; color: var(--text-main); margin-bottom: 0.5rem; display: block;">Email Address</label>
                    <div style="position: relative;">
                        <i class="ph ph-envelope" style="position: absolute; left: 1.25rem; top: 50%; transform: translateY(-50%); color: var(--text-gray); font-size: 1.2rem;"></i>
                        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="jane@example.com" style="padding-left: 3.25rem; height: 3.5rem; border-radius: 1rem;">
                    </div>
                    @error('email') <span style="color: #EF4444; font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-weight: 600; font-size: 0.9rem; color: var(--text-main); margin-bottom: 0.5rem; display: block;">Password</label>
                        <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" style="height: 3.5rem; border-radius: 1rem;">
                        @error('password') <span style="color: #EF4444; font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label style="font-weight: 600; font-size: 0.9rem; color: var(--text-main); margin-bottom: 0.5rem; display: block;">Confirm</label>
                        <input type="password" wire:model="password_confirmation" class="form-control" placeholder="••••••••" style="height: 3.5rem; border-radius: 1rem;">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0.5rem;">
                    <label style="display: flex; align-items: flex-start; gap: 0.75rem; cursor: pointer; font-size: 0.9rem; color: var(--text-gray); line-height: 1.5;">
                        <input type="checkbox" required style="width: 1.2rem; height: 1.2rem; accent-color: var(--primary); border-radius: 0.4rem; margin-top: 2px;">
                        <span>I agree to the <a href="#" style="color: var(--primary); font-weight: 600; text-decoration: none;">Terms of Service</a> and <a href="#" style="color: var(--primary); font-weight: 600; text-decoration: none;">Privacy Policy</a></span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 3.75rem; border-radius: 1rem; font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 0.75rem; transition: all 0.3s ease; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);">
                    Create Account <i class="ph-bold ph-arrow-right"></i>
                </button>
            </form>

            <div style="text-align: center; margin-top: 2.5rem; padding-top: 2rem; border-top: 1px solid var(--border);">
                <p style="color: var(--text-gray); font-size: 1rem;">
                    Already have an account? 
                    <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; border-bottom: 2px solid rgba(16, 185, 129, 0.2); padding-bottom: 2px;">Sign In Instead</a>
                </p>
                <div style="margin-top: 1.5rem;">
                    <a href="{{ route('home') }}" style="color: var(--text-gray); text-decoration: none; font-size: 0.9rem; opacity: 0.7; transition: opacity 0.3s ease;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">
                        <i class="ph ph-house"></i> Return to Homepage
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
