<?php
include 'config.php';

$message = "";

if (isset($_POST['book'])) {
    $patient_name = $_POST['patient_name'];
    $phone = $_POST['phone'];
    $doctor_id = $_POST['doctor_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $check = mysqli_query($conn, "
        SELECT * FROM appointments
        WHERE doctor_id = '$doctor_id'
        AND appointment_date = '$appointment_date'
        AND appointment_time = '$appointment_time'
    ");

    if (mysqli_num_rows($check) > 0) {
        $message = "هذا الموعد محجوز مسبقاً، اختاري وقت آخر ❌";
    } else {
        $sql = "INSERT INTO appointments 
        (patient_name, phone, doctor_id, appointment_date, appointment_time, status)
        VALUES 
        ('$patient_name', '$phone', '$doctor_id', '$appointment_date', '$appointment_time', 'قيد الانتظار')";

        if (mysqli_query($conn, $sql)) {
            $message = "تم حجز الموعد بنجاح ✅";
        } else {
            $message = "حدث خطأ أثناء الحجز";
        }
    }
}

$doctors = mysqli_query($conn, "SELECT * FROM doctors");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">

    <title>حجز موعد | موعدي</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="book-page">
<?php include 'navbar.php'; ?>

<section class="book-hero">
    <div class="book-hero-content">
        <h1>احجز موعدك</h1>
        <p>املأ البيانات التالية لتأكيد حجز موعدك الطبي بسهولة</p>
    </div>
</section>
<section class="premium-booking-section">

    <div class="premium-booking-card">

        <div class="booking-card-header">
            <span>📅</span>
            <h2>بيانات الحجز</h2>
            <p>أدخل البيانات التالية لتأكيد موعدك الطبي</p>
        </div>

        <form method="POST" class="premium-booking-form">

            <?php if ($message != "") { ?>
                <div class="success-msg"><?php echo $message; ?></div>
            <?php } ?>

            <div class="form-grid">

                <div class="form-group">
                    <label>اسم المريض</label>
                    <div class="input-box">
                        <span>👤</span>
                        <input type="text" name="patient_name" placeholder="أدخل اسم المريض" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>رقم الهاتف</label>
                    <div class="input-box">
                        <span>📞</span>
                        <input type="text" name="phone" placeholder="05xxxxxxxx" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>اختر الطبيب</label>
                    <div class="input-box">
                        <span>👨‍⚕️</span>
                        <select name="doctor_id" required>
                            <option value="">-- اختر الطبيب --</option>

                            <?php while ($row = mysqli_fetch_assoc($doctors)) { ?>
                                <option 
                                    value="<?php echo $row['id']; ?>"
                                    <?php if($selected_doctor_id == $row['id']) echo 'selected'; ?>
                                >
                                    <?php echo $row['doctor_name'] . " - " . $row['specialization']; ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>تاريخ الموعد</label>
                    <div class="input-box">
                        <span>📅</span>
                        <input type="date" name="appointment_date" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>وقت الموعد</label>
                    <div class="input-box">
                        <span>⏰</span>
                        <input type="time" name="appointment_time" required>
                    </div>
                </div>

            </div>

            <button type="submit" name="book" class="premium-book-btn">
                تأكيد الحجز
                <span>✔</span>
            </button>

        </form>

    </div>

</section>

</body>
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
            <a href="#">الأطباء</a>
            <a href="book.php">احجز موعد</a>
            <a href="#">مواعيدي</a>
        </div>

        <div class="footer-box">
            <h4>تواصل معنا</h4>
            <p>📞 0590000000</p>
            <p>✉️ info@mawidi.com</p>

            <div class="footer-social">
                <a href="#">f</a>
                <a href="#">◎</a>
                <a href="#">●</a>
                <a href="#">𝕏</a>
            </div>
        </div>

    </div>

    <div class="footer-copy">
        © 2026 موعدي - جميع الحقوق محفوظة
    </div>

</footer>
</html>