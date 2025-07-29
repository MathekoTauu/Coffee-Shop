<?php
// Start session at the very top if needed
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Corner | Artisanal Coffee Experience</title>
    <style>
        :root {
            --coffee-dark: #2A2118;
            --coffee-medium: #6F4E37;
            --coffee-light: #C4A484;
            --cream: #F8F5F0;
            --accent-gold: #D4AF37;
            --text-dark: #333;
            --text-light: #F8F5F0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'DM Sans', sans-serif;
        }
        
        body {
            background-color: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }
        
        /* Hero Section */
        .landing-section {
            position: relative;
            height: 100vh;
            min-height: 600px;
            overflow: hidden;
        }
        
        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .background-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(42, 33, 24, 0.4);
        }
        
        .background-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }
        
        .landing {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 90%;
            max-width: 800px;
            color: var(--text-light);
            animation: fadeIn 1.5s ease-out;
        }
        
        .landing h1 {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .landing .logo {
            height: 100px;
            margin: 2rem 0;
            filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.5));
        }
        
        .landing p {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }
        
        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background-color: var(--accent-gold);
            color: var(--coffee-dark);
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            border: 2px solid var(--accent-gold);
            font-size: 1.1rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .btn:hover {
            background-color: transparent;
            color: var(--accent-gold);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
        }
        
        /* Featured Items */
        .featured-items {
            padding: 5rem 2rem;
            background-color: var(--cream);
            text-align: center;
        }
        
        .featured-items h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--coffee-medium);
            margin-bottom: 3rem;
            position: relative;
            display: inline-block;
        }
        
        .featured-items h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background-color: var(--accent-gold);
        }
        
        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto 3rem;
        }
        
        .featured-item {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .featured-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .featured-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            object-position: center;
        }
        
        .featured-item h3 {
            padding: 1.5rem;
            font-size: 1.5rem;
            color: var(--coffee-dark);
        }
        
        .welcome-message {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--coffee-dark);
            position: relative;
        }
        
        .welcome-message::before {
            content: '"';
            position: absolute;
            top: -30px;
            left: 20px;
            font-family: 'Playfair Display', serif;
            font-size: 8rem;
            color: var(--accent-gold);
            opacity: 0.2;
            line-height: 1;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translate(-50%, -40%); }
            to { opacity: 1; transform: translate(-50%, -50%); }
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .landing h1 {
                font-size: 2.5rem;
            }
            
            .landing p {
                font-size: 1.2rem;
            }
            
            .featured-items {
                padding: 3rem 1rem;
            }
            
            .featured-items h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <section class="landing-section">
        <div class="background-image">
            <img src="https://i.pinimg.com/736x/eb/bb/b9/ebbbb9da81c8f96428801dd72fb2af02.jpg" alt="Coffee Shop Interior">
        </div>
        <div class="landing">
            <h1>Discover the Art of Coffee</h1>
        
            <p>Where every cup tells a story</p>
            <a href="menu.php" class="btn">Explore Our Menu</a>
        </div>
    </section>

    <section class="featured-items">
        <h2>Our Signature Creations</h2>
        <div class="featured-grid">
            <div class="featured-item">
                <img src="https://i.pinimg.com/1200x/f1/4e/70/f14e7007806beed9f34ff9cf733e5e52.jpg" alt="Espresso">
                <h3>Classic Espresso</h3>
            </div>
            <div class="featured-item">
                <img src="https://i.pinimg.com/736x/36/79/38/367938f9213ae2fc3cd4ec3b3f6e8199.jpg" alt="Latte">
                <h3>Velvet Latte</h3>
            </div>
            <div class="featured-item">
                <img src="https://i.pinimg.com/1200x/4d/a5/7e/4da57e8ed551e7a6af65ccc64b427272.jpg" alt="Muffin">
                <h3>Homemade Muffins</h3>
            </div>
        </div>
        <div class="welcome-message">
            <p>At Coffee Corner, we're passionate about crafting exceptional coffee experiences. Our beans are ethically sourced from the world's finest plantations, roasted to perfection, and brewed with care by our expert baristas. Whether you're seeking your morning pick-me-up or a cozy afternoon retreat, every visit promises warmth, quality, and that perfect cup.</p>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
</body>
</html>