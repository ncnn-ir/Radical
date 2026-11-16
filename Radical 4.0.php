<!DOCTYPE html>
<html lang="fa" dir="rtl" data-theme="dark" data-preset="default" data-color="cyan">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<meta name="theme-color" content="#0a0e17">
<title>⛵ کشتی نوح v1.4.4 — گروه هنری اقاقیا</title>
<script src="https://unpkg.com/@phosphor-icons/web"></script>
<link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/lz-string@1.5.0/libs/lz-string.min.js"></script>
<style>
*{box-sizing:border-box;margin:0;padding:0;-webkit-tap-highlight-color:transparent}
:root{
  --bg1:#070b14; --bg2:#14081f; --bg3:#061a24;
  --surface:rgba(255,255,255,0.09); --surface2:rgba(255,255,255,0.14); --surface3:rgba(255,255,255,0.20);
  --glass-solid:rgba(15,22,35,0.88);
  --border:rgba(255,255,255,0.14); --border2:rgba(255,255,255,0.24);
  --text:#e9f0f8; --text2:#93a4bb; --text3:#5a6b7f;
  --accent:#22d3ee; --accent2:#a855f7; --accent3:#f472b6;
  --ok:#34d399; --warn:#fbbf24; --err:#f87171;
  --shadow:0 12px 40px rgba(0,0,0,0.45); --shadow-sm:0 4px 16px rgba(0,0,0,0.28);
  --radius:18px; --radius-sm:12px; --blur:24px;
  --spring:cubic-bezier(.34,1.56,.64,1);
  --stripe:rgba(255,255,255,0.025);
  --card-elev: 0 8px 32px rgba(0,0,0,0.45), inset 0 1px 0 rgba(255,255,255,0.10);
}
[data-theme="light"]{
  --bg1:#e8eef6; --bg2:#eee6f8; --bg3:#e0eef6;
  --surface:rgba(255,255,255,0.72); --surface2:rgba(255,255,255,0.90);
  --surface3:rgba(255,255,255,0.98); --glass-solid:rgba(248,250,254,0.92);
  --border:rgba(30,50,90,0.14); --border2:rgba(30,50,90,0.28);
  --text:#1a2332; --text2:#556780; --text3:#8090a5;
  --shadow:0 12px 40px rgba(50,80,120,0.12); --shadow-sm:0 4px 16px rgba(50,80,120,0.08);
  --stripe:rgba(30,50,90,0.025);
  --card-elev: 0 8px 32px rgba(50,80,120,0.10), inset 0 1px 0 rgba(255,255,255,0.6);
}
[data-color="blue"]{--accent:#3b82f6;--accent2:#6366f1;--accent3:#8b5cf6}
[data-color="purple"]{--accent:#a855f7;--accent2:#d946ef;--accent3:#ec4899}
[data-color="green"]{--accent:#10b981;--accent2:#22c55e;--accent3:#84cc16}
[data-color="orange"]{--accent:#f97316;--accent2:#f59e0b;--accent3:#ef4444}
[data-color="pink"]{--accent:#ec4899;--accent2:#f472b6;--accent3:#fbbf24}
[data-color="red"]{--accent:#ef4444;--accent2:#dc2626;--accent3:#f97316}
[data-color="teal"]{--accent:#14b8a6;--accent2:#0d9488;--accent3:#06b6d4}
[data-color="amber"]{--accent:#f59e0b;--accent2:#d97706;--accent3:#eab308}
[data-color="dracula"]{--accent:#bd93f9;--accent2:#ff79c6;--accent3:#50fa7b}
[data-color="monokai"]{--accent:#a6e22e;--accent2:#f92672;--accent3:#66d9ef}
[data-color="nord"]{--accent:#88c0d0;--accent2:#81a1c1;--accent3:#5e81ac}
[data-color="tokyo"]{--accent:#7aa2f7;--accent2:#bb9af7;--accent3:#7dcfff}

/* DISTINCT PRESETS */
[data-preset="default"]{--radius:18px;--radius-sm:12px;--blur:24px}
[data-preset="material"]{
  --radius:4px; --radius-sm:2px; --blur:0px;
  --surface:rgba(255,255,255,0.10); --surface2:rgba(255,255,255,0.16); --surface3:rgba(255,255,255,0.22);
  --border:rgba(255,255,255,0.08); --border2:rgba(255,255,255,0.16);
  --shadow:0 2px 4px rgba(0,0,0,0.2),0 4px 8px rgba(0,0,0,0.15),0 8px 16px rgba(0,0,0,0.12);
  --glass-solid:rgba(20,26,38,0.98);
}
[data-theme="light"][data-preset="material"]{
  --surface:rgba(255,255,255,0.98); --surface2:rgba(245,248,252,0.98); --surface3:#fff;
  --border:rgba(30,50,90,0.12); --border2:rgba(30,50,90,0.24);
  --glass-solid:rgba(255,255,255,0.99);
  --shadow:0 1px 3px rgba(50,80,120,0.15),0 4px 8px rgba(50,80,120,0.10),0 8px 16px rgba(50,80,120,0.08);
}
[data-preset="liquid"]{
  --radius:32px; --radius-sm:20px; --blur:52px;
  --surface:rgba(255,255,255,0.14); --surface2:rgba(255,255,255,0.20); --surface3:rgba(255,255,255,0.28);
  --border:rgba(255,255,255,0.26); --border2:rgba(255,255,255,0.40);
  --shadow:0 16px 56px rgba(0,0,0,0.55),inset 0 2px 0 rgba(255,255,255,0.20);
  --glass-solid:rgba(15,22,35,0.72);
}
[data-theme="light"][data-preset="liquid"]{
  --surface:rgba(255,255,255,0.60); --surface2:rgba(255,255,255,0.85); --surface3:rgba(255,255,255,0.96);
  --glass-solid:rgba(248,250,254,0.75);
}
[data-preset="win11"]{
  --radius:8px; --radius-sm:6px; --blur:32px;
  --surface:rgba(40,45,55,0.70); --surface2:rgba(48,52,62,0.85); --surface3:rgba(56,60,70,0.95);
  --border:rgba(255,255,255,0.09); --border2:rgba(255,255,255,0.14);
  --shadow:0 4px 20px rgba(0,0,0,0.35),inset 0 1px 0 rgba(255,255,255,0.06);
  --glass-solid:rgba(32,36,44,0.85);
}
[data-theme="light"][data-preset="win11"]{
  --surface:rgba(252,252,254,0.80); --surface2:rgba(248,248,252,0.92); --surface3:#fff;
  --border:rgba(30,50,90,0.10); --border2:rgba(30,50,90,0.18);
  --glass-solid:rgba(252,252,254,0.88);
}

html,body{min-height:100vh;font-family:'Vazirmatn','Segoe UI',Tahoma,sans-serif;color:var(--text);background:var(--bg1);transition:background .4s,color .4s;line-height:1.55;overflow-x:hidden}
body::before{content:'';position:fixed;inset:-20%;z-index:-2;background:radial-gradient(ellipse at 20% 10%,var(--bg2) 0%,transparent 55%),radial-gradient(ellipse at 80% 90%,var(--bg3) 0%,transparent 55%),var(--bg1);animation:drift 28s ease-in-out infinite alternate}
@keyframes drift{to{transform:translate(-2%,2%) scale(1.05)}}
.glass{background:var(--surface);backdrop-filter:blur(var(--blur)) saturate(180%);-webkit-backdrop-filter:blur(var(--blur)) saturate(180%);border:1px solid var(--border);border-radius:var(--radius);box-shadow:var(--card-elev)}

/* SPLASH */
.splash{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;overflow:hidden;background:linear-gradient(180deg,#02050f 0%,#070b14 40%,#0d0f2a 70%,#1a0f2e 100%);transition:opacity .6s ease,visibility .6s ease}
.splash.hide{opacity:0;visibility:hidden;pointer-events:none}
.splash-stars{position:absolute;inset:0}
.splash-star{position:absolute;border-radius:50%;background:#fff;box-shadow:0 0 3px rgba(255,255,255,0.9);animation:twinkle 3s ease-in-out infinite}
@keyframes twinkle{0%,100%{opacity:.35;transform:scale(.7)}50%{opacity:1;transform:scale(1.15)}}
.splash-moon{position:absolute;top:12%;right:14%;width:72px;height:72px;border-radius:50%;background:radial-gradient(circle at 35% 35%,#f5f7fb,#d0d8e6 50%,#98a3b8 100%);box-shadow:0 0 60px rgba(200,220,255,0.55),inset -8px -8px 22px rgba(90,110,145,0.35);overflow:hidden}
.splash-moon::before,.splash-moon::after{content:'';position:absolute;border-radius:50%;background:rgba(130,145,175,0.35);box-shadow:inset 1px 1px 3px rgba(70,85,115,0.4)}
.splash-moon::before{width:16px;height:16px;top:26%;left:24%}
.splash-moon::after{width:10px;height:10px;top:56%;left:56%;box-shadow:inset 1px 1px 2px rgba(70,85,115,0.4),18px -22px 0 3px rgba(130,145,175,0.28),-12px 10px 0 1px rgba(130,145,175,0.32)}
.splash-waves{position:absolute;bottom:0;left:0;right:0;height:38%;overflow:hidden}
.splash-wave{position:absolute;bottom:0;left:-50%;width:200%;height:100%;background:radial-gradient(ellipse at 50% 100%,rgba(34,211,238,0.15),transparent 70%)}
.splash-wave:nth-child(1){animation:wave 9s linear infinite;opacity:.6}
.splash-wave:nth-child(2){animation:wave 13s linear infinite reverse;opacity:.45;background:radial-gradient(ellipse at 50% 100%,rgba(168,85,247,0.15),transparent 70%)}
@keyframes wave{0%{transform:translateX(0)}50%{transform:translateX(-25%) translateY(-8px)}100%{transform:translateX(-50%)}}
.splash-inner{position:relative;z-index:2;text-align:center;padding:20px;animation:splashIn 1s var(--spring)}
@keyframes splashIn{from{opacity:0;transform:scale(.85)}to{opacity:1;transform:none}}
.splash .logo-wrap{display:inline-block;margin-bottom:14px;animation:shipBob 3s ease-in-out infinite;filter:drop-shadow(0 0 24px rgba(34,211,238,0.6))}
.splash .logo-wrap svg{width:96px;height:96px;display:block}
@keyframes shipBob{0%,100%{transform:translateY(0) rotate(-3deg)}50%{transform:translateY(-10px) rotate(3deg)}}
.splash h1{font-size:34px;font-weight:900;background:linear-gradient(135deg,#22d3ee,#a855f7,#f472b6);-webkit-background-clip:text;background-clip:text;color:transparent}
.splash .msg{font-size:13px;color:#93a4bb;margin-top:14px;min-height:20px}
.splash .ver{font-size:10px;color:#5a6b7f;margin-top:26px}
.splash .bar{width:180px;height:4px;background:rgba(255,255,255,0.08);border-radius:3px;margin:22px auto 0;overflow:hidden}
.splash .bar::after{content:'';display:block;height:100%;width:40%;background:linear-gradient(90deg,#22d3ee,#a855f7,#f472b6);border-radius:3px;animation:loadBar 1.6s ease-in-out infinite}
@keyframes loadBar{0%{margin-left:-40%;width:30%}50%{margin-left:20%;width:50%}100%{margin-left:100%;width:30%}}

/* TOPBAR */
.topbar{position:sticky;top:10px;z-index:50;margin:10px auto;max-width:1180px;width:calc(100% - 20px);padding:8px 14px;display:flex;align-items:center;justify-content:space-between;gap:10px;background:var(--glass-solid);backdrop-filter:blur(28px) saturate(180%);-webkit-backdrop-filter:blur(28px) saturate(180%);border-radius:18px;border:1px solid var(--border)}
.brand{display:flex;align-items:center;gap:9px;flex-shrink:0;order:1}
.topbar-actions{display:flex;gap:6px;order:3;flex-shrink:0}
.tabs{display:none;gap:4px;flex:1;justify-content:center;order:2}
@media(min-width:721px){.tabs{display:flex}}
.brand-icon{width:34px;height:34px;display:grid;place-items:center;flex-shrink:0}
.brand-icon svg{width:100%;height:100%;filter:drop-shadow(0 2px 6px rgba(34,211,238,0.45))}
.brand h1{font-size:15px;font-weight:800;background:linear-gradient(90deg,var(--accent),var(--accent2),var(--accent3));-webkit-background-clip:text;background-clip:text;color:transparent;line-height:1.1}
.brand .sub{font-size:9.5px;color:var(--text2);margin-top:1px;text-align:right}
.tab{background:transparent;border:1px solid transparent;color:var(--text2);padding:7px 13px;border-radius:11px;font-family:inherit;font-size:12px;font-weight:600;cursor:pointer;transition:all .25s var(--spring);white-space:nowrap}
.tab:hover{background:var(--surface2);color:var(--text)}
.tab.active{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;box-shadow:0 4px 18px rgba(34,211,238,0.32)}
.icon-btn{background:var(--surface2);border:1px solid var(--border);color:var(--text);width:38px;height:38px;border-radius:11px;cursor:pointer;font-size:17px;display:grid;place-items:center;transition:all .25s var(--spring);flex-shrink:0}
.icon-btn:hover{background:var(--surface3);transform:scale(1.06)}
.icon-btn:active{transform:scale(.94)}
main{max-width:1180px;margin:0 auto;padding:0 10px 130px}
@media(min-width:721px){main{padding-bottom:40px}}
.page{display:none;animation:pageIn .35s ease}
.page.active{display:block}
@keyframes pageIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:none}}
.card{padding:16px;margin-bottom:12px}
@media(max-width:720px){.card{padding:12px;margin-bottom:10px}}
.field{display:flex;flex-direction:column;gap:5px;margin-bottom:10px}
.field label{font-size:11.5px;color:var(--text2);font-weight:600;padding:0 2px;display:flex;align-items:center;gap:5px}
.row{display:grid;grid-template-columns:1fr 1fr;gap:10px}
@media(max-width:720px){.row{grid-template-columns:1fr}}
.row3{display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px}
@media(max-width:900px){.row3{grid-template-columns:1fr 1fr}}
@media(max-width:600px){.row3{grid-template-columns:1fr}}

/* Subtabs */
.subtabs{display:flex;gap:4px;margin-bottom:12px;overflow-x:auto;padding-bottom:2px}
.subtab{padding:7px 13px;border-radius:9px;background:var(--surface);border:1px solid var(--border);color:var(--text2);font-family:inherit;font-size:12px;font-weight:600;cursor:pointer;white-space:nowrap;transition:all .25s;flex-shrink:0}
.subtab:hover{background:var(--surface2);color:var(--text)}
.subtab.active{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;border-color:transparent}
.subpage{display:none}
.subpage.active{display:block;animation:pageIn .25s ease}

/* DROPDOWN */
.dd{position:relative;width:100%}
.dd-trigger{width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:10px 14px;border-radius:var(--radius-sm);font-family:inherit;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:space-between;gap:8px;transition:all .25s;min-height:42px;text-align:right}
.dd-trigger:hover{background:var(--surface2);border-color:var(--border2)}
.dd-trigger.open{border-color:var(--accent);box-shadow:0 0 0 3px rgba(34,211,238,0.15)}
.dd-trigger .placeholder{color:var(--text3);font-weight:400}
.dd-trigger .selected{display:flex;align-items:center;gap:6px;flex:1;min-width:0;overflow:hidden}
.dd-trigger .selected .nm{white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-weight:600}
.dd-trigger .chev{font-size:14px;color:var(--text2);transition:transform .3s var(--spring);flex-shrink:0}
.dd-trigger.open .chev{transform:rotate(180deg)}
.dd-panel{position:absolute;top:calc(100% + 6px);left:0;right:0;z-index:250;background:var(--glass-solid);backdrop-filter:blur(32px) saturate(200%);-webkit-backdrop-filter:blur(32px) saturate(200%);border:1px solid var(--border2);border-radius:var(--radius-sm);box-shadow:var(--shadow);max-height:280px;overflow-y:auto;padding:6px;opacity:0;visibility:hidden;transform:translateY(-6px) scale(.98);transition:all .25s var(--spring);transform-origin:top center}
.dd.open .dd-panel{opacity:1;visibility:visible;transform:none}
.dd-item{padding:9px 10px;border-radius:9px;cursor:pointer;display:flex;align-items:center;gap:8px;font-size:12.5px;transition:background .15s;white-space:nowrap;overflow:hidden;line-height:1.2}
.dd-item:hover{background:var(--surface2)}
.dd-item.active{background:rgba(34,211,238,0.18)}
.dd-item .num{width:20px;height:20px;border-radius:6px;background:var(--surface2);display:grid;place-items:center;font-size:10.5px;font-weight:700;color:var(--text2);flex-shrink:0}
.dd-item.active .num{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff}
.dd-item .ttl{flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;font-weight:600}
.dd-item .dt{font-size:10.5px;color:var(--text3);flex-shrink:0;font-variant-numeric:tabular-nums}
.dd-item .bg{font-size:10px;padding:2px 7px;border-radius:6px;font-weight:700;flex-shrink:0;background:rgba(168,85,247,0.20);color:#c084fc;border:1px solid rgba(168,85,247,0.3)}
.dd-item .bg.new{background:rgba(52,211,153,0.18);color:#34d399;border-color:rgba(52,211,153,0.3)}
.dd-item.empty{color:var(--text3);justify-content:center;cursor:default;padding:14px}
.dd-item.empty:hover{background:transparent}

/* Dropdown Backdrop */
.dd-backdrop{position:fixed;inset:0;z-index:150;background:rgba(5,10,20,0.35);backdrop-filter:blur(6px);-webkit-backdrop-filter:blur(6px);opacity:0;visibility:hidden;transition:all .25s;pointer-events:none}
.dd-backdrop.show{opacity:1;visibility:visible;pointer-events:auto}
[data-theme="light"] .dd-backdrop{background:rgba(200,210,230,0.30)}

/* Code Box */
.code-wrap{position:relative;margin-bottom:10px}
.code-toolbar{position:absolute;top:8px;left:8px;z-index:5;display:flex;gap:4px;background:var(--glass-solid);backdrop-filter:blur(28px) saturate(200%);-webkit-backdrop-filter:blur(28px) saturate(200%);border:1px solid var(--border2);border-radius:12px;padding:4px;box-shadow:var(--shadow-sm)}
.code-toolbar button{background:transparent;border:none;color:var(--text);height:32px;min-width:32px;border-radius:8px;cursor:pointer;font-size:15px;display:grid;place-items:center;transition:all .2s;padding:0 6px}
.code-toolbar button:hover{background:var(--surface2);transform:scale(1.06)}
.code-toolbar button:active{transform:scale(.94)}
.code-toolbar .toolbar-save{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;padding:0 14px;font-size:12px;font-weight:700;display:flex;align-items:center;gap:6px;min-width:88px;box-shadow:0 4px 14px rgba(34,211,238,0.4);border-radius:9px}
.code-toolbar .toolbar-save:hover{transform:scale(1.04);box-shadow:0 6px 20px rgba(34,211,238,0.55)}
textarea.code-input{width:100%;min-height:260px;padding:52px 14px 14px;resize:vertical;background:var(--surface);border:1px solid var(--border);color:var(--text);border-radius:var(--radius-sm);font-family:'JetBrains Mono',Consolas,monospace;font-size:12.5px;line-height:1.6;outline:none;transition:all .25s;direction:ltr;text-align:left}
textarea.code-input:focus{border-color:var(--accent);box-shadow:0 0 0 3px rgba(34,211,238,0.15);background:var(--surface2)}
[data-tip]{position:relative}
[data-tip]::after{content:attr(data-tip);position:absolute;bottom:calc(100% + 8px);left:50%;transform:translateX(-50%) translateY(4px);background:rgba(10,15,25,0.95);color:#fff;padding:6px 11px;border-radius:8px;font-size:11px;font-weight:600;white-space:nowrap;z-index:1000;pointer-events:none;opacity:0;transition:all .2s ease;border:1px solid rgba(255,255,255,0.1)}
[data-theme="light"] [data-tip]::after{background:rgba(20,30,45,0.94)}
[data-tip]:hover::after{opacity:1;transform:translateX(-50%) translateY(0)}
.icon-action{background:var(--surface2);border:1px solid var(--border);color:var(--text);height:44px;min-width:44px;padding:0 14px;border-radius:11px;font-family:inherit;font-size:18px;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;gap:6px;transition:all .25s var(--spring);flex-shrink:0}
.icon-action:hover{background:var(--surface3);border-color:var(--border2);transform:translateY(-1px)}
.icon-action:active{transform:scale(.96)}
.icon-action.primary{background:linear-gradient(135deg,var(--accent),var(--accent2));border-color:transparent;color:#fff;box-shadow:0 6px 20px rgba(34,211,238,0.35)}
.icon-action.danger{background:rgba(248,113,113,0.14);border-color:rgba(248,113,113,0.4);color:#f87171}
.icon-action.success{background:rgba(52,211,153,0.14);border-color:rgba(52,211,153,0.4);color:#34d399}
.icon-action .lbl{font-size:12px;font-weight:600}
.bottom-row{display:flex;align-items:stretch;gap:8px;margin-top:10px;flex-wrap:nowrap}
.bottom-row .date-box{flex:1;min-width:0;background:var(--surface);border:1px dashed var(--border);border-radius:11px;padding:0 14px;display:flex;align-items:center;font-size:12.5px;color:var(--text2);font-variant-numeric:tabular-nums;height:44px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;font-weight:600}
.bottom-row .date-box .ph{font-size:15px;margin-left:6px;color:var(--accent);flex-shrink:0}
.mini-table{width:100%;border-collapse:collapse;table-layout:fixed;border-radius:11px;overflow:hidden;font-size:12.5px;background:var(--surface)}
.mini-table tr{border-bottom:1px solid var(--border)}
.mini-table tr:last-child{border-bottom:none}
.mini-table tr:nth-child(odd){background:var(--stripe)}
.mini-table th{text-align:right;padding:10px 12px;color:var(--text2);font-weight:600;font-size:11.5px;width:110px;vertical-align:top;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.mini-table td{padding:10px 12px;vertical-align:top;font-size:12.5px;max-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;cursor:pointer;transition:background .15s}
.mini-table td:hover{background:rgba(34,211,238,0.06)}
.mini-table tr.expanded td{white-space:normal;overflow:visible;max-width:none;word-break:break-word}
.mini-table tr.expanded{background:rgba(34,211,238,0.04)}
.mini-table td .tag{display:inline-block;padding:2px 8px;border-radius:6px;font-size:10.5px;font-weight:700;margin:1px 0 1px 4px;background:rgba(34,211,238,0.15);color:#22d3ee;border:1px solid rgba(34,211,238,0.28)}

/* ITEM CAROUSEL */
.item-carousel{display:flex;gap:8px;overflow-x:auto;padding:6px 4px 12px;scroll-snap-type:x mandatory;scrollbar-width:thin;scroll-behavior:smooth}
.item-carousel::-webkit-scrollbar{height:5px}
.item-carousel::-webkit-scrollbar-thumb{background:var(--border2);border-radius:4px}
.carousel-item{flex:0 0 auto;width:88px;display:flex;flex-direction:column;align-items:center;gap:5px;padding:10px 6px 8px;background:var(--surface);border:1px solid var(--border);border-radius:14px;cursor:pointer;scroll-snap-align:start;transition:all .25s var(--spring);font-family:inherit;color:var(--text)}
.carousel-item:hover{transform:translateY(-2px);background:var(--surface2);border-color:var(--border2)}
.carousel-item.active{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;border-color:transparent;box-shadow:0 6px 20px rgba(34,211,238,0.35)}
.ci-icon{width:48px;height:48px;display:grid;place-items:center;font-size:30px;border-radius:12px;background:var(--surface2);overflow:hidden;flex-shrink:0}
.carousel-item.active .ci-icon{background:rgba(255,255,255,0.22)}
.ci-icon img{width:100%;height:100%;object-fit:cover}
.ci-label{font-size:10.5px;font-weight:600;text-align:center;max-width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;line-height:1.2}
.ci-badge{font-size:8.5px;padding:1px 6px;border-radius:5px;font-weight:700;background:rgba(168,85,247,0.20);color:#c084fc;margin-top:1px}
.carousel-item.active .ci-badge{background:rgba(255,255,255,0.25);color:#fff}
.version-switcher{display:flex;align-items:center;justify-content:center;gap:10px;padding:8px;background:var(--surface);border:1px solid var(--border);border-radius:14px;margin-top:10px}
.ver-btn{width:40px;height:40px;border-radius:50%;border:1px solid var(--border);background:var(--surface2);color:var(--text);cursor:pointer;font-size:18px;display:grid;place-items:center;transition:all .2s var(--spring);flex-shrink:0}
.ver-btn:hover{background:var(--surface3);transform:scale(1.08)}
.ver-btn:disabled{opacity:.4;cursor:not-allowed;transform:none}
.ver-display{flex:1;text-align:center;min-width:120px}
.ver-num{font-size:16px;font-weight:800;color:var(--text);font-variant-numeric:tabular-nums}
.ver-of{font-size:11px;color:var(--text2);margin-right:4px}
.ver-date{font-size:10px;color:var(--text3);margin-top:2px;font-variant-numeric:tabular-nums}

/* FULL-WIDTH PREVIEW */
.preview-full{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-sm);overflow:hidden;margin-bottom:10px;position:relative;width:100%}
.preview-full iframe{display:block;width:100%;border:none;background:transparent;min-height:240px;height:auto}
.preview-full .fw-label{position:absolute;top:10px;right:10px;z-index:2;background:var(--glass-solid);backdrop-filter:blur(20px);border:1px solid var(--border2);border-radius:8px;padding:3px 9px;font-size:10.5px;font-weight:700;color:var(--text2);display:flex;align-items:center;gap:4px;pointer-events:none}

.dep-status{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:8px;font-size:11px;font-weight:600;border:1px solid;margin:3px 3px 3px 0}
.dep-status.green{background:rgba(52,211,153,0.14);color:#34d399;border-color:rgba(52,211,153,0.35)}
.dep-status.red{background:rgba(248,113,113,0.14);color:#f87171;border-color:rgba(248,113,113,0.35)}
.dep-status.warn{background:rgba(251,191,36,0.14);color:#fbbf24;border-color:rgba(251,191,36,0.35)}
.dep-status.checking{background:rgba(251,191,36,0.14);color:#fbbf24;border-color:rgba(251,191,36,0.35)}
.dep-status .dot{width:8px;height:8px;border-radius:50%;background:currentColor;flex-shrink:0;box-shadow:0 0 6px currentColor}
.dep-status.checking .dot{animation:pulseDot 1.2s ease-in-out infinite}
@keyframes pulseDot{0%,100%{opacity:.4}50%{opacity:1}}
.card-title{font-size:14px;font-weight:700;margin-bottom:10px;display:flex;align-items:center;gap:8px;color:var(--text)}
.card-title .ph{font-size:16px;color:var(--accent)}

/* TOAST */
.toast{position:fixed;bottom:100px;left:50%;transform:translate(-50%,80px);z-index:500;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;padding:11px 20px;border-radius:12px;font-size:12.5px;font-weight:700;box-shadow:0 10px 30px rgba(0,0,0,0.4);opacity:0;transition:.35s;pointer-events:none;max-width:90vw;text-align:center}
@media(min-width:721px){.toast{bottom:24px}}
.toast.show{opacity:1;transform:translate(-50%,0)}
.toast.err{background:linear-gradient(135deg,#f87171,#b91c1c)}
.toast.ok{background:linear-gradient(135deg,#34d399,#059669)}

/* MODAL */
.modal-backdrop{position:fixed;inset:0;z-index:300;display:none;align-items:center;justify-content:center;padding:16px;background:rgba(0,0,0,0.55);backdrop-filter:blur(16px);-webkit-backdrop-filter:blur(16px)}
.modal-backdrop.show{display:flex;animation:fadeIn .25s ease}
@keyframes fadeIn{from{opacity:0}to{opacity:1}}
.modal{width:100%;max-width:560px;max-height:88vh;display:flex;flex-direction:column;background:var(--glass-solid);backdrop-filter:blur(34px) saturate(200%);-webkit-backdrop-filter:blur(34px) saturate(200%);border:1px solid var(--border2);border-radius:var(--radius);overflow:hidden;box-shadow:0 30px 80px rgba(0,0,0,0.5);animation:modalIn .3s var(--spring)}
@keyframes modalIn{from{opacity:0;transform:scale(.94) translateY(10px)}to{opacity:1;transform:none}}
.modal-head{padding:14px 18px;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center}
.modal-head h3{font-size:14px;font-weight:700;display:flex;align-items:center;gap:7px}
.modal-head h3 .ph{color:var(--accent);font-size:16px}
.modal-body{padding:16px 18px;overflow-y:auto;flex:1}
.modal-foot{padding:12px 18px;border-top:1px solid var(--border);display:flex;justify-content:flex-end;gap:8px;flex-wrap:wrap}
.modal-body input[type=text],.modal-body textarea{width:100%;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:11px 14px;border-radius:11px;font-family:inherit;font-size:13px;outline:none}
.modal-body textarea{min-height:180px;font-family:'JetBrains Mono',monospace;font-size:11.5px;direction:ltr;text-align:left;resize:vertical}

/* TABLES */
.table-scroll{width:100%;overflow-x:auto;border-radius:11px;-webkit-overflow-scrolling:touch}
.table-scroll::-webkit-scrollbar{height:6px}
.table-scroll::-webkit-scrollbar-thumb{background:var(--border2);border-radius:3px}
.data-table{width:100%;border-collapse:collapse;font-size:12.5px;background:var(--surface);table-layout:fixed}
.data-table th{text-align:right;padding:9px 11px;color:var(--text2);font-weight:600;font-size:11.5px;background:var(--stripe);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.data-table td{padding:9px 11px;word-wrap:break-word;font-size:12.5px;vertical-align:middle;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.data-table tr{border-bottom:1px solid var(--border)}
.data-table tr:last-child{border-bottom:none}
.app-info-table{width:100%;border-collapse:collapse;font-size:12px;table-layout:fixed}
.app-info-table tr{border-bottom:1px solid var(--border)}
.app-info-table tr:last-child{border-bottom:none}
.app-info-table th{text-align:right;padding:9px 4px;color:var(--text3);font-weight:500;font-size:11px;width:42%}
.app-info-table td{text-align:left;padding:9px 4px;color:var(--text);font-weight:600;font-size:12px;direction:ltr;font-variant-numeric:tabular-nums;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.app-info-table td .ver-badge{display:inline-block;padding:2px 9px;border-radius:6px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-size:11px;font-weight:800;letter-spacing:.5px}
.app-info-table td .days-badge{display:inline-block;padding:2px 8px;border-radius:6px;background:rgba(52,211,153,0.15);color:#34d399;font-size:10.5px;font-weight:700;border:1px solid rgba(52,211,153,0.3);margin-left:6px}

/* TECH CAROUSEL */
.tech-carousel-wrap{overflow:hidden;position:relative;margin:4px -4px;padding:6px 4px;mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent);-webkit-mask-image:linear-gradient(90deg,transparent,#000 8%,#000 92%,transparent)}
.tech-carousel-track{display:flex;gap:10px;width:max-content;animation:techScroll 32s linear infinite}
.tech-carousel-wrap:hover .tech-carousel-track{animation-play-state:paused}
@keyframes techScroll{from{transform:translateX(0)}to{transform:translateX(-50%)}}
.tech-item{flex:0 0 auto;display:flex;align-items:center;gap:8px;padding:10px 14px;background:var(--surface2);border:1px solid var(--border);border-radius:14px;transition:all .3s var(--spring);min-width:180px}
.tech-item:hover{border-color:var(--accent);box-shadow:0 4px 16px rgba(34,211,238,0.20);transform:translateY(-2px)}
.ti-icon{width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:grid;place-items:center;color:#fff;font-size:18px;flex-shrink:0;box-shadow:0 3px 10px rgba(34,211,238,0.30)}
.ti-body{display:flex;flex-direction:column;gap:1px;min-width:0}
.ti-name{font-size:11.5px;font-weight:800;color:var(--text);white-space:nowrap}
.ti-desc{font-size:10px;color:var(--text2);white-space:nowrap}

/* VERSION ACCORDION */
.version-accordion{display:flex;flex-direction:column;gap:8px}
.version-card{background:var(--surface);border:1px solid var(--border);border-radius:12px;overflow:hidden;transition:all .3s var(--spring)}
.version-card.open{border-color:var(--accent);box-shadow:0 4px 20px rgba(34,211,238,0.18)}
.version-header{width:100%;display:flex;align-items:center;gap:10px;padding:12px 14px;background:transparent;border:none;color:var(--text);cursor:pointer;font-family:inherit;text-align:right;transition:background .2s}
.version-header:hover{background:var(--surface2)}
.vh-badge{padding:3px 10px;border-radius:8px;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-size:11px;font-weight:800;letter-spacing:.4px;flex-shrink:0}
.vh-title{font-size:12.5px;font-weight:700;flex:1;min-width:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.vh-date{font-size:10.5px;color:var(--text3);flex-shrink:0;font-variant-numeric:tabular-nums}
.vh-chev{font-size:14px;color:var(--text2);flex-shrink:0;transition:transform .35s var(--spring)}
.version-card.open .vh-chev{transform:rotate(180deg);color:var(--accent)}
.version-body{max-height:0;overflow:hidden;transition:max-height .45s cubic-bezier(.4,0,.2,1);background:rgba(0,0,0,0.10)}
.version-card.open .version-body{max-height:1200px}
.version-body-inner{padding:4px 14px 14px}
.vbi-group{margin-top:10px}
.vbi-group-title{display:flex;align-items:center;gap:6px;font-size:11px;font-weight:800;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px}
.vbi-group-title .ph{font-size:13px}
.vbi-new{color:var(--ok)} .vbi-new .ph{color:var(--ok)}
.vbi-upd{color:#3b82f6} .vbi-upd .ph{color:#3b82f6}
.vbi-fix{color:var(--warn)} .vbi-fix .ph{color:var(--warn)}
.vbi-list{list-style:none;padding:0;margin:0}
.vbi-list li{position:relative;padding:4px 16px 4px 0;font-size:11.5px;color:var(--text2);line-height:1.7;border-bottom:1px dashed var(--border)}
.vbi-list li:last-child{border-bottom:none}
.vbi-list li::before{content:'•';position:absolute;right:4px;color:var(--accent);font-weight:900}
[data-theme="light"] .version-body{background:rgba(0,0,0,0.02)}

/* MOBILE NAV */
.mobile-nav{position:fixed;bottom:16px;left:50%;transform:translateX(-50%);z-index:90;background:var(--glass-solid);backdrop-filter:blur(28px) saturate(200%);-webkit-backdrop-filter:blur(28px) saturate(200%);border:1px solid var(--border2);border-radius:40px;padding:6px;box-shadow:0 12px 40px rgba(0,0,0,0.45),inset 0 1px 0 rgba(255,255,255,0.14);display:flex;align-items:center;gap:4px;max-width:calc(100vw - 32px)}
@media(min-width:721px){.mobile-nav{display:none}}
.nav-slider{position:absolute;top:6px;bottom:6px;border-radius:34px;background:linear-gradient(135deg,var(--accent),var(--accent2));transition:all 0.55s cubic-bezier(0.34, 1.56, 0.64, 1);z-index:0;box-shadow:0 6px 20px rgba(34,211,238,0.42);pointer-events:none;opacity:0;left:6px;width:60px}
.nav-slider.ready{opacity:1}
.mobile-nav button{position:relative;z-index:1;background:transparent;border:none;color:var(--text2);cursor:pointer;border-radius:34px;padding:11px 14px;display:flex;align-items:center;justify-content:center;font-family:inherit;font-size:12px;font-weight:600;white-space:nowrap;transition:color .3s ease, padding .5s var(--spring)}
.mobile-nav button .ph{font-size:19px;flex-shrink:0;transition:color .3s ease}
.mobile-nav button .lbl{max-width:0;overflow:hidden;opacity:0;transition:max-width .55s var(--spring), opacity .35s ease .05s, margin .5s var(--spring);white-space:nowrap;font-weight:700}
.mobile-nav button.active{color:#fff;padding-left:16px;padding-right:16px}
.mobile-nav button.active .lbl{max-width:80px;opacity:1;margin-right:6px}

/* THEMES GRID */
.theme-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:8px}
.theme-cell{padding:14px 10px;background:var(--surface);border:2px solid var(--border);border-radius:12px;cursor:pointer;text-align:center;font-family:inherit;color:var(--text);transition:all .3s var(--spring);position:relative;overflow:hidden}
.theme-cell:hover{border-color:var(--border2);transform:translateY(-3px) scale(1.02);box-shadow:0 8px 24px rgba(0,0,0,0.2)}
.theme-cell.active{border-color:var(--accent);background:var(--surface2);box-shadow:0 0 0 3px rgba(34,211,238,0.18),0 8px 24px rgba(0,0,0,0.3)}
.theme-cell.active::after{content:'✓';position:absolute;top:6px;left:6px;width:18px;height:18px;border-radius:50%;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;font-size:10px;display:grid;place-items:center;font-weight:900}
.theme-cell .tc-icon{font-size:30px;margin-bottom:6px;display:block}
.theme-cell .tc-name{font-size:11.5px;font-weight:700}
.color-grid{display:flex;flex-wrap:wrap;gap:10px}
.color-cell{width:44px;height:44px;border-radius:50%;border:3px solid transparent;cursor:pointer;transition:all .25s var(--spring);position:relative}
.color-cell:hover{transform:scale(1.15) rotate(5deg)}
.color-cell.active{border-color:#fff;box-shadow:0 0 0 2px var(--text);transform:scale(1.08)}
.color-cell.active::after{content:'✓';position:absolute;inset:0;display:grid;place-items:center;color:#fff;font-size:16px;font-weight:900;text-shadow:0 1px 3px rgba(0,0,0,0.5)}

/* ABOUT HERO */
.about-hero{position:sticky;top:64px;z-index:40;margin-bottom:14px;border-radius:var(--radius);overflow:hidden;background:linear-gradient(180deg,var(--bg2),var(--bg1));border:1px solid var(--border);box-shadow:var(--shadow);height:140px}
@media(min-width:721px){.about-hero{top:66px;height:160px}}
.hero-sky{position:absolute;inset:0;overflow:hidden;transition:background 2s ease}
.hero-sky.period-morning{background:linear-gradient(180deg,#0a1a2e 0%,#1e4a7a 45%,#6ea3c8 80%,#f4b47a 100%)}
.hero-sky.period-noon{background:linear-gradient(180deg,#1a5a8a 0%,#3a9fd4 40%,#7bc8ea 75%,#d4ecfa 100%)}
.hero-sky.period-evening{background:linear-gradient(180deg,#0a0a28 0%,#3a1a4a 30%,#9a3a4e 65%,#f59e42 100%)}
.hero-sky.period-night{background:linear-gradient(180deg,#020812 0%,#061225 55%,#0a1e35 85%,#102a45 100%)}

.hero-stars{position:absolute;inset:0;opacity:0;transition:opacity 2s;z-index:0}
.hero-sky.period-night .hero-stars{opacity:1}
.hero-sky.period-morning .hero-stars{opacity:.15}
.hero-sky.period-evening .hero-stars{opacity:.35}
.hero-star{position:absolute;border-radius:50%;background:#fff;box-shadow:0 0 4px rgba(255,255,255,0.8),0 0 1px rgba(255,255,255,1);animation:twinkle 3s ease-in-out infinite}

.hero-moon{position:absolute;width:52px;height:52px;border-radius:50%;background:radial-gradient(circle at 35% 32%,#fafcff 0%,#dde5f0 40%,#a8b4c8 75%,#8a95a8 100%);box-shadow:0 0 32px rgba(190,215,255,0.55),0 0 70px rgba(140,180,240,0.30),inset -6px -6px 16px rgba(90,110,140,0.35);right:18%;top:22%;opacity:0;transition:opacity 2s, top 2s, right 2s;z-index:1;overflow:hidden}
.hero-moon::before,.hero-moon::after{content:'';position:absolute;border-radius:50%;background:rgba(140,155,180,0.45);box-shadow:inset 1.5px 1.5px 3px rgba(70,85,115,0.5)}
.hero-moon::before{width:14px;height:14px;top:28%;left:24%}
.hero-moon::after{width:9px;height:9px;top:56%;left:56%;box-shadow:inset 1px 1px 2px rgba(70,85,115,0.5),14px -18px 0 2px rgba(140,155,180,0.35),-10px 8px 0 0px rgba(140,155,180,0.40),8px 4px 0 -1px rgba(140,155,180,0.30)}
.hero-sky.period-night .hero-moon{opacity:1}

.hero-sun{position:absolute;width:58px;height:58px;border-radius:50%;background:radial-gradient(circle at 32% 30%,#fffceb 0%,#ffe28a 30%,#ffb347 65%,#f77f00 100%);box-shadow:0 0 40px rgba(255,220,100,0.85),0 0 90px rgba(255,180,50,0.55),0 0 160px rgba(255,150,40,0.30);opacity:0;transition:opacity 2s, left 2s, top 2s;z-index:1;left:10%;top:50%;transform:translateY(-50%)}
.hero-sky.period-morning .hero-sun{opacity:1;left:12%;top:60%}
.hero-sky.period-noon .hero-sun{opacity:1;left:50%;top:15%}
.hero-sky.period-evening .hero-sun{opacity:1;left:82%;top:58%}

.hero-clouds{position:absolute;inset:0;pointer-events:none;z-index:2;overflow:hidden}
.hero-cloud{position:absolute;background:rgba(245,250,255,0.85);border-radius:80px;filter:blur(1.2px);animation:cloudDrift linear infinite;box-shadow:0 2px 8px rgba(0,0,0,0.05)}
.hero-cloud::before,.hero-cloud::after{content:'';position:absolute;background:inherit;border-radius:50%;box-shadow:inherit}
.hero-cloud::before{width:55%;height:130%;top:-45%;left:18%}
.hero-cloud::after{width:45%;height:110%;top:-32%;right:12%}
.hero-cloud.cloud-1{width:110px;height:26px;top:22%;left:-140px;animation-duration:80s;opacity:.85}
.hero-cloud.cloud-2{width:75px;height:20px;top:52%;left:-100px;animation-duration:100s;animation-delay:-30s;opacity:.70}
.hero-cloud.cloud-3{width:140px;height:32px;top:70%;left:-160px;animation-duration:120s;animation-delay:-60s;opacity:.60}
.hero-sky.period-night .hero-cloud{background:rgba(120,140,170,0.35);filter:blur(2px)}
.hero-sky.period-evening .hero-cloud{background:rgba(255,200,180,0.55)}
.hero-sky.period-morning .hero-cloud{background:rgba(255,240,220,0.80)}
@keyframes cloudDrift{0%{transform:translateX(0)}100%{transform:translateX(calc(100vw + 260px))}}

.hero-text{position:absolute;inset:0;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;padding:0 24px;z-index:3;text-shadow:0 2px 12px rgba(0,0,0,0.7);pointer-events:none}
.hero-greeting{font-size:22px;font-weight:900;color:#fff;letter-spacing:.5px}
@media(min-width:721px){.hero-greeting{font-size:28px}}
.hero-date{font-size:11.5px;color:rgba(255,255,255,0.85);margin-top:6px;font-variant-numeric:tabular-nums}

/* Help */
.help-section{margin-bottom:20px}
.help-section h4{font-size:13px;font-weight:800;margin-bottom:8px;color:var(--accent);display:flex;align-items:center;gap:6px}
.help-section p{font-size:12px;color:var(--text2);line-height:1.7;margin-bottom:8px}
.help-code{position:relative;background:rgba(0,0,0,0.28);border:1px solid var(--border);border-radius:10px;padding:12px 14px;padding-top:38px;margin-bottom:8px}
[data-theme="light"] .help-code{background:rgba(240,244,250,0.75)}
.help-code pre{font-family:'JetBrains Mono',Consolas,monospace;font-size:11px;line-height:1.65;direction:ltr;text-align:left;color:#c9d6e4;white-space:pre-wrap;word-wrap:break-word;margin:0;max-height:340px;overflow:auto}
[data-theme="light"] .help-code pre{color:#2a3342}
.help-code-copy{position:absolute;top:6px;left:6px;background:var(--surface2);border:1px solid var(--border);color:var(--text2);padding:4px 10px;border-radius:6px;font-family:inherit;font-size:10.5px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:4px}
.help-code-copy:hover{background:var(--surface3);color:var(--text)}
.help-code-copy.copied{background:rgba(52,211,153,0.18);color:#34d399;border-color:rgba(52,211,153,0.35)}

.hidden{display:none !important}
.flex-row{display:flex;gap:8px;flex-wrap:wrap}
.mt-8{margin-top:8px}
.mt-12{margin-top:12px}
.muted{color:var(--text3);font-size:12px;text-align:center;padding:16px}
.empty{text-align:center;padding:26px 12px;color:var(--text3);font-size:12.5px}
.empty .ph{font-size:32px;display:block;margin-bottom:8px;opacity:.5}
::-webkit-scrollbar{width:7px;height:7px}
::-webkit-scrollbar-track{background:transparent}
::-webkit-scrollbar-thumb{background:var(--border2);border-radius:4px}

/* Settings & Reports grid */
.settings-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media(max-width:900px){.settings-grid{grid-template-columns:1fr}}
.settings-section{background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:16px}
.settings-section h3{font-size:13px;font-weight:700;margin-bottom:12px;display:flex;align-items:center;gap:7px;color:var(--text);padding-bottom:10px;border-bottom:1px solid var(--border)}
.settings-section h3 .ph{color:var(--accent);font-size:16px}
.settings-section .sub-label{font-size:11px;color:var(--text2);margin:10px 0 6px;font-weight:600;display:block}
.reports-grid{display:grid;grid-template-columns:1fr 2fr;gap:12px;margin-bottom:12px}
@media(max-width:900px){.reports-grid{grid-template-columns:1fr}}

/* Backup & Log tables */
.backup-table{width:100%;border-collapse:collapse;font-size:12px;border-radius:11px;overflow:hidden;background:var(--surface);table-layout:fixed;min-width:520px}
.backup-table th{text-align:right;padding:9px 10px;color:var(--text2);font-weight:600;font-size:11px;background:var(--stripe);white-space:nowrap}
.backup-table td{padding:0 10px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;vertical-align:middle;height:44px;font-size:12px}
.backup-table tr{border-bottom:1px solid var(--border)}
.backup-table td.actions{display:flex;align-items:center;gap:3px}
.backup-table td.actions button{background:transparent;border:none;color:var(--text2);width:28px;height:28px;border-radius:7px;cursor:pointer;font-size:14px;display:grid;place-items:center;transition:all .2s}
.backup-table td.actions button:hover{background:var(--surface2);color:var(--text)}
.backup-table td.actions button.del:hover{background:rgba(248,113,113,0.18);color:#f87171}
.backup-table td.actions button.res:hover{background:rgba(52,211,153,0.18);color:#34d399}
.backup-table td.actions button.dl:hover{background:rgba(34,211,238,0.18);color:#22d3ee}
.badge-cnt{display:inline-block;padding:1px 7px;border-radius:5px;background:rgba(34,211,238,0.15);color:#22d3ee;font-size:10.5px;font-weight:700}
.log-table{width:100%;border-collapse:collapse;font-size:11.5px;border-radius:11px;overflow:hidden;background:var(--surface);table-layout:fixed;min-width:560px}
.log-table th{text-align:right;padding:8px 10px;color:var(--text2);font-weight:600;font-size:10.5px;background:var(--stripe);white-space:nowrap}
.log-table td{padding:0 10px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;vertical-align:middle;height:38px;font-size:11.5px}
.log-table tr{border-bottom:1px solid var(--border)}
.log-tag{display:inline-block;padding:2px 8px;border-radius:6px;font-size:10px;font-weight:700;border:1px solid transparent;white-space:nowrap}
.log-tag.type-save{background:rgba(52,211,153,0.16);color:#34d399;border-color:rgba(52,211,153,0.3)}
.log-tag.type-create{background:rgba(34,211,238,0.16);color:#22d3ee;border-color:rgba(34,211,238,0.3)}
.log-tag.type-delete{background:rgba(248,113,113,0.16);color:#f87171;border-color:rgba(248,113,113,0.3)}
.log-tag.type-backup{background:rgba(168,85,247,0.16);color:#c084fc;border-color:rgba(168,85,247,0.3)}
.log-tag.type-restore{background:rgba(251,191,36,0.16);color:#fbbf24;border-color:rgba(251,191,36,0.3)}
.log-tag.type-other{background:rgba(147,164,187,0.16);color:#93a4bb;border-color:rgba(147,164,187,0.3)}
.filter-bar{display:flex;gap:6px;flex-wrap:wrap;margin-bottom:10px;align-items:center}
.filter-bar input,.filter-bar select{flex:1;min-width:120px;background:var(--surface);border:1px solid var(--border);color:var(--text);padding:8px 11px;border-radius:9px;font-family:inherit;font-size:12px;outline:none}
.filter-bar input:focus,.filter-bar select:focus{border-color:var(--accent)}

/* Icon picker */
.icon-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(48px,1fr));gap:6px;margin-top:10px;max-height:340px;overflow-y:auto;padding:4px}
.icon-cell{background:var(--surface);border:1px solid var(--border);color:var(--text);width:100%;aspect-ratio:1;border-radius:10px;cursor:pointer;font-size:20px;display:grid;place-items:center;transition:all .2s var(--spring)}
.icon-cell:hover{background:var(--surface2);border-color:var(--accent);transform:scale(1.08)}
.icon-cell.active{background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;border-color:transparent}
</style>
</head>
<body>

<!-- SPLASH -->
<div class="splash" id="splash">
  <div class="splash-stars" id="splashStars"></div>
  <div class="splash-moon"></div>
  <div class="splash-waves">
    <div class="splash-wave"></div>
    <div class="splash-wave"></div>
  </div>
  <div class="splash-inner">
    <span class="logo-wrap">
      <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <linearGradient id="sailG1" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#a5f3fc"/><stop offset="100%" stop-color="#22d3ee"/>
          </linearGradient>
          <linearGradient id="sailG2" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#f0abfc"/><stop offset="100%" stop-color="#a855f7"/>
          </linearGradient>
          <linearGradient id="hullG" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#c28152"/><stop offset="100%" stop-color="#6b4226"/>
          </linearGradient>
        </defs>
        <path d="M32 6 L32 40 L10 40 Z" fill="url(#sailG1)"/>
        <path d="M34 6 L34 40 L54 40 Z" fill="url(#sailG2)"/>
        <line x1="32" y1="6" x2="32" y2="42" stroke="#5c3a1e" stroke-width="2" stroke-linecap="round"/>
        <path d="M6 42 Q32 56 58 42 L54 50 Q32 60 10 50 Z" fill="url(#hullG)" stroke="#4a2d18" stroke-width="1"/>
        <path d="M6 42 Q32 47 58 42" stroke="#fbbf24" stroke-width="1.5" fill="none" opacity="0.7"/>
      </svg>
    </span>
    <h1>کشتی نوح</h1>
    <div class="msg" id="splashMsg">در حال بادبان‌کشی...</div>
    <div class="bar"></div>
    <div class="ver" id="splashVer">نسخه ۱.۴.۴ · گروه هنری اقاقیا</div>
  </div>
</div>

<header class="topbar">
  <div class="brand">
    <span class="brand-icon">
      <svg viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
        <defs>
          <linearGradient id="hSailG1" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#a5f3fc"/><stop offset="100%" stop-color="#22d3ee"/>
          </linearGradient>
          <linearGradient id="hSailG2" x1="0" y1="0" x2="1" y2="1">
            <stop offset="0%" stop-color="#f0abfc"/><stop offset="100%" stop-color="#a855f7"/>
          </linearGradient>
          <linearGradient id="hHullG" x1="0" y1="0" x2="0" y2="1">
            <stop offset="0%" stop-color="#c28152"/><stop offset="100%" stop-color="#6b4226"/>
          </linearGradient>
        </defs>
        <path d="M32 6 L32 40 L10 40 Z" fill="url(#hSailG1)"/>
        <path d="M34 6 L34 40 L54 40 Z" fill="url(#hSailG2)"/>
        <line x1="32" y1="6" x2="32" y2="42" stroke="#5c3a1e" stroke-width="2" stroke-linecap="round"/>
        <path d="M6 42 Q32 56 58 42 L54 50 Q32 60 10 50 Z" fill="url(#hHullG)" stroke="#4a2d18" stroke-width="1"/>
        <path d="M6 42 Q32 47 58 42" stroke="#fbbf24" stroke-width="1.5" fill="none" opacity="0.7"/>
      </svg>
    </span>
    <div style="text-align:right"><h1>کشتی نوح</h1><div class="sub">گروه هنری اقاقیا · v۱.۴.۴</div></div>
  </div>
  <nav class="tabs">
    <button class="tab active" data-tab="entry">ورود کد</button>
    <button class="tab" data-tab="view">نمایش</button>
    <button class="tab" data-tab="about">درباره</button>
    <button class="tab" data-tab="settings">تنظیمات</button>
  </nav>
  <div class="topbar-actions">
    <button class="icon-btn" id="themeBtn" data-tip="تغییر تم">🌙</button>
    <button class="icon-btn" id="syncBtn" data-tip="ذخیره آنلاین">☁️</button>
  </div>
</header>

<main>
  <section class="page active" id="page-entry">
    <div class="glass card">
      <div class="row" style="grid-template-columns:1fr 1fr">
        <div class="field" style="margin-bottom:6px">
          <label>آیتم</label>
          <div style="display:flex;gap:6px">
            <div class="dd" id="itemDD" style="flex:1"></div>
            <button class="icon-action" id="addItemBtn" data-tip="افزودن" style="min-width:42px;height:42px;padding:0"><i class="ph ph-plus"></i></button>
          </div>
        </div>
        <div class="field" style="margin-bottom:6px">
          <label>نوع</label>
          <div style="display:flex;gap:6px">
            <div class="dd" id="catDD" style="flex:1"></div>
            <button class="icon-action" id="addCatBtn" data-tip="افزودن" style="min-width:42px;height:42px;padding:0"><i class="ph ph-plus"></i></button>
          </div>
        </div>
      </div>
      <div class="field" style="margin-bottom:8px">
        <label>کد آیتم</label>
        <div class="code-wrap">
          <div class="code-toolbar">
            <button type="button" class="toolbar-save" id="tSave"><i class="ph ph-floppy-disk"></i><span>ذخیره</span></button>
            <button type="button" id="tCopy" data-tip="کپی"><i class="ph ph-copy"></i></button>
            <button type="button" id="tPaste" data-tip="پیست"><i class="ph ph-clipboard-text"></i></button>
            <button type="button" id="tEye" data-tip="پیش‌نمایش"><i class="ph ph-eye"></i></button>
            <button type="button" id="tClear" data-tip="پاک"><i class="ph ph-trash"></i></button>
          </div>
          <textarea class="code-input" id="codeInput" placeholder="===NOAH-ARK-ITEM-v1===&#10;{ ... }&#10;===END-NOAH-ARK-ITEM==="></textarea>
        </div>
      </div>
      <div id="entryPreview"></div>
      <div class="bottom-row">
        <div class="date-box"><i class="ph ph-calendar-blank"></i><span id="nowDisplay">—</span></div>
        <button class="icon-action" id="parseBtn" data-tip="بررسی"><i class="ph ph-scan"></i></button>
        <button class="icon-action primary" id="saveBtn" data-tip="ذخیره"><i class="ph ph-floppy-disk"></i></button>
      </div>
      <div class="flex-row mt-8">
        <button class="icon-action" id="bulkImportBtn" data-tip="ورود گروهی"><i class="ph ph-list-plus"></i><span class="lbl">ورود گروهی</span></button>
        <button class="icon-action" id="helpBtn" data-tip="راهنما"><i class="ph ph-question"></i></button>
        <button class="icon-action" id="copyGuideBtn" data-tip="کپی راهنما"><i class="ph ph-book-open"></i></button>
      </div>
    </div>
  </section>

  <section class="page" id="page-view">
    <div class="glass card" style="padding:8px"><div class="item-carousel" id="itemCarousel"></div></div>
    <div class="glass card" id="viewControlCard" style="padding:10px">
      <div class="version-switcher">
        <button class="ver-btn" id="verPrev" data-tip="قبلی"><i class="ph ph-caret-right"></i></button>
        <div class="ver-display">
          <div><span class="ver-num" id="verNum">—</span><span class="ver-of" id="verOf"></span></div>
          <div class="ver-date" id="verDate"></div>
        </div>
        <button class="ver-btn" id="verNext" data-tip="بعدی"><i class="ph ph-caret-left"></i></button>
      </div>
    </div>
    <div id="viewArea"><div class="glass card"><div class="empty"><i class="ph ph-selection-all"></i>یک آیتم انتخاب کنید</div></div></div>
  </section>

  <section class="page" id="page-about">
    <div class="about-hero">
      <div class="hero-sky" id="heroSky">
        <div class="hero-stars" id="heroStars"></div>
        <div class="hero-moon" id="heroMoon"></div>
        <div class="hero-sun" id="heroSun"></div>
        <div class="hero-clouds">
          <div class="hero-cloud cloud-1"></div>
          <div class="hero-cloud cloud-2"></div>
          <div class="hero-cloud cloud-3"></div>
        </div>
      </div>
      <div class="hero-text">
        <div class="hero-greeting" id="heroGreeting">وقت بخیر</div>
        <div class="hero-date" id="heroDate">—</div>
      </div>
    </div>
    <div class="subtabs">
      <button class="subtab active" data-sub="info">شناسنامه</button>
      <button class="subtab" data-sub="reports">آمار و سیستم</button>
      <button class="subtab" data-sub="changelog">تاریخچه</button>
      <button class="subtab" data-sub="backups">بک‌آپ</button>
      <button class="subtab" data-sub="logs">لاگ</button>
    </div>
    
    <div class="subpage active" id="sub-info">
      <div class="glass card">
        <div class="card-title"><i class="ph ph-info"></i>شناسنامه برنامه</div>
        <table class="app-info-table" id="aboutTable"></table>
      </div>
      <div class="glass card">
        <div class="card-title"><i class="ph ph-stack"></i>فناوری‌های استفاده شده</div>
        <div class="tech-carousel-wrap">
          <div class="tech-carousel-track" id="techTrack"></div>
        </div>
      </div>
      <div class="glass card">
        <div class="card-title"><i class="ph ph-clock-counter-clockwise"></i>تاریخچه نسخه‌ها</div>
        <div class="version-accordion" id="versionAccordion"></div>
      </div>
    </div>

    <div class="subpage" id="sub-reports">
      <div class="reports-grid">
        <div class="glass card" style="margin-bottom:0">
          <div class="card-title"><i class="ph ph-table"></i>آمار کامل</div>
          <table class="app-info-table" id="fullStatsTable"></table>
        </div>
        <div class="glass card" style="margin-bottom:0">
          <div class="card-title"><i class="ph ph-list"></i>جدول پروژه‌ها</div>
          <div class="table-scroll" style="max-height:280px">
            <table class="data-table" id="projectsTable"></table>
          </div>
        </div>
      </div>
      <div class="glass card">
        <div class="card-title"><i class="ph ph-heartbeat"></i>تست سلامت کتابخانه‌ها</div>
        <p style="font-size:12px;color:var(--text2);margin-bottom:10px">با کلیک روی دکمه زیر، تمام کتابخانه‌های استفاده شده در تمام آیتم‌ها اسکن شده و وضعیت اتصال/وجود آن‌ها بررسی می‌شود.</p>
        <button class="icon-action primary" id="runHealthCheckBtn" style="width:100%"><i class="ph ph-activity"></i><span>شروع اسکن کامل سیستم</span></button>
        <div id="healthCheckResult" class="mt-12"></div>
      </div>
      <div class="glass card"><div class="card-title"><i class="ph ph-chart-pie"></i>نمودار دسته‌بندی‌ها</div><div id="categoryChart"></div></div>
    </div>
    
    <div class="subpage" id="sub-changelog">
      <div class="glass card">
        <div class="card-title"><i class="ph ph-clock-counter-clockwise"></i>تاریخچه تغییرات</div>
        <div id="changelogBox"></div>
      </div>
    </div>
    
    <div class="subpage" id="sub-backups">
      <div class="glass card">
        <div class="card-title"><i class="ph ph-cloud-arrow-down"></i>بک‌آپ‌ها</div>
        <div class="table-scroll">
          <table class="backup-table"><colgroup><col style="width:auto"><col style="width:80px"><col style="width:80px"><col style="width:120px"></colgroup><thead><tr><th>تاریخ</th><th>آیتم</th><th>نسخه</th><th>عملیات</th></tr></thead><tbody id="backupBody"></tbody></table>
        </div>
        <div class="flex-row mt-8">
          <button class="icon-action primary" id="createBackupBtn"><i class="ph ph-plus-circle"></i><span>ایجاد بک‌آپ جدید</span></button>
          <button class="icon-action" id="logsBtn"><i class="ph ph-file-text"></i><span>دانلود لاگ‌ها</span></button>
          <button class="icon-action danger" id="resetBtn"><i class="ph ph-warning"></i><span>ریست کل</span></button>
        </div>
      </div>
    </div>
    
    <div class="subpage" id="sub-logs">
      <div class="glass card">
        <div class="card-title"><i class="ph ph-list-dashes"></i>آرشیو لاگ‌ها</div>
        <div class="filter-bar">
          <input type="text" id="logSearch" placeholder="جستجو...">
          <select id="logFilter">
            <option value="all">همه</option>
            <option value="save">ذخیره</option>
            <option value="create">ایجاد</option>
            <option value="delete">حذف</option>
            <option value="backup">بک‌آپ</option>
            <option value="restore">بازگردانی</option>
            <option value="other">سایر</option>
          </select>
        </div>
        <div class="table-scroll">
          <table class="log-table"><colgroup><col style="width:150px"><col style="width:80px"><col style="width:100px"><col></colgroup><thead><tr><th>زمان</th><th>نوع</th><th>عملیات</th><th>جزئیات</th></tr></thead><tbody id="logBody"></tbody></table>
        </div>
      </div>
    </div>
  </section>

  <section class="page" id="page-settings">
    <div class="settings-grid">
      <div class="settings-section">
        <h3><i class="ph ph-palette"></i>ظاهر و تم</h3>
        <span class="sub-label">پوسته برنامه</span>
        <div class="theme-grid" id="presetGrid"></div>
        <span class="sub-label">پروفایل رنگ</span>
        <div class="color-grid" id="colorGrid"></div>
        <span class="sub-label">حالت نمایش</span>
        <div class="flex-row">
          <button class="icon-action" id="setDark"><i class="ph ph-moon"></i> تیره</button>
          <button class="icon-action" id="setLight"><i class="ph ph-sun"></i> روشن</button>
        </div>
      </div>
      
      <div class="settings-section">
        <h3><i class="ph ph-package"></i>مدیریت کتابخانه‌ها</h3>
        <p style="font-size:11px;color:var(--text2);line-height:1.7;margin-bottom:10px">پوشه پروژه خود را انتخاب کنید. سیستم هوشمندانه تمام فایل‌های JS و CSS را پیدا کرده و در حافظه (IndexedDB) کش می‌کند.</p>
        <div class="flex-row">
          <button class="icon-action primary" id="pickLibFolderBtn"><i class="ph ph-folder-open"></i><span class="lbl">انتخاب پوشه</span></button>
          <button class="icon-action success" id="saveToHostBtn"><i class="ph ph-upload-simple"></i><span class="lbl">ذخیره در هاست</span></button>
        </div>
        <div id="libFolderStatus" style="margin-top:10px;font-size:11.5px;color:var(--text3)"></div>
        <div id="libCacheStatus" style="margin-top:6px;font-size:11px;color:var(--text3)"></div>
      </div>

      <div class="settings-section">
        <h3><i class="ph ph-cloud-check"></i>ذخیره و اشتراک‌گذاری</h3>
        <div class="flex-row">
          <button class="icon-action primary" id="onlineSaveBtn" style="flex:1"><i class="ph ph-cloud-arrow-up"></i><span class="lbl">ذخیره آنلاین (فشرده)</span></button>
          <button class="icon-action" id="onlineLoadBtn"><i class="ph ph-cloud-arrow-down"></i><span class="lbl">بارگذاری</span></button>
        </div>
        <div class="flex-row mt-8">
          <button class="icon-action" id="shareUrlBtn"><i class="ph ph-link"></i><span class="lbl">لینک اشتراک</span></button>
          <button class="icon-action" id="exportAllBtn"><i class="ph ph-download-simple"></i><span class="lbl">خروجی فایل</span></button>
          <button class="icon-action" id="importAllBtn"><i class="ph ph-upload-simple"></i><span class="lbl">ورود فایل</span></button>
        </div>
        <input type="file" id="importFile" accept=".json,application/json" style="display:none">
      </div>

      <div class="settings-section">
        <h3><i class="ph ph-image"></i>آیکون آیتم</h3>
        <div class="dd" id="iconItemDD"></div>
        <div class="flex-row mt-8">
          <button class="icon-action" id="pickLibBtn"><i class="ph ph-squares-four"></i><span class="lbl">از کتابخانه</span></button>
          <button class="icon-action" id="uploadIconBtn"><i class="ph ph-upload"></i><span class="lbl">آپلود</span></button>
          <input type="file" id="iconFile" accept="image/*" style="display:none">
        </div>
      </div>
    </div>
  </section>
</main>

<nav class="mobile-nav" id="mobileNav">
  <div class="nav-slider" id="navSlider"></div>
  <button data-tab="entry" class="active"><i class="ph ph-pencil-simple"></i><span class="lbl">ورود</span></button>
  <button data-tab="view"><i class="ph ph-eye"></i><span class="lbl">نمایش</span></button>
  <button data-tab="about"><i class="ph ph-info"></i><span class="lbl">درباره</span></button>
  <button data-tab="settings"><i class="ph ph-gear"></i><span class="lbl">تنظیمات</span></button>
</nav>

<!-- Dropdown Backdrop -->
<div class="dd-backdrop" id="ddBackdrop"></div>

<!-- MODALS -->
<div class="modal-backdrop" id="addModal">
  <div class="modal">
    <div class="modal-head"><h3><i class="ph ph-plus-circle"></i><span id="addModalTitle">افزودن</span></h3><button class="icon-btn" id="addModalClose" style="width:32px;height:32px"><i class="ph ph-x"></i></button></div>
    <div class="modal-body"><input type="text" id="addModalInput" placeholder="نام..." autocomplete="off"></div>
    <div class="modal-foot"><button class="icon-action" id="addModalCancel">انصراف</button><button class="icon-action primary" id="addModalOk"><i class="ph ph-check"></i><span>تایید</span></button></div>
  </div>
</div>

<div class="modal-backdrop" id="bulkModal">
  <div class="modal" style="max-width:700px">
    <div class="modal-head"><h3><i class="ph ph-list-plus"></i>ورود گروهی آیتم‌ها</h3><button class="icon-btn" id="bulkClose" style="width:32px;height:32px"><i class="ph ph-x"></i></button></div>
    <div class="modal-body">
      <p style="font-size:11.5px;color:var(--text2);margin-bottom:10px;line-height:1.7">چند بلوک <code style="background:var(--surface2);padding:1px 6px;border-radius:4px;font-size:10.5px">===NOAH-ARK-ITEM-v1===</code> را با هم پیست کنید. همه به‌طور خودکار ذخیره می‌شوند.</p>
      <textarea id="bulkInput" placeholder="===NOAH-ARK-ITEM-v1===&#10;{ ... }&#10;===END-NOAH-ARK-ITEM===" style="min-height:280px"></textarea>
      <div id="bulkResult" style="margin-top:10px"></div>
    </div>
    <div class="modal-foot"><button class="icon-action" id="bulkCancel">انصراف</button><button class="icon-action primary" id="bulkOk"><i class="ph ph-check"></i><span>پردازش</span></button></div>
  </div>
</div>

<div class="modal-backdrop" id="helpModal">
  <div class="modal" style="max-width:920px">
    <div class="modal-head"><h3><i class="ph ph-book-open"></i>راهنمای نوشتن کد (Prompt)</h3><button class="icon-btn" id="helpClose" style="width:32px;height:32px"><i class="ph ph-x"></i></button></div>
    <div class="modal-body" id="helpBody"></div>
    <div class="modal-foot"><button class="icon-action primary" id="helpCopy"><i class="ph ph-copy"></i><span>کپی همه</span></button><button class="icon-action" id="helpClose2">بستن</button></div>
  </div>
</div>

<div class="modal-backdrop" id="confirmModal">
  <div class="modal" style="max-width:420px">
    <div class="modal-head"><h3><i class="ph ph-warning"></i><span id="confirmTitle">تایید</span></h3><button class="icon-btn" id="confirmClose" style="width:32px;height:32px"><i class="ph ph-x"></i></button></div>
    <div class="modal-body" style="padding:18px"><p id="confirmMsg" style="font-size:13px;line-height:1.7"></p></div>
    <div class="modal-foot"><button class="icon-action" id="confirmCancel">انصراف</button><button class="icon-action danger" id="confirmOk">تایید</button></div>
  </div>
</div>

<div class="modal-backdrop" id="previewModal">
  <div class="modal" style="max-width:900px">
    <div class="modal-head"><h3><i class="ph ph-eye"></i>پیش‌نمایش</h3><button class="icon-btn" id="previewClose" style="width:32px;height:32px"><i class="ph ph-x"></i></button></div>
    <div class="modal-body" style="padding:0"><iframe id="previewFrame" sandbox="allow-scripts allow-same-origin" style="width:100%;min-height:60vh;border:none;background:transparent"></iframe></div>
  </div>
</div>

<div class="modal-backdrop" id="iconPickerModal">
  <div class="modal" style="max-width:600px">
    <div class="modal-head"><h3><i class="ph ph-squares-four"></i>انتخاب آیکون</h3><button class="icon-btn" id="iconPickerClose" style="width:32px;height:32px"><i class="ph ph-x"></i></button></div>
    <div class="modal-body"><input type="text" id="iconSearch" placeholder="جستجو..."><div class="icon-grid" id="iconGrid"></div></div>
    <div class="modal-foot"><button class="icon-action" id="iconPickerCancel">بستن</button></div>
  </div>
</div>

<div class="modal-backdrop" id="syncModal">
  <div class="modal" style="max-width:520px">
    <div class="modal-head"><h3><i class="ph ph-cloud-check"></i><span id="syncTitle">ذخیره آنلاین</span></h3><button class="icon-btn" id="syncClose" style="width:32px;height:32px"><i class="ph ph-x"></i></button></div>
    <div class="modal-body" id="syncBody"></div>
    <div class="modal-foot"><button class="icon-action" id="syncCancel">بستن</button></div>
  </div>
</div>

<script>
/* ============================================================
   ⛵ کشتی نوح v1.4.4 — گروه هنری اقاقیا
   ============================================================ */
const STORAGE_KEY = 'noah_ark_db_v1';
const THEME_KEY = 'noah_ark_theme';
const PRESET_KEY = 'noah_ark_preset';
const COLOR_KEY = 'noah_ark_color';
const APP_VERSION = '1.4.4';
const APP_BUILD_ISO = new Date().toISOString();
const APP_BUILD_DATE_FA = new Intl.DateTimeFormat('fa-IR',{weekday:'long',day:'2-digit',month:'long',year:'numeric'}).format(new Date());
const IDB_NAME = 'noah_ark_libs_v1';

/* ===== SPLASH ===== */
(function buildSplashStars(){
  const el = document.getElementById('splashStars');
  if(!el) return;
  let h = '';
  for(let i=0;i<50;i++){
    const x = Math.random()*100, y = Math.random()*100;
    const s = 0.8 + Math.random()*1.8;
    const d = (Math.random()*3).toFixed(2);
    h += `<div class="splash-star" style="left:${x}%;top:${y}%;width:${s}px;height:${s}px;animation-delay:${d}s"></div>`;
  }
  el.innerHTML = h;
})();

let splashHidden = false;
function hideSplash(){ if(splashHidden) return; splashHidden=true; const s=document.getElementById('splash'); if(!s) return; s.classList.add('hide'); setTimeout(()=>{ try{s.remove();}catch(e){} }, 700); }
window.addEventListener('error', hideSplash);
window.addEventListener('unhandledrejection', hideSplash);
setTimeout(hideSplash, 2400);
if(document.readyState === 'complete') hideSplash(); else window.addEventListener('load', hideSplash, {once:true});

/* ===== HELPERS ===== */
const $ = s => document.querySelector(s);
const $$ = s => document.querySelectorAll(s);
const faNum = n => String(n).replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[+d]);
function escapeHtml(s){ return String(s==null?'':s).replace(/[&<>"']/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c])); }
function safeDate(iso){ if(!iso) return null; try{ const d=new Date(iso); return isNaN(d.getTime())?null:d; }catch(e){ return null; } }
function jDate(iso){ const d=safeDate(iso); if(!d) return '—'; try{ const wd=new Intl.DateTimeFormat('fa-IR',{weekday:'long'}).format(d); const dt=new Intl.DateTimeFormat('fa-IR',{day:'2-digit',month:'long',year:'numeric'}).format(d); const tm=new Intl.DateTimeFormat('fa-IR',{hour:'2-digit',minute:'2-digit',hour12:false}).format(d); return wd+' '+dt+' · '+tm; }catch(e){ return '—'; } }
function jDateShort(iso){ const d=safeDate(iso); if(!d) return '—'; try{ return new Intl.DateTimeFormat('fa-IR',{year:'numeric',month:'2-digit',day:'2-digit'}).format(d); }catch(e){ return '—'; } }
function jDateFull(iso){ const d=safeDate(iso); if(!d) return '—'; try{ const wd=new Intl.DateTimeFormat('fa-IR',{weekday:'long'}).format(d); const dt=new Intl.DateTimeFormat('fa-IR',{day:'2-digit',month:'long',year:'numeric'}).format(d); const tm=new Intl.DateTimeFormat('fa-IR',{hour:'2-digit',minute:'2-digit',second:'2-digit',hour12:false}).format(d); return wd+' '+dt+' · '+tm; }catch(e){ return '—'; } }
function daysAgo(iso){
  const d = safeDate(iso); if(!d) return '—';
  const diff = Math.floor((Date.now() - d.getTime()) / (1000*60*60*24));
  if(diff <= 0) return 'امروز';
  if(diff === 1) return 'دیروز';
  if(diff < 30) return faNum(diff)+' روز پیش';
  if(diff < 365) return faNum(Math.floor(diff/30))+' ماه پیش';
  return faNum(Math.floor(diff/365))+' سال پیش';
}

function toast(msg, type=''){
  const t = document.createElement('div');
  t.className = 'toast '+type; t.textContent = msg;
  document.body.appendChild(t);
  requestAnimationFrame(()=>t.classList.add('show'));
  setTimeout(()=>{ t.classList.remove('show'); setTimeout(()=>t.remove(),350); },2600);
}
function copyText(text){
  if(!text){ toast('چیزی برای کپی نیست','err'); return; }
  if(navigator.clipboard && navigator.clipboard.writeText){ navigator.clipboard.writeText(text).then(()=>toast('✓ کپی شد','ok')).catch(()=>fallbackCopy(text)); } else fallbackCopy(text);
}
function fallbackCopy(text){
  const ta = document.createElement('textarea'); ta.value = text;
  ta.style.position='fixed'; ta.style.opacity='0';
  document.body.appendChild(ta); ta.select();
  try{ document.execCommand('copy'); toast('✓ کپی شد','ok'); }catch(e){ toast('کپی ناموفق','err'); }
  ta.remove();
}
async function pasteFromClipboard(){
  try{ if(navigator.clipboard && navigator.clipboard.readText) return await navigator.clipboard.readText(); return null; }catch(e){ return null; }
}
function downloadFile(name, content, mime='application/json'){
  const blob = new Blob([content],{type:mime+';charset=utf-8'});
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a'); a.href=url; a.download=name;
  document.body.appendChild(a); a.click();
  setTimeout(()=>{ URL.revokeObjectURL(url); a.remove(); },100);
}

/* ===== INDEXEDDB LIB CACHE ===== */
let idbDB = null;
let libDirHandle = null;

async function openLibDB(){
  if(idbDB) return idbDB;
  return new Promise((resolve, reject) => {
    const req = indexedDB.open(IDB_NAME, 1);
    req.onupgradeneeded = e => {
      const d = e.target.result;
      if(!d.objectStoreNames.contains('libs')) d.createObjectStore('libs', {keyPath:'name'});
      if(!d.objectStoreNames.contains('meta')) d.createObjectStore('meta', {keyPath:'key'});
    };
    req.onsuccess = e => { idbDB = e.target.result; resolve(idbDB); };
    req.onerror = e => reject(e.target.error);
  });
}
async function checkLibCache(name){
  try{ const db = await openLibDB(); return new Promise(res => { const tx=db.transaction('libs','readonly'); const req=tx.objectStore('libs').get(name); req.onsuccess=()=>res(req.result||null); req.onerror=()=>res(null); }); }catch(e){ return null; }
}
async function saveLibCache(name, data, type='js'){
  try{ const db = await openLibDB(); return new Promise(res => { const tx=db.transaction('libs','readwrite'); tx.objectStore('libs').put({name,data,type,ts:Date.now()}); tx.oncomplete=()=>res(true); tx.onerror=()=>res(false); }); }catch(e){ return false; }
}
async function listCachedLibs(){
  try{ const db = await openLibDB(); return new Promise(res => { const tx=db.transaction('libs','readonly'); const req=tx.objectStore('libs').getAll(); req.onsuccess=()=>res(req.result||[]); req.onerror=()=>res([]); }); }catch(e){ return []; }
}
async function saveDirHandle(handle){
  try{ const db = await openLibDB(); return new Promise(res => { const tx=db.transaction('meta','readwrite'); tx.objectStore('meta').put({key:'libDir', handle}); tx.oncomplete=()=>res(true); tx.onerror=()=>res(false); }); }catch(e){ return false; }
}
async function loadDirHandle(){
  try{ const db = await openLibDB(); return new Promise(res => { const tx=db.transaction('meta','readonly'); const req=tx.objectStore('meta').get('libDir'); req.onsuccess=()=>res(req.result?req.result.handle:null); req.onerror=()=>res(null); }); }catch(e){ return null; }
}

/* ===== FOLDER RECURSION ===== */
async function findFileRecursive(dirHandle, query) {
  if (!dirHandle) return null;
  const q = query.toLowerCase().replace(/[^a-z0-9]/g, '');
  for await (const entry of dirHandle.values()) {
    if (entry.kind === 'file') {
      const fname = entry.name.toLowerCase();
      if (!/\.(js|css)$/i.test(fname)) continue;
      const cleanName = fname.replace(/\.(js|css)$/i, '').replace(/[^a-z0-9]/g, '');
      if (cleanName.includes(q) || q.includes(cleanName) || cleanName === q) {
        const file = await entry.getFile();
        const content = await file.text();
        const type = fname.endsWith('.css') ? 'css' : 'js';
        return { content, type, filename: entry.name };
      }
    } else if (entry.kind === 'directory') {
      const result = await findFileRecursive(entry, query);
      if (result) return result;
    }
  }
  return null;
}

async function scanFolderAndCache(){
  if(!libDirHandle) return {cached:0, total:0};
  let cached = 0, total = 0;
  async function scan(dir) {
    for await (const entry of dir.values()) {
      if (entry.kind === 'file') {
        if (!/\.(js|css)$/i.test(entry.name)) continue;
        total++;
        try {
          const file = await entry.getFile();
          const content = await file.text();
          const type = entry.name.endsWith('.css') ? 'css' : 'js';
          const name = entry.name.replace(/\.(js|css)$/i, '');
          await saveLibCache(name, content, type);
          cached++;
        } catch(e) {}
      } else if (entry.kind === 'directory') {
        await scan(entry);
      }
    }
  }
  await scan(libDirHandle);
  return {cached, total};
}

/* ===== CDN MAPPINGS ===== */
const SPECIAL_LIBS = {
  'vazirmatn font':'vazirmatn@33.0.3/Vazirmatn-font-face.css',
  'vazirmatn':'vazirmatn@33.0.3/Vazirmatn-font-face.css',
  'phosphor icons':'@phosphor-icons/web@2.1.1/src/regular/style.css',
  '@phosphor-icons/web':'@phosphor-icons/web@2.1.1/src/regular/style.css'
};
const NPM_PATHS = {
  'chart.js':'chart.js@4.4.0/dist/chart.umd.min.js',
  'gsap':'gsap@3.12.2/dist/gsap.min.js',
  'three':'three@0.160.0/build/three.min.js',
  'react':'react@18.2.0/umd/react.production.min.js',
  'vue':'vue@3.3.8/dist/vue.global.prod.js',
  'bootstrap':'bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
  'jquery':'jquery@3.7.1/dist/jquery.min.js',
  'lodash':'lodash@4.17.21/lodash.min.js',
  'axios':'axios@1.6.0/dist/axios.min.js',
  'd3':'d3@7.8.5/dist/d3.min.js',
  'alpinejs':'alpinejs@3.13.1/dist/cdn.min.js',
  'gridjs':'gridjs@6.0.6/dist/gridjs.umd.js',
  'gridjs css':'gridjs@6.0.6/dist/theme/mermaid.min.css',
  'sweetalert2':'sweetalert2@11.10.1/dist/sweetalert2.all.min.js',
  'swiper':'swiper@11.0.5/swiper-bundle.min.js',
  'swiper css':'swiper@11.0.5/swiper-bundle.min.css',
  'ag grid 31':'ag-grid-community@31.0.0/dist/ag-grid-community.min.js',
  'ag-grid 31':'ag-grid-community@31.0.0/dist/ag-grid-community.min.js',
  'ag grid':'ag-grid-community@31.0.0/dist/ag-grid-community.min.js',
  'ag-grid':'ag-grid-community@31.0.0/dist/ag-grid-community.min.js',
  'ag-grid-community':'ag-grid-community@31.0.0/dist/ag-grid-community.min.js',
  'persian datepicker':'persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js',
  'persian-datepicker':'persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js',
  'persian date':'persian-date@1.2.0/dist/persian-date.min.js',
  'persian-date':'persian-date@1.2.0/dist/persian-date.min.js'
};
function getLibNpmPath(lib){
  const k = String(lib||'').toLowerCase().trim();
  return SPECIAL_LIBS[k] || NPM_PATHS[k] || null;
}
function getLibCDNUrls(lib){
  const path = getLibNpmPath(lib);
  if(!path) return [];
  return [`https://cdn.jsdelivr.net/npm/${path}`, `https://unpkg.com/${path}`];
}

const libStatusMemory = new Map();

async function getLibContent(dep){
  const cached = await checkLibCache(dep);
  if(cached) return {ok:true, content:cached.data, type:cached.type, source:'cache'};
  const folderHit = await findFileRecursive(libDirHandle, dep);
  if(folderHit){
    await saveLibCache(dep, folderHit.content, folderHit.type);
    return {ok:true, content:folderHit.content, type:folderHit.type, source:'folder'};
  }
  const urls = getLibCDNUrls(dep);
  if(urls.length > 0){
    const url = urls[0];
    const type = url.endsWith('.css') ? 'css' : 'js';
    return {ok:true, url, type, source:'online'};
  }
  return {ok:false};
}
function isBuiltIn(lib) {
  const l = String(lib).toLowerCase();
  return l.includes('vazirmatn') || l.includes('phosphor');
}
async function getLibStatus(dep){
  if (libStatusMemory.has(dep)) return libStatusMemory.get(dep);
  let result = {status:'red', label:'یافت نشد', source:'none'};
  const cached = await checkLibCache(dep);
  if(cached) { result = {status:'green', label:'در کش', source:'cache'}; libStatusMemory.set(dep, result); return result; }
  const folderHit = await findFileRecursive(libDirHandle, dep);
  if(folderHit) { result = {status:'green', label:'در پوشه', source:'folder'}; libStatusMemory.set(dep, result); return result; }
  if (isBuiltIn(dep)) { result = {status:'green', label:'پیش‌فرض', source:'builtin'}; libStatusMemory.set(dep, result); return result; }
  const urls = getLibCDNUrls(dep);
  if (urls.length > 0) { result = {status:'green', label:'آنلاین (CDN)', source:'online'}; }
  libStatusMemory.set(dep, result);
  return result;
}

/* ===== DB ===== */
function getInitialDB(){
  const now = new Date().toISOString();
  return {
    meta:{
      app:'کشتی نوح', version: APP_VERSION,
      createdAt: now, created: now,
      algorithm:'گروه هنری اقاقیا',
      designer:'حسن حاجی قاسمی',
      changelog:[
        {
          version:'1.4.4',
          ts: now,
          newItems:[
            'کروسل افقی خودکار فناوری‌های استفاده شده با لوپ بی‌پایان',
            'آکاردیون تاریخچه نسخه‌ها (فقط یک کارت باز با انیمیشن)',
            'پس‌زمینه بلور برای لیست‌های باز (Dropdown Backdrop)',
            'قالب راهنمای پرامپت‌محور برای AI و برنامه‌نویس',
            'ردیف تاریخ آخرین بروزرسانی در شناسنامه با محاسبه خودکار «چند روز پیش»',
            'پشتیبانی کامل از AG Grid 31 و Persian Datepicker در جدول کتابخانه‌ها',
            'دکمه‌های عملیات بالای جدول اطلاعات در صفحه نمایش'
          ],
          updates:[
            'نسخه برنامه به v۱.۴.۴ بروزرسانی شد',
            'آیکون هدر با SVG واقعی (بادبان و بدنه کشتی) جایگزین ایموجی شد',
            'آسمان درباره ما ثابت و بدون چرخه دوره (زمان حال)',
            'ابرها، ستاره‌ها و ماه با گرادیانت و بافت واقعی‌تر',
            'پیش‌نمایش تمام‌عرض بدون پدینگ چپ/راست با ارتفاع مناسب',
            'پس‌زمینه بلور برای لیست‌ها هنگام باز شدن',
            'تفاوت چشمگیر بین پوسته‌ها (default / material / liquid / win11)',
            'حذف فیلد «موضوع» از صفحه ورود کد — فقط آیتم و نوع'
          ],
          fixes:[
            'رفع مشکل نمایش کتابخانه‌های AG Grid 31 و Persian Datepicker در جدول اطلاعات',
            'رفع مشکل اجرای نمونه کد قدیمی جدول سفارشات در پیش‌نمایش',
            'رفع مشکل ثبت‌نشدن خودکار نوع آیتم هنگام ذخیره',
            'بسته‌شدن خودکار لیست قبلی هنگام باز کردن لیست جدید',
            'بهبود پایداری راهنمای کد (نمونه‌ها در باکس مخصوص)'
          ],
          notes:'نسخه پایدار — آیکون واقعی، آسمان ثابت، کروسل فناوری، آکاردیون نسخه، تم‌های متمایز، پشتیبانی AG Grid.'
        },
        {
          version:'1.4.3',
          ts: new Date(Date.now() - 86400000*2).toISOString(),
          notes:'رفع کامل باگ استایل تب‌های درباره ما، اضافه شدن دکمه دانلود کتابخانه به صفحه نمایش، اصلاح آپلود در هاست'
        },
        {
          version:'1.4.2',
          ts: new Date(Date.now() - 86400000*5).toISOString(),
          notes:'رفع خطاهای Null و جابجایی هدر'
        },
        {
          version:'1.0',
          ts: new Date(Date.now() - 86400000*30).toISOString(),
          notes:'نسخه اولیه'
        }
      ]
    },
    items:{},
    categories:['کامپوننت','لایه','فرم','تعاملی','استایل','ابزارک','نمودار','بنر','کارت','دکمه','گالری','ناوبری'],
    subjects:['عمومی','فناوری','هنری','آموزشی','سرگرمی','ابزار','کشاورزی','سلامت','مالی','رسانه'],
    backups:[],
    logs:[{ts:now, action:'نصب نسخه v'+APP_VERSION, type:'create', detail:'کشتی نوح '+APP_VERSION}]
  };
}
function loadDB(){
  let raw;
  try{ raw = localStorage.getItem(STORAGE_KEY); }catch(e){ return getInitialDB(); }
  if(!raw) return getInitialDB();
  let p;
  try{ p = JSON.parse(raw); }catch(err){
    try{ localStorage.setItem(STORAGE_KEY+'_corrupt_'+Date.now(), raw); }catch(e){}
    setTimeout(()=>toast('داده‌های قبلی خراب بودند — در کلید پشتیبان حفظ شدند','err'),2000);
    return getInitialDB();
  }
  if(!p || typeof p !== 'object' || !p.items) return getInitialDB();
  if(!p.backups) p.backups = [];
  if(!p.categories) p.categories = [];
  if(!p.subjects) p.subjects = ['عمومی','فناوری'];
  if(!p.logs) p.logs = [];
  if(!p.meta) p.meta = {};
  if(!p.meta.createdAt) p.meta.createdAt = p.meta.created || new Date().toISOString();
  if(!Array.isArray(p.meta.changelog)) p.meta.changelog = [];
  
  // ensure 1.4.4 entry exists
  const has144 = p.meta.changelog.some(c => c.version === '1.4.4');
  if(!has144){
    const fresh = getInitialDB();
    p.meta.changelog.unshift(fresh.meta.changelog[0]);
  }
  p.meta.version = APP_VERSION;
  return p;
}
let db = loadDB();
function saveDB(){
  try{ localStorage.setItem(STORAGE_KEY, JSON.stringify(db)); }
  catch(e){ toast('خطا در ذخیره — فضای مرورگر پر است','err'); throw e; }
}
function log(action, detail, type){
  if(!type){
    if(action.includes('ذخیره')) type='save';
    else if(action.includes('ایجاد')) type='create';
    else if(action.includes('حذف')) type='delete';
    else if(action.includes('بک‌آپ')) type='backup';
    else if(action.includes('بازگردانی')) type='restore';
    else type='other';
  }
  db.logs.push({ts:new Date().toISOString(), action, type, detail});
  if(db.logs.length > 500) db.logs = db.logs.slice(-400);
  saveDB();
}

/* ===== THEME ===== */
const PRESETS = {
  default:{name:'شیشه‌ای',icon:'💎',desc:'گوشه‌های گرد، بلور متوسط'},
  material:{name:'متریال',icon:'🎨',desc:'گوشه‌های تیز، سایه‌های چندلایه'},
  liquid:{name:'لکوید',icon:'🍎',desc:'بسیار گرد، بلور بالا'},
  win11:{name:'ویندوز ۱۱',icon:'🪟',desc:'Mica، تیره‌روشن'}
};
const COLORS = {
  cyan:{name:'فیروزه‌ای',c1:'#22d3ee',c2:'#a855f7'}, blue:{name:'آبی',c1:'#3b82f6',c2:'#6366f1'},
  purple:{name:'بنفش',c1:'#a855f7',c2:'#d946ef'}, green:{name:'سبز',c1:'#10b981',c2:'#22c55e'},
  orange:{name:'نارنجی',c1:'#f97316',c2:'#f59e0b'}, pink:{name:'صورتی',c1:'#ec4899',c2:'#f472b6'},
  red:{name:'قرمز',c1:'#ef4444',c2:'#dc2626'}, teal:{name:'فیروزه‌ای تیره',c1:'#14b8a6',c2:'#0d9488'},
  amber:{name:'کهربایی',c1:'#f59e0b',c2:'#d97706'}, dracula:{name:'دراکولا',c1:'#bd93f9',c2:'#ff79c6'},
  monokai:{name:'مونوکای',c1:'#a6e22e',c2:'#f92672'}, nord:{name:'نورد',c1:'#88c0d0',c2:'#81a1c1'},
  tokyo:{name:'توکیو',c1:'#7aa2f7',c2:'#bb9af7'}
};
function applyTheme(t){ document.documentElement.dataset.theme=t; const b=document.getElementById('themeBtn'); if(b) b.textContent = t==='dark'?'☀️':'🌙'; localStorage.setItem(THEME_KEY, t); }
function applyPreset(p){ document.documentElement.dataset.preset=p; localStorage.setItem(PRESET_KEY, p); renderPresetGrid(); }
function applyColor(c){ document.documentElement.dataset.color=c; localStorage.setItem(COLOR_KEY, c); renderColorGrid(); }
applyTheme(localStorage.getItem(THEME_KEY)||'dark');
document.documentElement.dataset.preset = localStorage.getItem(PRESET_KEY)||'default';
document.documentElement.dataset.color = localStorage.getItem(COLOR_KEY)||'cyan';

function renderPresetGrid(){
  const cur = document.documentElement.dataset.preset;
  const el = document.getElementById('presetGrid');
  if(!el) return;
  el.innerHTML = Object.entries(PRESETS).map(([k,v]) => `<button class="theme-cell${k===cur?' active':''}" data-preset="${k}" title="${v.desc}"><span class="tc-icon">${v.icon}</span><div class="tc-name">${v.name}</div></button>`).join('');
  el.querySelectorAll('.theme-cell').forEach(b => b.onclick = () => applyPreset(b.dataset.preset));
}
function renderColorGrid(){
  const cur = document.documentElement.dataset.color;
  const el = document.getElementById('colorGrid');
  if(!el) return;
  el.innerHTML = Object.entries(COLORS).map(([k,v]) => `<button class="color-cell${k===cur?' active':''}" data-color="${k}" style="background:linear-gradient(135deg,${v.c1},${v.c2})" title="${v.name}"></button>`).join('');
  el.querySelectorAll('.color-cell').forEach(b => b.onclick = () => applyColor(b.dataset.color));
}

/* ===== DROPDOWN (mutual close + backdrop) ===== */
const ddBackdropEl = document.getElementById('ddBackdrop');
function showDDBackdrop(){ if(ddBackdropEl){ ddBackdropEl.classList.add('show'); ddBackdropEl.onclick = () => { document.querySelectorAll('.dd.open').forEach(el => { if(el._ddInstance) el._ddInstance.close(); }); }; } }
function hideDDBackdrop(){ if(ddBackdropEl) ddBackdropEl.classList.remove('show'); }

class Dropdown {
  constructor(el, opts={}){
    this.el = el; this.opts = opts; this.value = ''; this.items = [];
    el._ddInstance = this;
    this._build();
  }
  _build(){
    this.el.classList.add('dd');
    this.el.innerHTML = `<button class="dd-trigger" type="button"><span class="placeholder">${escapeHtml(this.opts.placeholder||'انتخاب کنید')}</span><i class="ph ph-caret-down chev"></i></button><div class="dd-panel"></div>`;
    this.trigger = this.el.querySelector('.dd-trigger');
    this.panel = this.el.querySelector('.dd-panel');
    this.trigger.onclick = (e) => { e.stopPropagation(); if(this.el.classList.contains('open')) this.close(); else this.open(); };
    document.addEventListener('click', (e) => { if(!this.el.contains(e.target)) this.close(); });
  }
  setItems(items){ this.items = items; this._render(); }
  _render(){
    if(!this.items.length){ this.panel.innerHTML = '<div class="dd-item empty">موردی موجود نیست</div>'; return; }
    this.panel.innerHTML = this.items.map((it,i) => {
      const num = faNum(i+1);
      const meta = this.opts.renderItem ? this.opts.renderItem(it,i) : {ttl: it.label || it.value};
      const active = it.value === this.value ? ' active' : '';
      const badge = meta.badge ? `<span class="bg${meta.badgeNew?' new':''}">${escapeHtml(meta.badge)}</span>` : '';
      const date = meta.date ? `<span class="dt">${escapeHtml(meta.date)}</span>` : '';
      return `<div class="dd-item${active}" data-val="${escapeHtml(it.value)}"><span class="num">${num}</span><span class="ttl">${escapeHtml(meta.ttl||it.value)}</span>${date}${badge}</div>`;
    }).join('');
    this.panel.querySelectorAll('.dd-item:not(.empty)').forEach(row => {
      row.onclick = () => { this.setValue(row.dataset.val, true); this.close(); };
    });
  }
  setValue(v, fromUser=false){
    this.value = v;
    const found = this.items.find(x => x.value === v);
    const sel = this.trigger.querySelector('.selected');
    const ph = this.trigger.querySelector('.placeholder');
    if(found){
      if(!sel){ if(ph) ph.outerHTML = `<span class="selected"><span class="nm"></span></span>`; }
      const nm = this.trigger.querySelector('.nm');
      if(nm) nm.textContent = found.label || found.value;
    } else {
      if(sel) sel.outerHTML = `<span class="placeholder">${escapeHtml(this.opts.placeholder||'انتخاب کنید')}</span>`;
    }
    this._render();
    if(this.opts.onSelect) this.opts.onSelect(v, found, fromUser);
  }
  getValue(){ return this.value; }
  open(){ 
    // close all other dropdowns
    document.querySelectorAll('.dd.open').forEach(el => {
      if(el._ddInstance && el._ddInstance !== this) el._ddInstance.close();
    });
    this.el.classList.add('open'); 
    this.trigger.classList.add('open'); 
    showDDBackdrop();
  }
  close(){ 
    this.el.classList.remove('open'); 
    this.trigger.classList.remove('open');
    if(!document.querySelector('.dd.open')) hideDDBackdrop();
  }
}

const itemDD = new Dropdown(document.getElementById('itemDD'), {placeholder:'انتخاب آیتم', onSelect:()=>{ try{updateEntryPreview();}catch(e){} }});
const catDD = new Dropdown(document.getElementById('catDD'), {placeholder:'انتخاب نوع'});
const iconItemDD = new Dropdown(document.getElementById('iconItemDD'), {placeholder:'آیتم را انتخاب کنید'});

function refreshItemDD(){
  const list = Object.values(db.items).map(it => {
    const last = it.versions && it.versions.length ? it.versions[it.versions.length-1].ts : it.createdAt;
    return {value:it.name, label:it.name, meta:{ttl:it.name, badge: it.versions && it.versions.length ? faNum(it.versions.length)+' نسخه':'جدید', badgeNew: !(it.versions && it.versions.length), date: jDateShort(last)}};
  });
  itemDD.setItems(list);
  iconItemDD.setItems(list);
}
function refreshCatDD(){ catDD.setItems(db.categories.map(c => ({value:c,label:c}))); }

/* ===== PARSE ===== */
function parseItemCode(code){
  const trimmed = (code||'').trim();
  const re = /===NOAH-ARK-ITEM-v1===([\s\S]*?)===END-NOAH-ARK-ITEM===/;
  const m = trimmed.match(re);
  if(m){
    let body = m[1].trim();
    try{ return {ok:true, data:JSON.parse(body), raw:false}; }
    catch(e){
      const a = body.indexOf('{'), b = body.lastIndexOf('}');
      if(a !== -1 && b > a){
        try{ return {ok:true, data:JSON.parse(body.slice(a,b+1)), raw:false}; }catch(e2){}
      }
      return {ok:false, error:'JSON نامعتبر: '+e.message};
    }
  }
  if(trimmed.startsWith('{') && trimmed.endsWith('}')){
    try{ return {ok:true, data:JSON.parse(trimmed), raw:false}; }catch(e){}
  }
  return {ok:true, data:{title:'',category:'',subject:'',description:'کد خام',style:'',usage:'',params:{},dependencies:[],html:'',css:'',js:'',raw:trimmed}, raw:true};
}
function parseBulk(text){
  const items = [];
  const re = /===NOAH-ARK-ITEM-v1===([\s\S]*?)===END-NOAH-ARK-ITEM===/g;
  let m;
  while((m = re.exec(text)) !== null){
    try{ items.push(JSON.parse(m[1].trim())); }catch(e){ console.warn('bulk parse:', e); }
  }
  if(items.length) return items;
  try{ const arr = JSON.parse(text); if(Array.isArray(arr)) return arr; }catch(e){}
  return [];
}
function detectCategory(data){
  if(data && data.category && typeof data.category === 'string') return data.category.trim();
  const text = [data?.title||'', data?.description||'', data?.style||'', data?.usage||''].join(' ').toLowerCase();
  const rules = [{kw:['نمودار','chart','گراف','graph','pie','bar'],cat:'نمودار'},{kw:['فرم','form','input','ورودی'],cat:'فرم'},{kw:['بنر','banner','هدر','header','hero'],cat:'بنر'},{kw:['کارت','card','tile'],cat:'کارت'},{kw:['دکمه','button','btn'],cat:'دکمه'},{kw:['گالری','gallery','تصویر','image','slider'],cat:'گالری'},{kw:['تب','tab','ناوبری','nav','منو'],cat:'ناوبری'},{kw:['ابزارک','widget'],cat:'ابزارک'},{kw:['تعاملی','interactive'],cat:'تعاملی'},{kw:['استایل','style','theme'],cat:'استایل'},{kw:['لایه','layer','grid'],cat:'لایه'},{kw:['جدول','table','data'],cat:'کامپوننت'}];
  for(const r of rules){ if(r.kw.some(k => text.includes(k))) return r.cat; }
  return 'کامپوننت';
}
function detectSubject(data){
  if(data && data.subject && typeof data.subject === 'string') return data.subject.trim();
  const text = [data?.title||'', data?.description||'', data?.style||'', data?.usage||''].join(' ').toLowerCase();
  const rules = [{kw:['نمودار','chart','graph','داده','data'],s:'فناوری'},{kw:['کشاورزی','دام','شیر','حیوان','plant','crop','farm'],s:'کشاورزی'},{kw:['سلامت','پزشک','بیمار','health','medical'],s:'سلامت'},{kw:['مالی','بانک','پرداخت','payment','bank','money'],s:'مالی'},{kw:['آموزش','درس','معلم','learn','course'],s:'آموزشی'},{kw:['بازی','game','سرگرم','fun'],s:'سرگرمی'},{kw:['موسیقی','music','صدا','audio','video'],s:'رسانه'},{kw:['هنر','art','طراحی','design'],s:'هنری'},{kw:['ابزار','tool','utility'],s:'ابزار'}];
  for(const r of rules){ if(r.kw.some(k => text.includes(k))) return r.s; }
  return 'عمومی';
}

function buildInfoTable(d, extra={}){
  const rows = [];
  if(d.title) rows.push(['عنوان', escapeHtml(d.title)]);
  if(d.category) rows.push(['نوع', escapeHtml(d.category)]);
  if(d.subject) rows.push(['موضوع', escapeHtml(d.subject)]);
  if(d.description) rows.push(['توضیح', escapeHtml(d.description)]);
  if(d.style) rows.push(['استایل', escapeHtml(d.style)]);
  if(d.usage) rows.push(['نحوه استفاده', escapeHtml(d.usage)]);
  if(d.params && typeof d.params === 'object' && Object.keys(d.params).length){
    const tags = Object.entries(d.params).map(([k,p])=>{ const t=p&&p.type?' ('+p.type+')':''; const def=p&&p.default!==undefined?' ['+p.default+']':''; return `<span class="tag">${escapeHtml(k)}${escapeHtml(t)}${escapeHtml(def)}</span>`; }).join('');
    rows.push(['پارامترها', tags]);
  }
  if(d.dependencies && d.dependencies.length){
    const deps = d.dependencies.map(x => `<span class="dep-status checking" data-dep-status="${escapeHtml(x)}"><span class="dot"></span>${escapeHtml(x)}</span>`).join('');
    rows.push(['کتابخانه‌ها', deps]);
  }
  if(extra.raw) rows.push(['وضعیت','<span class="tag" style="background:rgba(251,191,36,.15);color:#fbbf24;border-color:rgba(251,191,36,.3)">کد خام</span>']);
  if(extra.version) rows.push(['نسخه', faNum(extra.version)]);
  if(extra.date) rows.push(['تاریخ ثبت', escapeHtml(extra.date)]);
  if(!rows.length) return '';
  return `<div class="table-scroll"><table class="mini-table" id="infoTable">${rows.map(([k,v])=>`<tr><th>${k}</th><td>${v}</td></tr>`).join('')}</table></div>`;
}
function wireInfoTableClicks(){
  const tbl = document.getElementById('infoTable');
  if(!tbl) return;
  tbl.querySelectorAll('tr').forEach(tr => {
    tr.style.cursor = 'pointer';
    tr.addEventListener('click', (e) => {
      if(e.target.closest('.dep-status')) return;
      tr.classList.toggle('expanded');
    });
  });
}
async function checkDepStatuses(){
  const els = document.querySelectorAll('[data-dep-status]');
  for(const el of els){
    const dep = el.dataset.depStatus;
    const s = await getLibStatus(dep);
    el.classList.remove('checking');
    el.classList.add(s.status);
    el.innerHTML = `<span class="dot"></span>${escapeHtml(dep)} — ${s.label}`;
  }
}

function updateEntryPreview(){
  const codeEl = document.getElementById('codeInput');
  const box = document.getElementById('entryPreview');
  if(!codeEl || !box) return;
  const code = codeEl.value.trim();
  if(!code){ box.innerHTML=''; return; }
  if(!code.includes('===NOAH-ARK-ITEM-v1===') && !code.startsWith('{')){ box.innerHTML=''; return; }
  const p = parseItemCode(code);
  if(!p.ok){ box.innerHTML = `<div class="mini-table" style="padding:10px;color:var(--err);font-size:12px">خطا: ${escapeHtml(p.error)}</div>`; return; }
  box.innerHTML = buildInfoTable(p.data,{raw:p.raw});
  wireInfoTableClicks();
  checkDepStatuses();
  if(!catDD.getValue()){
    const detected = detectCategory(p.data);
    if(detected){ if(!db.categories.includes(detected)){ db.categories.push(detected); refreshCatDD(); } catDD.setValue(detected); }
  }
}

/* ===== NAV SLIDER ===== */
function updateNavSlider(){
  const nav = document.getElementById('mobileNav');
  const slider = document.getElementById('navSlider');
  if(!nav || !slider) return;
  const active = nav.querySelector('button.active');
  if(!active) return;
  const update = () => {
    const navRect = nav.getBoundingClientRect();
    const btnRect = active.getBoundingClientRect();
    slider.style.left = (btnRect.left - navRect.left) + 'px';
    slider.style.width = btnRect.width + 'px';
    slider.classList.add('ready');
  };
  update();
  setTimeout(update, 50);
  setTimeout(update, 560);
}

function switchTab(name){
  $$('.tab').forEach(t => t.classList.toggle('active', t.dataset.tab === name));
  $$('.page').forEach(p => p.classList.toggle('active', p.id === 'page-'+name));
  $$('.mobile-nav button').forEach(b => b.classList.toggle('active', b.dataset.tab === name));
  updateNavSlider();
  try{
    if(name === 'view') renderView();
    if(name === 'about') { renderAbout(); updateAboutHeroStatic(); }
  }catch(e){ console.warn(e); }
}

/* ===== VIEW ===== */
let currentItem = null;
let currentVerIdx = 0;

function renderCarousel(){
  const carousel = document.getElementById('itemCarousel');
  if(!carousel) return;
  const items = Object.values(db.items);
  if(!items.length){ carousel.innerHTML = '<div class="empty" style="padding:14px;flex:1"><i class="ph ph-selection-all"></i>آیتمی نیست</div>'; return; }
  carousel.innerHTML = items.map(it => {
    let icon = '<i class="ph ph-cube"></i>';
    const _ri = it.icon;
    if(_ri && typeof _ri === 'string' && !/[{}<>]/.test(_ri)){
      if(_ri.startsWith('data:image/')) icon = `<img src="${escapeHtml(_ri)}" alt="">`;
      else if(/^[a-z0-9-]+$/i.test(_ri)) icon = `<i class="ph ph-${_ri}"></i>`;
    }
    return `<button class="carousel-item${it.name===currentItem?' active':''}" data-name="${escapeHtml(it.name)}">
      <div class="ci-icon">${icon}</div>
      <div class="ci-label">${escapeHtml(it.name)}</div>
      <div class="ci-badge">${it.versions.length ? faNum(it.versions.length)+' نسخه' : 'جدید'}</div>
    </button>`;
  }).join('');
  carousel.querySelectorAll('.carousel-item').forEach(b => {
    b.onclick = () => {
      currentItem = b.dataset.name;
      currentVerIdx = Math.max(0, (db.items[currentItem].versions||[]).length - 1);
      renderCarousel();
      renderView();
      renderVersionSwitcher();
    };
  });
  const active = carousel.querySelector('.carousel-item.active');
  if(active) try{ active.scrollIntoView({behavior:'smooth', block:'nearest', inline:'center'}); }catch(e){}
}
function renderVersionSwitcher(){
  const num = document.getElementById('verNum');
  const of = document.getElementById('verOf');
  const date = document.getElementById('verDate');
  const prev = document.getElementById('verPrev');
  const next = document.getElementById('verNext');
  if(!num) return;
  if(!currentItem || !db.items[currentItem]){ num.textContent='—'; of.textContent=''; date.textContent=''; prev.disabled=true; next.disabled=true; return; }
  const item = db.items[currentItem];
  const total = item.versions.length;
  const v = item.versions[currentVerIdx];
  if(!v) return;
  num.textContent = 'نسخه '+faNum(v.version);
  of.textContent = 'از '+faNum(total);
  date.textContent = jDateShort(v.ts);
  prev.disabled = currentVerIdx >= total - 1;
  next.disabled = currentVerIdx <= 0;
}

async function buildPreviewSrcdoc(m, raw, code){
  const html = m.html || (raw ? code : '') || '';
  const css = m.css || '';
  const js = (m.js || '').replace(/<\/script>/gi,'<\\/script>');
  
  const deps = [...(m.dependencies || [])].sort((a, b) => {
    if (a.toLowerCase().includes('jquery')) return -1;
    if (b.toLowerCase().includes('jquery')) return 1;
    return 0;
  });

  let libStyles = '';
  let libScripts = '';
  
  // AG Grid special case: add CSS when dependency detected
  const usesAgGrid = deps.some(d => d.toLowerCase().includes('ag grid') || d.toLowerCase().includes('ag-grid'));
  if (usesAgGrid) {
    libStyles += `<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-grid.css">\n`;
    libStyles += `<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ag-grid-community@31.0.0/styles/ag-theme-quartz-dark.css">\n`;
  }
  
  for(const dep of deps){
    const info = await getLibContent(dep);
    if(info.ok){
      if(info.url) {
        if(info.type === 'css') libStyles += `<link rel="stylesheet" href="${info.url}">\n`;
        else libScripts += `<script src="${info.url}"><\/script>\n`;
      } else {
        if(info.type === 'css') libStyles += `<style data-lib="${escapeHtml(dep)}">${info.content}</style>\n`;
        else libScripts += `<script data-lib="${escapeHtml(dep)}">${info.content}<\/script>\n`;
      }
    }
  }
  
  return `<!DOCTYPE html><html lang="fa" dir="rtl"><head>
<meta charset="UTF-8">
<link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
<script src="https://unpkg.com/@phosphor-icons/web"><\/script>
${libStyles}
<style>html,body{margin:0;padding:0;font-family:'Vazirmatn',system-ui,sans-serif;background:transparent;color:#e9f0f8;min-height:100%}${css}</style></head><body>${html}${libScripts}<script>${js}<\/script></body></html>`;
}

async function renderView(){
  renderCarousel();
  renderVersionSwitcher();
  const area = document.getElementById('viewArea');
  if(!area) return;
  if(!currentItem || !db.items[currentItem] || !db.items[currentItem].versions.length){
    area.innerHTML = `<div class="glass card"><div class="empty"><i class="ph ph-selection-all"></i>یک آیتم انتخاب کنید</div></div>`;
    return;
  }
  const item = db.items[currentItem];
  const v = item.versions[currentVerIdx];
  if(!v) return;
  const m = v.meta || {};
  const srcdoc = await buildPreviewSrcdoc(m, v.raw, v.code);
  const infoTable = buildInfoTable(m, {version:v.version, date:jDate(v.ts), raw:v.raw});
  const deps = m.dependencies || [];

  let depBlock = '';
  if(deps.length){
    depBlock = `<div class="glass card">
      <div class="card-title"><i class="ph ph-package"></i>وضعیت کتابخانه‌ها</div>
      <div id="depStatusList">${deps.map(d => `<span class="dep-status checking" data-dep-status="${escapeHtml(d)}"><span class="dot"></span>${escapeHtml(d)} — بررسی...</span>`).join('')}</div>
      <div class="flex-row mt-8">
        <button class="icon-action primary" onclick="openLibDownload()"><i class="ph ph-download-simple"></i><span class="lbl">بررسی / دانلود کتابخانه‌ها</span></button>
      </div>
    </div>`;
  }

  // Preview full-width, no padding; buttons above info table
  area.innerHTML = `
    <div class="preview-full">
      <div class="fw-label"><i class="ph ph-eye"></i>پیش‌نمایش</div>
      <iframe sandbox="allow-scripts allow-same-origin" id="previewIframe"></iframe>
    </div>
    <div class="glass card">
      <div class="flex-row">
        <button class="icon-action" onclick="copyViewCode()" data-tip="کپی"><i class="ph ph-copy"></i></button>
        <button class="icon-action" onclick="editViewItem()" data-tip="ویرایش"><i class="ph ph-pencil-simple"></i></button>
        <button class="icon-action primary" onclick="openViewLivePreview()" data-tip="بزرگ"><i class="ph ph-eye"></i></button>
        <button class="icon-action danger" onclick="deleteViewVersion()" data-tip="حذف"><i class="ph ph-trash"></i></button>
      </div>
    </div>
    ${infoTable ? `<div class="glass card">${infoTable}</div>` : ''}
    ${depBlock}`;

  window._currentCode = v.code;
  window._currentMeta = m;
  window._currentRaw = v.raw;

  const frame = document.getElementById('previewIframe');
  if(frame){
    frame.addEventListener('load', () => { try{ const h = frame.contentDocument.documentElement.scrollHeight; frame.style.height = Math.min(Math.max(h,240),1400)+'px'; }catch(e){} });
    frame.srcdoc = srcdoc;
  }
  wireInfoTableClicks();
  checkDepStatuses();
}

window.copyViewCode = () => copyText(window._currentCode || '');
window.editViewItem = () => {
  if(!window._currentCode){ toast('کدی نیست','err'); return; }
  itemDD.setValue(currentItem || '');
  if(db.items[currentItem]){ catDD.setValue(db.items[currentItem].category||''); }
  const ci = document.getElementById('codeInput');
  if(ci){ ci.value = window._currentCode; updateEntryPreview(); }
  switchTab('entry');
  toast('✓ بارگذاری شد','ok');
};
window.openViewLivePreview = async () => {
  if(!window._currentCode){ toast('کدی نیست','err'); return; }
  const frame = document.getElementById('previewFrame');
  frame.srcdoc = await buildPreviewSrcdoc(window._currentMeta||{}, window._currentRaw, window._currentCode);
  document.getElementById('previewModal').classList.add('show');
};
window.deleteViewVersion = async () => {
  if(!currentItem) return;
  const item = db.items[currentItem];
  const v = item.versions[currentVerIdx];
  if(!v) return;
  const ok = await confirmDialog('حذف نسخه', `«${currentItem} — نسخه ${v.version}» حذف شود؟`);
  if(!ok) return;
  item.versions.splice(currentVerIdx, 1);
  item.versions.forEach((ver,i) => ver.version = i+1);
  log('حذف نسخه', `${currentItem} — نسخه ${v.version}`,'delete');
  saveDB();
  currentVerIdx = Math.max(0, Math.min(currentVerIdx, item.versions.length - 1));
  refreshItemDD();
  renderView();
  toast('✓ حذف شد','ok');
};

/* ===== HEALTH CHECK ===== */
async function runHealthCheck() {
  const btn = document.getElementById('runHealthCheckBtn');
  const resBox = document.getElementById('healthCheckResult');
  if(!btn || !resBox) return;
  btn.disabled = true;
  btn.innerHTML = '<i class="ph ph-spinner ph-spin"></i><span>در حال اسکن...</span>';
  resBox.innerHTML = '';

  const allDeps = new Set();
  Object.values(db.items).forEach(it => {
    it.versions.forEach(v => {
      if (v.meta && v.meta.dependencies) v.meta.dependencies.forEach(d => allDeps.add(d));
    });
  });

  if (allDeps.size === 0) {
    resBox.innerHTML = '<div class="muted">هیچ کتابخانه‌ای در آیتم‌ها یافت نشد.</div>';
    btn.disabled = false;
    btn.innerHTML = '<i class="ph ph-activity"></i><span>شروع اسکن کامل سیستم</span>';
    return;
  }

  let html = `<div class="table-scroll"><table class="data-table"><thead><tr><th>کتابخانه</th><th>وضعیت</th><th>منبع</th></tr></thead><tbody>`;
  for (const dep of allDeps) {
    const s = await getLibStatus(dep);
    let label = s.status === 'green' ? 'در دسترس' : 'نامشخص';
    let color = s.status === 'green' ? 'var(--ok)' : 'var(--err)';
    html += `<tr>
      <td style="font-weight:700">${escapeHtml(dep)}</td>
      <td><span style="color:${color};font-weight:700">${label}</span></td>
      <td style="font-size:11px">${escapeHtml(s.label)}</td>
    </tr>`;
  }
  html += `</tbody></table></div>`;
  resBox.innerHTML = html;

  btn.disabled = false;
  btn.innerHTML = '<i class="ph ph-activity"></i><span>شروع مجدد اسکن</span>';
  toast('✓ اسکن کامل شد', 'ok');
}

/* ===== ABOUT HERO (static current time, no cycle) ===== */
function getGreeting(){
  const h = new Date().getHours();
  if(h >= 5 && h < 12) return {text:'صبح بخیر', period:'morning'};
  if(h >= 12 && h < 17) return {text:'ظهر بخیر', period:'noon'};
  if(h >= 17 && h < 20) return {text:'عصر بخیر', period:'evening'};
  return {text:'شب بخیر', period:'night'};
}

function generateHeroStars(){
  const el = document.getElementById('heroStars');
  if(!el) return;
  let h = '';
  for(let i=0;i<48;i++){
    const x = (Math.random()*100).toFixed(2);
    const y = (Math.random()*100).toFixed(2);
    const s = (0.8 + Math.random()*1.6).toFixed(2);
    const d = (Math.random()*3).toFixed(2);
    h += `<div class="hero-star" style="left:${x}%;top:${y}%;width:${s}px;height:${s}px;animation-delay:${d}s"></div>`;
  }
  el.innerHTML = h;
}

function updateAboutHeroStatic(){
  const sky = document.getElementById('heroSky');
  const sun = document.getElementById('heroSun');
  const moon = document.getElementById('heroMoon');
  const greetEl = document.getElementById('heroGreeting');
  const dateEl = document.getElementById('heroDate');
  if(!sky || !greetEl) return;
  
  const g = getGreeting();
  sky.className = 'hero-sky period-' + g.period;
  greetEl.textContent = g.text;
  
  if(sun && moon) {
    if (g.period === 'night') { sun.style.opacity = 0; moon.style.opacity = 1; }
    else {
      sun.style.opacity = 1; moon.style.opacity = 0;
      if (g.period === 'morning') { sun.style.left = '12%'; sun.style.top = '60%'; }
      if (g.period === 'noon') { sun.style.left = '50%'; sun.style.top = '15%'; }
      if (g.period === 'evening') { sun.style.left = '82%'; sun.style.top = '58%'; }
    }
  }

  if(dateEl){
    const now = new Date();
    const wd = new Intl.DateTimeFormat('fa-IR',{weekday:'long'}).format(now);
    const dt = new Intl.DateTimeFormat('fa-IR',{day:'2-digit',month:'long',year:'numeric'}).format(now);
    dateEl.textContent = wd + ' · ' + dt;
  }
}

/* ===== ABOUT RENDER ===== */
function getLastUpdateTs(){
  const cl = (db.meta && db.meta.changelog) || [];
  if(!cl.length) return db.meta.createdAt || APP_BUILD_ISO;
  let latest = null;
  cl.forEach(c => { const d = safeDate(c.ts); if(d && (!latest || d > latest)) latest = d; });
  return latest ? latest.toISOString() : (db.meta.createdAt || APP_BUILD_ISO);
}

function renderAbout(){
  try{
    const m = db.meta || {};
    const lastUpd = getLastUpdateTs();
    const rows = [
      ['نسخه برنامه', `<span class="ver-badge">v${faNum(APP_VERSION)}</span>`],
      ['تاریخ ساخت نسخه', escapeHtml(APP_BUILD_DATE_FA)],
      ['تاریخ آخرین بروزرسانی', `${escapeHtml(jDateShort(lastUpd))} <span class="days-badge">${escapeHtml(daysAgo(lastUpd))}</span>`],
      ['تاریخ نصب', escapeHtml(jDateShort(m.createdAt))],
      ['طراح', escapeHtml(m.designer || 'حسن حاجی قاسمی')],
      ['سازنده', escapeHtml(m.algorithm || 'گروه هنری اقاقیا')]
    ];
    const at = document.getElementById('aboutTable');
    if(at) at.innerHTML = rows.map(([k,v])=>`<tr><th>${escapeHtml(k)}</th><td>${v}</td></tr>`).join('');
  }catch(e){ console.warn(e); }

  try{ renderTechCarousel(); }catch(e){}
  try{ renderVersionAccordion(); }catch(e){}
  try{ renderBackups(); }catch(e){}
  try{ renderLogs(); }catch(e){}
}

function renderTechCarousel(){
  const techs = [
    {n:'HTML5 / CSS3', d:'ساختار و استایل', i:'ph-file-html'},
    {n:'JavaScript ES2022', d:'منطق برنامه', i:'ph-brackets-curly'},
    {n:'IndexedDB', d:'کش کتابخانه‌ها', i:'ph-database'},
    {n:'Vazirmatn', d:'فونت فارسی', i:'ph-text-aa'},
    {n:'Phosphor Icons', d:'آیکون‌های برداری', i:'ph-icons'},
    {n:'LZ-String', d:'فشرده‌سازی داده', i:'ph-archive-box'},
    {n:'AG Grid 31', d:'جدول داده پیشرفته', i:'ph-table'},
    {n:'Persian Datepicker', d:'تاریخ شمسی', i:'ph-calendar-blank'},
    {n:'Chart.js', d:'نمودارها', i:'ph-chart-line'}
  ];
  const track = document.getElementById('techTrack');
  if(!track) return;
  const html = techs.map(t => `<div class="tech-item"><div class="ti-icon"><i class="ph ${t.i}"></i></div><div class="ti-body"><div class="ti-name">${t.n}</div><div class="ti-desc">${t.d}</div></div></div>`).join('');
  // duplicate for seamless loop
  track.innerHTML = html + html;
}

function renderVersionAccordion(){
  const el = document.getElementById('versionAccordion');
  if(!el) return;
  const cl = (db.meta && db.meta.changelog) || [];
  if(!cl.length){ el.innerHTML = '<div class="muted">تغییری ثبت نشده</div>'; return; }
  
  // Sort: newest first
  const sorted = [...cl].sort((a,b) => (safeDate(b.ts)||0) - (safeDate(a.ts)||0));
  
  el.innerHTML = sorted.map((c, idx) => {
    const isOpen = idx === 0 ? ' open' : '';
    let body = '';
    if(c.newItems && c.newItems.length){
      body += `<div class="vbi-group"><div class="vbi-group-title vbi-new"><i class="ph ph-sparkle"></i>جدید</div><ul class="vbi-list">${c.newItems.map(x=>`<li>${escapeHtml(x)}</li>`).join('')}</ul></div>`;
    }
    if(c.updates && c.updates.length){
      body += `<div class="vbi-group"><div class="vbi-group-title vbi-upd"><i class="ph ph-arrows-clockwise"></i>بروزرسانی</div><ul class="vbi-list">${c.updates.map(x=>`<li>${escapeHtml(x)}</li>`).join('')}</ul></div>`;
    }
    if(c.fixes && c.fixes.length){
      body += `<div class="vbi-group"><div class="vbi-group-title vbi-fix"><i class="ph ph-wrench"></i>اصلاح</div><ul class="vbi-list">${c.fixes.map(x=>`<li>${escapeHtml(x)}</li>`).join('')}</ul></div>`;
    }
    if(c.notes){
      body += `<div class="vbi-group"><div class="vbi-group-title" style="color:var(--text2)"><i class="ph ph-note"></i>یادداشت</div><p style="font-size:11.5px;color:var(--text2);line-height:1.7">${escapeHtml(c.notes)}</p></div>`;
    }
    return `<div class="version-card${isOpen}" data-vidx="${idx}">
      <button class="version-header">
        <span class="vh-badge">v${faNum(c.version)}</span>
        <span class="vh-title">${escapeHtml(c.notes || ('نسخه '+c.version))}</span>
        <span class="vh-date">${escapeHtml(jDateShort(c.ts))}</span>
        <i class="ph ph-caret-down vh-chev"></i>
      </button>
      <div class="version-body"><div class="version-body-inner">${body || '<div class="muted">—</div>'}</div></div>
    </div>`;
  }).join('');
  
  el.querySelectorAll('.version-header').forEach(btn => {
    btn.onclick = () => {
      const card = btn.closest('.version-card');
      const wasOpen = card.classList.contains('open');
      // close all
      el.querySelectorAll('.version-card').forEach(c => c.classList.remove('open'));
      // open this one if wasn't open
      if(!wasOpen) card.classList.add('open');
    };
  });
}

function renderReports(){
  try{
    const totalItems = Object.keys(db.items).length;
    const totalVersions = Object.values(db.items).reduce((s,it)=>s+((it.versions||[]).length),0);
    const rows = [
      ['تعداد آیتم‌ها', faNum(totalItems)],
      ['کل نسخه‌ها', faNum(totalVersions)],
      ['تعداد لاگ‌ها', faNum(db.logs.length)],
      ['تعداد بک‌آپ‌ها', faNum(db.backups.length)]
    ];
    const tbl = document.getElementById('fullStatsTable');
    if(tbl) tbl.innerHTML = rows.map(([k,v])=>`<tr><th>${escapeHtml(k)}</th><td style="direction:rtl;text-align:right">${v}</td></tr>`).join('');
  }catch(e){}

  try{
    const pt = document.getElementById('projectsTable');
    if(pt){
      const itemsList = Object.values(db.items).map(it => ({name:it.name, cat:it.category, count:(it.versions||[]).length}));
      if(!itemsList.length){ pt.innerHTML = '<tr><td style="text-align:center;color:var(--text3);padding:20px">آیتمی نیست</td></tr>'; }
      else {
        pt.innerHTML = `<thead><tr><th>نام</th><th>نوع</th><th>نسخه</th></tr></thead><tbody>${itemsList.map(it => `<tr><td>${escapeHtml(it.name)}</td><td>${escapeHtml(it.cat||'—')}</td><td><span class="badge-cnt">${faNum(it.count)}</span></td></tr>`).join('')}</tbody>`;
      }
    }
  }catch(e){}

  try{ renderCategoryChart(); }catch(e){}
}

function renderCategoryChart(){
  const byCat = {};
  Object.values(db.items).forEach(it => { const c = it.category || 'بی‌دسته'; byCat[c] = (byCat[c]||0) + 1; });
  const total = Object.values(byCat).reduce((s,n)=>s+n,0);
  const catColors = ['#22d3ee','#a855f7','#f472b6','#34d399','#fbbf24','#f87171','#818cf8','#fb923c'];
  const entries = Object.entries(byCat);
  const cc = document.getElementById('categoryChart');
  if(cc){
    if(!total){ cc.innerHTML = '<div class="empty"><i class="ph ph-chart-pie"></i>آیتمی نیست</div>'; }
    else {
      let offset = 0;
      const r=70, cx=90, cy=90, stroke=28, circ=2*Math.PI*r;
      const segments = entries.map(([c,n],i) => {
        const len = (n/total)*circ;
        const seg = `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="${catColors[i%catColors.length]}" stroke-width="${stroke}" stroke-dasharray="${len} ${circ-len}" stroke-dashoffset="${-offset}" transform="rotate(-90 ${cx} ${cy})"/>`;
        offset += len;
        return seg;
      }).join('');
      cc.innerHTML = `<div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap"><svg width="180" height="180" viewBox="0 0 180 180"><circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="${stroke}"/>${segments}<text x="${cx}" y="${cy-6}" text-anchor="middle" fill="currentColor" font-size="20" font-weight="800">${faNum(total)}</text><text x="${cx}" y="${cy+14}" text-anchor="middle" fill="var(--text2)" font-size="10">آیتم</text></svg><div style="flex:1;min-width:120px">${entries.map(([c,n],i)=>`<div style="display:flex;align-items:center;gap:6px;padding:3px 0;font-size:12px"><span style="width:10px;height:10px;border-radius:3px;background:${catColors[i%catColors.length]}"></span><span style="flex:1">${escapeHtml(c)}</span><b style="color:var(--text2)">${faNum(n)}</b></div>`).join('')}</div></div>`;
    }
  }
}

function renderBackups(){
  const body = document.getElementById('backupBody');
  if(!body) return;
  if(!db.backups || !db.backups.length){ body.innerHTML = '<tr><td colspan="4" style="text-align:center;color:var(--text3);height:44px">بک‌آپی نیست</td></tr>'; return; }
  body.innerHTML = [...db.backups].reverse().map(b => {
    const totalVers = b.data && b.data.items ? Object.values(b.data.items).reduce((s,it)=>s+((it.versions||[]).length),0) : 0;
    const totalItms = b.data && b.data.items ? Object.keys(b.data.items).length : 0;
    return `<tr><td title="${jDateFull(b.ts)}">${jDateShort(b.ts)}</td><td><span class="badge-cnt">${faNum(totalItms)}</span></td><td><span class="badge-cnt">${faNum(totalVers)}</span></td><td class="actions"><button class="res" onclick="restoreBackup('${b.id}')"><i class="ph ph-arrows-counter-clockwise"></i></button><button class="dl" onclick="downloadBackup('${b.id}')"><i class="ph ph-download-simple"></i></button><button class="del" onclick="deleteBackup('${b.id}')"><i class="ph ph-trash"></i></button></td></tr>`;
  }).join('');
}

function renderLogs(){
  try{
    const body = document.getElementById('logBody');
    if(!body) return;
    const q = (document.getElementById('logSearch')?.value || '').toLowerCase();
    const filter = document.getElementById('logFilter')?.value || 'all';
    const logs = [...db.logs].reverse().filter(l => {
      if(!l) return false;
      if(filter !== 'all' && l.type !== filter) return false;
      if(q && !((l.action||'')+(l.detail||'')).toLowerCase().includes(q)) return false;
      return true;
    }).slice(0, 100);
    const typeLabels = {save:'ذخیره',create:'ایجاد',delete:'حذف',backup:'بک‌آپ',restore:'بازگردانی',other:'سایر'};
    if(!logs.length){ body.innerHTML = '<tr><td colspan="4" style="text-align:center;color:var(--text3);height:38px">لاگی نیست</td></tr>'; return; }
    body.innerHTML = logs.map(l => `<tr><td title="${jDateFull(l.ts)}">${jDateFull(l.ts)}</td><td><span class="log-tag type-${l.type||'other'}">${typeLabels[l.type||'other']}</span></td><td>${escapeHtml(l.action||'—')}</td><td title="${escapeHtml(l.detail||'')}">${escapeHtml(l.detail||'')}</td></tr>`).join('');
  }catch(e){}
}

/* ===== LIB DOWNLOAD ===== */
window.openLibDownload = async () => {
  const deps = (window._currentMeta && window._currentMeta.dependencies) || [];
  if(!deps.length) { toast('کتابخانه‌ای در این آیتم وجود ندارد', 'warn'); return; }
  const modal = document.getElementById('syncModal');
  const title = document.getElementById('syncTitle');
  const body = document.getElementById('syncBody');
  if(!modal || !title || !body) return;
  title.textContent = 'دانلود کتابخانه‌ها';
  body.innerHTML = '<div class="empty"><i class="ph ph-spinner"></i>در حال بررسی...</div>';
  modal.classList.add('show');
  
  let html = '<div style="font-size:12px;line-height:2">';
  for (const dep of deps) {
    const status = await getLibStatus(dep);
    const isCached = status.source === 'cache' || status.source === 'folder';
    const icon = status.status === 'green' ? 'ph-check-circle' : 'ph-download-simple';
    const color = status.status === 'green' ? 'var(--ok)' : 'var(--accent)';
    const label = isCached ? 'در حافظه ذخیره شده' : 'آماده دانلود';
    html += `<div style="display:flex;align-items:center;gap:8px;padding:8px 0;border-bottom:1px solid var(--border)"><i class="ph ${icon}" style="color:${color};font-size:18px"></i><b style="flex:1">${escapeHtml(dep)}</b><span style="font-size:10.5px;color:var(--text2)">${label}</span></div>`;
  }
  html += `<div class="flex-row mt-12"><button class="icon-action primary" onclick="downloadAllDeps('${encodeURIComponent(JSON.stringify(deps))}')"><i class="ph ph-download-simple"></i><span class="lbl">دانلود همه</span></button><button class="icon-action" onclick="document.getElementById('syncModal').classList.remove('show')">بستن</button></div></div>`;
  body.innerHTML = html;
};

window.downloadAllDeps = async (depsJson) => {
  const deps = JSON.parse(decodeURIComponent(depsJson));
  let count = 0;
  for (const dep of deps) {
    const cached = await checkLibCache(dep);
    if (cached) { count++; continue; }
    const urls = getLibCDNUrls(dep);
    if (!urls.length) continue;
    try {
      const res = await fetch(urls[0]);
      if (!res.ok) continue;
      const content = await res.text();
      const type = urls[0].endsWith('.css') ? 'css' : 'js';
      await saveLibCache(dep, content, type);
      count++;
    } catch(e) { console.warn('Download failed:', dep, e); }
  }
  toast(`✓ ${count} کتابخانه دانلود و ذخیره شد`, 'ok');
  document.getElementById('syncModal').classList.remove('show');
};

/* ===== CONFIRM ===== */
let confirmResolve = null;
function confirmDialog(title, msg){
  return new Promise(resolve => {
    confirmResolve = resolve;
    document.getElementById('confirmTitle').textContent = title;
    document.getElementById('confirmMsg').textContent = msg;
    document.getElementById('confirmModal').classList.add('show');
  });
}
function closeConfirm(val){
  document.getElementById('confirmModal').classList.remove('show');
  if(confirmResolve){ confirmResolve(val); confirmResolve = null; }
}

/* ===== ICON PICKER ===== */
const LIBRARY_ICONS = ['house','star','heart','book','code','image','music-note','film-slate','table','chart-bar','palette','sparkle','lightning','fire','rocket','crown','gem','shield-check','cloud','sun','moon','tree','flower','horse','boat','anchor','user','users','envelope','bell','calendar','clock','map-pin','globe','phone','camera','headphones','game-controller','pencil-simple','folder','file-text','database','cube','circle','square','triangle','arrow-right','arrow-left','check-circle','x-circle','plus-circle','minus-circle','info','gear','wrench','hammer','paint-brush','scissors','magnet','cpu','hard-drive','wifi-high'];
function renderIconGrid(search){
  const cur = (db.items[iconItemDD.getValue()]||{}).icon || '';
  const filtered = LIBRARY_ICONS.filter(n => n.includes((search||'').toLowerCase()));
  const grid = document.getElementById('iconGrid');
  if(!grid) return;
  grid.innerHTML = filtered.length ? filtered.map(n => `<button class="icon-cell${cur===n?' active':''}" data-icon="${n}"><i class="ph ph-${n}"></i></button>`).join('') : '<div style="padding:20px;text-align:center;color:var(--text3);font-size:12px">آیکونی یافت نشد</div>';
  grid.querySelectorAll('.icon-cell').forEach(b => {
    b.onclick = () => {
      const item = db.items[iconItemDD.getValue()];
      if(item){ item.icon = b.dataset.icon; saveDB(); log('تعیین آیکون', `${item.name} → ${b.dataset.icon}`,'other'); toast('✓ ثبت شد','ok'); renderCarousel(); }
      document.getElementById('iconPickerModal').classList.remove('show');
    };
  });
}

/* ===== SAVE ===== */
function doSave(){
  const codeInput = document.getElementById('codeInput');
  const code = codeInput?.value.trim();
  if(!code){ toast('کد را وارد کنید','err'); return; }
  const name = itemDD.getValue();
  if(!name){ toast('آیتم را انتخاب کنید','err'); return; }
  const p = parseItemCode(code);
  let cat = catDD.getValue();
  if(!cat && p.ok){ cat = detectCategory(p.data); if(!db.categories.includes(cat)) db.categories.push(cat); refreshCatDD(); catDD.setValue(cat); }
  if(!cat) cat = 'کامپوننت';
  const subj = p.ok ? detectSubject(p.data) : 'عمومی';
  if(!db.subjects.includes(subj)) db.subjects.push(subj);
  if(!db.categories.includes(cat)) db.categories.push(cat);
  if(!db.items[name]) db.items[name] = {name, category:cat, subject:subj, createdAt:new Date().toISOString(), versions:[]};
  db.items[name].category = cat;
  db.items[name].subject = subj;
  const version = (db.items[name].versions||[]).length + 1;
  const metaData = p.ok ? p.data : {title:name};
  if(p.raw && !metaData.html) metaData.html = code;
  // ensure category is set on metaData for auto-registration
  if(!metaData.category) metaData.category = cat;
  db.items[name].versions.push({version, ts:new Date().toISOString(), code, meta: metaData, raw: p.raw});
  log('ذخیره آیتم', `${name} — نسخه ${version}`,'save');
  saveDB();
  refreshItemDD(); refreshCatDD();
  if(codeInput) codeInput.value = '';
  const ep = document.getElementById('entryPreview'); if(ep) ep.innerHTML = '';
  toast(`✓ ذخیره شد: ${name} (نسخه ${version})`,'ok');
}

/* ===== ONLINE SAVE/LOAD ===== */
async function onlineSaveNow(){
  const data = {meta: db.meta, items: db.items, categories: db.categories, subjects: db.subjects, _fmt: 'noah-ark-lz-v1'};
  const json = JSON.stringify(data);
  const compressed = LZString.compressToBase64(json);
  try{
    const res = await fetch('https://paste.rs', {method:'POST', body: compressed, headers:{'Content-Type':'text/plain'}});
    if(res.ok){
      const url = (await res.text()).trim();
      const id = url.split('/').pop();
      return {service:'paste.rs', id, compressedSize: compressed.length, originalSize: json.length};
    }
  }catch(e){}
  try{
    const res = await fetch('https://jsonblob.com/api/jsonBlob', {
      method:'POST', headers:{'Content-Type':'application/json','Accept':'application/json'},
      body: JSON.stringify({_fmt:'noah-ark-lz-v1', compressed})
    });
    if(res.ok){
      const loc = res.headers.get('Location') || '';
      const id = loc.split('/').pop();
      return {service:'jsonblob', id, compressedSize: compressed.length, originalSize: json.length};
    }
  }catch(e){}
  throw new Error('سرویس‌های ذخیره‌سازی در دسترس نیستند.');
}
async function onlineLoadById(service, id){
  if(service === 'paste.rs'){
    const res = await fetch(`https://paste.rs/${id}`); if(!res.ok) throw new Error('paste.rs '+res.status);
    return JSON.parse(LZString.decompressFromBase64(await res.text()));
  }
  if(service === 'jsonblob'){
    const res = await fetch(`https://jsonblob.com/api/jsonBlob/${id}`); if(!res.ok) throw new Error('jsonblob '+res.status);
    const j = await res.json();
    return j && j.compressed ? JSON.parse(LZString.decompressFromBase64(j.compressed)) : j;
  }
  throw new Error('سرویس ناشناخته');
}

/* ===== BULK ===== */
function openBulkModal(){
  document.getElementById('bulkInput').value = '';
  document.getElementById('bulkResult').innerHTML = '';
  document.getElementById('bulkModal').classList.add('show');
}
async function processBulk(){
  const text = document.getElementById('bulkInput').value.trim();
  if(!text){ toast('چیزی برای پردازش نیست','err'); return; }
  const items = parseBulk(text);
  if(!items.length){ toast('هیچ آیتم معتبری پیدا نشد','err'); return; }
  let created = 0, updated = 0, failed = 0;
  for(const data of items){
    try{
      if(!data || typeof data !== 'object'){ failed++; continue; }
      const name = data.title || data.name || ('آیتم-'+Date.now()+'-'+Math.random().toString(36).slice(2,6));
      const subj = data.subject || detectSubject(data);
      const cat = data.category || detectCategory(data);
      if(!db.subjects.includes(subj)) db.subjects.push(subj);
      if(!db.categories.includes(cat)) db.categories.push(cat);
      const isNew = !db.items[name];
      if(isNew){ db.items[name] = {name, category:cat, subject:subj, createdAt:new Date().toISOString(), versions:[]}; created++; }
      else { updated++; }
      db.items[name].category = cat;
      db.items[name].subject = subj;
      const version = (db.items[name].versions||[]).length + 1;
      const code = '===NOAH-ARK-ITEM-v1===\n'+JSON.stringify(data,null,2)+'\n===END-NOAH-ARK-ITEM===';
      db.items[name].versions.push({version, ts:new Date().toISOString(), code, meta: data, raw: false});
    }catch(e){ failed++; }
  }
  saveDB();
  log('ورود گروهی', `${created} جدید، ${updated} به‌روزرسانی، ${failed} خطا`, 'create');
  refreshItemDD(); refreshCatDD();
  document.getElementById('bulkResult').innerHTML = `<div style="padding:10px;background:rgba(52,211,153,0.1);border-radius:8px;font-size:12px"><b style="color:var(--ok)">✓ انجام شد</b> — جدید: ${faNum(created)} · به‌روزرسانی: ${faNum(updated)} · خطا: ${faNum(failed)}</div>`;
  toast(`✓ ${created+updated} آیتم پردازش شد`,'ok');
}

/* ===== GUIDE (PROMPT-ONLY) ===== */
const GUIDE_TEXT = `=== NOAH-ARK ITEM WRITING PROMPT ===

You are generating code items for the NOAH-ARK storage system.
The system parses, executes, and stores items via a strict JSON format.
Read and follow these rules exactly.

────────── FORMAT (MANDATORY) ──────────
Each item must be wrapped in:

===NOAH-ARK-ITEM-v1===
{ VALID JSON OBJECT }
===END-NOAH-ARK-ITEM===

────────── JSON SCHEMA ──────────
{
  "title": "string — unique item name",
  "category": "string — نوع آیتم (auto-registered)",
  "subject": "string — optional",
  "description": "string — one line",
  "style": "string — palette/fonts",
  "usage": "string — how to use",
  "params": { "name": {"type": "string", "default": "value"} },
  "dependencies": ["lib name", "..."],
  "html": "<div>...</div>",
  "css": ".class{...}",
  "js": "(() => { ... })();"
}

────────── RULES ──────────
1. Body MUST be valid JSON. Double quotes only. No trailing commas.
2. Fields title, category, description, style, usage, html, css, js are REQUIRED.
3. Empty fields must be "" (empty string), never null.
4. Inside "js", escape <\/script> as <\\/script>.
5. "category" determines the type. Common values:
   کامپوننت / فرم / نمودار / بنر / کارت / دکمه / گالری / ناوبری / جدول
   → system will auto-register a new type if unknown.
6. All dependencies MUST be listed in "dependencies" with a recognizable name.
7. Do NOT reference global app variables (window.db, window.app, etc.).
8. All code runs in a sandboxed iframe with dir="rtl" and Vazirmatn font.

────────── DEPENDENCY NAME MAP ──────────
Recognized names (case-insensitive):
  "AG Grid 31" / "ag-grid-community" → ag-grid-community@31
  "Persian Datepicker" → persian-datepicker@1.2
  "Persian Date" → persian-date@1.2
  "Chart.js" → chart.js@4
  "GSAP" → gsap@3
  "Bootstrap" → bootstrap@5
  "jQuery" → jquery@3.7
  "Swiper" → swiper@11
  "Vazirmatn" → Vazirmatn font
  "Phosphor Icons" → phosphor-icons
  For other libs, use the npm package name (e.g. "alpinejs", "three").

────────── EXAMPLE: AG GRID TABLE ──────────
===NOAH-ARK-ITEM-v1===
{
  "title": "جدول سفارشات",
  "category": "جدول",
  "description": "جدول AG Grid با فیلتر و سرچ",
  "style": "تیره، طلایی",
  "usage": "درج در صفحه",
  "params": {},
  "dependencies": ["AG Grid 31", "Vazirmatn", "Phosphor Icons"],
  "html": "<div id='myGrid' class='ag-theme-quartz-dark' style='height:500px'></div>",
  "css": "#myGrid{--ag-background-color:#0b0f19;--ag-header-background-color:#151a26;--ag-foreground-color:#e2e8f0;--ag-border-color:#2a3a4a}",
  "js": "const api = agGrid.createGrid(document.getElementById('myGrid'), { columnDefs:[{field:'name',headerName:'نام'},{field:'amount',headerName:'مبلغ'}], rowData:[{name:'علی',amount:1000},{name:'مریم',amount:2000}], pagination:true, paginationPageSize:10 });"
}
===END-NOAH-ARK-ITEM===

────────── EXAMPLE: PERSIAN DATEPICKER ──────────
===NOAH-ARK-ITEM-v1===
{
  "title": "انتخاب تاریخ شمسی",
  "category": "فرم",
  "description": "ورودی تاریخ شمسی",
  "style": "روشن",
  "usage": "در فرم‌ها",
  "params": {},
  "dependencies": ["Persian Datepicker", "Persian Date"],
  "html": "<input type='text' id='dp' placeholder='تاریخ'><p id='res'></p>",
  "css": "input{padding:8px;border-radius:8px;border:1px solid #ccc}",
  "js": "new persianDatepicker('#dp', {format:'YYYY/MM/DD', onSelect:(u)=>{document.getElementById('res').textContent=u.format('YYYY/MM/DD');}});"
}
===END-NOAH-ARK-ITEM===

────────── CHECKLIST BEFORE SUBMIT ──────────
✓ Wrapped in ===NOAH-ARK-ITEM-v1=== ... ===END-NOAH-ARK-ITEM===
✓ Body is valid JSON (parse it mentally)
✓ All required fields present
✓ category is set (for auto-registration)
✓ dependencies array lists every external library
✓ html/css/js contain no <\\/script> that isn't escaped
✓ Code runs without referencing app globals

=== END PROMPT ===`;

/* ===== HELP MODAL BUILDER ===== */
function buildHelpSections(){
  const example1 = `===NOAH-ARK-ITEM-v1===
{
  "title": "جدول سفارشات - AG Grid",
  "category": "جدول داده",
  "description": "جدول سفارشات با AG Grid، تک‌خطی، فیلتر، سرچ",
  "style": "تیره، هدر مجزا",
  "usage": "در صفحه سفارشات درج کنید.",
  "params": {},
  "dependencies": ["AG Grid 31", "Vazirmatn", "Phosphor Icons", "Persian Datepicker"],
  "html": "<div id='myGrid' class='ag-theme-quartz-dark'></div>",
  "css": "#myGrid{height:500px;--ag-background-color:#0b0f19;--ag-header-background-color:#151a26;--ag-foreground-color:#e2e8f0;--ag-border-color:#2a3a4a;--ag-row-hover-color:rgba(212,175,55,0.08)}",
  "js": "const api = agGrid.createGrid(document.getElementById('myGrid'), {\n  columnDefs: [\n    {field:'name', headerName:'نام مشتری'},\n    {field:'orderNo', headerName:'شماره سفارش'},\n    {field:'amount', headerName:'مبلغ', valueFormatter: p => p.value.toLocaleString('fa-IR')}\n  ],\n  rowData: [\n    {name:'علی رضایی', orderNo:'ORD-1001', amount:1500000},\n    {name:'مریم احمدی', orderNo:'ORD-1002', amount:2300000}\n  ],\n  pagination: true,\n  paginationPageSize: 10\n});"
}
===END-NOAH-ARK-ITEM===`;

  const example2 = `===NOAH-ARK-ITEM-v1===
{
  "title": "انتخاب تاریخ شمسی",
  "category": "فرم",
  "description": "ورودی تاریخ شمسی با datepicker",
  "style": "روشن، تمیز",
  "usage": "در فرم‌ها استفاده کنید.",
  "params": {},
  "dependencies": ["Persian Datepicker", "Persian Date", "Vazirmatn"],
  "html": "<div style='padding:16px'><input type='text' id='dp' placeholder='انتخاب تاریخ' style='padding:10px;border-radius:8px;border:1px solid #ccc'><p id='result' style='margin-top:12px;color:#333'></p></div>",
  "css": "body{font-family:'Vazirmatn',sans-serif;background:#f5f7fb}",
  "js": "new persianDatepicker('#dp', { format:'YYYY/MM/DD', onSelect: (unix) => { document.getElementById('result').textContent = 'انتخاب شد: ' + unix.format('YYYY/MM/DD'); } });"
}
===END-NOAH-ARK-ITEM===`;

  const example3 = `===NOAH-ARK-ITEM-v1===
{
  "title": "کارت محصول",
  "category": "کارت",
  "description": "کارت محصول با hover",
  "style": "گرادیانت فیروزه‌ای",
  "usage": "در گالری محصولات",
  "params": {"title":"نام محصول","price":"قیمت"},
  "dependencies": ["Vazirmatn"],
  "html": "<div class='card'><div class='card-title'>انگشتر فیروزه</div><div class='card-price'>۱٬۲۵۰٬۰۰۰ تومان</div></div>",
  "css": ".card{background:linear-gradient(135deg,#22d3ee,#a855f7);color:#fff;padding:20px;border-radius:16px;font-family:'Vazirmatn',sans-serif;transition:transform .3s}.card:hover{transform:scale(1.03)}.card-title{font-weight:800;font-size:16px}.card-price{margin-top:8px;font-size:13px;opacity:.9}",
  "js": ""
}
===END-NOAH-ARK-ITEM===`;

  return `
    <div class="help-section">
      <h4><i class="ph ph-info"></i>۱. قالب اجباری</h4>
      <p>هر آیتم باید دقیقاً بین دو مارکر زیر قرار گیرد. بدنه یک JSON معتبر است.</p>
      <div class="help-code">
        <button class="help-code-copy" data-code="===NOAH-ARK-ITEM-v1===\n{\n  ...\n}\n===END-NOAH-ARK-ITEM==="><i class="ph ph-copy"></i>کپی</button>
        <pre>===NOAH-ARK-ITEM-v1===
{
  ... JSON VALID ...
}
===END-NOAH-ARK-ITEM===</pre>
      </div>
    </div>
    <div class="help-section">
      <h4><i class="ph ph-list-checks"></i>۲. فیلدهای JSON</h4>
      <p>همه این فیلدها اجباری هستند. فیلد خالی باید <code>""</code> باشد نه <code>null</code>.</p>
      <div class="help-code">
        <button class="help-code-copy" data-code='{"title":"نام","category":"نوع","subject":"موضوع","description":"توضیح","style":"استایل","usage":"کاربرد","params":{},"dependencies":[],"html":"","css":"","js":""}'><i class="ph ph-copy"></i>کپی</button>
        <pre>{
  "title": "string — نام یکتا",
  "category": "string — نوع (خودکار ثبت می‌شود)",
  "subject": "string — موضوع (اختیاری)",
  "description": "string — یک خط",
  "style": "string — پالت/فونت",
  "usage": "string — نحوه استفاده",
  "params": { "name": {"type":"string","default":"x"} },
  "dependencies": ["lib1", "lib2"],
  "html": "&lt;div&gt;...&lt;/div&gt;",
  "css": ".class{...}",
  "js": "(() =&gt; { ... })();"
}</pre>
      </div>
    </div>
    <div class="help-section">
      <h4><i class="ph ph-warning-circle"></i>۳. قوانین طلایی</h4>
      <p>۱) بدنه باید JSON معتبر باشد (گیومه دوتایی، بدون کاما انتهایی).<br>
      ۲) فیلد <code>category</code> حتماً پر شود — خودکار در سیستم ثبت می‌شود.<br>
      ۳) تمام کتابخانه‌ها باید در <code>dependencies</code> باشند.<br>
      ۴) در <code>js</code> تگ <code>&lt;/script&gt;</code> را به صورت <code>&lt;\\/script&gt;</code> بنویسید.<br>
      ۵) کد در iframe سندباکس با <code>dir="rtl"</code> اجرا می‌شود — به گلوبال‌های برنامه دست نزنید.</p>
    </div>
    <div class="help-section">
      <h4><i class="ph ph-package"></i>۴. نام‌های شناخته‌شده کتابخانه</h4>
      <p>این نام‌ها به صورت خودکار از CDN یا کش بارگذاری می‌شوند:</p>
      <div class="help-code">
        <button class="help-code-copy" data-code="AG Grid 31 / ag-grid-community\nPersian Datepicker\nPersian Date\nChart.js\nGSAP\nBootstrap\njQuery\nSwiper\nVazirmatn\nPhosphor Icons\nAlpine.js\nThree.js"><i class="ph ph-copy"></i>کپی</button>
        <pre>AG Grid 31 / ag-grid-community  → ag-grid-community@31
Persian Datepicker               → persian-datepicker@1.2
Persian Date                     → persian-date@1.2
Chart.js                         → chart.js@4
GSAP                             → gsap@3
Bootstrap                        → bootstrap@5
jQuery                           → jquery@3.7
Swiper                           → swiper@11
Vazirmatn                        → فونت فارسی
Phosphor Icons                   → آیکون‌ها
Alpine.js / Three.js             → از npm</pre>
      </div>
    </div>
    <div class="help-section">
      <h4><i class="ph ph-table"></i>۵. نمونه: AG Grid 31 + Persian Datepicker</h4>
      <p>این نمونه کامل اجرا می‌شود — کتابخانه‌ها به‌صورت خودکار بارگذاری خواهند شد.</p>
      <div class="help-code">
        <button class="help-code-copy" data-code="${escapeHtml(example1)}"><i class="ph ph-copy"></i>کپی</button>
        <pre>${escapeHtml(example1)}</pre>
      </div>
    </div>
    <div class="help-section">
      <h4><i class="ph ph-calendar-blank"></i>۶. نمونه: Persian Datepicker</h4>
      <div class="help-code">
        <button class="help-code-copy" data-code="${escapeHtml(example2)}"><i class="ph ph-copy"></i>کپی</button>
        <pre>${escapeHtml(example2)}</pre>
      </div>
    </div>
    <div class="help-section">
      <h4><i class="ph ph-cube"></i>۷. نمونه: کارت ساده</h4>
      <div class="help-code">
        <button class="help-code-copy" data-code="${escapeHtml(example3)}"><i class="ph ph-copy"></i>کپی</button>
        <pre>${escapeHtml(example3)}</pre>
      </div>
    </div>
    <div class="help-section">
      <h4><i class="ph ph-check-circle"></i>۸. چک‌لیست نهایی</h4>
      <p>
      ☐ بین دو مارکر قرار گرفته<br>
      ☐ JSON معتبر است<br>
      ☐ فیلد category پر است (برای ثبت خودکار نوع)<br>
      ☐ همه کتابخانه‌ها در dependencies هستند<br>
      ☐ تگ &lt;/script&gt; در js escape شده<br>
      ☐ به گلوبال‌های برنامه دست نمی‌زند
      </p>
    </div>`;
}

function openHelpModal(){
  const body = document.getElementById('helpBody');
  if(!body) return;
  body.innerHTML = buildHelpSections();
  body.querySelectorAll('.help-code-copy').forEach(btn => {
    btn.onclick = () => {
      const code = btn.getAttribute('data-code');
      copyText(code);
      btn.classList.add('copied');
      btn.innerHTML = '<i class="ph ph-check"></i>کپی شد';
      setTimeout(()=>{ btn.classList.remove('copied'); btn.innerHTML = '<i class="ph ph-copy"></i>کپی'; }, 1500);
    };
  });
  document.getElementById('helpModal').classList.add('show');
}

/* ===== WIRE EVENTS ===== */
function wireEvents(){
  const safeOn = (id, ev, fn) => { const el = document.getElementById(id); if(el) el[ev] = fn; };
  
  $$('.tab').forEach(t => t.onclick = () => switchTab(t.dataset.tab));
  $$('.mobile-nav button').forEach(b => b.onclick = () => switchTab(b.dataset.tab));
  
  $$('.subtab').forEach(t => t.onclick = () => {
    $$('.subtab').forEach(x => x.classList.remove('active'));
    t.classList.add('active');
    $$('.subpage').forEach(p => p.classList.remove('active'));
    const s = document.getElementById('sub-'+t.dataset.sub);
    if(s) s.classList.add('active');
    try{
      if(t.dataset.sub === 'info') { renderAbout(); updateAboutHeroStatic(); }
      if(t.dataset.sub === 'reports') renderReports();
      if(t.dataset.sub === 'backups') renderBackups();
      if(t.dataset.sub === 'logs') renderLogs();
    }catch(e){ console.warn(e); }
  });

  safeOn('themeBtn', 'onclick', () => applyTheme(document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark'));
  
  safeOn('syncBtn', 'onclick', async () => {
    const modal = document.getElementById('syncModal');
    const title = document.getElementById('syncTitle');
    const body = document.getElementById('syncBody');
    if(!modal || !title || !body) return;
    title.textContent = 'ذخیره آنلاین';
    body.innerHTML = '<div class="empty"><i class="ph ph-spinner"></i>در حال فشرده‌سازی و ارسال...</div>';
    modal.classList.add('show');
    try{
      const r = await onlineSaveNow();
      const shareUrl = location.origin + location.pathname + `#sync=${r.service}:${r.id}`;
      try{ await navigator.clipboard.writeText(shareUrl); }catch(e){}
      log('ذخیره آنلاین', `${r.service}:${r.id}`,'other');
      title.textContent = '✓ ذخیره شد';
      body.innerHTML = `
        <p style="font-size:12px;color:var(--text2);margin-bottom:8px">سرویس: <b>${escapeHtml(r.service)}</b> · حجم: ${faNum((r.compressedSize/1024).toFixed(1))}KB (فشرده از ${faNum((r.originalSize/1024).toFixed(1))}KB)</p>
        <p style="font-size:12px;color:var(--text2);margin-bottom:8px">لینک کپی شد:</p>
        <div style="padding:10px;background:var(--surface);border-radius:10px;font-family:monospace;font-size:10.5px;word-break:break-all;direction:ltr;text-align:left">${escapeHtml(shareUrl)}</div>
        <div class="flex-row mt-8"><button class="icon-action primary" onclick="copyText('${escapeHtml(shareUrl)}')"><i class="ph ph-copy"></i><span class="lbl">کپی دوباره</span></button></div>`;
      toast('✓ ذخیره و کپی شد','ok');
    }catch(e){
      body.innerHTML = `<div style="padding:12px;background:rgba(248,113,113,0.1);border-radius:8px;font-size:12px;color:var(--err)"><b>خطا:</b> ${escapeHtml(e.message)}</div>`;
    }
  });

  let previewTimer = null;
  const codeInput = document.getElementById('codeInput');
  if(codeInput) {
    codeInput.addEventListener('input', () => { clearTimeout(previewTimer); previewTimer = setTimeout(updateEntryPreview, 500); });
    codeInput.addEventListener('paste', () => setTimeout(updateEntryPreview, 300));
  }

  setInterval(()=>{ const el = document.getElementById('nowDisplay'); if(el) el.textContent = jDate(new Date().toISOString()); }, 60000);
  const nd = document.getElementById('nowDisplay'); if(nd) nd.textContent = jDate(new Date().toISOString());

  safeOn('tSave', 'onclick', doSave);
  safeOn('saveBtn', 'onclick', doSave);
  safeOn('tCopy', 'onclick', () => { const v = codeInput?.value; if(!v){ toast('خالی','err'); return; } copyText(v); });
  safeOn('tPaste', 'onclick', async () => {
    const t = await pasteFromClipboard();
    if(t === null){ toast('دسترسی کلیپ‌بورد نیست','err'); return; }
    if(codeInput) { codeInput.value = t; updateEntryPreview(); }
    toast('✓ پیست شد','ok');
  });
  safeOn('tEye', 'onclick', async () => {
    const code = codeInput?.value.trim();
    if(!code){ toast('کدی نیست','err'); return; }
    const p = parseItemCode(code);
    if(!p.ok){ toast('کد نامعتبر','err'); return; }
    const frame = document.getElementById('previewFrame');
    if(frame) {
      frame.srcdoc = await buildPreviewSrcdoc(p.data, p.raw, code);
      document.getElementById('previewModal').classList.add('show');
    }
  });
  safeOn('tClear', 'onclick', () => { if(codeInput) codeInput.value = ''; const ep = document.getElementById('entryPreview'); if(ep) ep.innerHTML = ''; toast('پاک شد',''); });
  safeOn('parseBtn', 'onclick', () => {
    const code = codeInput?.value.trim();
    if(!code){ toast('کدی نیست','err'); return; }
    const p = parseItemCode(code);
    updateEntryPreview();
    if(p.ok && !p.raw) toast('✓ معتبر است','ok');
    else if(p.ok && p.raw) toast('کد خام','');
    else toast('خطا','err');
  });

  // Add modal
  let addMode = 'item';
  const openAdd = (mode) => {
    addMode = mode;
    const labels = {item:'افزودن آیتم', cat:'افزودن نوع'};
    const title = document.getElementById('addModalTitle');
    if(title) title.textContent = labels[mode] || 'افزودن';
    const inp = document.getElementById('addModalInput');
    if(inp) inp.value = '';
    const modal = document.getElementById('addModal');
    if(modal) modal.classList.add('show');
    setTimeout(()=>{ if(inp) inp.focus(); }, 100);
  };
  safeOn('addItemBtn', 'onclick', () => openAdd('item'));
  safeOn('addCatBtn', 'onclick', () => openAdd('cat'));
  
  safeOn('addModalClose', 'onclick', () => { const m = document.getElementById('addModal'); if(m) m.classList.remove('show'); });
  safeOn('addModalCancel', 'onclick', () => { const m = document.getElementById('addModal'); if(m) m.classList.remove('show'); });
  
  const addModalEl = document.getElementById('addModal');
  if(addModalEl) addModalEl.addEventListener('click', e => { if(e.target.id==='addModal') addModalEl.classList.remove('show'); });
  
  const addInput = document.getElementById('addModalInput');
  if(addInput) addInput.addEventListener('keydown', e => { if(e.key==='Enter') { const ok = document.getElementById('addModalOk'); if(ok) ok.click(); } });
  
  safeOn('addModalOk', 'onclick', () => {
    const name = addInput?.value.trim();
    if(!name){ toast('نام را وارد کنید','err'); return; }
    if(addMode === 'item'){
      if(db.items[name]){ toast('از قبل هست','err'); return; }
      db.items[name] = {name, subject:'عمومی', category:catDD.getValue()||'کامپوننت', createdAt:new Date().toISOString(), versions:[]};
      log('ایجاد آیتم', name,'create');
      saveDB(); refreshItemDD(); itemDD.setValue(name);
      toast(`✓ ${name} اضافه شد`,'ok');
    } else {
      if(db.categories.includes(name)){ toast('از قبل هست','err'); return; }
      db.categories.push(name); log('ایجاد نوع', name,'create'); saveDB(); refreshCatDD(); catDD.setValue(name);
      toast(`✓ نوع ${name} اضافه شد`,'ok');
    }
    if(addModalEl) addModalEl.classList.remove('show');
  });

  // Bulk
  safeOn('bulkImportBtn', 'onclick', openBulkModal);
  safeOn('bulkClose', 'onclick', () => { const m = document.getElementById('bulkModal'); if(m) m.classList.remove('show'); });
  safeOn('bulkCancel', 'onclick', () => { const m = document.getElementById('bulkModal'); if(m) m.classList.remove('show'); });
  
  const bulkModalEl = document.getElementById('bulkModal');
  if(bulkModalEl) bulkModalEl.addEventListener('click', e => { if(e.target.id==='bulkModal') bulkModalEl.classList.remove('show'); });
  
  safeOn('bulkOk', 'onclick', processBulk);

  // Health Check
  safeOn('runHealthCheckBtn', 'onclick', runHealthCheck);

  // Help
  safeOn('helpBtn', 'onclick', openHelpModal);
  safeOn('helpClose', 'onclick', () => { const m = document.getElementById('helpModal'); if(m) m.classList.remove('show'); });
  safeOn('helpClose2', 'onclick', () => { const m = document.getElementById('helpModal'); if(m) m.classList.remove('show'); });
  safeOn('helpCopy', 'onclick', () => copyText(GUIDE_TEXT));
  safeOn('copyGuideBtn', 'onclick', () => copyText(GUIDE_TEXT));

  // Confirm & Preview
  safeOn('confirmOk', 'onclick', () => closeConfirm(true));
  safeOn('confirmCancel', 'onclick', () => closeConfirm(false));
  safeOn('confirmClose', 'onclick', () => closeConfirm(false));
  
  const confirmModalEl = document.getElementById('confirmModal');
  if(confirmModalEl) confirmModalEl.addEventListener('click', e => { if(e.target.id==='confirmModal') closeConfirm(false); });

  safeOn('previewClose', 'onclick', () => { const m = document.getElementById('previewModal'); if(m) m.classList.remove('show'); });
  const previewModalEl = document.getElementById('previewModal');
  if(previewModalEl) previewModalEl.addEventListener('click', e => { if(e.target.id==='previewModal') previewModalEl.classList.remove('show'); });

  safeOn('verPrev', 'onclick', () => { if(!currentItem) return; const total=(db.items[currentItem].versions||[]).length; if(currentVerIdx < total-1){ currentVerIdx++; renderView(); } });
  safeOn('verNext', 'onclick', () => { if(!currentItem) return; if(currentVerIdx > 0){ currentVerIdx--; renderView(); } });

  // Backups
  safeOn('createBackupBtn', 'onclick', () => {
    try {
      const backup = {id:Date.now().toString(), ts:new Date().toISOString(), data: JSON.parse(JSON.stringify({items:db.items, categories:db.categories, subjects:db.subjects}))};
      if(!db.backups) db.backups = [];
      db.backups.push(backup);
      if(db.backups.length > 10) db.backups = db.backups.slice(-10);
      saveDB(); 
      log('ایجاد بک‌آپ','','backup'); 
      renderBackups(); 
      toast('✓ بک‌آپ ایجاد شد','ok');
    } catch(err) { toast('خطا در ایجاد بک‌آپ: ' + err.message, 'err'); }
  });
  safeOn('logsBtn', 'onclick', () => {
    const txt = db.logs.map(l => `[${jDateFull(l.ts)}] [${l.type||'other'}] ${l.action} :: ${l.detail}`).join('\n');
    downloadFile(`noah-ark-logs-${new Date().toISOString().slice(0,10)}.txt`, txt, 'text/plain');
    toast('✓ دانلود شد','ok');
  });
  safeOn('resetBtn', 'onclick', async () => {
    const ok = await confirmDialog('ریست','تمام داده‌ها حذف می‌شوند. یک نسخه پشتیبان خودکار گرفته می‌شود. ادامه؟');
    if(!ok) return;
    try{ const cur = localStorage.getItem(STORAGE_KEY); if(cur) localStorage.setItem(STORAGE_KEY+'_safety_'+Date.now(), cur); }catch(e){}
    localStorage.removeItem(STORAGE_KEY); location.reload();
  });

  safeOn('logSearch', 'input', renderLogs);
  safeOn('logFilter', 'change', renderLogs);
  safeOn('setDark', 'onclick', () => applyTheme('dark'));
  safeOn('setLight', 'onclick', () => applyTheme('light'));

  // Icon picker
  safeOn('pickLibBtn', 'onclick', () => { if(!iconItemDD.getValue()){ toast('آیتم را انتخاب','err'); return; } renderIconGrid(''); const m = document.getElementById('iconPickerModal'); if(m) m.classList.add('show'); });
  safeOn('iconSearch', 'input', e => renderIconGrid(e.target.value));
  safeOn('iconPickerClose', 'onclick', () => { const m = document.getElementById('iconPickerModal'); if(m) m.classList.remove('show'); });
  safeOn('iconPickerCancel', 'onclick', () => { const m = document.getElementById('iconPickerModal'); if(m) m.classList.remove('show'); });
  
  const iconPickerModalEl = document.getElementById('iconPickerModal');
  if(iconPickerModalEl) iconPickerModalEl.addEventListener('click', e => { if(e.target.id==='iconPickerModal') iconPickerModalEl.classList.remove('show'); });
  
  safeOn('uploadIconBtn', 'onclick', () => { if(!iconItemDD.getValue()){ toast('آیتم را انتخاب','err'); return; } const f = document.getElementById('iconFile'); if(f) f.click(); });
  
  safeOn('iconFile', 'change', e => {
    const file = e.target.files[0]; if(!file) return;
    if(!file.type.startsWith('image/')){ toast('فایل تصویری','err'); return; }
    const reader = new FileReader();
    reader.onload = ev => { const item = db.items[iconItemDD.getValue()]; if(item){ item.icon = ev.target.result; saveDB(); log('آپلود آیکون', item.name,'other'); toast('✓ آپلود','ok'); renderCarousel(); } };
    reader.readAsDataURL(file); e.target.value = '';
  });

  // Lib folder
  safeOn('pickLibFolderBtn', 'onclick', async () => {
    if(!window.showDirectoryPicker){ toast('مرورگر پشتیبانی نمی‌کند — Chrome/Edge','err'); return; }
    try{
      const handle = await window.showDirectoryPicker({mode:'readwrite'});
      libDirHandle = handle;
      await saveDirHandle(handle);
      updateLibFolderStatus();
      toast('✓ پوشه انتخاب شد — اسکن در حال انجام...','ok');
      const r = await scanFolderAndCache();
      updateLibCacheStatus();
      toast(`✓ ${r.cached} فایل کش شد`,'ok');
      log('اتصال پوشه', handle.name, 'other');
      setTimeout(()=>checkDepStatuses(), 500);
    }catch(e){ if(e.name !== 'AbortError') toast('خطا: '+e.message,'err'); }
  });

  safeOn('saveToHostBtn', 'onclick', async () => {
    if(!libDirHandle){ toast('ابتدا پوشه را انتخاب کنید','err'); return; }
    const libs = await listCachedLibs();
    if(!libs.length){ toast('هیچ کتابخانه‌ای در کش نیست','err'); return; }
    let count = 0;
    for(const l of libs){
      try {
        const ext = l.type === 'css' ? '.css' : '.js';
        const fname = l.name.replace(/[^a-z0-9.-]/gi, '-') + ext;
        const fh = await libDirHandle.getFileHandle(fname, {create:true});
        const w = await fh.createWritable();
        await w.write(l.data);
        await w.close();
        count++;
      } catch(e) { console.warn(e); }
    }
    toast(`✓ ${count} کتابخانه در پوشه هاست ذخیره شد`,'ok');
    log('ذخیره در هاست', `${count} فایل`, 'other');
  });

  // Import/Export
  safeOn('exportAllBtn', 'onclick', () => {
    downloadFile(`noah-ark-full-${new Date().toISOString().slice(0,10)}.json`, JSON.stringify({meta:db.meta, items:db.items, categories:db.categories, subjects:db.subjects, logs:db.logs, backups:db.backups},null,2));
    toast('✓ خروجی دانلود شد','ok');
  });
  safeOn('importAllBtn', 'onclick', () => { const f = document.getElementById('importFile'); if(f) f.click(); });
  
  safeOn('importFile', 'change', async e => {
    const file = e.target.files[0]; if(!file) return;
    try{
      const text = await file.text();
      const data = JSON.parse(text);
      if(!data.items) throw new Error('ساختار نامعتبر');
      const ok = await confirmDialog('ورود','داده‌های فعلی جایگزین می‌شوند. ادامه؟');
      if(!ok) return;
      db.items = data.items || {};
      db.categories = data.categories || db.categories;
      db.subjects = data.subjects || db.subjects;
      if(data.meta) db.meta = {...db.meta, ...data.meta};
      if(data.backups) db.backups = data.backups;
      saveDB(); log('ورود داده','از فایل JSON','restore');
      refreshItemDD(); refreshCatDD(); renderAbout();
      toast('✓ وارد شد','ok');
    }catch(err){ toast('خطا: '+err.message,'err'); }
    e.target.value = '';
  });

  // Online load
  safeOn('onlineLoadBtn', 'onclick', () => {
    const title = document.getElementById('syncTitle');
    const body = document.getElementById('syncBody');
    if(!title || !body) return;
    title.textContent = 'بارگذاری آنلاین';
    body.innerHTML = `<p style="font-size:12px;color:var(--text2);margin-bottom:10px">لینک کامل یا شناسه را وارد کنید:</p>
      <input type="text" id="loadUrlInput" placeholder="https://paste.rs/... یا https://jsonblob.com/..." style="direction:ltr;text-align:left">
      <div class="flex-row mt-8"><button class="icon-action primary" onclick="doOnlineLoad()"><i class="ph ph-cloud-arrow-down"></i><span class="lbl">بارگذاری</span></button></div>`;
    const m = document.getElementById('syncModal'); if(m) m.classList.add('show');
  });
  
  window.doOnlineLoad = async () => {
    const val = document.getElementById('loadUrlInput').value.trim();
    if(!val){ toast('لینک را وارد کنید','err'); return; }
    let service = null, id = null;
    if(val.includes('paste.rs/')){ service='paste.rs'; id = val.split('paste.rs/').pop().split(/[?#]/)[0]; }
    else if(val.includes('jsonblob.com/')){ service='jsonblob'; id = val.split('jsonBlob/').pop().split(/[?#]/)[0]; if(!id || id.includes('api')) { const m = val.match(/jsonBlob\/([a-f0-9-]+)/i); if(m) id = m[1]; } }
    else if(val.includes('#sync=')){ const p = val.split('#sync=')[1].split('&')[0]; const parts = p.split(':'); service = parts[0]; id = parts[1]; }
    else { toast('لینک نامعتبر','err'); return; }
    try{
      const body = document.getElementById('syncBody');
      if(body) body.innerHTML = '<div class="empty"><i class="ph ph-spinner"></i>در حال دریافت...</div>';
      const data = await onlineLoadById(service, id);
      if(!data.items) throw new Error('ساختار نامعتبر');
      const ok = await confirmDialog('بارگذاری','داده‌های فعلی جایگزین می‌شوند. ادامه؟');
      if(!ok) return;
      db.items = data.items; db.categories = data.categories || db.categories; db.subjects = data.subjects || db.subjects;
      saveDB(); log('بارگذاری آنلاین', service+':'+id, 'restore');
      refreshItemDD(); refreshCatDD(); renderAbout();
      const m = document.getElementById('syncModal'); if(m) m.classList.remove('show');
      toast('✓ بارگذاری شد','ok');
    }catch(err){ 
      const body = document.getElementById('syncBody');
      if(body) body.innerHTML = `<div style="padding:12px;color:var(--err);font-size:12px">${escapeHtml(err.message)}</div>`; 
    }
  };

  safeOn('shareUrlBtn', 'onclick', () => {
    try{
      const compressed = LZString.compressToEncodedURIComponent(JSON.stringify({items: db.items, categories: db.categories, subjects: db.subjects}));
      const url = location.origin + location.pathname + '#data=' + compressed;
      if(url.length > 32000){ toast('داده بزرگ‌تر از URL — از خروجی استفاده کنید','err'); return; }
      const title = document.getElementById('syncTitle');
      const body = document.getElementById('syncBody');
      if(!title || !body) return;
      title.textContent = 'لینک اشتراک';
      body.innerHTML = `<p style="font-size:12px;color:var(--text2);margin-bottom:10px">این لینک را کپی و در دستگاه دیگر باز کنید:</p>
        <div style="padding:10px;background:var(--surface);border-radius:10px;font-family:monospace;font-size:10.5px;word-break:break-all;direction:ltr;text-align:left;max-height:180px;overflow:auto">${escapeHtml(url)}</div>
        <div class="flex-row mt-8"><button class="icon-action primary" onclick="copyText(decodeURIComponent('${encodeURIComponent(url)}'))"><i class="ph ph-copy"></i><span class="lbl">کپی</span></button></div>`;
      const m = document.getElementById('syncModal'); if(m) m.classList.add('show');
    }catch(e){ toast('خطا: '+e.message,'err'); }
  });

  safeOn('syncClose', 'onclick', () => { const m = document.getElementById('syncModal'); if(m) m.classList.remove('show'); });
  safeOn('syncCancel', 'onclick', () => { const m = document.getElementById('syncModal'); if(m) m.classList.remove('show'); });
  
  const syncModalEl = document.getElementById('syncModal');
  if(syncModalEl) syncModalEl.addEventListener('click', e => { if(e.target.id==='syncModal') syncModalEl.classList.remove('show'); });

  document.addEventListener('keydown', e => {
    if(e.key === 'Escape'){ 
      ['#helpModal','#addModal','#previewModal','#iconPickerModal','#syncModal','#bulkModal'].forEach(s => { 
        const el = document.querySelector(s); if(el) el.classList.remove('show'); 
      }); 
      closeConfirm(false); 
      document.querySelectorAll('.dd.open').forEach(el => { if(el._ddInstance) el._ddInstance.close(); });
    }
    if((e.ctrlKey || e.metaKey) && e.key === 's'){ e.preventDefault(); doSave(); }
  });

  window.addEventListener('resize', updateNavSlider);
}

function updateLibFolderStatus(){
  const el = document.getElementById('libFolderStatus');
  if(!el) return;
  if(libDirHandle){ el.innerHTML = `<span style="color:var(--ok)">✓ پوشه: </span><b>${escapeHtml(libDirHandle.name||'—')}</b>`; }
  else { el.innerHTML = `<span style="color:var(--text3)">پوشه انتخاب نشده</span>`; }
}
async function updateLibCacheStatus(){
  const el = document.getElementById('libCacheStatus');
  if(!el) return;
  const list = await listCachedLibs();
  if(list.length){ el.innerHTML = `<span style="color:var(--ok)">📦 ${faNum(list.length)} کتابخانه در حافظه</span>`; }
  else { el.innerHTML = ''; }
}

window.restoreBackup = async (id) => {
  const b = db.backups.find(x => x.id === id); if(!b) return;
  const ok = await confirmDialog('بازگردانی','داده‌های فعلی جایگزین می‌شوند. ادامه؟'); if(!ok) return;
  db.items = JSON.parse(JSON.stringify(b.data.items||{}));
  db.categories = JSON.parse(JSON.stringify(b.data.categories||[]));
  db.subjects = JSON.parse(JSON.stringify(b.data.subjects||db.subjects));
  saveDB(); log('بازگردانی','از بک‌آپ','restore');
  refreshItemDD(); refreshCatDD(); renderAbout(); toast('✓ بازگردانی شد','ok');
};
window.downloadBackup = (id) => {
  const b = db.backups.find(x => x.id === id); if(!b) return;
  downloadFile(`noah-ark-backup-${b.ts.slice(0,10)}.json`, JSON.stringify(b.data,null,2));
  toast('✓ دانلود شد','ok');
};
window.deleteBackup = async (id) => {
  const ok = await confirmDialog('حذف بک‌آپ','مطمئنید؟'); if(!ok) return;
  db.backups = db.backups.filter(x => x.id !== id);
  saveDB(); log('حذف بک‌آپ','','delete'); renderBackups(); toast('✓ حذف شد','ok');
};

/* ===== INIT ===== */
(async () => {
  try{ renderPresetGrid(); }catch(e){}
  try{ renderColorGrid(); }catch(e){}
  try{ wireEvents(); }catch(e){ console.error(e); }
  try{ refreshItemDD(); }catch(e){}
  try{ refreshCatDD(); }catch(e){}
  try{ generateHeroStars(); }catch(e){}
  try{ renderAbout(); }catch(e){}
  try{ updateAboutHeroStatic(); }catch(e){}
  libDirHandle = await loadDirHandle();
  updateLibFolderStatus();
  await updateLibCacheStatus();
  setTimeout(updateNavSlider, 300);
})();

/* reset=1 */
try{
  if(new URLSearchParams(location.search).get('reset') === '1'){
    if(confirm('همه داده‌ها حذف شوند؟')){
      try{ const cur = localStorage.getItem(STORAGE_KEY); if(cur) localStorage.setItem(STORAGE_KEY+'_safety_'+Date.now(), cur); }catch(e){}
      localStorage.removeItem(STORAGE_KEY); location.href = location.pathname;
    }
  }
}catch(e){}

/* URL hash */
try{
  const hash = location.hash;
  if(hash.startsWith('#data=')){
    const compressed = hash.slice(6);
    const json = LZString.decompressFromEncodedURIComponent(compressed);
    if(json){ const data = JSON.parse(json); if(data.items && confirm('داده‌ای در لینک هست. بارگذاری شود؟')){ db.items = data.items; db.categories = data.categories || db.categories; db.subjects = data.subjects || db.subjects; saveDB(); log('بارگذاری از لینک','','restore'); location.reload(); } }
    history.replaceState(null,'',' ');
  } else if(hash.startsWith('#sync=')){
    const p = hash.slice(6).split('&')[0];
    const parts = p.split(':');
    const service = parts[0], id = parts[1];
    if(service && id && confirm('داده‌ای در سرور هست. بارگذاری شود؟')){
      onlineLoadById(service, id).then(data => { if(data.items){ db.items = data.items; db.categories = data.categories || db.categories; db.subjects = data.subjects || db.subjects; saveDB(); log('بارگذاری از لینک', service+':'+id, 'restore'); location.reload(); } }).catch(()=>{});
    }
    history.replaceState(null,'',' ');
  }
}catch(e){}

console.log('%c⛵ کشتی نوح v'+APP_VERSION+' — گروه هنری اقاقیا', 'font-size:16px;color:#22d3ee;font-weight:bold');
</script>
</body>
</html>