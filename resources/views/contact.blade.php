<x-layouts.app>
    <section style="padding: 5rem 0; background: #f3f4f6;">
        <div class="container" style="max-width: 800px; text-align: center;">
            <h1 style="font-size: 3rem; margin-bottom: 1.5rem;">Get in <span>Touch</span></h1>
            <p style="color: var(--text-gray); font-size: 1.25rem;">Have questions? Our team is here to support you. Send us a message and we'll get back to you shortly.</p>
        </div>
    </section>

    <section style="padding: 5rem 0; background: white;">
        <div class="container">
            <div class="grid-cards" style="grid-template-columns: 1fr 1.5fr;">
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    <div class="card" style="display: flex; align-items: center; gap: 1.5rem;">
                        <div class="stat-icon primary"><i class="ph ph-envelope"></i></div>
                        <div>
                            <h4>Email Us</h4>
                            <p style="color: var(--text-gray);">info@mwsacco.co.ke</p>
                        </div>
                    </div>
                    <div class="card" style="display: flex; align-items: center; gap: 1.5rem;">
                        <div class="stat-icon success"><i class="ph ph-phone"></i></div>
                        <div>
                            <h4>Call Us</h4>
                            <p style="color: var(--text-gray);">+254 712 345 678</p>
                        </div>
                    </div>
                    <div class="card" style="display: flex; align-items: center; gap: 1.5rem;">
                        <div class="stat-icon warning"><i class="ph ph-map-pin"></i></div>
                        <div>
                            <h4>Visit Us</h4>
                            <p style="color: var(--text-gray);">123 SACCO Plaza, Murang'a</p>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label>Your Name</label>
                                <input type="text" class="form-control" placeholder="John Doe">
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="john@example.com">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" placeholder="How can we help?">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" rows="5" placeholder="Your message here..."></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" style="align-self: flex-start; padding: 1rem 3rem;">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
