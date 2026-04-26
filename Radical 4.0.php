<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// ─── endpoint استعلام AJAX ───────────────────────────────
if (isset($_GET['ajax_verify'])) {
    header('Content-Type: application/json; charset=utf-8');
    
    if (!isset($pdo) || $pdo === null) {
        require_once 'includes/db.php';
    }
    
    $code = trim($_GET['ajax_verify']);
    
    if (!preg_match('/^\d{6}$/', $code)) {
        echo json_encode(['valid' => false, 'reason' => 'format']);
        exit;
    }
    
    try {
        $stmt = $pdo->prepare(
            "SELECT c.cert_code, c.barcode, c.status, c.issued_at, c.expires_at,
                    p.title AS product_title
             FROM certificates c
             LEFT JOIN products p ON p.id = c.product_id
             WHERE c.barcode = ?
               AND c.status = 'active'
             LIMIT 1"
        );
        $stmt->execute([$code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            echo json_encode([
                'valid'        => true,
                'cert_number'  => $row['cert_code'],
                'barcode'      => $row['barcode'],
                'product_title' => $row['product_title'] ?? '',
                'issued_at'    => $row['issued_at'],
                'expires_at'   => $row['expires_at']
            ]);
        } else {
            $stmt2 = $pdo->prepare(
                "SELECT status FROM certificates WHERE barcode = ? LIMIT 1"
            );
            $stmt2->execute([$code]);
            $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
            
            if ($row2) {
                echo json_encode(['valid' => false, 'reason' => $row2['status']]);
            } else {
                echo json_encode(['valid' => false, 'reason' => 'not_found']);
            }
        }
    } catch (Exception $e) {
        echo json_encode(['valid' => false, 'reason' => 'db_error', 'msg' => $e->getMessage()]);
    }
    exit;
}

if (isset($_GET['code'])) {
    header('Location: result.php?code=' . urlencode($_GET['code']));
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>جواهری مشاهیر | اصالت و اعتبار</title>
    <style>
        :root {
            --gold: #d4af37;
            --gold-light: #f3e5ab;
            --silver-metal: linear-gradient(135deg, #e0eaf5 0%, #b8c6db 50%, #8795a8 100%);
            --gold-metal: linear-gradient(135deg, #ffeb9b 0%, #d4af37 50%, #aa8000 100%);
            --bg-velvet-1: #030303;
            --bg-velvet-2: #08080a;
            --bg-velvet-3: #0a0505;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; outline: none; -webkit-tap-highlight-color: transparent; }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        body {
            font-family: system-ui, -apple-system, sans-serif;
            background: linear-gradient(-45deg, var(--bg-velvet-1), var(--bg-velvet-2), var(--bg-velvet-3), #000000);
            background-size: 400% 400%;
            animation: gradientMove 25s ease infinite;
            color: #e0e0e0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        #stars-canvas {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 0; pointer-events: none;
        }

        .main-wrapper {
            display: flex; flex-direction: column; width: 100%; max-width: 1000px;
            position: relative; z-index: 2; padding: 15px; gap: 20px;
        }

        @media (min-width: 768px) {
            .main-wrapper { align-items: center; justify-content: space-between; padding: 40px; }
        }

        .visual-section {
            position: relative; display: flex; justify-content: center; align-items: center;
            width: 100%; min-height: 370px; touch-action: pan-y;
        }

        #coin-3d-container {
            width: 380px; height: 380px; cursor: grab; z-index: 5;
            transition: transform 0.3s ease;
        }
        #coin-3d-container:active { cursor: grabbing; }

        #flip-btn {
            position: absolute;
            bottom: 10px;
            right: calc(50% - 190px);
            z-index: 10;
            background: linear-gradient(135deg, #1a1a1a, #0d0d0d);
            border: 1px solid #333;
            border-radius: 20px;
            color: var(--gold);
            font-size: 12px;
            padding: 7px 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.7), 0 0 0 1px rgba(212,175,55,0.1);
            transition: all 0.25s ease;
            user-select: none;
        }
        #flip-btn:hover {
            border-color: var(--gold);
            box-shadow: 0 4px 16px rgba(212,175,55,0.25);
        }
        #flip-btn:active {
            transform: scale(0.95);
        }
        #flip-btn .flip-icon {
            font-size: 15px;
            display: inline-block;
            transition: transform 0.5s ease;
        }
        #flip-btn.flipping .flip-icon {
            transform: rotate(45deg);
        }
        #flip-side-label {
            position: absolute;
            top: 10px;
            right: calc(50% - 190px);
            z-index: 10;
            background: rgba(0,0,0,0.55);
            backdrop-filter: blur(6px);
            border: 1px solid #2a2a2a;
            border-radius: 12px;
            color: #888;
            font-size: 11px;
            padding: 4px 12px;
            pointer-events: none;
            transition: all 0.3s;
        }

        .content-section { width: 100%; display: flex; justify-content: center; z-index: 5; }

        .content-card {
            background: rgba(10, 10, 12, 0.75); 
            backdrop-filter: blur(20px);
            border-radius: 20px; 
            padding: 25px 20px; 
            width: 100%; 
            max-width: 450px;
            text-align: center; 
            position: relative;
            box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08), 0 15px 40px rgba(0,0,0,0.9);
        }

        h1 {
            font-size: 38px; background: var(--gold-metal);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            letter-spacing: 1px; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); margin-bottom: 5px;
            cursor: pointer; user-select: none;
        }

        .subtitle { font-size: 14px; color: #888; margin-bottom: 20px; letter-spacing: 0.5px; }

        .verify-link {
            display: inline-block; background: var(--silver-metal); color: #111;
            padding: 12px 26px; border-radius: 20px; font-weight: 800; font-size: 15px;
            cursor: pointer; margin-bottom: 18px; text-decoration: none;
            box-shadow: 0 5px 12px rgba(0,0,0,0.6), inset 0 2px 0 rgba(255,255,255,0.7), inset 0 -3px 0 rgba(0,0,0,0.4);
            transition: all 0.2s;
        }
        .verify-link:active { transform: translateY(2px) scale(0.98); }

        .menu { display: flex; gap: 10px; justify-content: center; }
        .menu-btn {
            background: linear-gradient(135deg, rgba(40,40,40,0.9), rgba(20,20,20,0.9));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(80,80,80,0.5); 
            padding: 9px 20px; 
            border-radius: 14px;
            cursor: pointer; 
            font-size: 13px; 
            color: #aaa; 
            transition: all 0.25s;
            box-shadow: 0 3px 8px rgba(0,0,0,0.5), inset 0 1px 0 rgba(255,255,255,0.05);
        }
        .menu-btn:hover { 
            border-color: var(--gold); 
            color: var(--gold);
            background: linear-gradient(135deg, rgba(50,50,50,0.95), rgba(25,25,25,0.95));
        }

        .modal-overlay {
            display: none; position: fixed; inset: 0; background: rgba(0, 0, 0, 0.88);
            backdrop-filter: blur(12px); z-index: 1000; align-items: center; justify-content: center;
            padding: 15px; perspective: 1000px;
        }
        .modal-container {
            background: rgba(15, 15, 15, 0.97); 
            border: 1px solid rgba(60,60,60,0.6); 
            border-radius: 18px;
            width: 100%; max-width: 450px; padding: 28px 24px; position: relative; opacity: 0;
            transform: translateY(40px) scale(0.96); 
            filter: blur(4px);
            transition: all 0.35s cubic-bezier(0.25, 1, 0.5, 1);
            box-shadow: 0 20px 45px rgba(0,0,0,0.9), inset 0 0 20px rgba(255,255,255,0.02);
            backdrop-filter: blur(15px);
        }
        .modal-overlay.show .modal-container {
            opacity: 1; transform: translateY(0) scale(1); filter: blur(0);
        }
        .close-modal { position: absolute; top: 14px; left: 14px; color: #666; font-size: 19px; cursor: pointer; transition: color 0.25s;}
        .close-modal:hover { color: var(--gold); }
        .modal-title { color: var(--gold); margin-bottom: 22px; font-size: 17px; text-align: center; }

        .pin-container { 
            display: flex; 
            justify-content: center; 
            gap: 10px; 
            margin-bottom: 22px; 
            direction: ltr;
        }

        .pin-box {
            width: 52px; 
            height: 62px; 
            border-radius: 12px; 
            background: linear-gradient(180deg, #1a1a1a, #0a0a0a);
            border: 2px solid #555;
            color: transparent;
            font-size: 28px; 
            font-weight: bold; 
            text-align: center;
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.8), 0 4px 8px rgba(0,0,0,0.5);
            transition: all 0.25s ease; 
            position: relative; 
            overflow: hidden;
            font-family: monospace;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .pin-box .digit-display {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 28px;
            font-weight: bold;
        }

        .pin-box:focus, .pin-box.filled {
            border-color: var(--gold);
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.8), 0 0 10px rgba(212, 175, 55, 0.3);
        }

        .pin-box.success {
            border-color: #2ecc71; 
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.8), 0 0 15px rgba(46, 204, 113, 0.4);
        }
        .pin-box.success .digit-display {
            color: #2ecc71;
        }

        @keyframes slideUpBlur {
            0% { transform: translateY(25px); opacity: 0; filter: blur(3px); }
            100% { transform: translateY(0); opacity: 1; filter: blur(0); }
        }
        .digit-display.animate-num { 
            animation: slideUpBlur 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) forwards; 
        }
        
        .pin-box.spinning .digit-display { 
            color: var(--gold); 
            filter: blur(2px); 
        }

        .verify-btn {
            width: 100%; padding: 13px; background: linear-gradient(135deg, #555, #333);
            border: none; border-radius: 14px; font-weight: bold; color: #888;
            cursor: not-allowed; font-size: 15px; transition: all 0.3s;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5), inset 0 2px 0 rgba(255,255,255,0.1);
        }
        .verify-btn.ready {
            background: var(--gold-metal); color: #1a1500; cursor: pointer;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3), inset 0 2px 0 rgba(255,255,255,0.4), inset 0 -3px 0 rgba(0,0,0,0.2);
        }
        .verify-btn.ready:active { transform: translateY(2px); box-shadow: 0 2px 5px rgba(0,0,0,0.5); }

        .verify-message {
            margin-top: 15px;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            text-align: center;
        }
        .verify-message--success {
            background: rgba(46, 204, 113, 0.15);
            border: 1px solid rgba(46, 204, 113, 0.3);
            color: #2ecc71;
        }
        .verify-message--error {
            background: rgba(231, 76, 60, 0.15);
            border: 1px solid rgba(231, 76, 60, 0.3);
            color: #e74c3c;
        }

        .storm-warning {
            position: fixed; top: 20%; left: 50%; transform: translateX(-50%);
            background: rgba(200, 0, 0, 0.8); color: white; padding: 10px 30px;
            border-radius: 10px; font-weight: bold; font-size: 24px;
            z-index: 9999; pointer-events: none; opacity: 0;
            transition: opacity 0.3s; letter-spacing: 2px; box-shadow: 0 0 30px red;
        }
        body.storm-mode { background: radial-gradient(circle, #3a0000 0%, #000 100%); }

        footer { text-align: center; margin-top: auto; padding: 20px; font-size: 12px; color: #444; z-index: 2;}

        /* درباره ما */
        .about-section {
            margin-bottom: 20px;
            padding-bottom: 18px;
            border-bottom: 1px solid #222;
        }
        .about-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .about-section h3 {
            color: var(--gold);
            font-size: 14px;
            margin-bottom: 10px;
            text-align: right;
        }
        .about-section p {
            color: #ccc;
            font-size: 13px;
            line-height: 1.7;
            text-align: justify;
        }
        .contact-info {
            color: #aaa;
            font-size: 12px;
            line-height: 1.8;
            text-align: right;
        }
        .social-icons {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 12px;
        }
        .social-icon {
            position: relative;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #2a2a2a, #1a1a1a);
            border: 1px solid #333;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 18px;
        }
        .social-icon:hover {
            border-color: var(--gold);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(212,175,55,0.3);
        }
        .social-icon .tooltip {
            position: absolute;
            bottom: 45px;
            background: rgba(0,0,0,0.9);
            color: var(--gold);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
            border: 1px solid #333;
        }
        .social-icon:hover .tooltip {
            opacity: 1;
        }

        /* فرم تماس */
        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            text-align: right;
        }
        .form-group label {
            font-size: 12px;
            color: #888;
        }
        .form-group input,
        .form-group textarea {
            background: rgba(20,20,20,0.8);
            border: 1px solid #333;
            border-radius: 10px;
            padding: 10px 12px;
            color: #ddd;
            font-size: 13px;
            font-family: system-ui, sans-serif;
            transition: border-color 0.25s;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--gold);
        }
        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }
        .submit-contact-btn {
            background: var(--gold-metal);
            border: none;
            border-radius: 12px;
            padding: 11px;
            color: #1a1500;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 12px rgba(212,175,55,0.3);
        }
        .submit-contact-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(212,175,55,0.4);
        }
        .submit-contact-btn:active {
            transform: translateY(0);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0); }
            33% { transform: translateY(-8px) translateX(5px); }
            66% { transform: translateY(5px) translateX(-5px); }
        }
        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: radial-gradient(circle, rgba(212,175,55,0.8), transparent);
            border-radius: 50%;
            pointer-events: none;
            animation: float 4s ease-in-out infinite;
            box-shadow: 0 0 6px rgba(212,175,55,0.6);
        }
    </style>
</head>
<body>

<canvas id="stars-canvas"></canvas>
<div class="storm-warning" id="stormWarning">⚠️ ورود به منطقه ممنوعه ⚠️</div>

<div class="main-wrapper">
    <div class="visual-section">
        <div id="coin-3d-container"></div>
        <div id="flip-side-label">طرف رو (نقره)</div>
        <button id="flip-btn" title="چرخش طرح سکه">
            <span class="flip-icon">⟳</span>
            <span id="flip-btn-text">نمایش پشت</span>
        </button>
    </div>

    <div class="content-section">
        <div class="content-card">
            <h1 id="brandTitle">جواهری مشاهیر</h1>
            <div class="subtitle">تضمین اصالت و درخشش ابدی</div>

            <div class="verify-link" onclick="openModal('verifyModal')">استعلام شناسنامه دیجیتال</div>

            <div class="menu">
                <div class="menu-btn" onclick="openModal('aboutModal')">درباره ما</div>
                <div class="menu-btn" onclick="openModal('contactModal')">تماس با ما</div>
            </div>
        </div>
    </div>
</div>

<footer>طراحی و پیاده سازی الگوریتم گروه هنری اقاقیا 1388-1405</footer>

<div id="verifyModal" class="modal-overlay" onclick="closeModal(event, 'verifyModal')">
    <div class="modal-container" onclick="event.stopPropagation()">
        <span class="close-modal" onclick="closeModal(event, 'verifyModal')">✕</span>
        <h2 class="modal-title">تایید اصالت کالا</h2>
        <form id="verifyForm" action="result.php" method="get">
            <div class="pin-container" id="pinContainer"></div>
            <input type="hidden" name="code" id="fullCodeInput">
            <button type="button" id="submitBtn" class="verify-btn">بررسی اصالت</button>
            <div id="verifyMessage" class="verify-message" style="display:none;"></div>
        </form>
    </div>
</div>

<div id="aboutModal" class="modal-overlay" onclick="closeModal(event, 'aboutModal')">
    <div class="modal-container" onclick="event.stopPropagation()" style="max-width: 500px; max-height: 85vh; overflow-y: auto;">
        <span class="close-modal" onclick="closeModal(event, 'aboutModal')">✕</span>
        <h2 class="modal-title">درباره جواهری مشاهیر</h2>
        
        <div class="about-section">
            <h3>معرفی</h3>
            <p>جواهری مشاهیر با بیش از نیم قرن تجربه درخشان، همواره اصالت و کیفیت را سرلوحه کار خود قرار داده است. شناسنامه دیجیتال تضمین می‌کند قطعه شما کاملاً اصل و دارای ضمانت‌نامه معتبر است.</p>
        </div>

        <div class="about-section">
            <h3>راه‌های ارتباطی</h3>
            <div class="contact-info">
                📍 خراسان رضوی، نیشابور، صد متر مانده به آرامگاه خیام<br>
                📞 تلفن: 05142214956<br>
                ✉️ ایمیل: info@mashahirid.ir
            </div>
        </div>

        <div class="about-section">
            <h3>شبکه‌های اجتماعی</h3>
            <div class="social-icons">
                <div class="social-icon" onclick="window.open('https://instagram.com/mashahirid', '_blank')">
                    <span>📷</span>
                    <div class="tooltip">اینستاگرام</div>
                </div>
                <div class="social-icon" onclick="window.open('https://t.me/mashahirid', '_blank')">
                    <span>✈️</span>
                    <div class="tooltip">تلگرام</div>
                </div>
                <div class="social-icon" onclick="window.open('https://wa.me/989123456789', '_blank')">
                    <span>💬</span>
                    <div class="tooltip">واتساپ</div>
                </div>
                <div class="social-icon" onclick="window.open('https://mashahirid.ir', '_blank')">
                    <span>🌐</span>
                    <div class="tooltip">وب‌سایت</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contactModal" class="modal-overlay" onclick="closeModal(event, 'contactModal')">
    <div class="modal-container" onclick="event.stopPropagation()">
        <span class="close-modal" onclick="closeModal(event, 'contactModal')">✕</span>
        <h2 class="modal-title">تماس با ما</h2>
        <form class="contact-form" onsubmit="handleContactSubmit(event)">
            <div class="form-group">
                <label>نام و نام خانوادگی</label>
                <input type="text" required placeholder="نام خود را وارد کنید">
            </div>
            <div class="form-group">
                <label>شماره تماس</label>
                <input type="tel" required placeholder="09xxxxxxxxx">
            </div>
            <div class="form-group">
                <label>ایمیل</label>
                <input type="email" placeholder="example@email.com">
            </div>
            <div class="form-group">
                <label>پیام شما</label>
                <textarea required placeholder="پیام خود را بنویسید..."></textarea>
            </div>
            <button type="submit" class="submit-contact-btn">ارسال پیام</button>
        </form>
    </div>
</div>

<script>
    // --- ستاره‌های جادویی ---
    const canvas = document.getElementById('stars-canvas');
    const ctx = canvas.getContext('2d');
    let width, height, stars;
    let isStorm = false;

    function initStars() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
        stars = [];
        for (let i = 0; i < 50; i++) {
            stars.push({
                x: Math.random() * width, y: Math.random() * height,
                radius: Math.random() * 1.5 + 0.4,
                vx: (Math.random() - 0.5) * 0.4, vy: -Math.random() * 0.4 - 0.15,
                glow: Math.random() * 6 + 3,
                color: Math.random() > 0.5 ? '255,235,150' : '200,220,255'
            });
        }
    }

    function drawStars() {
        ctx.clearRect(0, 0, width, height);
        for (let star of stars) {
            ctx.beginPath();
            ctx.arc(star.x, star.y, star.radius, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${star.color}, 0.8)`;
            ctx.shadowBlur = isStorm ? 20 : star.glow;
            ctx.shadowColor = isStorm ? 'red' : `rgba(${star.color}, 1)`;
            ctx.fill();
        }
        ctx.shadowBlur = 0;
        updateStars();
        requestAnimationFrame(drawStars);
    }

    function updateStars() {
        let speedMult = isStorm ? 15 : 1;
        for (let star of stars) {
            star.x += star.vx * speedMult;
            star.y += star.vy * speedMult;
            if (star.y < 0) star.y = height;
            if (star.x < 0) star.x = width;
            if (star.x > width) star.x = 0;
        }
    }
    window.addEventListener('resize', initStars);
    initStars(); drawStars();

    // --- مدیریت مودال‌ها ---
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.style.display = 'flex';
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                modal.classList.add('show');
                if (modalId === 'verifyModal') {
                    setTimeout(() => pinBoxes[0] && pinBoxes[0].focus(), 50);
                }
            });
        });
    }

    function closeModal(event, modalId) {
        const modal = document.getElementById(modalId);
        if (event.target === modal || event.target.classList.contains('close-modal')) {
            modal.classList.remove('show');
            setTimeout(() => modal.style.display = 'none', 350);
        }
    }

    // --- فرم تماس ---
    function handleContactSubmit(e) {
        e.preventDefault();
        const btn = e.target.querySelector('.submit-contact-btn');
        btn.textContent = '✓ پیام ارسال شد';
        btn.style.background = 'linear-gradient(135deg, #2ecc71, #27ae60)';
        btn.style.color = '#fff';
        setTimeout(() => {
            btn.textContent = 'ارسال پیام';
            btn.style.background = '';
            btn.style.color = '';
            e.target.reset();
        }, 2500);
    }

    // --- ساخت باکس‌های PIN شش‌رقمی ---
    const pinContainer = document.getElementById('pinContainer');
    const PIN_COUNT = 6;
    let pinValues = new Array(PIN_COUNT).fill('');
    let pinBoxEls = [];
    let pinHiddenInputs = [];

    for (let i = 0; i < PIN_COUNT; i++) {
        const wrapper = document.createElement('div');
        wrapper.className = 'pin-box';
        wrapper.setAttribute('data-index', i);

        const digitDisplay = document.createElement('div');
        digitDisplay.className = 'digit-display';
        wrapper.appendChild(digitDisplay);

        // input مخفی برای دریافت ورودی
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'text';
        hiddenInput.inputMode = 'numeric';
        hiddenInput.maxLength = 1;
        hiddenInput.style.cssText = 'position:absolute;opacity:0;width:100%;height:100%;top:0;left:0;cursor:pointer;';
        wrapper.appendChild(hiddenInput);

        pinContainer.appendChild(wrapper);
        pinBoxEls.push(wrapper);
        pinHiddenInputs.push(hiddenInput);

        wrapper.addEventListener('click', () => hiddenInput.focus());

        hiddenInput.addEventListener('input', (e) => {
            const val = e.target.value.replace(/\D/g, '').slice(-1);
            e.target.value = val;
            if (val) {
                setDigit(i, val);
                if (i < PIN_COUNT - 1) pinHiddenInputs[i + 1].focus();
            } else {
                clearDigit(i);
            }
            checkFormReady();
        });

        hiddenInput.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace') {
                if (pinValues[i]) {
                    clearDigit(i);
                } else if (i > 0) {
                    clearDigit(i - 1);
                    pinHiddenInputs[i - 1].focus();
                }
                checkFormReady();
            }
        });
    }

    function setDigit(index, val) {
        pinValues[index] = val;
        const display = pinBoxEls[index].querySelector('.digit-display');
        display.textContent = val;
        display.classList.remove('animate-num');
        void display.offsetWidth; // reflow
        display.classList.add('animate-num');
        pinBoxEls[index].classList.add('filled');
    }

    function clearDigit(index) {
        pinValues[index] = '';
        pinHiddenInputs[index].value = '';
        const display = pinBoxEls[index].querySelector('.digit-display');
        display.textContent = '';
        pinBoxEls[index].classList.remove('filled', 'success');
    }

    function checkFormReady() {
        const allFilled = pinValues.every(v => v.length === 1);
        submitBtn.classList.toggle('ready', allFilled);
    }

    const submitBtn = document.getElementById('submitBtn');

    function setVerifyState(state, message = '') {
        const msgEl = document.getElementById('verifyMessage');
        switch (state) {
            case 'idle':
                submitBtn.disabled = false;
                submitBtn.classList.add('ready');
                submitBtn.innerText = 'بررسی اصالت';
                msgEl.style.display = 'none';
                msgEl.className = 'verify-message';
                break;
            case 'loading':
                submitBtn.disabled = true;
                submitBtn.classList.remove('ready');
                submitBtn.innerText = 'در حال ارتباط با سرور...';
                msgEl.style.display = 'none';
                break;
            case 'success':
                submitBtn.disabled = false;
                submitBtn.classList.add('ready');
                submitBtn.innerText = 'بررسی اصالت';
                msgEl.className = 'verify-message verify-message--success';
                msgEl.innerHTML = '✅ ' + message;
                msgEl.style.display = 'block';
                break;
            case 'error':
                submitBtn.disabled = false;
                submitBtn.classList.add('ready');
                submitBtn.innerText = 'بررسی مجدد';
                msgEl.className = 'verify-message verify-message--error';
                msgEl.innerHTML = '❌ ' + message;
                msgEl.style.display = 'block';
                break;
        }
    }

    submitBtn.addEventListener('click', async () => {
        if (!submitBtn.classList.contains('ready')) return;

        const originalValues = [...pinValues];
        const fullCode = originalValues.join('');

        setVerifyState('loading');

        // انیمیشن چرخش سریع ارقام
        let spinIntervals = [];
        pinBoxEls.forEach((box, i) => {
            box.classList.add('spinning');
            const display = box.querySelector('.digit-display');
            spinIntervals.push(setInterval(() => {
                display.textContent = Math.floor(Math.random() * 10);
            }, 40));
        });

        try {
            const res = await fetch(`?ajax_verify=${encodeURIComponent(fullCode)}`);
            const data = await res.json();

            await new Promise(resolve => {
                pinBoxEls.forEach((box, i) => {
                    setTimeout(() => {
                        clearInterval(spinIntervals[i]);
                        const display = box.querySelector('.digit-display');
                        display.textContent = originalValues[i];
                        box.classList.remove('spinning');
                        if (data.valid) {
                            box.classList.add('success');
                        }
                        display.classList.remove('animate-num');
                        void display.offsetWidth;
                        display.classList.add('animate-num');
                        if (i === pinBoxEls.length - 1) resolve();
                    }, i * 80);
                });
            });

            await new Promise(r => setTimeout(r, 300));

            if (data.valid) {
                setVerifyState('success', 'شناسنامه معتبر است — در حال انتقال...');
                document.getElementById('fullCodeInput').value = fullCode;
                await new Promise(r => setTimeout(r, 800));
                document.getElementById('verifyForm').submit();
            } else {
                const msgs = {
                    'format'   : 'فرمت کد وارد‌شده صحیح نیست',
                    'not_found': 'این شناسنامه در سیستم یافت نشد',
                    'revoked'  : 'این شناسنامه باطل شده است',
                    'expired'  : 'این شناسنامه منقضی شده است',
                    'db_error' : 'خطا در ارتباط با سرور'
                };
                setVerifyState('error', msgs[data.reason] ?? 'خطای ناشناخته');

                setTimeout(() => {
                    for (let i = 0; i < PIN_COUNT; i++) clearDigit(i);
                    checkFormReady();
                    setVerifyState('idle');
                    pinHiddenInputs[0].focus();
                }, 2000);
            }

        } catch (err) {
            spinIntervals.forEach(clearInterval);
            pinBoxEls.forEach((box, i) => {
                const display = box.querySelector('.digit-display');
                display.textContent = originalValues[i];
                box.classList.remove('spinning');
            });
            setVerifyState('error', 'خطا در ارتباط با سرور');
        }
    });

    // --- سه کلیک روی عنوان → لاگین ---
        // --- 7 کلیک روی عنوان "جواهری مشاهیر" → حالت طوفانی (ممنوعه) ---
    let titleClicks = 0, titleClickTimer;
    document.getElementById('brandTitle').addEventListener('click', () => {
        titleClicks++;
        clearTimeout(titleClickTimer);
        titleClickTimer = setTimeout(() => titleClicks = 0, 1500); // ریست شدن شمارنده بعد از 1.5 ثانیه
        
        if (titleClicks === 7 && !isStorm) {
            isStorm = true;
            document.body.classList.add('storm-mode');
            const warning = document.getElementById('stormWarning');
            warning.style.opacity = 1;
            
            setTimeout(() => {
                isStorm = false;
                document.body.classList.remove('storm-mode');
                warning.style.opacity = 0;
                titleClicks = 0;
            }, 5000); // پایان طوفان بعد از 5 ثانیه
        }
    });

    // --- 3 کلیک روی سکه سه بعدی → ورود به ادمین ---
    let coinClicks = 0, coinClickTimer;
    document.getElementById('coin-3d-container').addEventListener('click', () => {
        coinClicks++;
        clearTimeout(coinClickTimer);
        coinClickTimer = setTimeout(() => coinClicks = 0, 1500);
        
        if (coinClicks === 3) {
            window.location.href = 'https://mashahirid.ir/admin/login.php';
        }
    });


    // coinParams
    window.coinParams = {
    speed:       0.008,
    ambientInt:  0.9,    // افزایش نور محیطی (قبلا 0.6 بود)
    plightInt:   45.0,   // افزایش شدت نور نقطه‌ای (قبلا 20.0 بود)
    bumpFront:   0.7,    // افزایش شدید برجستگی روی سکه (قبلا 0.15 بود)
    bumpBack:    0.7,    // افزایش برجستگی پشت سکه
    lightCount:  4,
    labelFront:  'مشاهیر',
    labelBack:   'QR',
    lightColor:  0xffffff,
    lightColor2: 0xffd700,
    flipTo:      null,
    dirty: false
};


    // دکمه flip
    let coinFaceFront = true;
    const flipBtn       = document.getElementById('flip-btn');
    const flipBtnText   = document.getElementById('flip-btn-text');
    const flipSideLabel = document.getElementById('flip-side-label');

    flipBtn.addEventListener('click', () => {
        coinFaceFront = !coinFaceFront;
        flipBtn.classList.add('flipping');
        setTimeout(() => flipBtn.classList.remove('flipping'), 500);
        if (coinFaceFront) {
            flipBtnText.textContent   = 'نمایش پشت';
            flipSideLabel.textContent = 'طرف رو (نقره)';
            flipSideLabel.style.color = '#aaa';
        } else {
            flipBtnText.textContent   = 'نمایش رو';
            flipSideLabel.textContent = 'طرف پشت (طلا)';
            flipSideLabel.style.color = '#d4af37';
        }
        window.coinParams.flipTo = coinFaceFront ? 'front' : 'back';
    });
</script>

<script type="module">
    import * as THREE from '/js/three.module.js';

    function createBumpTexture(label) {
        const c = document.createElement('canvas');
        c.width = 1024; c.height = 1024;
        const cx = c.getContext('2d');
        cx.fillStyle = '#000000';
        cx.fillRect(0, 0, 1024, 1024);
        cx.shadowBlur = 15;
        cx.shadowColor = '#ffffff';
        cx.fillStyle = '#ffffff';
        const isQR = (label === 'QR' || label === '');
        if (!isQR) {
            cx.font = 'bold 200px "B Yekan", Tahoma, sans-serif';
            cx.textAlign = 'center';
            cx.textBaseline = 'middle';
            for (let i = 0; i < 3; i++) cx.fillText(label, 512, 512);
        } else {
            const size = 400, offset = (1024 - size) / 2;
            const blocks = 8, blockSize = size / blocks;
            for (let i = 0; i < blocks; i++)
                for (let j = 0; j < blocks; j++)
                    if (Math.random() > 0.35)
                        cx.fillRect(offset + i * blockSize, offset + j * blockSize, blockSize, blockSize);
            cx.fillRect(offset, offset, blockSize * 2.5, blockSize * 2.5);
            cx.fillRect(offset + size - blockSize * 2.5, offset, blockSize * 2.5, blockSize * 2.5);
            cx.fillRect(offset, offset + size - blockSize * 2.5, blockSize * 2.5, blockSize * 2.5);
        }
        return new THREE.CanvasTexture(c);
    }

    function init3DCoin() {
        const container = document.getElementById('coin-3d-container');
        if (!container) return;

        const p = window.coinParams;

        const scene    = new THREE.Scene();
        const camera   = new THREE.PerspectiveCamera(40, container.clientWidth / container.clientHeight, 0.1, 100);
        camera.position.z = 12;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(container.clientWidth, container.clientHeight);
        renderer.setPixelRatio(window.devicePixelRatio);
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 2.5;
        container.appendChild(renderer.domElement);

        const coinGroup = new THREE.Group();

        const rimGeometry = new THREE.TorusGeometry(3.5, 0.15, 32, 100);
        const rimMaterial = new THREE.MeshStandardMaterial({ color: 0xffd700, metalness: 1.0, roughness: 0.15 });
        coinGroup.add(new THREE.Mesh(rimGeometry, rimMaterial));

        const bodyGeometry = new THREE.CylinderGeometry(3.45, 3.45, 0.3, 64);
        let silverMat = new THREE.MeshStandardMaterial({
            color: 0xffffff, metalness: 1.0, roughness: 0.2,
            bumpMap: createBumpTexture(p.labelFront), bumpScale: p.bumpFront
        });
        let goldMat = new THREE.MeshStandardMaterial({
            color: 0xffd700, metalness: 1.0, roughness: 0.2,
            bumpMap: createBumpTexture('QR'),
            bumpScale: p.bumpBack
        });
        const edgeMat = new THREE.MeshStandardMaterial({ color: 0xffd700, metalness: 1.0, roughness: 0.2 });
        const body = new THREE.Mesh(bodyGeometry, [edgeMat, silverMat, goldMat]);
        body.rotation.x = Math.PI / 2;
        coinGroup.add(body);
        scene.add(coinGroup);

        const ambientLight = new THREE.AmbientLight(0xffffff, p.ambientInt);
        scene.add(ambientLight);

        const lightDefs = [
            { color: p.lightColor,  intensity: p.plightInt, pos: [5,  5,  8] },
            { color: p.lightColor2, intensity: 2,            pos: [-5,-5,  5] },
            { color: 0xffffff,      intensity: 1.5,          pos: [0,  0, -8] },
            { color: 0xffeedd,      intensity: 10,           pos: [0, -4,  4] },
            { color: 0xffe055,      intensity: 4,            pos: [4, 10,  0] },
            { color: 0xffffff,      intensity: 10,           pos: [-4, 0,  0] },
        ];
        let pointLights = [];

        function rebuildLights() {
            pointLights.forEach(l => scene.remove(l));
            pointLights = [];
            const count = Math.min(p.lightCount, lightDefs.length);
            for (let i = 0; i < count; i++) {
                const def = lightDefs[i];
                let col = i === 0 ? p.lightColor : i === 1 ? p.lightColor2 : def.color;
                const pl = new THREE.PointLight(col, i === 0 ? p.plightInt : def.intensity, 50);
                pl.position.set(...def.pos);
                scene.add(pl);
                pointLights.push(pl);
            }
        }
        rebuildLights();

        let isDragging = false, previousX = 0, velocityY = 0;
        container.addEventListener('mousedown', (e) => { isDragging = true; previousX = e.offsetX; });
        container.addEventListener('mousemove', (e) => {
            if (isDragging) {
                velocityY = (e.offsetX - previousX) * 0.01;
                coinGroup.rotation.y += velocityY;
                previousX = e.offsetX;
            }
        });
        window.addEventListener('mouseup', () => isDragging = false);
        container.addEventListener('touchstart', (e) => { isDragging = true; previousX = e.touches[0].clientX; }, { passive: true });
        container.addEventListener('touchmove', (e) => {
            if (isDragging) {
                velocityY = (e.touches[0].clientX - previousX) * 0.01;
                coinGroup.rotation.y += velocityY;
                previousX = e.touches[0].clientX;
            }
        }, { passive: true });
        window.addEventListener('touchend', () => isDragging = false);

        let flipTargetY = null;
        let flipStartY  = null;
        let flipProgress = 1;

        function animate() {
            requestAnimationFrame(animate);

            ambientLight.intensity = p.ambientInt;
            if (pointLights[0]) pointLights[0].intensity = p.plightInt;
            silverMat.bumpScale = p.bumpFront;
            goldMat.bumpScale   = p.bumpBack;

            if (p.flipTo !== null) {
                const cur = coinGroup.rotation.y;
                let target;
                if (p.flipTo === 'front') {
                    target = Math.round(cur / (Math.PI * 2)) * Math.PI * 2;
                } else {
                    target = Math.round((cur - Math.PI) / (Math.PI * 2)) * Math.PI * 2 + Math.PI;
                }
                flipStartY   = cur;
                flipTargetY  = target;
                flipProgress = 0;
                p.flipTo     = null;
            }

            if (flipProgress < 1 && flipTargetY !== null) {
                flipProgress = Math.min(flipProgress + 0.04, 1);
                const t = flipProgress < 0.5
                    ? 4 * flipProgress ** 3
                    : 1 - Math.pow(-2 * flipProgress + 2, 3) / 2;
                coinGroup.rotation.y = flipStartY + (flipTargetY - flipStartY) * t;
            } else if (window.isStorm) {
                coinGroup.rotation.y += 0.5;
                coinGroup.rotation.x  = Math.random() * 0.2;
                coinGroup.rotation.z  = Math.random() * 0.2;
            } else if (flipProgress >= 1) {
                coinGroup.rotation.x = THREE.MathUtils.lerp(coinGroup.rotation.x, 0, 0.1);
                coinGroup.rotation.z = THREE.MathUtils.lerp(coinGroup.rotation.z, 0, 0.1);
                if (!isDragging) {
                    if (Math.abs(velocityY) > p.speed) {
                        velocityY *= 0.95;
                        coinGroup.rotation.y += velocityY;
                    } else {
                        coinGroup.rotation.y += p.speed;
                    }
                }
            }

            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', () => {
            if (container.clientWidth > 0) {
                camera.aspect = container.clientWidth / container.clientHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(container.clientWidth, container.clientHeight);
            }
        });
    }

    init3DCoin();
</script>
</body>
</html>
uctId][a.attributeName]) grouped[a.productId][a.attributeName] = new Set();
        grouped[a.productId][a.attributeName].add(a.attributeValue);
      });
      for (let pid in grouped) {
        const attrArray = [];
        for (let name in grouped[pid]) {
          attrArray.push({ name, options: Array.from(grouped[pid][name]) });
        }
        productAttributesMap.set(Number(pid), attrArray);
      }
    }

    async function extractAttributes() {
      const attrs = await executeDB('product_attributes', 'readonly', store => store.getAll());
      allAttributes.clear();
      attrs.forEach(a => {
        if (!allAttributes.has(a.attributeName)) allAttributes.set(a.attributeName, new Set());
        allAttributes.get(a.attributeName).add(a.attributeValue);
      });
      attributesCount = attrs.length;
      document.getElementById('attributeCount').innerText = attributesCount.toLocaleString();
      document.getElementById('totalAttributes').innerText = attributesCount.toLocaleString();
      renderAttributeButtons();
      renderSelectedAttributeChips();
    }

    function renderAttributeButtons() {
      const container = document.getElementById('attributeFilterButtons');
      container.innerHTML = '';
      allAttributes.forEach((values, attr) => {
        const btn = document.createElement('button');
        btn.className = 'btn btn-sm';
        btn.style.background = attributeFilters.has(attr) ? 'var(--accent-gold)' : 'rgba(0,0,0,0.3)';
        btn.style.color = attributeFilters.has(attr) ? '#042d28' : 'white';
        let icon = '🏷️';
        if (attr.includes('رنگ')) icon = '🎨';
        else if (attr.includes('سایز')) icon = '📏';
        else if (attr.includes('جنس')) icon = '🧵';
        btn.innerText = icon + ' ' + attr + ' (' + values.size + ')';
        btn.onclick = () => openAttributeModal(attr);
        container.appendChild(btn);
      });
    }

    function renderSelectedAttributeChips() {
      const container = document.getElementById('selectedAttributeChips');
      if (!container) return;
      container.innerHTML = '';
      const chips = [];
      attributeFilters.forEach((values, attr) => {
        values.forEach(val => {
          chips.push({ attr, val });
        });
      });
      const isMobile = window.innerWidth <= 768;
      if (isMobile && chips.length > 3) {
        const moreChip = document.createElement('span');
        moreChip.className = 'more-chip';
        moreChip.innerText = `+${chips.length} فیلتر`;
        moreChip.onclick = () => showAllFiltersModal();
        container.appendChild(moreChip);
      } else {
        chips.forEach(({ attr, val }) => {
          const chip = document.createElement('span');
          chip.className = 'filter-chip';
          chip.innerHTML = `${attr}: ${val} <span class="remove" onclick="event.stopPropagation(); removeAttributeFilter('${attr}','${val}')">×</span>`;
          chip.onclick = (e) => { if (e.target === chip || !e.target.classList.contains('remove')) removeAttributeFilter(attr, val); };
          container.appendChild(chip);
        });
      }
    }

    function showAllFiltersModal() {
      const list = document.getElementById('allFiltersList');
      list.innerHTML = '';
      attributeFilters.forEach((values, attr) => {
        values.forEach(val => {
          const chip = document.createElement('span');
          chip.className = 'filter-chip';
          chip.innerHTML = `${attr}: ${val} <span class="remove" onclick="removeAttributeFilter('${attr}','${val}'); event.stopPropagation();">×</span>`;
          list.appendChild(chip);
        });
      });
      document.getElementById('allFiltersModal').style.display = 'flex';
    }

    window.closeAllFiltersModal = () => document.getElementById('allFiltersModal').style.display = 'none';

    function openAttributeModal(attr) {
      currentAttribute = attr;
      tempSelectedValues = new Set(attributeFilters.get(attr) || []);
      const values = Array.from(allAttributes.get(attr) || []);
      const container = document.getElementById('attributeOptions');
      container.innerHTML = '';
      values.forEach(v => {
        const opt = document.createElement('span');
        opt.className = 'attr-option' + (tempSelectedValues.has(v) ? ' selected' : '');
        opt.innerText = v;
        opt.onclick = () => {
          if (tempSelectedValues.has(v)) {
            tempSelectedValues.delete(v);
            opt.classList.remove('selected');
          } else {
            tempSelectedValues.add(v);
            opt.classList.add('selected');
          }
        };
        container.appendChild(opt);
      });
      document.getElementById('attributeModalTitle').innerText = 'انتخاب مقادیر ' + attr;
      document.getElementById('attributeModal').style.display = 'flex';
    }

    function closeAttributeModal() {
      document.getElementById('attributeModal').style.display = 'none';
      currentAttribute = null;
    }

    function applyAttributeSelection() {
      if (currentAttribute) {
        if (tempSelectedValues.size) {
          attributeFilters.set(currentAttribute, new Set(tempSelectedValues));
        } else {
          attributeFilters.delete(currentAttribute);
        }
        renderAttributeButtons();
        renderSelectedAttributeChips();
        applyFilters();
      }
      closeAttributeModal();
    }

    window.removeAttributeFilter = (attr, val) => {
      if (attributeFilters.has(attr)) {
        attributeFilters.get(attr).delete(val);
        if (attributeFilters.get(attr).size === 0) attributeFilters.delete(attr);
      }
      renderAttributeButtons();
      renderSelectedAttributeChips();
      applyFilters();
    };

    function clearAllAttributeFilters() {
      attributeFilters.clear();
      renderAttributeButtons();
      renderSelectedAttributeChips();
      applyFilters();
    }

    function updateStats() {
      document.getElementById('totalProducts').innerText = allProducts.length.toLocaleString();
      document.getElementById('indexedProducts').innerText = indexedCount.toLocaleString();
      document.getElementById('pendingChanges').innerText = syncQueue.length;
    }

    function updateCategoryFilter() {
      const container = document.getElementById('categoryFilterContainer');
      if (!container) return;
      
      // استخراج همه‌ی دسته‌های منحصربه‌فرد از محصولات
      const allCats = new Set();
      allProducts.forEach(p => {
        if (p.categories && Array.isArray(p.categories)) {
          p.categories.forEach(c => allCats.add(c));
        }
      });
      
      const sortedCats = Array.from(allCats).sort((a, b) => a.localeCompare(b, 'fa'));
      container.innerHTML = '';
      
      sortedCats.forEach(cat => {
        const label = document.createElement('label');
        label.style.margin = '0.2rem';
        label.style.display = 'inline-flex';
        label.style.alignItems = 'center';
        label.style.gap = '0.2rem';
        label.style.background = 'rgba(255,255,255,0.1)';
        label.style.padding = '0.2rem 0.6rem';
        label.style.borderRadius = '2rem';
        label.style.fontSize = '0.7rem';
        label.style.cursor = 'pointer';
        
        const cb = document.createElement('input');
        cb.type = 'checkbox';
        cb.value = cat;
        cb.checked = selectedCategories.has(cat);
        cb.style.marginLeft = '0.2rem';
        cb.onchange = (e) => {
          if (e.target.checked) selectedCategories.add(cat);
          else selectedCategories.delete(cat);
          applyFilters(); // اعمال فیلتر با هر تغییر
        };
        
        label.appendChild(cb);
        label.appendChild(document.createTextNode(cat));
        container.appendChild(label);
      });
    }

    function clearCategoryFilters() {
      selectedCategories.clear();
      updateCategoryFilter();
      applyFilters();
    }

    function selectAllCategories() {
      document.querySelectorAll('#categoryFilterContainer input[type="checkbox"]').forEach(cb => {
        cb.checked = true;
        selectedCategories.add(cb.value);
      });
      applyFilters();
    }

    function sortProducts() {
      filteredProducts.sort((a,b)=>{
        let va = a[sortColumn] || '', vb = b[sortColumn] || '';
        if (sortColumn==='date_modified') va = new Date(va), vb = new Date(vb);
        if (sortColumn==='price'||sortColumn==='weight'||sortColumn==='price_per_gram') va=Number(va), vb=Number(vb);
        if (sortDirection==='asc') return va>vb?1:-1;
        else return va<vb?1:-1;
      });
    }

    function displayProducts() {
      const rowsPerPage = appConfig.rowsPerPage;
      const start = (currentPage-1)*rowsPerPage;
      const end = start+rowsPerPage;
      const pageData = filteredProducts.slice(start,end);
      const tbody = document.getElementById('productsTableBody');
      tbody.innerHTML = '';
      pageData.forEach((p, idx) => {
        const globalIdx = start+idx+1;
        const checked = selectedProducts.has(p.id) ? 'checked' : '';
        let row = '<tr>';
        if (appConfig.visibleColumns.row) row += `<td>${globalIdx}</td>`;
        if (appConfig.visibleColumns.select) row += `<td><input type="checkbox" class="row-select" data-id="${p.id}" ${checked} onchange="toggleProductSelect(${p.id},this.checked)"></td>`;
        if (appConfig.visibleColumns.thumbnail) row += `<td><img src="${p.image||'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0MCIgaGVpZ2h0PSI0MCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxyZWN0IHg9IjMiIHk9IjMiIHdpZHRoPSIxOCIgaGVpZ2h0PSIxOCIgcng9IjIiIHJ5PSIyIj48L3JlY3Q+PGNpcmNsZSBjeD0iOC41IiBjeT0iOC41IiByPSIxLjUiPjwvY2lyY2xlPjxwb2x5bGluZSBwb2ludHM9IjIxIDE1IDE2IDEwIDUgMjEiPjwvcG9seWxpbmU+PC9zdmc+'}" class="product-thumb"></td>`;
        if (appConfig.visibleColumns.name) row += `<td><a href="#" onclick="showProductDetail(${p.id}); return false;" style="color:var(--accent-gold);">${p.name||'---'}</a></td>`;
        if (appConfig.visibleColumns.date_modified) row += `<td>${p.date_modified?new Date(p.date_modified).toLocaleDateString('fa-IR'):'---'}</td>`;
        if (appConfig.visibleColumns.weight) row += `<td>${p.weight?p.weight+'g':'---'}</td>`;
        if (appConfig.visibleColumns.price_per_gram) row += `<td>${p.price_per_gram?Math.round(p.price_per_gram).toLocaleString():'---'}</td>`;
        if (appConfig.visibleColumns.price) row += `<td>${p.price?p.price.toLocaleString():'---'}</td>`;
        if (appConfig.visibleColumns.new_price) {
          const newPrice = priceEdits.get(p.id)||'';
          row += `<td><input type="number" class="price-input" id="newprice_${p.id}" value="${newPrice}" placeholder="جدید"> <button class="btn btn-sm" onclick="savePrice(${p.id})">💾</button></td>`;
        }
if (appConfig.visibleColumns.actions) row += `<td style="white-space:nowrap;">
  <button class="btn btn-sm" title="شناسنامه محصول" onclick="showProductDetail(${p.id})">📋</button>
  <button class="btn btn-sm" title="جزئیات سریع" onclick="showQuickDetail(${p.id})">🔍</button>
  <button class="btn btn-sm" title="مشاهده در سایت" onclick="viewOnSite(${p.id})">🔗</button>
</td>`;
        row += '</tr>';
        tbody.innerHTML += row;
      });
      document.getElementById('resultsCount').innerText = filteredProducts.length.toLocaleString();
      renderPagination();
    }

    function renderPagination() {
      const totalPages = Math.ceil(filteredProducts.length/appConfig.rowsPerPage);
      let html = '';
      if (currentPage > 1) html += `<button class="page-btn" onclick="changePage(${currentPage-1})">❮</button>`;
      let startPage = Math.max(1, currentPage - 2);
      let endPage = Math.min(totalPages, startPage + 4);
      if (endPage - startPage < 4) startPage = Math.max(1, endPage - 4);
      for (let i = startPage; i <= endPage; i++) {
        html += `<button class="page-btn ${i===currentPage?'active':''}" onclick="changePage(${i})">${i}</button>`;
      }
      if (currentPage < totalPages) html += `<button class="page-btn" onclick="changePage(${currentPage+1})">❯</button>`;
      document.getElementById('pagination').innerHTML = html;
    }

    function changePage(p) { currentPage=p; displayProducts(); }

    // ------------------------------------------------------------
    // انتخاب محصولات
    // ------------------------------------------------------------
    window.toggleProductSelect = (id, checked) => { if(checked) selectedProducts.add(id); else selectedProducts.delete(id); };
    window.selectAllFiltered = () => { filteredProducts.forEach(p=>selectedProducts.add(p.id)); displayProducts(); };
    window.deselectAll = () => { selectedProducts.clear(); displayProducts(); };
    window.toggleSelectAllRows = () => {
      const allSelected = filteredProducts.every(p=>selectedProducts.has(p.id));
      if(allSelected) filteredProducts.forEach(p=>selectedProducts.delete(p.id));
      else filteredProducts.forEach(p=>selectedProducts.add(p.id));
      displayProducts();
    };

    // ------------------------------------------------------------
    // ذخیره قیمت و انیمیشن (اصلاح شده)
    // ------------------------------------------------------------
    async function savePrice(productId) {
      try {
        const input = document.getElementById(`newprice_${productId}`);
        const newPrice = parseFloat(input.value);
        if(isNaN(newPrice) || newPrice<0) { alert('قیمت نامعتبر'); return; }
        const product = allProducts.find(p=>p.id===productId);
        if(!product) return;
        const oldPrice = product.price||0;
        
        // ذخیره در price_edits
        await executeDB('price_edits', 'readwrite', store => store.put({ productId, newPrice, oldPrice, timestamp: new Date().toISOString(), synced: false, productName: product.name }));
        
        // ذخیره در تاریخچه
        await executeDB('price_history', 'readwrite', store => store.add({ productId, oldPrice, newPrice, timestamp: new Date().toISOString() }));
        
        priceEdits.set(productId, newPrice);
        
        // اضافه به sync_queue
        const queueItem = { productId, type: 'price_update', status: 'pending', timestamp: new Date().toISOString() };
        const id = await executeDB('sync_queue', 'readwrite', store => store.add(queueItem));
        syncQueue.push({ id, ...queueItem });
        
        // به‌روزرسانی نمایش
        updateHeaderSyncCount();
        animateCount(1, input);
        displayProducts();
        updateStats();
        
        // اگر تب همگام‌سازی فعال است، لیست را به‌روز کن
        if (document.getElementById('syncTab').classList.contains('active')) {
          renderSyncList();
        }
        
        await log(`قیمت محصول ${product.name} به ${newPrice} تغییر یافت`, 'success');
      } catch (error) {
        console.error('خطا در ذخیره قیمت:', error);
        alert('خطا در ذخیره قیمت. لطفاً کنسول را بررسی کنید.');
      }
    }

    function animateCount(count, sourceElement) {
      if (!sourceElement) return;
      const rect = sourceElement.getBoundingClientRect();
      const fly = document.createElement('div');
      fly.innerText = '+' + count;
      fly.className = 'float-counter';
      fly.style.left = rect.left + 'px';
      fly.style.top = rect.top + 'px';
      fly.style.background = 'var(--accent-gold)';
      fly.style.color = '#042d28';
      fly.style.borderRadius = '50%';
      fly.style.width = '30px';
      fly.style.height = '30px';
      fly.style.display = 'flex';
      fly.style.alignItems = 'center';
      fly.style.justifyContent = 'center';
      fly.style.fontWeight = 'bold';
      fly.style.boxShadow = '0 0 10px gold';
      document.body.appendChild(fly);
      setTimeout(()=>fly.remove(), 1000);
    }

    window.viewOnSite = function(productId) {
      const product = allProducts.find(p=>p.id===productId);
      if (product && product.permalink) window.open(product.permalink, '_blank');
      else alert('لینک موجود نیست');
    };

    function updateHeaderSyncCount() {
      const count = syncQueue.length;
      const badge = document.getElementById('headerSyncCount');
      badge.innerText = count;
      if (count === 0) badge.classList.add('hide'); else badge.classList.remove('hide');
    }

    // ------------------------------------------------------------
    // همگام‌سازی
    // ------------------------------------------------------------
    async function loadSyncQueue() {
      syncQueue = await executeDB('sync_queue', 'readonly', store => store.getAll()) || [];
      updateHeaderSyncCount();
      renderSyncList();
    }

    function renderSyncList() {
      const container = document.getElementById('syncList');
      if(!syncQueue.length) { container.innerHTML = '<p>هیچ تغییری در صف نیست</p>'; return; }
      let html = '';
      syncQueue.forEach(item => {
        const product = allProducts.find(p=>p.id===item.productId);
        const checked = selectedSyncItems.has(item.id) ? 'checked' : '';
        html += `<div style="display:flex; align-items:center; gap:0.3rem; padding:0.3rem; border-bottom:1px solid rgba(255,255,255,0.1);">
          <input type="checkbox" class="sync-checkbox" data-id="${item.id}" ${checked} onchange="toggleSyncItem(${item.id}, this.checked)">
          <span>${product?.name||'نامشخص'} (${item.productId})</span>
          <span style="color:var(--accent-gold);">${priceEdits.get(item.productId)?.toLocaleString()} تومان</span>
        </div>`;
      });
      container.innerHTML = html;
      updateSyncStats();
    }

    window.toggleSyncItem = (id, checked) => { if(checked) selectedSyncItems.add(id); else selectedSyncItems.delete(id); };

    function toggleSelectAllSync() {
      const cb = document.getElementById('selectAllSync');
      if(cb.checked) syncQueue.forEach(i=>selectedSyncItems.add(i.id));
      else selectedSyncItems.clear();
      renderSyncList();
    }

    function updateSyncStats() {
      let inc=0, dec=0;
      syncQueue.forEach(item=>{
        const p = allProducts.find(p=>p.id===item.productId);
        if(p) {
          const old = p.price||0;
          const newP = priceEdits.get(p.id)||0;
          if(newP>old) inc++; else if(newP<old) dec++;
        }
      });
      document.getElementById('syncTotal').innerText = syncQueue.length;
      document.getElementById('syncIncrease').innerText = inc;
      document.getElementById('syncDecrease').innerText = dec;
      document.getElementById('syncSuccess').innerText = '0';
    }

    async function syncSelected() {
      const items = syncQueue.filter(i=>selectedSyncItems.has(i.id));
      await startSync(items);
    }

    async function syncAll() { await startSync(syncQueue); }

    async function startSync(items) {
      if(isSyncing) return;
      if(!items.length) return alert('آیتمی انتخاب نشده');
      isSyncing = true;
      syncStopRequested = false;
      document.getElementById('syncProgress').style.display = 'block';
      let success=0, error=0;
      for(let i=0;i<items.length;i++) {
        if(syncStopRequested) break;
        const item = items[i];
        const product = allProducts.find(p=>p.id===item.productId);
        if(!product) { error++; continue; }
        try {
          const newPrice = priceEdits.get(item.productId);
          const url = `${appConfig.siteUrl}/wp-json/wc/v3/products/${item.productId}?consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}`;
          const res = await fetch(url, { method:'PUT', headers:{'Content-Type':'application/json'}, body:JSON.stringify({ regular_price: newPrice.toString() }) });
          if(res.ok) {
            success++;
            await executeDB('price_edits', 'readwrite', store => store.put({ productId: item.productId, synced: true }));
            await executeDB('sync_queue', 'readwrite', store => store.delete(item.id));
            syncQueue = syncQueue.filter(q=>q.id!==item.id);
            selectedSyncItems.delete(item.id);
            logSync(`✅ ${product.name} همگام شد`, 'success');
          } else { error++; logSync(`❌ ${product.name}`, 'error'); }
        } catch(e) { error++; logSync(`❌ ${product.name}`, 'error'); }
        const percent = Math.round(((i+1)/items.length)*100);
        document.getElementById('syncProgressFill').style.width = percent+'%';
        document.getElementById('syncProgressPercent').innerText = percent+'%';
        document.getElementById('headerProgressFill').style.width = percent+'%';
        document.getElementById('headerProgress').style.display = 'flex';
        document.getElementById('headerProgressText').innerText = `${items.length - (i+1)} باقی`;
      }
      isSyncing = false;
      document.getElementById('syncProgress').style.display = 'none';
      document.getElementById('headerProgress').style.display = 'none';
      renderSyncList();
      updateHeaderSyncCount();
      document.getElementById('syncSuccess').innerText = success;
      updateStats();
      log(`همگام‌سازی: ${success} موفق، ${error} ناموفق`, error===0?'success':'warning');
    }

    function stopSync() { syncStopRequested = true; }

    function logSync(msg, type) {
      const div = document.createElement('div');
      div.innerText = `${new Date().toLocaleString('fa-IR')} ${msg}`;
      div.style.color = type==='success'?'lightgreen':'pink';
      document.getElementById('syncLog').prepend(div);
      if(document.getElementById('syncLog').children.length>30) document.getElementById('syncLog').removeChild(document.getElementById('syncLog').lastChild);
    }

    async function deleteSelectedSync() {
      if(!selectedSyncItems.size) return;
      for(let id of selectedSyncItems) {
        await executeDB('sync_queue', 'readwrite', store => store.delete(id));
      }
      syncQueue = syncQueue.filter(i=>!selectedSyncItems.has(i.id));
      selectedSyncItems.clear();
      renderSyncList();
      updateHeaderSyncCount();
    }

    // ------------------------------------------------------------
    // ایندکس
    // ------------------------------------------------------------
    async function startIndexing() {
      if(isIndexing) return;
      if (Date.now() >= licenseExpiry) { alert('لایسنس منقضی شده'); return; }
      isIndexing = true;
      isPaused = false;
      document.getElementById('startIndexBtn').disabled = true;
      document.getElementById('pauseIndexBtn').disabled = false;
      document.getElementById('continueIndexBtn').style.display = 'none';
      indexStartTime = Date.now();
      startIndexTimer();
      await logIndex('شروع ایندکس...', 'info');

      try {
        const testUrl = `${appConfig.siteUrl}/wp-json/wc/v3/products?per_page=1&consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}`;
        const resp = await fetch(testUrl);
        if(!resp.ok) throw new Error('خطا در اتصال');
        totalSiteProducts = parseInt(resp.headers.get('X-WP-Total')) || 0;
        document.getElementById('totalSiteProducts').innerText = totalSiteProducts.toLocaleString();
      } catch(e) {
        logIndex('خطا در دریافت تعداد کل', 'error');
        isIndexing = false;
        updateIndexButtons();
        return;
      }

      let startPage = 1;
      const incremental = document.getElementById('incrementalCheck').checked;
      if(!incremental && indexedPages.size>0) {
        const maxPage = Math.max(...Array.from(indexedPages));
        if(maxPage * appConfig.perPage < totalSiteProducts) startPage = maxPage+1;
        else {
          logIndex('همه صفحات قبلاً ایندکس شده‌اند', 'info');
          completeIndexing();
          return;
        }
      }

      const totalPages = Math.ceil(totalSiteProducts / appConfig.perPage);
      for(let page=startPage; page<=totalPages; page++) {
        if(!isIndexing || isPaused) {
          if(isPaused) logIndex('ایندکس متوقف شد', 'warning');
          break;
        }
        await indexPage(page);
        const percent = Math.round((indexedCount/totalSiteProducts)*100);
        document.getElementById('indexProgressFill').style.width = percent+'%';
        document.getElementById('headerProgressFill').style.width = percent+'%';
        document.getElementById('headerProgress').style.display = 'flex';
        document.getElementById('headerProgressText').innerText = `${totalSiteProducts - indexedCount} باقی`;
        await saveIndexState();
      }
      if(isIndexing && !isPaused) completeIndexing();
    }

    async function indexPage(page) {
      try {
        const url = `${appConfig.siteUrl}/wp-json/wc/v3/products?per_page=${appConfig.perPage}&page=${page}&consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}&_fields=id,name,slug,sku,price,regular_price,sale_price,date_created,date_modified,weight,dimensions,categories,attributes,images,permalink`;
        const res = await fetch(url);
        if(!res.ok) throw new Error(`HTTP ${res.status}`);
        const products = await res.json();
        if(!products.length) return;

        for(const p of products) {
          const weight = parseFloat(p.weight)||0;
          const price = parseFloat(p.price)||0;
          const pricePerGram = weight>0?price/weight:0;
          const productData = {
            id: p.id,
            name: p.name,
            slug: p.slug,
            sku: p.sku||'',
            price,
            regular_price: parseFloat(p.regular_price)||0,
            sale_price: parseFloat(p.sale_price)||0,
            date_created: p.date_created,
            date_modified: p.date_modified,
            weight,
            dimensions: p.dimensions||null,
            categories: p.categories ? p.categories.map(c => c.name) : [], // ذخیره همه‌ی دسته‌ها
            image: p.images?.[0]?.src||'',
            permalink: p.permalink||'',
            price_per_gram: pricePerGram,
            last_indexed: new Date().toISOString()
          };
          await executeDB('products', 'readwrite', store => store.put(productData));
          
          // ذخیره ویژگی‌ها
          if(p.attributes) {
            for(const attr of p.attributes) {
              if(attr.options) {
                for(const opt of attr.options) {
                  await executeDB('product_attributes', 'readwrite', store => store.add({
                    productId: p.id,
                    attributeName: attr.name,
                    attributeValue: opt,
                    timestamp: new Date().toISOString()
                  }));
                }
              }
            }
          }
          indexedCount++;
        }
        indexedPages.add(page);
        await executeDB('indexed_pages', 'readwrite', store => store.put({ page, timestamp: Date.now() }));
        document.getElementById('indexedCountDisplay').innerText = indexedCount.toLocaleString();
        document.getElementById('indexedProducts').innerText = indexedCount.toLocaleString();
        logIndex(`صفحه ${page} ایندکس شد (${products.length} محصول)`, 'success');
        
        // به‌روزرسانی productAttributesMap برای محصولات جدید
        await loadProductAttributesMap();
      } catch(e) {
        logIndex(`خطا در صفحه ${page}: ${e.message}`, 'error');
        isIndexing = false;
        updateIndexButtons();
      }
    }

    function pauseIndexing() {
      if(isIndexing && !isPaused) {
        isPaused = true;
        document.getElementById('pauseIndexBtn').disabled = true;
        document.getElementById('continueIndexBtn').style.display = 'inline-block';
        logIndex('ایندکس متوقف شد', 'warning');
      }
    }

    function continueIndexing() {
      if(isIndexing && isPaused) {
        isPaused = false;
        document.getElementById('pauseIndexBtn').disabled = false;
        document.getElementById('continueIndexBtn').style.display = 'none';
        logIndex('ادامه ایندکس...', 'info');
        startIndexing();
      }
    }

    async function resetIndexing() {
      if(!confirm('ریست ایندکس؟')) return;
      await executeDB('products', 'readwrite', store => store.clear());
      await executeDB('product_attributes', 'readwrite', store => store.clear());
      await executeDB('indexed_pages', 'readwrite', store => store.clear());
      await executeDB('index_state', 'readwrite', store => store.clear());
      indexedPages.clear();
      indexedCount = 0;
      totalSiteProducts = 0;
      allProducts = [];
      filteredProducts = [];
      displayProducts();
      updateStats();
      logIndex('ایندکس ریست شد', 'warning');
    }

    function startIndexTimer() {
      clearInterval(timerInterval);
      timerInterval = setInterval(() => {
        if(indexStartTime) {
          const elapsed = Math.floor((Date.now()-indexStartTime)/1000);
          const min = Math.floor(elapsed/60);
          const sec = elapsed%60;
          document.getElementById('indexTime').innerText = `${min.toString().padStart(2,'0')}:${sec.toString().padStart(2,'0')}`;
        }
      }, 1000);
    }

    function completeIndexing() {
      isIndexing = false;
      clearInterval(timerInterval);
      updateIndexButtons();
      document.getElementById('headerProgress').style.display = 'none';
      logIndex('✅ ایندکس کامل شد', 'success');
      loadInitialData();
    }

    function updateIndexButtons() {
      document.getElementById('startIndexBtn').disabled = isIndexing;
      document.getElementById('pauseIndexBtn').disabled = !isIndexing || isPaused;
    }

    async function logIndex(msg, type) {
      const div = document.createElement('div');
      div.innerText = `${new Date().toLocaleString('fa-IR')} ${msg}`;
      div.style.color = type==='success'?'lightgreen':type==='error'?'pink':'white';
      document.getElementById('indexLog').prepend(div);
      if(document.getElementById('indexLog').children.length>30) document.getElementById('indexLog').removeChild(document.getElementById('indexLog').lastChild);
      await log(msg, type);
    }

    async function saveIndexState() {
      await executeDB('index_state', 'readwrite', store => store.put({
        id: 'index_state',
        indexedPages: Array.from(indexedPages),
        indexedCount,
        totalSiteProducts,
        lastIndexed: new Date().toISOString()
      }));
    }

    async function loadIndexState() {
      const state = await executeDB('index_state', 'readonly', store => store.get('index_state'));
      if(state) {
        indexedPages = new Set(state.indexedPages||[]);
        indexedCount = state.indexedCount||0;
        totalSiteProducts = state.totalSiteProducts||0;
        lastIndexTime = state.lastIndexed;
        document.getElementById('totalSiteProducts').innerText = totalSiteProducts.toLocaleString();
        document.getElementById('indexedCountDisplay').innerText = indexedCount.toLocaleString();
      }
    }

    // ------------------------------------------------------------
    // خروجی / ورودی با پیش‌نمایش
    // ------------------------------------------------------------
    let importDataCache = null;

    async function exportData() {
      const products = await executeDB('products', 'readonly', store => store.getAll());
      const edits = await executeDB('price_edits', 'readonly', store => store.getAll());
      const history = await executeDB('price_history', 'readonly', store => store.getAll());
      const attrs = await executeDB('product_attributes', 'readonly', store => store.getAll());
      const data = { products, edits, history, attrs, exportDate: new Date().toISOString() };
      const blob = new Blob([JSON.stringify(data)], {type:'application/json'});
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = `backup_${new Date().toISOString().slice(0,10)}.json`;
      a.click();
    }

    async function importData() {
      const input = document.createElement('input');
      input.type = 'file';
      input.accept = '.json';
      input.onchange = async e => {
        const file = e.target.files[0];
        if(!file) return;
        const text = await file.text();
        const data = JSON.parse(text);
        importDataCache = data;
        const preview = document.getElementById('importPreview');
        preview.innerHTML = `
          <p>محصولات: ${data.products?.length || 0}</p>
          <p>ویرایش‌ها: ${data.edits?.length || 0}</p>
          <p>تاریخچه: ${data.history?.length || 0}</p>
          <p>ویژگی‌ها: ${data.attrs?.length || 0}</p>
        `;
        document.getElementById('importModal').style.display = 'flex';
      };
      input.click();
    }

    function closeImportModal() {
      document.getElementById('importModal').style.display = 'none';
      importDataCache = null;
    }

    async function confirmImport() {
      if (!importDataCache) return;
      const data = importDataCache;
      if(data.products) {
        await executeDB('products', 'readwrite', store => { store.clear(); data.products.forEach(p=>store.put(p)); });
      }
      if(data.edits) await executeDB('price_edits', 'readwrite', store => { store.clear(); data.edits.forEach(e=>store.put(e)); });
      if(data.history) await executeDB('price_history', 'readwrite', store => { store.clear(); data.history.forEach(h=>store.put(h)); });
      if(data.attrs) await executeDB('product_attributes', 'readwrite', store => { store.clear(); data.attrs.forEach(a=>store.put(a)); });
      alert('بازیابی انجام شد');
      closeImportModal();
      loadInitialData();
    }

    // ------------------------------------------------------------
    // فیلترها
    // ------------------------------------------------------------
    function applyFilters() {
      const search = document.getElementById('searchInput').value.toLowerCase();
      const hideNoWeight = document.getElementById('hideNoWeight').checked;
      const hideNoPrice = document.getElementById('hideNoPrice').checked;

      // خواندن مقادیر بازه قیمت هر گرم
      const minVal = parseFloat(document.getElementById('minPrice').value);
      const maxVal = parseFloat(document.getElementById('maxPrice').value);
      const hasMin = !isNaN(minVal);
      const hasMax = !isNaN(maxVal);

      filteredProducts = allProducts.filter(p => {
        // جستجو
        if (search && !(p.name.toLowerCase().includes(search) || (p.sku && p.sku.toLowerCase().includes(search)))) return false;
        
        // فیلتر دسته‌بندی (چند انتخابی)
        if (selectedCategories.size > 0) {
          const productCats = p.categories || (p.category ? [p.category] : []);
          if (!productCats.some(c => selectedCategories.has(c))) return false;
        }

        // عدم نمایش بی‌وزن
        if (hideNoWeight && (!p.weight || p.weight <= 0)) return false;
        // عدم نمایش بی‌قیمت
        if (hideNoPrice && (!p.price || p.price <= 0)) return false;

        // بازه قیمت هر گرم
        const ppg = p.price_per_gram || 0;
        if (hasMin && ppg < minVal) return false;
        if (hasMax && ppg > maxVal) return false;

        // فیلتر ویژگی‌ها
        if (attributeFilters.size > 0) {
          const productAttrs = productAttributesMap.get(p.id) || [];
          for (let [attr, vals] of attributeFilters) {
            const pa = productAttrs.find(a => a.name === attr);
            if (!pa || !pa.options || !pa.options.some(opt => vals.has(opt))) return false;
          }
        }
        return true;
      });
      currentPage = 1;
      sortProducts();
      displayProducts();
    }

    window.applyFilters = applyFilters;

    // ------------------------------------------------------------
    // نمایش جزییات محصول
    // ------------------------------------------------------------
   // ✅ جدید - showProductDetail با مودال کارت شناسنامه
window.showProductDetail = function(id) {
  const p = allProducts.find(p => p.id === id);
  if (!p) return;

  // ساخت لیست ویژگی‌ها
  let attrsHtml = '';
  if (p.attributes && p.attributes.length > 0) {
    attrsHtml = `<div style="margin-top:1rem;">
      <strong style="color:var(--accent-gold);">ویژگی‌ها:</strong>
      <div style="display:flex; flex-wrap:wrap; gap:0.4rem; margin-top:0.5rem;">
        ${p.attributes.map(a =>
          `<span style="background:var(--bg-main); border:1px solid var(--accent-gold); border-radius:20px; padding:2px 10px; font-size:0.85rem;">
            <b>${a.name}:</b> ${Array.isArray(a.options) ? a.options.join('، ') : (a.option || '---')}
          </span>`
        ).join('')}
      </div>
    </div>`;
  }

  // ساخت تصویر
  const imgHtml = p.images && p.images[0]
    ? `<img src="${p.images[0].src}" style="width:100%; max-height:220px; object-fit:contain; border-radius:10px; margin-bottom:1rem;" onerror="this.style.display='none'">`
    : `<div style="width:100%; height:120px; background:var(--bg-main); border-radius:10px; display:flex; align-items:center; justify-content:center; margin-bottom:1rem; font-size:3rem;">📦</div>`;

  // محاسبه قیمت هر گرم
  let pricePerGram = '---';
  if (p.price && p.weight) {
    pricePerGram = (parseFloat(p.price) / parseFloat(p.weight)).toFixed(0);
    pricePerGram = parseInt(pricePerGram).toLocaleString('fa-IR') + ' ت/گ';
  }

  document.getElementById('productModalContent').innerHTML = `
    ${imgHtml}
    <div style="border-right:4px solid var(--accent-gold); padding-right:1rem; margin-bottom:1rem;">
      <h2 style="margin:0 0 0.3rem; color:var(--text-light); font-size:1.2rem;">${p.name || '---'}</h2>
      <small style="color:#aaa;">SKU: ${p.sku || '---'} | ID: ${p.id}</small>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.8rem; margin-bottom:1rem;">
      <div style="background:var(--bg-main); border-radius:10px; padding:0.8rem; text-align:center;">
        <div style="font-size:0.75rem; color:#aaa; margin-bottom:0.3rem;">قیمت</div>
        <div style="font-size:1.1rem; color:var(--accent-gold); font-weight:bold;">${p.price ? parseInt(p.price).toLocaleString('fa-IR') : '---'}</div>
      </div>
      <div style="background:var(--bg-main); border-radius:10px; padding:0.8rem; text-align:center;">
        <div style="font-size:0.75rem; color:#aaa; margin-bottom:0.3rem;">وزن</div>
        <div style="font-size:1.1rem; color:var(--accent-gold); font-weight:bold;">${p.weight ? p.weight + 'g' : '---'}</div>
      </div>
      <div style="background:var(--bg-main); border-radius:10px; padding:0.8rem; text-align:center;">
        <div style="font-size:0.75rem; color:#aaa; margin-bottom:0.3rem;">قیمت هر گرم</div>
        <div style="font-size:1rem; color:#7fdbff; font-weight:bold;">${pricePerGram}</div>
      </div>
      <div style="background:var(--bg-main); border-radius:10px; padding:0.8rem; text-align:center;">
        <div style="font-size:0.75rem; color:#aaa; margin-bottom:0.3rem;">موجودی</div>
        <div style="font-size:1rem; color:${p.stock_status === 'instock' ? '#2ecc71' : '#e74c3c'}; font-weight:bold;">${p.stock_status === 'instock' ? '✅ موجود' : '❌ ناموجود'}</div>
      </div>
    </div>

    <div style="font-size:0.8rem; color:#999; margin-bottom:1rem;">
      📅 آخرین بروزرسانی: ${p.date_modified ? new Date(p.date_modified).toLocaleString('fa-IR') : '---'}
    </div>

    ${attrsHtml}

    <div style="margin-top:1.5rem; display:flex; gap:0.8rem; justify-content:center;">
      <button class="btn btn-sm" style="background:var(--accent-gold); color:#000;" onclick="viewOnSite(${p.id})">🔗 مشاهده در سایت</button>
      <button class="btn btn-sm" onclick="closeProductModal()">بستن</button>
    </div>
  `;

  const modal = document.getElementById('productModal');
  modal.style.display = 'flex';
};

// تابع جدید برای نمایش سریع (دکمه 🔍)
window.showQuickDetail = function(id) {
  const p = allProducts.find(p => p.id === id);
  if (!p) return;
  alert(`📦 ${p.name}\nSKU: ${p.sku||'---'}\nقیمت: ${p.price ? parseInt(p.price).toLocaleString('fa-IR') : '---'}\nوزن: ${p.weight || '---'}g`);
};

window.closeProductModal = function() {
  document.getElementById('productModal').style.display = 'none';
};

    // ------------------------------------------------------------
    // تنظیمات
    // ------------------------------------------------------------
    function saveSettings() {
      appConfig.siteUrl = document.getElementById('siteUrl').value;
      appConfig.consumerKey = document.getElementById('consumerKey').value;
      appConfig.consumerSecret = document.getElementById('consumerSecret').value;
      executeDB('app_config', 'readwrite', store => store.put({ key: 'config', value: appConfig }));
      log('تنظیمات ذخیره شد', 'success');
    }

    function saveDisplaySettings() {
      appConfig.rowsPerPage = parseInt(document.getElementById('rowsPerPage').value) || 10;
      appConfig.showAttributesInPopup = document.getElementById('showAttrInPopup').checked;
      document.querySelectorAll('#columnSelector input').forEach(cb => {
        appConfig.visibleColumns[cb.dataset.col] = cb.checked;
      });
      appConfig.visibleAttributes = [];
      document.querySelectorAll('#attributeSelector input:checked').forEach(cb => {
        appConfig.visibleAttributes.push(cb.value);
      });
      displayProducts();
      log('تنظیمات نمایش ذخیره شد', 'success');
    }

    function renderColumnSelector() {
      const container = document.getElementById('columnSelector');
      container.innerHTML = '';
      for (let [key, label] of Object.entries({
        row: 'ردیف', select: 'انتخاب', thumbnail: 'تصویر', name: 'نام',
        date_modified: 'بروزرسانی', weight: 'وزن', price_per_gram: 'هر گرم',
        price: 'قیمت', new_price: 'قیمت جدید', actions: 'عملیات'
      })) {
        const div = document.createElement('label');
        div.style.margin = '0 0.5rem';
        div.innerHTML = `<input type="checkbox" data-col="${key}" ${appConfig.visibleColumns[key]?'checked':''}> ${label}`;
        container.appendChild(div);
      }
    }

    function renderAttributeSelector() {
      const container = document.getElementById('attributeSelector');
      if (!container) return;
      container.innerHTML = '';
      allAttributes.forEach((_, attr) => {
        const div = document.createElement('label');
        div.style.margin = '0 0.5rem';
        div.innerHTML = `<input type="checkbox" value="${attr}" ${(appConfig.visibleAttributes || []).includes(attr)?'checked':''}> ${attr}`;
        container.appendChild(div);
      });
    }

    async function testConnection() {
      try {
        const url = `${appConfig.siteUrl}/wp-json/wc/v3/products?per_page=1&consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}`;
        const res = await fetch(url);
        if (res.ok) alert('اتصال موفق');
        else alert('خطا در اتصال');
      } catch { alert('خطا'); }
    }

    // ------------------------------------------------------------
    // منوی موبایل
    // ------------------------------------------------------------
    const menuOverlay = document.getElementById('menuOverlay');
    document.getElementById('mobileMenuBtn').addEventListener('click', () => menuOverlay.classList.add('active'));
    document.getElementById('menuClose').addEventListener('click', () => menuOverlay.classList.remove('active'));
    document.querySelectorAll('.menu-item').forEach(btn => {
      btn.addEventListener('click', () => {
        const tab = btn.dataset.tab;
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelector(`.tab-btn[data-tab="${tab}"]`).classList.add('active');
        document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
        document.getElementById(tab + 'Tab').classList.add('active');
        menuOverlay.classList.remove('active');
        if (tab === 'log') displayLogs();
        if (tab === 'sync') renderSyncList();
      });
    });

    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.querySelectorAll('.tab-btn').forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.tab-content').forEach(c=>c.classList.remove('active'));
        document.getElementById(btn.dataset.tab+'Tab').classList.add('active');
        if(btn.dataset.tab==='log') displayLogs();
        if(btn.dataset.tab==='sync') renderSyncList();
      });
    });

    // ------------------------------------------------------------
    // باز/بسته کردن پنل فیلترها
    // ------------------------------------------------------------
    let filterPanelVisible = false;
    document.getElementById('filterToggleBtn').addEventListener('click', () => {
      const panel = document.getElementById('filterPanel');
      filterPanelVisible = !filterPanelVisible;
      panel.classList.toggle('visible', filterPanelVisible);
      document.getElementById('filterToggleBtn').innerText = filterPanelVisible ? '🔍 مخفی کردن فیلترها' : '🔍 نمایش فیلترها';
    });

    // ------------------------------------------------------------
    // تم
    // ------------------------------------------------------------
    function setTheme(theme) {
      if(theme==='dark') {
        document.body.classList.remove('light-theme');
      } else {
        document.body.classList.add('light-theme');
      }
      appConfig.theme = theme;
      localStorage.setItem('theme', theme);
      document.querySelectorAll('#themeLight, #themeDark').forEach(el=>el.classList.remove('active'));
      document.getElementById(theme==='light'?'themeLight':'themeDark').classList.add('active');
    }
    document.getElementById('themeLight').addEventListener('click', ()=>setTheme('light'));
    document.getElementById('themeDark').addEventListener('click', ()=>setTheme('dark'));
    const savedTheme = localStorage.getItem('theme') || 'light';
    setTheme(savedTheme);

    // ------------------------------------------------------------
    // PWA نصب
    // ------------------------------------------------------------
    window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault();
      deferredPrompt = e;
    });

    window.showInstallPrompt = function() {
      if (deferredPrompt) {
        deferredPrompt.prompt();
        deferredPrompt.userChoice.then(() => deferredPrompt = null);
      } else {
        alert('برای نصب اپلیکیشن، از گزینه «افزودن به صفحه اصلی» در منوی مرورگر استفاده کنید.');
      }
    };

    window.showHelp = function() {
      alert(`راهنمای سریع:
      - محصولات: لیست محصولات ایندکس شده، امکان ویرایش قیمت، فیلتر
      - همگام‌سازی: ارسال تغییرات به سایت
      - ایندکس: دریافت اطلاعات از سایت (مقاوم به قطع)
      - لاگ: مشاهده رویدادها
      - تنظیمات: پیکربندی اتصال و نمایش
      - درباره: اطلاعات پروژه و لایسنس`);
    };

    // ------------------------------------------------------------
    // اعمال تغییر دسته‌ای قیمت
    // ------------------------------------------------------------
    window.applyBatchPriceChange = async function() {
      const type = document.getElementById('priceChangeType').value;
      const value = parseFloat(document.getElementById('priceChangeValue').value);
      const applyTo = document.getElementById('priceApplyType').value;
      if(isNaN(value) || value===0) { alert('مقدار معتبر وارد کنید'); return; }
      let products = [];
      if(applyTo === 'all') products = allProducts;
      else if(applyTo === 'filtered') products = filteredProducts;
      else if(applyTo === 'selected') products = allProducts.filter(p=>selectedProducts.has(p.id));
      if(products.length===0) { alert('محصولی یافت نشد'); return; }
      if(!confirm(`اعمال تغییر بر ${products.length} محصول؟`)) return;
      let count = 0;
      for(const p of products) {
        if(p.price>0) {
          let newPrice;
          if(type==='percent') {
            newPrice = p.price * (1 + value/100);
          } else {
            if(p.weight<=0) continue;
            newPrice = p.weight * value;
          }
          newPrice = Math.round(newPrice);
          await executeDB('price_edits', 'readwrite', store => store.put({ productId: p.id, newPrice, oldPrice: p.price, timestamp: new Date().toISOString(), synced: false, productName: p.name }));
          await executeDB('price_history', 'readwrite', store => store.add({ productId: p.id, oldPrice: p.price, newPrice, timestamp: new Date().toISOString() }));
          priceEdits.set(p.id, newPrice);
          const queueItem = { productId: p.id, type: 'price_update', status: 'pending', timestamp: new Date().toISOString() };
          const id = await executeDB('sync_queue', 'readwrite', store => store.add(queueItem));
          syncQueue.push({ id, ...queueItem });
          count++;
        }
      }
      updateHeaderSyncCount();
      animateCount(count, event.target);
      displayProducts();
      updateStats();
      if (document.getElementById('syncTab').classList.contains('active')) renderSyncList();
      alert(`${count} محصول به صف همگام‌سازی اضافه شد`);
    };

    window.sortTable = (col) => {
      if(sortColumn===col) sortDirection = sortDirection==='asc'?'desc':'asc';
      else { sortColumn=col; sortDirection='asc'; }
      sortProducts(); displayProducts();
    };

    window.changePage = changePage;

    // ------------------------------------------------------------
    // آماده‌سازی نهایی
    // ------------------------------------------------------------
    window.onload = async () => {
      await initDatabase();
      await loadIndexState();
      await loadInitialData();
      updateLicenseDisplay();
      setInterval(updateLicenseDisplay, 60000);
      document.getElementById('searchInput').addEventListener('input', applyFilters);
      // توجه: المنت categoryFilter حذف شده، پس نیازی به رویداد change نیست.
      document.getElementById('hideNoWeight').addEventListener('change', applyFilters);
      document.getElementById('hideNoPrice').addEventListener('change', applyFilters);
      document.getElementById('siteUrl').value = appConfig.siteUrl;
      document.getElementById('consumerKey').value = appConfig.consumerKey;
      document.getElementById('consumerSecret').value = appConfig.consumerSecret;
      document.getElementById('rowsPerPage').value = appConfig.rowsPerPage;
      document.getElementById('showAttrInPopup').checked = appConfig.showAttributesInPopup;
    };

    // expose functions
    window.startIndexing = startIndexing;
    window.pauseIndexing = pauseIndexing;
    window.continueIndexing = continueIndexing;
    window.resetIndexing = resetIndexing;
    window.exportData = exportData;
    window.importData = importData;
    window.closeImportModal = closeImportModal;
    window.confirmImport = confirmImport;
    window.testConnection = testConnection;
    window.saveSettings = saveSettings;
    window.saveDisplaySettings = saveDisplaySettings;
    window.activateLicense = activateLicense;
    window.clearAllAttributeFilters = clearAllAttributeFilters;
    window.filterLogs = filterLogs;
    window.applyDeviceFilter = applyDeviceFilter;
    window.toggleSelectAllSync = toggleSelectAllSync;
    window.syncSelected = syncSelected;
    window.syncAll = syncAll;
    window.stopSync = stopSync;
    window.deleteSelectedSync = deleteSelectedSync;
    window.closeAttributeModal = closeAttributeModal;
	window.selectAllAttrValues = function() {
  document.querySelectorAll('#attributeOptions input[type="checkbox"]')
    .forEach(cb => cb.checked = true);
};

window.clearAllAttrValues = function() {
  document.querySelectorAll('#attributeOptions input[type="checkbox"]')
    .forEach(cb => cb.checked = false);
};

window.applyAttributeFilter = function() {
  if (!currentAttribute) return;
  const checked = Array.from(
    document.querySelectorAll('#attributeOptions input[type="checkbox"]:checked')
  ).map(cb => cb.value);
  
  if (checked.length === 0) {
    delete attributeFilters[currentAttribute];
  } else {
    attributeFilters[currentAttribute] = checked;
  }
  closeAttributeModal();
  applyFilters();
};
    window.applyAttributeSelection = applyAttributeSelection;
    window.savePrice = savePrice; // ensure it's globally available
    window.clearCategoryFilters = clearCategoryFilters;
    window.selectAllCategories = selectAllCategories;
	// ==================== توابع سفارشات ====================
async function loadOrders() {
  showLoading();
  try {
    const status = document.getElementById('orderStatusFilter').value;
    const dateFrom = document.getElementById('orderDateFrom').value;
    const dateTo = document.getElementById('orderDateTo').value;
    const search = document.getElementById('orderSearchInput').value;

    let url = `${appConfig.siteUrl}/wp-json/wc/v3/orders?per_page=100&consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}`;
    if (status) url += `&status=${status}`;
    if (dateFrom) url += `&after=${dateFrom}T00:00:00`;
    if (dateTo) url += `&before=${dateTo}T23:59:59`;
    if (search) url += `&search=${encodeURIComponent(search)}`;

    const res = await fetch(url);
    if (!res.ok) throw new Error('خطا در دریافت سفارشات');
    const data = await res.json();

    currentOrders = data.map(order => ({
      id: order.id,
      number: order.number,
      customer_name: `${order.billing.first_name} ${order.billing.last_name}`.trim() || '---',
      customer_email: order.billing.email,
      customer_phone: order.billing.phone,
      total: order.total,
      status: order.status,
      payment_method: order.payment_method_title,
      date_created: order.date_created,
      line_items: order.line_items,
      shipping: order.shipping,
      billing: order.billing,
      customer_note: order.customer_note || ''
    }));

    applyOrderFilters(); // فیلتر و مرتب‌سازی اولیه
    log(`تعداد ${currentOrders.length} سفارش بارگذاری شد`, 'info');
  } catch (error) {
    console.error(error);
    alert('خطا در بارگذاری سفارشات');
  } finally {
    hideLoading();
  }
}

function applyOrderFilters() {
  const search = document.getElementById('orderSearchInput').value.toLowerCase();
  filteredOrders = currentOrders.filter(o => {
    if (search && !(o.number.toLowerCase().includes(search) ||
                   o.customer_name.toLowerCase().includes(search) ||
                   (o.customer_phone && o.customer_phone.includes(search)))) return false;
    return true;
  });
  sortOrders();
  ordersCurrentPage = 1;
  displayOrders();
  updateOrderStats();
}

function sortOrders() {
  filteredOrders.sort((a, b) => {
    let va = a[orderSortColumn] || '';
    let vb = b[orderSortColumn] || '';
    if (orderSortColumn === 'date_created') {
      va = new Date(va);
      vb = new Date(vb);
    } else if (orderSortColumn === 'total') {
      va = parseFloat(va);
      vb = parseFloat(vb);
    }
    if (orderSortDirection === 'asc') return va > vb ? 1 : -1;
    else return va < vb ? 1 : -1;
  });
}

function displayOrders() {
  const tbody = document.getElementById('ordersTableBody');
  const start = (ordersCurrentPage - 1) * ORDERS_PER_PAGE;
  const pageData = filteredOrders.slice(start, start + ORDERS_PER_PAGE);
  
  if (!pageData.length) {
    tbody.innerHTML = `<tr><td colspan="8" style="text-align:center; padding:2rem;">هیچ سفارشی یافت نشد</td></tr>`;
    document.getElementById('ordersCount').innerText = '0';
    renderOrdersPagination();
    return;
  }

  tbody.innerHTML = pageData.map(order => {
    const checked = selectedOrders.has(order.id) ? 'checked' : '';
    const statusText = getOrderStatusText(order.status);
    return `
      <tr>
        <td><input type="checkbox" data-id="${order.id}" ${checked} onchange="toggleOrderSelect(${order.id}, this.checked)"></td>
        <td><strong style="color:var(--accent-gold);">#${order.number}</strong></td>
        <td>
          <div>${order.customer_name}</div>
          <small style="opacity:0.7;">${order.customer_phone || ''}</small>
        </td>
        <td>${new Date(order.date_created).toLocaleDateString('fa-IR')}</td>
        <td>${parseInt(order.total).toLocaleString('fa-IR')}</td>
        <td><span class="status-badge status-${order.status}">${statusText}</span></td>
        <td>${order.payment_method || '---'}</td>
        <td>
          <div class="action-buttons">
            <button class="action-btn" onclick="viewOrderDetail(${order.id})" title="جزئیات">👁️</button>
            <button class="action-btn" onclick="openChangeOrderStatus(${order.id})" title="تغییر وضعیت">✏️</button>
            <button class="action-btn" onclick="printOrderInvoice(${order.id})" title="چاپ فاکتور">🖨️</button>
          </div>
        </td>
      </tr>
    `;
  }).join('');

  document.getElementById('ordersCount').innerText = filteredOrders.length.toLocaleString();
  renderOrdersPagination();
}

function renderOrdersPagination() {
  const totalPages = Math.ceil(filteredOrders.length / ORDERS_PER_PAGE);
  let html = '';
  if (ordersCurrentPage > 1) html += `<button class="page-btn" onclick="changeOrdersPage(${ordersCurrentPage-1})">❮</button>`;
  for (let i = Math.max(1, ordersCurrentPage-2); i <= Math.min(totalPages, ordersCurrentPage+2); i++) {
    html += `<button class="page-btn ${i===ordersCurrentPage?'active':''}" onclick="changeOrdersPage(${i})">${i}</button>`;
  }
  if (ordersCurrentPage < totalPages) html += `<button class="page-btn" onclick="changeOrdersPage(${ordersCurrentPage+1})">❯</button>`;
  document.getElementById('ordersPagination').innerHTML = html;
}

function changeOrdersPage(p) { ordersCurrentPage = p; displayOrders(); }

function updateOrderStats() {
  const total = filteredOrders.length;
  const pending = filteredOrders.filter(o => o.status === 'pending').length;
  const completed = filteredOrders.filter(o => o.status === 'completed').length;
  const today = new Date().toISOString().split('T')[0];
  const todayRevenue = filteredOrders
    .filter(o => o.date_created.startsWith(today) && o.status === 'completed')
    .reduce((sum, o) => sum + parseFloat(o.total), 0);
  
  document.getElementById('ordTotal').innerText = total.toLocaleString('fa-IR');
  document.getElementById('ordPending').innerText = pending.toLocaleString('fa-IR');
  document.getElementById('ordCompleted').innerText = completed.toLocaleString('fa-IR');
  document.getElementById('ordTodayRevenue').innerText = Math.round(todayRevenue).toLocaleString('fa-IR');
}

function getOrderStatusText(st) {
  const map = { pending:'در انتظار', processing:'در حال انجام', completed:'تکمیل شده', cancelled:'لغو شده', refunded:'مرجوع' };
  return map[st] || st;
}

window.toggleOrderSelect = (id, checked) => {
  if (checked) selectedOrders.add(id); else selectedOrders.delete(id);
};

window.toggleSelectAllOrders = () => {
  const cb = document.getElementById('selectAllOrders');
  const pageData = filteredOrders.slice((ordersCurrentPage-1)*ORDERS_PER_PAGE, ordersCurrentPage*ORDERS_PER_PAGE);
  if (cb.checked) pageData.forEach(o => selectedOrders.add(o.id));
  else pageData.forEach(o => selectedOrders.delete(o.id));
  displayOrders();
};

window.viewOrderDetail = (orderId) => {
  const order = currentOrders.find(o => o.id === orderId);
  if (!order) return;
  const items = order.line_items || [];
  
  let modalHtml = `
    <div style="margin-bottom:1rem;">
      <h3 style="color:var(--accent-gold);">سفارش #${order.number}</h3>
      <p>تاریخ: ${new Date(order.date_created).toLocaleString('fa-IR')}</p>
    </div>
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
      <div><strong>مشتری:</strong> ${order.customer_name}<br>📧 ${order.customer_email || '---'}<br>📞 ${order.customer_phone || '---'}</div>
      <div><strong>آدرس:</strong> ${order.billing?.address_1 || ''} ${order.billing?.city || ''}</div>
    </div>
    <h4>اقلام سفارش:</h4>
    <table class="order-items-table">
      ${items.map(item => `
        <tr><td>${item.name} × ${item.quantity}</td><td style="text-align:left;">${parseInt(item.total).toLocaleString('fa-IR')} تومان</td></tr>
      `).join('')}
    </table>
    <div style="text-align:left; margin-top:1rem; font-size:1.2rem; font-weight:bold;">
      جمع کل: ${parseInt(order.total).toLocaleString('fa-IR')} تومان
    </div>
    ${order.customer_note ? `<div style="margin-top:1rem; padding:0.5rem; background:rgba(212,175,55,0.1); border-radius:0.5rem;">📝 ${order.customer_note}</div>` : ''}
  `;
  
  showModal('جزئیات سفارش', modalHtml);
};

window.openChangeOrderStatus = (orderId) => {
  const order = currentOrders.find(o => o.id === orderId);
  if (!order) return;
  
  let html = `
    <input type="hidden" id="modalOrderId" value="${orderId}">
    <div class="form-group">
      <label>وضعیت جدید:</label>
      <select id="modalNewStatus" class="form-input">
        <option value="pending" ${order.status==='pending'?'selected':''}>در انتظار</option>
        <option value="processing" ${order.status==='processing'?'selected':''}>در حال انجام</option>
        <option value="completed" ${order.status==='completed'?'selected':''}>تکمیل شده</option>
        <option value="cancelled" ${order.status==='cancelled'?'selected':''}>لغو شده</option>
      </select>
    </div>
    <div class="form-group">
      <label>یادداشت:</label>
      <textarea id="modalStatusNote" class="form-textarea" placeholder="اختیاری..."></textarea>
    </div>
    <button class="btn btn-gold" onclick="submitOrderStatusChange()">ذخیره</button>
  `;
  showModal('تغییر وضعیت سفارش', html);
};

window.submitOrderStatusChange = async () => {
  const orderId = document.getElementById('modalOrderId').value;
  const newStatus = document.getElementById('modalNewStatus').value;
  const note = document.getElementById('modalStatusNote').value;
  
  showLoading();
  try {
    const url = `${appConfig.siteUrl}/wp-json/wc/v3/orders/${orderId}?consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}`;
    const res = await fetch(url, {
      method: 'PUT',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify({ status: newStatus })
    });
    if (!res.ok) throw new Error('خطا');
    
    // افزودن یادداشت (اختیاری)
    if (note) {
      await fetch(`${appConfig.siteUrl}/wp-json/wc/v3/orders/${orderId}/notes?consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ note, customer_note: false })
      });
    }
    
    closeModal();
    loadOrders();
    log(`وضعیت سفارش #${orderId} به ${getOrderStatusText(newStatus)} تغییر یافت`, 'success');
  } catch (e) {
    alert('خطا در تغییر وضعیت');
  } finally {
    hideLoading();
  }
};

window.printOrderInvoice = (orderId) => {
  const order = currentOrders.find(o => o.id === orderId);
  if (!order) return;
  const items = order.line_items || [];
  const printWin = window.open('', '_blank');
  printWin.document.write(`
    <html dir="rtl"><head><title>فاکتور ${order.number}</title>
    <style>body{font-family:system-ui;padding:20px;max-width:800px;margin:0 auto;} .header{text-align:center;border-bottom:2px solid #d4af37;padding-bottom:10px;} table{width:100%;border-collapse:collapse;margin:20px 0;} td,th{padding:8px;border-bottom:1px solid #ddd;} .total{text-align:left;font-size:1.2em;}</style>
    </head><body>
    <div class="header"><h1>جواهری مشاهیر</h1><p>فاکتور رسمی</p></div>
    <p><strong>شماره سفارش:</strong> ${order.number}</p>
    <p><strong>مشتری:</strong> ${order.customer_name}</p>
    <p><strong>تاریخ:</strong> ${new Date(order.date_created).toLocaleDateString('fa-IR')}</p>
    <table><thead><tr><th>محصول</th><th>تعداد</th><th>قیمت واحد</th><th>جمع</th></tr></thead><tbody>
    ${items.map(i => `<tr><td>${i.name}</td><td>${i.quantity}</td><td>${parseInt(i.price).toLocaleString('fa-IR')}</td><td>${parseInt(i.total).toLocaleString('fa-IR')}</td></tr>`).join('')}
    </tbody></table>
    <div class="total">جمع کل: ${parseInt(order.total).toLocaleString('fa-IR')} تومان</div>
    </body></html>
  `);
  printWin.document.close();
  printWin.print();
};

function exportOrdersToExcel() {
  let csv = "\uFEFFشماره سفارش,مشتری,تاریخ,مبلغ,وضعیت,پرداخت\n";
  filteredOrders.forEach(o => {
    csv += `"${o.number}","${o.customer_name}","${o.date_created}","${o.total}","${getOrderStatusText(o.status)}","${o.payment_method||''}"\n`;
  });
  const blob = new Blob([csv], {type: 'text/csv;charset=utf-8;'});
  const a = document.createElement('a');
  a.href = URL.createObjectURL(blob);
  a.download = `orders_${new Date().toISOString().slice(0,10)}.csv`;
  a.click();
}

function batchChangeOrderStatus() {
  if (selectedOrders.size === 0) { alert('هیچ سفارشی انتخاب نشده'); return; }
  let html = `
    <p>${selectedOrders.size} سفارش انتخاب شده</p>
    <div class="form-group">
      <label>وضعیت جدید:</label>
      <select id="batchNewStatus" class="form-input">
        <option value="pending">در انتظار</option>
        <option value="processing">در حال انجام</option>
        <option value="completed">تکمیل شده</option>
        <option value="cancelled">لغو شده</option>
      </select>
    </div>
    <button class="btn btn-gold" onclick="submitBatchStatusChange()">اعمال</button>
  `;
  showModal('تغییر وضعیت گروهی', html);
}

window.submitBatchStatusChange = async () => {
  const newStatus = document.getElementById('batchNewStatus').value;
  const ids = Array.from(selectedOrders);
  showLoading();
  let success = 0;
  for (const id of ids) {
    try {
      const url = `${appConfig.siteUrl}/wp-json/wc/v3/orders/${id}?consumer_key=${appConfig.consumerKey}&consumer_secret=${appConfig.consumerSecret}`;
      const res = await fetch(url, {
        method: 'PUT',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ status: newStatus })
      });
      if (res.ok) success++;
    } catch (e) {}
  }
  closeModal();
  loadOrders();
  selectedOrders.clear();
  log(`وضعیت ${success} سفارش به ${getOrderStatusText(newStatus)} تغییر یافت`, 'success');
  hideLoading();
};

// تابع کمکی برای نمایش مودال (سازگار با طراحی رادیکال)
function showModal(title, content) {
  let modal = document.getElementById('orderActionModal');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'orderActionModal';
    modal.className = 'modal-overlay';
    modal.style.display = 'flex';
    modal.innerHTML = `
      <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle" style="color:var(--accent-gold); margin-bottom:1rem;">${title}</h3>
        <div id="modalBody"></div>
      </div>
    `;
    document.body.appendChild(modal);
  } else {
    modal.style.display = 'flex';
    modal.querySelector('#modalTitle').innerText = title;
  }
  modal.querySelector('#modalBody').innerHTML = content;
}

window.closeModal = () => {
  document.getElementById('orderActionModal').style.display = 'none';
};

// اتصال رویدادهای فیلتر
document.addEventListener('DOMContentLoaded', () => {
  const statusFilter = document.getElementById('orderStatusFilter');
  const dateFrom = document.getElementById('orderDateFrom');
  const dateTo = document.getElementById('orderDateTo');
  const searchInput = document.getElementById('orderSearchInput');
  if (statusFilter) statusFilter.addEventListener('change', applyOrderFilters);
  if (dateFrom) dateFrom.addEventListener('change', applyOrderFilters);
  if (dateTo) dateTo.addEventListener('change', applyOrderFilters);
  if (searchInput) searchInput.addEventListener('input', applyOrderFilters);
});

// مرتب‌سازی جدول سفارشات (برای کلیک روی هدرها)
window.sortOrdersBy = (col) => {
  if (orderSortColumn === col) orderSortDirection = orderSortDirection === 'asc' ? 'desc' : 'asc';
  else { orderSortColumn = col; orderSortDirection = 'asc'; }
  sortOrders();
  displayOrders();
};
  })();


function issueCertificate(id){

window.open("product_certificate.php?id="+id,"_blank");

}

</script>

<footer style="text-align:center; margin-top:2rem; color:rgba(255,255,255,0.5); font-size:0.7rem;">
  <a href="#" onclick="showInstallPrompt()" style="color:var(--accent-gold);">نصب اپلیکیشن</a> | 
  <a href="#" onclick="showHelp()" style="color:var(--accent-gold);">راهنما</a>
  <br>رادیکال ایندکس‌ساز · تمام حقوق محفوظ است
</footer>
</body>
</html>
