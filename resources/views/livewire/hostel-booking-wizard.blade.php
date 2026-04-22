<div>
    @php
        $hostel = \App\Models\Hostel::where('name', 'LIKE', '%Sunrise%')->first() ?? \App\Models\Hostel::first();
        $hostelsHero = \App\Models\WebsiteImage::where('section', 'hostels_page')->where('is_active', true)->latest()->first();
        $heroBackground = $hostelsHero 
            ? asset('storage/' . $hostelsHero->image_path) 
            : (($hostel && $hostel->gallery && count($hostel->gallery) > 0) 
                ? asset('storage/' . $hostel->gallery[0]) 
                : 'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?auto=format&fit=crop&q=80&w=1200');
    @endphp

    <section class="hero" style="padding: 4rem 0; background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ $heroBackground }}'); background-size: cover; background-position: center; color: white;">
        <div class="container" style="text-align: center;">
            <h1 style="font-size: 3.5rem; font-weight: 800; color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">{{ $hostel->name ?? 'Premium Student Living' }}</h1>
            <p style="font-size: 1.25rem; max-width: 700px; margin: 1.5rem auto; opacity: 0.9; text-shadow: 0 1px 2px rgba(0,0,0,0.2);">Safe, secure, and modern accommodation managed by the Murang'a County Women's Sacco. Your home away from home.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 2.5rem;">
                <a href="#booking" class="btn btn-primary">Book Your Room</a>
                @if($hostel && $hostel->gallery && count($hostel->gallery) > 0)
                    <a href="#gallery" class="btn" style="background: rgba(255,255,255,0.2); backdrop-filter: blur(5px); color: white; border: 1px solid rgba(255,255,255,0.3);">View Gallery</a>
                @endif
            </div>
        </div>
    </section>

    <section id="features" style="padding: 5rem 0; background: var(--bg-main);">
        <div class="container">
            @if($hostel && $hostel->amenities && count($hostel->amenities) > 0)
                <div class="grid-cards" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                    @foreach($hostel->amenities as $amenity)
                        <div class="text-center" style="padding: 2rem; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px solid var(--border);">
                            <i class="ph-fill ph-sparkle" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"></i>
                            <h4 style="margin-bottom: 0;">{{ $amenity }}</h4>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid-cards" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                    <div class="text-center">
                        <i class="ph-fill ph-shield-check" style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                        <h4>24/7 Security</h4>
                        <p style="color: var(--text-gray); font-size: 0.9rem;">CCTV surveillance and professional security guards always on duty.</p>
                    </div>
                    <div class="text-center">
                        <i class="ph-fill ph-wifi-high" style="font-size: 3rem; color: var(--primary); margin-bottom: 1rem;"></i>
                        <h4>Free High-Speed Wi-Fi</h4>
                        <p style="color: var(--text-gray); font-size: 0.9rem;">Stay connected with reliable internet for all your studies.</p>
                    </div>
                    <div class="text-center">
                        <i class="ph-fill ph-drop" style="font-size: 3rem; color: #3B82F6; margin-bottom: 1rem;"></i>
                        <h4>Constant Water</h4>
                        <p style="color: var(--text-gray); font-size: 0.9rem;">Consistent water supply with backup tanks for your convenience.</p>
                    </div>
                    <div class="text-center">
                        <i class="ph-fill ph-map-pin" style="font-size: 3rem; color: #EF4444; margin-bottom: 1rem;"></i>
                        <h4>Near University</h4>
                        <p style="color: var(--text-gray); font-size: 0.9rem;">Just a 5-minute walk from the main university gates.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @if($hostel && $hostel->gallery && count($hostel->gallery) > 0)
    <section id="gallery" style="padding: 5rem 0; background: var(--bg-card); overflow: hidden;">
        <div class="container">
            <div class="section-header">
                <h2>Explore <span>The Facilities</span></h2>
                <p>Take a virtual tour through our modern hostels and premium amenities.</p>
            </div>
            
            <!-- Swiper Slideshow -->
            <div class="swiper hostel-swiper" style="width: 100%; height: 500px; border-radius: var(--radius-lg); box-shadow: var(--shadow-xl);">
                <div class="swiper-wrapper">
                    @foreach($hostel->gallery as $image)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endforeach
                </div>
                <!-- Pagination & Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev" style="color: white;"></div>
                <div class="swiper-button-next" style="color: white;"></div>
            </div>

            <!-- Thumbnail Navigation -->
            <div class="swiper-thumbnails" style="display: flex; gap: 1rem; margin-top: 1.5rem; justify-content: center; overflow-x: auto; padding: 0.5rem;">
                @foreach($hostel->gallery as $index => $image)
                    <div class="thumb-item" onclick="hostelSwiper.slideTo({{ $index }})" style="width: 100px; height: 70px; flex-shrink: 0; border-radius: var(--radius-md); overflow: hidden; cursor: pointer; border: 2px solid transparent; transition: var(--transition);">
                        <img src="{{ asset('storage/' . $image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                @endforeach
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                window.hostelSwiper = new Swiper('.hostel-swiper', {
                    loop: true,
                    grabCursor: true,
                    effect: 'creative',
                    creativeEffect: {
                        prev: { shadow: true, translate: [0, 0, -400] },
                        next: { translate: ['100%', 0, 0] },
                    },
                    pagination: { el: '.swiper-pagination', clickable: true },
                    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
                    autoplay: { delay: 4000, disableOnInteraction: false },
                });
            });
        </script>
    </section>
    @endif

    <section id="booking" style="padding: 5rem 0; background: var(--bg-main);">
        <div class="container">
            <div class="section-header">
                <h2>Available <span>Rooms</span></h2>
                <p>Choose the room type that best fits your needs and budget.</p>
            </div>

            @if ($step === 3)
                <div class="card" style="text-align: center; padding: 4rem 2rem;">
                    <i class="ph ph-check-circle" style="font-size: 4rem; color: var(--secondary); margin-bottom: 1.5rem;"></i>
                    <h2 style="font-size: 1.75rem;">Booking Reserved!</h2>
                    <p style="color: var(--text-gray); margin-bottom: 2rem;">We have reserved your spot. Please visit the SACCO office within 48 hours.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                </div>
            @else
                <div class="grid-cards">
                    @foreach($rooms as $room)
                        <div class="card {{ $room_id == $room->id ? 'active' : '' }}" 
                             @auth wire:click="$set('room_id', {{ $room->id }})" @endauth
                             style="cursor: @auth pointer @else default @endauth; border-color: {{ $room_id == $room->id ? 'var(--primary)' : 'var(--border)' }}; position: relative; padding: 2rem;">
                            
                            <h3 style="margin-bottom: 0.5rem;">Room #{{ $room->room_number }}</h3>
                            <p style="color: var(--text-gray); font-size: 0.9rem; margin-bottom: 1.5rem;">{{ ucfirst($room->room_type) }} occupancy room with high security and modern fittings.</p>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border); padding-top: 1rem;">
                                <span style="font-size: 1.125rem; font-weight: 800; color: var(--secondary);">KES {{ number_format($room->price_per_semester) }}</span>
                                <span style="font-size: 0.8rem; background: rgba(16, 185, 129, 0.1); color: var(--secondary); padding: 0.25rem 0.75rem; border-radius: var(--radius-full); font-weight: 600;">Available</span>
                            </div>

                            @if($room_id == $room->id)
                                <div style="position: absolute; top: 1rem; right: 1rem; color: var(--primary);">
                                    <i class="ph-fill ph-check-circle" style="font-size: 1.5rem;"></i>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                @guest
                    <div class="card" style="text-align: center; padding: 3rem; background: var(--bg-card); border: 2px dashed var(--secondary); margin-top: 3rem;">
                        <i class="ph ph-buildings" style="font-size: 3rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                        <h3>Ready to Reserve?</h3>
                        <p style="color: var(--text-gray); margin-bottom: 2rem; max-width: 400px; margin-left: auto; margin-right: auto;">
                            Room bookings are available to SACCO members. Sign in or register to secure your room for the next semester.
                        </p>
                        <div style="display: flex; gap: 1rem; justify-content: center;">
                            <a href="{{ route('login') }}" class="btn btn-primary" style="background: var(--secondary);">Sign In to Book</a>
                            <a href="{{ route('register') }}" class="btn btn-outline" style="color: var(--secondary); border-color: var(--secondary);">Become a Member</a>
                        </div>
                    </div>
                @else
                    @if($room_id)
                        <div class="card" style="margin-top: 3rem; border-top: 4px solid var(--secondary);">
                            <form wire:submit.prevent="{{ $step === 2 ? 'submit' : 'nextStep' }}">
                                @if($step === 1)
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                                        <div class="form-group">
                                            <label>Check-in Date</label>
                                            <input type="date" wire:model="check_in_date" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Duration (Months)</label>
                                            <input type="number" wire:model="duration_months" class="form-control" placeholder="e.g. 4">
                                        </div>
                                    </div>
                                @endif

                                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                                    @if($step > 1)
                                        <button type="button" wire:click="previousStep" class="btn btn-outline">Back</button>
                                    @endif
                                    <button type="submit" class="btn btn-primary" style="background: var(--secondary);">
                                        {{ $step === 2 ? 'Confirm Booking' : 'Continue' }} <i class="ph ph-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                @endguest
            @endif
        </div>
    </section>
</div>
