<section id="home" class="hero" style="background: url('<?= ASSET; ?>/img/destinations/<?= $data['random_image']; ?>'); background-size: cover; background-repeat: no-repeat; background-position: center">
    <main class="content">
        <h1>Temukan <span>keajaiban</span><br>dunia bersama <span>Let's Travel!</span></h1>
        <a href="<?= BASEURL; ?>/destinations#modal" class="btn btn-primary cta">Mulai Petualangan Anda</a>
    </main>
</section>

<section class="about" id="about">
    <main class="content">
        <div class="card" onclick="window.location.href='<?= BASEURL; ?>/about';">
            <h2>Tentang Kami</h2>
            <p>Ini adalah sebuah website yang di buat untuk mempermudah para pengunjung yang ingin menikmati keindahan dunia.</p>
            <a href="<?= BASEURL; ?>/about" class="btn btn-primary cta">Lebih lanjut</a>
        </div>
        <div class="card" onclick="window.location.href='<?= BASEURL; ?>/about#ticket-about';">
            <h2>Tiket Kami</h2>
            <p>Masukkan destinasi dan tanggal perjalanan Anda, dan temukan tiket terbaik hanya dengan beberapa klik.</p>
            <a href="<?= BASEURL; ?>/about#ticket-about" class="btn btn-primary cta">Lebih lanjut</a>
        </div>
        <div class="card" onclick="window.location.href='<?= BASEURL; ?>/about#destination-info';">
            <h2>Informasi lengkap</h2>
            <p>Temukan informasi lengkap tentang keindahan dunia dari berbagai penjuru dunia.</p>
            <a href="<?= BASEURL; ?>/about#destination-info" class="btn btn-primary cta">Lebih lanjut</a>
        </div>
    </main>
</section>

<div class="top-destinations" id="top-destinations">
    <div class="title">
        <i class='bx bx-trending-up'></i>
        <h1>Top Destinations</h1>
        <p>3 Tempat wisata yang sedang populer saat ini</p>
    </div>
    <div class="content">
        <?php if ($data['topDestinations']) : ?>
            <input type="radio" name="slider" id="item-1" checked>
            <input type="radio" name="slider" id="item-2">
            <input type="radio" name="slider" id="item-3">
            <div class="carousel-inner">
                <?php foreach ($data['topDestinations'] as $index => $destination) : ?>
                    <label class="carousel-item" for="item-<?= $index + 1 ?>" id="card-<?= $index + 1 ?>">
                        <img src="<?= ASSET; ?>/img/destinations/<?= $destination['image']; ?>" alt="<?= $destination['name']; ?>">
                    </label>
                <?php endforeach; ?>
            </div>
            <div class="captions">
                <?php foreach ($data['topDestinations'] as $index => $destination) : ?>
                    <div class="caption-item" id="caption-<?= $index + 1 ?>">
                        <h2><?= $destination['name']; ?></h2>
                        <p><?= $destination['description']; ?></p>
                        <a href="<?= BASEURL; ?>/destinations/detail/<?= $destination['id']; ?>" class="btn btn-primary cta">Lebih lanjut</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <p>Destinasi tidak ditemukan</p>
        <?php endif; ?>
    </div>
</div>

<div class="contact" id="contact">
    <hr>
    <div class="title">
        <i class='bx bx-user-pin'></i>
        <h1>Contact</h1>
        <p>Hubungi apabila ada kendala pada layanan kami</p>
    </div>
    <div class="content">
        <form action="<?= ASSET; ?>/contact/send" method="POST">
            <div class="form-row">
                <div class="form-group half-width">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                </div>
                <div class="form-group half-width">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Your Subject" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" class="form-control" rows="5" id="message" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary cta">Send</button>
        </form>
    </div>
</div>

<?php include_once '../resources/templates/footer.php'; ?>