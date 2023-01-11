<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Dynamic Website</title>
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header class="main">

        <nav>
            <a href="#" class="logo">
                <img src="images/logo1.png" />
            </a>
            <ul class="menu">
                <li><a href="#home" class="active">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
        <!-- <div class="f-img">
            <img src="images/bg.jpg.jpg" />
        </div> -->
        <div class="main-heading">
            <h1> Virtual Reality</h1>
            <p>It is possible for the client to get the desired result if he is very smart. Let them see that we drive. Flatter wrong!</p>
            <a class="main-btn" href="#">Contact</a>
        </div>
    </header>
    <section id="features" class="features">
        <div class="feature-container">
            <div class="feature-box">
                <div class="f-img">
                    <img src="images/info-icon1.png.png" />
                </div>
                <div class="f-text">
                    <h4>Web Development</h4>
                    <p>asdfghjikolkjhgfdsrtyuiokljhgf
                        drtyujnhb</p>
                    <a href="#" class="main-btn">Check</a>
                </div>
            </div>
            <div class="feature-box">
                <div class="f-img">
                    <img src="images/info-icon2.png.png" />
                </div>
                <div class="f-text">
                    <h4>Software Development</h4>
                    <p>sdjikoujhtfgdfghjijuhgytfhujh</p>
                    <a href="#" class="main-btn">Check</a>
                </div>
            </div>
            <div class="feature-box">
                <div class="f-img">
                    <img src="images/info-icon3.png.png" />
                </div>
                <div class="f-text">
                    <h4>App Development</h4>
                    <p>serdtfiojghfhjiklhgfchjkojiuhgytf</p>
                    <a href="#" class="main-btn">Check</a>
                </div>
            </div>

        </div>
    </section>
    <section id="about" class="about">
        <div class="about-img">
            <img src="images/about.png.png">
        </div>
        <div class="about-text">
            <h2>Start Tracking Your Statistics</h2>
            <p>qwertyuiop[p;lkjmnhgfdsfgyhujikljhgcfdxghkoiuhgydf
                xchjiuydfchjiufdcgvhjuyfgcvhujrfdcgvhyfdcfgvfcdgvhgfcvhjgfcvghgfcvghfcgvhfcvgfcgvf</p>
            <button class="main-btn">Read More</button>
        </div>
    </section>

    <footer id="contact" class="contact">
        <div class="contact-heading">
            <h1>Contact Us</h1>
            <p>dfghikolpiudfxcvghjuytrfdghujiytfgcvhjuygfvhygf</p>
        </div>
        <form action="userinformation.php" method="post">
            <input type="text" name="user" placeholder="Your Full Name" />
            <input type="email" name="email" placeholder="Your E-Mail" />
            <textarea name="message" placeholder="Type Your Message Here.........."></textarea>
            <button class="main-btn contact-btn" type="submit">Continue</button>
        </form>
    </footer>
</body>

</html>