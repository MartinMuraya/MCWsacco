<x-layouts.app>
    <section style="padding: 5rem 0; background: var(--bg-main);">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 style="font-size: 3rem; color: var(--text-main);">About <span>Our SACCO</span></h1>
                    <p style="color: var(--text-gray);">Murang'a County Women's Sacco was founded with a single vision: to uplift the lives of women in our community by providing accessible financial services and professional support.</p>
                </div>
                <div class="hero-image" style="width: 100%; max-width: 550px; position: relative;">
                    <div class="swiper about-swiper" style="border-radius: var(--radius-xl); box-shadow: var(--shadow-xl); overflow: hidden;">
                        <div class="swiper-wrapper">
                            @php
                                $aboutImages = \App\Models\WebsiteImage::where('section', 'about')->where('is_active', true)->latest()->get();
                            @endphp
                            @forelse($aboutImages as $img)
                                <div class="swiper-slide">
                                    <img src="{{ asset('storage/' . $img->image_path) }}" alt="{{ $img->title }}" style="width: 100%; height: 400px; object-fit: cover;">
                                </div>
                            @empty
                                <div class="swiper-slide">
                                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&q=80&w=1200" alt="Our Team" style="width: 100%; height: 400px; object-fit: cover;">
                                </div>
                            @endforelse
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            new Swiper('.about-swiper', {
                                loop: true,
                                autoplay: { delay: 4000, disableOnInteraction: false },
                                effect: 'slide',
                                pagination: { el: '.swiper-pagination', clickable: true },
                            });
                        });
                    </script>
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
