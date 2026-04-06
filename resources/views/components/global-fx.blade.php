<!-- Custom Cursor Markup -->
<div id="cursor-dot"></div>
<div id="cursor-outline"></div>

<style>
/* ─────────────────────────────────────────────────────────
   ADVANCED CURSOR ENGINE v2
───────────────────────────────────────────────────────── */
*, *::before, *::after { cursor: none !important; }

#cursor-dot {
    position: fixed; top: 0; left: 0; z-index: 999999;
    width: 6px; height: 6px;
    background: var(--ss-cyan);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
    transition: width 0.15s, height 0.15s, background 0.15s, border-radius 0.15s;
    box-shadow: 0 0 8px var(--ss-cyan);
}

#cursor-outline {
    position: fixed; top: 0; left: 0; z-index: 999998;
    width: 32px; height: 32px;
    border: 1.5px solid rgba(0,212,255,0.45);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
    transition: width 0.2s cubic-bezier(.16,1,.3,1),
                height 0.2s cubic-bezier(.16,1,.3,1),
                border-color 0.2s,
                background 0.2s,
                border-radius 0.2s;
}

/* States */
body.cur-link #cursor-dot {
    width: 5px; height: 5px;
    /* inner dot becomes thin crosshair via background trick */
    background: transparent;
    box-shadow: none;
    border: 2px solid var(--ss-cyan);
}
body.cur-link #cursor-outline {
    width: 44px; height: 44px;
    border-color: rgba(0,212,255,0.8);
    background: rgba(0,212,255,0.07);
}
body.cur-btn #cursor-dot {
    width: 8px; height: 8px;
    background: #fff;
    box-shadow: 0 0 10px var(--ss-cyan);
}
body.cur-btn #cursor-outline {
    width: 52px; height: 52px;
    border-color: rgba(0,212,255,1);
    background: rgba(0,212,255,0.12);
}
body.cur-danger #cursor-dot   { background: var(--ss-rose); box-shadow: 0 0 10px var(--ss-rose); }
body.cur-danger #cursor-outline{ border-color: var(--ss-rose); background: rgba(244,63,94,0.1); }

/* Click pulse ring */
.cursor-pulse {
    position: fixed; z-index: 999997;
    width: 6px; height: 6px;
    border: 1.5px solid rgba(0,212,255,0.8);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
    animation: cursorPulse 0.55s cubic-bezier(.16,1,.3,1) forwards;
}
@keyframes cursorPulse {
    from { width: 6px; height: 6px; opacity: 0.9; }
    to   { width: 60px; height: 60px; opacity: 0; }
}

/* ─────────────────────────────────────────────────────────
   PARTICLE CANVAS BACKGROUND
───────────────────────────────────────────────────────── */
#ss-particles {
    position: fixed; inset: 0;
    z-index: 0; pointer-events: none;
    opacity: 0.7;
}
</style>

<canvas id="ss-particles"></canvas>

<script>
(function () {
    /* ─── Cursor Engine ─── */
    const dot     = document.getElementById('cursor-dot');
    const outline = document.getElementById('cursor-outline');
    if (!dot || !outline) return;

    let mx = window.innerWidth  / 2;
    let my = window.innerHeight / 2;
    let ox = mx, oy = my;

    window.addEventListener('mousemove', e => {
        mx = e.clientX; my = e.clientY;
        dot.style.left = mx + 'px';
        dot.style.top  = my + 'px';
    });

    /* Lerp speeds per state */
    let lerpSpeed = 0.14;

    function animateCursor() {
        ox += (mx - ox) * lerpSpeed;
        oy += (my - oy) * lerpSpeed;
        outline.style.left = ox + 'px';
        outline.style.top  = oy + 'px';
        requestAnimationFrame(animateCursor);
    }
    animateCursor();

    /* Click pulse */
    document.addEventListener('mousedown', () => {
        const pulse = document.createElement('div');
        pulse.className = 'cursor-pulse';
        pulse.style.left = mx + 'px';
        pulse.style.top  = my + 'px';
        document.body.appendChild(pulse);
        setTimeout(() => pulse.remove(), 560);
    });

    /* Hover detection */
    function resetState() {
        document.body.classList.remove('cur-link','cur-btn','cur-danger');
        lerpSpeed = 0.14;
    }

    function attachHover() {
        document.querySelectorAll('a:not([data-cur]), button:not([data-cur])').forEach(el => {
            if (el.dataset.cur) return;
            el.dataset.cur = '1';

            el.addEventListener('mouseenter', () => {
                resetState();
                const isDanger = el.closest('.ss-btn-danger') || el.classList.contains('ss-btn-danger');
                if (el.tagName === 'BUTTON' || el.type === 'submit') {
                    document.body.classList.add(isDanger ? 'cur-danger' : 'cur-btn');
                    lerpSpeed = 0.22; /* snappy on buttons */
                } else {
                    document.body.classList.add('cur-link');
                    lerpSpeed = 0.10; /* cinematic on links */
                }
            });
            el.addEventListener('mouseleave', resetState);
        });
    }

    attachHover();
    setInterval(attachHover, 1500);

    /* ─── Particle Network Canvas ─── */
    const canvas = document.getElementById('ss-particles');
    const ctx    = canvas.getContext('2d');
    let W, H, particles = [];

    function resize() {
        W = canvas.width  = window.innerWidth;
        H = canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    const COUNT = window.innerWidth < 768 ? 28 : 55;
    for (let i = 0; i < COUNT; i++) {
        particles.push({
            x: Math.random() * window.innerWidth,
            y: Math.random() * window.innerHeight,
            vx: (Math.random() - 0.5) * 0.35,
            vy: (Math.random() - 0.5) * 0.35,
            r: Math.random() * 1.4 + 0.4
        });
    }

    function draw() {
        ctx.clearRect(0, 0, W, H);
        particles.forEach(p => {
            p.x += p.vx; p.y += p.vy;
            if (p.x < 0 || p.x > W) p.vx *= -1;
            if (p.y < 0 || p.y > H) p.vy *= -1;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(0,212,255,0.65)';
            ctx.fill();
        });

        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx  = particles[i].x - particles[j].x;
                const dy  = particles[i].y - particles[j].y;
                const d   = Math.sqrt(dx*dx + dy*dy);
                if (d < 140) {
                    ctx.strokeStyle = `rgba(0,212,255,${0.13 * (1 - d/140)})`;
                    ctx.lineWidth = 0.5;
                    ctx.beginPath();
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
            /* connect to cursor */
            const dx = particles[i].x - ox;
            const dy = particles[i].y - oy;
            const d  = Math.sqrt(dx*dx + dy*dy);
            if (d < 180) {
                ctx.strokeStyle = `rgba(0,212,255,${0.28 * (1 - d/180)})`;
                ctx.lineWidth = 0.9;
                ctx.beginPath();
                ctx.moveTo(particles[i].x, particles[i].y);
                ctx.lineTo(ox, oy);
                ctx.stroke();
            }
        }
        requestAnimationFrame(draw);
    }
    draw();
}());
</script>
