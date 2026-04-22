<x-layouts.app>
    <section class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>Empowering <span>Women</span>, Building a Stronger Murang'a</h1>
                <p>Join thousands of women who are transforming their lives through shared growth, financial support, and a community that cares about your success.</p>
                <div class="nav-actions" style="justify-content: flex-start;">
                    <a href="#" class="btn btn-primary">Start Your Journey</a>
                    <a href="/about" class="btn btn-outline">Learn More</a>
                </div>
            </div>
            <div class="hero-image">
                @php
                    $heroImage = \App\Models\WebsiteImage::where('section', 'hero')->where('is_active', true)->latest()->first();
                @endphp
                <img src="{{ $heroImage ? asset('storage/' . $heroImage->image_path) : 'https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&q=80&w=1200' }}" alt="Women Empowerment">
            </div>
        </div>
    </section>

    <!-- Core Services -->
    <section class="services" style="background: var(--bg-main);">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 4rem;">
                <h2 style="font-size: 2.5rem; font-weight: 800; color: var(--text-main);">Our Core <span>Services</span></h2>
                <p style="color: var(--text-gray); max-width: 600px; margin: 1rem auto;">We provide a comprehensive range of financial and social services tailored to empower every woman in Murang'a.</p>
            </div>
            
            <div class="grid-cards" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2.5rem;">
                <div class="card service-card" style="padding: 3rem 2rem; text-align: center; border: 1px solid var(--border); transition: var(--transition); background: var(--bg-card);">
                    <div class="service-icon" style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.1); color: var(--primary); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 2rem auto;">
                        <i class="ph-fill ph-bank"></i>
                    </div>
                    <h3 style="margin-bottom: 1rem; font-size: 1.5rem; color: var(--text-main);">Savings & Deposits</h3>
                    <p style="color: var(--text-gray); font-size: 0.95rem; line-height: 1.7; margin-bottom: 2rem;">Secure your future with our flexible savings plans offering competitive interest rates and easy withdrawals.</p>
                    <a href="/register" class="btn btn-outline btn-sm">Start Saving Today</a>
                </div>

                <div class="card service-card" style="padding: 3rem 2rem; text-align: center; border: 1px solid var(--border); transition: var(--transition); background: var(--bg-card);">
                    <div class="service-icon" style="width: 70px; height: 70px; background: rgba(16, 185, 129, 0.1); color: var(--secondary); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 2rem auto;">
                        <i class="ph-fill ph-hand-coins"></i>
                    </div>
                    <h3 style="margin-bottom: 1rem; font-size: 1.5rem; color: var(--text-main);">Affordable Loans</h3>
                    <p style="color: var(--text-gray); font-size: 0.95rem; line-height: 1.7; margin-bottom: 2rem;">Access quick and affordable credit facilities for business growth, education, and personal development.</p>
                    <a href="/loans/apply" class="btn btn-outline btn-sm">Explore Loan Products</a>
                </div>

                <div class="card service-card" style="padding: 3rem 2rem; text-align: center; border: 1px solid var(--border); transition: var(--transition); background: var(--bg-card);">
                    <div class="service-icon" style="width: 70px; height: 70px; background: rgba(245, 158, 11, 0.1); color: var(--accent); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 2rem auto;">
                        <i class="ph-fill ph-buildings"></i>
                    </div>
                    <h3 style="margin-bottom: 1rem; font-size: 1.5rem; color: var(--text-main);">Student Hostels</h3>
                    <p style="color: var(--text-gray); font-size: 0.95rem; line-height: 1.7; margin-bottom: 2rem;">Safe, secure, and modern accommodation for students in Murang'a, managed directly by the Sacco.</p>
                    <a href="/hostels/book" class="btn btn-outline btn-sm">View Available Rooms</a>
                </div>
            </div>
        </div>
    </section>

    <section style="padding: 5rem 0; background: var(--primary); color: white;">
        <div class="container" style="text-align: center;">
            <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem; color: white;">Join the Movement</h2>
            <p style="font-size: 1.25rem; margin-bottom: 2.5rem; max-width: 700px; margin: 0 auto 2.5rem; opacity: 0.9;">Take the first step towards financial independence and become part of a network of supportive women entrepreneurs.</p>
            <a href="/register" class="btn" style="background: white; color: var(--primary); font-size: 1.1rem; padding: 1rem 2.5rem;">Register Today</a>
        </div>
    </section>
</x-layouts.app>
