<?php
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Story | Brew Haven Coffee</title>
    <style>
        :root {
            --coffee-dark: #2A2118;
            --coffee-medium: #6F4E37;
            --coffee-light: #C4A484;
            --cream: #F8F5F0;
            --accent-gold: #D4AF37;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            color: var(--coffee-dark);
            line-height: 1.6;
        }
        
        .about-hero {
            background: linear-gradient(rgba(42, 33, 24, 0.7), rgba(42, 33, 24, 0.7)), 
                        url('https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--cream);
            padding: 0 2rem;
        }
        
        .hero-content h1 {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .hero-content p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .about-container {
            max-width: 1200px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--coffee-medium);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--accent-gold);
        }
        
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            margin-bottom: 4rem;
        }
        
        .about-text p {
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .about-image img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .value-card {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .value-card:hover {
            transform: translateY(-10px);
        }
        
        .value-icon {
            font-size: 2.5rem;
            color: var(--accent-gold);
            margin-bottom: 1rem;
        }
        
        .value-card h3 {
            font-family: 'Playfair Display', serif;
            color: var(--coffee-medium);
            margin-bottom: 1rem;
        }
        
        .team-section {
            background-color: var(--coffee-dark);
            color: var(--cream);
            padding: 4rem 2rem;
            margin-top: 4rem;
        }
        
        .team-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .team-member {
            text-align: center;
        }
        
        .team-member img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid var(--accent-gold);
            margin-bottom: 1rem;
        }
        
        .team-member h3 {
            font-family: 'Playfair Display', serif;
            margin-bottom: 0.5rem;
            color: var(--accent-gold);
        }
        
        .team-member p {
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            .about-content {
                grid-template-columns: 1fr;
            }
            
            .hero-content h1 {
                font-size: 2.5rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <section class="about-hero">
        <div class="hero-content">
            <h1>Our Story</h1>
            <p>Discover the passion behind every cup at Brew Haven Coffee</p>
        </div>
    </section>
    
    <div class="about-container">
        <section class="about-section">
            <h2 class="section-title">Who We Are</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>Founded in 2010, Brew Haven Coffee began as a small neighborhood café with a big dream - to serve exceptional coffee while fostering community connections. What started as a humble storefront has grown into a beloved local institution, but our core values remain unchanged.</p>
                    <p>Every morning, our master roasters carefully prepare small batches of specialty beans sourced directly from ethical growers around the world. We believe great coffee starts with respect - for the farmers who grow it, the land that nurtures it, and the people who enjoy it.</p>
                    <p>More than just a coffee shop, we're a gathering place where friendships are forged, ideas are born, and the simple pleasure of a perfect cup is celebrated daily.</p>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1463797221720-6b07e6426c24?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Our coffee shop interior">
                </div>
            </div>
        </section>
        
        <section class="values-section">
            <h2 class="section-title">Our Values</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Sustainable Sourcing</h3>
                    <p>We partner directly with farmers who use sustainable practices, ensuring fair wages and environmental stewardship.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Craft & Quality</h3>
                    <p>From bean to brew, every step is executed with precision and care to deliver an exceptional coffee experience.</p>
                </div>
                
                <div class="value-card">
                    <div class="value-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community</h3>
                    <p>We're committed to being more than a coffee shop - we're a welcoming space that brings people together.</p>
                </div>
            </div>
        </section>
    </div>
    
    <section class="team-section">
        <div class="team-container">
            <h2 class="section-title" style="color: var(--cream);">Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <img src="https://i.pinimg.com/736x/0f/69/1c/0f691cd77a8c6d90f07b35c10c95668f.jpg" alt="Sarah Johnson">
                    <h3>Sarah Johnson</h3>
                    <p>Founder & Head Roaster</p>
                </div>
                
                <div class="team-member">
                    <img src="https://i.pinimg.com/736x/0f/69/1c/0f691cd77a8c6d90f07b35c10c95668f.jpg" alt="Michael Chen">
                    <h3>Michael Chen</h3>
                    <p>Master Barista</p>
                </div>
                
                <div class="team-member">
                    <img src="https://i.pinimg.com/736x/0f/69/1c/0f691cd77a8c6d90f07b35c10c95668f.jpg" alt="Emma Rodriguez">
                    <h3>Emma Rodriguez</h3>
                    <p>Pastry Chef</p>
                </div>
                
                <div class="team-member">
                    <img src="https://i.pinimg.com/736x/0f/69/1c/0f691cd77a8c6d90f07b35c10c95668f.jpg" alt="David Wilson">
                    <h3>David Wilson</h3>
                    <p>Coffee Buyer</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>