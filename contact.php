<?php
include 'config.php';

$message_status = "";

if(isset($_POST['send'])){
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO contacts (full_name, email, message)
            VALUES ('$full_name', '$email', '$message')";

    if(mysqli_query($conn, $sql)){
        $message_status = "تم إرسال رسالتك بنجاح ✅";
    } else {
        $message_status = "حدث خطأ أثناء الإرسال ❌";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تواصل معنا | موعدي</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="contact-page">

<?php include 'navbar.php'; ?>

<main class="contact-page-wrap">

    <section class="contact-hero">
        <div class="contact-hero-content">
            <h1>تواصل معنا</h1>
            <p>نسعد بتواصلك معنا لأي استفسار، اقتراح، أو ملاحظة</p>
        </div>
    </section>

    <section class="contact-main-section">
        <div class="contact-grid">

            <div class="contact-info-panel">
                <div class="contact-panel-head">
                    <h2>بيانات التواصل</h2>
                    <p>يمكنك التواصل معنا مباشرة عبر الوسائل التالية</p>
                </div>

                <div class="contact-info-list">

                    <div class="contact-info-card">
                        <div class="contact-icon">📞</div>
                        <div>
                            <h3>رقم الهاتف</h3>
                            <p>0590000000</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">✉️</div>
                        <div>
                            <h3>البريد الإلكتروني</h3>
                            <p>info@mawidi.com</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">⏰</div>
                        <div>
                            <h3>ساعات العمل</h3>
                            <p>يوميًا من 8:00 صباحًا حتى 8:00 مساءً</p>
                        </div>
                    </div>

                    <div class="contact-info-card">
                        <div class="contact-icon">📍</div>
                        <div>
                            <h3>العنوان</h3>
                            <p>فلسطين - منصة موعدي الطبية</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="contact-form-panel">
                <div class="contact-panel-head">
                    <h2>أرسل رسالتك</h2>
                    <p>املأ النموذج التالي وسنقوم بالرد عليك في أقرب وقت</p>
                </div>

                <form method="POST" class="contact-form-pro">

                    <?php if($message_status != ""){ ?>
                        <div class="contact-success-msg"><?php echo $message_status; ?></div>
                    <?php } ?>

                    <div class="contact-form-group">
                        <label>الاسم الكامل</label>
                        <div class="contact-input-box">
                            <span>👤</span>
                            <input type="text" name="full_name" placeholder="أدخل اسمك الكامل" required>
                        </div>
                    </div>

                    <div class="contact-form-group">
                        <label>البريد الإلكتروني</label>
                        <div class="contact-input-box">
                            <span>📧</span>
                            <input type="email" name="email" placeholder="example@email.com" required>
                        </div>
                    </div>

                    <div class="contact-form-group">
                        <label>الرسالة</label>
                        <div class="contact-textarea-box">
                            <span>📝</span>
                            <textarea name="message" placeholder="اكتب رسالتك هنا..." required></textarea>
                        </div>
                    </div>

                    <button type="submit" name="send" class="contact-submit-btn">
                        إرسال الرسالة
                        <span>➜</span>
                    </button>

                </form>
            </div>

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
            <a href="doctors.php">اختيار الطبيب</a>
            <a href="contact.php">الدعم والمساعدة</a>
        </div>

        <div class="footer-box">
            <h4>روابط سريعة</h4>
            <a href="index.php">الرئيسية</a>
            <a href="doctors.php">الأطباء</a>
            <a href="book.php">احجز موعد</a>
            <a href="my_appointments.php">مواعيدي</a>
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