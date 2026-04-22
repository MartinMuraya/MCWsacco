<x-layouts.app>
    <section style="padding: 5rem 0; background: var(--bg-main);">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 style="font-size: 3rem; color: var(--text-main);">About <span>Our SACCO</span></h1>
                    <p style="color: var(--text-gray);">Murang'a County Women's Sacco was founded with a single vision: to uplift the lives of women in our community by providing accessible financial services and professional support.</p>
                </div>
                <div class="hero-image">
                    @php
                        $aboutImage = \App\Models\WebsiteImage::where('section', 'about')->where('is_active', true)->latest()->first();
                    @endphp
                    <img src="{{ $aboutImage ? asset('storage/' . $aboutImage->image_path) : 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&q=80&w=1200' }}" alt="Our Team">
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 5rem 0; background: var(--bg-card);">
        <div class="container">
            <div class="grid-cards" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                <div class="card" style="text-align: center; padding: 3rem; background: var(--bg-main);">
                    <i class="ph-fill ph-target" style="font-size: 3rem; color: var(--primary); margin-bottom: 1.5rem;"></i>
                    <h3 style="color: var(--text-main);">Our Mission</h3>
                    <p style="color: var(--text-gray);">To provide sustainable financial solutions that empower women to create wealth and lead dignified lives.</p>
                </div>
                <div class="card" style="text-align: center; padding: 3rem; background: var(--bg-main);">
                    <i class="ph-fill ph-eye" style="font-size: 3rem; color: var(--secondary); margin-bottom: 1.5rem;"></i>
                    <h3 style="color: var(--text-main);">Our Vision</h3>
                    <p style="color: var(--text-gray);">To be the leading women-centric SACCO in East Africa, recognized for excellence in financial inclusion.</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
