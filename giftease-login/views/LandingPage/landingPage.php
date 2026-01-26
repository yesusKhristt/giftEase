<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GiftEase - Global Gift Delivery Platform</title>

    <link rel="stylesheet" href="public/landingpagestyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Replaced dashboard structure with clean landing page header  -->
    <header
        style="background: white; padding: 20px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.1); position: sticky; top: 0; z-index: 1000;">
        <div
            style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <img src="resources/iconL.png" style="width:50px; height:50px;" class="logo_img">
                <div class="gift">
                    gift<span class="Ease">Ease
                    </span>
                </div>
            </div>
            <nav style="display: flex; gap: 30px; align-items: center;">
                <a href="#features" style="color: #032e3f; font-weight: 500; text-decoration: none;">Features</a>
                <a href="#how-it-works" style="color: #032e3f; font-weight: 500; text-decoration: none;">How It
                    Works</a>
                <a href="#stakeholders" style="color: #032e3f; font-weight: 500; text-decoration: none;">For
                    Business</a>
                <a href="#" style="color: #032e3f; font-weight: 500; text-decoration: none;">Browse Gifts</a>
            </nav>
        </div>
    </header>

    <!-- Converted to full-width landing page layout  -->
    <main style="background: white;">
        <!-- Hero Section  -->
        <section
            style="background: linear-gradient(135deg, #fff 0%, #fedbd2 100%); padding: 80px 20px; text-align: center;">
            <div style="max-width: 1200px; margin: 0 auto;">
                <div
                    style="background: #d03c2e; color: white; padding: 8px 20px; border-radius: 25px; display: inline-block; margin-bottom: 30px; font-size: 14px; font-weight: 600;">
                    Gift Delivery Platform
                </div>
                <h1 style="font-size: 48px; font-weight: 700; color: #032e3f; margin-bottom: 20px; line-height: 1.2;">
                    Send Love <span style="color: #d03c2e;">Anywhere</span><br>
                    and Everywhere
                </h1>
                <p
                    style="font-size: 18px; color: #666; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
                    Browse, customize, and send personalized gifts globally through our comprehensive platform
                    connecting
                    customers, vendors, delivery partners, and wrapping services.
                </p>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="?action=handleSignup&type=client" class="btn2" style="padding: 15px 30px;">Start Shopping
                    </a>
                    <a href="?action=handleSignup&type=staff" class="btn1" style="padding: 15px 30px;">Join as Staff</a>
                </div>
            </div>
        </section>

        <!-- Stats Section  -->
        <section style="background: #d03c2e; padding: 60px 20px; color: white;">
            <div style="max-width: 1200px; margin: 0 auto;">
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px; text-align: center;">
                    <div>
                        <div style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">190+</div>
                        <div style="font-size: 18px; opacity: 0.9;">Countries Served</div>
                    </div>
                    <div>
                        <div style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">50K+</div>
                        <div style="font-size: 18px; opacity: 0.9;">Happy Customers</div>
                    </div>
                    <div>
                        <div style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">1M+</div>
                        <div style="font-size: 18px; opacity: 0.9;">Gifts Delivered</div>
                    </div>
                    <div>
                        <div style="font-size: 48px; font-weight: 700; margin-bottom: 10px;">99.8%</div>
                        <div style="font-size: 18px; opacity: 0.9;">On-Time Delivery</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section  -->
        <section id="how-it-works" style="padding: 80px 20px; background: #f9f9f9;">
            <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
                <h2 style="font-size: 36px; font-weight: 700; color: #032e3f; margin-bottom: 15px;">How It Works</h2>
                <p style="font-size: 18px; color: #666; margin-bottom: 60px;">Simple steps to send the perfect gift</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 40px;">
                    <div style="text-align: center;">
                        <div
                            style="width: 80px; height: 80px; background: #d03c2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; margin: 0 auto 20px;">
                            1</div>
                        <h3 style="font-size: 24px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Browse &
                            Select</h3>
                        <p style="color: #666; line-height: 1.6;">Choose from thousands of curated gifts from verified
                            vendors worldwide</p>
                    </div>
                    <div style="text-align: center;">
                        <div
                            style="width: 80px; height: 80px; background: #d03c2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; margin: 0 auto 20px;">
                            2</div>
                        <h3 style="font-size: 24px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Customize
                        </h3>
                        <p style="color: #666; line-height: 1.6;">Personalize with messages, wrapping options, and
                            delivery preferences</p>
                    </div>
                    <div style="text-align: center;">
                        <div
                            style="width: 80px; height: 80px; background: #d03c2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; margin: 0 auto 20px;">
                            3</div>
                        <h3 style="font-size: 24px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Process &
                            Wrap</h3>
                        <p style="color: #666; line-height: 1.6;">Our network handles procurement, wrapping, and quality
                            assurance</p>
                    </div>
                    <div style="text-align: center;">
                        <div
                            style="width: 80px; height: 80px; background: #d03c2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: 700; margin: 0 auto 20px;">
                            4</div>
                        <h3 style="font-size: 24px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Deliver</h3>
                        <p style="color: #666; line-height: 1.6;">Track your gift in real-time until it reaches your
                            loved one</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section  -->
        <section id="features" style="padding: 80px 20px; background: white;">
            <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
                <h2 style="font-size: 36px; font-weight: 700; color: #032e3f; margin-bottom: 15px;">Why Choose GiftEase?
                </h2>
                <p style="font-size: 18px; color: #666; margin-bottom: 60px;">Our platform brings together everything
                    you need for seamless global gift delivery</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">

                    <div class="card">
                        <div
                            style="width: 60px; height: 60px; background: #d03c2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-heart" style="font-size: 24px;"></i>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">
                            Personalization</h3>
                        <p style="color: #666; line-height: 1.6;">Customize gifts with personal messages, wrapping
                            options, and special delivery instructions</p>
                    </div>
                    <div class="card">
                        <div
                            style="width: 60px; height: 60px; background: #d03c2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-box" style="font-size: 24px;"></i>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Quality
                            Vendors</h3>
                        <p style="color: #666; line-height: 1.6;">Curated selection of trusted vendors offering unique
                            and high-quality gift options</p>
                    </div>
                    

                    <div class="card">
                        <div
                            style="width: 60px; height: 60px; background: #d03c2e; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-star" style="font-size: 24px;"></i>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Premium
                            Experience</h3>
                        <p style="color: #666; line-height: 1.6;">White-glove service with premium wrapping, express
                            delivery, and 24/7 customer support</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stakeholders Section  -->
        <section id="stakeholders" style="padding: 80px 20px; background: #f9f9f9;">
            <div style="max-width: 1200px; margin: 0 auto; text-align: center;">
                <h2 style="font-size: 36px; font-weight: 700; color: #032e3f; margin-bottom: 15px;">Join Our Network
                </h2>
                <p style="font-size: 18px; color: #666; margin-bottom: 60px;">Multiple ways to be part of the GiftEase
                    ecosystem</p>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
                    <div class="card" style="text-align: center;">
                        <div
                            style="width: 60px; height: 60px; background: #3b82f6; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-store" style="font-size: 24px;"></i>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Vendors</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">Sell your products to a global
                            audience through our platform</p>

                    </div>
                    <div class="card" style="text-align: center;">
                        <div
                            style="width: 60px; height: 60px; background: #10b981; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-shipping-fast" style="font-size: 24px;"></i>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Delivery
                            Partners</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">Become part of our reliable
                            delivery network</p>

                    </div>
                    <div class="card" style="text-align: center;">
                        <div
                            style="width: 60px; height: 60px; background: #8b5cf6; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                            <i class="fas fa-gift" style="font-size: 24px;"></i>
                        </div>
                        <h3 style="font-size: 20px; font-weight: 600; color: #032e3f; margin-bottom: 15px;">Wrapping
                            Services</h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">Offer premium wrapping and
                            customization services</p>

                    </div>

                </div>
            </div>
        </section>

        <!-- CTA Section  -->
        <section style="background: #032e3f; padding: 80px 20px; text-align: center; color: white;">
            <div style="max-width: 800px; margin: 0 auto;">
                <h2 style="font-size: 36px; font-weight: 700; margin-bottom: 20px;">Ready to Send Your First Gift?</h2>
                <p style="font-size: 18px; opacity: 0.9; margin-bottom: 40px;">giftEase... The gift that keeps on giving
                </p>

            </div>
        </section>
    </main>

<script src="main.js"></script>
</body>
</html>
