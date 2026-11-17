<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultant Dashboard | Pinwatha Gems</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{--nav:92px;--side:288px;--bg1:#fbf5ec;--bg2:#f0e3d1;--panel:#fffaf3;--line:rgba(185,137,69,.16);--text:#2e241a;--muted:#75624f;--gold:#b98945;--gold2:#94652c;--green:#2f6f65;--green2:#214841;--shadow:0 22px 54px rgba(71,48,22,.12)}
        *{box-sizing:border-box} html{scroll-behavior:smooth}
        body{margin:0;font-family:"Manrope",sans-serif;color:var(--text);background:radial-gradient(circle at top left,rgba(185,137,69,.18),transparent 24%),radial-gradient(circle at top right,rgba(45,109,98,.12),transparent 22%),linear-gradient(180deg,var(--bg1),var(--bg2))}
        a{text-decoration:none;color:inherit}
        .topbar{position:fixed;inset:0 0 auto 0;min-height:var(--nav);display:flex;align-items:center;justify-content:space-between;gap:18px;padding:6px 24px;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid rgba(185,137,69,.18);box-shadow:0 12px 30px rgba(71,48,22,.08);z-index:1000}
        .left,.right,.brand,.profile-btn,.menu-main{display:flex;align-items:center;gap:14px}.mini-icon,.avatar{display:grid;place-items:center}
        .brand{align-items:center;gap:0}.brand-logo{display:block;width:56px;height:56px;object-fit:contain}.brand small{display:block;font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;color:var(--muted)} .brand strong{display:block;font-family:"Cormorant Garamond",serif;font-size:1.65rem;line-height:1.02}
        .search{flex:1;max-width:560px;position:relative}.search i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#8e7357}.search input{width:100%;height:42px;border-radius:16px;border:1px solid var(--line);background:rgba(255,255,255,.92);padding:0 16px 0 44px;outline:none;box-shadow:0 10px 22px rgba(84,61,35,.06)}
        .top-actions{display:flex;align-items:center;gap:14px}.consultant-badge{padding:8px 12px;border-radius:999px;background:#fff3de;border:1px solid #edd9b9;color:#7b5d33;font-size:.82rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase}
        .profile-wrap{position:relative}.profile-btn{padding:7px 12px 7px 7px;border:1px solid var(--line);border-radius:18px;background:rgba(255,255,255,.92);cursor:pointer;box-shadow:0 10px 22px rgba(84,61,35,.06)}.avatar{width:42px;height:42px;border-radius:14px;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:800;overflow:hidden}.avatar img{width:100%;height:100%;object-fit:cover;display:block}.profile-meta span{display:block;font-size:.82rem;color:var(--muted)} .caret{font-size:.8rem;color:var(--muted)}
        .profile-menu{position:absolute;top:calc(100% + 10px);right:0;width:220px;padding:8px;background:#fff;border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);display:none}.profile-wrap.open .profile-menu{display:block}.profile-link,.profile-menu button{width:100%;display:flex;align-items:center;gap:10px;padding:12px 14px;border:0;background:transparent;border-radius:12px;font:inherit;text-align:left;cursor:pointer;color:var(--text)}
        .body{display:flex;padding-top:calc(var(--nav) + 1px)} .sidebar{position:fixed;top:calc(var(--nav) + 1px);left:0;bottom:0;width:var(--side);overflow:auto;padding:22px 16px 28px;background:radial-gradient(circle at top left,rgba(215,161,86,.16),transparent 22%),radial-gradient(circle at bottom right,rgba(255,255,255,.06),transparent 18%),linear-gradient(180deg,#3f2c1e 0%,#261a12 48%,#1b130d 100%);color:#f6ead6;box-shadow:18px 0 40px rgba(19,14,10,.22)}
        .side-label{margin:6px 6px 14px;padding:0 8px;color:rgba(246,234,214,.54);font-size:.72rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase}.menu{list-style:none;padding:0;margin:0}.item+.item{margin-top:10px}
        .menu-link{width:100%;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 14px 14px 12px;border:1px solid rgba(255,255,255,.04);border-radius:22px;background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.025));color:inherit;font:inherit;cursor:pointer;transition:transform .18s ease,background .18s ease,border-color .18s ease,box-shadow .18s ease}
        .menu-link:hover{transform:translateX(2px);background:linear-gradient(180deg,rgba(255,255,255,.09),rgba(255,255,255,.04));border-color:rgba(247,217,165,.14);box-shadow:0 12px 24px rgba(13,8,5,.18)} .menu-link.active{background:linear-gradient(135deg,rgba(255,255,255,.12),rgba(215,161,86,.12));border-color:rgba(247,217,165,.2);box-shadow:inset 0 1px 0 rgba(255,255,255,.05),0 16px 30px rgba(16,10,6,.22)}
        .mini-icon{width:42px;height:42px;border-radius:15px;display:grid;place-items:center;background:linear-gradient(180deg,rgba(255,255,255,.08),rgba(255,255,255,.03));border:1px solid rgba(255,255,255,.05);color:#f7d9a5}.menu-meta{display:grid;gap:2px;min-width:0}.menu-meta strong{display:block;font-size:1.02rem;line-height:1.15}.menu-meta span{display:block;font-size:.77rem;line-height:1.3;color:rgba(246,234,214,.55)}
        .content{flex:1;margin-left:var(--side);padding:24px}.breadcrumb{display:flex;align-items:center;gap:10px;flex-wrap:wrap;color:var(--muted);font-size:.9rem;margin-bottom:18px}
        .hero,.metric,.widget,.table-panel,.module-head,.chat-card,.profile-card{background:var(--panel);border:1px solid rgba(185,137,69,.16);border-radius:24px;box-shadow:var(--shadow)}
        .hero{padding:28px;background:radial-gradient(circle at top right,rgba(47,111,101,.16),transparent 26%),linear-gradient(135deg,rgba(255,249,242,.96),rgba(250,239,223,.96))}.hero small{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:999px;background:#fff7eb;border:1px solid #ecd7b3;color:var(--gold2);font-weight:700;letter-spacing:.08em;text-transform:uppercase}.hero h1{margin:10px 0 8px;font-family:"Cormorant Garamond",serif;font-size:clamp(2.2rem,4vw,3.7rem);line-height:.96}.hero p{margin:0;color:var(--muted);max-width:760px;line-height:1.7}
        .metrics,.widgets,.two-col,.summary-grid,.profile-fields{display:grid;gap:16px}.metrics{grid-template-columns:repeat(4,1fr);margin-top:22px}.widgets{grid-template-columns:repeat(4,1fr);margin-top:22px}.two-col{grid-template-columns:1.08fr .92fr;margin-top:22px}.summary-grid{grid-template-columns:repeat(4,1fr);margin-bottom:16px}.profile-fields{grid-template-columns:1fr 1fr}
        .metric{padding:18px;color:#fff;position:relative;overflow:hidden;min-height:136px}.metric:after{content:"";position:absolute;width:110px;height:110px;border-radius:50%;top:-28px;right:-18px;background:rgba(255,255,255,.14)}.metric-top{display:flex;align-items:center;justify-content:space-between}.metric-icon{width:40px;height:40px;border-radius:14px;background:rgba(255,255,255,.16);display:grid;place-items:center}.metric-value{margin:20px 0 8px;font-size:1.92rem;font-weight:800}.metric-note{font-size:.84rem;opacity:.92}
        .m1{background:linear-gradient(135deg,#c7984e,#996b2d)} .m2{background:linear-gradient(135deg,#2f6f65,#214c45)} .m3{background:linear-gradient(135deg,#b96f5e,#935445)} .m4{background:linear-gradient(135deg,#54433d,#2f2724)}
        .widget,.table-panel,.chat-card,.profile-card{padding:18px}.widget span,.section-head span{display:block;color:var(--muted);font-size:.84rem}.section-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:16px}.section-head h2,.section-head h3{margin:0;font-size:1.05rem}
        .module-page{display:none;margin-top:22px}.module-page.active{display:block}.module-head{padding:22px;margin-bottom:16px}.module-head h2{margin:0 0 8px;font-family:"Cormorant Garamond",serif;font-size:2rem}.module-head p{margin:0;color:var(--muted)}
        .filter-row{display:grid;grid-template-columns:1.15fr repeat(3,auto);gap:10px;align-items:center;margin-bottom:16px}
        .filter-row input,.filter-row select,.field input,.field textarea{border:1px solid #e4d0b3;border-radius:12px;background:#fff;font:inherit}
        .filter-row input,.filter-row select{height:42px;padding:0 12px}
        .search input:focus,.search input:focus-visible,
        .filter-row input:focus,.filter-row select:focus,.filter-row input:focus-visible,.filter-row select:focus-visible,
        input:not([type="checkbox"]):not([type="radio"]):not([type="range"]):focus,
        input:not([type="checkbox"]):not([type="radio"]):not([type="range"]):focus-visible,
        select:focus,select:focus-visible,textarea:focus,textarea:focus-visible,
        .field input:focus,.field select:focus,.field textarea:focus,
        .field input:focus-visible,.field select:focus-visible,.field textarea:focus-visible,
        .profile-fields .field input:focus,.profile-fields .field textarea:focus,
        .profile-fields .field input:focus-visible,.profile-fields .field textarea:focus-visible,
        .dashboard-profile-grid .field input:focus,.dashboard-profile-grid .field textarea:focus,
        .dashboard-profile-grid .field input:focus-visible,.dashboard-profile-grid .field textarea:focus-visible,
        .insight-filter-row input:focus,.insight-filter-row select:focus,
        .insight-filter-row input:focus-visible,.insight-filter-row select:focus-visible{
            outline:none;
            border-color:#b98945;
            box-shadow:0 0 0 5px rgba(185,137,69,.22);
            caret-color:#7b5d33;
        }
        .btn{height:42px;padding:0 14px;border-radius:12px;border:1px solid var(--line);background:#fff;cursor:pointer;font-weight:700}.btn.theme{background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;border:0}
        .summary-card{padding:16px;border-radius:16px;border:1px solid #efdfca;background:#fff}.summary-card span{display:block;color:var(--muted);font-size:.84rem}.summary-card strong{font-size:1.45rem}
        table{width:100%;border-collapse:collapse} th,td{text-align:left;padding:14px 10px;border-bottom:1px solid #efdfca;font-size:.9rem;vertical-align:top} th{color:var(--muted)}
        .status{display:inline-flex;align-items:center;padding:7px 12px;border-radius:999px;font-size:.78rem;font-weight:700}.ok{background:#e0efe8;color:#266353}.warn{background:#faedd7;color:#936725}.bad{background:#f8dfd8;color:#a04e3e}.info{background:#dfeafb;color:#285b9b}
        .actions-inline{display:flex;gap:8px;flex-wrap:wrap}.mini-btn{padding:6px 10px;border-radius:10px;border:1px solid #e7d3b6;background:#fff;font-size:.82rem;cursor:pointer}
        .modal-backdrop{position:fixed;inset:0;background:rgba(20,13,8,.45);display:none;align-items:center;justify-content:center;padding:16px;z-index:2200}
        .modal-backdrop.open{display:flex}
        .modal-card{width:min(640px,100%);background:#fffaf3;border:1px solid #ead9c1;border-radius:20px;box-shadow:var(--shadow);padding:18px}
        .modal-head{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:12px}
        .modal-head h3{margin:0;font-size:1.1rem}
        .close-btn{width:34px;height:34px;border-radius:10px;border:1px solid #e6d1b3;background:#fff;cursor:pointer}
        .view-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .view-item{padding:10px;border:1px solid #efdfca;border-radius:10px;background:#fff}
        .view-item span{display:block;color:var(--muted);font-size:.8rem}
        .modal-actions{display:flex;justify-content:flex-end;gap:8px;margin-top:14px}
        .customer-stack,.advice-list,.chat-list{display:grid;gap:12px}
        .customer-card,.advice-note,.chat-thread{padding:16px;border:1px solid #efdfca;border-radius:18px;background:#fff}
        .customer-card strong,.advice-note strong,.chat-thread strong{display:block;margin-bottom:6px}
        .customer-card span,.advice-note span,.chat-thread span{display:block;color:var(--muted);font-size:.84rem;line-height:1.6}
        .insight-filter-row{display:grid;grid-template-columns:minmax(260px,1.6fr) minmax(180px,.75fr);gap:10px;align-items:center;margin-bottom:16px}
        .insight-filter-row input,.insight-filter-row select{height:42px;padding:0 12px;border:1px solid #e4d0b3;border-radius:12px;background:#fff;font:inherit}
        .insight-filter-row input:focus,.insight-filter-row select:focus{outline:none;border-color:#c89b5c;box-shadow:0 0 0 4px rgba(185,137,69,.12)}
        .insight-zodiac-pill{max-width:82px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
        .consult-chat-layout{display:grid;grid-template-columns:280px 1fr;gap:16px}
        .chat-contact{display:grid;gap:10px}
        .chat-contact-btn{width:100%;padding:14px 16px;border:1px solid #efdfca;border-radius:18px;background:#fff;text-align:left;cursor:pointer;transition:transform .18s ease,border-color .18s ease,box-shadow .18s ease}
        .chat-contact-btn strong{display:block;margin-bottom:4px}
        .chat-contact-btn span{display:block;color:var(--muted);font-size:.83rem;line-height:1.5}
        .chat-contact-btn.active{border-color:#d8bc8a;box-shadow:0 14px 28px rgba(42,29,18,.08);background:linear-gradient(135deg,#fffefc,#f9efdf)}
        .chat-window{padding:18px;border:1px solid #efdfca;border-radius:22px;background:#fff;display:grid;gap:14px}
        .chat-header{padding:12px 14px;border:1px solid #efdfca;border-radius:16px;background:#fffaf4}
        .chat-header strong{display:block}
        .chat-header span{display:block;color:var(--muted);font-size:.84rem;margin-top:4px}
        .chat-messages{display:grid;gap:10px;max-height:360px;overflow:auto;padding-right:4px}
        .chat-bubble-wrap{display:flex}
        .chat-bubble-wrap.consultant{justify-content:flex-end}
        .chat-bubble{max-width:82%;padding:12px 14px;border-radius:16px;border:1px solid #efdfca;background:#fff}
        .chat-bubble-wrap.consultant .chat-bubble{background:#efe6fb}
        .chat-bubble small{display:block;color:var(--muted);font-size:.76rem;margin-bottom:6px}
        .chat-media{margin-top:10px;max-width:320px}
        .chat-media img{display:block;width:100%;max-width:320px;max-height:220px;object-fit:contain;object-position:center;background:#fff;border-radius:14px;border:1px solid #e8d8c2;padding:8px}
        .reply-box{display:grid;gap:10px}.reply-box textarea{min-height:110px;padding:12px;resize:vertical}
        .notification-list{display:grid;gap:14px}
        .notification-card{display:grid;gap:12px;padding:16px;border:1px solid #efdfca;border-radius:20px;background:#fff}
        .notification-top{display:flex;align-items:flex-start;justify-content:space-between;gap:12px}
        .notification-top strong{display:block;font-size:1.02rem}
        .notification-top span{display:block;color:var(--muted);font-size:.88rem}
        .notification-card p{margin:0;color:#6f5b47;line-height:1.6}
        .notification-action{display:inline-flex;align-items:center;justify-content:center;width:max-content;margin-top:4px}
        .notification-card img{width:100%;max-height:240px;object-fit:contain;object-position:center;background:#fff;border-radius:14px;border:1px solid #efe1ce;padding:8px}
        .chat-media{max-width:260px}
        .chat-media img{max-width:260px;max-height:180px;object-fit:contain;object-position:center;background:#fff}
        .profile-layout{display:grid;grid-template-columns:260px 1fr;gap:18px}.profile-image-box{display:grid;place-items:center;gap:12px;padding:22px;border:1px solid #efdfca;border-radius:20px;background:#fff;text-align:center}.profile-avatar{width:94px;height:94px;border-radius:28px;display:grid;place-items:center;overflow:hidden;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:800;font-size:1.7rem}
        .profile-avatar img{width:100%;height:100%;object-fit:cover;display:block}
        .profile-upload-box{width:94px;height:94px;border-radius:28px;display:grid;place-items:center;position:relative;overflow:hidden;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;box-shadow:0 12px 24px rgba(157,119,64,.18)}
        .profile-upload-box i{font-size:1.1rem;opacity:.9}.profile-upload-box span{position:absolute;bottom:16px;font-size:1.2rem;font-weight:800;letter-spacing:.04em}.profile-upload-box img{width:100%;height:100%;object-fit:cover;display:none}.profile-upload-box.has-image i,.profile-upload-box.has-image span,.profile-upload-box.has-image .profile-preview-initial{display:none}.profile-upload-box.has-image img{display:block}
        .profile-upload-trigger{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid #ead7bd;background:#fff7ec;color:#7b5d33;font-weight:700;cursor:pointer}
        .profile-details-card{padding:18px;border:1px solid #efdfca;border-radius:20px;background:#fff}
        .profile-feedback{display:none;width:100%;margin-bottom:14px;padding:11px 14px;border-radius:14px;font-size:.92rem;line-height:1.5;box-shadow:0 10px 22px rgba(84,61,35,.06)}
        .profile-feedback.show{display:block}
        .profile-feedback.success{background:#fff7eb;border:1px solid #edd9b9;color:#7b5d33}
        .profile-feedback.error{background:#fdebe6;border:1px solid #f0c3b5;color:#9a4b3d}
        .dashboard-profile-feedback{display:none;width:100%;margin-bottom:14px;padding:11px 14px;border-radius:14px;font-size:.92rem;line-height:1.5;box-shadow:0 10px 22px rgba(84,61,35,.06)}
        .dashboard-profile-feedback.show{display:block}
        .dashboard-profile-feedback.success{background:#fff7eb;border:1px solid #edd9b9;color:#7b5d33}
        .dashboard-profile-feedback.error{background:#fdebe6;border:1px solid #f0c3b5;color:#9a4b3d}
        .consultant-toast-stack{position:fixed;right:20px;bottom:20px;z-index:2600;display:grid;gap:10px;pointer-events:none}
        .consultant-toast{min-width:280px;max-width:360px;padding:14px 16px;border-radius:16px;background:linear-gradient(135deg,#3f2c1e,#241913);color:#fff;box-shadow:0 18px 40px rgba(32,24,14,.22);border:1px solid rgba(255,255,255,.08);display:flex;align-items:flex-start;gap:10px;opacity:0;transform:translateY(10px) scale(.98);transition:opacity .22s ease,transform .22s ease}
        .consultant-toast.show{opacity:1;transform:translateY(0) scale(1)}
        .consultant-toast.success{background:linear-gradient(135deg,#2f6f65,#214841)}
        .consultant-toast.error{background:linear-gradient(135deg,#9e4335,#7f2e23)}
        .consultant-toast i{margin-top:2px;font-size:1rem}
        .consultant-toast strong{display:block;font-size:.92rem;margin-bottom:3px}
        .consultant-toast span{display:block;font-size:.82rem;line-height:1.5;color:rgba(255,255,255,.88)}
        .profile-fields{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .profile-fields .field input,.profile-fields .field textarea{height:44px;padding:0 12px;border:1px solid #e8d8c2;border-radius:12px;background:#fff;font:inherit}
        .profile-fields .field textarea{min-height:110px;padding:12px;resize:vertical}
        .profile-fields .field .locked-role{
            background:#f7f0e4;
            color:#7b5d33;
            cursor:not-allowed;
            opacity:1;
        }
        .field{display:flex;flex-direction:column;gap:6px}.field.full{grid-column:1 / -1}.field label{font-size:.82rem;color:var(--muted)} .field input,.field textarea{padding:10px 12px}.field textarea{min-height:110px;resize:vertical}.page-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:16px}
        .add-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}.add-form-grid .field.full{grid-column:1 / -1}
        @media (max-width:1260px){.metrics,.widgets,.summary-grid,.two-col,.profile-layout,.profile-fields{grid-template-columns:1fr 1fr}}
        @media (max-width:1024px){.content{margin-left:0;padding:22px 16px}.sidebar{position:static;width:100%;box-shadow:none}.body{display:block}.search{display:none}}
        @media (max-width:720px){.topbar{height:auto;padding:14px 16px;flex-direction:column;align-items:stretch}.body{padding-top:141px}.metrics,.widgets,.summary-grid,.two-col,.filter-row,.profile-layout,.profile-fields{grid-template-columns:1fr}.profile-meta{display:none}}
    </style>
</head>
<body>
    <header class="topbar">
        <div class="brand">
            <img class="brand-logo" src="{{ asset('images/web_logo.png') }}" alt="Pinwatha Gems logo">
          
        </div>
       
        <div class="top-actions">
         
            <div class="profile-wrap" id="profileWrap">
                <button class="profile-btn" id="profileToggle" type="button" aria-expanded="false">
                    <div class="avatar">
                        @if (auth()->user()->profileImageUrl())
                            <img src="{{ auth()->user()->profileImageUrl() }}" alt="{{ auth()->user()->first_name }} profile image">
                        @else
                            {{ auth()->user()->profileInitial() }}
                        @endif
                    </div>
                    <div class="profile-meta"><strong>{{ auth()->user()->first_name ?? 'Consultant' }}</strong><span>Gem Consultant</span></div>
                    <i class="fas fa-chevron-down caret"></i>
                </button>
                <div class="profile-menu">
                    <a href="#profile-page" class="profile-link"><i class="fas fa-user"></i> Profile</a>
                    <a href="#notifications-page" class="profile-link"><i class="fas fa-bell"></i> Notifications</a>
                    <a href="#settings-page" class="profile-link"><i class="fas fa-gear"></i> Settings</a>
                    <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit"><i class="fas fa-right-from-bracket"></i> Logout</button></form>
                </div>
            </div>
        </div>
    </header>

    <div class="body">
        <aside class="sidebar">
            <div class="side-label">Consultant Navigation</div>
            <ul class="menu">
                <li class="item"><a href="#dashboard" class="menu-link active"><span class="menu-main"><span class="mini-icon"><i class="fas fa-chart-pie"></i></span><span class="menu-meta"><strong>Dashboard</strong><span>Overview and daily workload</span></span></span></a></li>
                <li class="item"><a href="#consultation-requests-page" class="menu-link"><span class="menu-main"><span class="mini-icon"><i class="fas fa-file-circle-check"></i></span><span class="menu-meta"><strong>Consultation Requests</strong><span>Review new and pending requests</span></span></span></a></li>
                <li class="item"><a href="#appointments-page" class="menu-link"><span class="menu-main"><span class="mini-icon"><i class="fas fa-calendar-check"></i></span><span class="menu-meta"><strong>Appointments</strong><span>Today, upcoming and completed</span></span></span></a></li>
                <li class="item"><a href="#customer-insights-page" class="menu-link"><span class="menu-main"><span class="mini-icon"><i class="fas fa-user-group"></i></span><span class="menu-meta"><strong>Customer Insights</strong><span>Profiles, wishlist and history</span></span></span></a></li>
                <li class="item"><a href="#chat-page" class="menu-link"><span class="menu-main"><span class="mini-icon"><i class="fas fa-comments"></i></span><span class="menu-meta"><strong>Chat</strong><span>Ongoing customer conversations</span></span></span></a></li>
                <li class="item"><a href="#consultation-history-page" class="menu-link"><span class="menu-main"><span class="mini-icon"><i class="fas fa-clock-rotate-left"></i></span><span class="menu-meta"><strong>Consultation History</strong><span>Completed chats and outcomes</span></span></span></a></li>
            </ul>
        </aside>

        <main class="content">
            <div class="breadcrumb" id="breadcrumb"><span>Consultant Panel</span><i class="fas fa-chevron-right"></i><span id="breadcrumbLeaf">Dashboard</span></div>
            <section id="dashboard" class="default-section">
                <section class="hero">
                    <small><i class="fas fa-stethoscope"></i> Consultant Workspace</small>
                    <h1>Customer guidance, appointments, and recommendations in one place.</h1>
                    <p>The consultant panel is designed to handle customer consultations, appointments, messaging, recommendations, and custom jewellery advisory support with a simpler interface than the admin panel.</p>
                </section>
                <section class="metrics">
                    <div class="metric m1"><div class="metric-top"><span>Total Requests</span><div class="metric-icon"><i class="fas fa-file-circle-check"></i></div></div><div class="metric-value">{{ $consultationMetrics['total_requests'] ?? 0 }}</div><div class="metric-note">{{ $consultationMetrics['pending_requests'] ?? 0 }} pending review</div></div>
                    <div class="metric m2"><div class="metric-top"><span>Today Appointments</span><div class="metric-icon"><i class="fas fa-calendar-day"></i></div></div><div class="metric-value">{{ $consultationMetrics['today_appointments'] ?? 0 }}</div><div class="metric-note">{{ $consultationMetrics['upcoming_appointments'] ?? 0 }} upcoming sessions</div></div>
                    <div class="metric m3"><div class="metric-top"><span>Pending Requests</span><div class="metric-icon"><i class="fas fa-hourglass-half"></i></div></div><div class="metric-value">{{ $consultationMetrics['pending_requests'] ?? 0 }}</div><div class="metric-note">{{ $consultationMetrics['approved_requests'] ?? 0 }} approved</div></div>
                    <div class="metric m4"><div class="metric-top"><span>Completed</span><div class="metric-icon"><i class="fas fa-circle-check"></i></div></div><div class="metric-value">{{ $consultationMetrics['completed_requests'] ?? 0 }}</div><div class="metric-note">{{ $consultationMetrics['rejected_requests'] ?? 0 }} rejected</div></div>
                </section>
                <section class="widgets">
                    <div class="widget"><span>Live Appointments</span><strong>{{ $appointmentMetrics['today'] ?? 0 }}</strong></div>
                    <div class="widget"><span>Open Consultations</span><strong>{{ $consultationMetrics['total_requests'] ?? 0 }}</strong></div>
                    <div class="widget"><span>Pending Replies</span><strong>{{ $consultationMetrics['pending_requests'] ?? 0 }}</strong></div>
                    <div class="widget"><span>Completed Today</span><strong>{{ $appointmentMetrics['completed'] ?? 0 }}</strong></div>
                </section>
                <section class="two-col">
                    <div class="table-panel">
                <div class="section-head"><div><h3>Today's Appointments</h3><span>Upcoming sessions for the day</span></div></div>
                <table>
                    <thead><tr><th>Date</th><th>Time</th><th>Customer</th><th>Type</th><th>Status</th><th>Actions</th></tr></thead>
                    <tbody>
                                @forelse (($todayAppointmentRequests ?? collect()) as $appointmentRequest)
                                    @php
                                        $todayAppointmentStatusLower = strtolower((string) $appointmentRequest->status);
                                        $todayAppointmentHasPendingReschedule = (bool) $appointmentRequest->has_pending_reschedule;
                                    @endphp
                                    <tr
                                        data-appointment-id="{{ $appointmentRequest->id }}"
                                        data-appointment-number="{{ $appointmentRequest->appointment_number }}"
                                        data-appointment-status="{{ $appointmentRequest->status }}"
                                        data-appointment-date="{{ $appointmentRequest->preferred_date?->format('Y-m-d') }}"
                                        data-appointment-time="{{ $appointmentRequest->preferred_time }}"
                                        data-search-blob="{{ trim(($appointmentRequest->appointment_number ?? '').' '.($appointmentRequest->customer_name ?? '').' '.($appointmentRequest->appointment_topic ?? '').' '.($appointmentRequest->appointment_mode ?? '').' '.($appointmentRequest->status ?? '')) }}"
                                    >
                                        <td>{{ $appointmentRequest->preferred_date?->format('Y-m-d') }}</td>
                                        <td>{{ $appointmentRequest->preferred_time }}</td>
                                        <td>{{ $appointmentRequest->customer_name }}</td>
                                        <td>{{ $appointmentRequest->appointment_mode }}</td>
                                        <td>
                                            <span class="status {{ $appointmentRequest->status_class }}">{{ $appointmentRequest->status }}</span>
                                            @if ($todayAppointmentHasPendingReschedule)
                                                <small style="display:block;color:#8b7150;margin-top:4px;">Reschedule pending customer reply</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="actions-inline">
                                                @if ($todayAppointmentHasPendingReschedule)
                                                    <span class="status warn">Awaiting customer</span>
                                                @elseif ($todayAppointmentStatusLower === 'pending')
                                                    <button class="mini-btn" type="button">Confirm</button>
                                                    <button class="mini-btn" type="button">Propose Reschedule</button>
                                                    <button class="mini-btn" type="button">Cancel</button>
                                                @elseif ($todayAppointmentStatusLower === 'confirmed')
                                                    <button class="mini-btn" type="button">Propose Reschedule</button>
                                                    <button class="mini-btn" type="button">Complete</button>
                                                    <button class="mini-btn" type="button">Cancel</button>
                                                @else
                                                    <span class="status info">No actions</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6">No appointment requests for today yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="chat-card">
                        <div class="section-head"><div><h3>Recent Chats</h3><span>Customer-wise latest messages</span></div></div>
                        <div class="chat-list">
                            @forelse (($consultationRequests ?? collect())->take(3) as $consultationRequest)
                                <div class="chat-thread">
                                    <strong>{{ $consultationRequest->customer_name }}</strong>
                                    <span>{{ $consultationRequest->messages->isNotEmpty() ? $consultationRequest->messages->last()->message : $consultationRequest->customer_note }}</span>
                                </div>
                            @empty
                                <div class="chat-thread"><strong>No active chats</strong><span>Customer conversations will appear here once an admin assigns you to an approved consultation.</span></div>
                            @endforelse
                        </div>
                    </div>
                </section>
            </section>

            <section class="module-page" id="consultation-requests-page">
                <div class="module-head"><h2>Consultation Requests</h2><p>Review new, pending, approved, and rejected consultation requests with quick action controls.</p></div>
                <div class="summary-grid">
                    <div class="summary-card"><span>New Requests</span><strong>{{ $consultationMetrics['total_requests'] ?? 0 }}</strong></div>
                    <div class="summary-card"><span>Pending</span><strong>{{ $consultationMetrics['pending_requests'] ?? 0 }}</strong></div>
                    <div class="summary-card"><span>Approved</span><strong>{{ $consultationMetrics['approved_requests'] ?? 0 }}</strong></div>
                    <div class="summary-card"><span>Rejected</span><strong>{{ $consultationMetrics['rejected_requests'] ?? 0 }}</strong></div>
                </div>
                <div class="table-panel">
                        <div class="filter-row">
                            <input id="consultRequestSearch" type="text" placeholder="Search request or customer">
                            <select id="consultRequestStatus"><option>All Status</option><option>Pending</option><option>Approved</option><option>Rejected</option></select>
                        <select id="consultRequestType"><option>All Type</option><option>Gem Advice</option><option>Custom Design</option><option>Zodiac Recommendation</option></select>
                        </div>
                    <table>
                        <thead><tr><th>Request ID</th><th>Customer Name</th><th>Request Type</th><th>Submitted On</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody id="consultationRequestsTableBody">
                            @forelse (($consultationRequests ?? collect()) as $consultationRequest)
                                <tr
                                    data-generated="consultation-request"
                                    data-consultation-id="{{ $consultationRequest->id }}"
                                    data-request-id="{{ $consultationRequest->request_number }}"
                                    data-chat-thread-id="{{ $consultationRequest->chat_thread_id }}"
                                    data-customer-name="{{ $consultationRequest->customer_name }}"
                                    data-request-kind="{{ $consultationRequest->request_kind }}"
                                    data-request-type="{{ $consultationRequest->request_type }}"
                                    data-submitted-on="{{ $consultationRequest->created_at?->format('Y-m-d') }}"
                                    data-status="{{ $consultationRequest->status }}"
                                    data-consultant-id="{{ $consultationRequest->consultant_id }}"
                                    data-assigned-consultant="{{ $consultationRequest->consultant_name }}"
                                    data-consultant-note="{{ $consultationRequest->consultant_note }}"
                                    data-customer-note="{{ $consultationRequest->customer_note }}"
                                >
                                    <td>{{ $consultationRequest->request_number }}</td>
                                    <td>{{ $consultationRequest->customer_name }}</td>
                                    <td>{{ $consultationRequest->display_request_type }}</td>
                                    <td>{{ $consultationRequest->created_at?->format('Y-m-d') }}</td>
                                    <td><span class="status {{ $consultationRequest->status_class }}">{{ $consultationRequest->status }}</span></td>
                                    <td><div class="actions-inline"><button class="mini-btn" type="button">View</button><button class="mini-btn" type="button">Open Chat</button></div></td>
                                </tr>
                            @empty
                                <tr><td colspan="6">No consultation requests yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="module-page" id="appointments-page">
                <div class="module-head"><h2>Appointments</h2><p>Manage today's, upcoming, confirmed, completed, and cancelled customer appointments.</p></div>
                <div class="summary-grid">
                    <div class="summary-card"><span>Today</span><strong>{{ $appointmentMetrics['today'] ?? 0 }}</strong></div>
                    <div class="summary-card"><span>Upcoming</span><strong>{{ $appointmentMetrics['upcoming'] ?? 0 }}</strong></div>
                    <div class="summary-card"><span>Completed</span><strong>{{ $appointmentMetrics['completed'] ?? 0 }}</strong></div>
                    <div class="summary-card"><span>Cancelled</span><strong>{{ $appointmentMetrics['cancelled'] ?? 0 }}</strong></div>
                </div>
                <div class="table-panel">
                    <div class="filter-row">
                        <input id="appointmentSearch" type="text" placeholder="Search appointment">
                        <select id="appointmentStatus"><option>All Status</option><option>Pending</option><option>Confirmed</option><option>Completed</option><option>Cancelled</option></select>
                        <input id="appointmentDate" type="date">
                    </div>
                    <table>
                        <thead><tr><th>Appointment Date</th><th>Time</th><th>Customer</th><th>Type</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            @forelse (($appointmentRequests ?? collect()) as $appointmentRequest)
                                @php
                                    $appointmentStatusLower = strtolower((string) $appointmentRequest->status);
                                    $appointmentHasPendingReschedule = (bool) $appointmentRequest->has_pending_reschedule;
                                @endphp
                                <tr
                                    data-appointment-id="{{ $appointmentRequest->id }}"
                                    data-appointment-number="{{ $appointmentRequest->appointment_number }}"
                                    data-appointment-status="{{ $appointmentRequest->status }}"
                                    data-appointment-date="{{ $appointmentRequest->preferred_date?->format('Y-m-d') }}"
                                    data-appointment-time="{{ $appointmentRequest->preferred_time }}"
                                    data-search-blob="{{ trim(($appointmentRequest->appointment_number ?? '').' '.($appointmentRequest->customer_name ?? '').' '.($appointmentRequest->appointment_topic ?? '').' '.($appointmentRequest->appointment_mode ?? '').' '.($appointmentRequest->status ?? '')) }}"
                                >
                                    <td>{{ $appointmentRequest->preferred_date?->format('Y-m-d') }}</td>
                                    <td>{{ $appointmentRequest->preferred_time }}</td>
                                    <td>{{ $appointmentRequest->customer_name }}</td>
                                    <td>{{ $appointmentRequest->appointment_topic }}</td>
                                    <td>
                                        <span class="status {{ $appointmentRequest->status_class }}">{{ $appointmentRequest->status }}</span>
                                        @if ($appointmentHasPendingReschedule)
                                            <small style="display:block;color:#8b7150;margin-top:4px;">Reschedule pending customer reply</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="actions-inline">
                                            @if ($appointmentHasPendingReschedule)
                                                <span class="status warn">Awaiting customer</span>
                                            @elseif ($appointmentStatusLower === 'pending')
                                                <button class="mini-btn" type="button">Confirm</button>
                                                <button class="mini-btn" type="button">Propose Reschedule</button>
                                                <button class="mini-btn" type="button">Cancel</button>
                                            @elseif ($appointmentStatusLower === 'confirmed')
                                                <button class="mini-btn" type="button">Propose Reschedule</button>
                                                <button class="mini-btn" type="button">Complete</button>
                                                <button class="mini-btn" type="button">Cancel</button>
                                            @else
                                                <span class="status info">No actions</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6">No appointments yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="module-page" id="customer-insights-page">
                <div class="module-head"><h2>Customer Insights</h2><p>Review customer profiles, birth details, wishlist items, order history, and previous consultations.</p></div>
                <div class="table-panel">
                    <div class="insight-filter-row">
                        <input id="customerInsightSearch" type="text" placeholder="Search customer, order, consultation, or email">
                        <select id="customerInsightZodiac">
                            <option value="">All Zodiac Signs</option>
                            @foreach (($customerInsightZodiacOptions ?? collect()) as $zodiacOption)
                                <option value="{{ \Illuminate\Support\Str::lower($zodiacOption) }}">{{ $zodiacOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="customer-stack" id="customerInsightsStack">
                        @forelse (($customerInsights ?? collect()) as $insight)
                            <article class="customer-card" data-customer-insight-card data-search-blob="{{ $insight['search_blob'] ?? '' }}" data-zodiac-key="{{ $insight['zodiac_key'] ?? '' }}">
                                <div class="request-card-header">
                                    <div>
                                        <strong>{{ $insight['name'] }}</strong>
                                        <span>{{ $insight['email'] }} · {{ $insight['phone'] }}</span>
                                    </div>
                                    <span class="status info insight-zodiac-pill" title="{{ $insight['zodiac'] ?? '-' }}">{{ $insight['zodiac_label'] ?? ($insight['zodiac'] ?? '-') }}</span>
                                </div>
                                <div class="view-grid">
                                    <div class="view-item"><span>Birth Date</span><strong>{{ $insight['birth_date'] }}</strong></div>
                                    <div class="view-item"><span>Orders</span><strong>{{ $insight['orders_count'] }}</strong></div>
                                    <div class="view-item"><span>Wishlist</span><strong>{{ $insight['wishlist_count'] }}</strong></div>
                                    <div class="view-item"><span>Consultations</span><strong>{{ $insight['consultation_count'] }}</strong></div>
                                    <div class="view-item"><span>Latest Order</span><strong>{{ $insight['latest_order_number'] }}</strong><span>{{ $insight['latest_order_status'] }}</span></div>
                                    <div class="view-item"><span>Latest Consultation</span><strong>{{ $insight['latest_consultation_type'] }}</strong><span>{{ $insight['latest_consultation_status'] }} · {{ $insight['latest_consultation_date'] }}</span></div>
                                </div>
                            </article>
                        @empty
                            <div class="request-empty" style="margin:0;">No customer insight data is available yet. Once this consultant is assigned customers, their profiles, wishlists, orders, and consultation history will appear here.</div>
                        @endforelse
                    </div>
                    <div class="request-empty" id="customerInsightsEmpty" style="display:none;margin-top:12px;">No customer insights match the selected filter.</div>
                </div>
            </section>

            <section class="module-page" id="chat-page">
                <div class="module-head"><h2>Chat</h2><p>View customer-wise conversations and reply through a real thread-style chat area.</p></div>
                <div class="consult-chat-layout">
                    <div class="chat-card">
                        <div class="section-head"><div><h3>Customer Chats</h3><span>Select a customer conversation</span></div></div>
                        <div class="chat-contact" id="consultantChatContacts"></div>
                    </div>
                    <div class="chat-window">
                        <div class="chat-header">
                            <strong id="consultantChatTitle">Customer Consultation Chat</strong>
                            <span id="consultantChatMeta">Customer and consultant thread</span>
                        </div>
                        <div class="chat-messages" id="consultantChatMessages"></div>
                        <div class="reply-box">
                            <textarea id="consultantChatInput" placeholder="Type consultant reply, guidance, or follow-up note here..."></textarea>
                            <input id="consultantChatImage" type="file" accept="image/*">
                            <div class="page-actions">
                                <button class="btn" id="consultantChatComplete" type="button">Complete Consultation</button>
                                <button class="btn theme" id="consultantChatSend" type="button">Send Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="module-page" id="consultation-history-page">
                <div class="module-head"><h2>Consultation History</h2><p>Review completed consultation threads and the final recorded outcome.</p></div>
                <div class="summary-grid">
                    <div class="summary-card"><span>Completed Threads</span><strong>{{ ($consultationRequests ?? collect())->where('status', 'Completed')->count() }}</strong></div>
                    <div class="summary-card"><span>With Messages</span><strong>{{ ($consultationRequests ?? collect())->filter(fn ($consultationRequest) => $consultationRequest->status === 'Completed' && $consultationRequest->messages->isNotEmpty())->count() }}</strong></div>
                    <div class="summary-card"><span>Assigned</span><strong>{{ ($consultationRequests ?? collect())->whereNotNull('consultant_id')->where('status', 'Completed')->count() }}</strong></div>
                    <div class="summary-card"><span>Closed This Month</span><strong>{{ ($consultationRequests ?? collect())->filter(fn ($consultationRequest) => $consultationRequest->status === 'Completed' && $consultationRequest->completed_at && $consultationRequest->completed_at->isSameMonth(now()))->count() }}</strong></div>
                </div>
                <div class="table-panel">
                    <div class="filter-row">
                        <input id="consultationHistorySearch" type="text" placeholder="Search completed consultation">
                        <select id="consultationHistoryStatus"><option>All Status</option><option>Completed</option><option>Cancelled</option><option>Rejected</option></select>
                        <input id="consultationHistoryDate" type="date">
                    </div>
                    <table>
                        <thead><tr><th>Request ID</th><th>Customer</th><th>Consultation Type</th><th>Completed On</th><th>Status</th><th>Last Message</th></tr></thead>
                        <tbody id="consultationHistoryTableBody">
                            @forelse (($consultationRequests ?? collect())->where('status', 'Completed') as $consultationRequest)
                                <tr data-history-id="{{ $consultationRequest->id }}" data-history-status="{{ $consultationRequest->status }}" data-history-date="{{ $consultationRequest->completed_at?->format('Y-m-d') ?? $consultationRequest->updated_at?->format('Y-m-d') }}">
                                    <td>{{ $consultationRequest->request_number }}</td>
                                    <td>{{ $consultationRequest->customer_name }}</td>
                                    <td>{{ $consultationRequest->display_request_type }}</td>
                                    <td>{{ $consultationRequest->completed_at?->format('Y-m-d') ?? '-' }}</td>
                                    <td><span class="status ok">Completed</span></td>
                                    <td>{{ $consultationRequest->messages->last()?->message ?? 'No messages stored.' }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6">No completed consultation history yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="module-page" id="recommendations-page">
                <div class="module-head"><h2>Recommendations</h2><p>Save gemstone suggestions, zodiac-based advice, jewellery recommendations, and consultant notes.</p></div>
                <div class="table-panel">
                    <div class="advice-list">
                        @forelse (($recommendationRows ?? collect()) as $recommendation)
                            <article class="advice-note">
                                <strong>{{ $recommendation['customer_name'] }} · {{ $recommendation['request_type'] }}</strong>
                                <span>{{ $recommendation['request_number'] }} · {{ $recommendation['date'] }} · {{ $recommendation['consultant_name'] }}</span>
                                <span class="status {{ $recommendation['status_class'] }}">{{ $recommendation['status'] }}</span>
                                <p style="margin:10px 0 0;color:#5d4a37;line-height:1.7;">{{ $recommendation['summary'] }}</p>
                            </article>
                        @empty
                            <div class="request-empty" style="margin:0;">No recommendation records are available yet. Approved and completed consultation notes will appear here automatically.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            <section class="module-page" id="notifications-page">
                <div class="module-head">
                    <h2>Notifications</h2>
                    <p>Admin announcements and consultant updates appear here.</p>
                </div>
                <div class="notification-list">
                    @forelse (($consultantNotifications ?? collect()) as $notification)
                        <article class="notification-card">
                            <div class="notification-top">
                                <div>
                                    <strong>{{ $notification->title }}</strong>
                                    <span>{{ $notification->category ?: 'General' }}</span>
                                </div>
                                <span class="status {{ $notification->status_class }}">{{ $notification->status }}</span>
                            </div>
                            @if ($notification->imageUrl())
                                <img src="{{ $notification->imageUrl() }}" alt="{{ $notification->title }}">
                            @endif
                            <p>{{ $notification->message }}</p>
                            @if (!empty($notification->action_label) && !empty($notification->action_url))
                                <a class="mini-btn notification-action" href="{{ $notification->action_url }}">{{ $notification->action_label }}</a>
                            @endif
                            <small style="color:var(--muted);font-size:.82rem;">
                                {{ $notification->published_at?->format('Y-m-d') ?? $notification->created_at?->format('Y-m-d') }}
                            </small>
                        </article>
                    @empty
                        <div class="request-empty" style="margin:0;">No notifications yet. Admin announcements and updates will appear here once posted.</div>
                    @endforelse
                </div>
            </section>

            <section class="module-page" id="profile-page">
                <div class="module-head"><h2>Profile</h2><p>Manage consultant account details and personal contact information.</p></div>
                <div class="table-panel">
                    <form id="consultantProfileForm" action="{{ route('consultant.profile.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ route('consultant.dashboard') }}#profile-page">
                        <div class="profile-layout">
                            <div class="profile-image-box">
                                <div class="profile-upload-box {{ auth()->user()->profileImageUrl() ? 'has-image' : '' }}" id="consultantProfilePreviewBox">
                                    @if (auth()->user()->profileImageUrl())
                                        <img id="consultantProfilePreviewImage" src="{{ auth()->user()->profileImageUrl() }}" alt="Profile preview" style="display:block;">
                                    @else
                                        <i class="fas fa-user"></i>
                                        <span class="profile-preview-initial">{{ auth()->user()->profileInitial() }}</span>
                                        <img id="consultantProfilePreviewImage" alt="Profile preview">
                                    @endif
                                </div>
                                <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                                <span style="color:#7a6550;">Consultant Account</span>
                                @error('profile_image')
                                    <div class="field-error">{{ $message }}</div>
                                @enderror
                                <input id="consultantProfileImage" name="profile_image" form="consultantProfileImageForm" type="file" accept="image/*" style="display:none;">
                                <label class="profile-upload-trigger" for="consultantProfileImage"><i class="fas fa-image"></i> Profile Image</label>
                            </div>
                            <div class="profile-details-card">
                                <div class="profile-feedback success {{ session('profile_success') ? 'show' : '' }}" id="consultantProfileSuccessMessage">{{ session('profile_success', 'Profile details updated successfully.') }}</div>
                                <div class="profile-fields">
                                    <div class="field"><label>Full Name</label><input id="consultantProfileFullName" name="full_name" type="text" value="{{ old('full_name', trim((auth()->user()->first_name ?? '').' '.(auth()->user()->last_name ?? ''))) }}"></div>
                                    <div class="field"><label>Email Address</label><input id="consultantProfileEmail" name="email" type="email" value="{{ old('email', auth()->user()->email) }}"></div>
                                    <div class="field"><label>Phone Number</label><input id="consultantProfilePhone" name="phone_number" type="text" value="{{ old('phone_number', auth()->user()->phone_number ?? '') }}"></div>
                                    <div class="field"><label>Role</label><input class="locked-role" type="text" value="Consultant" disabled aria-disabled="true" tabindex="-1"></div>
                                    <div class="field"><label>Birth Date</label><input name="birth_date" type="date" value="{{ old('birth_date', formatDateInputValue(auth()->user()->birth_date ?? null)) }}"></div>
                                    <div class="field"><label>Zodiac Sign</label><input type="text" value="{{ auth()->user()->zodiacSign?->sign_name ?? 'Auto-calculated from birth date' }}" readonly></div>
                                    <div class="field full"><label>Address</label><textarea name="address">{{ old('address', auth()->user()->address ?? '') }}</textarea></div>
                                </div>
                                <div class="page-actions">
                                    <button class="btn theme" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form id="consultantProfileImageForm" action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ route('consultant.dashboard') }}#profile-page">
                    </form>
                </div>
            </section>

            <section class="module-page" id="settings-page">
                <div class="module-head"><h2>Settings</h2><p>Change password and keep consultant account access secure.</p></div>
                <div class="table-panel">
                    @if ($errors->has('current_password') || $errors->has('password'))
                        <div class="dashboard-profile-feedback error show">
                            Please correct the highlighted password fields.
                        </div>
                    @endif
                    <form class="add-form-grid" action="{{ route('dashboard.password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{{ route('consultant.dashboard') }}#settings-page">
                        <div class="field full"><label>Change Password</label><input value="Password update form" readonly></div>
                        <div class="field"><label>Current Password</label><input name="current_password" type="password" placeholder="Enter current password" required></div>
                        <div class="field"><label>New Password</label><input name="password" type="password" placeholder="Enter new password" required></div>
                        <div class="field"><label>Confirm New Password</label><input name="password_confirmation" type="password" placeholder="Confirm new password" required></div>
                        <div class="field full" style="display:flex;justify-content:flex-end;">
                            <button class="btn theme" type="submit">Update Password</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <div class="modal-backdrop" id="consultantViewModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3 id="consultantViewModalTitle">Details</h3>
                <button class="close-btn" id="consultantViewModalClose" type="button" aria-label="Close"><i class="fas fa-xmark"></i></button>
            </div>
            <div class="view-grid" id="consultantViewModalBody"></div>
            <div class="modal-actions">
                <button class="btn theme" id="consultantViewModalOk" type="button">OK</button>
            </div>
        </div>
    </div>

    <div class="modal-backdrop" id="consultantRescheduleModal">
        <div class="modal-card" style="max-width:520px;">
            <div class="modal-head">
                <h3 id="consultantRescheduleTitle">Propose Reschedule</h3>
                <button class="close-btn" id="consultantRescheduleClose" type="button" aria-label="Close"><i class="fas fa-xmark"></i></button>
            </div>
            <div class="add-form-grid">
                <div class="field"><label>New Date</label><input id="consultantRescheduleDate" type="date"></div>
                <div class="field"><label>New Time</label><select id="consultantRescheduleTime" disabled><option value="">Select a date first</option></select></div>
                <div class="field full"><label>Reschedule Note</label><textarea id="consultantRescheduleNote" placeholder="Optional note for the customer about the suggested new time."></textarea></div>
            </div>
            <div class="modal-actions">
                <button class="btn" id="consultantRescheduleCancel" type="button">Cancel</button>
                <button class="btn theme" id="consultantRescheduleSave" type="button">Done</button>
            </div>
        </div>
    </div>

    <div class="consultant-toast-stack" id="consultantToastStack" aria-live="polite" aria-atomic="true"></div>

    @php
        $consultationThreadsForJs = ($consultationRequests ?? collect())->map(function ($request) {
            return [
                'consultationId' => $request->id,
                'id' => $request->chat_thread_id,
                'requestId' => $request->request_number,
                'customerName' => $request->customer_name,
                'consultantName' => $request->consultant_name,
                'requestType' => $request->request_type,
                'status' => $request->status,
                'consultantId' => $request->consultant_id,
                'canReply' => $request->consultant_id && $request->status === 'Approved',
                'messages' => ($request->messages ?? collect())->map(function ($message) {
                    $role = strtolower((string) ($message->sender_role ?? 'customer'));
                    if (!in_array($role, ['customer', 'consultant'], true)) {
                        return null;
                    }

                    return [
                        'sender' => $role === 'consultant' ? 'Consultant' : 'Customer',
                        'time' => $message->created_at?->timezone('Asia/Colombo')->format('h:i A'),
                        'text' => $message->message,
                        'imagePath' => $message->image_path,
                        'imageUrl' => $message->image_path ? asset($message->image_path) : null,
                    ];
                })->filter()->values(),
            ];
        })->values();
    @endphp
    <script>
        (function () {
            const breadcrumbLeaf = document.getElementById('breadcrumbLeaf');
            const profileWrap = document.getElementById('profileWrap');
            const profileToggle = document.getElementById('profileToggle');
            const defaultSections = Array.from(document.querySelectorAll('.default-section'));
            const pages = Array.from(document.querySelectorAll('.module-page'));
            const consultantViewModal = document.getElementById('consultantViewModal');
            const consultantViewModalTitle = document.getElementById('consultantViewModalTitle');
            const consultantViewModalBody = document.getElementById('consultantViewModalBody');
            const consultantViewModalClose = document.getElementById('consultantViewModalClose');
            const consultantViewModalOk = document.getElementById('consultantViewModalOk');
            const consultantRescheduleModal = document.getElementById('consultantRescheduleModal');
            const consultantRescheduleClose = document.getElementById('consultantRescheduleClose');
            const consultantRescheduleCancel = document.getElementById('consultantRescheduleCancel');
            const consultantRescheduleSave = document.getElementById('consultantRescheduleSave');
            const consultantRescheduleDate = document.getElementById('consultantRescheduleDate');
            const consultantRescheduleTime = document.getElementById('consultantRescheduleTime');
            const consultantRescheduleNote = document.getElementById('consultantRescheduleNote');
            const consultantChatContacts = document.getElementById('consultantChatContacts');
            const consultantChatTitle = document.getElementById('consultantChatTitle');
            const consultantChatMeta = document.getElementById('consultantChatMeta');
            const consultantChatMessages = document.getElementById('consultantChatMessages');
            const consultantChatInput = document.getElementById('consultantChatInput');
            const consultantChatImage = document.getElementById('consultantChatImage');
            const consultantChatComplete = document.getElementById('consultantChatComplete');
            const consultantChatSend = document.getElementById('consultantChatSend');
            const consultantToastStack = document.getElementById('consultantToastStack');
            const consultationMessageStoreRoute = @json(url('/consultations'));
            const consultationThreadSyncRoute = @json(url('/consultations/threads'));
            const consultationRequestUpdateRoute = @json(url('/consultant/consultation-requests'));
            const appointmentUpdateRoute = @json(url('/consultant/appointments'));
            const appointmentSlotMap = @json($appointmentSlotMap ?? []);
            const consultationSyncStorageKey = 'pg_consultation_thread_sync';
            const initialConsultationThreads = @json($consultationThreadsForJs);
            const consultantDisplayName = @json(trim((auth()->user()->first_name ?? '').' '.(auth()->user()->last_name ?? '')) ?: 'Consultant');
            const routeMap = {
                '#consultation-requests-page': 'Consultation Requests',
                '#appointments-page': 'Appointments',
                '#customer-insights-page': 'Customer Insights',
                '#chat-page': 'Chat',
                '#consultation-history-page': 'Consultation History',
                '#recommendations-page': 'Recommendations',
                '#notifications-page': 'Notifications',
                '#profile-page': 'Profile',
                '#settings-page': 'Settings'
            };
            const escapeHtml = (value) => String(value || '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
            const showConsultantToast = (payload) => {
                if (!consultantToastStack || !payload?.message) return;
                const toast = document.createElement('div');
                toast.className = `consultant-toast ${payload.type || 'success'}`;
                toast.innerHTML = `
                    <i class="fas ${payload.type === 'error' ? 'fa-circle-xmark' : 'fa-circle-check'}"></i>
                    <div>
                        <strong>${escapeHtml(payload.title || 'Success')}</strong>
                        <span>${escapeHtml(payload.message)}</span>
                    </div>
                `;
                consultantToastStack.appendChild(toast);
                window.setTimeout(() => toast.classList.add('show'), 20);
                window.setTimeout(() => {
                    toast.classList.remove('show');
                    window.setTimeout(() => toast.remove(), 240);
                }, 3200);
            };
            const flashToasts = [];
            @if (session('profile_image_success'))
                flashToasts.push({ type: 'success', title: 'Profile Image', message: @json(session('profile_image_success')) });
            @endif
            @if (session('profile_success'))
                flashToasts.push({ type: 'success', title: 'Profile Updated', message: @json(session('profile_success')) });
            @endif
            @if (session('password_success'))
                flashToasts.push({ type: 'success', title: 'Password Updated', message: @json(session('password_success')) });
            @endif
            flashToasts.forEach(showConsultantToast);
            const formatChatTime = (date = new Date()) => date.toLocaleTimeString('en-LK', {
                timeZone: 'Asia/Colombo',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            const appointmentSlotTimes = Array.from({ length: 16 }, (_, index) => {
                const hour = 8 + Math.floor(index / 2);
                const minute = index % 2 === 0 ? '00' : '30';
                return `${String(hour).padStart(2, '0')}:${minute}`;
            });
            const getTodayDateValue = () => {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };
            const isBookableAppointmentDate = (dateValue) => {
                const date = new Date(dateValue);
                if (Number.isNaN(date.getTime())) return false;
                const day = date.getDay();
                return day >= 1 && day <= 6;
            };
            const isFutureAppointmentTime = (slot) => {
                const [slotHour, slotMinute] = slot.split(':').map(Number);
                const now = new Date();
                const slotDate = new Date();
                slotDate.setHours(slotHour, slotMinute, 0, 0);
                return slotDate.getTime() > now.getTime();
            };
            const getBookedSlotsForDate = (dateValue, appointmentId = '') => {
                const slots = Array.isArray(appointmentSlotMap?.[dateValue]) ? appointmentSlotMap[dateValue].filter(Boolean) : [];
                if (!dateValue || !appointmentId) return slots;
                const currentRow = document.querySelector(`#appointments-page tbody tr[data-appointment-id="${CSS.escape(String(appointmentId))}"]`);
                if (!currentRow) return slots;
                const currentDate = currentRow.children[0]?.textContent.trim() || '';
                const currentTime = currentRow.children[1]?.textContent.trim() || '';
                if (currentDate === dateValue && currentTime) {
                    return slots.filter((slot) => slot !== currentTime);
                }
                return slots;
            };
            const renderConsultantRescheduleTimeOptions = () => {
                if (!consultantRescheduleTime || !consultantRescheduleDate) return;
                const selectedDate = consultantRescheduleDate.value.trim();
                const appointmentId = activeAppointmentRow?.dataset?.appointmentId || '';
                const currentDate = activeAppointmentRow?.children?.[0]?.textContent.trim() || '';
                const currentTime = activeAppointmentRow?.children?.[1]?.textContent.trim() || '';
                const isDateAllowed = selectedDate && isBookableAppointmentDate(selectedDate);
                const bookedSlots = new Set(getBookedSlotsForDate(selectedDate, appointmentId));
                const availableSlots = isDateAllowed
                    ? appointmentSlotTimes.filter((slot) => !bookedSlots.has(slot) && (selectedDate !== getTodayDateValue() || isFutureAppointmentTime(slot)))
                    : [];
                const previousValue = consultantRescheduleTime.value || consultantRescheduleTime.dataset.selectedValue || '';
                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = isDateAllowed ? 'Select time slot' : 'Select a valid date first';
                consultantRescheduleTime.innerHTML = '';
                consultantRescheduleTime.appendChild(placeholder);
                if (currentTime && selectedDate === currentDate) {
                    const currentOption = document.createElement('option');
                    currentOption.value = currentTime;
                    currentOption.textContent = `${currentTime} (current slot)`;
                    currentOption.dataset.currentSlot = 'true';
                    consultantRescheduleTime.appendChild(currentOption);
                }
                availableSlots.forEach((slot) => {
                    if (slot === currentTime && selectedDate === currentDate) {
                        return;
                    }
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = slot;
                    consultantRescheduleTime.appendChild(option);
                });
                consultantRescheduleTime.disabled = !isDateAllowed;
                consultantRescheduleTime.value = (availableSlots.includes(previousValue) || previousValue === currentTime)
                    ? previousValue
                    : currentTime && selectedDate === currentDate
                        ? currentTime
                        : '';
                consultantRescheduleTime.setCustomValidity(selectedDate && isDateAllowed && !availableSlots.length
                    ? 'No available time slots remain for this date.'
                    : '');
            };
            const buildConsultationThreadMeta = (thread) => `${thread.requestType || 'Consultation'} / Customer and consultant thread`;
            const renderConsultationMessageMedia = (message) => {
                if (!message?.imageUrl) return '';
                return `<div class="chat-media"><img src="${escapeHtml(message.imageUrl)}" alt="Consultation attachment"></div>`;
            };
            const getConsultationThreadPreview = (thread) => {
                const latestMessage = Array.isArray(thread.messages) && thread.messages.length
                    ? thread.messages[thread.messages.length - 1]
                    : null;
                return latestMessage?.text || 'No messages yet.';
            };
            const buildConsultantChatTitle = (thread) => {
                const requestId = thread?.requestId ? ' - ' + thread.requestId : '';
                return 'Chat with ' + (thread?.customerName || 'Customer') + requestId;
            };
            let consultationThreadsState = normalizeConsultationThreads(initialConsultationThreads);
            const getConsultationChatThreads = () => consultationThreadsState;
            const saveConsultationChatThreads = (items) => {
                consultationThreadsState = normalizeConsultationThreads(items);
            };
            function normalizeConsultationThreads(items) {
                if (!Array.isArray(items)) return [];
                return items.filter((thread) => thread
                    && typeof thread === 'object'
                    && Array.isArray(thread.messages)
                    && thread.status === 'Approved');
            }
            let activeChatId = getConsultationChatThreads()[0]?.id || null;
            let activeAppointmentRow = null;

            function openConsultantViewModal(title, items) {
                if (!consultantViewModal || !consultantViewModalTitle || !consultantViewModalBody) return;
                consultantViewModalTitle.textContent = title;
                consultantViewModalBody.innerHTML = '';
                items.forEach(function (item) {
                    const block = document.createElement('div');
                    block.className = 'view-item';
                    block.innerHTML = '<span>' + item.label + '</span><strong>' + item.value + '</strong>';
                    consultantViewModalBody.appendChild(block);
                });
                consultantViewModal.classList.add('open');
            }

            function closeConsultantViewModal() {
                if (!consultantViewModal) return;
                consultantViewModal.classList.remove('open');
            }

            function openConsultantRescheduleModal(row) {
                if (!consultantRescheduleModal || !consultantRescheduleDate || !consultantRescheduleTime || !row) return;
                activeAppointmentRow = row;
                consultantRescheduleDate.value = row.children[0] ? row.children[0].textContent.trim() : '';
                consultantRescheduleTime.dataset.selectedValue = row.children[1] ? row.children[1].textContent.trim() : '';
                if (consultantRescheduleNote) {
                    consultantRescheduleNote.value = '';
                }
                renderConsultantRescheduleTimeOptions();
                consultantRescheduleModal.classList.add('open');
            }

            function closeConsultantRescheduleModal() {
                if (!consultantRescheduleModal) return;
                consultantRescheduleModal.classList.remove('open');
                if (consultantRescheduleTime) {
                    consultantRescheduleTime.dataset.selectedValue = '';
                    consultantRescheduleTime.innerHTML = '<option value="">Select a date first</option>';
                    consultantRescheduleTime.disabled = true;
                    consultantRescheduleTime.setCustomValidity('');
                }
                if (consultantRescheduleNote) {
                    consultantRescheduleNote.value = '';
                }
                activeAppointmentRow = null;
            }

            async function updateConsultationRequestOnServer(consultationId, payload) {
                const response = await fetch(`${consultationRequestUpdateRoute}/${consultationId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': @json(csrf_token()),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload || {}),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(data?.message || 'Unable to update the consultation request.');
                }

                return data;
            }
            const syncConsultationThreadsFromServer = async () => {
                try {
                    const response = await fetch(consultationThreadSyncRoute, {
                        headers: { 'Accept': 'application/json' },
                    });
                    if (!response.ok) return;
                    const payload = await response.json().catch(() => ({}));
                    if (!Array.isArray(payload?.threads)) return;

                    const currentActiveId = activeChatId;
                    saveConsultationChatThreads(payload.threads);

                    if (currentActiveId && getConsultationChatThreads().some((thread) => thread.id === currentActiveId)) {
                        activeChatId = currentActiveId;
                    } else {
                        activeChatId = getConsultationChatThreads()[0]?.id || null;
                    }

                    renderConsultantChat();
                } catch (error) {
                }
            };
            const broadcastConsultationThreadSync = (consultationId) => {
                try {
                    localStorage.setItem(consultationSyncStorageKey, JSON.stringify({
                        consultationId,
                        at: Date.now(),
                        sender: 'consultant',
                    }));
                } catch (error) {
                }
            };

            async function updateAppointmentOnServer(appointmentId, payload) {
                const response = await fetch(`${appointmentUpdateRoute}/${appointmentId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': @json(csrf_token()),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload || {}),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(data?.message || 'Unable to update the appointment.');
                }

                return data;
            }

            function applyConsultationRequestFilters() {
                const searchEl = document.getElementById('consultRequestSearch');
                const statusEl = document.getElementById('consultRequestStatus');
                const typeEl = document.getElementById('consultRequestType');
                const rows = Array.from(document.querySelectorAll('#consultation-requests-page tbody tr'));
                const search = searchEl ? searchEl.value.trim().toLowerCase() : '';
                const status = statusEl ? statusEl.value.trim().toLowerCase() : '';
                const type = typeEl ? typeEl.value.trim().toLowerCase() : '';
                rows.forEach(function (row) {
                    const rowText = row.textContent.toLowerCase();
                    const rowType = (row.dataset.requestType || row.children[2]?.textContent || '').trim().toLowerCase();
                    const rowStatus = row.children[4] ? row.children[4].textContent.trim().toLowerCase() : '';
                    let visible = !search || rowText.indexOf(search) !== -1;
                    if (visible && status && status.indexOf('all') !== 0) visible = rowStatus === status;
                    if (visible && type && type.indexOf('all') !== 0) visible = rowType.indexOf(type) !== -1;
                    row.style.display = visible ? '' : 'none';
                });
            }

            function applyAppointmentFilters() {
                const searchEl = document.getElementById('appointmentSearch');
                const statusEl = document.getElementById('appointmentStatus');
                const dateEl = document.getElementById('appointmentDate');
                const rows = Array.from(document.querySelectorAll('#appointments-page tbody tr'));
                const search = searchEl ? searchEl.value.trim().toLowerCase() : '';
                const status = statusEl ? statusEl.value.trim().toLowerCase() : '';
                const date = dateEl ? dateEl.value.trim() : '';
                rows.forEach(function (row) {
                    const rowText = ((row.dataset.searchBlob || '') + ' ' + row.textContent).toLowerCase();
                    const rowStatus = String(row.dataset.appointmentStatus || '').trim().toLowerCase();
                    const rowDate = String(row.dataset.appointmentDate || row.children[0]?.textContent || '').trim();
                    let visible = !search || rowText.indexOf(search) !== -1;
                    if (visible && status && status.indexOf('all') !== 0) visible = rowStatus === status;
                    if (visible && date) visible = rowDate === date;
                    row.style.display = visible ? '' : 'none';
                });
            }

            function applyCustomerInsightFilters() {
                const searchEl = document.getElementById('customerInsightSearch');
                const zodiacEl = document.getElementById('customerInsightZodiac');
                const emptyState = document.getElementById('customerInsightsEmpty');
                const cards = Array.from(document.querySelectorAll('#customerInsightsStack [data-customer-insight-card]'));
                const search = searchEl ? searchEl.value.trim().toLowerCase() : '';
                const zodiac = zodiacEl ? zodiacEl.value.trim().toLowerCase() : '';
                let visibleCount = 0;

                cards.forEach(function (card) {
                    const blob = String(card.dataset.searchBlob || '').toLowerCase();
                    const cardZodiac = String(card.dataset.zodiacKey || '').trim().toLowerCase();
                    let visible = !search || blob.indexOf(search) !== -1;
                    if (visible && zodiac) visible = cardZodiac === zodiac;
                    card.style.display = visible ? '' : 'none';
                    if (visible) visibleCount++;
                });

                if (emptyState) {
                    emptyState.style.display = visibleCount === 0 ? '' : 'none';
                }
            }

            function renderConsultantChatLegacy() {
                const threads = getConsultationChatThreads();
                const activeThread = threads.find(function (thread) { return thread.id === activeChatId; }) || threads[0];
                if (!consultantChatContacts || !consultantChatTitle || !consultantChatMeta || !consultantChatMessages) return;

                if (!activeThread) {
                    consultantChatContacts.innerHTML = '<div class="chat-thread"><strong>No active chats</strong><span>Customer conversations will appear here after a consultation starts.</span></div>';
                    consultantChatTitle.textContent = 'Customer Consultation Chat';
                    consultantChatMeta.textContent = 'Customer and consultant thread';
                    consultantChatMessages.innerHTML = '<div class="chat-thread"><strong>No messages yet</strong><span>Open an assigned consultation to start replying.</span></div>';
                    if (consultantChatInput) {
                        consultantChatInput.disabled = true;
                        consultantChatInput.placeholder = 'Select an assigned consultation chat to reply.';
                    }
                    if (consultantChatSend) consultantChatSend.disabled = true;
                    return;
                }

                activeChatId = activeThread.id;
                consultantChatContacts.innerHTML = threads.map(function (thread) {
                    return '<button class="chat-contact-btn ' + (thread.id === activeChatId ? 'active' : '') + '" type="button" data-chat-id="' + escapeHtml(thread.id) + '"><strong>' + escapeHtml(thread.requestId || thread.customerName || 'Consultation') + '</strong><span style="display:block;font-weight:700;color:#3f3125;margin-bottom:4px;">' + escapeHtml(thread.customerName || 'Customer') + ' / ' + escapeHtml(thread.consultantName || 'Consultant Team') + '</span><span>' + escapeHtml(getConsultationThreadPreview(thread)) + '</span></button>';
                }).join('');

                consultantChatTitle.textContent = buildConsultantChatTitle(activeThread);
                consultantChatMeta.textContent = buildConsultationThreadMeta(activeThread);
                consultantChatMessages.innerHTML = activeThread.messages.map(function (message) {
                    const wrap = document.createElement('div');
                    wrap.className = 'chat-bubble-wrap' + (message.sender === 'Consultant' ? ' consultant' : '');
                    const bubble = document.createElement('div');
                    bubble.className = 'chat-bubble';
                    bubble.innerHTML = '<small>' + message.sender + ' • ' + message.time + '</small><div>' + message.text + '</div>';
                    wrap.appendChild(bubble);
                    messages.appendChild(wrap);
                });
            }

            function renderConsultantChat() {
                const threads = getConsultationChatThreads();
                const activeThread = threads.find(function (thread) { return thread.id === activeChatId; }) || threads[0];
                if (!consultantChatContacts || !consultantChatTitle || !consultantChatMeta || !consultantChatMessages) return;

                if (!activeThread) {
                    consultantChatContacts.innerHTML = '<div class="chat-thread"><strong>No active chats</strong><span>Customer conversations will appear here after a consultation starts.</span></div>';
                    consultantChatTitle.textContent = 'Customer Consultation Chat';
                    consultantChatMeta.textContent = 'Customer and consultant thread';
                    consultantChatMessages.innerHTML = '<div class="chat-thread"><strong>No messages yet</strong><span>Open a consultation thread to start replying.</span></div>';
                    return;
                }

                activeChatId = activeThread.id;
                consultantChatContacts.innerHTML = threads.map(function (thread) {
                    return '<button class="chat-contact-btn ' + (thread.id === activeChatId ? 'active' : '') + '" type="button" data-chat-id="' + escapeHtml(thread.id) + '"><strong>' + escapeHtml(thread.customerName || 'Customer') + '</strong><span>' + escapeHtml(thread.requestId || 'Consultation') + '</span><span>' + escapeHtml(getConsultationThreadPreview(thread)) + '</span></button>';
                }).join('');

                consultantChatTitle.textContent = 'Chat with ' + (activeThread.customerName || 'Customer');
                consultantChatMeta.textContent = buildConsultationThreadMeta(activeThread);
                const canReply = Boolean(activeThread.canReply);
                if (consultantChatInput) {
                    consultantChatInput.disabled = !canReply;
                    consultantChatInput.placeholder = canReply
                        ? 'Type consultant reply, guidance, or follow-up note here...'
                        : 'This request is waiting for admin approval and assignment.';
                }
                if (consultantChatComplete) consultantChatComplete.disabled = !canReply;
                if (consultantChatSend) consultantChatSend.disabled = !canReply;
                consultantChatMessages.innerHTML = activeThread.messages.length
                    ? activeThread.messages.map(function (message) {
                        return '<div class="chat-bubble-wrap' + (message.sender === 'Consultant' ? ' consultant' : '') + '"><div class="chat-bubble"><small>' + escapeHtml(message.sender) + ' • ' + escapeHtml(message.time) + '</small><div>' + escapeHtml(message.text) + '</div>' + renderConsultationMessageMedia(message) + '</div></div>';
                    }).join('')
                    : '<div class="chat-thread"><strong>This chat is ready</strong><span>Either the customer or the consultant can send the first message.</span></div>';
                consultantChatMessages.scrollTop = consultantChatMessages.scrollHeight;

                consultantChatContacts.querySelectorAll('[data-chat-id]').forEach(function (button) {
                    button.addEventListener('click', function () {
                        activeChatId = button.dataset.chatId || null;
                        renderConsultantChat();
                    });
                });
            }

            function showPage() {
                const hash = window.location.hash;
                const matched = routeMap[hash];
                document.querySelectorAll('.sidebar .menu-link').forEach(function (link) {
                    link.classList.toggle('active', link.getAttribute('href') === (hash || '#dashboard'));
                });
                pages.forEach(function (page) {
                    page.classList.toggle('active', !!matched && ('#' + page.id) === hash);
                });
                defaultSections.forEach(function (section) {
                    section.style.display = matched ? 'none' : '';
                });
                if (breadcrumbLeaf) breadcrumbLeaf.textContent = matched || 'Dashboard';
            }

            window.addEventListener('hashchange', showPage);
            showPage();
            renderConsultantChat();
            syncConsultationThreadsFromServer();
            setInterval(syncConsultationThreadsFromServer, 7000);
            applyConsultationRequestFilters();
            applyAppointmentFilters();

            const consultRequestSearch = document.getElementById('consultRequestSearch');
            const consultRequestStatus = document.getElementById('consultRequestStatus');
            const consultRequestType = document.getElementById('consultRequestType');
            const appointmentSearch = document.getElementById('appointmentSearch');
            const appointmentStatus = document.getElementById('appointmentStatus');
            const appointmentDate = document.getElementById('appointmentDate');
            if (consultRequestSearch) consultRequestSearch.addEventListener('input', applyConsultationRequestFilters);
            if (consultRequestStatus) consultRequestStatus.addEventListener('change', applyConsultationRequestFilters);
            if (consultRequestType) consultRequestType.addEventListener('change', applyConsultationRequestFilters);
            if (appointmentSearch) appointmentSearch.addEventListener('input', applyAppointmentFilters);
            if (appointmentStatus) appointmentStatus.addEventListener('change', applyAppointmentFilters);
            if (appointmentDate) appointmentDate.addEventListener('change', applyAppointmentFilters);
            const customerInsightSearch = document.getElementById('customerInsightSearch');
            const customerInsightZodiac = document.getElementById('customerInsightZodiac');
            if (customerInsightSearch) customerInsightSearch.addEventListener('input', applyCustomerInsightFilters);
            if (customerInsightZodiac) customerInsightZodiac.addEventListener('change', applyCustomerInsightFilters);
            applyCustomerInsightFilters();

            const consultantProfileImage = document.getElementById('consultantProfileImage');
            const consultantProfileImageForm = document.getElementById('consultantProfileImageForm');
            const consultantProfilePreviewBox = document.getElementById('consultantProfilePreviewBox');
            const consultantProfilePreviewImage = document.getElementById('consultantProfilePreviewImage');
            const consultantProfileForm = document.getElementById('consultantProfileForm');
            const consultantProfileSuccessMessage = document.getElementById('consultantProfileSuccessMessage');
            const consultantProfileFullName = document.getElementById('consultantProfileFullName');
            const consultantProfileEmail = document.getElementById('consultantProfileEmail');
            const consultantProfilePhone = document.getElementById('consultantProfilePhone');
            if (consultantProfileImage && consultantProfilePreviewBox && consultantProfilePreviewImage) {
                consultantProfileImage.addEventListener('change', function () {
                    const file = consultantProfileImage.files && consultantProfileImage.files[0];
                    if (!file) {
                        consultantProfilePreviewImage.removeAttribute('src');
                        consultantProfilePreviewBox.classList.remove('has-image');
                        return;
                    }
                    consultantProfilePreviewImage.src = URL.createObjectURL(file);
                    consultantProfilePreviewBox.classList.add('has-image');
                    if (consultantProfileImageForm) {
                        consultantProfileImageForm.submit();
                    }
                });
            }

            if (consultantProfileForm) {
                consultantProfileForm.addEventListener('submit', function (event) {
                    let hasError = false;

                    if (!consultantProfileFullName || consultantProfileFullName.value.trim().length < 3) {
                        hasError = true;
                    }

                    if (!consultantProfileEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(consultantProfileEmail.value.trim())) {
                        hasError = true;
                    }

                    if (!consultantProfilePhone || consultantProfilePhone.value.trim().replace(/\D/g, '').length < 10) {
                        hasError = true;
                    }

                    if (hasError) {
                        event.preventDefault();
                        if (consultantProfileSuccessMessage) consultantProfileSuccessMessage.classList.remove('show');
                        notify('Please enter valid profile details');
                        return;
                    }
                });
            }

            if (consultantChatSend) {
                consultantChatSend.addEventListener('click', function () {
                    if (!consultantChatInput) return;
                    const text = consultantChatInput.value.trim();
                    if (!text) return;
                    const threads = getConsultationChatThreads();
                    const activeThread = threads.find(function (thread) { return thread.id === activeChatId; });
                    if (!activeThread) return;
                    if (!activeThread.canReply || !activeThread.consultationId) return;
                    const formData = new FormData();
                    formData.append('message', text);
                    const imageFile = consultantChatImage?.files?.[0] || null;
                    if (imageFile) {
                        formData.append('image', imageFile);
                    }
                    fetch(`${consultationMessageStoreRoute}/${activeThread.consultationId}/messages`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': @json(csrf_token()),
                            'Accept': 'application/json',
                        },
                        body: formData,
                    })
                        .then((response) => response.json().then((data) => ({ response, data })))
                        .then(({ response, data }) => {
                            if (!response.ok) {
                                throw new Error(data?.message || 'Unable to send the message.');
                            }
                            activeThread.messages.push({
                                sender: data?.message?.sender_role === 'consultant' ? 'Consultant' : 'Customer',
                                text: data?.message?.text || text,
                                time: data?.message?.time || formatChatTime(),
                                imageUrl: data?.message?.image_url || null,
                                imagePath: data?.message?.image_path || null,
                            });
                            saveConsultationChatThreads(threads);
                            broadcastConsultationThreadSync(activeThread.consultationId);
                            consultantChatInput.value = '';
                            if (consultantChatImage) consultantChatImage.value = '';
                            renderConsultantChat();
                        })
                        .catch((error) => alert(error.message || 'Unable to send the message.'));
                });
            }

            if (consultantChatComplete) {
                consultantChatComplete.addEventListener('click', function () {
                    const threads = getConsultationChatThreads();
                    const activeThread = threads.find(function (thread) { return thread.id === activeChatId; });
                    if (!activeThread || !activeThread.canReply || !activeThread.consultationId) return;
                    if (!window.confirm('Mark this consultation as completed and close the chat?')) return;

                    updateConsultationRequestOnServer(activeThread.consultationId, { action: 'complete' })
                        .then(() => syncConsultationThreadsFromServer())
                        .then(() => {
                            if (consultantChatInput) consultantChatInput.value = '';
                        })
                        .catch((error) => alert(error.message || 'Unable to complete the consultation.'));
                });
            }

            window.addEventListener('storage', function (event) {
                if (event.key === consultationSyncStorageKey) {
                    syncConsultationThreadsFromServer();
                }
            });

            if (consultantViewModalClose) consultantViewModalClose.addEventListener('click', closeConsultantViewModal);
            if (consultantViewModalOk) consultantViewModalOk.addEventListener('click', closeConsultantViewModal);
            if (consultantViewModal) {
                consultantViewModal.addEventListener('click', function (event) {
                    if (event.target === consultantViewModal) closeConsultantViewModal();
                });
            }

            document.addEventListener('click', function (event) {
                const button = event.target.closest('button');
                if (!button) return;
                const label = button.textContent.trim();
                const requestRow = button.closest('#consultation-requests-page tbody tr');
                const appointmentRow = button.closest('#appointments-page tbody tr');
                if (appointmentRow) {
                    const appointmentId = appointmentRow.dataset.appointmentId || '';
                    if (!appointmentId) return;
                    if (label === 'Propose Reschedule') {
                        openConsultantRescheduleModal(appointmentRow);
                        return;
                    }
                    if (label === 'Confirm') {
                        updateAppointmentOnServer(appointmentId, { action: 'confirm' })
                            .then(() => window.location.reload())
                            .catch((error) => alert(error.message || 'Unable to confirm the appointment.'));
                        return;
                    }
                    if (label === 'Complete') {
                        updateAppointmentOnServer(appointmentId, { action: 'complete' })
                            .then(() => window.location.reload())
                            .catch((error) => alert(error.message || 'Unable to complete the appointment.'));
                        return;
                    }
                    if (label === 'Cancel') {
                        if (!window.confirm('Cancel this appointment?')) return;
                        updateAppointmentOnServer(appointmentId, { action: 'cancel' })
                            .then(() => window.location.reload())
                            .catch((error) => alert(error.message || 'Unable to cancel the appointment.'));
                        return;
                    }
                }
                if (!requestRow) return;
                const consultationId = requestRow.dataset.consultationId || '';
                if (!consultationId) return;

                if (label === 'View') {
                    openConsultantViewModal('Consultation Request Details - ' + (requestRow.dataset.requestId || ''), [
                        { label: 'Request ID', value: requestRow.dataset.requestId || '' },
                        { label: 'Customer Name', value: requestRow.dataset.customerName || '' },
                        { label: 'Request Type', value: requestRow.dataset.requestType || '' },
                        { label: 'Submitted On', value: requestRow.dataset.submittedOn || '' },
                        { label: 'Status', value: requestRow.dataset.status || '' },
                        { label: 'Customer Note', value: requestRow.dataset.customerNote || 'Customer is requesting expert guidance before confirming the next step.' },
                        { label: 'Assigned Consultant', value: requestRow.dataset.assignedConsultant || consultantDisplayName },
                        { label: 'Chat Access', value: requestRow.dataset.consultantId ? 'Assigned' : 'Waiting for assignment' }
                    ]);
                    return;
                }
                if (label === 'Open Chat') {
                    const chatThreadId = requestRow.dataset.chatThreadId || '';
                    if (!requestRow.dataset.consultantId) {
                        alert('This consultation is waiting for admin assignment.');
                        return;
                    }
                    if (chatThreadId) {
                        activeChatId = chatThreadId;
                    }
                    window.location.hash = '#chat-page';
                    renderConsultantChat();
                    return;
                }
            });

            if (consultantRescheduleClose) consultantRescheduleClose.addEventListener('click', closeConsultantRescheduleModal);
            if (consultantRescheduleCancel) consultantRescheduleCancel.addEventListener('click', closeConsultantRescheduleModal);
            if (consultantRescheduleDate) {
                consultantRescheduleDate.addEventListener('change', renderConsultantRescheduleTimeOptions);
                consultantRescheduleDate.addEventListener('input', renderConsultantRescheduleTimeOptions);
            }
            if (consultantRescheduleSave) {
                consultantRescheduleSave.addEventListener('click', function () {
                    if (!activeAppointmentRow || !consultantRescheduleDate || !consultantRescheduleTime) return;
                    const newDate = consultantRescheduleDate.value.trim();
                    const newTime = consultantRescheduleTime.value.trim();
                    if (!newDate || !newTime) return;
                    const appointmentId = activeAppointmentRow.dataset.appointmentId || '';
                    if (!appointmentId) return;
                    updateAppointmentOnServer(appointmentId, {
                        action: 'request-reschedule',
                        preferred_date: newDate,
                        preferred_time: newTime,
                        reschedule_note: consultantRescheduleNote ? consultantRescheduleNote.value.trim() : '',
                    })
                        .then(() => window.location.reload())
                        .catch((error) => alert(error.message || 'Unable to reschedule the appointment.'));
                });
            }
            if (consultantRescheduleModal) {
                consultantRescheduleModal.addEventListener('click', function (event) {
                    if (event.target === consultantRescheduleModal) closeConsultantRescheduleModal();
                });
            }

            if (profileWrap && profileToggle) {
                profileToggle.addEventListener('click', function (event) {
                    event.stopPropagation();
                    const isOpen = profileWrap.classList.toggle('open');
                    profileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
                document.addEventListener('click', function (event) {
                    if (!profileWrap.contains(event.target)) {
                        profileWrap.classList.remove('open');
                        profileToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            renderConsultantChat();

            function autoHideSuccessFeedback(selector, delay) {
                document.querySelectorAll(selector).forEach(function (node) {
                    window.setTimeout(function () {
                        node.style.transition = 'opacity 220ms ease, transform 220ms ease';
                        node.style.opacity = '0';
                        node.style.transform = 'translateY(-4px)';
                        window.setTimeout(function () {
                            node.style.display = 'none';
                        }, 240);
                    }, delay);
                });
            }

            autoHideSuccessFeedback('.profile-feedback.success.show, .dashboard-profile-feedback.success.show', 3200);
        })();
    </script>
</body>
</html>
