<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle at top right, rgba(16, 185, 129, 0.05), transparent), radial-gradient(circle at bottom left, rgba(5, 150, 105, 0.05), transparent), var(--bg-main); padding: 2rem;">
    <div style="width: 100%; max-width: 480px; position: relative;">
        <!-- Decorative elements -->
        <div style="position: absolute; top: -20px; left: -20px; width: 100px; height: 100px; background: var(--primary); opacity: 0.1; filter: blur(40px); border-radius: 50%; z-index: 0;"></div>
        <div style="position: absolute; bottom: -20px; right: -20px; width: 120px; height: 120px; background: var(--secondary); opacity: 0.1; filter: blur(40px); border-radius: 50%; z-index: 0;"></div>

        <div class="card" style="position: relative; z-index: 1; padding: 3.5rem; border-radius: 2rem; border: 1px solid var(--border); background: var(--bg-card); box-shadow: var(--shadow-xl);">
            <div style="text-align: center; margin-bottom: 3rem;">
                <div style="width: 64px; height: 64px; background: var(--primary); color: white; border-radius: 1.25rem; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 1.5rem auto; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);">
                    <i class="ph-fill ph-leaf"></i>
                </div>
                <h2 style="font-size: 2.25rem; font-weight: 800; color: var(--text-main); letter-spacing: -0.025em;">Welcome <span style="color: var(--primary);">Back</span></h2>
                <p style="color: var(--text-gray); margin-top: 0.75rem; font-size: 1.05rem;">Access your MCW Sacco portal</p>
            </div>

            <form wire:submit.prevent="login" style="display: flex; flex-direction: column; gap: 1.75rem;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="font-weight: 600; font-size: 0.9rem; color: var(--text-main); margin-bottom: 0.75rem; display: block;">Email Address</label>
                    <div style="position: relative;">
                        <i class="ph ph-envelope" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-gray); font-size: 1.25rem;"></i>
                        <input type="email" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" style="padding-left: 3rem; height: 3.5rem; border-radius: 1rem;">
                    </div>
                    @error('email') <span style="color: #EF4444; font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <label style="font-weight: 600; font-size: 0.9rem; color: var(--text-main); margin-bottom: 0;">Password</label>
                        <a href="{{ route('password.request') }}" style="font-size: 0.85rem; color: var(--primary); text-decoration: none; font-weight: 600;">Forgot Password?</a>
                    </div>
                    <div style="position: relative;">
                        <i class="ph ph-lock" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--text-gray); font-size: 1.25rem;"></i>
                        <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" style="padding-left: 3rem; height: 3.5rem; border-radius: 1rem;">
                    </div>
                    @error('password') <span style="color: #EF4444; font-size: 0.85rem; margin-top: 0.5rem; display: block;">{{ $message }}</span> @enderror
                </div>

                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; font-size: 0.95rem; color: var(--text-gray);">
                        <input type="checkbox" wire:model="remember" style="width: 1.2rem; height: 1.2rem; accent-color: var(--primary); border-radius: 0.4rem;">
                        Keep me signed in
                    </label>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 3.5rem; border-radius: 1rem; font-size: 1.1rem; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 0.75rem; transition: all 0.3s ease; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.2);">
                    Sign In <i class="ph-bold ph-arrow-right"></i>
                </button>
            </form>

            <div style="text-align: center; margin-top: 2.5rem; padding-top: 2rem; border-top: 1px solid var(--border);">
                <p style="color: var(--text-gray); font-size: 1rem;">
                    New to the Sacco? 
                    <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; border-bottom: 2px solid rgba(16, 185, 129, 0.2); padding-bottom: 2px; transition: all 0.3s ease;">Create an Account</a>
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
