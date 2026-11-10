
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>بيت أهلنا - لوحة الإدارة</title>

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f6fa;
    color: #17243a;
    padding: 25px 15px;
}

.container {
    max-width: 1150px;
    margin: auto;
}

header {
    background: linear-gradient(135deg,#101c35,#29466e);
    color: white;
    padding: 38px 20px;
    text-align: center;
    border-radius: 18px;
    margin-bottom: 30px;
}

header h1 {
    font-size: 30px;
    margin-bottom: 12px;
}

header p {
    color: #d5dfed;
    line-height: 1.8;
}

.heading {
    margin: 25px 0;
    font-size: 22px;
}

.gallery {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 22px;
}

.card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px #17243a12;
    border: 1px solid #e7ebf1;
    transition: .3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px #17243a20;
}

.photo {
    height: 260px;
    background: #e9edf3;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.photo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    cursor: pointer;
}

.placeholder {
    text-align: center;
    color: #8792a4;
    line-height: 2;
}

.placeholder span {
    display: block;
    font-size: 40px;
}

.info {
    padding: 20px;
}

.info h3 {
    color: #192e4d;
    font-size: 19px;
    margin-bottom: 9px;
}

.info p {
    color: #7d8796;
    font-size: 14px;
    line-height: 1.8;
}

footer {
    text-align: center;
    margin-top: 35px;
    color: #929cac;
    font-size: 13px;
}

#viewer {
    display: none;
    position: fixed;
    inset: 0;
    background: #000e;
    z-index: 100;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

#viewer img {
    max-width: 95%;
    max-height: 90vh;
    object-fit: contain;
}

#viewer button {
    position: absolute;
    top: 20px;
    left: 25px;
    background: white;
    border: none;
    padding: 10px 17px;
    border-radius: 8px;
    font-size: 20px;
    cursor: pointer;
}

@media(max-width:650px) {
    .gallery {
        grid-template-columns: 1fr;
    }

    header h1 {
        font-size: 24px;
    }

    .photo {
        height: 220px;
    }
}
</style>
</head>

<body>

<div class="container">

<header>
    <h1>بيت أهلنا</h1>
    <p>نظام الإدارة والتحكم بالمنصة الإلكترونية</p>
</header>

<h2 class="heading">واجهات نظام الإدارة</h2>

<div class="gallery">

    <div class="card">
        <div class="photo">
            <div class="placeholder">
                <span>🔐</span>
                مكان صورة تسجيل الدخول
            </div>
        </div>
        <div class="info">
            <h3>01 - تسجيل دخول الأدمن</h3>
            <p>واجهة الدخول إلى النظام الإداري.</p>
        </div>
    </div>

    <div class="card">
        <div class="photo">
            <div class="placeholder">
                <span>🏠</span>
                مكان صورة الصفحة الرئيسية
            </div>
        </div>
        <div class="info">
            <h3>02 - الصفحة الرئيسية</h3>
            <p>الواجهة الرئيسية لنظام إدارة بيت أهلنا.</p>
        </div>
    </div>

    <div class="card">
        <div class="photo">
            <div class="placeholder">
                <span>📂</span>
                مكان صورة إدارة الأقسام
            </div>
        </div>
        <div class="info">
            <h3>03 - إدارة الأقسام</h3>
            <p>إضافة وتعديل وحذف أقسام المطعم.</p>
        </div>
    </div>

    <div class="card">
        <div class="photo">
            <div class="placeholder">
                <span>👥</span>
                مكان صورة إدارة المستخدمين
            </div>
        </div>
        <div class="info">
            <h3>04 - إدارة المستخدمين</h3>
            <p>عرض وإدارة حسابات المستخدمين.</p>
        </div>
    </div>

    <div class="card">
        <div class="photo">
            <div class="placeholder">
                <span>🛒</span>
                مكان صورة إدارة الطلبات
            </div>
        </div>
        <div class="info">
            <h3>05 - إدارة الطلبات</h3>
            <p>متابعة الطلبات وحالات تجهيزها وتسليمها.</p>
        </div>
    </div>

    <div class="card">
        <div class="photo">
            <div class="placeholder">
                <span>📊</span>
                مكان صورة لوحة التحكم
            </div>
        </div>
        <div class="info">
            <h3>06 - لوحة التحكم والإحصائيات</h3>
            <p>متابعة المبيعات والإحصائيات وأداء المنصة.</p>
        </div>
    </div>

</div>

<footer>
    جميع الحقوق محفوظة © بيت أهلنا
</footer>

</div>

<div id="viewer" onclick="closeImage()">
    <button onclick="closeImage()">✕</button>
    <img id="largeImage" src="" alt="صورة مكبرة">
</div>

<script>
function closeImage() {
    document.getElementById("viewer").style.display = "none";
}

document.querySelectorAll(".photo").forEach(function(box) {
    box.addEventListener("click", function() {
        const img = box.querySelector("img");
        if (!img) return;

        document.getElementById("largeImage").src = img.src;
        document.getElementById("viewer").style.display = "flex";
    });
});
</script>

</body>
</html>
