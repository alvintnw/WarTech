/* ============================================
   WARTECH - SPLASH SCREEN JS
   File: script.js (root folder)
   ============================================ */

(function () {
    var redirectUrl   = 'dashboard.php';
    var totalDuration = 3000;

    var loaderFill     = document.getElementById('loaderFill');
    var loaderText     = document.getElementById('loaderText');
    var percentText    = document.getElementById('percentText');
    var successOverlay = document.getElementById('successOverlay');

    if (!loaderFill || !successOverlay) return;

    var messages = [
        { pct: 0,   text: 'Memuat konfigurasi...' },
        { pct: 30,  text: 'Menghubungkan database...' },
        { pct: 55,  text: 'Menyiapkan data produk...' },
        { pct: 75,  text: 'Memuat komponen dashboard...' },
        { pct: 90,  text: 'Hampir selesai...' },
        { pct: 100, text: 'Siap!' },
    ];

    var startTime = null;

    function easeOutCubic(t) {
        return 1 - Math.pow(1 - t, 3);
    }

    function updateMessage(pct) {
        var current = messages[0].text;
        for (var i = 0; i < messages.length; i++) {
            if (pct >= messages[i].pct) current = messages[i].text;
        }
        if (loaderText.textContent !== current) {
            loaderText.style.opacity = '0';
            setTimeout(function () {
                loaderText.textContent = current;
                loaderText.style.opacity = '1';
            }, 150);
        }
    }

    function animate(timestamp) {
        if (!startTime) startTime = timestamp;
        var elapsed  = timestamp - startTime;
        var progress = Math.min(elapsed / totalDuration, 1);
        var eased    = easeOutCubic(progress);
        var pct      = Math.round(eased * 100);

        loaderFill.style.width  = pct + '%';
        percentText.textContent = pct + '%';
        updateMessage(pct);

        if (progress < 1) {
            requestAnimationFrame(animate);
        } else {
            showSuccess();
        }
    }

    function showSuccess() {
        successOverlay.classList.add('show');
        setTimeout(function () {
            window.location.href = redirectUrl;
        }, 900);
    }

    requestAnimationFrame(animate);
})();