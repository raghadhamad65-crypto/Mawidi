<?php 
include 'config.php';

function h($value){
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

$stats_query = mysqli_query($conn, "
    SELECT 
        COUNT(*) AS total_doctors,
        COUNT(DISTINCT specialization) AS total_specializations
    FROM doctors
");

$stats = mysqli_fetch_assoc($stats_query);

$result = mysqli_query($conn, "SELECT * FROM doctors ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الأطباء | موعدي</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="doctors-page">

<?php include 'navbar.php'; ?>

<main class="doctors-page-wrap">

    <section class="premium-doctors-hero">

        <div class="hero-medical-icon">🩺</div>

        <div class="hero-content">
            <div class="hero-badge">
            </div>

            <h1>الأطباء المتاحون</h1>

            <p>
                اختر الطبيب المناسب واحجز موعدك بسهولة وأمان
            </p>

          <div class="hero-info-cards">

    <div class="hero-info-card">
        <div class="info-circle"></div>
        <strong><?php echo h($stats['total_doctors']); ?></strong>
        <p>طبيب متاح</p>
    </div>

    <div class="hero-info-card">
        <div class="info-circle"></div>
        <strong><?php echo h($stats['total_specializations']); ?></strong>
        <p>تخصص طبي</p>
    </div>

    <div class="hero-info-card">
        <div class="info-circle"></div>
        <strong>24/7</strong>
        <p>خدمة متواصلة</p>
    </div>

</div>
    </section>

    <section class="premium-doctors-section">

        <div class="premium-section-title">
            <div class="title-line"></div>
            <h2>اختر طبيبك</h2>
            <div class="title-line"></div>
            <p>نخبة من الأطباء المتخصصين لخدمتك</p>
        </div>

        <div class="premium-doctor-grid">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="premium-doctor-card">

                    <div class="available-badge">
                        <span></span>
                        متاح الآن
                    </div>

                    <div class="doctor-img-box">
                        <img 
                            src="images/<?php echo h($row['image']); ?>" 
                            alt="<?php echo h($row['doctor_name']); ?>"
                        >
                        <div class="verified-icon">🛡️</div>
                    </div>

                    <h3><?php echo h($row['doctor_name']); ?></h3>

                    <div class="specialty-pill">
                        <?php echo h($row['specialization']); ?>
                    </div>

                    <div class="doctor-meta">
                        <span>⭐ 4.9</span>
                        <span></span>
                        <span> سنوات خبرة</span>
                    </div>

                    <div class="doctor-phone">
                        <span>📞</span>
                        <?php echo h($row['phone']); ?>
                    </div>

                    <a 
                        href="book.php?doctor_id=<?php echo h($row['id']); ?>" 
                        class="premium-book-btn"
                    >
                        احجز موعد
                        <span>📅</span>
                    </a>

                </div>

            <?php } ?>

        </div>

    </section>

   

</main>

<footer class="site-footer">

    <div class="footer-grid">

        <div class="footer-box">
            <h3>موعدي <span>🗓️</span></h3>
            <p>
                منصة ذكية لحجز وإدارة المواعيد الطبية
                بسهولة وأمان.
            </p>
        </div>

        <div class="footer-box">
            <h4>خدماتنا</h4>
            <a href="book.php">حجز موعد</a>
            <a href="#">إدارة المواعيد</a>
            <a href="#">اختيار الطبيب</a>
            <a href="contact.php">الدعم والمساعدة</a>
        </div>

        <div class="footer-box">
            <h4>روابط سريعة</h4>
            <a href="index.php">الرئيسية</a>
            <a href="doctors.php">الأطباء</a>
            <a href="book.php">احجز موعد</a>
            <a href="#">مواعيدي</a>
        </div>

        <div class="footer-box">
            <h4>تواصل معنا</h4>
            <p>📞 0590000000</p>
            <p>✉️ info@mawidi.com</p>
        </div>

    </div>

    <div class="footer-copy">
        © 2026 موعدي - جميع الحقوق محفوظة
    </div>

</footer>

</body>
</html>