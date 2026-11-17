<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard | Pinwantha Gems & Jewellery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root{--nav:92px;--side:288px;--text:#2e241a;--muted:#75624f;--line:#ead9c1;--panel:#fffaf3;--gold:#b98945;--gold2:#94652c;--bg1:#fbf5ec;--bg2:#f0e3d1;--shadow:0 22px 54px rgba(71,48,22,.12)}
        *{box-sizing:border-box} html{scroll-behavior:smooth} body{margin:0;font-family:"Manrope",sans-serif;color:var(--text);background:radial-gradient(circle at top left,rgba(185,137,69,.18),transparent 24%),radial-gradient(circle at top right,rgba(45,109,98,.12),transparent 22%),linear-gradient(180deg,var(--bg1),var(--bg2))}
        a{text-decoration:none;color:inherit} .app{min-height:100vh;overflow-x:hidden}.topbar{position:fixed;inset:0 0 auto 0;min-height:var(--nav);display:flex;align-items:center;justify-content:space-between;gap:18px;padding:6px 24px;background:rgba(255,255,255,.95);backdrop-filter:blur(16px);border-bottom:1px solid rgba(185,137,69,.18);box-shadow:0 12px 30px rgba(71,48,22,.08);z-index:1000}
        .left,.right,.brand,.profile-btn{display:flex;align-items:center;gap:14px}.mini-icon,.avatar{display:grid;place-items:center}
        .brand{align-items:center;gap:0}.brand-logo{display:block;width:56px;height:56px;object-fit:contain}.brand small{display:block;font-size:.72rem;letter-spacing:.15em;text-transform:uppercase;color:var(--muted)} .brand strong{display:block;font-family:"Cormorant Garamond",serif;font-size:1.65rem;line-height:1.02}
        .search{flex:1;max-width:560px;position:relative}.search i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#8e7357}.search input{width:100%;height:42px;border-radius:16px;border:1px solid var(--line);background:rgba(255,255,255,.92);padding:0 16px 0 44px;outline:none;box-shadow:0 10px 22px rgba(84,61,35,.06)}
        .profile-wrap{position:relative}.profile-btn{padding:7px 12px 7px 7px;border:1px solid var(--line);border-radius:18px;background:rgba(255,255,255,.92);cursor:pointer;box-shadow:0 10px 22px rgba(84,61,35,.06)}.avatar{width:42px;height:42px;border-radius:14px;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:800;overflow:hidden}.avatar img{width:100%;height:100%;object-fit:cover;display:block}.profile-meta span{display:block;font-size:.82rem;color:var(--muted)} .caret{font-size:.8rem;color:var(--muted)}
        .profile-menu{position:absolute;top:calc(100% + 10px);right:0;width:220px;padding:8px;background:#fff;border:1px solid var(--line);border-radius:18px;box-shadow:var(--shadow);display:none}.profile-wrap.open .profile-menu{display:block}
        .profile-link,.profile-menu button{width:100%;display:flex;align-items:center;gap:10px;padding:12px 14px;border:0;background:transparent;border-radius:12px;font:inherit;text-align:left;cursor:pointer;color:var(--text)}
        .body{display:flex;padding-top:var(--nav)} .sidebar{position:fixed;top:var(--nav);left:0;bottom:0;width:var(--side);overflow:auto;padding:22px 16px 28px;background:
        radial-gradient(circle at top left,rgba(215,161,86,.16),transparent 22%),
        radial-gradient(circle at bottom right,rgba(255,255,255,.06),transparent 18%),
        linear-gradient(180deg,#3f2c1e 0%,#261a12 48%,#1b130d 100%);color:#f6ead6;box-shadow:18px 0 40px rgba(19,14,10,.22)}
        .side-label{margin:6px 6px 14px;padding:0 8px;color:rgba(246,234,214,.54);font-size:.72rem;font-weight:700;letter-spacing:.22em;text-transform:uppercase}.menu,.submenu{list-style:none;padding:0;margin:0}.item+.item{margin-top:10px}
        .menu-link,.menu-toggle{width:100%;display:flex;align-items:center;justify-content:space-between;gap:12px;padding:14px 14px 14px 12px;border:1px solid rgba(255,255,255,.04);border-radius:22px;background:linear-gradient(180deg,rgba(255,255,255,.05),rgba(255,255,255,.025));color:inherit;font:inherit;cursor:pointer;transition:transform .18s ease,background .18s ease,border-color .18s ease,box-shadow .18s ease}
        .menu-link:hover,.menu-toggle:hover{transform:translateX(2px);background:linear-gradient(180deg,rgba(255,255,255,.09),rgba(255,255,255,.04));border-color:rgba(247,217,165,.14);box-shadow:0 12px 24px rgba(13,8,5,.18)}
        .menu-link.active,.menu-toggle.active{background:linear-gradient(135deg,rgba(255,255,255,.12),rgba(215,161,86,.12));border-color:rgba(247,217,165,.2);box-shadow:inset 0 1px 0 rgba(255,255,255,.05),0 16px 30px rgba(16,10,6,.22)}
        .menu-main{display:flex;align-items:center;gap:12px;min-width:0}.mini-icon{width:42px;height:42px;border-radius:15px;background:linear-gradient(180deg,rgba(255,255,255,.08),rgba(255,255,255,.03));border:1px solid rgba(255,255,255,.05);color:#f7d9a5;box-shadow:inset 0 1px 0 rgba(255,255,255,.03)}
        .menu-meta{display:grid;gap:2px;min-width:0}.menu-meta strong{display:block;font-size:1.02rem;line-height:1.15;letter-spacing:-.01em}.menu-meta span{display:block;font-size:.77rem;line-height:1.3;color:rgba(246,234,214,.55)}
        .menu-toggle > .fa-chevron-down{color:rgba(246,234,214,.78);font-size:.92rem;transition:transform .18s ease,color .18s ease}
        .item.open .menu-toggle > .fa-chevron-down{transform:rotate(180deg);color:#f7d9a5}
        .submenu{display:none;position:relative;margin-top:8px;padding:10px 0 4px 58px}
        .submenu:before{content:"";position:absolute;left:29px;top:8px;bottom:10px;width:1px;background:linear-gradient(180deg,rgba(247,217,165,.22),rgba(247,217,165,0))}
        .item.open .submenu{display:block}
        .submenu a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:16px;color:rgba(246,234,214,.86);transition:background .18s ease,transform .18s ease,color .18s ease}
        .submenu a:hover{transform:translateX(4px);background:rgba(255,255,255,.08);color:#fff}
        .submenu a.active{transform:translateX(4px);background:linear-gradient(135deg,rgba(247,217,165,.16),rgba(255,255,255,.08));color:#fff;box-shadow:inset 0 0 0 1px rgba(247,217,165,.12)}
        .item.has-active-child > .menu-toggle{background:linear-gradient(135deg,rgba(255,255,255,.12),rgba(215,161,86,.12));border-color:rgba(247,217,165,.2);box-shadow:inset 0 1px 0 rgba(255,255,255,.05),0 16px 30px rgba(16,10,6,.22)}
        .item.has-active-child > .menu-toggle .mini-icon,.menu-link.active .mini-icon{background:linear-gradient(135deg,rgba(247,217,165,.22),rgba(255,255,255,.07));color:#ffe7b7}
        .content{flex:1;margin-left:var(--side);padding:24px;min-width:0;overflow-x:hidden}.breadcrumb{display:flex;align-items:center;flex-wrap:wrap;gap:10px;color:var(--muted);font-size:.9rem;margin-bottom:18px}
        .panel,.hero,.metric,.widget,.chart,.table-panel,.alerts,.quick-actions,.activity-panel,.action{background:var(--panel);border:1px solid rgba(185,137,69,.16);border-radius:24px;box-shadow:var(--shadow)}
        .hero{padding:28px;background:radial-gradient(circle at top right,rgba(45,109,98,.18),transparent 28%),linear-gradient(135deg,rgba(255,249,242,.96),rgba(250,239,223,.96))} .hero h1{margin:10px 0 8px;font-family:"Cormorant Garamond",serif;font-size:clamp(2.2rem,4vw,3.7rem);line-height:.96} .hero p{margin:0;color:var(--muted);max-width:780px;line-height:1.7}
        .hero small{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:999px;background:#fff7eb;border:1px solid #ecd7b3;color:var(--gold2);font-weight:700;letter-spacing:.08em;text-transform:uppercase}
        .metrics,.widgets,.charts-grid,.bottom-grid,.two-col,.actions-grid{display:grid;gap:16px}.metrics{grid-template-columns:repeat(4,1fr);margin-top:22px}.widgets{grid-template-columns:repeat(5,1fr);margin-top:22px}.charts-grid{grid-template-columns:1.35fr .95fr;margin-top:22px}.bottom-grid,.two-col{grid-template-columns:1fr 1fr;margin-top:22px}.actions-grid{grid-template-columns:repeat(2,1fr)}
        .metric{padding:18px;color:#fff;position:relative;overflow:hidden;min-height:142px}.metric:after{content:"";position:absolute;width:120px;height:120px;border-radius:50%;top:-34px;right:-24px;background:rgba(255,255,255,.14)} .metric-top{display:flex;align-items:center;justify-content:space-between}.metric-icon{width:40px;height:40px;border-radius:14px;background:rgba(255,255,255,.16);display:grid;place-items:center}.metric-value{margin:22px 0 8px;font-size:1.95rem;font-weight:800}.metric-note{font-size:.84rem;opacity:.9}
        .m1{background:linear-gradient(135deg,#c7984e,#996b2d)}.m2{background:linear-gradient(135deg,#2f6f65,#214c45)}.m3{background:linear-gradient(135deg,#b96f5e,#935445)}.m4{background:linear-gradient(135deg,#54433d,#2f2724)}.m5{background:linear-gradient(135deg,#ab7b37,#855b23)}.m6{background:linear-gradient(135deg,#3f776a,#2c554c)}.m7{background:linear-gradient(135deg,#bc7866,#995443)}.m8{background:linear-gradient(135deg,#5b4a45,#362d2a)}
        .widget,.chart,.table-panel,.alerts,.quick-actions,.activity-panel,.action{padding:18px}.widget span,.section-head span,.activity span{display:block;color:var(--muted);font-size:.84rem}.section-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:16px}.section-head h2,.section-head h3{margin:0;font-size:1.05rem;font-family:"Cormorant Garamond",serif}
        #orders-all-page .table-panel,
        #orders-delivery-page .table-panel,
        #orders-pickup-page .table-panel{overflow-x:auto}
        #orders-all-page .table-panel table,
        #orders-delivery-page .table-panel table,
        #orders-pickup-page .table-panel table{min-width:0;table-layout:fixed}
        #orders-all-page .table-panel th,
        #orders-all-page .table-panel td,
        #orders-delivery-page .table-panel th,
        #orders-delivery-page .table-panel td,
        #orders-pickup-page .table-panel th,
        #orders-pickup-page .table-panel td{
            padding:9px 6px;
            word-break:break-word;
            vertical-align:top;
            font-size:.74rem;
            line-height:1.28;
        }
        #orders-all-page .table-panel th:nth-child(1),
        #orders-all-page .table-panel td:nth-child(1),
        #orders-delivery-page .table-panel th:nth-child(1),
        #orders-delivery-page .table-panel td:nth-child(1),
        #orders-pickup-page .table-panel th:nth-child(1),
        #orders-pickup-page .table-panel td:nth-child(1){width:11%}
        #orders-all-page .table-panel th:nth-child(2),
        #orders-all-page .table-panel td:nth-child(2),
        #orders-delivery-page .table-panel th:nth-child(2),
        #orders-delivery-page .table-panel td:nth-child(2),
        #orders-pickup-page .table-panel th:nth-child(2),
        #orders-pickup-page .table-panel td:nth-child(2){width:10%}
        #orders-all-page .table-panel th:nth-child(3),
        #orders-all-page .table-panel td:nth-child(3),
        #orders-delivery-page .table-panel th:nth-child(3),
        #orders-delivery-page .table-panel td:nth-child(3),
        #orders-pickup-page .table-panel th:nth-child(3),
        #orders-pickup-page .table-panel td:nth-child(3){width:12%}
        #orders-all-page .table-panel th:nth-child(4),
        #orders-all-page .table-panel td:nth-child(4),
        #orders-all-page .table-panel th:nth-child(5),
        #orders-all-page .table-panel td:nth-child(5),
        #orders-all-page .table-panel th:nth-child(6),
        #orders-all-page .table-panel td:nth-child(6),
        #orders-delivery-page .table-panel th:nth-child(4),
        #orders-delivery-page .table-panel td:nth-child(4),
        #orders-delivery-page .table-panel th:nth-child(5),
        #orders-delivery-page .table-panel td:nth-child(5),
        #orders-delivery-page .table-panel th:nth-child(6),
        #orders-delivery-page .table-panel td:nth-child(6),
        #orders-pickup-page .table-panel th:nth-child(4),
        #orders-pickup-page .table-panel td:nth-child(4),
        #orders-pickup-page .table-panel th:nth-child(5),
        #orders-pickup-page .table-panel td:nth-child(5),
        #orders-pickup-page .table-panel th:nth-child(6),
        #orders-pickup-page .table-panel td:nth-child(6){width:8%}
        #orders-all-page .table-panel th:nth-child(7),
        #orders-all-page .table-panel td:nth-child(7),
        #orders-delivery-page .table-panel th:nth-child(7),
        #orders-delivery-page .table-panel td:nth-child(7),
        #orders-pickup-page .table-panel th:nth-child(7),
        #orders-pickup-page .table-panel td:nth-child(7){width:8%}
        #orders-all-page .table-panel th:nth-child(8),
        #orders-all-page .table-panel td:nth-child(8),
        #orders-delivery-page .table-panel th:nth-child(8),
        #orders-delivery-page .table-panel td:nth-child(8),
        #orders-pickup-page .table-panel th:nth-child(8),
        #orders-pickup-page .table-panel td:nth-child(8){width:9%}
        #orders-all-page .table-panel th:nth-child(9),
        #orders-all-page .table-panel td:nth-child(9),
        #orders-delivery-page .table-panel th:nth-child(9),
        #orders-delivery-page .table-panel td:nth-child(9),
        #orders-pickup-page .table-panel th:nth-child(9),
        #orders-pickup-page .table-panel td:nth-child(9){width:9%}
        #orders-all-page .table-panel th:nth-child(10),
        #orders-all-page .table-panel td:nth-child(10),
        #orders-delivery-page .table-panel th:nth-child(10),
        #orders-delivery-page .table-panel td:nth-child(10),
        #orders-pickup-page .table-panel th:nth-child(10),
        #orders-pickup-page .table-panel td:nth-child(10){width:8%}
        #orders-all-page .table-panel th:nth-child(11),
        #orders-all-page .table-panel td:nth-child(11),
        #orders-delivery-page .table-panel th:nth-child(11),
        #orders-delivery-page .table-panel td:nth-child(11),
        #orders-pickup-page .table-panel th:nth-child(11),
        #orders-pickup-page .table-panel td:nth-child(11){width:8%}
        #orders-all-page .table-panel th:nth-child(12),
        #orders-all-page .table-panel td:nth-child(12),
        #orders-delivery-page .table-panel th:nth-child(12),
        #orders-delivery-page .table-panel td:nth-child(12),
        #orders-pickup-page .table-panel th:nth-child(12),
        #orders-pickup-page .table-panel td:nth-child(12){width:11%}
        #orders-all-page .table-panel .actions-inline,
        #orders-delivery-page .table-panel .actions-inline,
        #orders-pickup-page .table-panel .actions-inline{
            grid-template-columns:1fr;
            gap:6px;
            width:100%;
        }
        #orders-all-page .table-panel .actions-inline .mini-btn,
        #orders-delivery-page .table-panel .actions-inline .mini-btn,
        #orders-pickup-page .table-panel .actions-inline .mini-btn{
            width:100%;
            min-width:0;
            flex:0 0 auto;
            padding:0 8px;
            height:30px;
            border-radius:10px;
            font-size:.72rem;
        }
        #orders-all-page .table-panel .status,
        #orders-delivery-page .table-panel .status,
        #orders-pickup-page .table-panel .status{
            width:100%;
            max-width:100%;
            padding:5px 8px;
            font-size:.68rem;
            line-height:1;
            letter-spacing:.02em;
            white-space:normal;
            text-align:center;
            justify-content:center;
            word-break:keep-all;
            overflow-wrap:normal;
        }
        #orders-all-page .table-panel .status.two-line,
        #orders-delivery-page .table-panel .status.two-line,
        #orders-pickup-page .table-panel .status.two-line{
            line-height:1.1;
        }
        #orders-all-page .filter-row{
            display:grid;
            grid-template-columns:minmax(0,1.45fr) 160px 170px 170px 170px auto;
            gap:10px;
            align-items:stretch;
        }
        #orders-all-page .filter-row > *{
            min-width:0;
        }
        #orders-all-page .filter-row > input[type="text"]{
            min-width:0;
        }
        #orders-all-page .filter-row > input[type="date"],
        #orders-all-page .filter-row > select{
            width:100%;
        }
        #orders-all-page .filter-row .report-action-btn{
            justify-self:end;
            width:100%;
            min-width:148px;
        }
        #orders-all-page .filter-row .report-action-btn span{
            white-space:nowrap;
        }
        @media (max-width: 1180px){
            #orders-all-page .filter-row{
                grid-template-columns:minmax(0,1fr) repeat(2,minmax(0,170px));
            }
            #orders-all-page .filter-row .report-action-btn{
                grid-column:1 / -1;
                justify-self:stretch;
            }
        }
        @media (max-width: 760px){
            #orders-all-page .filter-row{
                grid-template-columns:1fr;
            }
            #orders-all-page .filter-row .report-action-btn{
                grid-column:auto;
            }
        }
        .bars{height:250px;display:flex;align-items:flex-end;gap:14px}.bar{flex:1;text-align:center}.track{height:205px;background:rgba(185,137,69,.08);border-radius:18px;padding:10px;display:flex;align-items:flex-end}.fill{width:100%;border-radius:14px;background:linear-gradient(180deg,#dbb06d,#a67334)}.bar.alt .fill{background:linear-gradient(180deg,#5f9b8f,#2c655a)} .bar span{display:block;margin-top:10px;color:var(--muted);font-size:.84rem}
        .donut-wrap{display:grid;place-items:center;min-height:250px}.donut{width:230px;height:230px;border-radius:50%;background:conic-gradient(#d7a156 0 28%,#5c968b 28% 50%,#b86d5b 50% 76%,#8b7169 76% 88%,#dfc89a 88% 100%);position:relative}.donut:after{content:"";position:absolute;inset:42px;background:var(--panel);border-radius:50%}.donut-label{position:absolute;text-align:center;z-index:1}.legend{display:grid;gap:10px;margin-top:18px}.legend div{display:flex;align-items:center;gap:10px;color:var(--muted);font-size:.88rem}.swatch{width:12px;height:12px;border-radius:50%}
        .product-bars{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;align-items:end;height:240px}.product-bar{display:flex;flex-direction:column;gap:10px;align-items:center}.product-bar-fill{width:100%;max-width:86px;border-radius:18px 18px 10px 10px;background:linear-gradient(180deg,#cf9b52,#8d6027)} .product-bar:nth-child(2) .product-bar-fill{background:linear-gradient(180deg,#6ba699,#316a60)} .product-bar:nth-child(3) .product-bar-fill{background:linear-gradient(180deg,#cc826d,#9d5544)} .product-bar:nth-child(4) .product-bar-fill{background:linear-gradient(180deg,#76625d,#433631)}
        table{width:100%;border-collapse:collapse} th,td{text-align:left;padding:14px 10px;border-bottom:1px solid #efdfca;font-size:.9rem} th{color:var(--muted)} .status{display:inline-flex;align-items:center;padding:7px 12px;border-radius:999px;font-size:.8rem;font-weight:700}.ok{background:#e0efe8;color:#266353}.warn{background:#faedd7;color:#936725}.bad{background:#f8dfd8;color:#a04e3e}.info{background:#dfeafb;color:#285b9b}.pickup{background:#efe6fb;color:#65459c}
        .orders-data-table{font-size:.82rem}
        .orders-data-table th,.orders-data-table td{padding:10px 8px}
        .alerts-grid,.activity-list{display:grid;gap:12px}.alert,.activity{padding:14px 16px;border-radius:18px;background:#fffaf3;border:1px solid #efdfca}.a1{background:#fde5dc;color:#8f4335}.a2{background:#faeed8;color:#936928}.a3{background:#e2f0ea;color:#2f695c}.a4{background:#efe6fb;color:#604392}
        .action{display:flex;align-items:center;gap:12px}.action i{width:42px;height:42px;border-radius:14px;display:grid;place-items:center;background:#f5eadc;color:var(--gold2)}
        .module-page{display:none;margin-top:22px}.module-page.active{display:block}
        body.dashboard-shell #dashboardBoundary ~ section.module-page{display:none !important;}
        body.dashboard-shell #dashboardBoundary ~ .module-page{display:none !important;}
        .module-head{padding:22px;margin-bottom:16px;background:var(--panel);border:1px solid rgba(185,137,69,.16);border-radius:24px;box-shadow:var(--shadow)}
        .module-head h2{margin:0 0 8px;font-family:"Cormorant Garamond",serif;font-size:2rem}
        .module-head p{margin:0;color:var(--muted)}
        .filter-row{display:grid;grid-template-columns:1.2fr repeat(4,auto);gap:10px;align-items:center;margin-bottom:16px}
        .filter-row input,.filter-row select{height:42px;padding:0 12px;border-radius:12px;border:1px solid var(--line);background:#fff}
        .search input:focus,.search input:focus-visible,
        .filter-row input:focus,.filter-row select:focus,.filter-row input:focus-visible,.filter-row select:focus-visible,
        input:not([type="checkbox"]):not([type="radio"]):not([type="range"]):focus,
        input:not([type="checkbox"]):not([type="radio"]):not([type="range"]):focus-visible,
        select:focus,select:focus-visible,textarea:focus,textarea:focus-visible,
        .module-page input:not([type="checkbox"]):not([type="radio"]):not([type="range"]):focus,
        .module-page input:not([type="checkbox"]):not([type="radio"]):not([type="range"]):focus-visible,
        .module-page select:focus,.module-page select:focus-visible,
        .module-page textarea:focus,.module-page textarea:focus-visible,
        .dashboard-profile-grid .field input:focus,.dashboard-profile-grid .field textarea:focus,
        .dashboard-profile-grid .field input:focus-visible,.dashboard-profile-grid .field textarea:focus-visible,
        .dashboard-profile-grid .field select:focus,.dashboard-profile-grid .field select:focus-visible{
            outline:none;
            border-color:#b98945;
            box-shadow:0 0 0 5px rgba(185,137,69,.22);
            caret-color:#7b5d33;
        }
        .btn{
            height:42px;
            padding:0 14px;
            border-radius:12px;
            border:1px solid var(--line);
            background:#fff;
            cursor:pointer;
            font-weight:600;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            white-space:nowrap;
            min-width:128px;
        }
        .btn.primary{background:linear-gradient(135deg,#c7984e,#996b2d);color:#fff;border:0}
        .btn.theme{background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;border:0}
        .report-actions{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
            justify-content:flex-end;
            grid-column:1/-1;
        }
        .report-action-btn{
            min-width:128px;
            gap:8px;
            border:0;
            background:linear-gradient(135deg,#c5a067,#9f7740);
            color:#fff;
            box-shadow:0 12px 24px rgba(124,89,42,.18);
        }
        .report-action-btn:hover{
            transform:translateY(-1px);
            box-shadow:0 16px 28px rgba(124,89,42,.22);
        }
        #content-faq-page .filter-row .btn{
            min-width:0;
            width:100%;
            height:46px;
            padding:0 18px;
            border-radius:15px;
            border:1px solid #ead7bd;
            background:linear-gradient(180deg,#fffdf8,#f7efe0);
            color:#5a452f;
            box-shadow:0 10px 22px rgba(84,61,35,.08);
        }
        #content-faq-page .filter-row .btn.theme{
            min-width:0;
            width:100%;
            border:0;
            background:linear-gradient(135deg,#c5a067,#9f7740);
            color:#fff;
            box-shadow:0 12px 24px rgba(34,72,65,.18);
        }
        #content-faq-page .filter-row .btn:hover{
            transform:translateY(-1px);
            box-shadow:0 14px 26px rgba(84,61,35,.12);
        }
        #content-faq-page .filter-row .btn.theme:hover{
            box-shadow:0 16px 28px rgba(124,89,42,.24);
        }
        #content-faq-page .filter-row{
            grid-template-columns:repeat(2,minmax(0,1fr));
            align-items:stretch;
        }
        #content-faq-page .filter-row > .btn,
        #content-faq-page .filter-row > .btn.theme{
            min-width:0;
        }
        #content-blogs-page .module-head > div,
        #content-news-page .module-head > div{
            display:flex;
            flex-wrap:wrap;
            gap:10px;
            margin-top:14px;
        }
        #content-blogs-page .module-head .btn,
        #content-blogs-page .module-head .btn-soft,
        #content-news-page .module-head .btn,
        #content-news-page .module-head .btn-soft,
        #content-blogs-page .table-panel .filter-row .btn-soft,
        #content-news-page .table-panel .filter-row .btn-soft{
            min-width:210px;
            height:46px;
            padding:0 18px;
            border-radius:15px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            white-space:nowrap;
        }
        #content-blogs-page .module-head .btn.theme,
        #content-news-page .module-head .btn.theme,
        #content-blogs-page .table-panel .filter-row .btn-soft,
        #content-news-page .table-panel .filter-row .btn-soft{
            border:0;
            background:linear-gradient(135deg,#c5a067,#9f7740);
            color:#fff;
            box-shadow:0 12px 24px rgba(124,89,42,.18);
        }
        #content-blogs-page .module-head .btn,
        #content-news-page .module-head .btn{
            border:1px solid #ead7bd;
            background:linear-gradient(180deg,#fffdf8,#f7efe0);
            color:#5a452f;
            box-shadow:0 10px 22px rgba(84,61,35,.08);
        }
        #content-blogs-page .module-head .btn:hover,
        #content-blogs-page .module-head .btn-soft:hover,
        #content-news-page .module-head .btn:hover,
        #content-news-page .module-head .btn-soft:hover,
        #content-blogs-page .table-panel .filter-row .btn-soft:hover,
        #content-news-page .table-panel .filter-row .btn-soft:hover{
            transform:translateY(-1px);
        }
        #content-blogs-page .actions-inline .mini-btn,
        #content-news-page .actions-inline .mini-btn,
        #content-faq-page .actions-inline .mini-btn{
            min-width:0;
            width:100%;
            height:34px;
            padding:0 10px;
            border-radius:11px;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            white-space:normal;
            overflow-wrap:anywhere;
            font-size:.78rem;
        }
        #content-blogs-page .actions-inline,
        #content-news-page .actions-inline,
        #content-faq-page .actions-inline{
            grid-template-columns:1fr;
            gap:6px;
            width:100%;
        }
        #content-blogs-page td:last-child,
        #content-news-page td:last-child,
        #content-faq-page td:last-child{
            min-width:150px;
            vertical-align:top;
        }
        #custom-requests-page .actions-inline,
        #custom-pending-page .actions-inline,
        #custom-quotations-page .actions-inline,
        #custom-paid-page .actions-inline{
            grid-template-columns:1fr;
            gap:6px;
            width:100%;
        }
        #custom-requests-page .actions-inline .mini-btn,
        #custom-pending-page .actions-inline .mini-btn,
        #custom-quotations-page .actions-inline .mini-btn,
        #custom-paid-page .actions-inline .mini-btn{
            min-height:34px;
            height:auto;
            padding:6px 10px;
            line-height:1.15;
            white-space:normal;
            overflow-wrap:anywhere;
            font-size:.78rem;
        }
        #custom-requests-page td:last-child,
        #custom-pending-page td:last-child,
        #custom-quotations-page td:last-child,
        #custom-paid-page td:last-child{
            min-width:180px;
            vertical-align:top;
        }
        #custom-requests-page .table-panel,
        #custom-pending-page .table-panel,
        #custom-quotations-page .table-panel,
        #custom-paid-page .table-panel{
            overflow-x:auto;
        }
        #custom-requests-page .table-panel table,
        #custom-pending-page .table-panel table,
        #custom-quotations-page .table-panel table,
        #custom-paid-page .table-panel table{
            width:100%;
            min-width:0;
            table-layout:fixed;
            font-size:.78rem;
        }
        #custom-requests-page .table-panel th,
        #custom-pending-page .table-panel th,
        #custom-quotations-page .table-panel th,
        #custom-paid-page .table-panel th,
        #custom-requests-page .table-panel td,
        #custom-pending-page .table-panel td,
        #custom-quotations-page .table-panel td,
        #custom-paid-page .table-panel td{
            padding:10px 8px;
            line-height:1.35;
        }
        #custom-requests-page th:nth-child(1), #custom-requests-page td:nth-child(1),
        #custom-pending-page th:nth-child(1), #custom-pending-page td:nth-child(1),
        #custom-quotations-page th:nth-child(1), #custom-quotations-page td:nth-child(1),
        #custom-paid-page th:nth-child(1), #custom-paid-page td:nth-child(1){width:10%}
        #custom-requests-page th:nth-child(2), #custom-requests-page td:nth-child(2),
        #custom-pending-page th:nth-child(2), #custom-pending-page td:nth-child(2),
        #custom-quotations-page th:nth-child(2), #custom-quotations-page td:nth-child(2),
        #custom-paid-page th:nth-child(2), #custom-paid-page td:nth-child(2){width:12%}
        #custom-requests-page th:nth-child(3), #custom-requests-page td:nth-child(3),
        #custom-pending-page th:nth-child(3), #custom-pending-page td:nth-child(3),
        #custom-quotations-page th:nth-child(3), #custom-quotations-page td:nth-child(3),
        #custom-paid-page th:nth-child(3), #custom-paid-page td:nth-child(3){width:10%}
        #custom-requests-page th:nth-child(4), #custom-requests-page td:nth-child(4),
        #custom-pending-page th:nth-child(4), #custom-pending-page td:nth-child(4),
        #custom-quotations-page th:nth-child(4), #custom-quotations-page td:nth-child(4),
        #custom-paid-page th:nth-child(4), #custom-paid-page td:nth-child(4){width:8%}
        #custom-requests-page th:nth-child(5), #custom-requests-page td:nth-child(5),
        #custom-pending-page th:nth-child(5), #custom-pending-page td:nth-child(5),
        #custom-quotations-page th:nth-child(5), #custom-quotations-page td:nth-child(5),
        #custom-paid-page th:nth-child(5), #custom-paid-page td:nth-child(5){width:7%}
        #custom-requests-page th:nth-child(6), #custom-requests-page td:nth-child(6),
        #custom-pending-page th:nth-child(6), #custom-pending-page td:nth-child(6),
        #custom-quotations-page th:nth-child(6), #custom-quotations-page td:nth-child(6),
        #custom-paid-page th:nth-child(6), #custom-paid-page td:nth-child(6){width:9%}
        #custom-requests-page th:nth-child(7), #custom-requests-page td:nth-child(7),
        #custom-pending-page th:nth-child(7), #custom-pending-page td:nth-child(7),
        #custom-quotations-page th:nth-child(7), #custom-quotations-page td:nth-child(7),
        #custom-paid-page th:nth-child(7), #custom-paid-page td:nth-child(7){width:8%}
        #custom-requests-page th:nth-child(8), #custom-requests-page td:nth-child(8),
        #custom-pending-page th:nth-child(8), #custom-pending-page td:nth-child(8),
        #custom-quotations-page th:nth-child(8), #custom-quotations-page td:nth-child(8),
        #custom-paid-page th:nth-child(8), #custom-paid-page td:nth-child(8){width:7%}
        #custom-requests-page th:nth-child(9), #custom-requests-page td:nth-child(9),
        #custom-pending-page th:nth-child(9), #custom-pending-page td:nth-child(9),
        #custom-quotations-page th:nth-child(9), #custom-quotations-page td:nth-child(9),
        #custom-paid-page th:nth-child(9), #custom-paid-page td:nth-child(9){width:9%}
        #custom-requests-page th:nth-child(10), #custom-requests-page td:nth-child(10),
        #custom-pending-page th:nth-child(10), #custom-pending-page td:nth-child(10),
        #custom-quotations-page th:nth-child(10), #custom-quotations-page td:nth-child(10),
        #custom-paid-page th:nth-child(10), #custom-paid-page td:nth-child(10){width:9%}
        #custom-requests-page th:nth-child(11), #custom-requests-page td:nth-child(11),
        #custom-pending-page th:nth-child(11), #custom-pending-page td:nth-child(11),
        #custom-quotations-page th:nth-child(11), #custom-quotations-page td:nth-child(11),
        #custom-paid-page th:nth-child(11), #custom-paid-page td:nth-child(11){
            width:18%;
        }
        #contact-messages-page .actions-inline{
            grid-template-columns:repeat(2, minmax(96px, 1fr));
            gap:6px;
            width:100%;
        }
        #contact-messages-page td:last-child{
            min-width:210px;
            vertical-align:top;
        }
        #contact-messages-page .actions-inline .mini-btn{
            min-width:0;
            width:100%;
            height:36px;
            padding:0 10px;
            font-size:.8rem;
            white-space:normal;
            overflow-wrap:anywhere;
        }
        #notifications-list-page .actions-inline{
            grid-template-columns:1fr;
            gap:8px;
            width:100%;
        }
        #notifications-list-page td:last-child{
            min-width:140px;
            vertical-align:top;
        }
        #notifications-list-page .actions-inline .mini-btn{
            width:100%;
            min-width:0;
            height:40px;
            padding:0 12px;
        }
        .actions-inline{
            display:grid;
            grid-template-columns:repeat(var(--actions-cols, 2), minmax(0, 1fr));
            gap:8px;
            align-items:stretch;
        }
        .actions-inline .mini-btn{
            min-width:0;
            width:100%;
            height:36px;
            padding:0 14px;
            border-radius:11px;
            border:1px solid #e7d3b6;
            background:#fff;
            font-size:.82rem;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-align:center;
            white-space:nowrap;
        }
        .actions-inline a.mini-btn{
            text-decoration:none;
            color:inherit;
            appearance:none;
            -webkit-appearance:none;
        }
        .actions-inline > *{
            min-width:0;
        }
        .actions-inline form{
            display:block;
            width:100%;
            margin:0;
        }
        @media (max-width: 980px){
            #custom-requests-page .actions-inline,
            #custom-pending-page .actions-inline,
            #custom-quotations-page .actions-inline,
            #custom-paid-page .actions-inline{
                grid-template-columns:1fr;
            }
            #custom-requests-page td:last-child,
            #custom-pending-page td:last-child,
            #custom-quotations-page td:last-child,
            #custom-paid-page td:last-child{
                min-width:0;
            }
        }
        #content-gold-price-page .filter-row{
            grid-template-columns:minmax(260px,1.5fr) minmax(180px,.75fr) minmax(170px,.72fr);
            gap:12px;
            padding:2px 0 0;
        }
        #content-gold-price-page .filter-row input,
        #content-gold-price-page .filter-row select{
            height:46px;
            border-radius:15px;
            border:1px solid #ead7bd;
            background:linear-gradient(180deg,#fffdf8,#fbf4e7);
            box-shadow:0 8px 18px rgba(84,61,35,.05);
        }
        #content-gold-price-page .filter-row input:focus,
        #content-gold-price-page .filter-row select:focus{
            outline:none;
            border-color:#c89b5c;
            box-shadow:0 0 0 4px rgba(185,137,69,.12);
        }
        .summary-grid{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px;margin-bottom:16px}
        .summary-card{padding:16px;border-radius:16px;border:1px solid #efdfca;background:#fff}
        .summary-card span{display:block;color:var(--muted);font-size:.84rem}.summary-card strong{font-size:1.45rem}
        .report-summary-grid{gap:14px}
        .report-summary-grid .summary-card{
            position:relative;
            overflow:hidden;
            min-height:112px;
            padding:18px 18px 16px;
            border-color:#ead7bc;
            background:linear-gradient(180deg,#fffdf8 0%,#fff 100%);
            box-shadow:0 12px 26px rgba(86,61,34,.06);
        }
        .report-summary-grid .summary-card::before{
            content:'';
            position:absolute;
            inset:0 auto auto 0;
            width:100%;
            height:4px;
            background:linear-gradient(90deg,#c89b5c 0%,#9e7237 100%);
        }
        .report-summary-grid .summary-card span{
            margin-bottom:10px;
            color:#86653a;
            font-size:.76rem;
            font-weight:700;
            letter-spacing:.08em;
            text-transform:uppercase;
        }
        .report-summary-grid .summary-card strong{
            display:block;
            color:var(--text);
            font-size:1.5rem;
            line-height:1.15;
            word-break:break-word;
        }
        .report-summary-grid .summary-card:hover{
            transform:translateY(-2px);
            border-color:#d7b784;
            box-shadow:0 16px 30px rgba(86,61,34,.1);
        }
        .mini-btn{padding:6px 10px;border-radius:10px;border:1px solid #e7d3b6;background:#fff;font-size:.82rem;cursor:pointer}
        .tag-list{display:flex;gap:8px;flex-wrap:wrap}.tag{display:inline-flex;align-items:center;padding:6px 10px;border-radius:999px;border:1px solid #e7d3b6;background:#fff;font-size:.78rem;font-weight:700;color:var(--gold2)}
        .detail-panel{margin-top:16px;padding:16px;border-radius:16px;border:1px solid #efdfca;background:#fff}
        .detail-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
        .check-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px}
        .check-grid label{display:flex;align-items:center;gap:8px;padding:10px;border:1px solid #efdfca;border-radius:10px;background:#fff}
        .note-list{display:grid;gap:10px;margin-top:14px}
        .note-item{padding:12px 14px;border-radius:14px;border:1px solid #efdfca;background:#fff}
        .breadcrumb i{font-size:.75rem}
        .modal-backdrop{position:fixed;inset:0;background:rgba(20,13,8,.45);display:none;align-items:flex-start;justify-content:center;padding:16px;z-index:2200;overflow-y:auto}
        .modal-backdrop.open{display:flex}
        .modal-card{width:min(640px,100%);background:#fffaf3;border:1px solid #ead9c1;border-radius:20px;box-shadow:var(--shadow);padding:18px;display:flex;flex-direction:column;max-height:calc(100vh - 32px);overflow:hidden}
        #viewModal .modal-card{width:min(760px,100%)}
        .modal-head{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:12px;flex-shrink:0}
        .modal-head h3{margin:0;font-size:1.1rem;font-family:"Cormorant Garamond",serif}
        .close-btn{width:34px;height:34px;border-radius:10px;border:1px solid #e6d1b3;background:#fff;cursor:pointer}
        .modal-card > form{display:flex;flex-direction:column;flex:1;min-height:0;overflow:hidden}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px;min-height:0;overflow:auto;padding-right:4px;flex:1}
        #viewModalBody{min-height:0;overflow:auto;padding-right:4px;flex:1}
        .field{display:flex;flex-direction:column;gap:6px}
        .field.full{grid-column:1 / -1}
        .field label{font-size:.82rem;color:var(--muted)}
        .field input,.field select{height:40px;border:1px solid #e4d0b3;border-radius:10px;padding:0 10px;background:#fff}
        .input-prefix{display:flex;align-items:stretch;border:1px solid #e4d0b3;border-radius:10px;overflow:hidden;background:#fff}
        .input-prefix span{display:inline-flex;align-items:center;padding:0 10px;background:#f5ebdb;color:#8a6d3a;font-size:.86rem;font-weight:700;white-space:nowrap;border-right:1px solid #e4d0b3}
        .input-prefix input{border:0 !important;border-radius:0 !important;flex:1;min-width:0;height:40px;padding:0 10px;background:transparent}
        .field.invalid input,.field.invalid select,.field.invalid textarea{border-color:#c86f61;background:#fff7f5}
        .field-error{font-size:.76rem;color:#a04e3e;font-weight:700}
        .modal-actions{display:flex;justify-content:flex-end;gap:8px;margin-top:14px;flex-shrink:0}
        .view-grid{display:grid;grid-template-columns:1fr 1fr;gap:10px}
        .view-item{padding:10px;border:1px solid #efdfca;border-radius:10px;background:#fff}
        .view-item span{display:block;color:var(--muted);font-size:.8rem}
        .admin-toast{
            position:fixed;
            right:18px;
            bottom:18px;
            min-width:260px;
            max-width:min(380px,calc(100vw - 36px));
            padding:14px 16px 12px;
            border-radius:18px;
            border:1px solid rgba(255,255,255,.28);
            box-shadow:0 18px 42px rgba(51,35,16,.24);
            backdrop-filter:blur(14px);
            color:#fff;
            z-index:2000;
            overflow:hidden;
            transform:translateY(18px) scale(.96);
            opacity:0;
            animation:adminToastIn .28s ease-out forwards;
        }
        .admin-toast::before{
            content:'';
            position:absolute;
            inset:0;
            background:linear-gradient(135deg,rgba(255,255,255,.2),rgba(255,255,255,0) 45%);
            pointer-events:none;
        }
        .admin-toast::after{
            content:'';
            position:absolute;
            left:0;
            right:0;
            bottom:0;
            height:4px;
            background:rgba(255,255,255,.4);
            transform-origin:left center;
            animation:adminToastBar 2.8s linear forwards;
        }
        .admin-toast[data-tone="success"]{background:linear-gradient(135deg,#22a06b 0%,#18805a 100%);}
        .admin-toast[data-tone="warning"]{background:linear-gradient(135deg,#d39b2b 0%,#a87315 100%);}
        .admin-toast[data-tone="error"]{background:linear-gradient(135deg,#c94d4d 0%,#8d2f2f 100%);}
        .admin-toast[data-tone="info"]{background:linear-gradient(135deg,#4a78b4 0%,#2f568f 100%);}
        .admin-toast__row{display:flex;align-items:flex-start;gap:12px;position:relative;z-index:1}
        .admin-toast__icon{
            width:36px;
            height:36px;
            border-radius:12px;
            display:grid;
            place-items:center;
            flex:0 0 auto;
            background:rgba(255,255,255,.16);
            border:1px solid rgba(255,255,255,.16);
            font-weight:800;
            font-size:1rem;
            box-shadow:inset 0 1px 0 rgba(255,255,255,.2);
        }
        .admin-toast__content{min-width:0;flex:1}
        .admin-toast__title{display:block;font-size:.72rem;letter-spacing:.16em;text-transform:uppercase;font-weight:800;opacity:.9;margin-bottom:4px}
        .admin-toast__message{display:block;font-size:.95rem;line-height:1.45;font-weight:600;word-break:break-word}
        @keyframes adminToastIn{
            from{opacity:0;transform:translateY(18px) scale(.96)}
            to{opacity:1;transform:translateY(0) scale(1)}
        }
        @keyframes adminToastBar{
            from{transform:scaleX(1)}
            to{transform:scaleX(0)}
        }
        .password-alert-backdrop{position:fixed;inset:0;background:rgba(20,13,8,.52);display:none;align-items:center;justify-content:center;padding:16px;z-index:2400;overflow-y:auto}
        .password-alert-backdrop.open{display:flex}
        .password-alert-card{width:min(560px,100%);background:linear-gradient(180deg,#fffdf8 0%,#fff7eb 100%);border:1px solid #ead8bc;border-radius:24px;box-shadow:0 28px 60px rgba(67,46,24,.22);padding:22px;position:relative}
        .password-alert-kicker{margin:0 0 6px;font-size:.78rem;letter-spacing:.16em;text-transform:uppercase;color:#9b723a;font-weight:800}
        .password-alert-card h3{margin:0;font-size:1.55rem;font-family:"Cormorant Garamond",serif;color:#2d2114}
        .password-alert-copyline{margin:8px 0 0;color:#6f5a40;line-height:1.55}
        .password-alert-field{display:flex;align-items:stretch;gap:10px;margin-top:18px;padding:10px;border:1px dashed #d8bf98;border-radius:16px;background:#fff}
        .password-alert-field input{flex:1;min-width:0;border:0;background:transparent;font:700 1rem/1.4 "Courier New",monospace;color:#2b1f12;padding:6px 4px;outline:none}
        .password-alert-field button{white-space:nowrap;border:0;border-radius:12px;background:#b98945;color:#fff;font-weight:700;padding:0 14px;cursor:pointer;box-shadow:0 10px 18px rgba(185,137,69,.22)}
        .password-alert-field button:hover{background:#9f7638}
        .password-alert-actions{display:flex;justify-content:flex-end;gap:10px;margin-top:18px}
        .profile-chip{display:flex;align-items:center;gap:10px;margin-bottom:10px}
        .profile-pic{width:46px;height:46px;border-radius:50%;display:grid;place-items:center;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:800}
        .dashboard-profile-layout{display:grid;grid-template-columns:260px 1fr;gap:18px}
        .dashboard-profile-card,.dashboard-profile-content{padding:18px;border:1px solid #efdfca;border-radius:20px;background:#fff}
        .dashboard-profile-preview{display:grid;place-items:center;gap:12px;text-align:center}
        .dashboard-profile-avatar{width:94px;height:94px;border-radius:28px;display:grid;place-items:center;overflow:hidden;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-size:1.7rem;font-weight:800}
        .dashboard-profile-avatar img{width:100%;height:100%;object-fit:cover;display:block}
        .dashboard-profile-avatar.has-image span{display:none}
        .dashboard-profile-avatar.has-image img{display:block !important}
        .dashboard-upload-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid #ead7bd;background:#fff7ec;color:#7b5d33;font-weight:700;cursor:pointer}
        .dashboard-profile-input{display:none}
        .dashboard-profile-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .dashboard-profile-grid .field input,.dashboard-profile-grid .field textarea{height:44px;padding:0 12px;border:1px solid #e8d8c2;border-radius:12px;background:#fff;font:inherit}
        .dashboard-profile-grid .field textarea{min-height:110px;padding:12px;resize:vertical}
        .dashboard-profile-grid .field .locked-role{
            background:#f7f0e4;
            color:#7b5d33;
            cursor:not-allowed;
            opacity:1;
        }
        .dashboard-profile-feedback{display:none;width:100%;margin-bottom:14px;padding:11px 14px;border-radius:14px;font-size:.92rem;line-height:1.5;box-shadow:0 10px 22px rgba(84,61,35,.06)}
        .dashboard-profile-feedback.show{display:block}
        .dashboard-profile-feedback.success{background:#fff7eb;border:1px solid #edd9b9;color:#7b5d33}
        .dashboard-profile-feedback.error{background:#fdebe6;border:1px solid #f0c3b5;color:#9a4b3d}
        .dashboard-profile-actions{display:flex;justify-content:flex-end;margin-top:18px}
        .confirm-text{margin:0;color:var(--muted);line-height:1.6}
        .chat-shell{display:grid;gap:14px}
        .chat-hero{display:flex;align-items:center;justify-content:space-between;gap:14px;padding:16px 18px;border:1px solid #efdfca;border-radius:18px;background:radial-gradient(circle at top right,rgba(47,111,101,.14),transparent 32%),linear-gradient(135deg,#fffdf8,#f8ecda)}
        .chat-title-wrap{display:grid;gap:4px}
        .chat-title-wrap strong{font-size:1.02rem}
        .chat-title-wrap span{color:var(--muted);font-size:.85rem}
        .chat-badge{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:999px;background:rgba(47,111,101,.08);border:1px solid rgba(47,111,101,.16);color:#285f55;font-size:.76rem;font-weight:800;letter-spacing:.08em;text-transform:uppercase}
        .chat-badge i{color:#b98945}
        .chat-thread{display:grid;gap:12px;max-height:360px;overflow:auto;padding:10px 6px 10px 2px}
        .chat-row{display:flex}
        .chat-row.admin-side{justify-content:flex-end}
        .chat-row.customer-side{justify-content:flex-start}
        .chat-bubble{max-width:84%;padding:12px 14px;border-radius:18px;border:1px solid #efdfca;background:#fff;box-shadow:0 10px 24px rgba(93,68,34,.07)}
        .chat-row.admin-side .chat-bubble{background:linear-gradient(135deg,#f1e8fb,#e5f2ef);border-color:#d8d9e8}
        .chat-meta{display:flex;align-items:center;justify-content:space-between;gap:10px;margin-bottom:8px;font-size:.76rem;color:var(--muted)}
        .chat-meta strong{font-size:.78rem;color:var(--gold2)}
        .chat-text{line-height:1.65}
        .chat-compose{display:grid;gap:10px;padding:14px;border:1px solid #efdfca;border-radius:18px;background:linear-gradient(180deg,#fffdf9,#fff)}
        .chat-compose-head{display:flex;align-items:center;justify-content:space-between;gap:12px}
        .chat-compose-head span{color:var(--muted);font-size:.82rem}
        .chat-compose textarea{min-height:102px;border:1px solid #e4d0b3;border-radius:14px;padding:12px;background:#fff;font:inherit;resize:vertical}
        .chat-compose-actions{display:flex;justify-content:flex-end}
        .consult-monitor-layout{display:grid;grid-template-columns:320px 1fr;gap:16px;margin-top:18px}
        .monitor-list,.monitor-detail{padding:18px;border:1px solid #efdfca;border-radius:22px;background:#fff;box-shadow:0 14px 28px rgba(83,57,26,.06)}
        .monitor-list-head,.monitor-detail-head{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:14px}
        .monitor-list-head h3,.monitor-detail-head h3{margin:0;font-size:1.08rem}
        .monitor-list-head span,.monitor-detail-head span{display:block;color:var(--muted);font-size:.82rem;margin-top:4px}
        .monitor-list-body{display:grid;gap:10px;max-height:520px;overflow:auto;padding-right:4px}
        .monitor-item{width:100%;padding:12px 14px;border:1px solid #efdfca;border-radius:16px;background:#fff;text-align:left;cursor:pointer;transition:transform .18s ease,border-color .18s ease,box-shadow .18s ease}
        .monitor-item:hover,.monitor-item.active{transform:translateY(-1px);border-color:#d9b77d;box-shadow:0 12px 24px rgba(83,57,26,.08);background:#fffaf2}
        .monitor-item strong{display:block;margin-bottom:4px}
        .monitor-item span{display:block;color:var(--muted);font-size:.82rem;line-height:1.45}
        .monitor-chip-row{display:flex;gap:8px;flex-wrap:wrap;margin-top:8px}
        .monitor-chip{display:inline-flex;align-items:center;padding:6px 10px;border-radius:999px;background:#fff6e8;border:1px solid #edd9b9;color:#7a5b2f;font-size:.76rem;font-weight:700}
        .monitor-thread{display:grid;gap:12px}
        .monitor-thread-meta{display:grid;grid-template-columns:repeat(4,1fr);gap:10px}
        .monitor-thread-meta .summary-card{margin:0}
        .monitor-messages{display:grid;gap:10px;max-height:520px;overflow:auto;padding-right:4px}
        .monitor-message{display:flex}
        .monitor-message.admin-side{justify-content:flex-end}
        .monitor-message .chat-bubble{max-width:88%}
        .monitor-message .chat-media{margin-top:10px;max-width:320px}
        .monitor-message .chat-media img{display:block;width:100%;max-width:320px;max-height:220px;object-fit:cover;border-radius:14px;border:1px solid #e8d8c2;background:#fff}
        .perm-cell{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
        .perm-summary{font-size:.82rem;color:var(--muted);font-weight:700}
        .perm-grid{display:grid;grid-template-columns:1fr 1fr;gap:8px}
        .perm-grid label{display:flex;align-items:center;gap:8px;padding:10px;border:1px solid #efdfca;border-radius:10px;background:#fff}
        .add-form-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
        .add-form-grid .field.full{grid-column:1 / -1}
        .add-form-grid textarea{min-height:90px;border:1px solid #e4d0b3;border-radius:10px;padding:10px;background:#fff;font:inherit;resize:vertical}
        .recipient-search-panel{display:grid;gap:8px}
        .recipient-search-results{display:none;max-height:220px;overflow:auto;padding:8px;border:1px solid #e4d0b3;border-radius:12px;background:#fff8ef;box-shadow:inset 0 1px 0 rgba(255,255,255,.55)}
        .recipient-search-results.open{display:grid}
        .recipient-search-results button{display:flex;flex-direction:column;gap:2px;align-items:flex-start;width:100%;padding:10px 12px;border:1px solid #ecd8bc;border-radius:12px;background:#fff;cursor:pointer;font:inherit;text-align:left}
        .recipient-search-results button:hover{border-color:#c99a53;background:#fff7ea}
        .recipient-search-results button.selected{border-color:#b98945;background:#fff3de;color:#7b5d33}
        .chat-badge{background:rgba(185,137,69,.1);border:1px solid rgba(185,137,69,.16);color:#8b6432}
        .chat-badge i{color:#b98945}
        .recipient-search-results button.active{border-color:#c99a53;background:#fff2dd;box-shadow:0 0 0 2px rgba(185,137,69,.14)}
        .recipient-result-top{display:flex;align-items:center;gap:10px;width:100%}
        .recipient-result-badge{width:32px;height:32px;border-radius:50%;display:grid;place-items:center;flex:0 0 auto;background:linear-gradient(135deg,#c8984f,#8e632d);color:#fff;font-weight:800;font-size:.82rem}
        .recipient-result-text{display:grid;gap:2px;min-width:0}
        .recipient-search-results .name{font-weight:700;color:var(--text)}
        .recipient-search-results .meta{font-size:.78rem;color:var(--muted)}
        .recipient-search-empty{padding:10px 12px;color:var(--muted);font-size:.86rem}
        .switches{display:flex;gap:14px;flex-wrap:wrap}
        .switches label{display:flex;align-items:center;gap:8px;padding:8px 10px;border:1px solid #efdfca;border-radius:10px;background:#fff}
        .upload-list{display:grid;gap:8px}
        .upload-row{display:grid;grid-template-columns:1fr auto;gap:8px}
        .form-block{padding:16px;border:1px solid #efdfca;border-radius:16px;background:#fff}
        .backdrop{display:none}
    </style>
</head>
<body>
    <div class="app" id="app">
        <header class="topbar">
            <div class="left">
                <div class="brand">
                    <img class="brand-logo" src="{{ asset('images/web_logo.png') }}" alt="Pinwantha Gems & Jewellery">
                </div>
            </div>
            <div class="search">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search products, orders, customers, reports...">
            </div>
            <div class="right">
                <div class="profile-wrap" id="profileWrap">
                    <button class="profile-btn" id="profileToggle" type="button" aria-expanded="false" aria-haspopup="true">
                        <div class="avatar">
                            @if (auth()->user()->profileImageUrl())
                                <img src="{{ auth()->user()->profileImageUrl() }}" alt="{{ auth()->user()->first_name }} profile image">
                            @else
                                {{ auth()->user()->profileInitial() }}
                            @endif
                        </div>
                        <div class="profile-meta">
                            <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                            <span>{{ Str::title(str_replace('_', ' ', auth()->user()->role ?? 'admin')) }}</span>
                        </div>
                        <i class="fas fa-chevron-down caret"></i>
                    </button>
                    <div class="profile-menu" id="profileMenu">
                        <a href="#profile-page" class="profile-link"><i class="fas fa-user"></i> Profile</a>
                        <a href="#settings-page" class="profile-link"><i class="fas fa-gear"></i> Settings</a>
                        <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit"><i class="fas fa-right-from-bracket"></i> Logout</button></form>
                    </div>
                </div>
            </div>
        </header>

        <div class="body">
            <aside class="sidebar">
                <div class="side-label">Main Navigation</div>
                <ul class="menu">
                    <li class="item"><a href="#dashboard" class="menu-link active"><span class="menu-main"><span class="mini-icon"><i class="fas fa-chart-pie"></i></span><span class="menu-meta"><strong>Dashboard</strong><span>Overview and recent activity</span></span></span></a></li>
                    <li class="item" id="userManagementItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-users-gear"></i></span>
                                <span class="menu-meta"><strong>User Management</strong><span>Customers, consultants, roles</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#users-customers-page"><i class="fas fa-user-group"></i> Customers</a></li>
                            <li><a href="#users-consultants-page"><i class="fas fa-user-tie"></i> Consultants</a></li>
                            <li><a href="#users-admins-page"><i class="fas fa-user-shield"></i> Admin Users</a></li>
                            <li><a href="#users-roles-page"><i class="fas fa-key"></i> Roles & Permissions</a></li>
                            <li><a href="#users-logs-page"><i class="fas fa-clipboard-list"></i> Activity Logs</a></li>
                        </ul>
                    </li>
                    <li class="item" id="productManagementItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-ring"></i></span>
                                <span class="menu-meta"><strong>Product Management</strong><span>Products</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#products-all-page"><i class="fas fa-box"></i> All Products</a></li>
                            <li><a href="#products-add-page"><i class="fas fa-plus-circle"></i> Add Product</a></li>
                            <li><a href="#products-categories-page"><i class="fas fa-tags"></i> Jewellery Types</a></li>
                            <li><a href="#products-reviews-page"><i class="fas fa-star-half-stroke"></i> Product Reviews</a></li>
                        </ul>
                    </li>
                    <li class="item" id="inventoryItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-boxes-stacked"></i></span>
                                <span class="menu-meta"><strong>Inventory</strong><span>Stock and history</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#inventory-stock-management-page"><i class="fas fa-cubes"></i> Stock Management</a></li>
                            <li><a href="#inventory-low-stock-page"><i class="fas fa-triangle-exclamation"></i> Low Stock Alerts</a></li>
                            <li><a href="#inventory-out-of-stock-page"><i class="fas fa-box-open"></i> Out of Stock Items</a></li>
                            <li><a href="#inventory-history-page"><i class="fas fa-clock-rotate-left"></i> Inventory History</a></li>
                        </ul>
                    </li>
                    <li class="item" id="ordersItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-bag-shopping"></i></span>
                                <span class="menu-meta"><strong>Orders</strong><span>Track and manage all orders</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#orders-all-page"><i class="fas fa-table-list"></i> All Orders</a></li>
                            <li><a href="#orders-delivery-page"><i class="fas fa-truck-fast"></i> Delivery Orders</a></li>
                            <li><a href="#orders-pickup-page"><i class="fas fa-store"></i> Pickup Orders</a></li>
                            <li><a href="#orders-returns-page"><i class="fas fa-rotate-left"></i> Returns & Refunds</a></li>
                        </ul>
                    </li>
                    <li class="item" id="customJewelleryItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-wand-magic-sparkles"></i></span>
                                <span class="menu-meta"><strong>Custom Jewellery</strong><span>Requests and quotations</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#custom-requests-page"><i class="fas fa-table-list"></i> Custom Requests</a></li>
                            <li><a href="#custom-pending-page"><i class="fas fa-hourglass-half"></i> Pending Requests</a></li>
                            <li><a href="#custom-quotations-page"><i class="fas fa-file-invoice-dollar"></i> Quotations</a></li>
                            <li><a href="#custom-paid-page"><i class="fas fa-gem"></i> Paid Designs</a></li>
                        </ul>
                    </li>
                    <li class="item" id="consultationItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-comments"></i></span>
                                <span class="menu-meta"><strong>Consultation</strong><span>Appointments and chat</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#consultation-requests-page"><i class="fas fa-table-list"></i> Consultation Requests</a></li>
                            <li><a href="#consultation-pending-page"><i class="fas fa-hourglass-half"></i> Pending Requests</a></li>
                            <li><a href="#appointments-page"><i class="fas fa-calendar-check"></i> Appointments</a></li>
                            <li><a href="#consultation-chat-page"><i class="fas fa-comments"></i> Chat / Messages</a></li>
                            <li><a href="#consultation-history-page"><i class="fas fa-clock-rotate-left"></i> Consultation History</a></li>
                        </ul>
                    </li>
                    <li class="item" id="reportsItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-chart-line"></i></span>
                                <span class="menu-meta"><strong>Reports & Analytics</strong><span>Revenue and insights</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#reports-sales-page"><i class="fas fa-sack-dollar"></i> Sales Reports</a></li>
                            <li><a href="#reports-orders-page"><i class="fas fa-bag-shopping"></i> Order Reports</a></li>
                            <li><a href="#reports-products-page"><i class="fas fa-box"></i> Product Reports</a></li>
                            <li><a href="#reports-inventory-page"><i class="fas fa-boxes-stacked"></i> Inventory Reports</a></li>
                            <li><a href="#reports-customers-page"><i class="fas fa-user-group"></i> Customer Reports</a></li>
                            <li><a href="#reports-consultation-page"><i class="fas fa-comments"></i> Consultation Reports</a></li>
                            <li><a href="#reports-custom-jewellery-page"><i class="fas fa-wand-magic-sparkles"></i> Custom Jewellery Reports</a></li>
                            <li><a href="#reports-revenue-page"><i class="fas fa-chart-pie"></i> Revenue Analytics</a></li>
                        </ul>
                    </li>
                    <li class="item" id="notificationsItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-bullhorn"></i></span>
                                <span class="menu-meta"><strong>Notifications</strong><span>Manual announcements only</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#notifications-send-page"><i class="fas fa-paper-plane"></i> Send Notification</a></li>
                            <li><a href="#notifications-list-page"><i class="fas fa-bell"></i> Notification List</a></li>
                        </ul>
                    </li>
                    <li class="item" id="contentManagementItem">
                        <button class="menu-toggle" type="button" aria-expanded="false">
                            <span class="menu-main">
                                <span class="mini-icon"><i class="fas fa-layer-group"></i></span>
                                <span class="menu-meta"><strong>Content Management</strong><span>Pages, blogs, news and updates</span></span>
                            </span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <ul class="submenu">
                            <li><a href="#content-blogs-page"><i class="fas fa-blog"></i> Blog Management</a></li>
                            <li><a href="#content-news-page"><i class="fas fa-newspaper"></i> News Management</a></li>
                            <li><a href="#content-faq-page"><i class="fas fa-circle-question"></i> FAQ Management</a></li>
                            <li><a href="#content-gold-price-page"><i class="fas fa-coins"></i> Metal Price Updates</a></li>
                        </ul>
                    </li>
                    <li class="item"><a href="#contact-messages-page" class="menu-link"><span class="menu-main"><span class="mini-icon"><i class="fas fa-envelope-open-text"></i></span><span class="menu-meta"><strong>Contact Messages</strong><span>Customer inquiries and replies</span></span></span></a></li>
                </ul>
            </aside>
            <main class="content">
                <div class="breadcrumb" id="breadcrumb"><span id="breadcrumbRoot">Dashboard</span><i class="fas fa-chevron-right"></i><span id="breadcrumbLeaf">Overview</span></div>
                <section class="hero default-section" id="dashboard">
                    <small><i class="fas fa-crown"></i> Admin Dashboard</small>
                    <h1>Key business information at a glance.</h1>
                    <p>Your key business information on sales, orders, customers, stock alerts and charts for quick decision-making.</p>
                </section>

                <section class="metrics default-section">
                    @php
                        $productMetrics = $productMetrics ?? [];
                        $salesSummary = $salesSummary ?? [];
                        $orderSummary = $orderSummary ?? [];
                        $productSummary = $productSummary ?? [];
                        $inventoryMetrics = $inventoryMetrics ?? [];
                        $customerSummary = $customerSummary ?? [];
                        $customJewellerySummary = $customJewellerySummary ?? [];
                        $revenueSummary = $revenueSummary ?? [];
                        $consultationMetrics = $consultationMetrics ?? [];
                        $appointmentMetrics = $appointmentMetrics ?? [];
                        $userMetrics = $userMetrics ?? [];
                        $adminBlogSummary = $adminBlogSummary ?? [];
                        $adminNewsSummary = $adminNewsSummary ?? [];
                    @endphp
                    <div class="metric m1"><div class="metric-top"><span>Total Jewellery Products</span><div class="metric-icon"><i class="fas fa-ring"></i></div></div><div class="metric-value">{{ number_format((int) ($productMetrics['jewellery_products'] ?? 0)) }}</div><div class="metric-note">{{ number_format((int) ($productMetrics['total_categories'] ?? 0)) }} active collections</div></div>
                    <div class="metric m2"><div class="metric-top"><span>Total Gem Products</span><div class="metric-icon"><i class="fas fa-gem"></i></div></div><div class="metric-value">{{ number_format((int) ($productMetrics['gem_products'] ?? 0)) }}</div><div class="metric-note">Live gem catalog</div></div>
                    <div class="metric m3"><div class="metric-top"><span>Total Customer Orders</span><div class="metric-icon"><i class="fas fa-bag-shopping"></i></div></div><div class="metric-value">{{ number_format((int) ($orderSummary['total_orders'] ?? 0)) }}</div><div class="metric-note">{{ number_format((int) ($orderSummary['pickup_orders'] ?? 0)) }} pickup orders</div></div>
                    <div class="metric m4"><div class="metric-top"><span>Monthly Revenue</span><div class="metric-icon"><i class="fas fa-sack-dollar"></i></div></div><div class="metric-value">{{ $revenueSummary['monthly_revenue'] ?? 'Rs 0' }}</div><div class="metric-note">Based on live orders</div></div>
                    <div class="metric m5"><div class="metric-top"><span>Low Stock Alerts</span><div class="metric-icon"><i class="fas fa-triangle-exclamation"></i></div></div><div class="metric-value">{{ number_format((int) ($inventoryMetrics['low'] ?? 0)) }}</div><div class="metric-note">Restock required</div></div>
                    <div class="metric m6"><div class="metric-top"><span>Pending Orders</span><div class="metric-icon"><i class="fas fa-hourglass-half"></i></div></div><div class="metric-value">{{ number_format((int) ($orderSummary['pending_orders'] ?? 0)) }}</div><div class="metric-note">Includes {{ number_format((int) ($orderSummary['pickup_orders'] ?? 0)) }} pickup</div></div>
                    <div class="metric m7"><div class="metric-top"><span>Custom Requests</span><div class="metric-icon"><i class="fas fa-wand-magic-sparkles"></i></div></div><div class="metric-value">{{ number_format((int) ($customJewellerySummary['total_requests'] ?? 0)) }}</div><div class="metric-note">{{ number_format((int) ($customJewellerySummary['approved_requests'] ?? 0)) }} approved</div></div>
                    <div class="metric m8"><div class="metric-top"><span>Consultation Requests</span><div class="metric-icon"><i class="fas fa-comments"></i></div></div><div class="metric-value">{{ number_format((int) ($consultationMetrics['total_requests'] ?? 0)) }}</div><div class="metric-note">{{ number_format((int) ($consultationMetrics['approved_requests'] ?? 0)) }} approved</div></div>
                </section>

                <section class="widgets default-section">
                    <div class="widget"><span>Most Viewed Category</span><strong>{{ $productSummary['most_viewed_category'] ?? '-' }}</strong></div>
                    <div class="widget"><span>Top Selling Gem Type</span><strong>{{ $productSummary['top_gem_type'] ?? '-' }}</strong></div>
                    <div class="widget"><span>New Customers This Month</span><strong>{{ number_format((int) ($userMetrics['customers_new_this_month'] ?? 0)) }}</strong></div>
                    <div class="widget"><span>Pickup-only Orders</span><strong>{{ number_format((int) ($orderSummary['pickup_orders'] ?? 0)) }}</strong></div>
                    <div class="widget"><span>Published Blogs / News</span><strong>{{ number_format((int) (($adminBlogSummary['published'] ?? 0) + ($adminNewsSummary['published'] ?? 0))) }}</strong></div>
                </section>

                <section class="charts-grid default-section" id="reports">
                    <div class="chart">
                        @php
                            $monthlySalesChart = collect($dashboardCharts['monthly_sales'] ?? []);
                            $orderStatusChart = collect($dashboardCharts['order_status'] ?? []);
                            $topProductsChart = collect($dashboardCharts['top_products'] ?? []);
                            $orderStatusStart = 0;
                            $orderStatusSegments = $orderStatusChart->map(function (array $segment) use (&$orderStatusStart) {
                                $start = $orderStatusStart;
                                $orderStatusStart += $segment['percent'] ?? 0;
                                return [
                                    'label' => $segment['label'] ?? '-',
                                    'count' => $segment['count'] ?? 0,
                                    'color' => $segment['color'] ?? '#b98945',
                                    'start' => $start,
                                    'end' => $orderStatusStart,
                                ];
                            });
                            $salesYearLabel = $monthlySalesChart->isNotEmpty() ? substr((string) ($monthlySalesChart->last()['month'] ?? now()->format('Y')), 0, 4) : now()->format('Y');
                        @endphp
                        <div class="section-head"><div><h2>Monthly Sales Chart</h2><span>Month-wise sales performance</span></div><span>{{ $salesYearLabel }}</span></div>
                        <div class="bars">
                            @forelse ($monthlySalesChart as $index => $salesBar)
                                <div class="bar {{ $index % 2 ? 'alt' : '' }}">
                                    <div class="track"><div class="fill" style="height:{{ $salesBar['height'] ?? 12 }}%"></div></div>
                                    <span>{{ $salesBar['label'] ?? '-' }}</span>
                                </div>
                            @empty
                                <div class="bar"><div class="track"><div class="fill" style="height:18%"></div></div><span>No data</span></div>
                            @endforelse
                        </div>
                    </div>

                    <div class="chart">
                        <div class="section-head"><div><h2>Order Status Chart</h2><span>Pending, Processing, Completed, Cancelled, Pickup</span></div></div>
                        <div class="donut-wrap">
                            <div class="donut" style="{{ $orderStatusSegments->isNotEmpty() ? 'background:conic-gradient(' . $orderStatusSegments->map(function ($segment) { return $segment['color'] . ' ' . $segment['start'] . '% ' . $segment['end'] . '%'; })->implode(',') . ');' : 'background:conic-gradient(#d7a156 0 100%);' }}">
                                <div class="donut-label"><strong>{{ number_format((int) $orderStatusChart->sum('count')) }}</strong><br><span style="color:var(--muted);font-size:.84rem;">Total Orders</span></div>
                            </div>
                        </div>
                        <div class="legend">
                            @forelse ($orderStatusSegments as $segment)
                                <div><span class="swatch" style="background:{{ $segment['color'] }};"></span> {{ $segment['label'] }}{{ isset($segment['count']) ? ' (' . $segment['count'] . ')' : '' }}</div>
                            @empty
                                <div><span class="swatch" style="background:#d7a156;"></span> No data</div>
                            @endforelse
                        </div>
                    </div>
                </section>

                <section class="chart default-section" style="margin-top:22px;">
                    <div class="section-head"><div><h2>Top Selling Products Chart</h2><span>Best performing products</span></div></div>
                    <div class="product-bars">
                        @forelse ($topProductsChart as $productBar)
                            <div class="product-bar">
                                <div class="product-bar-fill" style="height:{{ $productBar['height'] ?? 20 }}px;background:{{ $productBar['color'] ?? '#b98945' }};"></div>
                                <strong>{{ $productBar['label'] ?? '-' }}</strong>
                                <span>{{ number_format((int) ($productBar['count'] ?? 0)) }} sold</span>
                            </div>
                        @empty
                            <div class="product-bar"><div class="product-bar-fill" style="height:40px;"></div><strong>No data</strong><span>0 sold</span></div>
                        @endforelse
                    </div>
                </section>

                <section class="bottom-grid default-section">
                    <div class="table-panel" id="orders">
                        <div class="section-head"><div><h3>Recent Orders</h3><span>Latest customer orders</span></div></div>
                        @php
                            $recentOrders = collect($orderRows ?? [])->take(4);
                            $recentLowStockRows = collect($lowStockRows ?? [])->take(4);
                        @endphp
                        <table>
                            <thead><tr><th>Order ID</th><th>Customer</th><th>Type</th><th>Status</th><th>Total</th></tr></thead>
                            <tbody>
                                @forelse ($recentOrders as $recentOrder)
                                    <tr>
                                        <td>{{ $recentOrder['order_id'] ?? $recentOrder['order_number'] ?? '-' }}</td>
                                        <td>{{ $recentOrder['customer_name'] ?? '-' }}</td>
                                        <td>{{ $recentOrder['products'] ?? '-' }}</td>
                                        <td><span class="status {{ $recentOrder['status_class'] ?? 'warn' }}">{{ $recentOrder['status'] ?? '-' }}</span></td>
                                        <td>{{ $recentOrder['total_amount'] ?? 'Rs 0' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:24px;">No recent orders available.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-panel" id="inventory">
                        <div class="section-head"><div><h3>Low Stock Products</h3><span>Immediate stock attention</span></div></div>
                        <table>
                            <thead><tr><th>Product</th><th>Category</th><th>Stock</th><th>Level</th></tr></thead>
                            <tbody>
                                @forelse($recentLowStockRows as $lowStockRow)
                                    <tr>
                                        <td>{{ $lowStockRow['name'] }}</td>
                                        <td>{{ $lowStockRow['category'] }}</td>
                                        <td>{{ $lowStockRow['stock'] }}</td>
                                        <td><span class="status {{ $lowStockRow['status_class'] }}">{{ $lowStockRow['status'] }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="text-align:center;">No low stock products right now.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="two-col default-section">
                    <div class="quick-actions">
                        <div class="section-head"><div><h3>Quick Actions</h3><span>Fast access buttons</span></div></div>
                        <div class="actions-grid">
                            <a class="action" href="#products-add-page"><i class="fas fa-plus"></i><div><strong>Add Product</strong><span>Create new listing</span></div></a>
                            <a class="action" href="#orders-all-page"><i class="fas fa-bag-shopping"></i><div><strong>View Orders</strong><span>Open order management panel</span></div></a>
                            <a class="action" href="#inventory-stock-management-page"><i class="fas fa-boxes-stacked"></i><div><strong>Update Stock</strong><span>Manage inventory</span></div></a>
                            <a class="action" href="{{ route('admin.content-posts', ['type' => 'news']) }}"><i class="fas fa-newspaper"></i><div><strong>Add News</strong><span>Publish latest news</span></div></a>
                            <a class="action" href="{{ route('admin.content-posts', ['type' => 'blog']) }}"><i class="fas fa-blog"></i><div><strong>Add Blogs</strong><span>Create new blog post</span></div></a>
                            <a class="action" href="#reports"><i class="fas fa-chart-line"></i><div><strong>View Reports</strong><span>Open analytics</span></div></a>
                        </div>
                    </div>

                    <div class="alerts">
                        <div class="section-head"><div><h3>Alerts</h3><span>Important notifications</span></div></div>
                        <div class="alerts-grid">
                            @php $firstLowStockAlert = ($lowStockRows ?? collect())->first(); @endphp
                            <div class="alert a1"><strong>Low stock alert</strong><div>{{ $firstLowStockAlert ? ($firstLowStockAlert['name'] . ' is at ' . $firstLowStockAlert['stock'] . ' units and needs restocking.') : 'No low stock alerts right now.' }}</div></div>
                            <div class="alert a2"><strong>New custom jewellery request</strong><div>New bridal ring customization request needs review.</div></div>
                            <div class="alert a3"><strong>New consultation booking</strong><div>Two gemstone consultations were booked this morning.</div></div>
                            <div class="alert a4"><strong>New review pending approval</strong><div>A new verified buyer review is waiting for moderation.</div></div>
                        </div>
                    </div>
                </section>
                <div id="dashboardBoundary" style="height:1px;margin-top:4px;"></div>
                <section class="module-page" id="reports-sales-page">
                    @php
                        $salesSummary = collect($salesSummary ?? []);
                        $salesReportRows = collect($salesReportRows ?? []);
                        $salesCategories = $salesReportRows->pluck('category')->filter()->unique()->values();
                    @endphp
                    <div class="module-head">
                        <h2>Sales Reports</h2>
                        <p>Track daily, weekly, monthly, and yearly sales with revenue summaries and trend visibility.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Daily Sales</span><strong>{{ $salesSummary['daily_sales'] ?? 'Rs 0' }}</strong></div>
                        <div class="summary-card"><span>Weekly Sales</span><strong>{{ $salesSummary['weekly_sales'] ?? 'Rs 0' }}</strong></div>
                        <div class="summary-card"><span>Monthly Sales</span><strong>{{ $salesSummary['monthly_sales'] ?? 'Rs 0' }}</strong></div>
                        <div class="summary-card"><span>Yearly Revenue</span><strong>{{ $salesSummary['yearly_revenue'] ?? 'Rs 0' }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <input type="date" data-filter-index="1">
                            <select data-filter-index="2">
                                <option>All Category</option>
                                @foreach ($salesCategories as $categoryOption)
                                    <option>{{ $categoryOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Category</th><th>Total Sales</th><th>Total Orders</th><th>Revenue</th></tr></thead>
                            <tbody>
                                @forelse ($salesReportRows as $salesReportRow)
                                    <tr data-search-blob="{{ $salesReportRow['category'] ?? '' }}">
                                        <td>{{ $salesReportRow['from_date'] ?? '-' }}</td>
                                        <td>{{ $salesReportRow['to_date'] ?? '-' }}</td>
                                        <td>{{ $salesReportRow['category'] ?? '-' }}</td>
                                        <td>{{ $salesReportRow['total_sales'] ?? 0 }}</td>
                                        <td>{{ $salesReportRow['total_orders'] ?? 0 }}</td>
                                        <td>{{ $salesReportRow['revenue'] ?? 'Rs 0' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No sales report data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="reports-orders-page">
                    @php
                        $orderSummary = collect($orderSummary ?? []);
                        $orderReportRows = collect($orderReportRows ?? []);
                        $orderStatusOptions = $orderReportRows->pluck('status')->filter()->unique()->values();
                    @endphp
                    <div class="module-head">
                        <h2>Order Reports</h2>
                        <p>Review total orders, pending, completed, cancelled, and pickup order performance.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Total Orders</span><strong>{{ number_format((int) ($orderSummary['total_orders'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Pending Orders</span><strong>{{ number_format((int) ($orderSummary['pending_orders'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Completed Orders</span><strong>{{ number_format((int) ($orderSummary['completed_orders'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Pickup Orders</span><strong>{{ number_format((int) ($orderSummary['pickup_orders'] ?? 0)) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <input type="date" data-filter-index="1">
                            <select data-filter-index="2">
                                <option>All Status</option>
                                @foreach ($orderStatusOptions as $statusOption)
                                    <option>{{ $statusOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Status</th><th>Total Orders</th><th>Pickup-only</th><th>Cancelled</th></tr></thead>
                            <tbody>
                                @forelse ($orderReportRows as $orderReportRow)
                                    <tr data-search-blob="{{ $orderReportRow['status'] ?? '' }}">
                                        <td>{{ $orderReportRow['from_date'] ?? '-' }}</td>
                                        <td>{{ $orderReportRow['to_date'] ?? '-' }}</td>
                                        <td>{{ $orderReportRow['status'] ?? '-' }}</td>
                                        <td>{{ $orderReportRow['total_orders'] ?? 0 }}</td>
                                        <td>{{ $orderReportRow['pickup_only'] ?? 0 }}</td>
                                        <td>{{ $orderReportRow['cancelled'] ?? 0 }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No order report data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="reports-products-page">
                    @php
                        $productSummary = collect($productSummary ?? []);
                        $productReportRows = collect($productReportRows ?? []);
                        $productTypeOptions = $productReportRows->pluck('product_type')->filter()->unique()->values();
                    @endphp
                    <div class="module-head">
                        <h2>Product Reports</h2>
                        <p>Analyze best sellers, low-performing products, top viewed items, and category performance.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Best Seller</span><strong>{{ $productSummary['best_seller'] ?? '-' }}</strong></div>
                        <div class="summary-card"><span>Low Seller</span><strong>{{ $productSummary['lowest_seller'] ?? '-' }}</strong></div>
                        <div class="summary-card"><span>Most Viewed</span><strong>{{ $productSummary['most_viewed'] ?? '-' }}</strong></div>
                        <div class="summary-card"><span>Top Category</span><strong>{{ $productSummary['top_category'] ?? '-' }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <input type="date" data-filter-index="1">
                            <select data-filter-index="2">
                                <option>All Product Type</option>
                                @foreach ($productTypeOptions as $productTypeOption)
                                    <option>{{ $productTypeOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Product Type</th><th>Top Selling</th><th>Most Viewed</th></tr></thead>
                            <tbody>
                                @forelse ($productReportRows as $productReportRow)
                                    <tr data-search-blob="{{ $productReportRow['product_type'] ?? '' }}">
                                        <td>{{ $productReportRow['from_date'] ?? '-' }}</td>
                                        <td>{{ $productReportRow['to_date'] ?? '-' }}</td>
                                        <td>{{ $productReportRow['product_type'] ?? '-' }}</td>
                                        <td>{{ $productReportRow['top_selling'] ?? '-' }}</td>
                                        <td>{{ $productReportRow['most_viewed'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:24px;">No product report data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="reports-inventory-page">
                    @php
                        $inventorySummary = collect($inventorySummary ?? []);
                        $inventoryReportRows = collect($inventoryReportRows ?? []);
                        $inventoryStatusOptions = $inventoryReportRows->pluck('stock_status')->filter()->unique()->values();
                    @endphp
                    <div class="module-head">
                        <h2>Inventory Reports</h2>
                        <p>Monitor current stock, low stock, out of stock items, and stock movement history.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Current Stock</span><strong>{{ number_format((int) ($inventorySummary['total_skus'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Low Stock</span><strong>{{ number_format((int) ($inventorySummary['low_stock'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Out of Stock</span><strong>{{ number_format((int) ($inventorySummary['out_of_stock'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Stock Movement</span><strong>{{ number_format((int) (($inventoryReportRows ?? collect())->count())) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <input type="date" data-filter-index="1">
                            <select data-filter-index="2">
                                <option>All Stock Status</option>
                                @foreach ($inventoryStatusOptions as $inventoryStatusOption)
                                    <option>{{ $inventoryStatusOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Stock Status</th><th>Current Summary</th><th>Low Stock Items</th><th>Out of Stock</th></tr></thead>
                            <tbody>
                                @forelse ($inventoryReportRows as $inventoryReportRow)
                                    <tr data-search-blob="{{ $inventoryReportRow['stock_status'] ?? '' }}">
                                        <td>{{ $inventoryReportRow['from_date'] ?? '-' }}</td>
                                        <td>{{ $inventoryReportRow['to_date'] ?? '-' }}</td>
                                        <td>{{ $inventoryReportRow['stock_status'] ?? '-' }}</td>
                                        <td>{{ $inventoryReportRow['summary'] ?? '-' }}</td>
                                        <td>{{ number_format((int) ($inventoryReportRow['low_stock_items'] ?? 0)) }} items</td>
                                        <td>{{ number_format((int) ($inventoryReportRow['out_of_stock_items'] ?? 0)) }} items</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No inventory report data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="reports-customers-page">
                    @php
                        $customerSummary = collect($customerSummary ?? []);
                        $customerReportRows = collect($customerReportRows ?? []);
                        $customerTypeOptions = $customerReportRows->pluck('customer_type')->filter()->unique()->values();
                    @endphp
                    <div class="module-head">
                        <h2>Customer Reports</h2>
                        <p>Measure registrations, active customers, repeat buyers, and top customer value.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Total Customers</span><strong>{{ number_format((int) ($customerSummary['total_customers'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>New Registrations</span><strong>{{ number_format((int) ($customerSummary['new_registrations'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Active Customers</span><strong>{{ number_format((int) ($customerSummary['active_customers'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Top Buyers</span><strong>{{ number_format((int) ($customerSummary['top_buyers'] ?? 0)) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <input type="date" data-filter-index="1">
                            <select data-filter-index="2">
                                <option>All Customer Type</option>
                                @foreach ($customerTypeOptions as $customerTypeOption)
                                    <option>{{ $customerTypeOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Customer Type</th><th>Total</th><th>Top Buyer</th><th>Repeat Orders</th></tr></thead>
                            <tbody>
                                @forelse ($customerReportRows as $customerReportRow)
                                    <tr data-search-blob="{{ $customerReportRow['customer_type'] ?? '' }} {{ $customerReportRow['top_buyer'] ?? '' }}">
                                        <td>{{ $customerReportRow['from_date'] ?? '-' }}</td>
                                        <td>{{ $customerReportRow['to_date'] ?? '-' }}</td>
                                        <td>{{ $customerReportRow['customer_type'] ?? '-' }}</td>
                                        <td>{{ number_format((int) ($customerReportRow['total'] ?? 0)) }}</td>
                                        <td>{{ $customerReportRow['top_buyer'] ?? '-' }}</td>
                                        <td>{{ number_format((int) ($customerReportRow['repeat_orders'] ?? 0)) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No customer report data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="reports-consultation-page">
                    <div class="module-head">
                        <h2>Consultation Reports</h2>
                        <p>Track consultation demand, approved appointments, completions, and consultant performance.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Total Requests</span><strong>{{ $consultationMetrics['total_requests'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Approved</span><strong>{{ $consultationMetrics['approved_requests'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Completed</span><strong>{{ $consultationMetrics['completed_requests'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Top Consultant</span><strong>{{ $consultationTopConsultant ?? 'Unassigned' }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <select data-filter-index="2">
                                <option value="">All Consultation Type</option>
                                @foreach (($consultationTypeOptions ?? []) as $consultationTypeOption)
                                    <option value="{{ $consultationTypeOption }}">{{ $consultationTypeOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Consultation Type</th><th>Total Requests</th><th>Completed</th><th>Top Consultant</th></tr></thead>
                            <tbody>
                                @forelse (($consultationReportRows ?? collect()) as $consultationReportRow)
                                    <tr data-search-blob="{{ $consultationReportRow['type'] }} {{ $consultationReportRow['top_consultant'] }}" data-report-date="{{ $consultationReportRow['from_date'] }}" data-report-type="{{ $consultationReportRow['type'] }}">
                                        <td>{{ $consultationReportRow['from_date'] }}</td>
                                        <td>{{ $consultationReportRow['to_date'] }}</td>
                                        <td>{{ $consultationReportRow['type'] }}</td>
                                        <td>{{ $consultationReportRow['total_requests'] }}</td>
                                        <td>{{ $consultationReportRow['completed_requests'] }}</td>
                                        <td>{{ $consultationReportRow['top_consultant'] }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;">No consultation report data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="reports-custom-jewellery-page">
                    @php
                        $customJewellerySummary = collect($customJewellerySummary ?? []);
                        $customJewelleryReportRows = collect($customJewelleryReportRows ?? []);
                        $customRequestStatusOptions = $customJewelleryReportRows->pluck('request_status')->filter()->unique()->values();
                    @endphp
                    <div class="module-head">
                        <h2>Custom Jewellery Reports</h2>
                        <p>Monitor custom request volume, approvals, rejections, quotations, and completed custom demand.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Total Requests</span><strong>{{ number_format((int) ($customJewellerySummary['total_requests'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Approved</span><strong>{{ number_format((int) ($customJewellerySummary['approved_requests'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Rejected</span><strong>{{ number_format((int) ($customJewellerySummary['rejected_requests'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Completed Orders</span><strong>{{ number_format((int) ($customJewellerySummary['paid_requests'] ?? 0)) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <input type="date" data-filter-index="1">
                            <select data-filter-index="2">
                                <option>All Request Status</option>
                                @foreach ($customRequestStatusOptions as $customRequestStatusOption)
                                    <option>{{ $customRequestStatusOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Request Status</th><th>Total Requests</th><th>Custom Demand</th><th>Quotation Acceptance</th></tr></thead>
                            <tbody>
                                @forelse ($customJewelleryReportRows as $customJewelleryReportRow)
                                    <tr data-search-blob="{{ $customJewelleryReportRow['request_status'] ?? '' }} {{ $customJewelleryReportRow['custom_demand'] ?? '' }}">
                                        <td>{{ $customJewelleryReportRow['from_date'] ?? '-' }}</td>
                                        <td>{{ $customJewelleryReportRow['to_date'] ?? '-' }}</td>
                                        <td>{{ $customJewelleryReportRow['request_status'] ?? '-' }}</td>
                                        <td>{{ number_format((int) ($customJewelleryReportRow['total_requests'] ?? 0)) }}</td>
                                        <td>{{ $customJewelleryReportRow['custom_demand'] ?? '-' }}</td>
                                        <td>{{ $customJewelleryReportRow['quotation_acceptance'] ?? '0%' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No custom jewellery report data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="reports-revenue-page">
                    @php
                        $revenueSummary = collect($revenueSummary ?? []);
                        $revenueReportRows = collect($revenueReportRows ?? []);
                        $revenueTypeOptions = $revenueReportRows->pluck('revenue_type')->filter()->unique()->values();
                    @endphp
                    <div class="module-head">
                        <h2>Revenue Analytics</h2>
                        <p>Review monthly revenue, gross revenue, seasonal demand, and sales trend insights for planning.</p>
                    </div>
                    <div class="summary-grid report-summary-grid">
                        <div class="summary-card"><span>Monthly Revenue</span><strong>{{ $revenueSummary['monthly_revenue'] ?? 'Rs 0' }}</strong></div>
                        <div class="summary-card"><span>Gross Revenue</span><strong>{{ $revenueSummary['gross_revenue'] ?? 'Rs 0' }}</strong></div>
                        <div class="summary-card"><span>Pickup-only Count</span><strong>{{ number_format((int) ($revenueSummary['pickup_only_count'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Custom Demand Trend</span><strong>{{ $revenueSummary['custom_demand_trend'] ?? '0%' }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="date" data-filter-index="0">
                            <input type="date" data-filter-index="1">
                            <select data-filter-index="2">
                                <option>All Revenue Type</option>
                                @foreach ($revenueTypeOptions as $revenueTypeOption)
                                    <option>{{ $revenueTypeOption }}</option>
                                @endforeach
                            </select>
                            <div class="report-actions">
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-eye"></i><span>View Report</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-pdf"></i><span>Download PDF</span></button>
                                <button class="btn theme report-action-btn" type="button"><i class="fas fa-file-excel"></i><span>Export Excel</span></button>
                            </div>
                        </div>
                        <table>
                            <thead><tr><th>From Date</th><th>To Date</th><th>Revenue Type</th><th>Top Selling Gem</th><th>Popular Category</th><th>Trend Insight</th></tr></thead>
                            <tbody>
                                @forelse ($revenueReportRows as $revenueReportRow)
                                    <tr data-search-blob="{{ $revenueReportRow['revenue_type'] ?? '' }} {{ $revenueReportRow['trend_insight'] ?? '' }}">
                                        <td>{{ $revenueReportRow['from_date'] ?? '-' }}</td>
                                        <td>{{ $revenueReportRow['to_date'] ?? '-' }}</td>
                                        <td>{{ $revenueReportRow['revenue_type'] ?? '-' }}</td>
                                        <td>{{ $revenueReportRow['top_selling_gem'] ?? '-' }}</td>
                                        <td>{{ $revenueReportRow['popular_category'] ?? '-' }}</td>
                                        <td>{{ $revenueReportRow['trend_insight'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No revenue analytics data found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="notifications-send-page">
                    @php
                        $notifications = collect($notificationRows ?? []);
                        $notificationMetrics = $notificationMetrics ?? [];
                        $notificationRoles = collect($notificationRoleOptions ?? ['consultant', 'customer']);
                        $notificationRecipients = collect($notificationRecipientUsers ?? []);
                        $notificationCategories = collect($notificationCategoryOptions ?? []);
                    @endphp
                    <div class="module-head">
                        <h2>Send Notification</h2>
                        <p>Create a notification for customers or consultants.</p>
                    </div>
                    @if (session('notification_success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                if (typeof notify === 'function') {
                                    notify(@json(session('notification_success')), 'success');
                                }
                            });
                        </script>
                    @endif
                    @if (session('content_post_success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                if (typeof notify === 'function') {
                                    notify(@json(session('content_post_success')), 'success');
                                }
                            });
                        </script>
                    @endif
                    @if (session('faq_success'))
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                if (typeof notify === 'function') {
                                    notify(@json(session('faq_success')), 'success');
                                }
                            });
                        </script>
                    @endif
                    @if ($errors->any())
                        <div class="request-flash error">Please check the notification form fields and try again.</div>
                    @endif
                    <div class="table-panel">
                        <form id="notificationForm" class="add-form-grid" method="POST" action="{{ route('admin.notifications.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="action" value="create">
                            <div class="field full">
                                <label>Category</label>
                                <select name="category" required>
                                    <option value="" disabled {{ old('category') ? '' : 'selected' }}>Select a category</option>
                                    @foreach ($notificationCategories as $category)
                                        <option value="{{ $category }}" {{ old('category', 'General') === $category ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field full">
                                <label>Notification Image</label>
                                <input name="notification_image" type="file" accept="image/*">
                            </div>
                            <div class="field">
                                <label>Recipient Role</label>
                                <select name="recipient_role" required>
                                    @foreach ($notificationRoles as $role)
                                        <option value="{{ $role }}" {{ old('recipient_role', 'customer') === $role ? 'selected' : '' }}>
                                            {{ Str::title(str_replace('_', ' ', $role)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Specific User</label>
                                <div class="recipient-search-panel">
                                    <input id="notificationRecipientSearch" type="text" placeholder="Search customer or consultant">
                                    <div id="notificationRecipientResults" class="recipient-search-results" aria-label="Recipient search results"></div>
                                </div>
                                <select id="notificationRecipientSelect" name="recipient_user_id">
                                    <option value="">All users in role</option>
                                    @foreach ($notificationRecipients as $recipient)
                                        <option
                                            value="{{ $recipient['id'] }}"
                                            data-recipient-role="{{ $recipient['role'] ?? '' }}"
                                            data-recipient-name="{{ $recipient['name'] ?? '' }}"
                                            {{ (string) old('recipient_user_id') === (string) $recipient['id'] ? 'selected' : '' }}
                                        >
                                            {{ $recipient['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="field">
                                <label>Notification Title</label>
                                <input name="title" type="text" value="{{ old('title') }}" placeholder="New Gem Arrival" required>
                            </div>
                            <div class="field">
                                <label>Action Label</label>
                                <input name="action_label" type="text" value="{{ old('action_label') }}" placeholder="View Order">
                            </div>

                            <div class="field full">
                                <label>Message</label>
                                <textarea name="message" placeholder="Write the notification message here..." required>{{ old('message') }}</textarea>
                            </div>
                            <div class="field full" style="display:flex;gap:10px;justify-content:flex-end;">
                                <button class="btn theme" type="submit">Send Notification</button>
                            </div>
                        </form>
                    </div>
                </section>

                <section class="module-page" id="notifications-list-page">
                    <div class="module-head">
                        <h2>All Notifications</h2>
                        <p>View notifications stored in the site_notifications table.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Notifications</span><strong>{{ number_format((int) ($notificationMetrics['total_notifications'] ?? $notifications->count())) }}</strong></div>
                        <div class="summary-card"><span>Unread</span><strong>{{ number_format((int) ($notificationMetrics['unread_notifications'] ?? $notifications->where('status', 'Unread')->count())) }}</strong></div>
                        <div class="summary-card"><span>Read</span><strong>{{ number_format((int) ($notificationMetrics['read_notifications'] ?? $notifications->where('status', 'Read')->count())) }}</strong></div>
                        <div class="summary-card"><span>With Actions</span><strong>{{ number_format((int) ($notificationMetrics['actionable_notifications'] ?? $notifications->filter(fn ($row) => filled($row['action_label']) || filled($row['action_url']))->count())) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search notification">
                            <select data-filter-index="2">
                                <option>All Category</option>
                                @foreach ($notificationCategories as $category)
                                    <option>{{ $category }}</option>
                                @endforeach
                            </select>
                            <select data-filter-index="6"><option>All Status</option><option>Unread</option><option>Read</option></select>
                            <input type="date" data-filter-index="5">
                        </div>
                        <table>
                            <thead><tr><th>ID</th><th>Title</th><th>Category</th><th>Recipient</th><th>Message</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody id="notificationsListTableBody">
                                @forelse ($notifications as $notification)
                                    <tr
                                        data-notification-db-id="{{ $notification['db_id'] ?? '' }}"
                                        data-notification-id="{{ $notification['notification_id'] ?? '' }}"
                                        data-title="{{ $notification['title'] ?? '' }}"
                                        data-message="{{ $notification['message'] ?? '' }}"
                                        data-category="{{ $notification['category'] ?? '' }}"
                                        data-image-url="{{ $notification['image_url'] ?? '' }}"
                                        data-recipient-role="{{ $notification['recipient_role_raw'] ?? '' }}"
                                        data-recipient-user-name="{{ $notification['recipient_user_name'] ?? '' }}"
                                        data-recipient-label="{{ $notification['recipient_label'] ?? '' }}"
                                        data-published-date="{{ $notification['published_date'] ?? '' }}"
                                        data-published-datetime="{{ $notification['published_datetime'] ?? '' }}"
                                        data-status="{{ $notification['status'] ?? '' }}"
                                        data-action-label="{{ $notification['action_label'] ?? '' }}"
                                        data-action-url="{{ $notification['action_url'] ?? '' }}"
                                        data-search-blob="{{ $notification['search_blob'] ?? '' }}"
                                    >
                                        <td>{{ $notification['notification_id'] ?? '-' }}</td>
                                        <td>{{ $notification['title'] ?? '-' }}</td>
                                        <td>{{ $notification['category'] ?? '-' }}</td>
                                        <td>{{ $notification['recipient_label'] ?? '-' }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($notification['message'] ?? '-', 54) }}</td>
                                        <td>{{ $notification['published_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $notification['status_class'] ?? 'unread' }}">{{ $notification['status'] ?? 'Unread' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button" data-notification-action="view">View</button>
                                                <form method="POST" action="{{ route('admin.notifications.delete', $notification['db_id'] ?? 0) }}" onsubmit="return confirm('Delete this notification?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="mini-btn" type="submit">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:24px;">No notifications found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="content-blogs-page">
                    <div class="module-head">
                        <h2>Blog Management</h2>
                        <p>Live blog posts are pulled from the database. Use the editor for create, edit, publish, and delete actions.</p>
                        <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
                            <a class="btn theme" href="{{ route('admin.content-posts', ['type' => 'blog']) }}">Add Blog</a>
                            <a class="btn" href="{{ route('blogs') }}">View Public Blog</a>
                        </div>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Blogs</span><strong>{{ $adminBlogSummary['total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Published</span><strong>{{ $adminBlogSummary['published'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Draft</span><strong>{{ $adminBlogSummary['draft'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Zodiac Stories</span><strong>{{ $adminBlogSummary['zodiac'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <a class="btn-soft" href="{{ route('admin.content-posts', ['type' => 'blog']) }}">Open Blog Editor</a>
                        </div>
                        <table>
                            <thead><tr><th>ID</th><th>Title</th><th>Excerpt</th><th>Image</th><th>Category</th><th>Author</th><th>Published</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($adminBlogPosts ?? collect()) as $post)
                                    <tr data-delete-url="{{ route('admin.content-posts.destroy', ['contentPost' => $post->slug]) }}" data-content-kind="blog">
                                        <td>BLG-{{ str_pad((string) $post->id, 3, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <strong>{{ $post->title }}</strong><br>
                                            <span style="color:var(--muted);">{{ $post->slug }}</span>
                                        </td>
                                        <td>{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 90) }}</td>
                                        <td>
                                            <img src="{{ $post->featured_image_url ?? asset('images/placeholders/notavailable.png') }}" alt="{{ $post->title }}" style="width:64px;height:44px;object-fit:cover;border-radius:12px;border:1px solid #efdfca;">
                                        </td>
                                        <td>{{ $post->category ?: '-' }}</td>
                                        <td>{{ $post->author_name }}</td>
                                        <td>{{ optional($post->published_at)->format('Y-m-d') ?? '-' }}</td>
                                        <td><span class="status {{ $post->is_published ? 'ok' : 'warn' }}">{{ $post->is_published ? 'Published' : 'Draft' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <a class="mini-btn" href="{{ $post->is_published ? route('blogs.show', $post) : route('admin.content-posts', ['edit' => $post->slug]) }}">View</a>
                                                <a class="mini-btn" href="{{ route('admin.content-posts', ['edit' => $post->slug]) }}">Edit</a>
                                                <form method="POST" action="{{ route('admin.content-posts.destroy', ['contentPost' => $post->slug]) }}" data-content-delete-form="1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="mini-btn" type="submit" data-content-delete="1">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" style="text-align:center;color:var(--muted);padding:24px;">No blog posts have been added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="content-news-page">
                    <div class="module-head">
                        <h2>News Management</h2>
                        <p>Live news updates are pulled from the database. Use the editor for create, edit, publish, and delete actions.</p>
                        <div style="margin-top:14px;display:flex;gap:10px;flex-wrap:wrap;">
                            <a class="btn theme" href="{{ route('admin.content-posts', ['type' => 'news']) }}">Add News</a>
                            <a class="btn" href="{{ route('blogs') }}">View Public News</a>
                        </div>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total News</span><strong>{{ $adminNewsSummary['total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Live Updates</span><strong>{{ $adminNewsSummary['published'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Drafts</span><strong>{{ $adminNewsSummary['draft'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Event Posts</span><strong>{{ $adminNewsSummary['events'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <a class="btn-soft" href="{{ route('admin.content-posts', ['type' => 'news']) }}">Open News Editor</a>
                        </div>
                        <table>
                            <thead><tr><th>ID</th><th>Title</th><th>Excerpt</th><th>Image</th><th>Category</th><th>Author</th><th>Published</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($adminNewsPosts ?? collect()) as $post)
                                    <tr data-delete-url="{{ route('admin.content-posts.destroy', ['contentPost' => $post->slug]) }}" data-content-kind="news">
                                        <td>NWS-{{ str_pad((string) $post->id, 3, '0', STR_PAD_LEFT) }}</td>
                                        <td>
                                            <strong>{{ $post->title }}</strong><br>
                                            <span style="color:var(--muted);">{{ $post->slug }}</span>
                                        </td>
                                        <td>{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 90) }}</td>
                                        <td>
                                            <img src="{{ $post->featured_image_url ?? asset('images/placeholders/notavailable.png') }}" alt="{{ $post->title }}" style="width:64px;height:44px;object-fit:cover;border-radius:12px;border:1px solid #efdfca;">
                                        </td>
                                        <td>{{ $post->category ?: '-' }}</td>
                                        <td>{{ $post->author_name }}</td>
                                        <td>{{ optional($post->published_at)->format('Y-m-d') ?? '-' }}</td>
                                        <td><span class="status {{ $post->is_published ? 'ok' : 'warn' }}">{{ $post->is_published ? 'Published' : 'Draft' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <a class="mini-btn" href="{{ $post->is_published ? route('blogs.show', $post) : route('admin.content-posts', ['edit' => $post->slug]) }}">View</a>
                                                <a class="mini-btn" href="{{ route('admin.content-posts', ['edit' => $post->slug]) }}">Edit</a>
                                                <form method="POST" action="{{ route('admin.content-posts.destroy', ['contentPost' => $post->slug]) }}" data-content-delete-form="1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="mini-btn" type="submit" data-content-delete="1">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" style="text-align:center;color:var(--muted);padding:24px;">No news posts have been added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="content-faq-page">
                    <div class="module-head">
                        <h2>FAQ Management</h2>
                        <p>Live FAQ entries are pulled from the database. The dedicated editor handles create, update, publish, and delete actions.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total FAQs</span><strong>{{ $adminFaqSummary['total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Published</span><strong>{{ $adminFaqSummary['published'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Draft</span><strong>{{ $adminFaqSummary['draft'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Consultation</span><strong>{{ $adminFaqSummary['consultation'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <a class="btn theme" href="{{ route('admin.faq-entries') }}">Open FAQ Editor</a>
                            <a class="btn" href="{{ route('faq') }}">View Public FAQ</a>
                        </div>
                        <table>
                            <thead><tr><th>ID</th><th>Question</th><th>Answer</th><th>Group</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($adminFaqEntries ?? collect()) as $entry)
                                    <tr data-delete-url="{{ route('admin.faq-entries.destroy', ['faqEntry' => $entry->id]) }}" data-content-kind="faq">
                                        <td>FAQ-{{ str_pad((string) $entry->id, 3, '0', STR_PAD_LEFT) }}</td>
                                        <td><strong>{{ $entry->question }}</strong></td>
                                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($entry->answer), 90) }}</td>
                                        <td>{{ $entry->group_name }}</td>
                                        <td><span class="status {{ $entry->is_published ? 'ok' : 'warn' }}">{{ $entry->is_published ? 'Published' : 'Draft' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View</button>
                                                <a class="mini-btn" href="{{ route('admin.faq-entries', ['edit' => $entry->id]) }}">Edit</a>
                                                <form method="POST" action="{{ route('admin.faq-entries.destroy', ['faqEntry' => $entry->id]) }}" data-content-delete-form="1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="mini-btn" type="submit" data-content-delete="1">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;color:var(--muted);padding:24px;">No FAQ entries have been added yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="content-gold-price-page">
                    <div class="module-head">
                        <h2>Metal Price Updates</h2>
                        <p>Live metal prices are pulled from the Metal Price API and cached for the dashboard. Use the filters below to inspect each metal.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Gold / g</span><strong>{{ isset($metalSummaryMap['Gold']) ? number_format((float) $metalSummaryMap['Gold']['price_per_gram'], 2) . ' ' . $metalSummaryMap['Gold']['quote_currency'] : 'N/A' }}</strong></div>
                        <div class="summary-card"><span>Silver / g</span><strong>{{ isset($metalSummaryMap['Silver']) ? number_format((float) $metalSummaryMap['Silver']['price_per_gram'], 2) . ' ' . $metalSummaryMap['Silver']['quote_currency'] : 'N/A' }}</strong></div>
                        <div class="summary-card"><span>Platinum / g</span><strong>{{ isset($metalSummaryMap['Platinum']) ? number_format((float) $metalSummaryMap['Platinum']['price_per_gram'], 2) . ' ' . $metalSummaryMap['Platinum']['quote_currency'] : 'N/A' }}</strong></div>
                        <div class="summary-card"><span>Snapshot</span><strong>{{ $metalSnapshotAt ? $metalSnapshotAt->format('Y-m-d h:i A') : 'No data' }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search metal price entry">
                            <select data-filter-index="1">
                                <option>All Metals</option>
                                @foreach (($metalFilterOptions ?? collect()) as $metalOption)
                                    <option>{{ $metalOption }}</option>
                                @endforeach
                            </select>
                            <input type="date" data-filter-index="7">
                        </div>
                        <table>
                            <thead><tr><th>ID</th><th>Metal</th><th>Symbol</th><th>Price/Troy Oz</th><th>Price/Gram</th><th>Adjusted/Gram</th><th>Quote</th><th>Snapshot</th></tr></thead>
                            <tbody>
                                @forelse (($metalPriceRows ?? collect()) as $row)
                                    <tr data-metal="{{ $row['metal'] }}" data-snapshot-date="{{ $row['snapshot_date'] }}">
                                        <td>{{ $row['id'] }}</td>
                                        <td>{{ $row['metal'] }}</td>
                                        <td>{{ $row['symbol'] }}</td>
                                        <td>{{ number_format((float) $row['price_per_troy_ounce'], 2) }} {{ $row['quote_currency'] }}</td>
                                        <td>{{ number_format((float) $row['price_per_gram'], 2) }} {{ $row['quote_currency'] }}</td>
                                        <td>{{ number_format((float) $row['adjusted_price_per_gram'], 2) }} {{ $row['quote_currency'] }}</td>
                                        <td>{{ $row['quote_currency'] }}</td>
                                        <td>{{ $row['snapshot_date'] }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:24px;">No metal price data is available yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
                <section class="module-page" id="contact-messages-page">
                    <div class="module-head">
                        <h2>Contact Messages</h2>
                        <p>Review website contact form inquiries, reply to customers, and keep message handling organized.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Messages</span><strong id="contactSummaryTotal">{{ number_format((int) ($adminContactSummary['total'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Unread</span><strong id="contactSummaryUnread">{{ number_format((int) ($adminContactSummary['unread'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Read</span><strong id="contactSummaryRead">{{ number_format((int) ($adminContactSummary['read'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Replied</span><strong id="contactSummaryReplied">{{ number_format((int) ($adminContactSummary['replied'] ?? 0)) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search contact message">
                            <select data-filter-index="5">
                                <option>All Status</option>
                                @foreach (($adminContactStatusOptions ?? collect(['Unread', 'Read', 'Replied'])) as $statusOption)
                                    <option>{{ $statusOption }}</option>
                                @endforeach
                            </select>
                            <input type="date" data-filter-index="3">
                        </div>
                        <table>
                            <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Date</th><th>Message</th><th>Status</th><th>Subject</th><th>Actions</th></tr></thead>
                            <tbody id="contactMessagesTableBody">
                                @forelse (($adminContactMessages ?? collect()) as $message)
                                    @php
                                        $status = $message['status'] ?? 'Unread';
                                        $canMarkRead = $status === 'Unread';
                                    @endphp
                                    <tr
                                        data-generated="contact-message"
                                        data-message-id="{{ $message['db_id'] }}"
                                        data-contact-id="{{ $message['db_id'] }}"
                                        data-name="{{ $message['name'] }}"
                                        data-email="{{ $message['email'] }}"
                                        data-date="{{ $message['date'] }}"
                                        data-message="{{ $message['message'] }}"
                                        data-subject="{{ $message['subject'] }}"
                                        data-status="{{ $status }}"
                                        data-status-class="{{ $message['status_class'] }}"
                                        data-reply-message="{{ $message['reply_message'] }}"
                                        data-reply-date="{{ $message['reply_date'] }}"
                                        data-reply-by="{{ $message['reply_by'] }}"
                                        data-search-blob="{{ $message['search_blob'] }}"
                                    >
                                        <td>{{ $message['message_id'] }}</td>
                                        <td>{{ $message['name'] }}</td>
                                        <td>{{ $message['email'] }}</td>
                                        <td>{{ $message['date'] }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit($message['message'], 54) }}</td>
                                        <td><span class="status {{ $message['status_class'] }}">{{ $status }}</span></td>
                                        <td>{{ $message['subject'] }}</td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button" data-contact-action="view">View</button>
                                                @if ($canMarkRead)
                                                    <button class="mini-btn" type="button" data-contact-action="mark-read">Mark as Read</button>
                                                @endif
                                                <button class="mini-btn" type="button" data-contact-action="reply">Reply</button>
                                                <button class="mini-btn" type="button" data-contact-action="delete">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:24px;">No contact messages have been sent yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                @php
                    $allOrders = collect($orderRows ?? []);
                    $orderMetrics = $orderMetrics ?? [];
                @endphp
                <section class="module-page" id="orders-all-page">
                    <div class="module-head">
                        <h2>All Orders</h2>
                        <p>Track the live order list from the database, search by order ID or customer, and review pickup and delivery orders in one place.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Orders</span><strong>{{ number_format((int) ($orderMetrics['total_orders'] ?? $allOrders->count())) }}</strong></div>
                        <div class="summary-card"><span>Pending Today</span><strong>{{ number_format((int) ($orderMetrics['pending_today'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>Pickup Orders</span><strong>{{ number_format((int) ($orderMetrics['pickup_orders'] ?? 0)) }}</strong></div>
                        <div class="summary-card"><span>High-value Alerts</span><strong>{{ number_format((int) ($orderMetrics['high_value_orders'] ?? 0)) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search order ID or customer name">
                            <input type="date" data-filter-index="8">
                            <select data-filter-index="9"><option>All Status</option><option>Pending</option><option>Processing</option><option>Out for Delivery</option><option>Ready For Pickup</option><option>Completed</option><option>Cancelled</option></select>
                            <select id="ordersAllPaymentFilter" data-payment-filter>
                                <option value="">All Payment</option>
                                <option value="bank">Bank Transfer</option>
                                <option value="card">Card</option>
                                <option value="cod">Cash on Delivery</option>
                            </select>
                            <select id="ordersAllShippingFilter" data-shipping-filter>
                                <option value="">All Shipping</option>
                                <option value="standard">Standard Shipping</option>
                                <option value="express">Express Shipping</option>
                                <option value="pickup">Store Pickup</option>
                            </select>
                            <button class="btn theme report-action-btn" type="button" data-order-export="all-orders"><i class="fas fa-file-csv"></i><span>Export CSV</span></button>
                        </div>
                        <table class="orders-data-table">
                            <thead><tr><th>Order ID</th><th>Customer</th><th>Products</th><th>Total</th><th>Paid</th><th>Outstanding</th><th>Payment</th><th>Shipping</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse ($allOrders as $order)
                                    @php $pickupPaidInFull = !empty($order['pickup_only']) && in_array(strtolower((string) ($order['status'] ?? '')), ['completed', 'pickup completed'], true); @endphp
                                    <tr
                                        data-order-db-id="{{ $order['db_id'] ?? '' }}"
                                        data-order-id="{{ $order['order_id'] ?? '' }}"
                                        data-order-type="{{ $order['order_type'] ?? 'delivery' }}"
                                        data-pickup-only="{{ !empty($order['pickup_only']) ? '1' : '0' }}"
                                        data-deposit-amount="{{ $pickupPaidInFull ? ($order['total_value'] ?? 0) : ($order['deposit_amount'] ?? 0) }}"
                                        data-balance-due="{{ $pickupPaidInFull ? 0 : ($order['balance_due'] ?? 0) }}"
                                        data-pickup-config="{{ $order['pickup_config'] ?? '' }}"
                                        data-placed-by="{{ $order['placed_by'] ?? '' }}"
                                        data-total-value="{{ $order['total_value'] ?? 0 }}"
                                        data-payment-method="{{ $order['payment_method'] ?? '' }}"
                                        data-payment-method-key="{{ $order['payment_method_key'] ?? '' }}"
                                        data-receipt-image="{{ $order['receipt_image'] ?? '' }}"
                                        data-shipping-method="{{ $order['shipping_method'] ?? 'standard' }}"
                                        data-search-blob="{{ $order['search_blob'] ?? '' }}"
                                        data-order-status="{{ $order['status'] ?? '' }}"
                                        data-order-date="{{ $order['order_date'] ?? '' }}"
                                        data-customer-name="{{ $order['customer_name'] ?? '' }}"
                                    >
                                        <td>{{ $order['order_id'] ?? '-' }}</td>
                                        <td>{{ $order['customer_name'] ?? '-' }}</td>
                                        <td>{{ $order['products'] ?? '-' }}</td>
                                        <td>{{ $order['total_amount'] ?? '-' }}</td>
                                        <td>Rs {{ number_format((float) ($pickupPaidInFull ? ($order['total_value'] ?? 0) : (!empty($order['pickup_only']) ? ($order['deposit_amount'] ?? 0) : ($order['total_value'] ?? 0))), 0) }}</td>
                                        <td>Rs {{ number_format((float) ($pickupPaidInFull ? 0 : (!empty($order['pickup_only']) ? ($order['balance_due'] ?? 0) : 0)), 0) }}</td>
                                        <td>{{ $order['payment_method'] ?? '-' }}</td>
                                        <td>{{ $order['shipping_method_label'] ?? 'Standard Shipping' }}</td>
                                        <td>{{ $order['order_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $order['status_class'] ?? 'info' }}">{{ $order['status'] ?? 'Pending' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                                <button class="mini-btn" type="button">Change Status</button>
                                                <button class="mini-btn" type="button">Print Invoice</button>
                                                @if (strtolower((string) ($order['payment_method_key'] ?? '')) === 'bank' && !empty($order['receipt_image']))
                                                    <a class="mini-btn" href="{{ $order['receipt_image'] }}" download rel="noopener">Receipt</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="11" style="text-align:center;color:var(--muted);padding:24px;">No orders found in the database.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="orders-delivery-page">
                    <div class="module-head">
                        <h2>Delivery Orders</h2>
                        <p>Track live orders that are currently out for delivery.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Delivery Orders</span><strong>{{ number_format($deliveryOrderRows->count()) }}</strong></div>
                        <div class="summary-card"><span>Delivery Today</span><strong>{{ number_format($deliveryOrderRows->where('order_date', now()->toDateString())->count()) }}</strong></div>
                        <div class="summary-card"><span>High-value Delivery</span><strong>{{ number_format($deliveryOrderRows->filter(fn ($order) => (float) ($order['total_value'] ?? 0) >= 40000)->count()) }}</strong></div>
                        <div class="summary-card"><span>Pickup Crossovers</span><strong>{{ number_format($deliveryOrderRows->where('pickup_only', true)->count()) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search delivery order">
                            <input type="date" data-filter-index="8">
                            <select data-filter-index="9"><option>All Status</option><option>Pending</option><option>Processing</option><option>Out for Delivery</option><option>Completed</option><option>Cancelled</option></select>
                            <select data-payment-filter><option value="">All Payment</option><option value="bank">Bank Transfer</option><option value="card">Card</option><option value="cod">Cash on Delivery</option></select>
                            <select data-shipping-filter>
                                <option value="">All Shipping</option>
                                <option value="standard">Standard Shipping</option>
                                <option value="express">Express Shipping</option>
                            </select>
                        </div>
                        <table class="orders-data-table">
                            <thead><tr><th>Order ID</th><th>Customer</th><th>Products</th><th>Total</th><th>Paid</th><th>Outstanding</th><th>Payment</th><th>Shipping</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse ($deliveryOrderRows as $order)
                                    @php $pickupPaidInFull = !empty($order['pickup_only']) && in_array(strtolower((string) ($order['status'] ?? '')), ['completed', 'pickup completed'], true); @endphp
                                    <tr
                                        data-order-db-id="{{ $order['db_id'] ?? '' }}"
                                        data-order-id="{{ $order['order_id'] ?? '' }}"
                                        data-order-type="{{ $order['order_type'] ?? 'delivery' }}"
                                        data-pickup-only="{{ !empty($order['pickup_only']) ? '1' : '0' }}"
                                        data-deposit-amount="{{ $pickupPaidInFull ? ($order['total_value'] ?? 0) : ($order['deposit_amount'] ?? 0) }}"
                                        data-balance-due="{{ $pickupPaidInFull ? 0 : ($order['balance_due'] ?? 0) }}"
                                        data-pickup-config="{{ $order['pickup_config'] ?? '' }}"
                                        data-placed-by="{{ $order['placed_by'] ?? '' }}"
                                        data-total-value="{{ $order['total_value'] ?? 0 }}"
                                        data-payment-method="{{ $order['payment_method'] ?? '' }}"
                                        data-payment-method-key="{{ $order['payment_method_key'] ?? '' }}"
                                        data-receipt-image="{{ $order['receipt_image'] ?? '' }}"
                                        data-search-blob="{{ $order['search_blob'] ?? '' }}"
                                        data-order-status="{{ $order['status'] ?? '' }}"
                                        data-order-date="{{ $order['order_date'] ?? '' }}"
                                        data-customer-name="{{ $order['customer_name'] ?? '' }}"
                                    >
                                        <td>{{ $order['order_id'] ?? '-' }}</td>
                                        <td>{{ $order['customer_name'] ?? '-' }}</td>
                                        <td>{{ $order['products'] ?? '-' }}</td>
                                        <td>{{ $order['total_amount'] ?? '-' }}</td>
                                        <td>Rs {{ number_format((float) ($pickupPaidInFull ? ($order['total_value'] ?? 0) : (!empty($order['pickup_only']) ? ($order['deposit_amount'] ?? 0) : ($order['total_value'] ?? 0))), 0) }}</td>
                                        <td>Rs {{ number_format((float) ($pickupPaidInFull ? 0 : (!empty($order['pickup_only']) ? ($order['balance_due'] ?? 0) : 0)), 0) }}</td>
                                        <td>{{ $order['payment_method'] ?? '-' }}</td>
                                        <td>{{ $order['shipping_method_label'] ?? 'Standard Shipping' }}</td>
                                        <td>{{ $order['order_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $order['status_class'] ?? 'info' }}">{{ $order['status'] ?? 'Out for Delivery' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button" data-user-action="view">View</button>
                                                @if (strtolower((string) ($order['payment_method_key'] ?? '')) === 'bank' && !empty($order['receipt_image']))
                                                    <a class="mini-btn" href="{{ $order['receipt_image'] }}" download rel="noopener">Receipt</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="11" style="text-align:center;color:var(--muted);padding:24px;">No delivery orders found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="orders-pickup-page">
                    <div class="module-head">
                        <h2>Pickup Orders</h2>
                        <p>Review pickup orders that were created from the live checkout flow.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Pickup Orders</span><strong>{{ number_format($pickupOrderRows->count()) }}</strong></div>
                        <div class="summary-card"><span>Pending Pickup</span><strong>{{ number_format($pickupOrderRows->where('status', 'Pending')->count()) }}</strong></div>
                        <div class="summary-card"><span>Completed Pickup</span><strong>{{ number_format($pickupOrderRows->where('status', 'Completed')->count() + $pickupOrderRows->where('status', 'Pickup Completed')->count()) }}</strong></div>
                        <div class="summary-card"><span>High-value Pickup</span><strong>{{ number_format($pickupOrderRows->filter(fn ($order) => (float) ($order['total_value'] ?? 0) >= 40000)->count()) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search pickup order">
                            <input type="date" data-filter-index="8">
                            <select data-filter-index="9"><option>All Status</option><option>Pending</option><option>Processing</option><option>Ready For Pickup</option><option>Pickup Completed</option><option>Completed</option><option>Cancelled</option></select>
                            <select data-payment-filter><option value="">All Payment</option><option value="bank">Bank Transfer</option><option value="card">Card</option><option value="cod">Cash on Delivery</option></select>
                        </div>
                        <table class="orders-data-table">
                            <thead><tr><th>Order ID</th><th>Customer</th><th>Products</th><th>Total</th><th>Paid</th><th>Outstanding</th><th>Payment</th><th>Shipping</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse ($pickupOrderRows as $order)
                                    @php $pickupPaidInFull = !empty($order['pickup_only']) && in_array(strtolower((string) ($order['status'] ?? '')), ['completed', 'pickup completed'], true); @endphp
                                    <tr
                                        data-order-db-id="{{ $order['db_id'] ?? '' }}"
                                        data-order-id="{{ $order['order_id'] ?? '' }}"
                                        data-order-type="{{ $order['order_type'] ?? 'pickup' }}"
                                        data-pickup-only="{{ !empty($order['pickup_only']) ? '1' : '0' }}"
                                        data-deposit-amount="{{ $pickupPaidInFull ? ($order['total_value'] ?? 0) : ($order['deposit_amount'] ?? 0) }}"
                                        data-balance-due="{{ $pickupPaidInFull ? 0 : ($order['balance_due'] ?? 0) }}"
                                        data-pickup-config="{{ $order['pickup_config'] ?? '' }}"
                                        data-placed-by="{{ $order['placed_by'] ?? '' }}"
                                        data-total-value="{{ $order['total_value'] ?? 0 }}"
                                        data-payment-method="{{ $order['payment_method'] ?? '' }}"
                                        data-payment-method-key="{{ $order['payment_method_key'] ?? '' }}"
                                        data-receipt-image="{{ $order['receipt_image'] ?? '' }}"
                                        data-search-blob="{{ $order['search_blob'] ?? '' }}"
                                        data-order-status="{{ $order['status'] ?? '' }}"
                                        data-order-date="{{ $order['order_date'] ?? '' }}"
                                        data-customer-name="{{ $order['customer_name'] ?? '' }}"
                                    >
                                        <td>{{ $order['order_id'] ?? '-' }}</td>
                                        <td>{{ $order['customer_name'] ?? '-' }}</td>
                                        <td>{{ $order['products'] ?? '-' }}</td>
                                        <td>{{ $order['total_amount'] ?? '-' }}</td>
                                        <td>Rs {{ number_format((float) ($pickupPaidInFull ? ($order['total_value'] ?? 0) : (!empty($order['pickup_only']) ? ($order['deposit_amount'] ?? 0) : ($order['total_value'] ?? 0))), 0) }}</td>
                                        <td>Rs {{ number_format((float) ($pickupPaidInFull ? 0 : (!empty($order['pickup_only']) ? ($order['balance_due'] ?? 0) : 0)), 0) }}</td>
                                        <td>{{ $order['payment_method'] ?? '-' }}</td>
                                        <td>{{ $order['shipping_method_label'] ?? 'Store Pickup' }}</td>
                                        <td>{{ $order['order_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $order['status_class'] ?? 'pickup' }}">{{ $order['status'] ?? 'Pending' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                                @if (strtolower((string) ($order['payment_method_key'] ?? '')) === 'bank' && !empty($order['receipt_image']))
                                                    <a class="mini-btn" href="{{ $order['receipt_image'] }}" download rel="noopener">Receipt</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="11" style="text-align:center;color:var(--muted);padding:24px;">No pickup orders found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="orders-returns-page">
                    <div class="module-head">
                        <h2>Returns & Refunds</h2>
                        <p>Handle return requests, approve or reject them, and keep refund processing visible for the admin team.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Return Requests</span><strong>{{ number_format($returnMetrics['total_returns'] ?? 0) }}</strong></div>
                        <div class="summary-card"><span>Awaiting Review</span><strong>{{ number_format($returnMetrics['awaiting_review'] ?? 0) }}</strong></div>
                        <div class="summary-card"><span>Approved Refunds</span><strong>{{ number_format($returnMetrics['approved_refunds'] ?? 0) }}</strong></div>
                        <div class="summary-card"><span>Rejected Requests</span><strong>{{ number_format($returnMetrics['rejected_requests'] ?? 0) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search return request">
                            <select data-filter-index="5"><option>All Decisions</option><option>Pending Review</option><option>Approved</option><option>Rejected</option></select>
                            <select data-filter-index="6"><option>All Refund Status</option><option>In Progress</option><option>Refunded</option></select>
                        </div>
                        <table>
                            <thead><tr><th>Request ID</th><th>Order ID</th><th>Customer Name</th><th>Reason</th><th>Requested Date</th><th>Decision</th><th>Refund Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($returnRequestRows ?? collect()) as $returnRequest)
                                    @php
                                        $decisionLower = strtolower((string) ($returnRequest['decision'] ?? ''));
                                        $refundLower = strtolower((string) ($returnRequest['refund_status'] ?? ''));
                                    @endphp
                                    <tr
                                        data-return-db-id="{{ $returnRequest['db_id'] ?? '' }}"
                                        data-order-id="{{ $returnRequest['order_id'] ?? '' }}"
                                        data-request-id="{{ $returnRequest['request_id'] ?? '' }}"
                                        data-search-blob="{{ $returnRequest['search_blob'] ?? '' }}"
                                        data-admin-note="{{ $returnRequest['admin_note'] ?? '' }}"
                                        data-refund-amount="{{ $returnRequest['refund_amount'] ?? '' }}"
                                        data-reviewed-by="{{ $returnRequest['reviewed_by'] ?? '' }}"
                                        data-reviewed-at="{{ $returnRequest['reviewed_at'] ?? '' }}"
                                        data-order-status="{{ $returnRequest['order_status'] ?? '' }}"
                                    >
                                        <td>{{ $returnRequest['request_id'] ?? '-' }}</td>
                                        <td>{{ $returnRequest['order_id'] ?? '-' }}</td>
                                        <td>{{ $returnRequest['customer_name'] ?? '-' }}</td>
                                        <td>{{ $returnRequest['reason'] ?? '-' }}</td>
                                        <td>{{ $returnRequest['requested_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $returnRequest['decision_class'] ?? 'warn' }}">{{ $returnRequest['decision'] ?? 'Pending Review' }}</span></td>
                                        <td><span class="status {{ $returnRequest['refund_status_class'] ?? 'info' }}">{{ $returnRequest['refund_status'] ?? 'In Progress' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                                @if ($decisionLower === 'pending review')
                                                    <button class="mini-btn" type="button">Approve</button>
                                                    <button class="mini-btn" type="button">Reject</button>
                                                @elseif ($decisionLower === 'approved' && $refundLower !== 'refunded')
                                                    <button class="mini-btn" type="button">Mark Refunded</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" style="text-align:center;color:var(--muted);padding:24px;">No return requests yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                @php
                    $customRequests = collect($customRequestRows ?? []);
                    $customPending = collect($customPendingRows ?? []);
                    $customQuotations = collect($customQuotationRows ?? []);
                    $customPaid = collect($customPaidRows ?? []);
                    $customMetrics = $customMetrics ?? [];
                    $customRequestStatusOptions = collect(['Pending', 'Approved', 'Quoted', 'Rejected']);
                    $customQuotationDecisionOptions = collect(['Sent', 'Accepted', 'Rejected', 'Paid']);
                @endphp
                <section class="module-page" id="custom-requests-page">
                    <div class="module-head">
                        <h2>Custom Requests</h2>
                        <p>View all personalized jewellery requests with customer details, design notes, engraving, and uploaded references.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Requests</span><strong>{{ number_format((int) ($customMetrics['total_requests'] ?? $customRequests->count())) }}</strong></div>
                        <div class="summary-card"><span>Pending Review</span><strong>{{ number_format((int) ($customMetrics['pending_review'] ?? $customPending->count())) }}</strong></div>
                        <div class="summary-card"><span>Quotations</span><strong>{{ number_format((int) ($customMetrics['quoted_requests'] ?? $customQuotations->count())) }}</strong></div>
                        <div class="summary-card"><span>Paid</span><strong>{{ number_format((int) ($customMetrics['paid_requests'] ?? $customPaid->count())) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search request ID or customer">
                            <input type="date" data-filter-index="7">
                            <select data-filter-index="8">
                                <option>All Request Status</option>
                                @foreach ($customRequestStatusOptions as $statusOption)
                                    <option>{{ $statusOption }}</option>
                                @endforeach
                            </select>
                            <select data-filter-index="9">
                                <option>All Quotation Status</option>
                                @foreach ($customQuotationDecisionOptions as $decisionOption)
                                    <option>{{ $decisionOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table>
                            <thead><tr><th>Request ID</th><th>Customer Name</th><th>Gem Type</th><th>Metal</th><th>Size</th><th>Engraving</th><th>Reference Image</th><th>Date</th><th>Request Status</th><th>Quotation Status</th><th>Actions</th></tr></thead>
                            <tbody id="customRequestsTableBody">
                                @forelse ($customRequests as $customRequest)
                                    <tr
                                        data-custom-request-id="{{ $customRequest['db_id'] ?? '' }}"
                                        data-request-id="{{ $customRequest['request_id'] ?? '' }}"
                                        data-customer-name="{{ $customRequest['customer_name'] ?? '' }}"
                                        data-gem-type="{{ $customRequest['gem_type'] ?? '' }}"
                                        data-metal="{{ $customRequest['metal'] ?? '' }}"
                                        data-size="{{ $customRequest['size'] ?? '' }}"
                                        data-engraving="{{ $customRequest['engraving'] ?? '' }}"
                                        data-reference-images="{{ implode('|', $customRequest['reference_images'] ?? []) }}"
                                        data-date="{{ $customRequest['requested_date'] ?? '' }}"
                                        data-status="{{ $customRequest['status'] ?? '' }}"
                                        data-has-quotation="{{ !empty($customRequest['has_quotation']) ? '1' : '0' }}"
                                        data-quotation-status="{{ $customRequest['quotation_status'] ?? '' }}"
                                        data-quotation-status-raw="{{ $customRequest['quotation_status_raw'] ?? '' }}"
                                        data-quotation-amount="{{ $customRequest['quotation_amount'] ?? '' }}"
                                        data-quotation-note="{{ $customRequest['quotation_note'] ?? '' }}"
                                        data-quotation-image-url="{{ $customRequest['quotation_image_url'] ?? '' }}"
                                        data-notes="{{ $customRequest['notes'] ?? '' }}"
                                        data-search-blob="{{ $customRequest['search_blob'] ?? '' }}"
                                    >
                                        <td>{{ $customRequest['request_id'] ?? '-' }}</td>
                                        <td>{{ $customRequest['customer_name'] ?? '-' }}</td>
                                        <td>{{ $customRequest['gem_type'] ?? '-' }}</td>
                                        <td>{{ $customRequest['metal'] ?? '-' }}</td>
                                        <td>{{ $customRequest['size'] ?? '-' }}</td>
                                        <td>{{ $customRequest['engraving'] ?? 'None' }}</td>
                                        <td>{{ $customRequest['reference_count'] ?? 0 }} images</td>
                                        <td>{{ $customRequest['requested_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $customRequest['status_class'] ?? 'warn' }}">{{ $customRequest['status'] ?? 'Pending' }}</span></td>
                                        <td>
                                            @if (!empty($customRequest['has_quotation']))
                                                <span class="status {{ $customRequest['quotation_status_class'] ?? 'info' }}">{{ $customRequest['quotation_status'] ?? $customRequest['quotation_status_raw'] ?? 'Sent' }}</span>
                                            @else
                                                <span style="color:var(--muted);">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button" data-custom-action="view-details">View Details</button>
                                                @if (Str::lower((string) ($customRequest['status'] ?? '')) === 'pending')
                                                    <button class="mini-btn" type="button" data-custom-action="approve">Approve</button>
                                                    <button class="mini-btn" type="button" data-custom-action="reject">Reject</button>
                                                @endif
                                                @if (empty($customRequest['has_quotation']))
                                                    <button class="mini-btn" type="button" data-custom-action="update-status">Update Status</button>
                                                @endif
                                                @if (empty($customRequest['has_quotation']) || Str::lower((string) ($customRequest['quotation_status_raw'] ?? '')) === 'rejected')
                                                    <button class="mini-btn" type="button" data-custom-action="send-quotation">Send Quotation</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="11" style="text-align:center;color:var(--muted);padding:24px;">No custom requests found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="custom-pending-page">
                    <div class="module-head">
                        <h2>Pending Requests</h2>
                        <p>Review new custom design requests and decide whether to approve or reject them.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>New Requests</span><strong>{{ number_format((int) ($customPending->count())) }}</strong></div>
                        <div class="summary-card"><span>Gemstone Focused</span><strong>{{ number_format((int) ($customPending->filter(fn ($row) => !empty($row['gem_type']))->count())) }}</strong></div>
                        <div class="summary-card"><span>Engraving Requests</span><strong>{{ number_format((int) ($customPending->filter(fn ($row) => filled($row['engraving'] ?? null) && strtolower((string) ($row['engraving'] ?? 'none')) !== 'none')->count())) }}</strong></div>
                        <div class="summary-card"><span>Reference Uploads</span><strong>{{ number_format((int) ($customPending->sum('reference_count'))) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search pending request">
                            <input type="date" data-filter-index="7">
                        </div>
                        <table>
                            <thead><tr><th>Request ID</th><th>Customer Name</th><th>Gem Type</th><th>Metal</th><th>Size</th><th>Engraving</th><th>Reference Image</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody id="customPendingTableBody">
                                @forelse ($customPending as $customRequest)
                                    <tr
                                        data-custom-request-id="{{ $customRequest['db_id'] ?? '' }}"
                                        data-request-id="{{ $customRequest['request_id'] ?? '' }}"
                                        data-customer-name="{{ $customRequest['customer_name'] ?? '' }}"
                                        data-gem-type="{{ $customRequest['gem_type'] ?? '' }}"
                                        data-metal="{{ $customRequest['metal'] ?? '' }}"
                                        data-size="{{ $customRequest['size'] ?? '' }}"
                                        data-engraving="{{ $customRequest['engraving'] ?? '' }}"
                                        data-reference-images="{{ implode('|', $customRequest['reference_images'] ?? []) }}"
                                        data-date="{{ $customRequest['requested_date'] ?? '' }}"
                                        data-status="{{ $customRequest['status'] ?? '' }}"
                                        data-search-blob="{{ $customRequest['search_blob'] ?? '' }}"
                                    >
                                        <td>{{ $customRequest['request_id'] ?? '-' }}</td>
                                        <td>{{ $customRequest['customer_name'] ?? '-' }}</td>
                                        <td>{{ $customRequest['gem_type'] ?? '-' }}</td>
                                        <td>{{ $customRequest['metal'] ?? '-' }}</td>
                                        <td>{{ $customRequest['size'] ?? '-' }}</td>
                                        <td>{{ $customRequest['engraving'] ?? 'None' }}</td>
                                        <td>{{ $customRequest['reference_count'] ?? 0 }} images</td>
                                        <td>{{ $customRequest['requested_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $customRequest['status_class'] ?? 'warn' }}">{{ $customRequest['status'] ?? 'Pending' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button" data-custom-action="view-details">View Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="10" style="text-align:center;color:var(--muted);padding:24px;">No pending custom requests found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="custom-quotations-page">
                    <div class="module-head">
                        <h2>Quotations</h2>
                        <p>Manage price estimates, send quotations to customers, and track acceptance or rejection.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Quotations</span><strong>{{ number_format((int) ($customQuotations->count())) }}</strong></div>
                        <div class="summary-card"><span>Sent to Customer</span><strong>{{ number_format((int) ($customQuotations->where('quotation_status', 'Sent')->count())) }}</strong></div>
                        <div class="summary-card"><span>Accepted</span><strong>{{ number_format((int) ($customQuotations->where('quotation_status', 'Accepted')->count())) }}</strong></div>
                        <div class="summary-card"><span>Rejected</span><strong>{{ number_format((int) ($customQuotations->where('quotation_status', 'Rejected')->count())) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search quotation">
                            <select data-filter-index="4">
                                <option>All Decision</option>
                                @foreach ($customQuotationDecisionOptions as $decisionOption)
                                    <option>{{ $decisionOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table>
                            <thead><tr><th>Quotation ID</th><th>Request ID</th><th>Customer Name</th><th>Amount</th><th>Image</th><th>Customer Decision</th><th>Sent Date</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse ($customQuotations as $quotation)
                                    <tr
                                        data-quotation-db-id="{{ $quotation['db_id'] ?? '' }}"
                                        data-custom-request-id="{{ $quotation['db_id'] ?? '' }}"
                                        data-request-id="{{ $quotation['request_id'] ?? '' }}"
                                        data-customer-name="{{ $quotation['customer_name'] ?? '' }}"
                                        data-search-blob="{{ $quotation['search_blob'] ?? '' }}"
                                        data-quotation-amount="{{ $quotation['quotation_amount_value'] ?? 0 }}"
                                        data-quotation-note="{{ $quotation['quotation_note'] ?? '' }}"
                                        data-quotation-image="{{ $quotation['quotation_image_url'] ?? '' }}"
                                        data-quotation-status="{{ $quotation['quotation_status'] ?? '' }}"
                                        data-quotation-status-raw="{{ $quotation['quotation_status_raw'] ?? '' }}"
                                        data-has-quotation="1"
                                    >
                                        <td>{{ $quotation['quotation_number'] ?? '-' }}</td>
                                        <td>{{ $quotation['request_id'] ?? '-' }}</td>
                                        <td>{{ $quotation['customer_name'] ?? '-' }}</td>
                                        <td>{{ $quotation['quotation_amount'] ?? '-' }}</td>
                                        <td>
                                            @if (!empty($quotation['quotation_image_url']))
                                                <img src="{{ $quotation['quotation_image_url'] }}" alt="Quotation image" style="width:54px;height:54px;object-fit:cover;border-radius:14px;border:1px solid #e9dcc6;">
                                            @else
                                                <span style="color:var(--muted);">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $quotation['quotation_status'] ?? 'Sent' }}</td>
                                        <td>{{ $quotation['quotation_sent_at'] ?? '-' }}</td>
                                        <td><span class="status {{ $quotation['quotation_status_class'] ?? 'info' }}">{{ $quotation['quotation_status'] ?? 'Sent' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button" data-custom-action="view-details">View Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="9" style="text-align:center;color:var(--muted);padding:24px;">No quotations found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="custom-paid-page">
                    <div class="module-head">
                        <h2>Paid Designs</h2>
                        <p>Review paid custom jewellery requests, payment details, and catalogue readiness.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Paid Designs</span><strong>{{ number_format((int) ($customPaid->count())) }}</strong></div>
                        <div class="summary-card"><span>Ready for Order</span><strong>{{ number_format((int) ($customPaid->count())) }}</strong></div>
                        <div class="summary-card"><span>Catalogue Candidates</span><strong>{{ number_format((int) ($customPaid->where('quotation_status', 'Accepted')->count())) }}</strong></div>
                        <div class="summary-card"><span>Quotation Images</span><strong>{{ number_format((int) ($customPaid->filter(fn ($row) => !empty($row['quotation_image_url']))->count())) }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search paid design">
                            <input type="date" data-filter-index="5">
                        </div>
                        <table>
                            <thead><tr><th>Paid ID</th><th>Request ID</th><th>Customer Name</th><th>Design Name</th><th>Paid Date</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse ($customPaid as $customRequest)
                                    <tr
                                        data-custom-request-id="{{ $customRequest['db_id'] ?? '' }}"
                                        data-request-id="{{ $customRequest['request_id'] ?? '' }}"
                                        data-customer-name="{{ $customRequest['customer_name'] ?? '' }}"
                                        data-gem-type="{{ $customRequest['gem_type'] ?? '' }}"
                                        data-metal="{{ $customRequest['metal'] ?? '' }}"
                                        data-size="{{ $customRequest['size'] ?? '' }}"
                                        data-engraving="{{ $customRequest['engraving'] ?? '' }}"
                                        data-reference-images="{{ implode('|', $customRequest['reference_images'] ?? []) }}"
                                        data-date="{{ $customRequest['requested_date'] ?? '' }}"
                                        data-status="{{ $customRequest['quotation_status_raw'] ?? $customRequest['quotation_status'] ?? '' }}"
                                        data-quotation-image-url="{{ $customRequest['quotation_image_url'] ?? '' }}"
                                        data-search-blob="{{ $customRequest['search_blob'] ?? '' }}"
                                    >
                                        <td>{{ $customRequest['quotation_number'] ?? ('PD-' . str_pad((string) ($loop->index + 701), 3, '0', STR_PAD_LEFT)) }}</td>
                                        <td>{{ $customRequest['request_id'] ?? '-' }}</td>
                                        <td>{{ $customRequest['customer_name'] ?? '-' }}</td>
                                        <td>{{ $customRequest['type_display_name'] ?? 'Custom Jewellery' }}</td>
                                        <td>{{ $customRequest['requested_date'] ?? '-' }}</td>
                                        <td><span class="status {{ $customRequest['quotation_status_class'] ?? 'ok' }}">{{ $customRequest['quotation_status'] ?? 'Paid' }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button" data-custom-action="view-details">View Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" style="text-align:center;color:var(--muted);padding:24px;">No paid designs found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="consultation-requests-page">
                    <div class="module-head">
                        <h2>Consultation Requests</h2>
                        <p>Manage consultation chat requests, assign consultants, and open a live chat once approved.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Requests</span><strong>{{ $consultationMetrics['total_requests'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Pending</span><strong>{{ $consultationMetrics['pending_requests'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Approved</span><strong>{{ $consultationMetrics['approved_requests'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Completed</span><strong>{{ $consultationMetrics['completed_requests'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search consultation request">
                            <input type="date" data-filter-index="4">
                            <select data-filter-index="5">
                                <option value="">All Status</option>
                                @foreach (($consultationStatusOptions ?? []) as $consultationStatusOption)
                                    <option value="{{ $consultationStatusOption }}">{{ $consultationStatusOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table>
                            <thead><tr><th>Request ID</th><th>Customer Name</th><th>Consultation Type</th><th>Assigned Consultant</th><th>Submitted On</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($consultationRequests ?? collect()) as $consultationRequest)
                                    <tr
                                        data-consultation-id="{{ $consultationRequest->id }}"
                                        data-request-id="{{ $consultationRequest->request_number }}"
                                        data-chat-thread-id="{{ $consultationRequest->chat_thread_id }}"
                                        data-customer-name="{{ $consultationRequest->customer_name }}"
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
                                        <td>{{ $consultationRequest->consultant_name }}</td>
                                        <td>{{ $consultationRequest->created_at?->format('Y-m-d') }}</td>
                                        <td><span class="status {{ $consultationRequest->status_class }}">{{ $consultationRequest->status }}</span></td>
                                        @php
                                            $consultationStatusLower = strtolower((string) $consultationRequest->status);
                                            $consultationHasConsultant = !empty($consultationRequest->consultant_id);
                                        @endphp
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                                @if ($consultationStatusLower === 'pending')
                                                    <button class="mini-btn" type="button">Approve</button>
                                                    <button class="mini-btn" type="button">Reject</button>
                                                @elseif ($consultationStatusLower === 'approved' && ! $consultationHasConsultant)
                                                    <button class="mini-btn" type="button">Assign Consultant</button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No consultation requests yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="consultation-pending-page">
                    <div class="module-head">
                        <h2>Pending Requests</h2>
                        <p>Review new consultation chat requests, approve them, or reject them before assigning a consultant.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Pending Requests</span><strong>{{ $consultationRequests ? $consultationRequests->where('status', 'Pending')->count() : 0 }}</strong></div>
                        <div class="summary-card"><span>Need Consultant</span><strong>{{ $consultationRequests ? $consultationRequests->where('status', 'Pending')->whereNull('consultant_id')->count() : 0 }}</strong></div>
                        @forelse (($consultationPendingTypeMetrics ?? collect()) as $consultationPendingTypeMetric)
                            <div class="summary-card"><span>{{ $consultationPendingTypeMetric['label'] }}</span><strong>{{ $consultationPendingTypeMetric['count'] }}</strong></div>
                        @empty
                            <div class="summary-card"><span>Pending Types</span><strong>0</strong></div>
                        @endforelse
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search pending consultation">
                            <input type="date" data-filter-index="4">
                        </div>
                        <table>
                            <thead><tr><th>Request ID</th><th>Customer Name</th><th>Consultation Type</th><th>Assigned Consultant</th><th>Submitted On</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($consultationRequests ?? collect())->where('status', 'Pending') as $consultationRequest)
                                    <tr
                                        data-consultation-id="{{ $consultationRequest->id }}"
                                        data-request-id="{{ $consultationRequest->request_number }}"
                                        data-chat-thread-id="{{ $consultationRequest->chat_thread_id }}"
                                        data-customer-name="{{ $consultationRequest->customer_name }}"
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
                                        <td>{{ $consultationRequest->consultant_name }}</td>
                                        <td>{{ $consultationRequest->created_at?->format('Y-m-d') }}</td>
                                        <td><span class="status {{ $consultationRequest->status_class }}">{{ $consultationRequest->status }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                                <button class="mini-btn" type="button">Approve</button>
                                                <button class="mini-btn" type="button">Reject</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No pending consultation requests yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="appointments-page">
                    <div class="module-head">
                        <h2>Appointments</h2>
                        <p>Monitor customer appointments handled by consultants. Admins can review status and history, while consultants manage the workflow.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total</span><strong>{{ $appointmentMetrics['total_appointments'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Pending</span><strong>{{ $appointmentMetrics['pending_appointments'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Confirmed</span><strong>{{ $appointmentMetrics['confirmed_appointments'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Completed</span><strong>{{ $appointmentMetrics['completed_appointments'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search appointment">
                            <input type="date" data-filter-index="3">
                            <select data-filter-index="6">
                                <option value="">All Status</option>
                                @foreach (($appointmentStatusOptions ?? []) as $appointmentStatusOption)
                                    <option value="{{ $appointmentStatusOption }}">{{ $appointmentStatusOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table>
                            <thead><tr><th>Appointment ID</th><th>Customer Name</th><th>Consultant</th><th>Date</th><th>Time</th><th>Mode</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($appointmentRequests ?? collect()) as $appointmentRequest)
                                    <tr
                                        data-appointment-id="{{ $appointmentRequest->id }}"
                                        data-appointment-number="{{ $appointmentRequest->appointment_number }}"
                                        data-customer-name="{{ $appointmentRequest->customer_name }}"
                                        data-consultant-name="{{ $appointmentRequest->consultant_name }}"
                                        data-appointment-mode="{{ $appointmentRequest->appointment_mode }}"
                                        data-appointment-topic="{{ $appointmentRequest->appointment_topic }}"
                                        data-preferred-date="{{ $appointmentRequest->preferred_date?->format('Y-m-d') }}"
                                        data-preferred-time="{{ $appointmentRequest->preferred_time }}"
                                        data-contact-number="{{ $appointmentRequest->contact_number }}"
                                        data-status="{{ $appointmentRequest->status }}"
                                        data-status-class="{{ $appointmentRequest->status_class }}"
                                        data-consultant-id="{{ $appointmentRequest->consultant_id }}"
                                        data-consultant-note="{{ $appointmentRequest->consultant_note }}"
                                        data-customer-note="{{ $appointmentRequest->customer_note }}"
                                        data-approved-at="{{ $appointmentRequest->approved_at?->format('Y-m-d H:i') }}"
                                        data-completed-at="{{ $appointmentRequest->completed_at?->format('Y-m-d H:i') }}"
                                        data-cancelled-at="{{ $appointmentRequest->cancelled_at?->format('Y-m-d H:i') }}"
                                    >
                                        <td>{{ $appointmentRequest->appointment_number }}</td>
                                        <td>{{ $appointmentRequest->customer_name }}</td>
                                        <td>{{ $appointmentRequest->consultant_name ?: 'Unassigned' }}</td>
                                        <td>{{ $appointmentRequest->preferred_date?->format('Y-m-d') }}</td>
                                        <td>{{ $appointmentRequest->preferred_time }}</td>
                                        <td>{{ $appointmentRequest->appointment_mode }}</td>
                                        <td><span class="status {{ $appointmentRequest->status_class }}">{{ $appointmentRequest->status }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8">No appointments yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                @php
                    $consultationChatRequests = ($consultationRequests ?? collect())->filter(function ($consultationRequest) {
                        return $consultationRequest->consultant_id
                            && in_array($consultationRequest->status, ['Approved', 'Completed'], true);
                    })->values();

                    $consultationHistoryRequests = ($consultationRequests ?? collect())->filter(function ($consultationRequest) {
                        return in_array($consultationRequest->status, ['Completed', 'Rejected', 'Cancelled'], true)
                            || $consultationRequest->messages->isNotEmpty();
                    })->values();
                @endphp

                <section class="module-page" id="consultation-chat-page">
                    <div class="module-head">
                        <h2>Chat / Messages</h2>
                        <p>Track the live consultation conversations between customers and assigned consultants.</p>
                    </div>
                    <div class="summary-grid">
                            <div class="summary-card"><span>Open Threads</span><strong>{{ $consultationChatRequests->count() }}</strong></div>
                            <div class="summary-card"><span>Assigned Threads</span><strong>{{ $consultationChatRequests->whereNotNull('consultant_id')->count() }}</strong></div>
                            <div class="summary-card"><span>Customer Messages</span><strong>{{ $consultationChatRequests->sum(fn ($consultationRequest) => $consultationRequest->messages->where('sender_role', 'customer')->count()) }}</strong></div>
                        <div class="summary-card"><span>Consultant Replies</span><strong>{{ $consultationChatRequests->sum(fn ($consultationRequest) => $consultationRequest->messages->where('sender_role', 'consultant')->count()) }}</strong></div>
                        </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search chat thread">
                        </div>
                        <table>
                            <thead><tr><th>Thread ID</th><th>Customer Name</th><th>Consultation Type</th><th>Assigned Consultant</th><th>Last Message</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse ($consultationChatRequests as $consultationRequest)
                                    @php
                                        $lastChatMessage = $consultationRequest->messages->filter(fn ($message) => in_array((string) $message->sender_role, ['customer', 'consultant'], true))->last();
                                        $lastChatSnippet = $lastChatMessage ? trim((string) $lastChatMessage->message) : '';
                                        $lastChatSummary = $lastChatSnippet !== '' ? \Illuminate\Support\Str::limit($lastChatSnippet, 80) : 'No messages yet';
                                        $lastChatTime = $lastChatMessage?->created_at?->format('Y-m-d h:i A') ?? '';
                                    @endphp
                                    <tr
                                        data-consultation-id="{{ $consultationRequest->id }}"
                                        data-request-id="{{ $consultationRequest->request_number }}"
                                        data-chat-thread-id="{{ $consultationRequest->chat_thread_id }}"
                                        data-customer-name="{{ $consultationRequest->customer_name }}"
                                        data-request-type="{{ $consultationRequest->request_type }}"
                                        data-submitted-on="{{ $consultationRequest->created_at?->format('Y-m-d') }}"
                                        data-status="{{ $consultationRequest->status }}"
                                        data-consultant-id="{{ $consultationRequest->consultant_id }}"
                                        data-assigned-consultant="{{ $consultationRequest->consultant_name }}"
                                        data-consultant-note="{{ $consultationRequest->consultant_note }}"
                                        data-customer-note="{{ $consultationRequest->customer_note }}"
                                        data-last-message="{{ $lastChatSummary }}"
                                        data-last-message-time="{{ $lastChatTime }}"
                                    >
                                        <td>{{ $consultationRequest->request_number }}</td>
                                        <td>{{ $consultationRequest->customer_name }}</td>
                                        <td>{{ $consultationRequest->display_request_type }}</td>
                                        <td>{{ $consultationRequest->consultant_name }}</td>
                                        <td>{{ $lastChatSummary }}</td>
                                        <td><span class="status {{ $consultationRequest->status_class }}">{{ $consultationRequest->status }}</span></td>
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No consultation chats yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="consultation-history-page">
                    <div class="module-head">
                        <h2>Consultation History</h2>
                        <p>Review completed, rejected, and closed consultation records together with their message history.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Records</span><strong>{{ $consultationHistoryRequests->count() }}</strong></div>
                        <div class="summary-card"><span>Completed</span><strong>{{ $consultationHistoryRequests->where('status', 'Completed')->count() }}</strong></div>
                        <div class="summary-card"><span>Rejected</span><strong>{{ $consultationHistoryRequests->where('status', 'Rejected')->count() }}</strong></div>
                        <div class="summary-card"><span>Threads With Messages</span><strong>{{ $consultationHistoryRequests->filter(fn ($consultationRequest) => $consultationRequest->messages->isNotEmpty())->count() }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search consultation history">
                            <input type="date" data-filter-index="4">
                            <select data-filter-index="5">
                                <option value="">All Status</option>
                                @foreach (($consultationStatusOptions ?? []) as $consultationStatusOption)
                                    <option value="{{ $consultationStatusOption }}">{{ $consultationStatusOption }}</option>
                                @endforeach
                            </select>
                        </div>
                        <table>
                            <thead><tr><th>Request ID</th><th>Customer Name</th><th>Consultation Type</th><th>Assigned Consultant</th><th>Date & Time</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse ($consultationHistoryRequests as $consultationRequest)
                                    <tr
                                        data-consultation-id="{{ $consultationRequest->id }}"
                                        data-request-id="{{ $consultationRequest->request_number }}"
                                        data-chat-thread-id="{{ $consultationRequest->chat_thread_id }}"
                                        data-customer-name="{{ $consultationRequest->customer_name }}"
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
                                        <td>{{ $consultationRequest->consultant_name }}</td>
                                        <td>{{ $consultationRequest->date_time_label }}</td>
                                        <td><span class="status {{ $consultationRequest->status_class }}">{{ $consultationRequest->status }}</span></td>
                                        @php $consultationHasConsultant = !empty($consultationRequest->consultant_id); @endphp
                                        <td>
                                            <div class="actions-inline">
                                                <button class="mini-btn" type="button">View Details</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No consultation history yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="users-customers-page">
                    <div class="module-head">
                        <h2>Customers Management</h2>
                        <p>Manage all registered customers, their accounts, order history, and account status.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Customers</span><strong>{{ $userMetrics['customers_total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Active Customers</span><strong>{{ $userMetrics['customers_active'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Blocked Customers</span><strong>{{ $userMetrics['customers_blocked'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>New This Month</span><strong>{{ $userMetrics['customers_new_this_month'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search customers" value="{{ request('customer_search', '') }}" data-user-filter-key="customer_search">
                            <select data-user-filter-key="customer_status">
                                <option {{ !request('customer_status') || request('customer_status') === 'All Status' ? 'selected' : '' }}>All Status</option>
                                <option @selected(request('customer_status') === 'Active')>Active</option>
                                <option @selected(request('customer_status') === 'Inactive')>Inactive</option>
                                <option @selected(request('customer_status') === 'Blocked')>Blocked</option>
                            </select>
                            <button class="btn primary" type="button" data-dashboard-action="add-customer">Add Customer</button>
                            <button class="btn" type="button" data-user-export="customers">Export</button>
                            <button class="btn" type="button" data-user-filter-clear="customers">Clear</button>
                        </div>
                        <table>
                            <thead><tr><th>Customer ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Joined On</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse(($customerUsers ?? collect()) as $customer)
                                    <tr data-user-db-id="{{ $customer['db_id'] }}" data-user-id="{{ $customer['user_id'] }}" data-first-name="{{ $customer['first_name'] ?? '' }}" data-last-name="{{ $customer['last_name'] ?? '' }}" data-email="{{ $customer['email'] }}" data-phone="{{ $customer['phone'] }}" data-birth-date="{{ $customer['birth_date'] ?? '' }}" data-registration-date="{{ $customer['registration_date'] }}" data-status="{{ $customer['status'] }}" data-initials="{{ $customer['initials'] }}">
                                        <td>{{ $customer['user_id'] }}</td>
                                        <td>{{ $customer['name'] }}</td>
                                        <td>{{ $customer['email'] }}</td>
                                        <td>{{ $customer['phone'] }}</td>
                                        <td>{{ $customer['registration_date'] }}</td>
                                        <td><span class="status {{ $customer['status'] === 'Active' ? 'ok' : 'warn' }}">{{ $customer['status'] }}</span></td>
                                        <td><div class="actions-inline"><button class="mini-btn" type="button" data-user-action="view">View</button><button class="mini-btn" type="button" data-user-action="edit">Edit</button><button class="mini-btn" type="button" data-user-action="{{ $customer['status'] === 'Active' ? 'block' : 'unblock' }}">{{ $customer['status'] === 'Active' ? 'Block' : 'Unblock' }}</button><button class="mini-btn" type="button" data-user-action="delete">Delete</button></div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No customers found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="users-consultants-page">
                    <div class="module-head">
                        <h2>Consultants Management</h2>
                        <p>Manage consultant profiles, appointments, status, and assigned customer interactions.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Consultants</span><strong>{{ $userMetrics['consultants_total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Active Consultants</span><strong>{{ $userMetrics['consultants_active'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Blocked Consultants</span><strong>{{ $userMetrics['consultants_blocked'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Pending Consultations</span><strong>{{ $consultationMetrics['pending_requests'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search consultant" value="{{ request('consultant_search', '') }}" data-user-filter-key="consultant_search">
                            <select data-user-filter-key="consultant_status">
                                <option {{ !request('consultant_status') || request('consultant_status') === 'All Status' ? 'selected' : '' }}>All Status</option>
                                <option @selected(request('consultant_status') === 'Active')>Active</option>
                                <option @selected(request('consultant_status') === 'Inactive')>Inactive</option>
                                <option @selected(request('consultant_status') === 'Blocked')>Blocked</option>
                            </select>
                            <button class="btn primary" type="button">Add Consultant</button>
                            <button class="btn" type="button" data-user-export="consultants">Export</button>
                            <button class="btn" type="button" data-user-filter-clear="consultants">Clear</button>
                        </div>
                        <table>
                            <thead><tr><th>Consultant ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Consultations</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse(($consultantUsers ?? collect()) as $consultant)
                                    <tr data-user-db-id="{{ $consultant['db_id'] }}" data-consultant-id="{{ $consultant['consultant_id'] }}" data-first-name="{{ $consultant['first_name'] ?? '' }}" data-last-name="{{ $consultant['last_name'] ?? '' }}" data-email="{{ $consultant['email'] }}" data-phone="{{ $consultant['phone'] }}" data-birth-date="{{ $consultant['birth_date'] ?? '' }}" data-assigned-customers="{{ $consultant['assigned_customers'] }}" data-status="{{ $consultant['status'] }}" data-initials="{{ $consultant['initials'] }}">
                                        <td>{{ $consultant['consultant_id'] }}</td>
                                        <td>{{ $consultant['name'] }}</td>
                                        <td>{{ $consultant['email'] }}</td>
                                        <td>{{ $consultant['phone'] }}</td>
                                        <td>{{ $consultant['assigned_customers'] }}</td>
                                        <td><span class="status {{ $consultant['status'] === 'Active' ? 'ok' : ($consultant['status'] === 'Blocked' ? 'bad' : 'warn') }}">{{ $consultant['status'] }}</span></td>
                                        <td><div class="actions-inline"><button class="mini-btn" type="button" data-user-action="view">View</button><button class="mini-btn" type="button" data-user-action="edit">Edit</button><button class="mini-btn" type="button" data-user-action="{{ $consultant['status'] === 'Blocked' ? 'unblock' : 'block' }}">{{ $consultant['status'] === 'Blocked' ? 'Unblock' : 'Block' }}</button><button class="mini-btn" type="button" data-user-action="delete">Delete</button></div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7">No consultants found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="users-admins-page">
                    <div class="module-head">
                        <h2>Admin Users Management</h2>
                        <p>Manage admin accounts, responsibilities, and system-level access.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Admin Users</span><strong>{{ $userMetrics['admins_total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Lower Admins</span><strong>{{ ($adminUsers ?? collect())->where('role_key', 'lower_admin')->count() }}</strong></div>
                        <div class="summary-card"><span>Content Managers</span><strong>{{ ($adminUsers ?? collect())->where('role_key', 'content_manager')->count() }}</strong></div>
                        <div class="summary-card"><span>Active Permissions</span><strong>{{ $userMetrics['permissions_total'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search admin" value="{{ request('admin_search', '') }}" data-user-filter-key="admin_search">
                            <select data-user-filter-key="admin_role">
                                <option {{ !request('admin_role') || request('admin_role') === 'All Roles' ? 'selected' : '' }}>All Roles</option>
                                <option @selected(request('admin_role') === 'Admin')>Admin</option>
                                <option @selected(request('admin_role') === 'Lower Admin')>Lower Admin</option>
                                <option @selected(request('admin_role') === 'Content Manager')>Content Manager</option>
                            </select>
                            <button class="btn primary" type="button">Add Admin</button>
                  
                            <button class="btn" type="button" data-user-filter-clear="admins">Clear</button>
                        </div>
                        <table>
                            <thead><tr><th>Admin ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Role</th><th>Updated On</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse(($adminUsers ?? collect()) as $admin)
                                    <tr data-user-db-id="{{ $admin['db_id'] }}" data-admin-id="{{ $admin['admin_id'] }}" data-first-name="{{ $admin['first_name'] ?? '' }}" data-last-name="{{ $admin['last_name'] ?? '' }}" data-email="{{ $admin['email'] }}" data-phone="{{ $admin['phone'] ?? '-' }}" data-birth-date="{{ $admin['birth_date'] ?? '' }}" data-role="{{ $admin['role_label'] }}" data-role-key="{{ $admin['role_key'] }}" data-permissions="{{ implode(',', $admin['permissions_list']) }}" data-updated-on="{{ $admin['updated_on'] }}" data-status="{{ $admin['status'] }}" data-initials="{{ $admin['initials'] }}">
                                        <td>{{ $admin['admin_id'] }}</td>
                                        <td>{{ $admin['name'] }}</td>
                                        <td>{{ $admin['email'] }}</td>
                                        <td>{{ $admin['phone'] ?? '-' }}</td>
                                        <td>{{ $admin['role_label'] }}</td>
                                        <td>{{ $admin['updated_on'] }}</td>
                                        <td><span class="status {{ $admin['status'] === 'Active' ? 'ok' : 'warn' }}">{{ $admin['status'] }}</span></td>
                                        <td><div class="actions-inline"><button class="mini-btn" type="button" data-user-action="view">View</button><button class="mini-btn" type="button" data-user-action="edit">Edit</button><button class="mini-btn" type="button" data-user-action="{{ $admin['status'] === 'Blocked' ? 'unblock' : 'block' }}">{{ $admin['status'] === 'Blocked' ? 'Unblock' : 'Block' }}</button><button class="mini-btn" type="button" data-user-action="delete">Delete</button></div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8">No admin users found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="users-roles-page">
                    <div class="module-head">
                        <h2>Roles & Permissions</h2>
                        <p>Create roles and assign system permissions and access restrictions.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Roles</span><strong>{{ $userMetrics['admin_roles_total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Active Permissions</span><strong>{{ $userMetrics['permissions_total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Restricted Roles</span><strong>{{ $userMetrics['restricted_roles_total'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Role Types</span><strong>{{ $roleRows->count() ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search role" value="{{ request('role_search', '') }}" data-user-filter-key="role_search">
                            
                           
                        </div>
                        <table>
                            <thead><tr><th>Role</th><th>Description</th><th>Permission Matrix</th><th>Users</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse(($roleRows ?? collect()) as $roleRow)
                                    <tr data-role="{{ $roleRow['role'] }}" data-permissions="{{ implode(',', $roleRow['permissions']) }}" data-user-count="{{ $roleRow['user_count'] }}">
                                        <td>{{ Str::title(str_replace('_', ' ', $roleRow['role'])) }}</td>
                                        <td>{{ $roleRow['description'] }}</td>
                                        <td><div class="perm-cell"><span class="perm-summary">{{ $roleRow['permissions'][0] === 'All permissions' ? 'All enabled' : count($roleRow['permissions']) . ' enabled' }}</span></div></td>
                                        <td>{{ $roleRow['user_count'] }}</td>
                                        <td><div class="actions-inline"><button class="mini-btn" type="button" data-role-permissions-btn="1">Update Permissions</button></div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5">No roles configured.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="users-logs-page">
                    <div class="module-head">
                        <h2>Activity Logs</h2>
                        <p>Track user management updates, permission changes, deletions, and other admin activities.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total Activities</span><strong>{{ $activityLogMetrics['total_activities'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Created Today</span><strong>{{ $activityLogMetrics['created_today'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Changes Today</span><strong>{{ $activityLogMetrics['changes_today'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Deleted Today</span><strong>{{ $activityLogMetrics['deleted_today'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search by user name" value="{{ request('log_search', '') }}" data-user-filter-key="log_search">
                            <input type="date" value="{{ request('log_date', '') }}" data-user-filter-key="log_date">
                            <select data-user-filter-key="log_action">
                                <option {{ !request('log_action') || request('log_action') === 'All Actions' ? 'selected' : '' }}>All Actions</option>
                                <option @selected(request('log_action') === 'Created')>Created</option>
                                <option @selected(request('log_action') === 'Updated')>Updated</option>
                                <option @selected(request('log_action') === 'Deleted')>Deleted</option>
                                <option @selected(request('log_action') === 'Role Updated')>Role Updated</option>
                                <option @selected(request('log_action') === 'Permissions Updated')>Permissions Updated</option>
                            </select>
                            <button class="btn" type="button" data-user-export="logs">Export Logs</button>
                            <button class="btn" type="button" data-user-filter-clear="logs">Clear</button>
                        </div>
                        <table>
                            <thead><tr><th>Log ID</th><th>User Name</th><th>Role</th><th>Action</th><th>Module</th><th>Date & Time</th><th>IP / Device</th><th>Status</th></tr></thead>
                            <tbody>
                                @forelse(($adminActivityLogs ?? collect()) as $log)
                                    <tr data-log-id="{{ $log['log_id'] }}" data-user-name="{{ $log['user_name'] }}" data-role="{{ $log['role'] }}" data-action="{{ $log['action'] }}" data-module="{{ $log['module'] }}" data-date-time="{{ $log['date_time'] }}" data-status-class="{{ $log['status_class'] }}" data-status-label="{{ $log['status_label'] }}">
                                        <td>{{ $log['log_id'] }}</td>
                                        <td>{{ $log['user_name'] }}</td>
                                        <td>{{ $log['role'] }}</td>
                                        <td>{{ $log['action'] }}</td>
                                        <td>{{ $log['module'] }}</td>
                                        <td>{{ $log['date_time'] }}</td>
                                        <td>{{ $log['ip_device'] }}</td>
                                        <td><span class="status {{ $log['status_class'] }}">{{ $log['status_label'] }}</span></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8">No activity logs yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="inventory-stock-management-page">
                    <div class="module-head">
                        <h2>Stock Management</h2>
                        <p>Monitor gem stock, jewellery stock, high-value items, and reserved pickup stock.</p>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>Total SKUs</span><strong>{{ $inventoryMetrics['total_skus'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Healthy</span><strong>{{ $inventoryMetrics['healthy'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Low</span><strong>{{ $inventoryMetrics['low'] ?? 0 }}</strong></div>
                        <div class="summary-card"><span>Critical</span><strong>{{ $inventoryMetrics['critical'] ?? 0 }}</strong></div>
                    </div>
                    <div class="table-panel" style="margin-bottom:18px;">
                        <div class="filter-row">
                            <select data-stock-product-select>
                                <option value="">Select Product</option>
                                @foreach(($stockProductOptions ?? collect()) as $stockProductOption)
                                    <option value="{{ $stockProductOption['db_id'] }}" data-current-stock="{{ $stockProductOption['stock'] }}">{{ $stockProductOption['name'] }} ({{ $stockProductOption['stock'] }})</option>
                                @endforeach
                            </select>
                            <input type="number" placeholder="Quantity to add" min="1">
                            <select data-stock-status-filter>
                                <option value="">All Stock Status</option>
                                <option value="Healthy">Healthy</option>
                                <option value="Low">Low</option>
                                <option value="Critical">Critical</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                            <button class="btn primary" type="button">Add Stock Entry</button>
                            <button class="btn" type="button" data-stock-export="stock">Export</button>
                        </div>
                    </div>
                    <div class="table-panel">
                        <table>
                            <thead><tr><th>Item ID</th><th>Product</th><th>Category</th><th>Current Qty</th><th>Status</th><th>Action</th></tr></thead>
                            <tbody>
                                @forelse(($inventoryRows ?? collect()) as $stockRow)
                                    <tr
                                        data-stock-db-id="{{ $stockRow['db_id'] }}"
                                        data-stock-item-id="{{ $stockRow['item_id'] }}"
                                        data-stock-product-name="{{ $stockRow['name'] }}"
                                        data-stock-category="{{ $stockRow['category'] }}"
                                        data-stock-current="{{ $stockRow['stock'] }}"
                                    >
                                        <td>{{ $stockRow['item_id'] }}</td>
                                        <td>{{ $stockRow['name'] }}</td>
                                        <td>{{ $stockRow['category'] }}</td>
                                        <td>{{ $stockRow['stock'] }}</td>
                                        <td><span class="status {{ $stockRow['status_class'] }}">{{ $stockRow['status'] }}</span></td>
                                        <td><button class="mini-btn" type="button">Edit Stock</button></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;">No stock data found in the database yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="inventory-low-stock-page">
                    <div class="module-head">
                        <h2>Low Stock Alerts</h2>
                        <p>Track low stock items and trigger restock alerts quickly.</p>
                    </div>
                    <div class="table-panel">
                        <table>
                            <thead><tr><th>Item ID</th><th>Product</th><th>Category</th><th>Qty Left</th><th>Alert Level</th><th>Action</th></tr></thead>
                            <tbody>
                                @forelse(($lowStockRows ?? collect()) as $lowStockRow)
                                    <tr data-stock-db-id="{{ $lowStockRow['db_id'] }}" data-stock-product-name="{{ $lowStockRow['name'] }}" data-stock-category="{{ $lowStockRow['category'] }}" data-stock-current="{{ $lowStockRow['stock'] }}">
                                        <td>{{ $lowStockRow['item_id'] }}</td>
                                        <td>{{ $lowStockRow['name'] }}</td>
                                        <td>{{ $lowStockRow['category'] }}</td>
                                        <td>{{ $lowStockRow['stock'] }}</td>
                                        <td><span class="status {{ $lowStockRow['status_class'] }}">{{ $lowStockRow['status'] }}</span></td>
                                        <td><button class="mini-btn" type="button">Create Restock</button></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;">No low stock items found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="inventory-out-of-stock-page">
                    <div class="module-head">
                        <h2>Out of Stock Items</h2>
                        <p>View zero-stock products and prioritize restocking.</p>
                    </div>
                    <div class="table-panel">
                        <table>
                            <thead><tr><th>Item ID</th><th>Product</th><th>Category</th><th>Stock</th><th>Action</th></tr></thead>
                            <tbody>
                                @forelse(($outOfStockRows ?? collect()) as $outOfStockRow)
                                    <tr data-stock-db-id="{{ $outOfStockRow['db_id'] }}" data-stock-product-name="{{ $outOfStockRow['name'] }}" data-stock-category="{{ $outOfStockRow['category'] }}" data-stock-current="{{ $outOfStockRow['stock'] }}">
                                        <td>{{ $outOfStockRow['item_id'] }}</td>
                                        <td>{{ $outOfStockRow['name'] }}</td>
                                        <td>{{ $outOfStockRow['category'] }}</td>
                                        <td>{{ $outOfStockRow['stock'] }}</td>
                                        <td><button class="mini-btn" type="button">Restock</button></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" style="text-align:center;">No out of stock items found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="inventory-history-page">
                    <div class="module-head">
                        <h2>Inventory History</h2>
                        <p>Audit stock logs with user, action, date, and quantity changes.</p>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <button class="btn" type="button">Export CSV</button>
                        </div>
                        <table>
                            <thead><tr><th>Log ID</th><th>User</th><th>Action</th><th>Item</th><th>Qty Change</th><th>Date & Time</th></tr></thead>
                            <tbody>
                                @forelse(($inventoryHistoryRows ?? collect()) as $historyRow)
                                    <tr>
                                        <td>{{ $historyRow['log_id'] }}</td>
                                        <td>{{ $historyRow['user'] }}</td>
                                        <td>{{ $historyRow['action'] }}</td>
                                        <td>{{ $historyRow['item'] }}</td>
                                        <td>{{ $historyRow['qty_change'] }}</td>
                                        <td>{{ $historyRow['date_time'] }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" style="text-align:center;">No inventory history yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="products-all-page">
                    <div class="module-head">
                        <h2>All Products</h2>
                        <p>View all jewellery and gem products, then search, filter, edit, or delete records.</p>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search products" data-product-filter-key="product_search" value="{{ request('product_search', '') }}">
                            <select data-product-filter-key="product_category">
                                <option value="">All Categories</option>
                                @foreach(($productCategoryOptions ?? collect()) as $productCategoryOption)
                                    <option value="{{ $productCategoryOption }}" @selected(request('product_category', '') === $productCategoryOption)>{{ $productCategoryOption }}</option>
                                @endforeach
                            </select>
                            <input type="number" placeholder="Min Price" id="productsMinPrice" data-product-filter-key="product_min_price" value="{{ request('product_min_price', '') }}">
                            <input type="number" placeholder="Max Price" id="productsMaxPrice" data-product-filter-key="product_max_price" value="{{ request('product_max_price', '') }}">
                            <select id="productsStockFilter" data-product-filter-key="product_stock">
                                <option value="">All Stock</option>
                                <option value="in" @selected(request('product_stock', '') === 'in')>In Stock</option>
                                <option value="low" @selected(request('product_stock', '') === 'low')>Low Stock (5-15)</option>
                                <option value="critical" @selected(request('product_stock', '') === 'critical')>Critical Stock (1-4)</option>
                                <option value="out" @selected(request('product_stock', '') === 'out')>Out of Stock</option>
                            </select>
                            <button class="btn" type="button" data-product-filter-submit="all">Apply</button>
                            <button class="btn" type="button" data-product-filter-clear="all">Clear</button>
                            <button class="btn" type="button" data-product-export="all">Export CSV</button>
                        </div>
                        <table>
                            <thead><tr><th>Product ID</th><th>Name</th><th>Category</th><th>Price (LKR)</th><th>Pricing Mode</th><th>Stock</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse(($productRows ?? collect()) as $product)
                                    <tr
                                        data-product-db-id="{{ $product['db_id'] }}"
                                        data-status="{{ $product['status'] }}"
                                        data-gem-type="{{ $product['gem_type'] ?? '' }}"
                                        data-jewellery-type="{{ $product['jewellery_type'] ?? '' }}"
                                        data-color="{{ $product['color'] ?? '' }}"
                                        data-shape="{{ $product['shape'] ?? '' }}"
                                        data-carat-weight="{{ $product['carat_weight'] ?? '' }}"
                                        data-metal="{{ $product['metal'] ?? '' }}"
                                        data-metal-purity="{{ $product['metal_purity'] ?? '' }}"
                                        data-occasion="{{ $product['occasion'] ?? '' }}"
                                        data-gender="{{ $product['gender'] ?? '' }}"
                                        data-gemstone="{{ $product['gemstone'] ?? '' }}"
                                        data-metal-weight="{{ $product['metal_weight'] ?? '' }}"
                                        data-making-charge="{{ $product['making_charge'] ?? '' }}"
                                        data-wastage="{{ $product['wastage'] ?? '' }}"
                                        data-market-factor="{{ $product['market_factor'] ?? '' }}"
                                        data-pricing-mode="{{ $product['pricing_mode'] ?? '' }}"
                                        data-size-label="{{ $product['size_label'] ?? '' }}"
                                        data-size-options="{{ $product['size_options'] ?? '' }}"
                                        data-price-value="{{ $product['price_value'] ?? '' }}"
                                        data-fallback-price="{{ $product['fallback_price'] ?? '' }}"
                                        data-stock-value="{{ $product['stock'] ?? '' }}"
                                        data-search-blob="{{ $product['search_blob'] ?? '' }}"
                                        data-discount="{{ $product['discount'] ?? '' }}"
                                        data-description="{{ $product['description'] ?? '' }}"
                                        data-main-image="{{ $product['main_image'] ?? '' }}"
                                        data-high-value="{{ $product['high_value'] ?? '' }}"
                                        data-featured="{{ $product['featured'] ?? '' }}"
                                        data-discounted="{{ $product['discounted'] ?? '' }}"
                                        data-new-arrival="{{ $product['new_arrival'] ?? '' }}"
                                    >
                                        <td>{{ $product['product_id'] }}</td>
                                        <td>{{ $product['name'] }}</td>
                                        <td>{{ $product['category'] }}</td>
                                        <td>{{ $product['price'] }}</td>
                                        <td>{{ $product['pricing_mode'] ?? '-' }}</td>
                                        <td>{{ $product['stock'] }}</td>
                                        <td><span class="status {{ $product['status_class'] ?? 'info' }}">{{ $product['status'] }}</span></td>
                                        <td><div class="actions-inline"><button class="mini-btn" type="button" data-product-action="product-view">View</button><button class="mini-btn" type="button" data-product-action="product-edit">Edit</button><button class="mini-btn" type="button" data-product-action="product-delete">Delete</button></div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" style="text-align:center;">No products found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="products-add-page">
                    <div class="module-head">
                        <h2>Add Product</h2>
                        <p>Create a new product with full details, pricing, stock, and image references.</p>
                    </div>
                    <div class="table-panel">
                        <form id="addProductForm" class="add-form-grid">
                            @csrf
                            <div class="field"><label>Product Name</label><input id="apName" required type="text" placeholder="Luxury Emerald Necklace"></div>
                            <div class="field">
                                <label>Product Category</label>
                                <small style="display:block;margin-top:4px;color:var(--muted);">Choose <strong>Gems</strong>, <strong>Jewellery</strong>, or <strong>Collections</strong> from the product types below.</small>
                                @php
                                    $productTypeOptions = collect(['Gems', 'Jewellery', 'Collections']);
                                @endphp
                                <select id="apCategory" required>
                                    <option value="" disabled selected hidden>Select Product Type</option>
                                    @forelse($productTypeOptions as $productCategoryOption)
                                        <option value="{{ $productCategoryOption }}">{{ $productCategoryOption }}</option>
                                    @empty
                                        <option>Gems</option><option>Jewellery</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="field full" id="apSpecificFields"></div>
                            <div class="field"><label>Fallback Price (LKR)</label><input id="apPrice" required type="number" min="0" step="0.01" placeholder="2200"></div>
                            <div class="field"><label>Stock</label><input id="apStock" required type="number" min="0" step="1" placeholder="12"></div>
                            <div class="field full"><label>Description</label><textarea id="apDescription" placeholder="Product description..."></textarea></div>

                            <div class="field full form-block">
                                <label>Main Image Upload</label>
                                <input id="apMainImageFile" type="file" accept="image/*">
                            </div>

                            <div class="field full" style="display:flex;gap:10px;justify-content:flex-end;">
                                <button class="btn" type="reset">Clear</button>
                                <button class="btn primary" type="submit">Add Product</button>
                            </div>
                        </form>
                    </div>
                </section>

                <section class="module-page" id="products-categories-page">
                    <div class="module-head">
                        <h2>Jewellery Types</h2>
                        <p>Manage jewellery types such as rings, necklaces, bracelets, and pendants.</p>
                    </div>
                    <div class="table-panel">
                        <div class="filter-row">
                            <input type="text" placeholder="Search jewellery type" data-category-search-input>
                            <button class="btn primary" type="button" data-category-add>Add Jewellery Type</button>
                        </div>
                        <table>
                            <thead><tr><th>Jewellery Type</th><th>Items</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse(($jewelleryTypeRows ?? ($categoryRows ?? collect())) as $categoryRow)
                                    <tr data-type-id="{{ $categoryRow['db_id'] }}" data-type-name="{{ $categoryRow['name'] }}">
                                        <td>{{ $categoryRow['name'] }}</td>
                                        <td>{{ $categoryRow['product_count'] }}</td>
                                        <td><div class="actions-inline"><button class="mini-btn" type="button">Edit</button><button class="mini-btn" type="button">Delete</button></div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" style="text-align:center;">No jewellery types found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="products-reviews-page">
                    <div class="module-head">
                        <h2>Product Reviews</h2>
                        <p>View customer reviews and moderate them with approve, reject, or delete actions.</p>
                    </div>
                    <div class="table-panel">
                        <table>
                            <thead><tr><th>Review ID</th><th>Customer</th><th>Product</th><th>Rating</th><th>Status</th><th>Comment</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse(($reviewRows ?? collect()) as $review)
                                    <tr
                                        data-review-id="{{ $review['db_id'] }}"
                                        data-review-status="{{ $review['status'] }}"
                                        data-review-product="{{ $review['product'] }}"
                                        data-review-customer="{{ $review['customer'] }}"
                                        data-review-comment="{{ $review['comment'] }}"
                                        data-review-rating="{{ $review['rating'] }}"
                                        data-review-date="{{ $review['date'] }}"
                                    >
                                        <td>{{ $review['review_id'] }}</td>
                                        <td>{{ $review['customer'] }}</td>
                                        <td>{{ $review['product'] }}</td>
                                        <td>{{ $review['rating'] }}/5</td>
                                        <td><span class="status {{ $review['status_class'] }}">{{ $review['status'] }}</span></td>
                                        <td>{{ \Illuminate\Support\Str::limit($review['comment'], 90) }}</td>
                                        <td><div class="actions-inline"><button class="mini-btn" type="button" data-review-action="delete">Delete</button></div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="7" style="text-align:center;">No product reviews found in the database yet.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="module-page" id="profile-page">
                    <div class="module-head">
                        <h2>Profile</h2>
                        <p>Manage personal account details.</p>
                    </div>
                    <div class="table-panel">
                        <form id="profilePageForm" action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="redirect_to" value="{{ route('admin.dashboard') }}#profile-page">
                            <div class="dashboard-profile-layout">
                                <div class="dashboard-profile-card">
                                    <div class="dashboard-profile-preview">
                                        <div class="dashboard-profile-avatar profile-pic" id="profilePreviewBox" style="width:94px;height:94px;border-radius:28px;">
                                            @if (auth()->user()->profileImageUrl())
                                                <img id="profilePreviewImage" src="{{ auth()->user()->profileImageUrl() }}" alt="Profile preview">
                                            @else
                                                <span id="profilePreviewInitial">{{ auth()->user()->profileInitial() }}</span>
                                                <img id="profilePreviewImage" alt="Profile preview" style="display:none;">
                                            @endif
                                        </div>
                                        <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                                        <span style="color:#7a6550;">Administrator Account</span>
                                        @if (session('profile_image_success'))
                                            <div class="dashboard-profile-feedback success show">{{ session('profile_image_success') }}</div>
                                        @endif
                                        @error('profile_image')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                        <input id="profileImage" name="profile_image" form="adminProfileImageForm" class="dashboard-profile-input" type="file" accept="image/*">
                                        <label class="dashboard-upload-btn" for="profileImage"><i class="fas fa-image"></i> Profile Image</label>
                                    </div>
                                </div>
                                <div class="dashboard-profile-content">
                                    <div class="dashboard-profile-feedback success {{ session('profile_success') ? 'show' : '' }}" id="adminProfileSuccessMessage">{{ session('profile_success', 'Profile details updated successfully.') }}</div>
                                    <div class="dashboard-profile-grid">
                                        <div class="field"><label>Full Name</label><input id="profileFullName" name="full_name" type="text" value="{{ old('full_name', trim((auth()->user()->first_name ?? '').' '.(auth()->user()->last_name ?? ''))) }}" required></div>
                                        <div class="field"><label>Email Address</label><input id="profileEmail" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required></div>
                                        <div class="field"><label>Phone Number</label><input id="profilePhone" name="phone_number" type="text" value="{{ old('phone_number', auth()->user()->phone_number ?? '') }}" required></div>
                                        <div class="field"><label>Role</label><input id="profileRole" class="locked-role" type="text" value="{{ Str::title(str_replace('_', ' ', auth()->user()->role ?? 'admin')) }}" disabled aria-disabled="true" tabindex="-1"></div>
                                        <div class="field"><label>Birth Date</label><input name="birth_date" type="date" value="{{ old('birth_date', formatDateInputValue(auth()->user()->birth_date ?? null)) }}"></div>
                                        <div class="field"><label>Zodiac Sign</label><input type="text" value="{{ auth()->user()->zodiacSign?->sign_name ?? 'Auto-calculated from birth date' }}" readonly></div>
                                        <div class="field full"><label>Address</label><textarea name="address">{{ old('address', auth()->user()->address ?? '') }}</textarea></div>
                                    </div>
                                    <div class="dashboard-profile-actions">
                                        <button class="btn theme" type="submit">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form id="adminProfileImageForm" action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="redirect_to" value="{{ route('admin.dashboard') }}#profile-page">
                        </form>
                    </div>
                </section>

                <section class="module-page" id="settings-page">
                    <div class="module-head">
                        <h2>Settings</h2>
                        <p>Update password and account settings.</p>
                    </div>
                    <div class="table-panel">
                        @if (session('password_success'))
                            <div class="dashboard-profile-feedback success show">
                                <i class="fas fa-circle-check" style="margin-right:8px;"></i>{{ session('password_success') }}
                            </div>
                        @endif
                        @if ($errors->has('current_password') || $errors->has('password'))
                            <div class="dashboard-profile-feedback error show">
                                Please correct the highlighted password fields.
                            </div>
                        @endif
                        <form id="settingsPageForm" class="add-form-grid" action="{{ route('dashboard.password.update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="redirect_to" value="{{ route('admin.dashboard') }}#settings-page">
                            <div class="field full"><label>Change Password</label><input value="Password update form" readonly></div>
                            <div class="field"><label>Current Password</label><input id="currentPassword" name="current_password" type="password" required></div>
                            <div class="field"><label>New Password</label><input id="newPassword" name="password" type="password" required></div>
                            <div class="field"><label>Confirm New Password</label><input id="confirmNewPassword" name="password_confirmation" type="password" required></div>
                            <div class="field full" style="display:flex;justify-content:flex-end;">
                                <button class="btn theme" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <div class="modal-backdrop" id="formModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3 id="formModalTitle">Add Item</h3>
                <button class="close-btn" id="formModalClose" type="button" aria-label="Close" onclick="window.closeFormModal && window.closeFormModal()"><i class="fas fa-xmark"></i></button>
            </div>
            <form id="formModalForm">
                <div class="form-grid" id="formModalFields"></div>
                <div class="modal-actions">
                    <button class="btn" id="formModalCancel" type="button" onclick="window.closeFormModal && window.closeFormModal()">Cancel</button>
                    <button class="btn primary" type="submit">Done</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal-backdrop" id="viewModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3 id="viewModalTitle">Details</h3>
                <button class="close-btn" id="viewModalClose" type="button" aria-label="Close" onclick="window.closeViewModal && window.closeViewModal()"><i class="fas fa-xmark"></i></button>
            </div>
            <div id="viewModalBody"></div>
            <div class="modal-actions">
                <button class="btn primary" id="viewModalOk" type="button" onclick="window.closeViewModal && window.closeViewModal()">OK</button>
            </div>
        </div>
    </div>
    <div class="modal-backdrop" id="confirmModal">
        <div class="modal-card" style="max-width:480px;">
            <div class="modal-head">
                <h3 id="confirmModalTitle">Confirm Action</h3>
                <button class="close-btn" id="confirmModalClose" type="button" aria-label="Close" onclick="window.closeConfirmModal && window.closeConfirmModal()"><i class="fas fa-xmark"></i></button>
            </div>
            <p class="confirm-text" id="confirmModalText">Are you sure?</p>
            <div class="modal-actions">
                <button class="btn" id="confirmModalCancel" type="button" onclick="window.closeConfirmModal && window.closeConfirmModal()">Cancel</button>
                <button class="btn primary" id="confirmModalOk" type="button" onclick="window.executeConfirmModalAction && window.executeConfirmModalAction()">Delete</button>
            </div>
        </div>
    </div>
    <div class="modal-backdrop" id="permissionModal">
        <div class="modal-card">
            <div class="modal-head">
                <h3 id="permissionModalTitle">Update Permission Matrix</h3>
                <button class="close-btn" id="permissionModalClose" type="button" aria-label="Close" onclick="window.closePermissionModal && window.closePermissionModal()"><i class="fas fa-xmark"></i></button>
            </div>
            <div class="perm-grid" id="permissionModalGrid">
                <label><input type="checkbox" value="manage_orders"> Manage Orders</label>
                <label><input type="checkbox" value="manage_products"> Manage Products</label>
                <label><input type="checkbox" value="manage_inventory"> Manage Inventory</label>
                <label><input type="checkbox" value="manage_custom_jewellery"> Manage Custom Jewellery</label>
                <label><input type="checkbox" value="manage_consultations"> Manage Consultations</label>
                <label><input type="checkbox" value="manage_contact_messages"> Manage Contact Messages</label>
                <label><input type="checkbox" value="manage_content"> Manage Content</label>
                <label><input type="checkbox" value="manage_reports"> Manage Reports</label>
                <label><input type="checkbox" value="manage_notifications"> Manage Notifications</label>
                <label><input type="checkbox" value="manage_users"> Manage Users</label>
            </div>
            <div class="modal-actions">
                <button class="btn" id="permissionModalCancel" type="button" onclick="window.closePermissionModal && window.closePermissionModal()">Cancel</button>
                <button class="btn primary" id="permissionModalSave" type="button">Update</button>
            </div>
        </div>
    </div>
    <div class="password-alert-backdrop" id="tempPasswordAlert" aria-hidden="true">
        <div class="password-alert-card" role="dialog" aria-modal="true" aria-labelledby="tempPasswordAlertTitle">
            <p class="password-alert-kicker">Temporary Password</p>
            <h3 id="tempPasswordAlertTitle">Account created</h3>
            <p class="password-alert-copyline">Copy and share this password securely.</p>
            <div class="password-alert-field">
                <input type="text" id="tempPasswordValue" readonly>
                <button type="button" id="tempPasswordCopyBtn">Copy</button>
            </div>
            <div class="password-alert-actions">
                <button class="btn primary" type="button" id="tempPasswordCloseBtn">Close</button>
            </div>
        </div>
    </div>
    <script>
        (function () {
            const profileWrap = document.getElementById('profileWrap');
            const profileToggle = document.getElementById('profileToggle');
            const breadcrumbRoot = document.getElementById('breadcrumbRoot');
            const breadcrumbLeaf = document.getElementById('breadcrumbLeaf');
            const formModal = document.getElementById('formModal');
            const formModalTitle = document.getElementById('formModalTitle');
            const formModalFields = document.getElementById('formModalFields');
            const formModalForm = document.getElementById('formModalForm');
            const formModalClose = document.getElementById('formModalClose');
            const formModalCancel = document.getElementById('formModalCancel');
            const viewModal = document.getElementById('viewModal');
            const viewModalTitle = document.getElementById('viewModalTitle');
            const viewModalBody = document.getElementById('viewModalBody');
            const viewModalClose = document.getElementById('viewModalClose');
            const viewModalOk = document.getElementById('viewModalOk');
            const confirmModal = document.getElementById('confirmModal');
            const confirmModalTitle = document.getElementById('confirmModalTitle');
            const confirmModalText = document.getElementById('confirmModalText');
            const confirmModalClose = document.getElementById('confirmModalClose');
            const confirmModalCancel = document.getElementById('confirmModalCancel');
            const confirmModalOk = document.getElementById('confirmModalOk');
            const permissionModal = document.getElementById('permissionModal');
            const permissionModalTitle = document.getElementById('permissionModalTitle');
            const permissionModalGrid = document.getElementById('permissionModalGrid');
            const permissionModalClose = document.getElementById('permissionModalClose');
            const permissionModalCancel = document.getElementById('permissionModalCancel');
            const permissionModalSave = document.getElementById('permissionModalSave');
            const tempPasswordAlert = document.getElementById('tempPasswordAlert');
            const tempPasswordAlertTitle = document.getElementById('tempPasswordAlertTitle');
            const tempPasswordValue = document.getElementById('tempPasswordValue');
            const tempPasswordCopyBtn = document.getElementById('tempPasswordCopyBtn');
            const tempPasswordCloseBtn = document.getElementById('tempPasswordCloseBtn');
            const dashboardLink = document.querySelector('.sidebar > .menu > .item > .menu-link[href="#dashboard"]');
            const reportsItem = document.getElementById('reportsItem');
            const dashboardBoundary = document.getElementById('dashboardBoundary');
            const defaultSections = Array.from(document.querySelectorAll('.default-section'));
            const userPages = Array.from(document.querySelectorAll('.module-page'));
            const userManagementRoute = @json(route('admin.users.manage'));
            const adminUserExportBase = @json(url('/admin/users/export'));
            const permissionUpdateRoute = @json(route('admin.role-permissions.update'));
            const permissionCatalog = [
                { value: 'manage_orders', label: 'Manage Orders' },
                { value: 'manage_products', label: 'Manage Products' },
                { value: 'manage_inventory', label: 'Manage Inventory' },
                { value: 'manage_custom_jewellery', label: 'Manage Custom Jewellery' },
                { value: 'manage_consultations', label: 'Manage Consultations' },
                { value: 'manage_contact_messages', label: 'Manage Contact Messages' },
                { value: 'manage_content', label: 'Manage Content' },
                { value: 'manage_reports', label: 'Manage Reports' },
                { value: 'manage_notifications', label: 'Manage Notifications' },
                { value: 'manage_users', label: 'Manage Users' }
            ];
            function defaultPermissionsForRole(roleKey) {
                if (roleKey === 'lower_admin') {
                    return [
                        'manage_orders',
                        'manage_products',
                        'manage_inventory',
                        'manage_custom_jewellery',
                        'manage_consultations',
                        'manage_contact_messages'
                    ];
                }
                if (roleKey === 'content_manager') {
                    return [
                        'manage_content',
                        'manage_reports',
                        'manage_notifications'
                    ];
                }
                return [];
            }
            const routeMap = {
                '#orders-all-page': { page: 'orders-all-page', leaf: 'Orders / All Orders' },
                '#orders-delivery-page': { page: 'orders-delivery-page', leaf: 'Orders / Delivery Orders' },
                '#orders-pickup-page': { page: 'orders-pickup-page', leaf: 'Orders / Pickup Orders' },
                '#orders-returns-page': { page: 'orders-returns-page', leaf: 'Orders / Returns & Refunds' },
                '#custom-requests-page': { page: 'custom-requests-page', leaf: 'Custom Jewellery / Custom Requests' },
                '#custom-pending-page': { page: 'custom-pending-page', leaf: 'Custom Jewellery / Pending Requests' },
                '#custom-quotations-page': { page: 'custom-quotations-page', leaf: 'Custom Jewellery / Quotations' },
                '#custom-paid-page': { page: 'custom-paid-page', leaf: 'Custom Jewellery / Paid Designs' },
                '#consultation-requests-page': { page: 'consultation-requests-page', leaf: 'Consultation / Consultation Requests' },
                '#consultation-pending-page': { page: 'consultation-pending-page', leaf: 'Consultation / Pending Requests' },
                '#appointments-page': { page: 'appointments-page', leaf: 'Appointments / All Appointments' },
                '#consultation-chat-page': { page: 'consultation-chat-page', leaf: 'Consultation / Chat / Messages' },
                '#consultation-history-page': { page: 'consultation-history-page', leaf: 'Consultation / Consultation History' },
                '#reports-sales-page': { page: 'reports-sales-page', leaf: 'Reports & Analytics / Sales Reports' },
                '#reports-orders-page': { page: 'reports-orders-page', leaf: 'Reports & Analytics / Order Reports' },
                '#reports-products-page': { page: 'reports-products-page', leaf: 'Reports & Analytics / Product Reports' },
                '#reports-inventory-page': { page: 'reports-inventory-page', leaf: 'Reports & Analytics / Inventory Reports' },
                '#reports-customers-page': { page: 'reports-customers-page', leaf: 'Reports & Analytics / Customer Reports' },
                '#reports-consultation-page': { page: 'reports-consultation-page', leaf: 'Reports & Analytics / Consultation Reports' },
                '#reports-custom-jewellery-page': { page: 'reports-custom-jewellery-page', leaf: 'Reports & Analytics / Custom Jewellery Reports' },
                '#reports-revenue-page': { page: 'reports-revenue-page', leaf: 'Reports & Analytics / Revenue Analytics' },
                '#notifications-send-page': { page: 'notifications-send-page', leaf: 'Notifications / Send Notification' },
                '#notifications-list-page': { page: 'notifications-list-page', leaf: 'Notifications / Notification List' },
                '#content-blogs-page': { page: 'content-blogs-page', leaf: 'Content Management / Blog Management' },
                '#content-news-page': { page: 'content-news-page', leaf: 'Content Management / News Management' },
                '#content-faq-page': { page: 'content-faq-page', leaf: 'Content Management / FAQ Management' },
                '#content-gold-price-page': { page: 'content-gold-price-page', leaf: 'Content Management / Metal Price Updates' },
                '#contact-messages-page': { page: 'contact-messages-page', leaf: 'Contact Messages' },
                '#profile-page': { page: 'profile-page', leaf: 'Profile' },
                '#settings-page': { page: 'settings-page', leaf: 'Settings' },
                '#users-customers-page': { page: 'users-customers-page', leaf: 'User Management / Customers' },
                '#users-consultants-page': { page: 'users-consultants-page', leaf: 'User Management / Consultants' },
                '#users-admins-page': { page: 'users-admins-page', leaf: 'User Management / Admin Users' },
                '#users-roles-page': { page: 'users-roles-page', leaf: 'User Management / Roles & Permissions' },
                '#users-logs-page': { page: 'users-logs-page', leaf: 'User Management / Activity Logs' },
                '#products-all-page': { page: 'products-all-page', leaf: 'Product Management / All Products' },
                '#products-add-page': { page: 'products-add-page', leaf: 'Product Management / Add Product' },
                '#products-categories-page': { page: 'products-categories-page', leaf: 'Product Management / Jewellery Types' },
                '#products-reviews-page': { page: 'products-reviews-page', leaf: 'Product Management / Product Reviews' },
                '#inventory-stock-management-page': { page: 'inventory-stock-management-page', leaf: 'Inventory / Stock Management' },
                '#inventory-low-stock-page': { page: 'inventory-low-stock-page', leaf: 'Inventory / Low Stock Alerts' },
                '#inventory-out-of-stock-page': { page: 'inventory-out-of-stock-page', leaf: 'Inventory / Out of Stock Items' },
                '#inventory-history-page': { page: 'inventory-history-page', leaf: 'Inventory / Inventory History' }
            };
            const currentAdminUserId = @json(auth()->id());
            let currentAdminRole = @json(auth()->user()?->role);
            let currentAdminPermissions = @json(auth()->user()?->effectiveAdminPermissions() ?? []);
            const adminPermissionRules = [
                { prefix: 'orders-', permission: 'manage_orders' },
                { prefix: 'products-', permission: 'manage_products' },
                { prefix: 'inventory-', permission: 'manage_inventory' },
                { prefix: 'custom-', permission: 'manage_custom_jewellery' },
                { prefix: 'consultation-', permission: 'manage_consultations' },
                { prefix: 'reports-', permission: 'manage_reports' },
                { prefix: 'content-', permission: 'manage_content' },
                { prefix: 'contact-messages-page', permission: 'manage_contact_messages' },
                { prefix: 'notifications-', permission: 'manage_notifications' },
                { prefix: 'users-', permission: 'manage_users' }
            ];

            function hasFullAdminAccess() {
                return currentAdminRole === 'admin';
            }

            function hasPermission(permission) {
                if (!permission || hasFullAdminAccess()) return true;
                return Array.isArray(currentAdminPermissions) && currentAdminPermissions.indexOf(permission) !== -1;
            }

            function permissionForPage(pageId) {
                for (let i = 0; i < adminPermissionRules.length; i++) {
                    const rule = adminPermissionRules[i];
                    if (pageId === rule.prefix || pageId.indexOf(rule.prefix) === 0) return rule.permission;
                }
                return null;
            }

            function canAccessPage(pageId) {
                return hasPermission(permissionForPage(pageId));
            }

            function syncCurrentAdminAccess(nextRole, nextPermissions) {
                currentAdminRole = nextRole || currentAdminRole;
                currentAdminPermissions = Array.isArray(nextPermissions) ? nextPermissions.slice() : [];
                applyPermissionVisibility();
                showPageByHash();
            }

            function setReportsGroupActive(isActive) {
                if (!reportsItem) return;
                const reportsToggle = reportsItem.querySelector('.menu-toggle');
                reportsItem.classList.toggle('has-active-child', isActive);
                if (isActive) {
                    reportsItem.classList.add('open');
                }
                if (reportsToggle) {
                    reportsToggle.classList.toggle('active', isActive);
                    reportsToggle.setAttribute('aria-expanded', isActive ? 'true' : 'false');
                }
            }

            function firstAccessibleHash() {
                const hashes = Object.keys(routeMap);
                for (let i = 0; i < hashes.length; i++) {
                    const hash = hashes[i];
                    const pageId = routeMap[hash] ? routeMap[hash].page : '';
                    if (pageId && canAccessPage(pageId)) return hash;
                }
                return '#profile-page';
            }

            function applyPermissionVisibility() {
                document.querySelectorAll('.sidebar .menu-link, .sidebar .submenu a').forEach(function (link) {
                    const hash = link.getAttribute('href');
                    const mapped = hash ? routeMap[hash] : null;
                    const allowed = !mapped || canAccessPage(mapped.page);
                    link.dataset.permissionHidden = allowed ? '0' : '1';
                    link.style.display = allowed ? '' : 'none';
                });

                document.querySelectorAll('.sidebar .item').forEach(function (item) {
                    const visibleMainLink = item.querySelector('.menu-link[data-permission-hidden="0"]');
                    const visibleSubLink = item.querySelector('.submenu a[data-permission-hidden="0"]');
                    if (!visibleMainLink && !visibleSubLink) {
                        item.style.display = 'none';
                    }
                });
            }

            applyPermissionVisibility();

            document.querySelectorAll('.item .menu-toggle').forEach(function (toggle) {
                const item = toggle.closest('.item');
                if (!item) return;
                toggle.classList.toggle('active', item.classList.contains('open'));
                toggle.setAttribute('aria-expanded', item.classList.contains('open') ? 'true' : 'false');
                toggle.addEventListener('click', function () {
                    const isOpen = item.classList.toggle('open');
                    toggle.classList.toggle('active', isOpen);
                    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                });
            });

            function showPageByHash() {
                const hash = window.location.hash;
                const matched = routeMap[hash];
                const dashboardShell = !matched;
                document.body.classList.toggle('dashboard-shell', dashboardShell);
                if (matched && !canAccessPage(matched.page)) {
                    const fallbackHash = firstAccessibleHash();
                    if (fallbackHash && fallbackHash !== hash) {
                        window.location.replace(fallbackHash);
                        return;
                    }
                }
                if (!hash && !hasFullAdminAccess()) {
                    const fallbackHash = firstAccessibleHash();
                    if (fallbackHash) {
                        window.location.replace(fallbackHash);
                        return;
                    }
                }
                document.querySelectorAll('.sidebar .menu-link, .sidebar .submenu a').forEach(function (link) {
                    link.classList.toggle('active', !!hash && link.getAttribute('href') === hash);
                });
                document.querySelectorAll('.sidebar .item').forEach(function (item) {
                    item.classList.remove('has-active-child');
                });
                if (hash) {
                    const activeSubmenuLink = document.querySelector('.sidebar .submenu a[href="' + hash + '"]');
                    const activeTopLink = document.querySelector('.sidebar > .menu > .item > .menu-link[href="' + hash + '"]');
                    if (activeSubmenuLink) {
                        const parentItem = activeSubmenuLink.closest('.item');
                        if (parentItem) {
                            parentItem.classList.add('has-active-child');
                            parentItem.classList.add('open');
                            const parentToggle = parentItem.querySelector('.menu-toggle');
                            if (parentToggle) {
                                parentToggle.classList.add('active');
                                parentToggle.setAttribute('aria-expanded', 'true');
                            }
                        }
                    } else if (activeTopLink) {
                        activeTopLink.classList.add('active');
                    }
                }
                userPages.forEach(function (page) {
                    const active = matched && page.id === matched.page && canAccessPage(page.id);
                    page.classList.toggle('active', active);
                });

                defaultSections.forEach(function (section) {
                    section.style.display = matched && canAccessPage(matched.page) ? 'none' : '';
                });

                if (breadcrumbRoot && breadcrumbLeaf) {
                    breadcrumbRoot.textContent = 'Dashboard';
                    breadcrumbLeaf.textContent = matched ? matched.leaf : 'Overview';
                }
            }

            let dashboardScrollFrame = 0;
            function updateDashboardSectionFromScroll() {
                if (window.location.hash && routeMap[window.location.hash]) return;
                if (dashboardLink) dashboardLink.classList.add('active');
                setReportsGroupActive(false);
            }

            window.addEventListener('scroll', function () {
                if (dashboardScrollFrame) return;
                dashboardScrollFrame = window.requestAnimationFrame(function () {
                    dashboardScrollFrame = 0;
                    updateDashboardSectionFromScroll();
                });
            }, { passive: true });

            window.addEventListener('hashchange', showPageByHash);
            showPageByHash();
            updateDashboardSectionFromScroll();

            function notify(message) {
                const toast = document.createElement('div');
                const text = String(message || 'Saved successfully');
                const tone = /unable|error|failed|incorrect|missing|invalid|not found|cancelled|cancelled/i.test(text)
                    ? 'error'
                    : /warning|careful|please|already|duplicate|exists|confirm/i.test(text)
                        ? 'warning'
                        : /success|saved|updated|created|added|download|export|sent|approved|rejected|completed|copied/i.test(text)
                            ? 'success'
                            : 'info';
                const toneLabel = tone.charAt(0).toUpperCase() + tone.slice(1);
                const toneIcon = tone === 'success' ? 'OK' : (tone === 'warning' ? '!' : (tone === 'error' ? '!' : 'i'));

                toast.className = 'admin-toast';
                toast.setAttribute('data-tone', tone);
                toast.innerHTML = `
                    <div class="admin-toast__row">
                        <div class="admin-toast__icon">${toneIcon}</div>
                        <div class="admin-toast__content">
                            <span class="admin-toast__title">${toneLabel}</span>
                            <span class="admin-toast__message"></span>
                        </div>
                    </div>
                `;
                toast.querySelector('.admin-toast__message').textContent = text;
                document.body.appendChild(toast);
                setTimeout(function () {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateY(12px) scale(.98)';
                    toast.style.transition = 'opacity .2s ease, transform .2s ease';
                    setTimeout(function () { toast.remove(); }, 220);
                }, 2800);
            }

            function openTempPasswordAlert(title, password) {
                if (!tempPasswordAlert || !tempPasswordAlertTitle || !tempPasswordValue) return;
                tempPasswordAlertTitle.textContent = title || 'Temporary Password';
                tempPasswordValue.value = password || '';
                tempPasswordAlert.classList.add('open');
                tempPasswordAlert.setAttribute('aria-hidden', 'false');
                setTimeout(function () {
                    tempPasswordValue.focus();
                    tempPasswordValue.select();
                }, 0);
            }

            function closeTempPasswordAlert() {
                if (!tempPasswordAlert || !tempPasswordValue) return;
                tempPasswordAlert.classList.remove('open');
                tempPasswordAlert.setAttribute('aria-hidden', 'true');
                tempPasswordValue.value = '';
            }

            let activeFormSubmit = null;
            let activeFormFieldsConfig = [];
            let activeConfirmAction = null;
            let activePermissionRow = null;
            let activeConfirmButtonLabel = 'Delete';
            let activeChatKey = '';
            const userFilterTimers = {};
            const productFilterTimers = {};
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || @json(csrf_token());
            const consultationRequestUpdateRoute = @json('/consultant/consultation-requests');
            const adminProductExportBase = @json('/admin/products/export/all');
            const adminReportExportBase = @json('/admin/reports/export');
            const adminProductManageRoute = @json('/admin/products/manage');
            const adminOrderManageRoute = @json('/admin/orders/manage');
            const adminReturnManageRoute = @json('/admin/returns/manage');
            const adminCustomJewelleryManageRoute = @json('/admin/custom-jewellery/manage');
            const adminProductDetailsBase = @json('/admin/products');
            const adminProductReviewDeleteRoute = @json('/admin/product-reviews/manage');
            const adminStockManageRoute = @json('/admin/stock/manage');
            const adminStockExportRoute = @json('/admin/stock/export');
            const adminCategoryManageRoute = @json('/admin/categories/manage');
            const productCategoryOptions = @json(($productCategoryOptions ?? collect())->values());
            const productCategorySelectOptions = ['Gems', 'Jewellery', 'Collections'];
            const gemTypeOptions = @json(($gemTypeOptions ?? collect())->values());
            const jewelleryTypeOptions = @json(($jewelleryTypeOptions ?? collect())->values());
            const consultantOptions = @json(($consultants ?? collect())->map(function ($consultant) {
                return [
                    'id' => $consultant->id,
                    'name' => trim((($consultant->first_name ?? '') . ' ' . ($consultant->last_name ?? ''))) ?: 'Consultant',
                ];
            })->values());
            @php
                $consultationThreadData = ($consultationRequests ?? collect())->mapWithKeys(function ($consultationRequest) {
                    $threadKey = $consultationRequest->chat_thread_id ?: 'consultation-' . $consultationRequest->request_number;

                    return [
                        $threadKey => [
                            'thread_key' => $threadKey,
                            'request_id' => $consultationRequest->request_number,
                            'customer_name' => $consultationRequest->customer_name,
                            'consultant_name' => $consultationRequest->consultant_name,
                            'request_type' => $consultationRequest->display_request_type,
                            'status' => $consultationRequest->status,
                            'submitted_on' => $consultationRequest->created_at?->format('Y-m-d'),
                            'date_time' => $consultationRequest->date_time_label,
                            'messages' => $consultationRequest->messages->map(function ($message) {
                                $role = strtolower((string) ($message->sender_role ?? 'admin'));

                                return [
                                    'sender' => $role === 'customer' ? 'Customer' : ($role === 'consultant' ? 'Consultant' : 'Admin'),
                                    'text' => $message->message,
                                    'time' => $message->created_at?->format('h:i A') ?? 'Now',
                                    'imageUrl' => $message->image_path ? asset($message->image_path) : null,
                                    'imagePath' => $message->image_path,
                                ];
                            })->values(),
                        ],
                    ];
                })->all();
            @endphp
            let consultationThreadData = @json($consultationThreadData);
function closeFormModal() {
                if (!formModal) return;
                formModal.classList.remove('open');
                formModalFields.innerHTML = '';
                activeFormSubmit = null;
                activeFormFieldsConfig = [];
            }
            window.closeFormModal = closeFormModal;

            function clearFieldErrors(container) {
                if (!container) return;
                container.querySelectorAll('.field').forEach(function (field) {
                    field.classList.remove('invalid');
                });
                container.querySelectorAll('[aria-invalid="true"]').forEach(function (input) {
                    input.removeAttribute('aria-invalid');
                });
                container.querySelectorAll('.field-error').forEach(function (error) {
                    error.remove();
                });
            }

            function showFieldErrors(container, errors) {
                if (!container || !errors) return;
                clearFieldErrors(container);
                Object.keys(errors).forEach(function (name) {
                    const input = container.querySelector('[name="' + name + '"], #' + name);
                    const fieldWrap = input ? input.closest('.field') : null;
                    if (!fieldWrap) return;
                    fieldWrap.classList.add('invalid');
                    if (input) input.setAttribute('aria-invalid', 'true');
                    const error = document.createElement('div');
                    error.className = 'field-error';
                    error.textContent = errors[name];
                    fieldWrap.appendChild(error);
                });
            }

            function notifyValidationErrors(errors) {
                const firstError = errors ? Object.values(errors).find(Boolean) : '';
                notify(firstError || 'Please correct the highlighted fields');
            }

            function isBlankValue(value) {
                if (value == null) return true;
                if (Array.isArray(value)) return value.length === 0;
                if (typeof value === 'object') {
                    if (value instanceof File) return !value.name;
                    return Object.keys(value).length === 0;
                }
                return String(value).trim() === '';
            }

            function validateFieldValue(field, value) {
                const raw = value == null ? '' : String(value).trim();
                const label = field.label || 'This field';
                if (field.required) {
                    const isFile = field.type === 'file';
                    const fileMissing = isFile && (!value || !value.name);
                    if (isBlankValue(value) || fileMissing) return label + ' is required';
                }
                if (!raw && field.type !== 'file') return '';
                if (field.type === 'email' || field.name === 'email') {
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(raw)) return 'Enter a valid email address';
                }
                if (field.name && field.name.toLowerCase().indexOf('phone') !== -1) {
                    if (raw.replace(/\D/g, '').length < 10) return 'Enter a valid phone number';
                }
                if (field.name && field.name.toLowerCase().indexOf('password') !== -1) {
                    if (!raw) return '';
                    if (raw.length < 8) return 'Password must be at least 8 characters';
                }
                if (field.type === 'number' && raw && isNaN(Number(raw))) return label + ' must be a number';
                if ((field.name === 'amount' || field.name === 'price') && raw && !/[0-9]/.test(raw)) return 'Enter a valid amount';
                if ((field.name === 'title' || field.name === 'question' || field.name === 'subject' || field.name === 'name') && raw.length < 3) return label + ' must be at least 3 characters';
                if ((field.name === 'message' || field.name === 'content' || field.name === 'answer' || field.name === 'review') && raw.length < 5) return label + ' must be at least 5 characters';
                return '';
            }

            function extractNumericText(value) {
                const raw = value == null ? '' : String(value);
                const match = raw.match(/-?\d[\d,]*(?:\.\d+)?/);
                return match ? match[0].replace(/,/g, '') : '';
            }

            function validateFields(fields, data) {
                const errors = {};
                (fields || []).forEach(function (field) {
                    if (field.type === 'permissions') return;
                    const message = validateFieldValue(field, data[field.name]);
                    if (message) errors[field.name] = message;
                });
                const password = String(data.password || '').trim();
                const passwordConfirmation = String(data.password_confirmation || '').trim();
                if ((password || passwordConfirmation) && password !== passwordConfirmation) {
                    errors.password_confirmation = 'Password confirmation does not match';
                }
                return errors;
            }

            async function submitUserManagementAction(payload) {
                const response = await fetch(userManagementRoute, {
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
                    throw new Error(data?.message || 'Unable to save user changes.');
                }

                return data;
            }

            async function submitOrderManagementAction(payload) {
                const response = await fetch(adminOrderManageRoute, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload || {}),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(data?.message || 'Unable to save order changes.');
                }

                return data;
            }

            async function submitReturnManagementAction(payload) {
                const response = await fetch(adminReturnManageRoute, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload || {}),
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(data?.message || 'Unable to save return changes.');
                }

                return data;
            }

            async function submitCustomJewelleryAction(payload) {
                const formData = new FormData();
                Object.entries(payload || {}).forEach(function ([key, value]) {
                    if (value === null || value === undefined) return;
                    if (Array.isArray(value)) {
                        value.forEach(function (item) {
                            formData.append(key, item);
                        });
                        return;
                    }
                    formData.append(key, value instanceof File ? value : String(value));
                });
                const response = await fetch(adminCustomJewelleryManageRoute, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(data?.message || 'Unable to save custom jewellery changes.');
                }

                return data;
            }

            function openFormModal(config) {
                if (!formModal || !formModalFields || !formModalTitle) return;
                formModalTitle.textContent = config.title;
                formModalFields.innerHTML = '';
                formModalForm.noValidate = true;
                activeFormFieldsConfig = config.fields || [];
                config.fields.forEach(function (field) {
                    const wrap = document.createElement('div');
                    wrap.className = 'field';
                    const label = document.createElement('label');
                    label.textContent = field.label;
                if (field.type === 'permissions') {
                        wrap.classList.add('full');
                        const grid = document.createElement('div');
                        grid.className = 'perm-grid';
                        (field.options || []).forEach(function (opt) {
                            const optionValue = opt && typeof opt === 'object'
                                ? (opt.value != null ? opt.value : (opt.id != null ? opt.id : (opt.label || opt.name || '')))
                                : opt;
                            const optionLabel = opt && typeof opt === 'object'
                                ? (opt.label || opt.name || String(optionValue))
                                : String(opt);
                            const itemLabel = document.createElement('label');
                            const cb = document.createElement('input');
                            cb.type = 'checkbox';
                            cb.name = field.name;
                            cb.value = optionValue;
                            cb.checked = (field.checkedOptions || []).indexOf(optionValue) !== -1;
                            itemLabel.appendChild(cb);
                            itemLabel.appendChild(document.createTextNode(' ' + optionLabel));
                            grid.appendChild(itemLabel);
                        });
                        wrap.appendChild(label);
                        wrap.appendChild(grid);
                        formModalFields.appendChild(wrap);
                        return;
                    }
                    const input = document.createElement(field.type === 'select' ? 'select' : 'input');
                    input.name = field.name;
                    input.required = !!field.required;
                    if (field.type === 'select') {
                        (field.options || []).forEach(function (opt) {
                            const option = document.createElement('option');
                            if (opt && typeof opt === 'object') {
                                option.value = opt.value != null ? opt.value : (opt.id != null ? opt.id : (opt.label || opt.name || ''));
                                option.textContent = opt.label || opt.name || String(option.value);
                            } else {
                                option.value = opt;
                                option.textContent = opt;
                            }
                            input.appendChild(option);
                        });
                        if (field.value != null) {
                            input.value = field.value;
                        }
                    } else {
                        input.type = field.type || 'text';
                        input.placeholder = field.placeholder || '';
                        if (field.accept) input.accept = field.accept;
                        if (field.value) input.value = field.value;
                        if (field.type === 'number') {
                            input.step = field.step || 'any';
                            if (field.min !== undefined && field.min !== null) input.min = String(field.min);
                            if (field.max !== undefined && field.max !== null) input.max = String(field.max);
                        }
                    }
                    wrap.appendChild(label);
                    wrap.appendChild(input);
                    formModalFields.appendChild(wrap);
                });
                activeFormSubmit = config.onSubmit;
                formModal.classList.add('open');
            }

            function setProductPricingModeVisibility(container, categoryValue) {
                if (!container) return;
                const pricingField = container.querySelector('[name="pricing_mode"]');
                const pricingWrap = pricingField ? pricingField.closest('.field') : null;
                if (!pricingField || !pricingWrap) return;
                const normalized = String(categoryValue || '').trim().toLowerCase();
                const isGem = normalized === 'gems';
                const isCollection = normalized === 'collections';
                const hidePricing = isGem || isCollection;
                pricingWrap.style.display = hidePricing ? 'none' : '';
                pricingField.disabled = hidePricing;
            }

            function renderAddProductSpecificFields(container, categoryValue) {
                if (!container) return;
                const normalized = String(categoryValue || '').trim().toLowerCase();
                const isGem = normalized === 'gems';
                const isJewellery = normalized === 'jewellery';
                const isCollection = normalized === 'collections';
                if (!isGem && !isJewellery && !isCollection) {
                    container.innerHTML = '';
                    return;
                }
                if (isGem) {
                    container.innerHTML = [
                        '<div class="field full"><label>Gem Type</label><select id="apGemType" required><option value="">Select Gem Type</option>',
                        gemTypeOptions.map(function (option) {
                            return '<option value="' + String(option).replace(/"/g, '&quot;') + '">' + String(option) + '</option>';
                        }).join(''),
                        '</select></div>',
                        '<div class="field"><label>Color</label><input id="apColor" type="text" placeholder="Blue, Red, Green"></div>',
                        '<div class="field"><label>Shape</label><input id="apShape" type="text" placeholder="Oval, Round, Cushion"></div>',
                        '<div class="field"><label>Carat Weight</label><input id="apCaratWeight" type="number" min="0" step="0.01" placeholder="1.25"></div>'
                    ].join('');
                    return;
                }

                if (isCollection) {
                    container.innerHTML = [
                        '<div class="field"><label>Occasion</label><input id="apOccasion" type="text" placeholder="Wedding, Daily Wear, Party" required></div>',
                        '<div class="field"><label>Gender</label><select id="apGender" required><option value="">Select Gender</option><option value="Men">Men</option><option value="Women">Women</option><option value="Unisex">Unisex</option></select></div>',
                        '<div class="field full"><label>Gemstone</label><input id="apGemstone" type="text" placeholder="Diamond, Ruby, Sapphire" required></div>',
                        '<div class="field"><label>Metal</label><input id="apMetal" type="text" placeholder="Gold, Silver, Platinum" required></div>'
                    ].join('');
                    return;
                }

                container.innerHTML = [
                    '<div class="field full"><label>Jewellery Type</label><select id="apJewelleryType" required><option value="">Select Jewellery Type</option>',
                    jewelleryTypeOptions.map(function (option) {
                        return '<option value="' + String(option).replace(/"/g, '&quot;') + '">' + String(option) + '</option>';
                    }).join(''),
                    '</select></div>',
                    '<div class="field"><label>Occasion</label><input id="apOccasion" type="text" placeholder="Wedding, Daily Wear, Party" required></div>',
                    '<div class="field"><label>Gender</label><select id="apGender" required><option value="">Select Gender</option><option value="Men">Men</option><option value="Women">Women</option><option value="Unisex">Unisex</option></select></div>',
                    '<div class="field full"><label>Gemstone</label><input id="apGemstone" type="text" placeholder="Diamond, Ruby, Sapphire" required></div>',
                    '<div class="field"><label>Metal</label><input id="apMetal" type="text" placeholder="Gold, Silver, Platinum" required></div>',
                    '<div class="field"><label>Metal Purity</label><input id="apMetalPurity" type="text" placeholder="24K, 22K, 925, 950" required></div>',
                    '<div class="field"><label>Metal Weight (g)</label><input id="apMetalWeight" type="number" min="0" step="0.001" value="0" placeholder="12.500"></div>',
                    '<div class="field"><label>Making Charge (LKR)</label><input id="apMakingCharge" type="number" min="0" step="0.01" value="0" placeholder="1500"></div>',
                    '<div class="field"><label>Wastage (%)</label><input id="apWastage" type="number" min="0" step="0.01" value="0" placeholder="5"></div>',
                    '<div class="field"><label>Market Factor</label><input id="apMarketFactor" type="number" min="0" max="1" step="0.01" value="0.80" placeholder="0.80"></div>',
                    '<div class="field" id="apPricingModeWrap"><label>Pricing Mode</label><select id="apPricingMode"><option value="dynamic">Dynamic</option><option value="static">Static</option></select></div>',
                    '<div class="field"><label>Size Label</label><input id="apSizeLabel" type="text" placeholder="Ring Size, Necklace Length"></div>',
                    '<div class="field full"><label>Available Sizes</label><input id="apSizeOptions" type="text" placeholder="6, 7, 8, 9"></div>',
                    '<div class="field full form-block" id="apPreview360Block"><label>360 Preview Images</label><input id="apPreview360Images" type="file" accept="image/*" multiple><small style="display:block;margin-top:6px;color:var(--muted);">Upload exactly 8 images for the jewellery 360 preview.</small></div>'
                ].join('');
            }

            function setProductFormFieldVisibility(container, fieldName, visible) {
                if (!container) return;
                const field = container.querySelector('[name="' + fieldName + '"]');
                const wrap = field ? field.closest('.field') : null;
                if (!field || !wrap) return;
                wrap.style.display = visible ? '' : 'none';
                field.disabled = !visible;
            }

            function setEditProductVisibility(container, categoryValue) {
                if (!container) return;
                const normalized = String(categoryValue || '').trim().toLowerCase();
                const isGem = normalized === 'gems';
                const isCollection = normalized === 'collections';
                ['gem_type', 'color', 'shape', 'carat_weight'].forEach(function (name) {
                    setProductFormFieldVisibility(container, name, isGem);
                });
                ['jewellery_type', 'metal_purity', 'metal_weight', 'making_charge', 'wastage', 'market_factor', 'pricing_mode'].forEach(function (name) {
                    setProductFormFieldVisibility(container, name, !isGem && !isCollection);
                });
                ['size_label', 'size_options'].forEach(function (name) {
                    setProductFormFieldVisibility(container, name, !isGem && !isCollection);
                });
                ['occasion', 'gender', 'gemstone', 'metal'].forEach(function (name) {
                    setProductFormFieldVisibility(container, name, !isGem);
                });
                setProductPricingModeVisibility(container, categoryValue);
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

            function statusClassFromText(text) {
                const lower = String(text || '').toLowerCase();
                if (lower === 'active' || lower === 'available' || lower === 'success' || lower === 'healthy' || lower === 'completed' || lower === 'pickup completed' || lower === 'approved' || lower === 'refunded' || lower === 'verified' || lower === 'published' || lower === 'sent' || lower === 'replied' || lower === 'updated') return 'ok';
                if (lower === 'processing' || lower === 'in progress' || lower === 'out for delivery') return 'info';
                if (lower === 'pickup' || lower === 'ready to pickup' || lower === 'ready for pickup' || lower === 'out for pickup') return 'pickup';
                if (lower === 'blocked' || lower === 'deleted' || lower === 'deactivated' || lower === 'critical' || lower === 'out of stock' || lower === 'rejected' || lower === 'unpublished') return 'bad';
                return 'warn';
            }

            function normalizePaymentKey(value) {
                const lower = String(value || '').trim().toLowerCase();
                if (!lower) return '';
                if (lower === 'bank transfer' || lower === 'bank_transfer') return 'bank';
                if (lower === 'cash on delivery') return 'cod';
                return lower;
            }

            function closeViewModal() {
                if (!viewModal) return;
                viewModal.classList.remove('open');
                if (viewModalBody) viewModalBody.innerHTML = '';
                activeChatKey = '';
            }
            window.closeViewModal = closeViewModal;

            function openViewModal(title, rows, initials) {
                if (!viewModal || !viewModalBody || !viewModalTitle) return;
                viewModalTitle.textContent = title;
                let html = '';
                if (initials) {
                    html += '<div class="profile-chip"><div class="profile-pic">' + initials + '</div><div><strong>' + title + '</strong></div></div>';
                }
                html += '<div class="view-grid">';
                rows.forEach(function (item) {
                    if (item.html) html += '<div class="view-item"><span>' + item.label + '</span>' + item.html + '</div>';
                    else html += '<div class="view-item"><span>' + item.label + '</span><strong>' + item.value + '</strong></div>';
                });
                html += '</div>';
                viewModalBody.innerHTML = html;
                viewModal.classList.add('open');
            }

            function renderConsultationChat(threadKey, title, participants) {
                if (!viewModal || !viewModalBody || !viewModalTitle) return;
                activeChatKey = threadKey;
                const thread = consultationThreadData[threadKey] || { messages: [] };
                const messages = thread.messages || [];
                let html = '<div class="chat-shell">';
                html += '<div class="chat-hero"><div class="chat-title-wrap"><strong>' + title + '</strong><span>' + (thread.request_id ? thread.request_id + ' - ' + (thread.request_type || 'Consultation') : participants) + '</span></div><div class="chat-badge"><i class="fas fa-comments"></i> Active Chat</div></div>';
                html += '<div class="chat-thread">';
                if (!messages.length) {
                    html += '<div class="chat-empty" style="padding:14px 16px;border:1px dashed #e6d4b6;border-radius:14px;background:#fff;text-align:center;color:var(--muted);">No messages yet. Open the thread to begin the consultation chat.</div>';
                }
                messages.forEach(function (message) {
                    const isAdminSide = message.sender === 'Admin' || message.sender === 'Consultant';
                    html += '<div class="chat-row ' + (isAdminSide ? 'admin-side' : 'customer-side') + '">';
                    html += '<div class="chat-bubble">';
                    html += '<div style="font-size:.78rem;color:var(--muted);margin-bottom:6px;">' + message.sender + ' &bull; ' + message.time + '</div>';
                    html += '<div class="chat-text">' + message.text + '</div>';
                    if (message.imageUrl) {
                        html += '<div class="chat-media"><img src="' + message.imageUrl + '" alt="Consultation attachment"></div>';
                    }
                    html += '</div></div>';
                });
                html += '</div>';
                html += '<div class="chat-compose">';
                html += '<div class="chat-compose-head"><strong>Admin Review Only</strong><span>Use the consultation actions to approve, reject, or assign consultants. Chat replies are handled by the assigned consultant.</span></div>';
                html += '<div style="padding:12px 14px;border:1px dashed #e6d4b6;border-radius:14px;background:#fff;color:var(--muted);line-height:1.6;">Admin messages are disabled here to keep consultations focused on request handling and consultant-customer communication.</div>';
                html += '</div></div>';
                viewModalTitle.textContent = title;
                viewModalBody.innerHTML = html;
                viewModal.classList.add('open');
            }

            function closeConfirmModal() {
                if (!confirmModal) return;
                confirmModal.classList.remove('open');
                activeConfirmAction = null;
                activeConfirmButtonLabel = 'Delete';
                if (confirmModalTitle) confirmModalTitle.textContent = 'Confirm Action';
                if (confirmModalOk) confirmModalOk.textContent = 'Delete';
            }
            window.closeConfirmModal = closeConfirmModal;

            function executeConfirmModalAction() {
                if (typeof activeConfirmAction === 'function') {
                    const result = activeConfirmAction();
                    if (result && typeof result.then === 'function') {
                        result.then(function () {
                            closeConfirmModal();
                        }).catch(function (error) {
                            notify(error && error.message ? error.message : 'Unable to save changes');
                        });
                        return;
                    }
                }
                closeConfirmModal();
            }
            window.executeConfirmModalAction = executeConfirmModalAction;

            function openConfirmModal(config, onConfirm) {
                if (!confirmModal || !confirmModalText || !confirmModalTitle) return;
                const options = typeof config === 'string' ? { message: config, onConfirm: onConfirm } : (config || {});
                confirmModalTitle.textContent = options.title || 'Delete Confirmation';
                confirmModalText.textContent = options.message || 'Are you sure?';
                activeConfirmAction = options.onConfirm || onConfirm || null;
                activeConfirmButtonLabel = options.confirmLabel || 'Delete';
                if (confirmModalOk) confirmModalOk.textContent = activeConfirmButtonLabel;
                confirmModal.classList.add('open');
            }

            function isOrderPage(pageId) {
                return ['orders-all-page', 'orders-delivery-page', 'orders-pickup-page'].indexOf(pageId) !== -1;
            }

            function isCustomPage(pageId) {
                return ['custom-requests-page', 'custom-pending-page', 'custom-quotations-page', 'custom-paid-page'].indexOf(pageId) !== -1;
            }

            function isConsultationPage(pageId) {
                return ['consultation-requests-page', 'consultation-pending-page', 'consultation-chat-page', 'consultation-history-page'].indexOf(pageId) !== -1;
            }

            function isAppointmentPage(pageId) {
                return ['appointments-page'].indexOf(pageId) !== -1;
            }

            function isContentPage(pageId) {
                return ['content-blogs-page', 'content-news-page', 'content-faq-page', 'content-gold-price-page', 'contact-messages-page'].indexOf(pageId) !== -1;
            }

            function normalizeActionInlineLayout(container) {
                if (!container) return;

                const actions = Array.from(container.children).filter(function (child) {
                    return child && child.matches && (child.matches('button, a, form'));
                });
                const count = actions.length;
                const columns = count >= 4 ? 2 : Math.max(count, 1);

                container.style.setProperty('--actions-cols', String(columns));
                container.dataset.actionCount = String(count);
            }

            function refreshActionInlineLayouts(root) {
                const scope = root && root.querySelectorAll ? root : document;
                scope.querySelectorAll('.actions-inline').forEach(function (container) {
                    normalizeActionInlineLayout(container);
                });
            }

            let actionInlineLayoutObserver = null;

            function startActionInlineLayoutObserver() {
                if (actionInlineLayoutObserver || typeof MutationObserver === 'undefined' || !document.body) {
                    return;
                }

                actionInlineLayoutObserver = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        mutation.addedNodes.forEach(function (node) {
                            if (!node || node.nodeType !== 1) return;

                            if (node.matches && node.matches('.actions-inline')) {
                                normalizeActionInlineLayout(node);
                            }

                            if (node.querySelectorAll) {
                                node.querySelectorAll('.actions-inline').forEach(function (container) {
                                    normalizeActionInlineLayout(container);
                                });
                            }
                        });
                    });
                });

                actionInlineLayoutObserver.observe(document.body, { childList: true, subtree: true });
            }

            function buildAppointmentRow(row) {
                return '<tr><td>' + row.children[0].textContent.trim() + '</td><td>' + row.children[1].textContent.trim() + '</td><td>' + row.children[2].textContent.trim() + '</td><td>' + row.children[3].textContent.trim() + '</td><td>' + row.children[4].textContent.trim() + '</td><td>' + row.children[5].textContent.trim() + '</td><td><span class="status ' + (row.dataset.statusClass || 'info') + '">' + row.children[6].textContent.trim() + '</span></td><td><div class="actions-inline"><button class="mini-btn" type="button">View Details</button></div></td></tr>';
            }

            function getOrderColumnConfig(pageId) {
                if (['orders-all-page', 'orders-delivery-page', 'orders-pickup-page'].indexOf(pageId) !== -1) {
                    return { id: 0, customer: 1, product: 2, total: 3, paid: 4, outstanding: 5, payment: 6, shipping: 7, date: 8, status: 9, extraLabel: '', extraValueIndex: null };
                }
                return { id: 0, customer: 1, product: 2, total: 3, paid: 4, outstanding: 5, payment: 6, date: 7, status: 8, extraLabel: '', extraValueIndex: null };
            }

            function getOrderDetails(pageId, row) {
                const cfg = getOrderColumnConfig(pageId);
                const orderId = row.children[cfg.id] ? row.children[cfg.id].textContent.trim() : '-';
                const customer = row.children[cfg.customer] ? row.children[cfg.customer].textContent.trim() : '-';
                const product = row.children[cfg.product] ? row.children[cfg.product].textContent.trim() : '-';
                const total = row.children[cfg.total] ? row.children[cfg.total].textContent.trim() : '-';
                const payment = cfg.payment != null && row.children[cfg.payment] ? row.children[cfg.payment].textContent.trim() : (pageId === 'orders-pickup-page' ? 'Pickup Payment' : 'See order note');
                const receiptImage = String(row.dataset.receiptImage || '').trim();
                const shipping = cfg.shipping != null && row.children[cfg.shipping] ? row.children[cfg.shipping].textContent.trim() : (String(row.dataset.shippingMethod || '').toLowerCase() === 'pickup' ? 'Store Pickup' : 'Standard Shipping');
                const orderDate = row.children[cfg.date] ? row.children[cfg.date].textContent.trim() : '-';
                const status = row.children[cfg.status] ? row.children[cfg.status].textContent.trim() : '-';
                const customerInitials = customer.split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() || 'OR';
                const orderType = String(row.dataset.orderType || '').toLowerCase();
                const isPickup = row.dataset.pickupOnly === '1' || orderType === 'pickup' || status.toLowerCase().indexOf('pickup') !== -1 || pageId === 'orders-pickup-page';
                const totalValue = parseFloat(row.dataset.totalValue || total.replace(/[^0-9.]/g, '')) || 0;
                const depositValue = parseFloat(row.dataset.depositAmount || '0') || 0;
                const balanceValue = parseFloat(row.dataset.balanceDue || '0') || 0;
                const isHighValue = totalValue >= 40000;
                const paidLabel = isPickup ? (row.dataset.paymentMethod || payment) : payment;
                const pickupConfig = isPickup ? (row.dataset.pickupConfig || 'Store Pickup') : 'Standard Delivery';
                const shippingMethod = String(row.dataset.shippingMethod || (isPickup ? 'pickup' : 'standard')).toLowerCase();
                const normalizedShippingMethod = shippingMethod === 'free' ? 'standard' : shippingMethod;
                const shippingLabel = normalizedShippingMethod === 'express' ? 'Express Shipping' : (normalizedShippingMethod === 'pickup' ? 'Store Pickup' : 'Standard Shipping');
                const paymentKey = String(row.dataset.paymentMethodKey || '').toLowerCase();
                const paymentState = getManagedOrderPaymentState({
                    pickupOnly: isPickup,
                    total: total,
                    depositAmount: depositValue,
                    balanceDue: balanceValue,
                    status: status
                }, status);
                const paidAmount = cfg.paid != null && row.children[cfg.paid]
                    ? row.children[cfg.paid].textContent.trim()
                    : paymentState.paidAmountText;
                const outstandingAmount = cfg.outstanding != null && row.children[cfg.outstanding]
                    ? row.children[cfg.outstanding].textContent.trim()
                    : paymentState.outstandingAmountText;
                const details = [
                    { label: 'Order ID', value: orderId },
                    { label: 'Customer Name', value: customer },
                    { label: 'Placed By', value: row.dataset.customerName || customer },
                    { label: 'Products', value: product },
                    { label: 'Total Amount', value: total },
                    { label: 'Paid Amount', value: paidAmount },
                    { label: 'Amount Left to Pay', value: outstandingAmount },
                    { label: 'Payment Method', value: paidLabel },
                    { label: 'Receipt', html: receiptImage ? '<a href="' + receiptImage + '" target="_blank" rel="noopener">View Uploaded Receipt</a>' : '<strong>Not uploaded</strong>' },
                    { label: 'Shipping Method', value: shipping || shippingLabel },
                    { label: 'Pickup Config', value: pickupConfig },
                    { label: 'Order Date', value: orderDate },
                    { label: 'Status', value: status },
                    { label: 'Order Type', value: isPickup ? 'Pickup Order' : 'Delivery Order' },
                    { label: 'High-value Alert', value: isHighValue ? 'Required' : 'Standard' },
                    { label: 'Consultation Link', value: product.toLowerCase().indexOf('consultation') !== -1 ? 'Linked' : 'Not linked' },
                    { label: 'Custom Jewellery', value: product.toLowerCase().indexOf('custom') !== -1 ? 'Yes' : 'No' }
                ];
                if (cfg.extraLabel && cfg.extraValueIndex != null && row.children[cfg.extraValueIndex]) {
                    details.push({ label: cfg.extraLabel, value: row.children[cfg.extraValueIndex].textContent.trim() });
                }
                return {
                    orderId: orderId,
                    dbId: row.dataset.orderDbId || '',
                    customer: customer,
                    product: product,
                    total: total,
                    paidAmount: paidAmount,
                    outstandingAmount: outstandingAmount,
                    payment: payment,
                    paymentKey: paymentKey,
                    receiptImage: receiptImage,
                    shippingMethod: normalizedShippingMethod,
                    orderDate: orderDate,
                    status: status,
                    pickupOnly: isPickup,
                    depositAmount: paymentState.depositAmountValue,
                    balanceDue: paymentState.balanceDueValue,
                    pickupConfig: pickupConfig,
                    placedBy: row.dataset.placedBy || customer,
                    initials: customerInitials,
                    details: details
                };
            }

            function downloadTextFile(fileName, content, mimeType) {
                const blob = new Blob([content], { type: mimeType || 'text/plain;charset=utf-8;' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = fileName;
                link.click();
                URL.revokeObjectURL(url);
            }

            function parseRsAmount(value) {
                return parseFloat(String(value || '').replace(/[^0-9.]/g, '')) || 0;
            }

            function downloadReferenceImage(fileName) {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                if (!ctx) return;
                canvas.width = 900;
                canvas.height = 620;
                ctx.fillStyle = '#fbf5ec';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.fillStyle = '#b98945';
                ctx.fillRect(40, 40, canvas.width - 80, 12);
                ctx.fillStyle = '#fff';
                ctx.fillRect(60, 90, canvas.width - 120, canvas.height - 150);
                ctx.strokeStyle = '#ead9c1';
                ctx.lineWidth = 3;
                ctx.strokeRect(60, 90, canvas.width - 120, canvas.height - 150);
                ctx.fillStyle = '#2e241a';
                ctx.font = '700 34px Arial';
                ctx.fillText('Custom Reference Image', 110, 180);
                ctx.fillStyle = '#75624f';
                ctx.font = '500 26px Arial';
                ctx.fillText(fileName, 110, 245);
                ctx.fillText('Downloaded from Custom Jewellery module', 110, 300);
                ctx.fillText('Preview asset placeholder for admin workflow', 110, 355);
                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = fileName.replace(/\.[^.]+$/, '') + '.png';
                link.click();
            }

            function buildOrderActionsHtml(type) {
                return '<div class="actions-inline"><button class="mini-btn" type="button">View Details</button></div>';
            }

            function getReportSectionConfig(pageId) {
                const config = {
                    'reports-sales-page': { section: 'sales', fromIndex: 0, toIndex: 1, filterIndex: 2, typeKey: 'category' },
                    'reports-orders-page': { section: 'orders', fromIndex: 0, toIndex: 1, filterIndex: 2, typeKey: 'status' },
                    'reports-products-page': { section: 'products', fromIndex: 0, toIndex: 1, filterIndex: 2, typeKey: 'product_type' },
                    'reports-inventory-page': { section: 'inventory', fromIndex: 0, toIndex: 1, filterIndex: 2, typeKey: 'stock_status' },
                    'reports-customers-page': { section: 'customers', fromIndex: 0, toIndex: 1, filterIndex: 2, typeKey: 'customer_type' },
                    'reports-consultation-page': { section: 'consultations', fromIndex: 0, toIndex: null, filterIndex: 2, typeKey: 'consultation_type' },
                    'reports-custom-jewellery-page': { section: 'custom-jewellery', fromIndex: 0, toIndex: 1, filterIndex: 2, typeKey: 'request_status' },
                    'reports-revenue-page': { section: 'revenue', fromIndex: 0, toIndex: 1, filterIndex: 2, typeKey: 'revenue_type' },
                };

                return config[pageId] || null;
            }

            function getReportFilterValue(page, index) {
                if (!page || index === null || index === undefined) return '';
                const field = page.querySelector('.filter-row [data-filter-index="' + index + '"]');
                if (!field) return '';
                const value = String(field.value || '').trim();
                if (!value || value.toLowerCase().indexOf('all ') === 0 || value.toLowerCase() === 'all') {
                    return '';
                }
                return value;
            }

            function getReportPdfTitle(sectionKey, fallbackTitle) {
                const titles = {
                    sales: 'Sales Report',
                    orders: 'Order Report',
                    products: 'Product Report',
                    inventory: 'Inventory Report',
                    customers: 'Customer Report',
                    consultations: 'Consultation Report',
                    'custom-jewellery': 'Custom Jewellery Report',
                    revenue: 'Revenue Report',
                };
                if (sectionKey && titles[sectionKey]) {
                    return titles[sectionKey];
                }
                const cleaned = String(fallbackTitle || 'Report').trim();
                return cleaned.replace(/\bReports\b/i, 'Report');
            }

            function buildReportQuery(page) {
                const config = getReportSectionConfig(page ? page.id : '');
                if (!config) return '';
                const params = new URLSearchParams();
                const fromDate = getReportFilterValue(page, config.fromIndex);
                const toDate = getReportFilterValue(page, config.toIndex);
                const filterValue = getReportFilterValue(page, config.filterIndex);

                if (fromDate) params.set('from_date', fromDate);
                if (toDate) params.set('to_date', toDate);
                if (filterValue) params.set(config.typeKey, filterValue);

                return params.toString();
            }

            function buildReportExportUrl(page, format) {
                const config = getReportSectionConfig(page ? page.id : '');
                if (!config) return '';
                const query = new URLSearchParams(buildReportQuery(page));
                if (format) {
                    query.set('format', format);
                }
                const finalQuery = query.toString();
                return adminReportExportBase + '/' + encodeURIComponent(config.section) + (finalQuery ? '?' + finalQuery : '');
            }

            function getVisibleReportRows(table) {
                if (!table) return [];
                return Array.from(table.querySelectorAll('tbody tr')).filter(function (row) {
                    return row.style.display !== 'none' && !row.dataset.emptyContact;
                });
            }

            function getOrdersTableBody(pageId) {
                return document.querySelector('#' + pageId + ' table tbody');
            }

            function getOrderTargetPageId(status) {
                const lower = String(status || '').toLowerCase();
                if (lower === 'out for delivery') return 'orders-delivery-page';
                if (lower === 'ready to pickup' || lower === 'ready for pickup' || lower === 'pickup' || lower === 'out for pickup') return 'orders-pickup-page';
                return '';
            }

            function getManagedOrderPaymentState(order, status) {
                const effectiveStatus = String(status || order.status || '').toLowerCase();
                const isPickup = !!order.pickupOnly;
                const isPickupCompleted = isPickup && (effectiveStatus === 'completed' || effectiveStatus === 'pickup completed');
                const totalValue = parseRsAmount(order.total || 0);
                const depositValue = isPickupCompleted
                    ? totalValue
                    : parseRsAmount(order.depositAmount || (isPickup ? order.total : totalValue));
                const balanceValue = isPickupCompleted
                    ? 0
                    : parseRsAmount(order.balanceDue || 0);

                return {
                    depositAmountValue: depositValue,
                    balanceDueValue: balanceValue,
                    paidAmountText: isPickup
                        ? ('Rs ' + depositValue.toLocaleString(undefined, { maximumFractionDigits: 0 }))
                        : (order.total || ('Rs ' + totalValue.toLocaleString(undefined, { maximumFractionDigits: 0 }))),
                    outstandingAmountText: isPickup
                        ? ('Rs ' + balanceValue.toLocaleString(undefined, { maximumFractionDigits: 0 }))
                        : 'Rs 0'
                };
            }

            function buildManagedOrderRow(order, status) {
                const lower = String(status || '').toLowerCase();
                const paymentState = getManagedOrderPaymentState(order, status);
                const isPickupOrder = !!order.pickupOnly || String(order.shippingMethod || '').toLowerCase() === 'pickup';
                const rowAttrs = ' data-order-db-id="' + (order.dbId || '') + '" data-order-id="' + (order.orderId || '') + '" data-order-type="' + (isPickupOrder ? 'pickup' : 'delivery') + '" data-pickup-only="' + (order.pickupOnly ? '1' : '0') + '" data-deposit-amount="' + paymentState.depositAmountValue + '" data-balance-due="' + paymentState.balanceDueValue + '" data-pickup-config="' + (order.pickupConfig || '') + '" data-placed-by="' + (order.placedBy || '') + '" data-total-value="' + (parseRsAmount(order.total) || '') + '" data-payment-method="' + (order.payment || '') + '" data-payment-method-key="' + (order.paymentKey || '').toLowerCase() + '" data-shipping-method="' + (order.shippingMethod || (isPickupOrder ? 'pickup' : 'standard')) + '" data-search-blob="' + (order.searchBlob || '') + '" data-order-date="' + (order.orderDate || '') + '" data-customer-name="' + (order.customer || '') + '"';
                const paidAmount = paymentState.paidAmountText;
                const outstandingAmount = paymentState.outstandingAmountText;
                if (lower === 'ready to pickup' || lower === 'pickup' || lower === 'out for pickup') {
                    const pickupLabel = lower === 'out for pickup' ? 'Out for Pickup' : 'Ready For Pickup';
                    return '<tr' + rowAttrs + '><td>' + order.orderId + '</td><td>' + order.customer + '</td><td>' + order.product + '</td><td>' + order.total + '</td><td>' + paidAmount + '</td><td>' + outstandingAmount + '</td><td>' + order.payment + '</td><td>' + (order.shippingMethod === 'pickup' ? 'Store Pickup' : 'Standard Shipping') + '</td><td>' + order.orderDate + '</td><td><span class="status pickup">' + pickupLabel + '</span></td><td>' + buildOrderActionsHtml('pickup') + '</td></tr>';
                }
                if (lower === 'cancelled') {
                    return '<tr' + rowAttrs + '><td>' + order.orderId + '</td><td>' + order.customer + '</td><td>' + order.product + '</td><td>' + order.total + '</td><td>' + paidAmount + '</td><td>' + outstandingAmount + '</td><td>Status Change</td><td>' + (order.shippingMethod === 'pickup' ? 'Store Pickup' : 'Standard Shipping') + '</td><td>' + order.orderDate + '</td><td><span class="status bad">Cancelled</span></td><td>' + buildOrderActionsHtml('cancelled') + '</td></tr>';
                }
                if (lower === 'completed' || lower === 'pickup completed') {
                    const completedLabel = lower === 'pickup completed'
                        ? 'Pickup Completed'
                        : ((order.payment.toLowerCase().indexOf('pickup') !== -1 || order.status.toLowerCase().indexOf('pickup') !== -1) ? 'Pickup Completed' : 'Completed');
                    return '<tr' + rowAttrs + '><td>' + order.orderId + '</td><td>' + order.customer + '</td><td>' + order.product + '</td><td>' + order.total + '</td><td>' + paidAmount + '</td><td>' + outstandingAmount + '</td><td>' + order.payment + '</td><td>' + (order.shippingMethod === 'pickup' ? 'Store Pickup' : 'Standard Shipping') + '</td><td>' + order.orderDate + '</td><td><span class="status ok">' + completedLabel + '</span></td><td>' + buildOrderActionsHtml('completed') + '</td></tr>';
                }
                const statusLabel = lower === 'out for delivery'
                    ? 'Out for Delivery'
                    : 'Processing';
                return '<tr' + rowAttrs + '><td>' + order.orderId + '</td><td>' + order.customer + '</td><td>' + order.product + '</td><td>' + order.total + '</td><td>' + paidAmount + '</td><td>' + outstandingAmount + '</td><td>' + order.payment + '</td><td>' + (order.shippingMethod === 'pickup' ? 'Store Pickup' : 'Standard Shipping') + '</td><td>' + order.orderDate + '</td><td><span class="status ' + statusClassFromText(statusLabel) + '">' + statusLabel + '</span></td><td>' + buildOrderActionsHtml('delivery') + '</td></tr>';
            }

            function moveOrderRowToStatus(row, sourcePageId, status) {
                const order = getOrderDetails(sourcePageId, row);
                const paymentState = getManagedOrderPaymentState(order, status);
                order.depositAmount = paymentState.depositAmountValue;
                order.balanceDue = paymentState.balanceDueValue;
                order.paidAmount = paymentState.paidAmountText;
                order.outstandingAmount = paymentState.outstandingAmountText;
                const targetPageId = getOrderTargetPageId(status);
                if (!targetPageId) {
                    row.dataset.depositAmount = String(paymentState.depositAmountValue);
                    row.dataset.balanceDue = String(paymentState.balanceDueValue);
                    row.dataset.orderStatus = status;
                    if (row.children[4]) row.children[4].textContent = paymentState.paidAmountText;
                    if (row.children[5]) row.children[5].textContent = paymentState.outstandingAmountText;
                    if (row.children[8]) row.children[8].innerHTML = '<span class="status ' + statusClassFromText(status) + '">' + status + '</span>';
                    return true;
                }
                const targetBody = getOrdersTableBody(targetPageId);
                if (!targetBody) return false;
                targetBody.insertAdjacentHTML('afterbegin', buildManagedOrderRow(order, status));
                row.remove();
                return true;
            }

            function addCustomDesignToOrders(config) {
                const allOrdersBody = document.querySelector('#orders-all-page table tbody');
                const pickupBody = document.querySelector('#orders-pickup-page table tbody');
                if (!allOrdersBody || !pickupBody) return;

                const amount = parseRsAmount(config.amount);
                const isPickup = amount > 40000;
                const orderId = 'ORD-' + String(24100 + allOrdersBody.querySelectorAll('tr').length + 1);
                const orderDate = '2026-03-30';
                const statusLabel = isPickup ? 'Ready For Pickup' : 'Pending';
                const paidAmount = isPickup ? ('Rs ' + Math.round(amount * 0.2).toLocaleString()) : config.amount;
                const outstandingAmount = isPickup ? ('Rs ' + Math.max(amount - Math.round(amount * 0.2), 0).toLocaleString()) : 'Rs 0';
                const paymentKey = normalizePaymentKey(config.payment);
                const searchBlob = [orderId, config.customer, config.product, config.amount, config.payment, statusLabel, isPickup ? 'pickup' : 'delivery'].join(' ').toLowerCase();
                const shippingLabel = isPickup ? 'Store Pickup' : 'Standard Shipping';
                const allOrdersRow = '<tr data-order-id="' + orderId + '" data-order-type="' + (isPickup ? 'pickup' : 'delivery') + '" data-pickup-only="' + (isPickup ? '1' : '0') + '" data-deposit-amount="' + (isPickup ? Math.round(amount * 0.2) : amount) + '" data-balance-due="' + (isPickup ? Math.max(amount - Math.round(amount * 0.2), 0) : 0) + '" data-pickup-config="' + (isPickup ? 'Store Pickup' : 'Standard Delivery') + '" data-placed-by="' + config.customer + '" data-total-value="' + amount + '" data-payment-method="' + config.payment + '" data-payment-method-key="' + paymentKey + '" data-shipping-method="' + (isPickup ? 'pickup' : 'standard') + '" data-search-blob="' + searchBlob + '" data-order-date="' + orderDate + '" data-customer-name="' + config.customer + '"><td>' + orderId + '</td><td>' + config.customer + '</td><td>' + config.product + '</td><td>' + config.amount + '</td><td>' + paidAmount + '</td><td>' + outstandingAmount + '</td><td>' + config.payment + '</td><td>' + shippingLabel + '</td><td>' + orderDate + '</td><td><span class="status ' + statusClassFromText(statusLabel) + '">' + statusLabel + '</span></td><td><div class="actions-inline"><button class="mini-btn" type="button">View Details</button><button class="mini-btn" type="button">' + (isPickup ? 'Change Status' : 'Change Status') + '</button><button class="mini-btn" type="button">' + (isPickup ? 'Cancel Order' : 'Cancel Order') + '</button><button class="mini-btn" type="button">Print Invoice</button></div></td></tr>';
                allOrdersBody.insertAdjacentHTML('afterbegin', allOrdersRow);

                if (isPickup) {
                    const pickupRow = '<tr data-order-id="' + orderId + '" data-order-type="pickup" data-pickup-only="1" data-deposit-amount="' + Math.round(amount * 0.2) + '" data-balance-due="' + Math.max(amount - Math.round(amount * 0.2), 0) + '" data-pickup-config="Pickup Only (Auto)" data-placed-by="' + config.customer + '" data-total-value="' + amount + '" data-payment-method="' + config.payment + '" data-payment-method-key="' + paymentKey + '" data-shipping-method="pickup" data-search-blob="' + searchBlob + '" data-order-date="2026-03-31 11:00" data-customer-name="' + config.customer + '"><td>' + orderId + '</td><td>' + config.customer + '</td><td>' + config.product + '</td><td>' + config.amount + '</td><td>' + paidAmount + '</td><td>' + outstandingAmount + '</td><td>' + config.payment + '</td><td>Store Pickup</td><td>2026-03-31 11:00</td><td><span class="status pickup">Ready For Pickup</span></td><td>' + buildOrderActionsHtml('pickup') + '</td></tr>';
                    pickupBody.insertAdjacentHTML('afterbegin', pickupRow);
                }
            }

            function downloadInvoice(order) {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                if (!ctx) return;

                const width = 1200;
                const height = 1600;
                canvas.width = width;
                canvas.height = height;

                const lines = [
                    { text: 'Pinwantha Gems & Jewellery Invoice', size: 46, weight: '700', color: '#2e241a' },
                    { text: 'Professional order invoice', size: 22, weight: '400', color: '#75624f' },
                    { text: 'Invoice No: ' + order.orderId, size: 28, weight: '600', color: '#2e241a' },
                    { text: 'Customer: ' + order.customer, size: 28, weight: '600', color: '#2e241a' },
                    { text: 'Order Date: ' + order.orderDate, size: 26, weight: '500', color: '#2e241a' },
                    { text: 'Status: ' + order.status, size: 26, weight: '500', color: '#2e241a' },
                    { text: 'Payment Method: ' + order.payment, size: 26, weight: '500', color: '#2e241a' },
                    { text: 'Product Details', size: 32, weight: '700', color: '#2e241a' },
                    { text: 'Product: ' + order.product, size: 26, weight: '500', color: '#2e241a' },
                    { text: 'Order Type: ' + (order.status.toLowerCase().indexOf('pickup') !== -1 ? 'Pickup' : 'Standard'), size: 26, weight: '500', color: '#2e241a' },
                    { text: 'Total Amount: ' + order.total, size: 30, weight: '700', color: '#94652c' },
                    { text: 'Thank you for choosing Pinwantha Gems & Jewellery.', size: 24, weight: '500', color: '#75624f' }
                ];

                ctx.fillStyle = '#fbf5ec';
                ctx.fillRect(0, 0, width, height);

                ctx.fillStyle = '#b98945';
                ctx.fillRect(70, 70, width - 140, 14);
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(70, 110, width - 140, height - 180);
                ctx.strokeStyle = '#ead9c1';
                ctx.lineWidth = 4;
                ctx.strokeRect(70, 110, width - 140, height - 180);

                function drawLine(text, x, y, size, weight, color) {
                    ctx.fillStyle = color;
                    ctx.font = weight + ' ' + size + 'px Arial';
                    ctx.fillText(text, x, y);
                }

                function drawValueRow(label, value, x, y, labelSize, valueSize) {
                    drawLine(label, x, y, labelSize, '700', '#75624f');
                    drawLine(value, x, y + 34, valueSize, '700', '#2e241a');
                }

                drawLine(lines[0].text, 130, 180, lines[0].size, lines[0].weight, lines[0].color);
                drawLine(lines[1].text, 130, 250, lines[1].size, lines[1].weight, lines[1].color);

                drawValueRow('Invoice No', order.orderId, 130, 345, 24, 28);
                drawValueRow('Customer', order.customer, 130, 420, 24, 28);
                drawValueRow('Order Date', order.orderDate, 130, 495, 22, 26);
                drawValueRow('Status', order.status, 130, 570, 22, 26);
                drawValueRow('Payment Method', order.payment, 130, 645, 22, 26);

                drawLine('Product Details', 130, 740, 32, '700', '#2e241a');
                drawLine('Product: ' + order.product, 130, 792, 26, '500', '#2e241a');
                drawLine('Order Type: ' + (order.status.toLowerCase().indexOf('pickup') !== -1 ? 'Pickup' : 'Standard'), 130, 834, 26, '500', '#2e241a');
                drawLine('Total Amount: ' + order.total, 130, 900, 30, '700', '#94652c');
                drawLine('Thank you for choosing Pinwantha Gems & Jewellery.', 130, 980, 24, '500', '#75624f');
                ctx.strokeStyle = '#b98945';
                ctx.lineWidth = 3;
                ctx.beginPath();
                ctx.moveTo(120, 935);
                ctx.lineTo(width - 120, 935);
                ctx.stroke();

                ctx.fillStyle = '#75624f';
                ctx.font = '500 22px Arial';
                ctx.fillText('Generated from admin order panel', 130, 1035);

                const link = document.createElement('a');
                link.href = canvas.toDataURL('image/png');
                link.download = order.orderId + '-invoice.png';
                link.click();
            }

            function openReportPreview(page, table) {
                if (!page || !table) return;
                const title = page.querySelector('.module-head h2') ? page.querySelector('.module-head h2').textContent.trim() : 'Report';
                const firstRow = getVisibleReportRows(table)[0] || table.querySelector('tbody tr');
                const previewRows = [];
                if (firstRow) {
                    Array.from(firstRow.children).slice(0, Math.min(firstRow.children.length, 6)).forEach(function (cell, index) {
                        const header = table.querySelectorAll('thead th')[index];
                        previewRows.push({ label: header ? header.textContent.trim() : 'Column ' + (index + 1), value: cell.textContent.trim() });
                    });
                }
                openViewModal(title + ' Preview', previewRows.length ? previewRows : [{ label: 'Status', value: 'No report data available' }], 'RP');
            }

            function downloadReportPdf(page, table) {
                if (!page || !table) return;
                const title = page.querySelector('.module-head h2') ? page.querySelector('.module-head h2').textContent.trim() : 'Report';
                const sectionConfig = getReportSectionConfig(page.id);
                const headers = Array.from(table.querySelectorAll('thead th')).slice(0, 6).map(function (header) {
                    return header.textContent.trim();
                });
                const rows = getVisibleReportRows(table).slice(0, 80).map(function (row) {
                    return Array.from(row.children).slice(0, 6).map(function (cell) {
                        return cell.textContent.trim();
                    });
                });
                const fromDate = getReportFilterValue(page, sectionConfig ? sectionConfig.fromIndex : null);
                const toDate = getReportFilterValue(page, sectionConfig ? sectionConfig.toIndex : null);
                const activeFilter = getReportFilterValue(page, sectionConfig ? sectionConfig.filterIndex : null);

                function escapePdfText(text) {
                    return String(text || '').replace(/\\/g, '\\\\').replace(/\(/g, '\\(').replace(/\)/g, '\\)');
                }

                function pdfTextLength(value) {
                    return String(value || '').length;
                }

                function truncatePdfText(value, maxChars) {
                    const text = String(value || '').replace(/\s+/g, ' ').trim();
                    if (text.length <= maxChars) return text;
                    if (maxChars < 4) return text.slice(0, Math.max(0, maxChars));
                    return text.slice(0, maxChars - 3).trimEnd() + '...';
                }

                function columnWidths(headersRow, dataRows, availableWidth, sectionKey) {
                    if (headersRow.length === 6) {
                        const fixedMap = {
                            sales: [92, 92, 180, 112, 112, 132],
                            orders: [92, 92, 194, 105, 105, 130],
                            products: [92, 92, 166, 110, 110, 143],
                            inventory: [92, 92, 168, 108, 108, 143],
                            customers: [92, 92, 172, 105, 110, 140],
                            consultations: [92, 100, 168, 110, 110, 143],
                            'custom-jewellery': [92, 92, 170, 108, 110, 142],
                            revenue: [92, 92, 174, 106, 110, 132],
                        };
                        const fixed = fixedMap[sectionKey] || [95, 95, 180, 120, 120, 176];
                        const total = fixed.reduce(function (sum, width) { return sum + width; }, 0);
                        const scale = total ? (availableWidth / total) : 1;
                        const scaled = fixed.map(function (width) {
                            return Math.max(72, Math.round(width * scale));
                        });
                        const scaledSum = scaled.reduce(function (sum, width) { return sum + width; }, 0);
                        scaled[scaled.length - 1] += (availableWidth - scaledSum);
                        return scaled;
                    }

                    const weights = headersRow.map(function (header, index) {
                        const headerText = String(header || '').toLowerCase();
                        let maxLength = pdfTextLength(header);
                        dataRows.forEach(function (row) {
                            maxLength = Math.max(maxLength, pdfTextLength(row[index] || ''));
                        });

                        let weight = Math.max(10, Math.min(30, maxLength));
                        if (/(date|time)/i.test(headerText)) {
                            weight = Math.max(weight, 14);
                        } else if (/(status|category|type|customer|product|request|consultation|method|name)/i.test(headerText)) {
                            weight = Math.max(weight, 20);
                        } else if (/(total|amount|revenue|sales|orders|count|pickup|cancelled|completed|balance|paid|outstanding|stock|value|price)/i.test(headerText)) {
                            weight = Math.max(weight, 14);
                        } else if (sectionKey === 'orders' && index === 2) {
                            weight = Math.max(weight, 24);
                        } else if (sectionKey === 'sales' && index === 2) {
                            weight = Math.max(weight, 18);
                        } else {
                            weight = Math.max(weight, 12);
                        }

                        return weight;
                    });

                    const totalWeight = weights.reduce(function (sum, weight) { return sum + weight; }, 0) || headersRow.length;
                    const widths = weights.map(function (weight, index) {
                        const headerText = String(headersRow[index] || '').toLowerCase();
                        let minWidth = 86;
                        let maxWidth = 220;

                        if (/(date|time)/i.test(headerText)) {
                            minWidth = 92;
                            maxWidth = 124;
                        } else if (/(status|category|type|customer|product|request|consultation|method|name)/i.test(headerText)) {
                            minWidth = 120;
                            maxWidth = 220;
                        } else if (/(total|amount|revenue|sales|orders|count|pickup|cancelled|completed|balance|paid|outstanding|stock|value|price)/i.test(headerText)) {
                            minWidth = 86;
                            maxWidth = 136;
                        }

                        const rawWidth = Math.round((availableWidth * weight) / totalWeight);
                        return Math.max(minWidth, Math.min(maxWidth, rawWidth));
                    });

                    const widthSum = widths.reduce(function (sum, width) { return sum + width; }, 0);
                    if (widths.length) {
                        widths[widths.length - 1] += (availableWidth - widthSum);
                    }

                    return widths;
                }

                const pageWidth = 842;
                const pageHeight = 595;
                const marginX = 28;
                const topBandHeight = 70;
                const headerBlockHeight = 76;
                const tableTopY = 382;
                const rowHeight = 21;
                const availableWidth = 786;
                const maxRowsPerPage = 13;
                const reportTitle = getReportPdfTitle(sectionConfig ? sectionConfig.section : '', title);
                const widths = columnWidths(headers, rows, availableWidth, sectionConfig ? sectionConfig.section : '');
                const rowChunks = rows.length ? rows.reduce(function (chunks, row, index) {
                    const chunkIndex = Math.floor(index / maxRowsPerPage);
                    if (!chunks[chunkIndex]) chunks[chunkIndex] = [];
                    chunks[chunkIndex].push(row);
                    return chunks;
                }, []) : [[]];

                function buildPdfPage(pageRows, pageNumber, pageCount) {
                    const commands = [];
                    commands.push('q');
                    commands.push('1 1 1 rg');
                    commands.push('0 0 ' + pageWidth + ' ' + pageHeight + ' re f');
                    commands.push('0.78 0.61 0.36 rg');
                    commands.push('0 ' + (pageHeight - topBandHeight) + ' ' + pageWidth + ' ' + topBandHeight + ' re f');
                    commands.push('0.97 0.95 0.91 rg');
                    commands.push('0 ' + (pageHeight - 172) + ' ' + pageWidth + ' 102 re f');
                    commands.push('0.17 0.14 0.11 rg');
                    commands.push('BT');
                    commands.push('/F1 26 Tf');
                    commands.push('1 0 0 1 34 ' + (pageHeight - 134) + ' Tm');
                    commands.push('(' + escapePdfText(reportTitle) + ') Tj');
                    commands.push('ET');
                    commands.push('BT');
                    commands.push('/F1 9 Tf');
                    commands.push('0.34 0.25 0.16 rg');
                    commands.push('1 0 0 1 34 ' + (pageHeight - 154) + ' Tm');
                    commands.push('(Pinwantha Gems & Jewellery Admin Report Export) Tj');
                    commands.push('ET');
                    commands.push('BT');
                    commands.push('/F1 9 Tf');
                    commands.push('0.34 0.25 0.16 rg');
                    commands.push('1 0 0 1 34 ' + (pageHeight - 168) + ' Tm');
                    commands.push('(Page ' + pageNumber + ' of ' + pageCount + ') Tj');
                    commands.push('ET');

                    commands.push('0.97 0.95 0.91 rg');
                    commands.push('0 ' + (pageHeight - headerBlockHeight) + ' ' + pageWidth + ' ' + headerBlockHeight + ' re f');
                    commands.push('0.91 0.85 0.76 RG');
                    commands.push('0.91 0.85 0.76 rg');
                    commands.push('0 ' + (pageHeight - headerBlockHeight) + ' ' + pageWidth + ' ' + headerBlockHeight + ' re S');

                    const filterText = [
                        fromDate ? 'From: ' + fromDate : 'From: All dates',
                        toDate ? 'To: ' + toDate : 'To: All dates',
                        activeFilter ? 'Filter: ' + activeFilter : null
                    ].filter(Boolean).join(' | ');

                    commands.push('BT');
                    commands.push('/F1 10 Tf');
                    commands.push('0.34 0.25 0.16 rg');
                    commands.push('1 0 0 1 ' + marginX + ' ' + (pageHeight - 100) + ' Tm');
                    commands.push('(' + escapePdfText(filterText) + ') Tj');
                    commands.push('ET');

                    const xPositions = [marginX];
                    widths.forEach(function (width, index) {
                        xPositions[index + 1] = xPositions[index] + width;
                    });

                    const headerY = tableTopY;
                    commands.push('0.86 0.67 0.35 rg');
                    commands.push(marginX + ' ' + headerY + ' ' + availableWidth + ' 24 re f');
                    commands.push('0.82 0.64 0.34 RG');
                    commands.push(marginX + ' ' + headerY + ' ' + availableWidth + ' 24 re S');
                    commands.push('BT');
                    commands.push('/F1 8 Tf');
                    commands.push('1 1 1 rg');
                    headers.forEach(function (header, index) {
                        const cellX = xPositions[index] + 6;
                        const cellWidth = widths[index] - 12;
                        const maxChars = Math.max(8, Math.floor(cellWidth / 4.2));
                        commands.push('1 0 0 1 ' + cellX + ' ' + (headerY + 8) + ' Tm');
                        commands.push('(' + escapePdfText(truncatePdfText(header, maxChars)) + ') Tj');
                    });
                    commands.push('ET');

                    const startY = headerY - rowHeight;
                    pageRows.forEach(function (row, rowIndex) {
                        const rowY = startY - (rowIndex * rowHeight);
                        const fill = rowIndex % 2 === 0 ? '0.99 0.97 0.94 rg' : '1 1 1 rg';
                        commands.push(fill);
                        commands.push(marginX + ' ' + rowY + ' ' + availableWidth + ' ' + rowHeight + ' re f');
                        commands.push('0.92 0.87 0.79 RG');
                        commands.push(marginX + ' ' + rowY + ' ' + availableWidth + ' ' + rowHeight + ' re S');
                        commands.push('0.19 0.16 0.12 rg');
                        commands.push('BT');
                        commands.push('/F1 8 Tf');

                        headers.forEach(function (header, index) {
                            const cellWidth = widths[index] - 10;
                            const maxChars = Math.max(8, Math.floor(cellWidth / 4.3));
                            const value = truncatePdfText(row[index] || '', maxChars);
                            const cellX = xPositions[index] + 5;
                            commands.push('1 0 0 1 ' + cellX + ' ' + (rowY + 7) + ' Tm');
                            commands.push('(' + escapePdfText(value) + ') Tj');
                        });
                        commands.push('ET');
                    });

                    if (!pageRows.length) {
                        commands.push('BT');
                        commands.push('/F1 10 Tf');
                        commands.push('0.34 0.25 0.16 rg');
                        commands.push('1 0 0 1 350 ' + (headerY - 36) + ' Tm');
                        commands.push('(No report data available) Tj');
                        commands.push('ET');
                    }

                    commands.push('Q');
                    return commands.join('\n');
                }

                const pageCount = Math.max(1, rowChunks.length);
                const pages = rowChunks.map(function (chunk, index) {
                    return buildPdfPage(chunk, index + 1, pageCount);
                });

                if (!pages.length) {
                    pages.push(buildPdfPage([], 1, 1));
                }

                const objects = [
                    '<< /Type /Catalog /Pages 2 0 R >>',
                    '<< /Type /Pages /Kids [] /Count 0 >>'
                ];
                const kids = [];
                const basePageObjectId = 3;
                const fontObjectId = 3 + (pages.length * 2);

                pages.forEach(function (content, index) {
                    const pageObjectId = basePageObjectId + (index * 2);
                    const contentObjectId = pageObjectId + 1;
                    kids.push(pageObjectId + ' 0 R');
                    objects.push('<< /Type /Page /Parent 2 0 R /MediaBox [0 0 842 595] /Resources << /Font << /F1 ' + fontObjectId + ' 0 R >> >> /Contents ' + contentObjectId + ' 0 R >>');
                    objects.push('<< /Length ' + content.length + ' >> stream\n' + content + '\nendstream');
                });

                objects[1] = '<< /Type /Pages /Kids [' + kids.join(' ') + '] /Count ' + pages.length + ' >>';
                objects.push('<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>');

                let pdf = '%PDF-1.4\n';
                const offsets = [0];
                objects.forEach(function (object, index) {
                    offsets.push(pdf.length);
                    pdf += (index + 1) + ' 0 obj\n' + object + '\nendobj\n';
                });
                const xrefPos = pdf.length;
                pdf += 'xref\n0 ' + (objects.length + 1) + '\n';
                pdf += '0000000000 65535 f \n';
                for (let i = 1; i < offsets.length; i++) {
                    pdf += String(offsets[i]).padStart(10, '0') + ' 00000 n \n';
                }
                pdf += 'trailer\n<< /Size ' + (objects.length + 1) + ' /Root 1 0 R >>\nstartxref\n' + xrefPos + '\n%%EOF';

                const blob = new Blob([pdf], { type: 'application/pdf' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = title.toLowerCase().replace(/[^a-z0-9]+/g, '-') + '-report.pdf';
                link.click();
                URL.revokeObjectURL(url);
            }

            function closePermissionModal() {
                if (!permissionModal) return;
                permissionModal.classList.remove('open');
                activePermissionRow = null;
            }
            window.closePermissionModal = closePermissionModal;

            function openPermissionModal(row) {
                if (!permissionModal || !permissionModalGrid || !permissionModalTitle) return;
                activePermissionRow = row;
                const roleName = row.children[0] ? row.children[0].textContent.trim() : 'Role';
                permissionModalTitle.textContent = 'Update Permission Matrix - ' + roleName;
                const selected = (row.dataset.permissions || '').split(',').map(function (p) { return p.trim(); }).filter(Boolean);
                permissionModalGrid.querySelectorAll('input[type="checkbox"]').forEach(function (cb) {
                    cb.checked = selected.indexOf(cb.value) !== -1 || selected.indexOf('All permissions') !== -1;
                });
                permissionModal.classList.add('open');
            }

            function toCsv(table) {
                const rows = Array.from(table.querySelectorAll('tr'));
                return rows.map(function (row) {
                    const cells = Array.from(row.querySelectorAll('th,td')).map(function (cell) {
                        return '"' + cell.textContent.trim().replace(/"/g, '""') + '"';
                    });
                    return cells.join(',');
                }).join('\n');
            }

            function exportTable(table, fileName) {
                const csv = toCsv(table);
                const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
                const url = URL.createObjectURL(blob);
                const link = document.createElement('a');
                link.href = url;
                link.download = fileName;
                link.click();
                URL.revokeObjectURL(url);
                notify('Export completed');
            }

            function getStatusText(row, index) {
                const statusCell = row.children[index];
                return statusCell ? statusCell.textContent.trim().toLowerCase() : '';
            }

            function setStatusBadge(row, index, label) {
                const cell = row.children[index];
                if (!cell) return;
                const badge = cell.querySelector('.status');
                if (!badge) return;
                badge.textContent = label;
                badge.className = 'status';
                if (['active', 'available', 'success', 'completed', 'pickup completed', 'approved', 'refunded', 'verified'].indexOf(label.toLowerCase()) !== -1) badge.classList.add('ok');
                else if (['processing', 'in progress'].indexOf(label.toLowerCase()) !== -1) badge.classList.add('info');
                else if (label.toLowerCase() === 'pickup') badge.classList.add('pickup');
                else if (label.toLowerCase() === 'blocked' || label.toLowerCase() === 'deleted' || label.toLowerCase() === 'deactivated') badge.classList.add('bad');
                else badge.classList.add('warn');
            }

            function getServerUserFilterValue(field) {
                const raw = field && field.value != null ? String(field.value).trim() : '';
                if (!raw || raw.toLowerCase().indexOf('all ') === 0) return '';
                return raw;
            }

            function buildServerUserFilterUrl(pageId) {
                const page = document.getElementById(pageId);
                if (!page) return window.location.href;

                const url = new URL(window.location.href);
                page.querySelectorAll('[data-user-filter-key]').forEach(function (field) {
                    const key = field.dataset.userFilterKey;
                    const value = getServerUserFilterValue(field);
                    if (!key) return;
                    if (value) url.searchParams.set(key, value);
                    else url.searchParams.delete(key);
                });
                url.hash = '#' + pageId;
                return url.toString();
            }

            function navigateWithServerUserFilters(pageId) {
                window.location.href = buildServerUserFilterUrl(pageId);
            }

            function buildServerUserExportUrl(section) {
                const url = new URL(buildServerUserFilterUrl('users-' + section + '-page'));
                const query = url.searchParams.toString();
                return adminUserExportBase + '/' + section + (query ? '?' + query : '');
            }

            function clearServerUserFilters(pageId) {
                const page = document.getElementById(pageId);
                if (!page) return;
                const url = new URL(window.location.href);
                page.querySelectorAll('[data-user-filter-key]').forEach(function (field) {
                    const key = field.dataset.userFilterKey;
                    if (key) url.searchParams.delete(key);
                });
                url.hash = '#' + pageId;
                window.location.href = url.toString();
            }

            function attachServerUserFilters(pageId, options) {
                const page = document.getElementById(pageId);
                if (!page) return;

                const textFields = Array.from(page.querySelectorAll('input[data-user-filter-key][type="text"]'));
                const filterSubmit = page.querySelector('[data-user-filter-submit]');
                const exportButton = page.querySelector('[data-user-export]');
                const clearButton = page.querySelector('[data-user-filter-clear]');

                textFields.forEach(function (field) {
                    field.addEventListener('input', function () {
                        window.clearTimeout(userFilterTimers[pageId]);
                        userFilterTimers[pageId] = window.setTimeout(function () {
                            navigateWithServerUserFilters(pageId);
                        }, 350);
                    });
                });

                page.querySelectorAll('input[data-user-filter-key]:not([type="text"]), select[data-user-filter-key]').forEach(function (field) {
                    field.addEventListener('change', function () {
                        navigateWithServerUserFilters(pageId);
                    });
                });

                if (filterSubmit) {
                    filterSubmit.addEventListener('click', function () {
                        navigateWithServerUserFilters(pageId);
                    });
                }

                if (exportButton && options && options.exportSection) {
                    exportButton.addEventListener('click', function () {
                        window.location.href = buildServerUserExportUrl(options.exportSection);
                    });
                }

                if (clearButton) {
                    clearButton.addEventListener('click', function () {
                        clearServerUserFilters(pageId);
                    });
                }
            }

            function buildServerProductFilterUrl(pageId) {
                const page = document.getElementById(pageId);
                if (!page) return window.location.href;

                const url = new URL(window.location.href);
                page.querySelectorAll('[data-product-filter-key]').forEach(function (field) {
                    const key = field.dataset.productFilterKey;
                    const value = getServerUserFilterValue(field);
                    if (!key) return;
                    if (value) url.searchParams.set(key, value);
                    else url.searchParams.delete(key);
                });
                url.hash = '#' + pageId;
                return url.toString();
            }

            function navigateWithServerProductFilters(pageId) {
                window.location.href = buildServerProductFilterUrl(pageId);
            }

            function buildServerProductExportUrl(pageId) {
                const url = new URL(buildServerProductFilterUrl(pageId));
                const query = url.searchParams.toString();
                return adminProductExportBase + (query ? '?' + query : '');
            }

            function clearServerProductFilters(pageId) {
                const page = document.getElementById(pageId);
                if (!page) return;
                const url = new URL(window.location.href);
                page.querySelectorAll('[data-product-filter-key]').forEach(function (field) {
                    const key = field.dataset.productFilterKey;
                    if (key) url.searchParams.delete(key);
                });
                url.hash = '#' + pageId;
                window.location.href = url.toString();
            }

            function attachServerProductFilters(pageId) {
                const page = document.getElementById(pageId);
                if (!page) return;

                if (pageId === 'products-all-page') {
                    const table = page.querySelector('table');
                    if (!table) return;
                    const textField = page.querySelector('input[data-product-filter-key="product_search"]');
                    const categorySelect = page.querySelector('select[data-product-filter-key="product_category"]');
                    const minPriceField = page.querySelector('input[data-product-filter-key="product_min_price"]');
                    const maxPriceField = page.querySelector('input[data-product-filter-key="product_max_price"]');
                    const stockSelect = page.querySelector('select[data-product-filter-key="product_stock"]');
                    const submitButton = page.querySelector('[data-product-filter-submit]');
                    const clearButton = page.querySelector('[data-product-filter-clear]');
                    const rows = Array.from(table.querySelectorAll('tbody tr'));

                    function parseMoney(value) {
                        const normalized = String(value || '').replace(/[^0-9.-]/g, '');
                        const parsed = parseFloat(normalized);
                        return Number.isFinite(parsed) ? parsed : null;
                    }

                    function applyFilters() {
                        const query = String(textField ? textField.value : '').trim().toLowerCase();
                        const categoryValue = String(categorySelect ? categorySelect.value : '').trim().toLowerCase();
                        const minPrice = parseMoney(minPriceField ? minPriceField.value : '');
                        const maxPrice = parseMoney(maxPriceField ? maxPriceField.value : '');
                        const stockValue = String(stockSelect ? stockSelect.value : '').trim().toLowerCase();

                        rows.forEach(function (row) {
                            const blob = String(row.dataset.searchBlob || row.textContent || '').toLowerCase();
                            const rowCategory = String(row.children[2] ? row.children[2].textContent : '').trim().toLowerCase();
                            const rowPriceValue = row.dataset.priceValue || (row.children[3] ? row.children[3].textContent : '');
                            const rowPrice = parseMoney(rowPriceValue);
                            const rowStock = parseInt(row.dataset.stockValue || (row.children[5] ? row.children[5].textContent : '0'), 10);
                            const rowStatus = String(row.children[6] ? row.children[6].textContent : '').trim().toLowerCase();

                            let visible = true;
                            if (query && !blob.includes(query)) visible = false;
                            if (visible && categoryValue && rowCategory !== categoryValue) visible = false;
                            if (visible && minPrice !== null && (rowPrice === null || rowPrice < minPrice)) visible = false;
                            if (visible && maxPrice !== null && (rowPrice === null || rowPrice > maxPrice)) visible = false;
                            if (visible && stockValue) {
                                if (stockValue === 'in') {
                                    visible = Number.isFinite(rowStock) && rowStock > 0;
                                } else if (stockValue === 'low') {
                                    visible = Number.isFinite(rowStock) && rowStock >= 5 && rowStock <= 15;
                                } else if (stockValue === 'critical') {
                                    visible = Number.isFinite(rowStock) && rowStock >= 1 && rowStock <= 4;
                                } else if (stockValue === 'out') {
                                    visible = Number.isFinite(rowStock) && rowStock === 0;
                                } else {
                                    visible = rowStatus.indexOf(stockValue) !== -1;
                                }
                            }

                            row.style.display = visible ? '' : 'none';
                        });
                    }

                    if (textField) textField.addEventListener('input', applyFilters);
                    if (categorySelect) categorySelect.addEventListener('change', applyFilters);
                    if (minPriceField) minPriceField.addEventListener('input', applyFilters);
                    if (maxPriceField) maxPriceField.addEventListener('input', applyFilters);
                    if (stockSelect) stockSelect.addEventListener('change', applyFilters);
                    if (submitButton) {
                        submitButton.addEventListener('click', function (event) {
                            event.preventDefault();
                            applyFilters();
                        });
                    }
                    if (clearButton) {
                        clearButton.addEventListener('click', function (event) {
                            event.preventDefault();
                            if (textField) textField.value = '';
                            if (categorySelect) categorySelect.value = '';
                            if (minPriceField) minPriceField.value = '';
                            if (maxPriceField) maxPriceField.value = '';
                            if (stockSelect) stockSelect.value = '';
                            applyFilters();
                        });
                    }

                    applyFilters();
                    return;
                }

                const textFields = Array.from(page.querySelectorAll('input[data-product-filter-key][type="text"], input[data-product-filter-key][type="number"]'));
                const submitButton = page.querySelector('[data-product-filter-submit]');
                const exportButton = page.querySelector('[data-product-export]');
                const clearButton = page.querySelector('[data-product-filter-clear]');

                textFields.forEach(function (field) {
                    field.addEventListener('input', function () {
                        window.clearTimeout(productFilterTimers[pageId]);
                        productFilterTimers[pageId] = window.setTimeout(function () {
                            navigateWithServerProductFilters(pageId);
                        }, 350);
                    });
                });

                page.querySelectorAll('select[data-product-filter-key]').forEach(function (field) {
                    field.addEventListener('change', function () {
                        navigateWithServerProductFilters(pageId);
                    });
                });

                if (submitButton) {
                    submitButton.addEventListener('click', function () {
                        navigateWithServerProductFilters(pageId);
                    });
                }

                if (exportButton) {
                    exportButton.addEventListener('click', function () {
                        window.location.href = buildServerProductExportUrl(pageId);
                    });
                }

                if (clearButton) {
                    clearButton.addEventListener('click', function () {
                        clearServerProductFilters(pageId);
                    });
                }
            }

            function attachStockStatusFilter() {
                const page = document.getElementById('inventory-stock-management-page');
                if (!page) return;

                const statusSelect = page.querySelector('[data-stock-status-filter]');
                const table = page.querySelector('table');
                if (!statusSelect || !table) return;

                const rows = Array.from(table.querySelectorAll('tbody tr'));

                function applyFilter() {
                    const selected = String(statusSelect.value || '').trim().toLowerCase();
                    rows.forEach(function (row) {
                        const statusCell = row.children[4];
                        const statusText = String(statusCell ? statusCell.textContent : '').trim().toLowerCase();
                        const visible = !selected || statusText === selected;
                        row.style.display = visible ? '' : 'none';
                    });
                }

                statusSelect.addEventListener('change', applyFilter);
                applyFilter();
            }

            function attachFilters(pageId, cfg) {
                const page = document.getElementById(pageId);
                if (!page) return;
                const table = page.querySelector('table');
                if (!table) return;
                const textInput = page.querySelector('.filter-row input[type="text"]');
                const dateInput = page.querySelector('.filter-row input[type="date"]');
                const select = page.querySelector('.filter-row select');
                const indexedSelects = Array.from(page.querySelectorAll('.filter-row select[data-filter-index]'));
                const indexedDates = Array.from(page.querySelectorAll('.filter-row input[type="date"][data-filter-index]'));
                const paymentSelects = Array.from(page.querySelectorAll('.filter-row select[data-payment-filter]'));
                const shippingSelect = page.querySelector('.filter-row select[data-shipping-filter]');
                const filterBtn = Array.from(page.querySelectorAll('.filter-row .btn')).find(function (btn) { return btn.textContent.trim().toLowerCase() === 'filter'; });

                function applyFilters() {
                    const bodyRows = Array.from(table.querySelectorAll('tbody tr'));
                    const query = textInput ? textInput.value.trim().toLowerCase() : '';
                    const dateValue = dateInput ? dateInput.value : '';
                    bodyRows.forEach(function (row) {
                        const rowText = ((row.dataset.searchBlob || '') + ' ' + row.textContent).toLowerCase();
                        let visible = !query || rowText.indexOf(query) !== -1;

                        if (visible && indexedSelects.length) {
                            visible = indexedSelects.every(function (selectEl) {
                                const selectValue = selectEl.value.trim().toLowerCase();
                                if (!selectValue || selectValue.indexOf('all') === 0) return true;
                                const cellIndex = Number(selectEl.dataset.filterIndex);
                                const targetCell = row.children[cellIndex];
                                const cellText = targetCell ? targetCell.textContent.toLowerCase() : '';
                                return cellText.indexOf(selectValue) !== -1 || getStatusText(row, cellIndex).indexOf(selectValue) !== -1;
                            });
                        } else if (visible && cfg.selectIndex != null && select) {
                            const selectValue = select.value.trim().toLowerCase();
                            if (selectValue.indexOf('all') === 0) {
                                visible = true;
                            } else {
                            const targetCell = row.children[cfg.selectIndex];
                            const cellText = targetCell ? targetCell.textContent.toLowerCase() : '';
                            visible = cellText.indexOf(selectValue) !== -1 || getStatusText(row, cfg.selectIndex).indexOf(selectValue) !== -1;
                            }
                        }

                        if (visible && paymentSelects.length) {
                            visible = paymentSelects.every(function (selectEl) {
                                const paymentValue = normalizePaymentKey(selectEl.value);
                                if (!paymentValue) return true;
                                const rowPaymentKey = normalizePaymentKey(row.dataset.paymentMethodKey || row.dataset.paymentMethod || row.children[6]?.textContent || '');
                                return rowPaymentKey === paymentValue;
                            });
                        }

                        if (visible && shippingSelect) {
                            const shippingValue = shippingSelect.value.trim().toLowerCase();
                            if (shippingValue) {
                                const rowShipping = String(row.dataset.shippingMethod || '').toLowerCase();
                                visible = rowShipping === shippingValue;
                            }
                        }

                        if (visible && indexedDates.length) {
                            visible = indexedDates.every(function (dateEl) {
                                if (!dateEl.value) return true;
                                const cellIndex = Number(dateEl.dataset.filterIndex);
                                const rowDate = row.children[cellIndex] ? row.children[cellIndex].textContent.trim().slice(0, 10) : '';
                                return rowDate === dateEl.value;
                            });
                        } else if (visible && cfg.dateIndex != null && dateInput && dateValue) {
                            const rowDate = row.children[cfg.dateIndex] ? row.children[cfg.dateIndex].textContent.trim().slice(0, 10) : '';
                            visible = rowDate === dateValue;
                        }

                        row.style.display = visible ? '' : 'none';
                    });
                }

                if (textInput) textInput.addEventListener('input', applyFilters);
                if (select) select.addEventListener('change', applyFilters);
                if (dateInput) dateInput.addEventListener('change', applyFilters);
                paymentSelects.forEach(function (selectEl) { selectEl.addEventListener('change', applyFilters); });
                if (shippingSelect) shippingSelect.addEventListener('change', applyFilters);
                indexedSelects.forEach(function (selectEl) { selectEl.addEventListener('change', applyFilters); });
                indexedDates.forEach(function (dateEl) { dateEl.addEventListener('change', applyFilters); });
                if (filterBtn) filterBtn.addEventListener('click', applyFilters);
            }

            attachFilters('orders-all-page', { selectIndex: 9, dateIndex: 8 });
            attachFilters('orders-delivery-page', { selectIndex: 9, dateIndex: 8 });
            attachFilters('orders-pickup-page', { selectIndex: 9, dateIndex: 8 });
            attachFilters('orders-returns-page', { selectIndex: 5 });
            attachFilters('custom-requests-page', { selectIndex: 8, dateIndex: 7 });
            attachFilters('custom-pending-page', { selectIndex: null, dateIndex: 7 });
            attachFilters('custom-quotations-page', { selectIndex: 5 });
            attachFilters('custom-paid-page', { selectIndex: null, dateIndex: 5 });
            attachFilters('consultation-requests-page', { selectIndex: 5, dateIndex: 4 });
            attachFilters('consultation-pending-page', { selectIndex: null, dateIndex: 4 });
            attachFilters('appointments-page', { selectIndex: 6, dateIndex: 3 });
            attachFilters('consultation-chat-page', { selectIndex: null });
            attachFilters('consultation-history-page', { selectIndex: 5, dateIndex: 4 });
            attachFilters('reports-sales-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('reports-orders-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('reports-products-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('reports-inventory-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('reports-customers-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('reports-consultation-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('reports-custom-jewellery-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('reports-revenue-page', { selectIndex: 2, dateIndex: 0 });
            attachFilters('notifications-list-page', { selectIndex: null, dateIndex: 5 });
            attachFilters('content-blogs-page', { selectIndex: [4, 7], dateIndex: 6 });
            attachFilters('content-news-page', { selectIndex: [4, 7], dateIndex: 6 });
            attachFilters('content-faq-page', { selectIndex: 3 });
            attachFilters('content-gold-price-page', { selectIndex: [1], dateIndex: 7 });
            attachFilters('contact-messages-page', { selectIndex: 5, dateIndex: 3 });
            attachServerProductFilters('products-all-page');
            attachStockStatusFilter();

            function initProductManagementActions() {
                const page = document.getElementById('products-all-page');
                if (!page) return;

                function renderProductDetails(product, fallbackTitle) {
                    const categoryName = String(product && (product.category || '')).trim().toLowerCase();
                    const isGemProduct = categoryName === 'gems';
                    const isCollectionProduct = categoryName === 'collections';
                    const sizeLabel = String(product && product.size_label || '').trim();
                    const sizeOptions = Array.isArray(product && product.size_options_list) ? product.size_options_list.join(', ') : String(product && product.size_options || '').trim();
                    const title = (product && product.name) || fallbackTitle || 'Product';
                    const initials = String(title || '').split(' ').map(function (n) { return n.charAt(0); }).join('').slice(0, 2).toUpperCase();
                    const productDetails = [
                        { label: 'Product ID', value: (product && product.product_id) || '-' },
                        { label: 'Category', value: (product && product.category) || '-' },
                        { label: isGemProduct ? 'Gem Type' : (isCollectionProduct ? 'Collection' : 'Jewellery Type'), value: (product && product.gem_type) || '-' },
                    ];

                    if (isGemProduct) {
                        productDetails.push(
                            { label: 'Color', value: (product && product.color) || '-' },
                            { label: 'Shape', value: (product && product.shape) || '-' },
                            { label: 'Carat Weight', value: (product && product.carat_weight) || '-' }
                        );
                    } else if (isCollectionProduct) {
                        productDetails.push(
                            { label: 'Occasion', value: (product && product.collection_occasion) || (product && product.occasion) || '-' },
                            { label: 'Gender', value: (product && product.collection_gender) || (product && product.gender) || '-' },
                            { label: 'Gemstone', value: (product && product.collection_gemstone) || (product && product.gemstone) || '-' },
                            { label: 'Metal', value: (product && product.collection_metal) || (product && product.metal) || '-' }
                        );
                    } else {
                        productDetails.push(
                            { label: 'Metal', value: (product && product.metal) || '-' },
                            { label: 'Pricing Mode', value: (product && product.pricing_mode) || '-' }
                        );
                    }

                    if (sizeLabel || sizeOptions) {
                        productDetails.push(
                            { label: 'Size Label', value: sizeLabel || '-' },
                            { label: 'Available Sizes', value: sizeOptions || '-' }
                        );
                    }

                    productDetails.push(
                        { label: 'Price', value: (product && product.price) || '-' },
                        { label: 'Stock', value: (product && product.stock) || '0' },
                        { label: 'Status', value: (product && product.status) || '-' },
                        { label: 'Description', value: (product && product.description) || '-' },
                        { label: 'Main Image', value: (product && product.main_image) || 'Not set' },
                    );

                    openViewModal('Product Details - ' + title, productDetails, initials);
                }

                function openProductView(row) {
                    const productId = row.dataset.productDbId;
                    const fallbackTitle = row.children[1] ? row.children[1].textContent.trim() : 'Product';
                    const fallbackDetails = {
                        product_id: row.children[0] ? row.children[0].textContent.trim() : '-',
                        name: fallbackTitle,
                        category: row.children[2] ? row.children[2].textContent.trim() : '-',
                        gem_type: row.dataset.gemType || '-',
                        color: row.dataset.color || '-',
                        shape: row.dataset.shape || '-',
                        carat_weight: row.dataset.caratWeight || '-',
                        metal: row.dataset.metal || '-',
                        size_label: row.dataset.sizeLabel || '-',
                        size_options: row.dataset.sizeOptions || '-',
                        price: row.children[3] ? row.children[3].textContent.trim() : '-',
                        pricing_mode: row.children[4] ? row.children[4].textContent.trim() : '-',
                        stock: row.children[5] ? row.children[5].textContent.trim() : '0',
                        status: row.children[6] ? row.children[6].textContent.trim() : '-',
                        description: row.dataset.description || 'Premium quality product with certified authenticity.',
                        main_image: row.dataset.mainImage || 'Not set',
                    };

                    if (!productId) {
                        renderProductDetails(fallbackDetails, fallbackTitle);
                        return;
                    }

                    fetch(adminProductDetailsBase + '/' + productId, {
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    }).then(function (response) {
                        return response.json().then(function (payload) {
                            if (!response.ok) {
                                throw new Error(payload.message || 'Unable to load product details.');
                            }
                            return payload;
                        });
                    }).then(function (payload) {
                        renderProductDetails(payload.product || fallbackDetails, fallbackTitle);
                    }).catch(function () {
                        renderProductDetails(fallbackDetails, fallbackTitle);
                    });
                }

                function openProductEdit(row) {
                    openFormModal({
                        title: 'Edit Product',
                        fields: [
                            { name: 'name', label: 'Product Name', required: true, value: row.children[1].textContent.trim() },
                            { name: 'category', label: 'Product Category', type: 'select', options: productCategorySelectOptions },
                            { name: 'gem_type', label: 'Gem Type', type: 'select', options: ['', ...gemTypeOptions], required: false, value: row.dataset.gemType || '' },
                            { name: 'color', label: 'Color', required: false, value: row.dataset.color || '' },
                            { name: 'shape', label: 'Shape', required: false, value: row.dataset.shape || '' },
                            { name: 'carat_weight', label: 'Carat Weight', type: 'number', required: false, value: row.dataset.caratWeight || '' },
                            { name: 'jewellery_type', label: 'Jewellery Type', type: 'select', options: ['', ...jewelleryTypeOptions], required: false, value: row.dataset.jewelleryType || '' },
                            { name: 'occasion', label: 'Occasion', required: false, value: row.dataset.occasion || '' },
                            { name: 'gender', label: 'Gender', type: 'select', options: ['', 'Men', 'Women', 'Unisex'], required: false, value: row.dataset.gender || '' },
                            { name: 'gemstone', label: 'Gemstone', required: false, value: row.dataset.gemstone || '' },
                            { name: 'metal', label: 'Metal', required: false, value: row.dataset.metal || '' },
                            { name: 'metal_purity', label: 'Metal Purity', required: false, value: row.dataset.metalPurity || '' },
                            { name: 'metal_weight', label: 'Metal Weight (g)', type: 'number', required: false, value: row.dataset.metalWeight || '' },
                            { name: 'making_charge', label: 'Making Charge', type: 'number', required: false, value: row.dataset.makingCharge || '' },
                            { name: 'wastage', label: 'Wastage %', type: 'number', required: false, value: row.dataset.wastage || '' },
                            { name: 'market_factor', label: 'Market Factor', type: 'number', step: '0.01', min: 0, max: 1, required: false, value: row.dataset.marketFactor || '0.80' },
                            { name: 'pricing_mode', label: 'Pricing Mode', type: 'select', options: ['dynamic', 'static'], required: false, value: row.dataset.pricingMode && row.dataset.pricingMode !== '-' ? String(row.dataset.pricingMode).toLowerCase() : 'dynamic' },
                            { name: 'price', label: 'Fallback Price', type: 'number', step: '0.01', min: 0, required: true, value: extractNumericText(row.children[3] ? row.children[3].textContent : '') },
                            { name: 'stock', label: 'Stock', type: 'number', required: true, value: row.children[5].textContent.trim() },
                            { name: 'description', label: 'Description', required: false, value: row.dataset.description || '' },
                            { name: 'main_image', label: 'Replace Main Image', type: 'file', accept: 'image/*', required: false }
                        ],
                        onSubmit: function (data) {
                            const payload = new FormData();
                            payload.append('_token', csrfToken);
                            payload.append('action', 'update');
                            payload.append('product_id', row.dataset.productDbId);
                            payload.append('name', data.name);
                            payload.append('category', data.category);
                            payload.append('gem_type', data.gem_type || '');
                            payload.append('jewellery_type', data.jewellery_type || '');
                            payload.append('occasion', data.occasion || '');
                            payload.append('gender', data.gender || '');
                            payload.append('gemstone', data.gemstone || '');
                            payload.append('color', data.color || '');
                            payload.append('shape', data.shape || '');
                            payload.append('carat_weight', data.carat_weight || '');
                            payload.append('metal', data.metal || '');
                            payload.append('metal_purity', data.metal_purity || '');
                            payload.append('metal_weight', data.metal_weight || '');
                            payload.append('making_charge', data.making_charge || '');
                            payload.append('wastage', data.wastage || '');
                            payload.append('market_factor', data.market_factor || '0.80');
                            payload.append('pricing_mode', data.pricing_mode || 'dynamic');
                            payload.append('price', data.price);
                            payload.append('stock', data.stock);
                            payload.append('description', data.description || '');
                            const mainImageFile = data.main_image instanceof File ? data.main_image : null;
                            if (mainImageFile) payload.append('main_image', mainImageFile);

                            return fetch(adminProductManageRoute, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: payload,
                            }).then(function (response) {
                                return response.json().then(function (payload) {
                                    if (!response.ok) {
                                        throw new Error(payload.message || 'Unable to update product.');
                                    }
                                    return payload;
                                });
                            }).then(function (payload) {
                                const product = payload.product || {};
                                row.children[0].textContent = product.product_id || row.children[0].textContent;
                                row.children[1].textContent = product.name || data.name;
                                row.children[2].textContent = product.category || data.category;
                                row.children[3].textContent = product.price || ('LKR ' + Number(data.price || 0).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                row.children[4].textContent = product.pricing_mode || '-';
                                row.children[5].textContent = product.stock || data.stock;
                                row.children[6].innerHTML = '<span class="status ' + statusClassFromText(product.status || data.status) + '">' + (product.status || data.status) + '</span>';
                                const normalizedCategory = String(data.category || '').trim().toLowerCase();
                                const isGem = normalizedCategory === 'gems';
                                const isCollection = normalizedCategory === 'collections';
                                row.dataset.mainImage = product.main_image || row.dataset.mainImage || '';
                                row.dataset.gemType = isGem ? (data.gem_type || '') : '';
                                row.dataset.jewelleryType = isGem || isCollection ? '' : (data.jewellery_type || '');
                                row.dataset.color = isGem ? (data.color || '') : '';
                                row.dataset.shape = isGem ? (data.shape || '') : '';
                                row.dataset.caratWeight = isGem ? (data.carat_weight || '') : '';
                                row.dataset.metal = isGem ? '' : (isCollection ? (data.metal || '') : (data.metal || ''));
                                row.dataset.metalPurity = isGem || isCollection ? '' : (data.metal_purity || '');
                                row.dataset.occasion = (isGem ? '' : (data.occasion || ''));
                                row.dataset.gender = isGem ? '' : (data.gender || '');
                                row.dataset.gemstone = isGem ? '' : (data.gemstone || '');
                                row.dataset.metalWeight = isGem || isCollection ? '' : (data.metal_weight || '');
                                row.dataset.makingCharge = isGem || isCollection ? '' : (data.making_charge || '');
                                row.dataset.wastage = isGem || isCollection ? '' : (data.wastage || '');
                                row.dataset.marketFactor = isGem || isCollection ? '' : (data.market_factor || '0.80');
                                row.dataset.pricingMode = isGem || isCollection ? (isCollection ? 'Static' : '-') : String(data.pricing_mode || 'dynamic');
                                row.dataset.description = data.description || '';
                                notify(payload.message || 'Product updated');
                            });
                        }
                    });

                    const categorySelect = formModalFields.querySelector('select[name="category"]');
                    const pricingModeSelect = formModalFields.querySelector('select[name="pricing_mode"]');
                    const statusSelect = formModalFields.querySelector('select[name="status"]');
                    if (categorySelect) categorySelect.value = row.children[2].textContent.trim();
                    if (pricingModeSelect) pricingModeSelect.value = row.dataset.pricingMode && row.dataset.pricingMode !== '-' ? String(row.dataset.pricingMode).toLowerCase() : 'dynamic';
                    if (statusSelect) statusSelect.value = row.children[6].textContent.trim();
                    setEditProductVisibility(formModalFields, categorySelect ? categorySelect.value : '');
                    if (categorySelect) {
                        categorySelect.addEventListener('change', function () {
                            setEditProductVisibility(formModalFields, categorySelect.value);
                        });
                    }
                }

                function deleteProduct(row) {
                    openConfirmModal({ title: 'Delete Product', message: 'Are you sure you want to delete this product? This cannot be undone.', confirmLabel: 'Delete' }, function () {
                        fetch(adminProductManageRoute, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                action: 'delete',
                                product_id: row.dataset.productDbId
                            }),
                        }).then(function (response) {
                            return response.json().then(function (payload) {
                                if (!response.ok) {
                                    throw new Error(payload.message || 'Unable to delete product.');
                                }
                                return payload;
                            });
                        }).then(function (payload) {
                            row.remove();
                            notify(payload.message || 'Product deleted successfully');
                        }).catch(function (error) {
                            notify(error.message || 'Unable to delete product');
                        });
                    });
                }

                page.addEventListener('click', function (event) {
                    const button = event.target.closest('button[data-product-action]');
                    if (!button || !page.contains(button)) return;
                    const row = button.closest('tr');
                    if (!row) return;
                    const action = String(button.dataset.productAction || '').trim().toLowerCase();
                    if (!action) return;
                    event.preventDefault();
                    event.stopPropagation();

                    if (action === 'product-view') {
                        openProductView(row);
                        return;
                    }

                    if (action === 'product-edit') {
                        openProductEdit(row);
                        return;
                    }

                    if (action === 'product-delete') {
                        deleteProduct(row);
                    }
                });
            }

            initProductManagementActions();

            function initProductReviewActions() {
                const page = document.getElementById('products-reviews-page');
                if (!page) return;

                function sendReviewDelete(row) {
                    const reviewId = row.dataset.reviewId;
                    if (!reviewId) return;

                    const payload = new FormData();
                    payload.append('review_id', reviewId);
                    payload.append('action', 'delete');

                    return fetch(adminProductReviewDeleteRoute, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: payload,
                    }).then(function (response) {
                        return response.json().then(function (payload) {
                            if (!response.ok) {
                                throw new Error(payload.message || 'Unable to delete review.');
                            }
                            return payload;
                        });
                    }).then(function (payload) {
                        row.remove();
                        notify(payload.message || 'Review deleted');
                    });
                }

                page.addEventListener('click', function (event) {
                    const button = event.target.closest('button[data-review-action]');
                    if (!button || !page.contains(button)) return;
                    const row = button.closest('tr');
                    if (!row) return;
                    const action = String(button.dataset.reviewAction || '').trim().toLowerCase();
                    if (!action) return;
                    event.preventDefault();
                    event.stopPropagation();

                    openConfirmModal({ title: 'Delete Review', message: 'Are you sure you want to delete this review? This cannot be undone.', confirmLabel: 'Delete' }, function () {
                        sendReviewDelete(row).catch(function (error) {
                            notify(error.message || 'Unable to delete review');
                        });
                    });
                });
            }

            initProductReviewActions();

            attachServerUserFilters('users-customers-page', { exportSection: 'customers' });
            attachServerUserFilters('users-consultants-page', { exportSection: 'consultants' });
            attachServerUserFilters('users-admins-page', { exportSection: 'admins' });
            attachServerUserFilters('users-roles-page');
            attachServerUserFilters('users-logs-page', { exportSection: 'logs' });

            function initNotificationForm() {
                const form = document.getElementById('notificationForm');
                const roleSelect = form ? form.querySelector('select[name="recipient_role"]') : null;
                const recipientSearch = document.getElementById('notificationRecipientSearch');
                const recipientSelect = document.getElementById('notificationRecipientSelect');
                const recipientResults = document.getElementById('notificationRecipientResults');
                if (!form || !roleSelect || !recipientSearch || !recipientSelect || !recipientResults) return;
                let activeResultIndex = -1;
                const actionUrlInput = form.querySelector('input[name="action_url"]');

                const baseOptions = Array.from(recipientSelect.querySelectorAll('option')).map(function (option) {
                    return {
                        value: option.value,
                        text: option.textContent.trim(),
                        role: String(option.dataset.recipientRole || '').toLowerCase(),
                        name: String(option.dataset.recipientName || option.textContent || '').toLowerCase(),
                    };
                });

                const renderRecipientSelect = function () {
                    const selectedRole = String(roleSelect.value || '').toLowerCase();
                    const currentValue = String(recipientSelect.value || '');
                    recipientSelect.innerHTML = '';

                    const defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'All users in role';
                    recipientSelect.appendChild(defaultOption);

                    baseOptions.forEach(function (option) {
                        if (!option.value) return;
                        if (selectedRole && option.role !== selectedRole) return;

                        const selectOption = document.createElement('option');
                        selectOption.value = option.value;
                        selectOption.textContent = option.text;
                        selectOption.dataset.recipientRole = option.role;
                        selectOption.dataset.recipientName = option.name;
                        if (String(option.value) === currentValue) {
                            selectOption.selected = true;
                        }
                        recipientSelect.appendChild(selectOption);
                    });

                    if (recipientSelect.options.length === 1) {
                        const emptyOption = document.createElement('option');
                        emptyOption.value = '';
                        emptyOption.textContent = 'No matching users';
                        emptyOption.disabled = true;
                        emptyOption.selected = true;
                        recipientSelect.appendChild(emptyOption);
                    }
                };

                const renderRecipientResults = function () {
                    const searchTerm = recipientSearch.value.trim().toLowerCase();
                    const selectedRole = String(roleSelect.value || '').toLowerCase();
                    const selectedValue = String(recipientSelect.value || '');
                    activeResultIndex = -1;

                    recipientResults.innerHTML = '';

                    if (!searchTerm) {
                        recipientResults.classList.remove('open');
                        return;
                    }

                    const matches = baseOptions.filter(function (option) {
                        if (!option.value) return false;
                        if (selectedRole && option.role !== selectedRole) return false;
                        return option.name.includes(searchTerm) || option.text.toLowerCase().includes(searchTerm);
                    });

                    if (!matches.length) {
                        const empty = document.createElement('div');
                        empty.className = 'recipient-search-empty';
                        empty.textContent = 'No matching users';
                        recipientResults.appendChild(empty);
                        recipientResults.classList.add('open');
                        return;
                    }

                    matches.forEach(function (option) {
                        const button = document.createElement('button');
                        button.type = 'button';
                        button.dataset.value = option.value;
                        if (String(option.value) === selectedValue) {
                            button.classList.add('selected');
                        }
                        const initials = option.text.split(/\s+/).filter(Boolean).map(function (part) {
                            return part.charAt(0);
                        }).join('').slice(0, 2).toUpperCase() || 'U';
                        button.innerHTML = '<span class="recipient-result-top"><span class="recipient-result-badge">' + initials + '</span><span class="recipient-result-text"><span class="name">' + option.text + '</span><span class="meta">' + (option.role ? option.role.charAt(0).toUpperCase() + option.role.slice(1) : 'User') + '</span></span></span>';
                        button.addEventListener('click', function () {
                            recipientSelect.value = option.value;
                            recipientSearch.value = option.text;
                            recipientResults.classList.remove('open');
                        });
                        recipientResults.appendChild(button);
                    });

                    recipientResults.classList.add('open');
                    setActiveRecipientResult(0);
                    updateRecipientResultHighlight();
                };

                const getRecipientResultButtons = function () {
                    return Array.from(recipientResults.querySelectorAll('button[data-value]'));
                };

                const setActiveRecipientResult = function (index) {
                    const buttons = getRecipientResultButtons();
                    if (!buttons.length) {
                        activeResultIndex = -1;
                        return;
                    }
                    activeResultIndex = Math.max(0, Math.min(index, buttons.length - 1));
                    updateRecipientResultHighlight();
                };

                const updateRecipientResultHighlight = function () {
                    const buttons = getRecipientResultButtons();
                    buttons.forEach(function (button, index) {
                        button.classList.toggle('active', index === activeResultIndex);
                    });
                };

                const selectActiveRecipient = function () {
                    const buttons = getRecipientResultButtons();
                    const button = buttons[activeResultIndex];
                    if (!button) return;
                    button.click();
                };

                roleSelect.addEventListener('change', function () {
                    renderRecipientSelect();
                    renderRecipientResults();
                });

                recipientSearch.addEventListener('input', renderRecipientResults);
                recipientSearch.addEventListener('keydown', function (event) {
                    const buttons = getRecipientResultButtons();
                    if (!recipientResults.classList.contains('open') || !buttons.length) return;

                    if (event.key === 'ArrowDown') {
                        event.preventDefault();
                        setActiveRecipientResult(activeResultIndex + 1);
                    } else if (event.key === 'ArrowUp') {
                        event.preventDefault();
                        setActiveRecipientResult(activeResultIndex - 1);
                    } else if (event.key === 'Enter') {
                        event.preventDefault();
                        selectActiveRecipient();
                    } else if (event.key === 'Escape') {
                        event.preventDefault();
                        recipientResults.classList.remove('open');
                    }
                });

                recipientSelect.addEventListener('change', function () {
                    const selectedOption = recipientSelect.options[recipientSelect.selectedIndex];
                    if (selectedOption && selectedOption.value) {
                        recipientSearch.value = selectedOption.textContent.trim();
                    } else {
                        recipientSearch.value = '';
                    }
                    renderRecipientResults();
                });

                document.addEventListener('click', function (event) {
                    if (!recipientResults.contains(event.target) && event.target !== recipientSearch) {
                        if (!recipientSelect.value) return;
                        recipientResults.classList.remove('open');
                    }
                });

                const normalizeActionUrl = function () {
                    if (!actionUrlInput) return;
                    const value = actionUrlInput.value.trim();
                    if (!value) return;
                    actionUrlInput.value = value.replace(/^[a-zA-Z][a-zA-Z0-9+.-]*:\/\//, '').replace(/^\/+/, '');
                };

                const submitActionUrl = function () {
                    if (!actionUrlInput) return;
                    const value = actionUrlInput.value.trim();
                    if (!value) return;
                    if (/^[a-zA-Z][a-zA-Z0-9+.-]*:\/\//.test(value)) {
                        actionUrlInput.value = value;
                        return;
                    }
                    actionUrlInput.value = 'https://' + value.replace(/^\/+/, '');
                };

                if (actionUrlInput) {
                    actionUrlInput.addEventListener('blur', normalizeActionUrl);
                }

                form.addEventListener('submit', function () {
                    submitActionUrl();
                });

                renderRecipientSelect();
                const initialSelectedOption = recipientSelect.options[recipientSelect.selectedIndex];
                if (initialSelectedOption && initialSelectedOption.value) {
                    recipientSearch.value = initialSelectedOption.textContent.trim();
                }
                renderRecipientResults();
            }

            initNotificationForm();

            function initProfileSettingsForms() {
                const profileForm = document.getElementById('profilePageForm');
                const settingsForm = document.getElementById('settingsPageForm');
                const profileImage = document.getElementById('profileImage');
                const profileImageForm = document.getElementById('adminProfileImageForm');
                const profilePreviewBox = document.getElementById('profilePreviewBox');
                const profilePreviewImage = document.getElementById('profilePreviewImage');
                const profileSuccessMessage = document.getElementById('adminProfileSuccessMessage');
                const fullName = document.getElementById('profileFullName');
                const email = document.getElementById('profileEmail');
                const phone = document.getElementById('profilePhone');

                if (profileForm) profileForm.noValidate = true;
                if (settingsForm) settingsForm.noValidate = true;

                if (profileImage && profilePreviewBox && profilePreviewImage) {
                    profileImage.addEventListener('change', function () {
                        const file = profileImage.files && profileImage.files[0];
                        if (!file) {
                            profilePreviewImage.removeAttribute('src');
                            profilePreviewBox.classList.remove('has-image');
                            return;
                        }
                        const objectUrl = URL.createObjectURL(file);
                        profilePreviewImage.src = objectUrl;
                        profilePreviewBox.classList.add('has-image');
                        if (profileImageForm) {
                            profileImageForm.submit();
                        }
                    });
                }

                if (profileForm) {
                    profileForm.addEventListener('submit', function (event) {
                        clearFieldErrors(profileForm);
                        const errors = {};
                        if (!fullName || fullName.value.trim().length < 3) errors.profileFullName = 'Full name must be at least 3 characters';
                        if (!email || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) errors.profileEmail = 'Enter a valid email address';
                        if (!phone || phone.value.trim().replace(/\D/g, '').length < 10) errors.profilePhone = 'Enter a valid phone number';
                        if (Object.keys(errors).length) {
                            event.preventDefault();
                            showFieldErrors(profileForm, errors);
                            if (profileSuccessMessage) profileSuccessMessage.classList.remove('show');
                            notifyValidationErrors(errors);
                            return;
                        }
                    });
                }

                if (settingsForm) {
                    settingsForm.addEventListener('submit', function (event) {
                        event.preventDefault();
                        clearFieldErrors(settingsForm);
                        const currentPassword = document.getElementById('currentPassword');
                        const newPassword = document.getElementById('newPassword');
                        const confirmPassword = document.getElementById('confirmNewPassword');
                        if (!currentPassword || !newPassword || !confirmPassword) return;
                        const errors = {};
                        if (currentPassword.value.trim().length < 8) errors.currentPassword = 'Current password must be at least 8 characters';
                        if (newPassword.value.trim().length < 8) errors.newPassword = 'New password must be at least 8 characters';
                        if (confirmPassword.value.trim().length < 8) errors.confirmNewPassword = 'Confirm password must be at least 8 characters';
                        if (newPassword.value !== confirmPassword.value) errors.confirmNewPassword = 'New passwords do not match';
                        if (Object.keys(errors).length) {
                            showFieldErrors(settingsForm, errors);
                            notifyValidationErrors(errors);
                            return;
                        }
                        settingsForm.submit();
                    });
                }
            }

            initProfileSettingsForms();

            function initAddProductForm() {
                const form = document.getElementById('addProductForm');
                const specificFields = document.getElementById('apSpecificFields');
                const categoryEl = document.getElementById('apCategory');
                if (!form || !specificFields || !categoryEl) return;
                form.noValidate = true;

                function productStatusFromValues(stock, selectedStatus) {
                    if (selectedStatus && selectedStatus !== 'Active') return selectedStatus;
                    if (stock <= 0) return 'Out of Stock';
                    if (stock <= 5) return 'Low';
                    return 'Active';
                }

                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    clearFieldErrors(form);
                    const nameEl = document.getElementById('apName');
                    const categoryEl = document.getElementById('apCategory');
                    const priceEl = document.getElementById('apPrice');
                    const stockEl = document.getElementById('apStock');
                    const descEl = document.getElementById('apDescription');
                    const mainImageEl = document.getElementById('apMainImageFile');
                    const preview360El = document.getElementById('apPreview360Images');
                    if (!nameEl || !categoryEl || !priceEl || !stockEl) return;
                    const errors = {};
                    const isJewellery = String(categoryEl.value || '').trim().toLowerCase() === 'jewellery';
                    if (nameEl.value.trim().length < 3) errors.apName = 'Product name must be at least 3 characters';
                    if (!categoryEl.value.trim()) errors.apCategory = 'Category is required';
                    if (!priceEl.value || parseFloat(priceEl.value || '0') < 0) errors.apPrice = 'Enter a valid fallback price';
                    if (!stockEl.value || parseInt(stockEl.value || '0', 10) < 0) errors.apStock = 'Enter a valid stock quantity';
                    if (descEl && descEl.value.trim().length < 10) errors.apDescription = 'Description must be at least 10 characters';
                    if (isJewellery && preview360El && preview360El.files && preview360El.files.length > 0 && preview360El.files.length !== 8) {
                        errors.apPreview360Images = 'Upload exactly 8 images for the 360 preview.';
                    }
                    if (Object.keys(errors).length) {
                        showFieldErrors(form, errors);
                        notifyValidationErrors(errors);
                        return;
                    }

                    const name = nameEl.value.trim();
                    const category = categoryEl.value;
                    const gemEl = document.getElementById('apGemType');
                    const jewelleryTypeEl = document.getElementById('apJewelleryType');
                    const occasionEl = document.getElementById('apOccasion');
                    const genderEl = document.getElementById('apGender');
                    const gemstoneEl = document.getElementById('apGemstone');
                    const colorEl = document.getElementById('apColor');
                    const shapeEl = document.getElementById('apShape');
                    const caratWeightEl = document.getElementById('apCaratWeight');
                    const metalEl = document.getElementById('apMetal');
                    const metalPurityEl = document.getElementById('apMetalPurity');
                    const metalWeightEl = document.getElementById('apMetalWeight');
                    const makingChargeEl = document.getElementById('apMakingCharge');
                    const wastageEl = document.getElementById('apWastage');
                    const marketFactorEl = document.getElementById('apMarketFactor');
                    const pricingModeEl = document.getElementById('apPricingMode');
                    const sizeLabelEl = document.getElementById('apSizeLabel');
                    const sizeOptionsEl = document.getElementById('apSizeOptions');
                    const gemType = gemEl ? gemEl.value.trim() : '';
                    const jewelleryType = jewelleryTypeEl ? jewelleryTypeEl.value.trim() : '';
                    const occasion = occasionEl ? occasionEl.value.trim() : '';
                    const gender = genderEl ? genderEl.value.trim() : '';
                    const gemstone = gemstoneEl ? gemstoneEl.value.trim() : '';
                    const color = colorEl ? colorEl.value.trim() : '';
                    const shape = shapeEl ? shapeEl.value.trim() : '';
                    const caratWeight = caratWeightEl ? caratWeightEl.value.trim() : '';
                    const metal = metalEl ? metalEl.value.trim() : '';
                    const metalPurity = metalPurityEl ? metalPurityEl.value.trim() : '';
                    const metalWeight = metalWeightEl ? metalWeightEl.value.trim() : '';
                    const makingCharge = makingChargeEl ? makingChargeEl.value.trim() : '';
                    const wastage = wastageEl ? wastageEl.value.trim() : '';
                    const marketFactor = marketFactorEl ? marketFactorEl.value.trim() : '0.80';
                    const pricingMode = pricingModeEl ? pricingModeEl.value : 'dynamic';
                    const sizeLabel = sizeLabelEl ? sizeLabelEl.value.trim() : '';
                    const sizeOptions = sizeOptionsEl ? sizeOptionsEl.value.trim() : '';
                    const price = parseFloat(priceEl.value || '0');
                    const stock = parseInt(stockEl.value || '0', 10);
                    const description = descEl ? descEl.value.trim() : '';
                    const isGemProduct = String(category || '').trim().toLowerCase() === 'gems';
                    const isCollectionProduct = String(category || '').trim().toLowerCase() === 'collections';
                    const formData = new FormData();
                    formData.append('_token', csrfToken);
                    formData.append('action', 'create');
                    formData.append('name', name);
                    formData.append('category', category);
                    if (isGemProduct) {
                        formData.append('gem_type', gemType);
                        formData.append('color', color);
                        formData.append('shape', shape);
                        formData.append('carat_weight', caratWeight);
                    } else if (isCollectionProduct) {
                        formData.append('occasion', occasion);
                        formData.append('gender', gender);
                        formData.append('gemstone', gemstone);
                        formData.append('metal', metal);
                    } else {
                        formData.append('jewellery_type', jewelleryType);
                        formData.append('occasion', occasion);
                        formData.append('gender', gender);
                        formData.append('gemstone', gemstone);
                        formData.append('metal', metal);
                        formData.append('metal_purity', metalPurity);
                        formData.append('metal_weight', metalWeight);
                        formData.append('making_charge', makingCharge);
                        formData.append('wastage', wastage);
                        formData.append('market_factor', marketFactor);
                        formData.append('pricing_mode', pricingMode);
                        formData.append('size_label', sizeLabel);
                        formData.append('size_options', sizeOptions);
                    }
                    formData.append('price', String(price));
                    formData.append('stock', String(stock));
                    formData.append('description', description);
                    if (mainImageEl && mainImageEl.files && mainImageEl.files[0]) {
                        formData.append('main_image', mainImageEl.files[0]);
                    }
                    if (isJewellery && preview360El && preview360El.files && preview360El.files.length) {
                        Array.from(preview360El.files).forEach(function (file) {
                            formData.append('preview_360_images[]', file);
                        });
                    }
                    fetch(adminProductManageRoute, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData
                    }).then(function (response) {
                        return response.json().then(function (payload) {
                            if (!response.ok) {
                                throw new Error(payload.message || 'Unable to create product.');
                            }
                            return payload;
                        });
                    }).then(function (payload) {
                        notify(payload.message || 'Product created successfully');
                        setTimeout(function () {
                            window.location.reload();
                        }, 250);
                    }).catch(function (error) {
                        notify(error.message || 'Unable to create product');
                    });
                });

                categoryEl.addEventListener('change', function () {
                    renderAddProductSpecificFields(specificFields, categoryEl.value);
                });

                form.addEventListener('reset', function () {
                    window.setTimeout(function () {
                        renderAddProductSpecificFields(specificFields, categoryEl.value);
                    }, 0);
                });

                renderAddProductSpecificFields(specificFields, categoryEl.value);
            }

            initAddProductForm();

            function initCategoryManagement() {
                const page = document.getElementById('products-categories-page');
                if (!page) return;
                const addButton = page.querySelector('[data-category-add]');
                const searchInput = page.querySelector('[data-category-search-input]');
                const table = page.querySelector('table');
                const tableBody = table ? table.querySelector('tbody') : null;

                function applyCategorySearch() {
                    if (!tableBody || !searchInput) return;
                    const query = searchInput.value.trim().toLowerCase();
                    Array.from(tableBody.querySelectorAll('tr')).forEach(function (row) {
                        const text = row.textContent.toLowerCase();
                        row.style.display = !query || text.indexOf(query) !== -1 ? '' : 'none';
                    });
                }

                if (searchInput) searchInput.addEventListener('input', applyCategorySearch);

                if (addButton) {
                    addButton.addEventListener('click', function () {
                        openFormModal({
                            title: 'Add Jewellery Type',
                            fields: [
                                { name: 'name', label: 'Jewellery Type Name', required: true, placeholder: 'Rings, Necklaces, Pendants' }
                            ],
                            onSubmit: function (data) {
                                return fetch(adminCategoryManageRoute, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        action: 'create',
                                        name: data.name
                                    })
                                }).then(function (response) {
                                    return response.json().then(function (payload) {
                                        if (!response.ok) {
                                            throw new Error(payload.message || 'Unable to create jewellery type.');
                                        }
                                        return payload;
                                    });
                                }).then(function (payload) {
                                    notify(payload.message || 'Jewellery type created successfully');
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 250);
                                }).catch(function (error) {
                                    notify(error.message || 'Unable to create jewellery type');
                                });
                            }
                        });
                    });
                }
            }

            initCategoryManagement();

            if (formModalForm) {
                formModalForm.addEventListener('submit', function (event) {
                    event.preventDefault();
                    if (!activeFormSubmit) return;
                    const data = {};
                    new FormData(formModalForm).forEach(function (value, key) {
                        if (Object.prototype.hasOwnProperty.call(data, key)) {
                            if (Array.isArray(data[key])) data[key].push(value);
                            else data[key] = [data[key], value];
                        } else {
                            data[key] = value;
                        }
                    });
                    const errors = validateFields(activeFormFieldsConfig, data);
                    if (Object.keys(errors).length) {
                        showFieldErrors(formModalFields, errors);
                        const firstInvalid = formModalFields.querySelector('[aria-invalid="true"]');
                        if (firstInvalid && typeof firstInvalid.focus === 'function') {
                            firstInvalid.focus();
                        }
                        notifyValidationErrors(errors);
                        return;
                    }
                    const result = activeFormSubmit(data);
                    if (result && typeof result.then === 'function') {
                        result.then(function () {
                            closeFormModal();
                        }).catch(function (error) {
                            notify(error && error.message ? error.message : 'Unable to save changes');
                        });
                        return;
                    }
                    closeFormModal();
                });
            }

            if (formModalClose) formModalClose.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                closeFormModal();
            });
            if (formModalCancel) formModalCancel.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                closeFormModal();
            });
            if (formModal) {
                formModal.addEventListener('click', function (event) {
                    if (event.target === formModal) closeFormModal();
                });
            }
            if (viewModalClose) viewModalClose.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                closeViewModal();
            });
            if (viewModalOk) viewModalOk.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                closeViewModal();
            });
            if (viewModal) {
                viewModal.addEventListener('click', function (event) {
                    if (event.target === viewModal) closeViewModal();
                });
            }
            if (confirmModalClose) confirmModalClose.addEventListener('click', closeConfirmModal);
            if (confirmModalCancel) confirmModalCancel.addEventListener('click', closeConfirmModal);
            if (confirmModalOk) {
                confirmModalOk.addEventListener('click', function () {
                    executeConfirmModalAction();
                });
            }
            if (confirmModal) {
                confirmModal.addEventListener('click', function (event) {
                    if (event.target === confirmModal) closeConfirmModal();
                });
            }
            if (tempPasswordCloseBtn) tempPasswordCloseBtn.addEventListener('click', closeTempPasswordAlert);
            if (tempPasswordCopyBtn && tempPasswordValue) {
                tempPasswordCopyBtn.addEventListener('click', async function () {
                    const password = tempPasswordValue.value.trim();
                    if (!password) return;

                    try {
                        if (navigator.clipboard && window.isSecureContext) {
                            await navigator.clipboard.writeText(password);
                        } else {
                            tempPasswordValue.focus();
                            tempPasswordValue.select();
                            document.execCommand('copy');
                        }
                        tempPasswordCopyBtn.textContent = 'Copied';
                        setTimeout(function () {
                            tempPasswordCopyBtn.textContent = 'Copy';
                        }, 1400);
                    } catch (error) {
                        notify('Unable to copy the password');
                    }
                });
            }
            if (tempPasswordAlert) {
                tempPasswordAlert.addEventListener('click', function (event) {
                    if (event.target === tempPasswordAlert) closeTempPasswordAlert();
                });
            }
            if (permissionModalClose) permissionModalClose.addEventListener('click', closePermissionModal);
            if (permissionModalCancel) permissionModalCancel.addEventListener('click', closePermissionModal);
            if (permissionModalSave) {
                permissionModalSave.addEventListener('click', async function () {
                    if (!activePermissionRow || !permissionModalGrid) return;
                    const selected = Array.from(permissionModalGrid.querySelectorAll('input[type="checkbox"]:checked')).map(function (cb) { return cb.value; });
                    const roleKey = activePermissionRow.dataset.role || '';
                    if (!roleKey || roleKey === 'admin') {
                        notify('Admin permissions are fixed');
                        closePermissionModal();
                        return;
                    }

                    try {
                        const response = await fetch(permissionUpdateRoute, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                role: roleKey,
                                permissions: selected,
                            }),
                        });

                        const data = await response.json().catch(() => ({}));
                        if (!response.ok) {
                            throw new Error(data?.message || 'Unable to update permissions.');
                        }

                        activePermissionRow.dataset.permissions = (data.permissions || selected).join(',');
                        const summary = activePermissionRow.querySelector('.perm-summary');
                        if (summary) summary.textContent = (data.permissions || selected).length + ' enabled';
                        const matchingAdminRows = document.querySelectorAll('#users-admins-page tr[data-role-key="' + roleKey + '"]');
                        matchingAdminRows.forEach(function (adminRow) {
                            adminRow.dataset.permissions = (data.permissions || selected).join(',');
                        });
                        const adminRoleRow = document.querySelector('#users-roles-page tr[data-role="' + roleKey + '"]');
                        if (adminRoleRow) {
                            adminRoleRow.dataset.permissions = (data.permissions || selected).join(',');
                            const adminRoleSummary = adminRoleRow.querySelector('.perm-summary');
                            if (adminRoleSummary) adminRoleSummary.textContent = (data.permissions || selected).length + ' enabled';
                        }
                        if (roleKey === currentAdminRole) {
                            syncCurrentAdminAccess(roleKey, data.permissions || selected);
                        }
                        notify('Permission matrix updated');
                        closePermissionModal();
                    } catch (error) {
                        notify(error.message || 'Unable to update permissions');
                    }
                });
            }
            if (permissionModal) {
                permissionModal.addEventListener('click', function (event) {
                    if (event.target === permissionModal) closePermissionModal();
                });
            }

            document.addEventListener('keydown', function (event) {
                if (event.key !== 'Escape') return;
                if (tempPasswordAlert && tempPasswordAlert.classList.contains('open')) {
                    closeTempPasswordAlert();
                    return;
                }
                if (formModal && formModal.classList.contains('open')) {
                    closeFormModal();
                    return;
                }
                if (viewModal && viewModal.classList.contains('open')) {
                    closeViewModal();
                    return;
                }
                if (confirmModal && confirmModal.classList.contains('open')) {
                    closeConfirmModal();
                    return;
                }
                if (permissionModal && permissionModal.classList.contains('open')) {
                    closePermissionModal();
                }
            });

            document.addEventListener('click', function (event) {
                const button = event.target.closest('button');
                if (!button) return;
                if (button.dataset.contentDelete) {
                    const form = button.closest('form[data-content-delete-form]');
                    if (!form) return;
                    event.preventDefault();
                    event.stopPropagation();
                    const row = button.closest('tr');
                    const page = button.closest('.module-page');
                    const contentKind = page && page.id === 'content-blogs-page'
                        ? 'blog post'
                        : (page && page.id === 'content-news-page'
                            ? 'news post'
                            : 'FAQ entry');
                    openConfirmModal({
                        title: 'Delete Content',
                        message: 'Are you sure you want to delete this ' + contentKind + '? This action cannot be undone.',
                        confirmLabel: 'Delete'
                    }, function () {
                        if (typeof form.requestSubmit === 'function') {
                            form.requestSubmit(button);
                        } else {
                            form.submit();
                        }
                        if (row && page && page.id === 'content-faq-page' && !row.dataset.deleteUrl) {
                            row.remove();
                        }
                    });
                    return;
                }
                if (button.dataset.downloadRef) {
                    downloadReferenceImage(button.dataset.downloadRef);
                    notify('Reference image downloaded');
                    return;
                }
                if (button.dataset.rolePermissionsBtn) {
                    const roleRow = button.closest('tr');
                    if (roleRow) openPermissionModal(roleRow);
                    return;
                }
                if (button.dataset.adminRoleBtn) {
                    const adminRow = button.closest('tr');
                    if (adminRow) {
                        button.textContent = 'Role';
                    }
                }
                if (button.dataset.userExport) {
                    window.location.href = buildServerUserExportUrl(button.dataset.userExport);
                    return;
                }
                if (button.dataset.userFilterSubmit) {
                    navigateWithServerUserFilters(page.id);
                    return;
                }
                if (button.dataset.dashboardAction === 'add-customer') {
                    const page = button.closest('.module-page');
                    const table = page ? page.querySelector('table') : null;
                    const tbody = table ? table.querySelector('tbody') : null;
                    if (!tbody) return;
                    openFormModal({
                        title: 'Add Customer',
                        fields: [
                            { name: 'first_name', label: 'First Name', required: true, placeholder: 'Enter first name' },
                            { name: 'last_name', label: 'Last Name', required: true, placeholder: 'Enter last name' },
                            { name: 'email', label: 'Email', type: 'email', required: true, placeholder: 'name@example.com' },
                            { name: 'phone', label: 'Phone', required: true, placeholder: '+94 7X XXX XXXX' },
                            { name: 'birth_date', label: 'Birthday', type: 'date', required: true },
                            { name: 'password', label: 'Password', type: 'password', required: false, placeholder: 'Leave blank to auto-generate' },
                            { name: 'password_confirmation', label: 'Confirm Password', type: 'password', required: false, placeholder: 'Repeat password if entered above' },
                            { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive', 'Blocked'], value: 'Active' }
                        ],
                        onSubmit: function (data) {
                            const firstName = String(data.first_name || '').trim();
                            const lastName = String(data.last_name || '').trim();
                            const displayName = (firstName + ' ' + lastName).trim() || 'Customer';
                            return submitUserManagementAction({
                                action: 'create',
                                scope: 'customer',
                                first_name: firstName,
                                last_name: lastName,
                                email: data.email,
                                phone: data.phone,
                                birth_date: data.birth_date,
                                password: data.password,
                                password_confirmation: data.password_confirmation,
                                status: data.status
                            }).then(function (result) {
                                const user = result.user || {};
                                const id = user.id ? String(user.id) : String(tbody.children.length + 12);
                                const statusClass = data.status === 'Active' ? 'ok' : (data.status === 'Blocked' ? 'bad' : 'warn');
                                tbody.insertAdjacentHTML('beforeend', '<tr data-user-db-id="' + (user.id || '') + '" data-user-id="' + id + '" data-first-name="' + firstName + '" data-last-name="' + lastName + '" data-email="' + data.email + '" data-phone="' + data.phone + '" data-birth-date="' + (data.birth_date || '') + '" data-registration-date="' + (user.created_at ? user.created_at.slice(0, 10) : new Date().toISOString().slice(0, 10)) + '" data-status="' + data.status + '" data-initials="' + displayName.split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() + '"><td>' + id + '</td><td>' + displayName + '</td><td>' + data.email + '</td><td>' + data.phone + '</td><td>' + (user.created_at ? user.created_at.slice(0, 10) : new Date().toISOString().slice(0, 10)) + '</td><td><span class="status ' + statusClass + '">' + data.status + '</span></td><td><div class="actions-inline"><button class="mini-btn" type="button" data-user-action="view">View</button><button class="mini-btn" type="button" data-user-action="edit">Edit</button><button class="mini-btn" type="button" data-user-action="' + (data.status === 'Blocked' ? 'unblock' : 'block') + '">' + (data.status === 'Blocked' ? 'Unblock' : 'Block') + '</button><button class="mini-btn" type="button" data-user-action="delete">Delete</button></div></td></tr>');
                                if (result.temp_password) {
                                    openTempPasswordAlert('Customer Added', result.temp_password);
                                } else {
                                    notify('Customer added');
                                }
                            });
                        }
                    });
                    return;
                }
                const label = button.textContent.trim();
                const actionKey = String(button.dataset.productAction || button.dataset.userAction || label).trim().toLowerCase();
                const contactAction = String(button.dataset.contactAction || '').trim().toLowerCase() || actionKey;
                const page = button.closest('.module-page');
                if (!page) return;
                const table = page.querySelector('table');
                const row = button.closest('tr');

                if (button.dataset.stockExport) {
                    window.location.href = adminStockExportRoute + '?section=' + encodeURIComponent(button.dataset.stockExport);
                    return;
                }

                if (button.dataset.orderExport) {
                    if (table) exportTable(table, page.id + '.csv');
                    return;
                }

                if (page.id === 'inventory-history-page' && label === 'Export CSV') {
                    if (table) exportTable(table, page.id + '.csv');
                    return;
                }

                if (label === 'Export' || label === 'Export Logs') {
                    if (table) exportTable(table, page.id + '.csv');
                    return;
                }

                if (label === 'Export Excel') {
                    if (page.id.indexOf('reports-') === 0) {
                        const exportUrl = buildReportExportUrl(page, 'xlsx');
                        if (exportUrl) {
                            window.location.href = exportUrl;
                            notify('Excel download started');
                        } else {
                            notify('Report export is unavailable');
                        }
                        return;
                    }
                    if (table) exportTable(table, page.id + '.csv');
                    return;
                }

                if (page.id === 'inventory-stock-management-page' && label === 'Add Stock Entry') {
                    const productSelect = page.querySelector('[data-stock-product-select]');
                    const quantityInput = page.querySelector('.table-panel .filter-row input[type="number"]');
                    const productId = productSelect ? productSelect.value.trim() : '';
                    const addedQty = quantityInput ? Number(quantityInput.value) : 0;

                    if (!productId || !addedQty || addedQty < 1) {
                        notify('Select a product and enter a valid quantity');
                        return;
                    }

                    const payload = new FormData();
                    payload.append('action', 'add');
                    payload.append('product_id', productId);
                    payload.append('quantity', String(addedQty));

                    fetch(adminStockManageRoute, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: payload
                    }).then(function (response) {
                        return response.json().then(function (payload) {
                            if (!response.ok) {
                                throw new Error(payload.message || 'Unable to add stock.');
                            }
                            return payload;
                        });
                    }).then(function (payload) {
                        notify(payload.message || 'Stock entry added successfully');
                        window.location.reload();
                    }).catch(function (error) {
                        notify(error.message || 'Unable to add stock');
                    });

                    if (productSelect) productSelect.value = '';
                    if (quantityInput) quantityInput.value = '';
                    return;
                }

                if ((page.id === 'inventory-stock-management-page' && label === 'Edit Stock') || (page.id === 'inventory-low-stock-page' && label === 'Create Restock') || (page.id === 'inventory-out-of-stock-page' && label === 'Restock')) {
                    if (!row) {
                        notify('Stock row not found');
                        return;
                    }

                    const productName = row.dataset.stockProductName || (row.children[1] ? row.children[1].textContent.trim() : 'Product');
                    const currentStock = Number(row.dataset.stockCurrent || (row.children[3] ? row.children[3].textContent.trim() : 0));
                    const productId = row.dataset.stockDbId || '';
                    const isSetUpdate = page.id === 'inventory-stock-management-page' && label === 'Edit Stock';

                    openFormModal({
                        title: (isSetUpdate ? 'Edit Stock - ' : 'Restock - ') + productName,
                        fields: [
                            { name: 'qty', label: isSetUpdate ? 'New Quantity' : 'Quantity to Add', type: 'number', required: true, value: String(currentStock || 0) }
                        ],
                        onSubmit: function (data) {
                            const qty = Number(data.qty || 0);
                            if (Number.isNaN(qty) || qty < 0) {
                                notify('Enter a valid quantity');
                                return;
                            }

                            const payload = new FormData();
                            payload.append('action', isSetUpdate ? 'update' : 'add');
                            payload.append('product_id', productId);
                            payload.append('quantity', String(qty));

                            fetch(adminStockManageRoute, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: payload
                            }).then(function (response) {
                                return response.json().then(function (payload) {
                                    if (!response.ok) {
                                        throw new Error(payload.message || 'Unable to update stock.');
                                    }
                                    return payload;
                                });
                            }).then(function (payload) {
                                notify(payload.message || (isSetUpdate ? 'Stock updated successfully' : 'Stock restocked successfully'));
                                window.location.reload();
                            }).catch(function (error) {
                                notify(error.message || 'Unable to update stock');
                            });
                        }
                    });
                    return;
                }

                if (label === 'View Report') {
                    if (page.id.indexOf('reports-') === 0) {
                        openReportPreview(page, table);
                        return;
                    }
                    openReportPreview(page, table);
                    return;
                }

                if (label === 'Download PDF') {
                    if (page.id.indexOf('reports-') === 0) {
                        downloadReportPdf(page, table);
                        notify('PDF download started');
                        return;
                    }
                    downloadReportPdf(page, table);
                    notify('Report download started');
                    return;
                }

                if (label === 'Add Consultant') {
                    const tbody = table ? table.querySelector('tbody') : null;
                    if (!tbody) return;
                    openFormModal({
                        title: 'Add Consultant',
                        fields: [
                            { name: 'first_name', label: 'First Name', required: true, placeholder: 'Enter first name' },
                            { name: 'last_name', label: 'Last Name', required: true, placeholder: 'Enter last name' },
                            { name: 'email', label: 'Email', type: 'email', required: true, placeholder: 'consultant@example.com' },
                            { name: 'phone', label: 'Phone', required: true, placeholder: '+94 7X XXX XXXX' },
                            { name: 'birth_date', label: 'Birthday', type: 'date', required: true },
                            { name: 'password', label: 'Password', type: 'password', required: false, placeholder: 'Leave blank to auto-generate' },
                            { name: 'password_confirmation', label: 'Confirm Password', type: 'password', required: false, placeholder: 'Repeat password if entered above' },
                            { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive', 'Blocked'] }
                        ],
                        onSubmit: function (data) {
                            const firstName = String(data.first_name || '').trim();
                            const lastName = String(data.last_name || '').trim();
                            const displayName = (firstName + ' ' + lastName).trim() || 'Consultant';
                            return submitUserManagementAction({
                                action: 'create',
                                scope: 'consultant',
                                first_name: firstName,
                                last_name: lastName,
                                email: data.email,
                                phone: data.phone,
                                birth_date: data.birth_date,
                                password: data.password,
                                password_confirmation: data.password_confirmation,
                                status: data.status
                            }).then(function (result) {
                                const user = result.user || {};
                                const id = user.id ? String(user.id) : String(tbody.children.length + 10);
                                const statusClass = statusClassFromText(data.status);
                                tbody.insertAdjacentHTML('beforeend', '<tr data-user-db-id="' + (user.id || '') + '" data-consultant-id="' + id + '" data-first-name="' + firstName + '" data-last-name="' + lastName + '" data-email="' + data.email + '" data-phone="' + data.phone + '" data-birth-date="' + (data.birth_date || '') + '" data-assigned-customers="0" data-status="' + data.status + '" data-initials="' + displayName.split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() + '"><td>' + id + '</td><td>' + displayName + '</td><td>' + data.email + '</td><td>' + data.phone + '</td><td>0</td><td><span class="status ' + statusClass + '">' + data.status + '</span></td><td><div class="actions-inline"><button class="mini-btn" type="button" data-user-action="view">View</button><button class="mini-btn" type="button" data-user-action="edit">Edit</button><button class="mini-btn" type="button" data-user-action="' + (data.status === 'Blocked' ? 'unblock' : 'block') + '">' + (data.status === 'Blocked' ? 'Unblock' : 'Block') + '</button><button class="mini-btn" type="button" data-user-action="delete">Delete</button></div></td></tr>');
                                if (result.temp_password) {
                                    openTempPasswordAlert('Consultant Added', result.temp_password);
                                } else {
                                    notify('Consultant added');
                                }
                            });
                        }
                    });
                    return;
                }

                if (label === 'Add Admin') {
                    const tbody = table ? table.querySelector('tbody') : null;
                    if (!tbody) return;
                    openFormModal({
                        title: 'Add Admin User',
                        fields: [
                            { name: 'first_name', label: 'First Name', required: true, placeholder: 'Enter first name' },
                            { name: 'last_name', label: 'Last Name', required: true, placeholder: 'Enter last name' },
                            { name: 'email', label: 'Email', type: 'email', required: true, placeholder: 'admin@example.com' },
                            { name: 'phone', label: 'Phone', required: true, placeholder: '+94 7X XXX XXXX' },
                            { name: 'birth_date', label: 'Birthday', type: 'date', required: true },
                            { name: 'password', label: 'Password', type: 'password', required: false, placeholder: 'Leave blank to auto-generate' },
                            { name: 'password_confirmation', label: 'Confirm Password', type: 'password', required: false, placeholder: 'Repeat password if entered above' },
                            { name: 'role', label: 'Role', type: 'select', options: ['Admin', 'Lower Admin', 'Content Manager'] },
                            { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive', 'Blocked'] }
                        ],
                        onSubmit: function (data) {
                            const roleKey = data.role === 'Admin' ? 'admin' : (data.role === 'Lower Admin' ? 'lower_admin' : 'content_manager');
                            const firstName = String(data.first_name || '').trim();
                            const lastName = String(data.last_name || '').trim();
                            const displayName = (firstName + ' ' + lastName).trim() || 'Admin';
                            return submitUserManagementAction({
                                action: 'create',
                                scope: 'admin',
                                role: roleKey,
                                first_name: firstName,
                                last_name: lastName,
                                email: data.email,
                                phone: data.phone,
                                birth_date: data.birth_date,
                                password: data.password,
                                password_confirmation: data.password_confirmation,
                                status: data.status
                            }).then(function (result) {
                                const user = result.user || {};
                                const id = user.id ? String(user.id) : String(tbody.children.length + 1);
                                const statusClass = data.status === 'Active' ? 'ok' : (data.status === 'Blocked' ? 'bad' : 'warn');
                                const updatedOn = new Date().toISOString().slice(0, 16).replace('T', ' ');
                                tbody.insertAdjacentHTML('beforeend', '<tr data-user-db-id="' + (user.id || '') + '" data-admin-id="' + id + '" data-first-name="' + firstName + '" data-last-name="' + lastName + '" data-email="' + data.email + '" data-phone="' + data.phone + '" data-birth-date="' + (data.birth_date || '') + '" data-role="' + data.role + '" data-role-key="' + roleKey + '" data-permissions="' + ((result.user && result.user.permissions) ? result.user.permissions.join(',') : '') + '" data-updated-on="' + updatedOn + '" data-status="' + data.status + '" data-initials="' + displayName.split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() + '"><td>' + id + '</td><td>' + displayName + '</td><td>' + data.email + '</td><td>' + data.phone + '</td><td>' + data.role + '</td><td>' + updatedOn + '</td><td><span class="status ' + statusClass + '">' + data.status + '</span></td><td><div class="actions-inline"><button class="mini-btn" type="button" data-user-action="view">View</button><button class="mini-btn" type="button" data-user-action="edit">Edit</button><button class="mini-btn" type="button" data-user-action="' + (data.status === 'Blocked' ? 'unblock' : 'block') + '">' + (data.status === 'Blocked' ? 'Unblock' : 'Block') + '</button><button class="mini-btn" type="button" data-user-action="delete">Delete</button></div></td></tr>');
                                if (result.temp_password) {
                                    openTempPasswordAlert('Admin Added', result.temp_password);
                                } else {
                                    notify('Admin added');
                                }
                            });
                        }
                    });
                    return;
                }

                if (label === 'Update Permissions') {
                    if (!row) return;
                    openPermissionModal(row);
                    return;
                }

                if (page.id === 'content-faq-page' && label === 'Add FAQ') {
                    const tbody = table ? table.querySelector('tbody') : null;
                    if (!tbody) return;
                    openFormModal({
                        title: 'Add FAQ',
                        fields: [
                            { name: 'question', label: 'Question', required: true, placeholder: 'Enter FAQ question' },
                            { name: 'answer', label: 'Answer', required: true, placeholder: 'Enter FAQ answer' },
                            { name: 'group', label: 'Group', type: 'select', options: ['Orders', 'Custom Jewellery', 'Consultation', 'Payments'] },
                            { name: 'date', label: 'Updated On', type: 'date', required: true, value: '2026-03-30' }
                        ],
                        onSubmit: function (data) {
                            const nextId = 'FAQ-' + String(tbody.querySelectorAll('tr').length + 1).padStart(2, '0');
                            tbody.insertAdjacentHTML('afterbegin', '<tr><td>' + nextId + '</td><td>' + data.question + '</td><td>' + data.answer + '</td><td>' + data.group + '</td><td>' + data.date + '</td><td><div class="actions-inline"><button class="mini-btn" type="button">View</button><button class="mini-btn" type="button">Edit</button></div></td></tr>');
                            notify('FAQ added');
                        }
                    });
                    return;
                }

                if (!row) return;

                if (isOrderPage(page.id) && label === 'View Details') {
                    const order = getOrderDetails(page.id, row);
                    openViewModal('Order Details - ' + order.orderId, order.details, order.initials);
                    return;
                }

                if (isOrderPage(page.id) && label === 'Change Status') {
                    const order = getOrderDetails(page.id, row);
                    const statusOptions = page.id === 'orders-pickup-page'
                        ? ['Ready For Pickup', 'Pickup Completed']
                        : (page.id === 'orders-delivery-page'
                            ? ['Out for Delivery', 'Out for Pickup', 'Completed', 'Cancelled']
                            : ['Pending', 'Processing', 'Out for Delivery', 'Ready For Pickup', 'Completed', 'Pickup Completed', 'Cancelled']);
                    openFormModal({
                        title: 'Change Order Status - ' + order.orderId,
                        fields: [
                            { name: 'status', label: 'Order Status', type: 'select', options: statusOptions, required: true },
                            { name: 'note', label: 'Admin Note', required: false, placeholder: 'Optional update note' }
                        ],
                        onSubmit: async function (data) {
                            const response = await submitOrderManagementAction({
                                action: 'update-status',
                                order_db_id: Number(order.dbId || row.dataset.orderDbId || 0),
                                status: data.status,
                                note: data.note || ''
                            });
                            const updatedStatus = response?.order?.status || data.status;
                            const didMove = moveOrderRowToStatus(row, page.id, updatedStatus);
                            if (!didMove) {
                                throw new Error('Target orders section not found');
                            }
                            notify('Order moved to ' + updatedStatus);
                        }
                    });
                    const statusSelect = formModalFields.querySelector('select[name="status"]');
                    if (statusSelect) statusSelect.value = statusOptions.indexOf(order.status) !== -1 ? order.status : statusOptions[0];
                    return;
                }

                if (isOrderPage(page.id) && label === 'Cancel Order') {
                    const order = getOrderDetails(page.id, row);
                    openConfirmModal({
                        title: 'Cancel Order',
                        message: 'Cancel order ' + order.orderId + ' for ' + order.customer + '?',
                        confirmLabel: 'Cancel Order'
                    }, async function () {
                        await submitOrderManagementAction({
                            action: 'cancel',
                            order_db_id: Number(order.dbId || row.dataset.orderDbId || 0),
                            note: 'Cancelled from admin dashboard'
                        });
                        const didMove = moveOrderRowToStatus(row, page.id, 'Cancelled');
                        if (!didMove) {
                            throw new Error('Unable to move order to cancelled orders.');
                        }
                        notify('Order cancelled successfully');
                    });
                    return;
                }

                if (isOrderPage(page.id) && label === 'Print Invoice') {
                    const order = getOrderDetails(page.id, row);
                    const isFullyPaidPickup = order.pickupOnly && ['completed', 'pickup completed'].indexOf(String(order.status || '').toLowerCase()) !== -1;
                    openViewModal('Invoice Preview - ' + order.orderId, [
                        { label: 'Invoice No', value: order.orderId },
                        { label: 'Customer Name', value: order.customer },
                        { label: 'Products', value: order.product },
                        { label: 'Payment Method', value: order.payment },
                        { label: 'Order Date', value: order.orderDate },
                        { label: 'Order Status', value: order.status },
                        { label: isFullyPaidPickup ? 'Fully Paid' : 'Paid Amount', value: isFullyPaidPickup ? order.total : order.paidAmount },
                        { label: isFullyPaidPickup ? 'Outstanding Amount' : 'Amount Left to Pay', value: isFullyPaidPickup ? 'Rs 0' : order.outstandingAmount },
                        { label: 'Total Amount', value: order.total }
                    ], order.initials);
                    downloadInvoice(order);
                    notify('Invoice downloaded');
                    return;
                }

                if (page.id === 'orders-pickup-page' && label === 'Schedule Pickup') {
                    openFormModal({
                        title: 'Schedule Pickup - ' + (row.children[0] ? row.children[0].textContent.trim() : 'Order'),
                        fields: [
                            { name: 'slot', label: 'Pickup Slot', required: true, value: row.children[7].textContent.trim() },
                            { name: 'status', label: 'Status', type: 'select', options: ['Ready For Pickup', 'Pickup Completed'], required: true }
                        ],
                        onSubmit: async function (data) {
                            const order = getOrderDetails(page.id, row);
                            await submitOrderManagementAction({
                                action: 'update-status',
                                order_db_id: Number(order.dbId || row.dataset.orderDbId || 0),
                                status: data.status,
                                note: data.slot || ''
                            });
                            moveOrderRowToStatus(row, page.id, data.status);
                            notify('Pickup schedule saved');
                        }
                    });
                    const statusSelect = formModalFields.querySelector('select[name="status"]');
                    if (statusSelect) statusSelect.value = row.children[9].textContent.trim();
                    return;
                }

                if (page.id === 'orders-returns-page' && label === 'View Details') {
                    openViewModal('Return Request Details - ' + (row.children[0] ? row.children[0].textContent.trim() : 'Request'), [
                        { label: 'Request ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                        { label: 'Order ID', value: row.children[1] ? row.children[1].textContent.trim() : '-' },
                        { label: 'Customer Name', value: row.children[2] ? row.children[2].textContent.trim() : '-' },
                        { label: 'Reason', value: row.children[3] ? row.children[3].textContent.trim() : '-' },
                        { label: 'Requested Date', value: row.children[4] ? row.children[4].textContent.trim() : '-' },
                        { label: 'Decision', value: row.children[5] ? row.children[5].textContent.trim() : '-' },
                        { label: 'Refund Status', value: row.children[6] ? row.children[6].textContent.trim() : '-' },
                        { label: 'Order Status', value: row.dataset.orderStatus || '-' },
                        { label: 'Reviewed By', value: row.dataset.reviewedBy || 'Not reviewed yet' },
                        { label: 'Reviewed At', value: row.dataset.reviewedAt || 'Not reviewed yet' },
                        { label: 'Admin Note', value: row.dataset.adminNote || 'No admin note yet.' },
                        { label: 'Refund Amount', value: row.dataset.refundAmount || '-' }
                    ], row.children[2] ? row.children[2].textContent.trim().split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() : 'RR');
                    return;
                }

                if (page.id === 'orders-returns-page' && label === 'Approve') {
                    openFormModal({
                        title: 'Approve Return Request',
                        fields: [
                            { name: 'note', label: 'Admin Note', required: false, placeholder: 'Optional approval note' }
                        ],
                        onSubmit: async function (data) {
                            const result = await submitReturnManagementAction({
                                action: 'approve',
                                return_db_id: Number(row.dataset.returnDbId || 0),
                                note: data.note || ''
                            });
                            const updated = result?.return_request || {};
                            if (row.children[5]) row.children[5].innerHTML = '<span class="status ' + (updated.decision_class || 'ok') + '">' + (updated.decision || 'Approved') + '</span>';
                            if (row.children[6]) row.children[6].innerHTML = '<span class="status ' + (updated.refund_status_class || 'info') + '">' + (updated.refund_status || 'In Progress') + '</span>';
                            row.dataset.adminNote = updated.admin_note || '';
                            row.dataset.refundAmount = updated.refund_amount || '';
                            notify(result.message || 'Return request approved');
                            setTimeout(function () { window.location.reload(); }, 700);
                        }
                    });
                    return;
                }

                if (page.id === 'orders-returns-page' && label === 'Reject') {
                    openFormModal({
                        title: 'Reject Return Request',
                        fields: [
                            { name: 'note', label: 'Admin Note', required: false, placeholder: 'Optional rejection note' }
                        ],
                        onSubmit: async function (data) {
                            const result = await submitReturnManagementAction({
                                action: 'reject',
                                return_db_id: Number(row.dataset.returnDbId || 0),
                                note: data.note || ''
                            });
                            const updated = result?.return_request || {};
                            if (row.children[5]) row.children[5].innerHTML = '<span class="status ' + (updated.decision_class || 'bad') + '">' + (updated.decision || 'Rejected') + '</span>';
                            if (row.children[6]) row.children[6].innerHTML = '<span class="status ' + (updated.refund_status_class || 'info') + '">' + (updated.refund_status || 'In Progress') + '</span>';
                            row.dataset.adminNote = updated.admin_note || '';
                            row.dataset.refundAmount = updated.refund_amount || '';
                            notify(result.message || 'Return request rejected');
                            setTimeout(function () { window.location.reload(); }, 700);
                        }
                    });
                    return;
                }

                if (page.id === 'orders-returns-page' && label === 'Mark Refunded') {
                    openFormModal({
                        title: 'Mark Refund Complete',
                        fields: [
                            { name: 'note', label: 'Admin Note', required: false, placeholder: 'Optional refund completion note' }
                        ],
                        onSubmit: async function (data) {
                            const result = await submitReturnManagementAction({
                                action: 'refund',
                                return_db_id: Number(row.dataset.returnDbId || 0),
                                note: data.note || ''
                            });
                            const updated = result?.return_request || {};
                            if (row.children[5]) row.children[5].innerHTML = '<span class="status ' + (updated.decision_class || 'ok') + '">' + (updated.decision || 'Approved') + '</span>';
                            if (row.children[6]) row.children[6].innerHTML = '<span class="status ' + (updated.refund_status_class || 'ok') + '">' + (updated.refund_status || 'Refunded') + '</span>';
                            row.dataset.adminNote = updated.admin_note || '';
                            row.dataset.refundAmount = updated.refund_amount || '';
                            notify(result.message || 'Refund marked as completed');
                            setTimeout(function () { window.location.reload(); }, 700);
                        }
                    });
                    return;
                }

                if (isCustomPage(page.id) && label === 'View Details') {
                    const refImages = (row.dataset.referenceImages || row.dataset.refImages || '').split('|').filter(Boolean);
                    const customerName = row.dataset.customerName || (row.children[1] ? row.children[1].textContent.trim() : '-');
                    const gemType = row.dataset.gemType || (row.children[2] ? row.children[2].textContent.trim() : '-');
                    const metal = row.dataset.metal || (row.children[3] ? row.children[3].textContent.trim() : '-');
                    const size = row.dataset.size || (row.children[4] ? row.children[4].textContent.trim() : '-');
                    const engraving = row.dataset.engraving || (row.children[5] ? row.children[5].textContent.trim() : '-');
                    const requestDate = row.dataset.date || (row.children[7] ? row.children[7].textContent.trim() : '-');
                    const status = row.dataset.status || (row.children[8] ? row.children[8].textContent.trim() : '-');
                    const quotationStatus = row.dataset.quotationStatusRaw || row.dataset.quotationStatus || (row.dataset.hasQuotation === '1' ? 'Sent' : '—');
                    const quotationAmount = row.dataset.quotationAmount || '-';
                    const quotationNote = row.dataset.quotationNote || '-';
                    const quotationImageUrl = row.dataset.quotationImageUrl || '';
                    const requestNotes = row.dataset.notes || '-';
                    const refHtml = refImages.length ? refImages.map(function (img) {
                        return '<div style="padding:8px 10px;border:1px solid #efdfca;border-radius:10px;background:#fff;margin-top:6px;"><div style="margin-bottom:8px;"><i class="fas fa-image" style="color:#b98945;margin-right:8px;"></i>' + img + '</div><button class="mini-btn" type="button" data-download-ref="' + img + '">Download</button></div>';
                    }).join('') : '<strong>—</strong>';
                    const quotationImageHtml = quotationImageUrl
                        ? '<div style="margin-top:6px;"><img src="' + quotationImageUrl + '" alt="Quotation image" style="width:100%;max-width:220px;height:auto;border-radius:16px;border:1px solid #eadbc6;"></div>'
                        : '<span style="color:var(--muted);">—</span>';
                    openViewModal('Custom Request Details - ' + (row.dataset.requestId || (row.children[0] ? row.children[0].textContent.trim() : 'Request')), [
                        { label: 'Request ID', value: row.dataset.requestId || (row.children[0] ? row.children[0].textContent.trim() : '-') },
                        { label: 'Customer Name', value: customerName },
                        { label: 'Gem Type', value: gemType },
                        { label: 'Metal', value: metal },
                        { label: 'Size', value: size },
                        { label: 'Engraving', value: engraving },
                        { label: 'Request Notes', value: requestNotes },
                        { label: 'Reference Images', html: refHtml },
                        { label: 'Date', value: requestDate },
                        { label: 'Status', value: status },
                        { label: 'Quotation Status', value: quotationStatus },
                        { label: 'Quotation Amount', value: quotationAmount },
                        { label: 'Quotation Note', value: quotationNote },
                        { label: 'Quotation Image', html: quotationImageHtml }
                    ], customerName.trim().split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() || 'CJ');
                    return;
                }

                if (isCustomPage(page.id) && label === 'Approve') {
                    openConfirmModal({
                        title: 'Approve Custom Design',
                        message: 'Approve this custom jewellery request?',
                        confirmLabel: 'Approve'
                    }, async function () {
                        await submitCustomJewelleryAction({
                            action: 'approve',
                            custom_request_db_id: Number(row.dataset.customRequestId || 0),
                            admin_note: ''
                        });
                        notify('Custom request approved');
                        setTimeout(function () { window.location.reload(); }, 700);
                    });
                    return;
                }

                if (isCustomPage(page.id) && label === 'Reject') {
                    if (page.id === 'custom-quotations-page') {
                        notify('Quotation rows are read-only in this view');
                        return;
                    }
                    openFormModal({
                        title: 'Reject Custom Request',
                        fields: [
                            { name: 'reason', label: 'Reject Reason', required: true, placeholder: 'Budget, design mismatch, unavailable gem...' }
                        ],
                        onSubmit: async function (data) {
                            await submitCustomJewelleryAction({
                                action: 'reject',
                                custom_request_db_id: Number(row.dataset.customRequestId || 0),
                                admin_note: data.reason || ''
                            });
                            notify('Custom request rejected');
                            setTimeout(function () { window.location.reload(); }, 700);
                        }
                    });
                    return;
                }

                if (isCustomPage(page.id) && label === 'Update Status') {
                    if (row.dataset.hasQuotation === '1') {
                        notify('Status can no longer be updated after a quotation has been sent.');
                        return;
                    }
                    const currentStatus = String(row.dataset.status || row.children[8]?.textContent || 'Pending').trim();
                    openFormModal({
                        title: 'Update Custom Request Status',
                        fields: [
                            { name: 'status', label: 'Status', type: 'select', options: ['Pending', 'Approved', 'Quoted', 'Rejected'], required: true, value: currentStatus },
                            { name: 'note', label: 'Admin Note', required: false, placeholder: 'Optional status note' },
                            { name: 'quotation_amount', label: 'Quotation Amount', required: false, placeholder: 'Rs 22,500' },
                            { name: 'quotation_note', label: 'Quotation Note', required: false, placeholder: 'Production lead time and gemstone details' },
                            { name: 'quotation_image', label: 'Quotation Image', type: 'file', accept: 'image/*', required: false }
                        ],
                        onSubmit: async function (data) {
                            const selectedStatus = String(data.status || '').trim();
                            const quotationAmount = Number(String(data.quotation_amount || '').replace(/[^\d.]/g, '')) || 0;

                            if (selectedStatus === 'Quoted') {
                                if (!quotationAmount) {
                                    throw new Error('Quotation amount is required when marking this request as Quoted.');
                                }
                                await submitCustomJewelleryAction({
                                    action: 'send-quotation',
                                    custom_request_db_id: Number(row.dataset.customRequestId || 0),
                                    quotation_amount: quotationAmount,
                                    quotation_note: data.quotation_note || '',
                                    quotation_image: data.quotation_image instanceof File && data.quotation_image.size ? data.quotation_image : null,
                                    admin_note: data.note || ''
                                });
                                row.dataset.status = 'Quoted';
                                if (row.children[8]) {
                                    row.children[8].innerHTML = '<span class="status ' + statusClassFromText('Quoted') + '">Quoted</span>';
                                }
                                notify('Quotation sent and request marked as Quoted');
                                setTimeout(function () { window.location.reload(); }, 700);
                                return;
                            }
                            await submitCustomJewelleryAction({
                                action: 'update-status',
                                custom_request_db_id: Number(row.dataset.customRequestId || 0),
                                status: selectedStatus,
                                admin_note: data.note || ''
                            });
                            row.dataset.status = selectedStatus;
                            if (row.children[8]) {
                                row.children[8].innerHTML = '<span class="status ' + statusClassFromText(selectedStatus) + '">' + selectedStatus + '</span>';
                            }
                            notify('Custom request status updated to ' + selectedStatus);
                            setTimeout(function () { window.location.reload(); }, 700);
                        }
                    });
                    const statusSelect = formModalFields.querySelector('select[name="status"]');
                    const quotationAmountField = formModalFields.querySelector('[name="quotation_amount"]');
                    const quotationNoteField = formModalFields.querySelector('[name="quotation_note"]');
                    const quotationImageField = formModalFields.querySelector('[name="quotation_image"]');
                    function toggleQuotationFields() {
                        const shouldShow = String(statusSelect ? statusSelect.value : '').trim() === 'Quoted';
                        [quotationAmountField, quotationNoteField, quotationImageField].forEach(function (field) {
                            if (!field) return;
                            const wrap = field.closest('.field');
                            if (!wrap) return;
                            wrap.style.display = shouldShow ? '' : 'none';
                            field.disabled = !shouldShow;
                        });
                    }
                    if (statusSelect) {
                        statusSelect.value = currentStatus;
                        statusSelect.addEventListener('change', toggleQuotationFields);
                    }
                    toggleQuotationFields();
                    return;
                }

                if ((page.id === 'custom-requests-page' || page.id === 'custom-quotations-page') && label === 'Send Quotation') {
                    const quotationStatus = String(row.dataset.quotationStatusRaw || row.dataset.quotationStatus || '').toLowerCase();
                    if (row.dataset.hasQuotation === '1' && quotationStatus !== 'rejected') {
                        notify('A quotation already exists for this request');
                        return;
                    }
                    const requestId = row.dataset.requestId || (row.children[0] ? row.children[0].textContent.trim() : '-');
                    const customerName = row.dataset.customerName || (row.children[1] ? row.children[1].textContent.trim() : '-');
                    openFormModal({
                        title: 'Send Quotation',
                        fields: [
                            { name: 'amount', label: 'Quotation Amount', required: true, placeholder: 'Rs 22,500' },
                            { name: 'note', label: 'Quotation Note', required: false, placeholder: 'Production lead time and gemstone details' },
                            { name: 'quotation_image', label: 'Quotation Image', type: 'file', accept: 'image/*', required: false }
                        ],
                        onSubmit: async function (data) {
                            const quotationAmount = Number(String(data.amount || '').replace(/[^\d.]/g, '')) || 0;
                            await submitCustomJewelleryAction({
                                action: 'send-quotation',
                                custom_request_db_id: Number(row.dataset.customRequestId || 0),
                                quotation_amount: quotationAmount,
                                quotation_note: data.note || '',
                                quotation_image: data.quotation_image || null
                            });
                            notify('Quotation sent to customer');
                            setTimeout(function () { window.location.reload(); }, 700);
                        }
                    });
                    return;
                }

                if (page.id === 'custom-paid-page' && label === 'View Details') {
                    const paidQuotationImageUrl = row.dataset.quotationImageUrl || '';
                    const paidQuotationImageHtml = paidQuotationImageUrl
                        ? '<div style="margin-top:6px;"><img src="' + paidQuotationImageUrl + '" alt="Quotation image" style="width:100%;max-width:220px;height:auto;border-radius:16px;border:1px solid #eadbc6;"></div>'
                        : '<span style="color:var(--muted);">—</span>';
                    openViewModal('Paid Design Details - ' + (row.children[0] ? row.children[0].textContent.trim() : 'Paid'), [
                        { label: 'Paid ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                        { label: 'Request ID', value: row.children[1] ? row.children[1].textContent.trim() : '-' },
                        { label: 'Customer Name', value: row.children[2] ? row.children[2].textContent.trim() : '-' },
                        { label: 'Design Name', value: row.children[3] ? row.children[3].textContent.trim() : '-' },
                        { label: 'Paid Date', value: row.children[4] ? row.children[4].textContent.trim() : '-' },
                        { label: 'Status', value: row.children[5] ? row.children[5].textContent.trim() : '-' },
                        { label: 'Quotation Image', html: paidQuotationImageHtml }
                    ], row.children[2] ? row.children[2].textContent.trim().split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() : 'PD');
                    return;
                }

                if (page.id === 'custom-quotations-page' && label === 'View Details') {
                    const quotationImageUrl = row.dataset.quotationImage || '';
                    const quotationImageHtml = quotationImageUrl
                        ? '<div style="margin-top:6px;"><img src="' + quotationImageUrl + '" alt="Quotation image" style="width:100%;max-width:220px;height:auto;border-radius:16px;border:1px solid #eadbc6;"></div>'
                        : '<span style="color:var(--muted);">—</span>';
                    openViewModal('Quotation Details - ' + (row.children[0] ? row.children[0].textContent.trim() : 'Quotation'), [
                        { label: 'Quotation ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                        { label: 'Request ID', value: row.children[1] ? row.children[1].textContent.trim() : '-' },
                        { label: 'Customer Name', value: row.children[2] ? row.children[2].textContent.trim() : '-' },
                        { label: 'Amount', value: row.children[3] ? row.children[3].textContent.trim() : '-' },
                        { label: 'Image', html: quotationImageHtml },
                        { label: 'Customer Decision', value: row.children[5] ? row.children[5].textContent.trim() : '-' },
                        { label: 'Sent Date', value: row.children[6] ? row.children[6].textContent.trim() : '-' },
                        { label: 'Status', value: row.children[7] ? row.children[7].textContent.trim() : '-' }
                    ], row.children[2] ? row.children[2].textContent.trim().split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() : 'QU');
                    return;
                }

                if (page.id === 'notifications-list-page' && label === 'View') {
                    openViewModal('Notification Details - ' + (row.dataset.notificationId || (row.children[1] ? row.children[1].textContent.trim() : 'Notification')), [
                        { label: 'ID', value: row.dataset.notificationId || (row.children[0] ? row.children[0].textContent.trim() : '-') },
                        { label: 'Title', value: row.dataset.title || (row.children[1] ? row.children[1].textContent.trim() : '-') },
                        { label: 'Category', value: row.dataset.category || (row.children[2] ? row.children[2].textContent.trim() : '-') },
                        row.dataset.imageUrl ? { label: 'Image', html: '<img src="' + row.dataset.imageUrl + '" alt="Notification image" style="max-width:220px;border-radius:14px;display:block;border:1px solid #eadfcf;box-shadow:0 10px 24px rgba(0,0,0,.08)">' } : { label: 'Image', value: '-' },
                        { label: 'Recipient', value: row.dataset.recipientLabel || (row.children[3] ? row.children[3].textContent.trim() : '-') },
                        { label: 'Message', value: row.dataset.message || (row.children[4] ? row.children[4].textContent.trim() : '-') },
                        { label: 'Action Label', value: row.dataset.actionLabel || '-' },
                        { label: 'Date', value: row.dataset.publishedDatetime || (row.children[5] ? row.children[5].textContent.trim() : '-') },
                        { label: 'Status', value: row.dataset.status || (row.children[6] ? row.children[6].textContent.trim() : '-') }
                    ], 'NT');
                    return;
                }

                if ((page.id === 'content-blogs-page' || page.id === 'content-news-page') && (label === 'Publish' || label === 'Unpublish')) {
                    const nextStatus = label === 'Publish' ? 'Published' : 'Draft';
                    row.children[7].innerHTML = '<span class="status ' + statusClassFromText(nextStatus) + '">' + nextStatus + '</span>';
                    button.textContent = label === 'Publish' ? 'Unpublish' : 'Publish';
                    notify((page.id === 'content-blogs-page' ? 'Blog' : 'News') + ' status updated');
                    return;
                }

                if (page.id === 'contact-messages-page' && contactAction === 'reply') {
                    openFormModal({
                        title: 'Reply to Contact Message',
                        fields: [
                            { name: 'reply_message', label: 'Reply Message', type: 'textarea', required: true, placeholder: 'Write your reply here...' }
                        ],
                        onSubmit: function (data) {
                            const contactId = row.dataset.contactId || row.dataset.messageId || '';
                            if (!contactId) return;

                            return fetch(@json(url('/admin/contact-messages')) + '/' + encodeURIComponent(contactId) + '/reply', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    reply_message: data.reply_message || ''
                                }),
                            }).then(function (response) {
                                return response.json().then(function (payload) {
                                    if (!response.ok) {
                                        throw new Error(payload.message || 'Unable to save reply.');
                                    }
                                    return payload;
                                });
                            }).then(function (payload) {
                                applyContactMessageRowUpdate(row, payload.contact_message || {});
                                notify(payload.message || 'Reply saved for contact message');
                            }).catch(function (error) {
                                notify(error.message || 'Unable to save reply');
                            });
                        }
                    });
                    return;
                }

                if (page.id === 'contact-messages-page' && contactAction === 'mark-read') {
                    const contactId = row.dataset.contactId || row.dataset.messageId || '';
                    if (!contactId) return;

                    fetch(@json(url('/admin/contact-messages')) + '/' + encodeURIComponent(contactId) + '/read', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                    }).then(function (response) {
                        return response.json().then(function (payload) {
                            if (!response.ok) {
                                throw new Error(payload.message || 'Unable to mark message as read.');
                            }
                            return payload;
                        });
                    }).then(function (payload) {
                        applyContactMessageRowUpdate(row, payload.contact_message || {});
                        notify(payload.message || 'Message marked as read');
                    }).catch(function (error) {
                        notify(error.message || 'Unable to mark message as read');
                    });
                    return;
                }

                if (isAppointmentPage(page.id) && label === 'View Details') {
                    openViewModal('Appointment Details - ' + (row.children[0] ? row.children[0].textContent.trim() : 'Appointment'), [
                        { label: 'Appointment ID', value: row.dataset.appointmentNumber || (row.children[0] ? row.children[0].textContent.trim() : '-') },
                        { label: 'Customer Name', value: row.dataset.customerName || (row.children[1] ? row.children[1].textContent.trim() : '-') },
                        { label: 'Consultant', value: row.dataset.consultantName || (row.children[2] ? row.children[2].textContent.trim() : 'Unassigned') },
                        { label: 'Appointment Topic', value: row.dataset.appointmentTopic || '-' },
                        { label: 'Appointment Mode', value: row.dataset.appointmentMode || (row.children[5] ? row.children[5].textContent.trim() : '-') },
                        { label: 'Preferred Date', value: row.dataset.preferredDate || (row.children[3] ? row.children[3].textContent.trim() : '-') },
                        { label: 'Preferred Time', value: row.dataset.preferredTime || (row.children[4] ? row.children[4].textContent.trim() : '-') },
                        { label: 'Contact Number', value: row.dataset.contactNumber || '-' },
                        { label: 'Status', value: row.dataset.status || (row.children[6] ? row.children[6].textContent.trim() : '-') },
                        { label: 'Consultant Note', value: row.dataset.consultantNote || 'No consultant note saved yet.' },
                        { label: 'Customer Note', value: row.dataset.customerNote || 'No customer note saved yet.' },
                        { label: 'Confirmed At', value: row.dataset.approvedAt || 'Not confirmed yet.' },
                        { label: 'Completed At', value: row.dataset.completedAt || 'Not completed yet.' }
                    ], row.children[1] ? row.children[1].textContent.trim().split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() : 'AP');
                    return;
                }

                if (isConsultationPage(page.id) && label === 'View Details') {
                    const consultationThreadKey = row.dataset.chatThreadId || row.dataset.requestId || ('consultation-' + (row.children[0] ? row.children[0].textContent.trim().toLowerCase() : 'thread'));
                    const consultationThread = consultationThreadData[consultationThreadKey] || { messages: [] };
                    const consultationMessages = consultationThread.messages || [];
                const latestMessage = consultationMessages.length ? consultationMessages[consultationMessages.length - 1] : null;
                const latestMessageHtml = latestMessage
                    ? '<div style="padding:10px 12px;border:1px solid #e7d3b6;border-radius:12px;background:#fff8ef;"><strong style="display:block;margin-bottom:6px;">' + latestMessage.sender + ' • ' + latestMessage.time + '</strong><div>' + latestMessage.text + '</div>' + (latestMessage.imageUrl ? '<div class="chat-media"><img src="' + latestMessage.imageUrl + '" alt="Consultation attachment"></div>' : '') + '</div>'
                    : 'No messages have been exchanged yet.';

                    openViewModal('Consultation Details - ' + (row.children[0] ? row.children[0].textContent.trim() : 'Request'), [
                        { label: 'Request ID', value: row.dataset.requestId || (row.children[0] ? row.children[0].textContent.trim() : '-') },
                        { label: 'Customer Name', value: row.dataset.customerName || (row.children[1] ? row.children[1].textContent.trim() : '-') },
                        { label: 'Consultation Type', value: row.dataset.requestType || (row.children[2] ? row.children[2].textContent.trim() : '-') },
                        { label: 'Assigned Consultant', value: row.dataset.assignedConsultant || (row.children[3] ? row.children[3].textContent.trim() : '-') },
                        { label: 'Submitted On', value: row.dataset.submittedOn || (row.children[4] ? row.children[4].textContent.trim() : '-') },
                        { label: 'Status', value: row.dataset.status || (row.children[5] ? row.children[5].textContent.trim() : '-') },
                        { label: 'Thread ID', value: consultationThreadKey },
                        { label: 'Message Count', value: String(consultationMessages.length) },
                        { label: 'Latest Message', html: latestMessageHtml },
                        { label: 'Customer Note', value: row.dataset.customerNote || 'No customer note saved yet.' },
                        { label: 'Consultant Note', value: row.dataset.consultantNote || 'No consultant note saved yet.' },
                        { label: 'Chat Access', value: row.dataset.consultantId && String(row.dataset.status || '').toLowerCase() === 'approved' ? 'Available' : (String(row.dataset.status || '').toLowerCase() === 'approved' ? 'Waiting for assignment' : 'Waiting for approval') }
                    ], row.children[1] ? row.children[1].textContent.trim().split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase() : 'CS');
                    return;
                }

                if (isConsultationPage(page.id) && label === 'Approve') {
                    openFormModal({
                        title: 'Approve Consultation',
                        fields: [
                            { name: 'consultant_id', label: 'Assign Consultant', type: 'select', options: consultantOptions, required: true },
                            { name: 'consultant_note', label: 'Admin Note', required: false, placeholder: 'Optional approval note or guidance' }
                        ],
                        onSubmit: function (data) {
                            const consultationId = row.dataset.consultationId || '';
                            if (!consultationId) {
                                notify('Consultation row is missing an ID');
                                return;
                            }
                            updateConsultationRequestOnServer(consultationId, {
                                action: 'approve',
                                consultant_id: data.consultant_id,
                                consultant_note: data.consultant_note
                            })
                                .then(() => window.location.reload())
                                .catch((error) => alert(error.message || 'Unable to approve the consultation.'));
                        }
                    });
                    return;
                }

                if (isConsultationPage(page.id) && label === 'Reject') {
                    openFormModal({
                        title: 'Reject Consultation',
                        fields: [
                            { name: 'consultant_note', label: 'Reject Reason', required: false, placeholder: 'Optional reason for rejection' }
                        ],
                        onSubmit: function (data) {
                            const consultationId = row.dataset.consultationId || '';
                            if (!consultationId) {
                                notify('Consultation row is missing an ID');
                                return;
                            }
                            updateConsultationRequestOnServer(consultationId, {
                                action: 'reject',
                                consultant_note: data.consultant_note
                            })
                                .then(() => window.location.reload())
                                .catch((error) => alert(error.message || 'Unable to reject the consultation.'));
                        }
                    });
                    return;
                }

                if ((page.id === 'consultation-requests-page' || page.id === 'consultation-pending-page') && label === 'Assign Consultant') {
                    openFormModal({
                        title: 'Assign Consultant',
                        fields: [
                            { name: 'consultant_id', label: 'Consultant', type: 'select', options: consultantOptions, required: true }
                        ],
                        onSubmit: function (data) {
                            const consultationId = row.dataset.consultationId || '';
                            if (!consultationId) {
                                notify('Consultation row is missing an ID');
                                return;
                            }
                            updateConsultationRequestOnServer(consultationId, {
                                action: 'assign',
                                consultant_id: data.consultant_id
                            })
                                .then(() => window.location.reload())
                                .catch((error) => alert(error.message || 'Unable to assign the consultant.'));
                        }
                    });
                    return;
                }

                if (actionKey === 'view' || actionKey === 'product-view') {
                    if (page.id === 'content-blogs-page' || page.id === 'content-news-page') {
                        openViewModal((page.id === 'content-blogs-page' ? 'Blog Details - ' : 'News Details - ') + (row.children[1] ? row.children[1].textContent.trim() : 'Content'), [
                            { label: 'ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                            { label: 'Title', value: row.children[1] ? row.children[1].textContent.trim() : '-' },
                            { label: 'Content', value: row.children[2] ? row.children[2].textContent.trim() : '-' },
                            { label: 'Image', value: row.children[3] ? row.children[3].textContent.trim() : '-' },
                            { label: 'Category', value: row.children[4] ? row.children[4].textContent.trim() : '-' },
                            { label: 'Author', value: row.children[5] ? row.children[5].textContent.trim() : '-' },
                            { label: 'Date', value: row.children[6] ? row.children[6].textContent.trim() : '-' },
                            { label: 'Status', value: row.children[7] ? row.children[7].textContent.trim() : '-' }
                        ], 'CM');
                    } else if (page.id === 'content-faq-page') {
                        openViewModal('FAQ Details - ' + (row.children[0] ? row.children[0].textContent.trim() : 'FAQ'), [
                            { label: 'FAQ ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                            { label: 'Question', value: row.children[1] ? row.children[1].textContent.trim() : '-' },
                            { label: 'Answer', value: row.children[2] ? row.children[2].textContent.trim() : '-' },
                            { label: 'Group', value: row.children[3] ? row.children[3].textContent.trim() : '-' },
                            { label: 'Updated On', value: row.children[4] ? row.children[4].textContent.trim() : '-' }
                        ], 'FQ');
                    } else if (page.id === 'content-gold-price-page') {
                        openViewModal('Metal Price - ' + (row.children[1] ? row.children[1].textContent.trim() : 'Metal'), [
                            { label: 'Price ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                            { label: 'Metal', value: row.children[1] ? row.children[1].textContent.trim() : '-' },
                            { label: 'Symbol', value: row.children[2] ? row.children[2].textContent.trim() : '-' },
                            { label: 'Price / Troy Oz', value: row.children[3] ? row.children[3].textContent.trim() : '-' },
                            { label: 'Price / Gram', value: row.children[4] ? row.children[4].textContent.trim() : '-' },
                            { label: 'Adjusted / Gram', value: row.children[5] ? row.children[5].textContent.trim() : '-' },
                            { label: 'Quote Currency', value: row.children[6] ? row.children[6].textContent.trim() : '-' },
                            { label: 'Snapshot Date', value: row.children[7] ? row.children[7].textContent.trim() : '-' },
                            { label: 'Status', value: row.children[8] ? row.children[8].textContent.trim() : '-' }
                        ], 'AU');
                    } else if (page.id === 'contact-messages-page') {
                        openViewModal('Contact Message - ' + (row.children[1] ? row.children[1].textContent.trim() : 'Message'), [
                            { label: 'Message ID', value: row.dataset.messageId || (row.children[0] ? row.children[0].textContent.trim() : '-') },
                            { label: 'Name', value: row.dataset.name || (row.children[1] ? row.children[1].textContent.trim() : '-') },
                            { label: 'Email', value: row.dataset.email || (row.children[2] ? row.children[2].textContent.trim() : '-') },
                            { label: 'Date', value: row.dataset.date || (row.children[3] ? row.children[3].textContent.trim() : '-') },
                            { label: 'Message', value: row.dataset.message || (row.children[4] ? row.children[4].textContent.trim() : '-') },
                            { label: 'Status', value: row.dataset.status || (row.children[5] ? row.children[5].textContent.trim() : '-') },
                            { label: 'Subject', value: row.dataset.subject || (row.children[6] ? row.children[6].textContent.trim() : '-') },
                            { label: 'Reply', value: row.dataset.replyMessage || 'No reply has been sent yet.' },
                            { label: 'Replied By', value: row.dataset.replyBy || '-' },
                            { label: 'Replied At', value: row.dataset.replyDate || '-' }
                        ], 'CM');
                    } else if (page.id === 'users-customers-page') {
                        const customerFirstName = row.dataset.firstName || '';
                        const customerLastName = row.dataset.lastName || '';
                        const fullName = row.children[1] ? row.children[1].textContent.trim() : '-';
                        const email = row.children[2] ? row.children[2].textContent.trim() : '-';
                        const phone = row.children[3] ? row.children[3].textContent.trim() : '-';
                        const regDate = row.children[4] ? row.children[4].textContent.trim() : '-';
                        const status = row.children[5] ? row.children[5].textContent.trim() : '-';
                        const initials = fullName.split(' ').map(function (n) { return n.charAt(0); }).join('').slice(0, 2).toUpperCase();
                        openViewModal('Customer Details - ' + fullName, [
                            { label: 'Customer ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                            { label: 'First Name', value: customerFirstName || (fullName.split(' ')[0] || '-') },
                            { label: 'Last Name', value: customerLastName || (fullName.split(' ').slice(1).join(' ') || '-') },
                            { label: 'Email', value: email },
                            { label: 'Phone', value: phone },
                            { label: 'Status', value: status },
                            { label: 'Joined On', value: regDate },
                        ], initials);
                    } else if (page.id === 'users-consultants-page') {
                        const firstName = row.dataset.firstName || '';
                        const lastName = row.dataset.lastName || '';
                        const name = row.children[1] ? row.children[1].textContent.trim() : '-';
                        const email = row.children[2] ? row.children[2].textContent.trim() : '-';
                        const phone = row.children[3] ? row.children[3].textContent.trim() : '-';
                        const assigned = row.children[4] ? row.children[4].textContent.trim() : '0';
                        const accountStatus = row.dataset.status || 'Active';
                        const initials = name.split(' ').map(function (n) { return n.charAt(0); }).join('').slice(0, 2).toUpperCase();
                        openViewModal('Consultant Details - ' + name, [
                            { label: 'Consultant ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                            { label: 'First Name', value: firstName || (name.split(' ')[0] || '-') },
                            { label: 'Last Name', value: lastName || (name.split(' ').slice(1).join(' ') || '-') },
                            { label: 'Email', value: email },
                            { label: 'Phone', value: phone },
                            { label: 'Status', value: accountStatus },
                            { label: 'Consultations', value: assigned },
                        ], initials);
                    } else if (page.id === 'users-admins-page') {
                        const firstName = row.dataset.firstName || '';
                        const lastName = row.dataset.lastName || '';
                        const name = row.children[1] ? row.children[1].textContent.trim() : '-';
                        const email = row.children[2] ? row.children[2].textContent.trim() : '-';
                        const phone = row.children[3] ? row.children[3].textContent.trim() : '-';
                        const role = row.children[4] ? row.children[4].textContent.trim() : '-';
                        const updatedOn = row.children[5] ? row.children[5].textContent.trim() : '-';
                        const status = row.children[6] ? row.children[6].textContent.trim() : '-';
                        const initials = name.split(' ').map(function (n) { return n.charAt(0); }).join('').slice(0, 2).toUpperCase();
                        openViewModal('Admin Details - ' + name, [
                            { label: 'Admin ID', value: row.children[0] ? row.children[0].textContent.trim() : '-' },
                            { label: 'First Name', value: firstName || (name.split(' ')[0] || '-') },
                            { label: 'Last Name', value: lastName || (name.split(' ').slice(1).join(' ') || '-') },
                            { label: 'Email', value: email },
                            { label: 'Phone', value: phone },
                            { label: 'Status', value: status },
                            { label: 'Role', value: role },
                            { label: 'Updated On', value: updatedOn },
                            { label: 'Permissions', value: (row.dataset.permissions || (role === 'Admin' ? 'All permissions' : 'Scoped access')).replace(/,/g, ', ') }
                        ], initials);
                    } else if (page.id === 'products-all-page') {
                        const productId = row.dataset.productDbId;
                        const fallbackProductName = row.children[1] ? row.children[1].textContent.trim() : '-';
                        const fallbackCategory = row.children[2] ? row.children[2].textContent.trim() : '-';
                        const fallbackStock = row.children[5] ? row.children[5].textContent.trim() : '0';
                        const fallbackStatus = row.children[6] ? row.children[6].textContent.trim() : '-';
                        const fallbackPrice = row.children[3] ? row.children[3].textContent.trim() : '-';
                        const fallbackPricingMode = row.children[4] ? row.children[4].textContent.trim() : '-';
                        const fallbackIsGemProduct = String(fallbackCategory || '').trim().toLowerCase() === 'gems';
                        const fallbackDetails = {
                            product_id: row.children[0] ? row.children[0].textContent.trim() : '-',
                            name: fallbackProductName,
                            category: fallbackCategory,
                            gem_type: row.dataset.gemType || '-',
                            color: row.dataset.color || '-',
                            shape: row.dataset.shape || '-',
                            carat_weight: row.dataset.caratWeight || '-',
                            metal: row.dataset.metal || '-',
                            price: fallbackPrice,
                            pricing_mode: fallbackPricingMode,
                            stock: fallbackStock,
                            status: fallbackStatus,
                            description: row.dataset.description || 'Premium quality product with certified authenticity.',
                            main_image: row.dataset.mainImage || 'Not set',
                            is_gem: fallbackIsGemProduct
                        };

                        const renderProductDetails = function (product) {
                            const categoryName = String(product.category || '').trim().toLowerCase();
                            const isGemProduct = categoryName === 'gems';
                            const isCollectionProduct = categoryName === 'collections';
                            const title = product.name || fallbackProductName;
                            const initials = String(title || '').split(' ').map(function (n) { return n.charAt(0); }).join('').slice(0, 2).toUpperCase();
                            const productDetails = [
                                { label: 'Product ID', value: product.product_id || '-' },
                                { label: 'Category', value: product.category || '-' },
                                { label: isGemProduct ? 'Gem Type' : (isCollectionProduct ? 'Collection' : 'Jewellery Type'), value: product.gem_type || '-' },
                            ];

                            if (isGemProduct) {
                                productDetails.push(
                                    { label: 'Color', value: product.color || '-' },
                                    { label: 'Shape', value: product.shape || '-' },
                                    { label: 'Carat Weight', value: product.carat_weight || '-' }
                                );
                            } else if (isCollectionProduct) {
                                productDetails.push(
                                    { label: 'Occasion', value: product.collection_occasion || product.occasion || '-' },
                                    { label: 'Gender', value: product.collection_gender || product.gender || '-' },
                                    { label: 'Gemstone', value: product.collection_gemstone || product.gemstone || '-' },
                                    { label: 'Metal', value: product.collection_metal || product.metal || '-' }
                                );
                            } else {
                                productDetails.push(
                                    { label: 'Metal', value: product.metal || '-' },
                                    { label: 'Pricing Mode', value: product.pricing_mode || '-' }
                                );
                            }

                            productDetails.push(
                                { label: 'Price', value: product.price || '-' },
                                { label: 'Stock', value: product.stock || '0' },
                                { label: 'Status', value: product.status || '-' },
                                { label: 'Description', value: product.description || '-' },
                                { label: 'Main Image', value: product.main_image || 'Not set' },
                            );

                            openViewModal('Product Details - ' + title, productDetails, initials);
                        };

                        if (!productId) {
                            renderProductDetails(fallbackDetails);
                            return;
                        }

                        fetch(adminProductDetailsBase + '/' + productId, {
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            }
                        }).then(function (response) {
                            return response.json().then(function (payload) {
                                if (!response.ok) {
                                    throw new Error(payload.message || 'Unable to load product details.');
                                }
                                return payload;
                            });
                        }).then(function (payload) {
                            renderProductDetails(payload.product || fallbackDetails);
                        }).catch(function () {
                            renderProductDetails(fallbackDetails);
                        });
                    } else {
                        openViewModal('Record Details', [
                            { label: 'Primary', value: row.children[1] ? row.children[1].textContent.trim() : (row.children[0] ? row.children[0].textContent.trim() : '-') },
                            { label: 'Email / Reference', value: row.children[2] ? row.children[2].textContent.trim() : '-' },
                            { label: 'Status', value: row.textContent.includes('Active') ? 'Active' : 'Updated' }
                        ], '');
                    }
                    return;
                }

                if (actionKey === 'edit' || actionKey === 'edit role' || actionKey === 'product-edit') {
                    if (page.id === 'content-blogs-page' || page.id === 'content-news-page') {
                        const isBlog = page.id === 'content-blogs-page';
                        openFormModal({
                            title: isBlog ? 'Edit Blog' : 'Edit News',
                            fields: [
                                { name: 'title', label: 'Title', required: true, value: row.children[1].textContent.trim() },
                                { name: 'content', label: 'Content', required: true, value: row.children[2].textContent.trim() },
                                { name: 'image', label: 'Image', required: true, value: row.children[3].textContent.trim() },
                                { name: 'category', label: 'Category', type: 'select', options: isBlog ? ['Gem Education', 'Zodiac', 'Luxury Stories'] : ['Collection Launch', 'Promotion', 'Event Update'] },
                                { name: 'author', label: 'Author', required: true, value: row.children[5].textContent.trim() },
                                { name: 'date', label: 'Date', type: 'date', required: true, value: row.children[6].textContent.trim() },
                                { name: 'status', label: 'Status', type: 'select', options: ['Published', 'Draft'] }
                            ],
                            onSubmit: function (data) {
                                row.children[1].textContent = data.title;
                                row.children[2].textContent = data.content;
                                row.children[3].textContent = data.image;
                                row.children[4].textContent = data.category;
                                row.children[5].textContent = data.author;
                                row.children[6].textContent = data.date;
                                row.children[7].innerHTML = '<span class="status ' + statusClassFromText(data.status) + '">' + data.status + '</span>';
                                const toggleBtn = Array.from(row.querySelectorAll('.mini-btn')).find(function (btn) {
                                    const text = btn.textContent.trim();
                                    return text === 'Publish' || text === 'Unpublish';
                                });
                                if (toggleBtn) toggleBtn.textContent = data.status === 'Published' ? 'Unpublish' : 'Publish';
                                notify((isBlog ? 'Blog' : 'News') + ' updated');
                            }
                        });
                        const categorySelect = formModalFields.querySelector('select[name="category"]');
                        const statusSelect = formModalFields.querySelector('select[name="status"]');
                        if (categorySelect) categorySelect.value = row.children[4].textContent.trim();
                        if (statusSelect) statusSelect.value = row.children[7].textContent.trim();
                        return;
                    }

                    if (page.id === 'content-faq-page') {
                        openFormModal({
                            title: 'Edit FAQ',
                            fields: [
                                { name: 'question', label: 'Question', required: true, value: row.children[1].textContent.trim() },
                                { name: 'answer', label: 'Answer', required: true, value: row.children[2].textContent.trim() },
                                { name: 'group', label: 'Group', type: 'select', options: ['Orders', 'Custom Jewellery', 'Consultation', 'Payments'] },
                                { name: 'date', label: 'Updated On', type: 'date', required: true, value: row.children[4].textContent.trim() }
                            ],
                            onSubmit: function (data) {
                                row.children[1].textContent = data.question;
                                row.children[2].textContent = data.answer;
                                row.children[3].textContent = data.group;
                                row.children[4].textContent = data.date;
                                notify('FAQ updated');
                            }
                        });
                        const groupSelect = formModalFields.querySelector('select[name="group"]');
                        if (groupSelect) groupSelect.value = row.children[3].textContent.trim();
                        return;
                    }

                    if (page.id === 'users-customers-page') {
                        const customerFirstName = row.dataset.firstName || (row.children[1] ? String(row.children[1].textContent.trim()).split(' ')[0] : '');
                        const customerLastName = row.dataset.lastName || (row.children[1] ? String(row.children[1].textContent.trim()).split(' ').slice(1).join(' ') : '');
                        openFormModal({
                            title: 'Edit Customer',
                            fields: [
                                { name: 'first_name', label: 'First Name', required: true, value: customerFirstName },
                                { name: 'last_name', label: 'Last Name', required: true, value: customerLastName },
                                { name: 'email', label: 'Email', type: 'email', required: true, value: row.children[2].textContent.trim() },
                                { name: 'phone', label: 'Phone', required: true, value: row.children[3].textContent.trim() },
                                { name: 'birth_date', label: 'Birthday', type: 'date', required: true, value: row.dataset.birthDate || '' },
                                { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive', 'Blocked'] }
                            ],
                            onSubmit: function (data) {
                                const firstName = String(data.first_name || '').trim();
                                const lastName = String(data.last_name || '').trim();
                                const displayName = (firstName + ' ' + lastName).trim() || 'Customer';
                                return submitUserManagementAction({
                                    action: 'update',
                                    user_id: row.dataset.userDbId,
                                    first_name: firstName,
                                    last_name: lastName,
                                    email: data.email,
                                    phone: data.phone,
                                    birth_date: data.birth_date,
                                    status: data.status
                                }).then(function () {
                                    row.dataset.firstName = firstName;
                                    row.dataset.lastName = lastName;
                                    row.dataset.birthDate = data.birth_date || '';
                                    row.children[1].textContent = displayName;
                                    row.children[2].textContent = data.email;
                                    row.children[3].textContent = data.phone;
                                    row.dataset.status = data.status;
                                    row.children[5].innerHTML = '<span class="status ' + statusClassFromText(data.status) + '">' + data.status + '</span>';
                                    const blockBtn = Array.from(row.querySelectorAll('.mini-btn')).find(function (btn) {
                                        const t = btn.textContent.trim();
                                        return t === 'Block' || t === 'Unblock';
                                    });
                                    if (blockBtn) blockBtn.textContent = data.status === 'Blocked' ? 'Unblock' : 'Block';
                                    notify('Customer updated');
                                });
                            }
                        });
                        const statusSelect = formModalFields.querySelector('select[name="status"]');
                        if (statusSelect) statusSelect.value = row.children[5].textContent.trim();
                        return;
                    }

                    if (page.id === 'users-consultants-page') {
                        const consultantFirstName = row.dataset.firstName || (row.children[1] ? String(row.children[1].textContent.trim()).split(' ')[0] : '');
                        const consultantLastName = row.dataset.lastName || (row.children[1] ? String(row.children[1].textContent.trim()).split(' ').slice(1).join(' ') : '');
                        openFormModal({
                            title: 'Edit Consultant',
                            fields: [
                                { name: 'first_name', label: 'First Name', required: true, value: consultantFirstName },
                                { name: 'last_name', label: 'Last Name', required: true, value: consultantLastName },
                                { name: 'email', label: 'Email', type: 'email', required: true, value: row.children[2].textContent.trim() },
                                { name: 'phone', label: 'Phone', required: true, value: row.children[3].textContent.trim() },
                                { name: 'birth_date', label: 'Birthday', type: 'date', required: true, value: row.dataset.birthDate || '' },
                                { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive', 'Blocked'] }
                            ],
                            onSubmit: function (data) {
                                const firstName = String(data.first_name || '').trim();
                                const lastName = String(data.last_name || '').trim();
                                const displayName = (firstName + ' ' + lastName).trim() || 'Consultant';
                                return submitUserManagementAction({
                                    action: 'update',
                                    user_id: row.dataset.userDbId,
                                    first_name: firstName,
                                    last_name: lastName,
                                    email: data.email,
                                    phone: data.phone,
                                    birth_date: data.birth_date,
                                    status: data.status
                                }).then(function () {
                                    row.dataset.firstName = firstName;
                                    row.dataset.lastName = lastName;
                                    row.dataset.birthDate = data.birth_date || '';
                                    row.children[1].textContent = displayName;
                                    row.children[2].textContent = data.email;
                                    row.children[3].textContent = data.phone;
                                    row.dataset.status = data.status;
                                    row.children[5].innerHTML = '<span class="status ' + statusClassFromText(data.status) + '">' + data.status + '</span>';
                                    notify('Consultant updated');
                                });
                            }
                        });
                        const statusSelect = formModalFields.querySelector('select[name="status"]');
                        if (statusSelect) statusSelect.value = row.dataset.status || 'Active';
                        return;
                    }

                    if (page.id === 'users-admins-page') {
                        const adminFirstName = row.dataset.firstName || (row.children[1] ? String(row.children[1].textContent.trim()).split(' ')[0] : '');
                        const adminLastName = row.dataset.lastName || (row.children[1] ? String(row.children[1].textContent.trim()).split(' ').slice(1).join(' ') : '');
                        openFormModal({
                            title: 'Edit Admin User',
                            fields: [
                                { name: 'first_name', label: 'First Name', required: true, value: adminFirstName },
                                { name: 'last_name', label: 'Last Name', required: true, value: adminLastName },
                                { name: 'email', label: 'Email', type: 'email', required: true, value: row.children[2].textContent.trim() },
                                { name: 'phone', label: 'Phone', required: true, value: row.children[3].textContent.trim() },
                                { name: 'birth_date', label: 'Birthday', type: 'date', required: true, value: row.dataset.birthDate || '' },
                                { name: 'role', label: 'Role', type: 'select', options: ['Admin', 'Lower Admin', 'Content Manager'] },
                                { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive', 'Blocked'] }
                            ],
                            onSubmit: function (data) {
                                const roleKey = data.role === 'Admin' ? 'admin' : (data.role === 'Lower Admin' ? 'lower_admin' : 'content_manager');
                                const firstName = String(data.first_name || '').trim();
                                const lastName = String(data.last_name || '').trim();
                                const displayName = (firstName + ' ' + lastName).trim() || 'Admin';
                                return submitUserManagementAction({
                                    action: 'update',
                                    user_id: row.dataset.userDbId,
                                    first_name: firstName,
                                    last_name: lastName,
                                    email: data.email,
                                    phone: data.phone,
                                    birth_date: data.birth_date,
                                    status: data.status,
                                    role: roleKey
                                }).then(function (result) {
                                    const resolvedPermissions = roleKey === 'admin' ? ['All permissions'] : defaultPermissionsForRole(roleKey);
                                    row.dataset.firstName = firstName;
                                    row.dataset.lastName = lastName;
                                    row.dataset.birthDate = data.birth_date || '';
                                    row.children[1].textContent = displayName;
                                    row.children[2].textContent = data.email;
                                    row.children[3].textContent = data.phone;
                                    row.children[4].textContent = data.role;
                                    row.dataset.roleKey = roleKey;
                                    row.dataset.permissions = resolvedPermissions.join(',');
                                    row.dataset.initials = displayName.split(' ').map(function (part) { return part.charAt(0); }).join('').slice(0, 2).toUpperCase();
                                    row.children[5].textContent = new Date().toISOString().slice(0, 16).replace('T', ' ');
                                    row.dataset.updatedOn = row.children[5].textContent.trim();
                                    row.children[6].innerHTML = '<span class="status ' + statusClassFromText(data.status) + '">' + data.status + '</span>';
                                    const roleRow = document.querySelector('#users-roles-page tr[data-role="' + roleKey + '"]');
                                    if (roleRow) {
                                        roleRow.dataset.permissions = resolvedPermissions.join(',');
                                        const summary = roleRow.querySelector('.perm-summary');
                                        if (summary) summary.textContent = roleKey === 'admin' ? 'All enabled' : (resolvedPermissions.length + ' enabled');
                                    }
                                    notify('Admin updated');
                                });
                            }
                        });
                        const roleSelect = formModalFields.querySelector('select[name="role"]');
                        const statusSelect = formModalFields.querySelector('select[name="status"]');
                        if (roleSelect) roleSelect.value = row.children[4].textContent.trim();
                        if (statusSelect) statusSelect.value = row.children[6].textContent.trim();
                        return;
                    }

                    if (page.id === 'users-roles-page') {
                        openFormModal({
                            title: 'Edit Role',
                            fields: [
                                { name: 'role', label: 'Role Name', required: true, value: row.children[0].textContent.trim() },
                                { name: 'description', label: 'Description', required: true, value: row.children[1].textContent.trim() },
                                { name: 'permissions', label: 'Permissions Matrix', type: 'permissions', options: permissionCatalog, checkedOptions: (row.dataset.permissions || '').split(',').map(function (p) { return p.trim(); }).filter(Boolean) }
                            ],
                            onSubmit: function (data) {
                                const permissions = Array.isArray(data.permissions) ? data.permissions : (data.permissions ? [data.permissions] : []);
                                const roleKey = data.role.toLowerCase().replace(/\s+/g, '_');
                                if (roleKey === 'admin') {
                                    notify('Admin permissions are managed on the user rows');
                                    return;
                                }
                                return fetch(permissionUpdateRoute, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': @json(csrf_token()),
                                        'Accept': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        role: roleKey,
                                        permissions: permissions
                                    }),
                                }).then(function (response) {
                                    return response.json().then(function (dataResult) {
                                        if (!response.ok) {
                                            throw new Error(dataResult?.message || 'Unable to update permissions.');
                                        }
                                        return dataResult;
                                    });
                                }).then(function (result) {
                                    row.children[0].textContent = data.role;
                                    row.children[1].textContent = data.description;
                                    row.dataset.role = roleKey;
                                    row.dataset.permissions = (result.permissions || permissions).join(',');
                                    row.children[2].querySelector('.perm-summary').textContent = (result.permissions || permissions).length + ' enabled';
                                    const adminRows = document.querySelectorAll('#users-admins-page tr[data-role-key="' + roleKey + '"]');
                                    adminRows.forEach(function (adminRow) {
                                        adminRow.dataset.permissions = (result.permissions || permissions).join(',');
                                    });
                                    if (roleKey === currentAdminRole) {
                                        syncCurrentAdminAccess(roleKey, result.permissions || permissions);
                                    }
                                    notify('Role updated');
                                });
                            }
                        });
                        return;
                    }

                    if (page.id === 'products-categories-page') {
                        openFormModal({
                            title: 'Edit Jewellery Type',
                            fields: [
                                { name: 'name', label: 'Jewellery Type Name', required: true, value: row.children[0].textContent.trim() }
                            ],
                            onSubmit: function (data) {
                                return fetch(adminCategoryManageRoute, {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        action: 'update',
                                        type_id: row.dataset.typeId,
                                        name: data.name
                                    }),
                                }).then(function (response) {
                                    return response.json().then(function (payload) {
                                        if (!response.ok) {
                                            throw new Error(payload.message || 'Unable to update jewellery type.');
                                        }
                                        return payload;
                                    });
                                }).then(function (payload) {
                                    notify(payload.message || 'Jewellery type updated successfully');
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 250);
                                }).catch(function (error) {
                                    notify(error.message || 'Unable to update jewellery type');
                                });
                            }
                        });
                        return;
                    }

                    if (page.id === 'products-all-page') {
                        openFormModal({
                                title: 'Edit Product',
                                fields: [
                                    { name: 'name', label: 'Product Name', required: true, value: row.children[1].textContent.trim() },
                                    { name: 'category', label: 'Product Category', type: 'select', options: productCategorySelectOptions },
                                { name: 'gem_type', label: 'Gem Type', type: 'select', options: ['', ...gemTypeOptions], required: false, value: row.dataset.gemType || '' },
                                { name: 'color', label: 'Color', required: false, value: row.dataset.color || '' },
                                { name: 'shape', label: 'Shape', required: false, value: row.dataset.shape || '' },
                                { name: 'carat_weight', label: 'Carat Weight', type: 'number', required: false, value: row.dataset.caratWeight || '' },
                                { name: 'jewellery_type', label: 'Jewellery Type', type: 'select', options: ['', ...jewelleryTypeOptions], required: false, value: row.dataset.jewelleryType || '' },
                                    { name: 'occasion', label: 'Occasion', required: false, value: row.dataset.occasion || '' },
                                    { name: 'gender', label: 'Gender', type: 'select', options: ['', 'Men', 'Women', 'Unisex'], required: false, value: row.dataset.gender || '' },
                                    { name: 'gemstone', label: 'Gemstone', required: false, value: row.dataset.gemstone || '' },
                                    { name: 'metal', label: 'Metal', required: false, value: row.dataset.metal || '' },
                                    { name: 'metal_purity', label: 'Metal Purity', required: false, value: row.dataset.metalPurity || '' },
                                    { name: 'metal_weight', label: 'Metal Weight (g)', type: 'number', required: false, value: row.dataset.metalWeight || '' },
                                { name: 'making_charge', label: 'Making Charge', type: 'number', required: false, value: row.dataset.makingCharge || '' },
                                { name: 'wastage', label: 'Wastage %', type: 'number', required: false, value: row.dataset.wastage || '' },
                                { name: 'market_factor', label: 'Market Factor', type: 'number', required: false, value: row.dataset.marketFactor || '0.80' },
                                { name: 'pricing_mode', label: 'Pricing Mode', type: 'select', options: ['dynamic', 'static'], required: false, value: row.dataset.pricingMode && row.dataset.pricingMode !== '-' ? row.dataset.pricingMode : 'dynamic' },
                                { name: 'size_label', label: 'Size Label', required: false, value: row.dataset.sizeLabel || '' },
                                { name: 'size_options', label: 'Available Sizes', required: false, value: row.dataset.sizeOptions || '' },
                                { name: 'price', label: 'Fallback Price', type: 'number', step: '0.01', min: 0, required: true, value: row.dataset.fallbackPrice || extractNumericText(row.children[3] ? row.children[3].textContent : '') },
                                { name: 'stock', label: 'Stock', type: 'number', required: true, value: row.children[5].textContent.trim() },
                                { name: 'description', label: 'Description', required: false, value: row.dataset.description || '' },
                                { name: 'main_image', label: 'Replace Main Image', type: 'file', accept: 'image/*', required: false }
                            ],
                            onSubmit: function (data) {
                                const payload = new FormData();
                                payload.append('_token', csrfToken);
                                payload.append('action', 'update');
                                payload.append('product_id', row.dataset.productDbId);
                                payload.append('name', data.name);
                                payload.append('category', data.category);
                                payload.append('gem_type', data.gem_type || '');
                                payload.append('jewellery_type', data.jewellery_type || '');
                                payload.append('occasion', data.occasion || '');
                                payload.append('gender', data.gender || '');
                                payload.append('gemstone', data.gemstone || '');
                                payload.append('color', data.color || '');
                                payload.append('shape', data.shape || '');
                                payload.append('carat_weight', data.carat_weight || '');
                                payload.append('metal', data.metal || '');
                                payload.append('metal_purity', data.metal_purity || '');
                                payload.append('metal_weight', data.metal_weight || '');
                                payload.append('making_charge', data.making_charge || '');
                                payload.append('wastage', data.wastage || '');
                                payload.append('market_factor', data.market_factor || '0.80');
                                payload.append('pricing_mode', data.pricing_mode || 'dynamic');
                                payload.append('size_label', data.size_label || '');
                                payload.append('size_options', data.size_options || '');
                                payload.append('price', data.price);
                                payload.append('stock', data.stock);
                                payload.append('description', data.description || '');
                                if (data.main_image && data.main_image.files && data.main_image.files[0]) {
                                    payload.append('main_image', data.main_image.files[0]);
                                }
                                return fetch(adminProductManageRoute, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json',
                                    },
                                    body: payload,
                                }).then(function (response) {
                                    return response.json().then(function (payload) {
                                        if (!response.ok) {
                                            throw new Error(payload.message || 'Unable to update product.');
                                        }
                                        return payload;
                                    });
                                }).then(function (payload) {
                                    const product = payload.product || {};
                                    row.children[0].textContent = product.product_id || row.children[0].textContent;
                                    row.children[1].textContent = product.name || data.name;
                                    row.children[2].textContent = product.category || data.category;
                                    row.children[3].textContent = product.price || ('LKR ' + Number(data.price || 0).toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                    row.children[4].textContent = product.pricing_mode || '-';
                                    row.children[5].textContent = product.stock || data.stock;
                                    row.children[6].innerHTML = '<span class="status ' + statusClassFromText(product.status || data.status) + '">' + (product.status || data.status) + '</span>';
                                    row.dataset.mainImage = product.main_image || row.dataset.mainImage || '';
                                    row.dataset.priceValue = product.price_value || data.price || '';
                                    row.dataset.fallbackPrice = product.fallback_price || data.price || '';
                                    row.dataset.sizeLabel = product.size_label || data.size_label || '';
                                    row.dataset.sizeOptions = product.size_options || data.size_options || '';
                                const normalizedCategory = String(data.category || '').trim().toLowerCase();
                                const isGem = normalizedCategory === 'gems';
                                const isCollection = normalizedCategory === 'collections';
                                row.dataset.gemType = isGem ? (data.gem_type || '') : '';
                                row.dataset.jewelleryType = isGem || isCollection ? '' : (data.jewellery_type || '');
                                row.dataset.color = isGem ? (data.color || '') : '';
                                row.dataset.shape = isGem ? (data.shape || '') : '';
                                row.dataset.caratWeight = isGem ? (data.carat_weight || '') : '';
                                row.dataset.metal = isGem ? '' : (data.metal || '');
                                row.dataset.metalPurity = isGem || isCollection ? '' : (data.metal_purity || '');
                                row.dataset.occasion = isGem ? '' : (data.occasion || '');
                                row.dataset.gender = isGem ? '' : (data.gender || '');
                                row.dataset.gemstone = isGem ? '' : (data.gemstone || '');
                                row.dataset.metalWeight = isGem || isCollection ? '' : (data.metal_weight || '');
                                row.dataset.makingCharge = isGem || isCollection ? '' : (data.making_charge || '');
                                row.dataset.wastage = isGem || isCollection ? '' : (data.wastage || '');
                                row.dataset.marketFactor = isGem || isCollection ? '' : (data.market_factor || '0.80');
                                row.dataset.pricingMode = isCollection ? 'Static' : (isGem ? '-' : (data.pricing_mode || 'dynamic'));
                                row.dataset.description = data.description || '';
                                    notify(payload.message || 'Product updated');
                                });
                            }
                        });
                        const categorySelect = formModalFields.querySelector('select[name="category"]');
                        const pricingModeSelect = formModalFields.querySelector('select[name="pricing_mode"]');
                        const statusSelect = formModalFields.querySelector('select[name="status"]');
                        if (categorySelect) categorySelect.value = row.children[2].textContent.trim();
                        if (pricingModeSelect) pricingModeSelect.value = row.dataset.pricingMode && row.dataset.pricingMode !== '-' ? String(row.dataset.pricingMode).toLowerCase() : 'dynamic';
                        if (statusSelect) statusSelect.value = row.children[6].textContent.trim();
                        setEditProductVisibility(formModalFields, categorySelect ? categorySelect.value : '');
                        if (categorySelect) {
                            categorySelect.addEventListener('change', function () {
                                setEditProductVisibility(formModalFields, categorySelect.value);
                            });
                        }
                        return;
                    }

                    notify('Edit not available for this row');
                    return;
                }

                if (actionKey === 'role') {
                    if (page.id !== 'users-admins-page' || !row) {
                        notify('Role update is available in Admin Users');
                        return;
                    }
                        openFormModal({
                            title: 'Update Admin Role',
                            fields: [
                                { name: 'role', label: 'Role', type: 'select', options: ['Admin', 'Lower Admin', 'Content Manager'] },
                                { name: 'status', label: 'Status', type: 'select', options: ['Active', 'Inactive', 'Blocked'] }
                            ],
                            onSubmit: function (data) {
                                const roleKey = data.role === 'Admin' ? 'admin' : (data.role === 'Lower Admin' ? 'lower_admin' : 'content_manager');
                                return submitUserManagementAction({
                                    action: 'role',
                                    user_id: row.dataset.userDbId,
                                    role: roleKey,
                                    status: data.status
                                }).then(function (result) {
                                    const resolvedPermissions = roleKey === 'admin' ? ['All permissions'] : defaultPermissionsForRole(roleKey);
                                    row.children[4].textContent = data.role;
                                    row.dataset.roleKey = roleKey;
                                    row.dataset.permissions = resolvedPermissions.join(',');
                                    row.children[5].textContent = new Date().toISOString().slice(0, 16).replace('T', ' ');
                                    row.dataset.updatedOn = row.children[5].textContent.trim();
                                    const savedStatus = result.status || data.status;
                                    row.dataset.status = savedStatus;
                                    row.children[6].innerHTML = '<span class="status ' + statusClassFromText(savedStatus) + '">' + savedStatus + '</span>';
                                    if (String(row.dataset.userDbId || '') === String(currentAdminUserId || '')) {
                                        syncCurrentAdminAccess(roleKey, resolvedPermissions);
                                    }
                                    notify('Role updated');
                                });
                        }
                    });
                    const roleSelect = formModalFields.querySelector('select[name="role"]');
                    const statusSelect = formModalFields.querySelector('select[name="status"]');
                    if (roleSelect) roleSelect.value = row.children[4].textContent.trim();
                    if (statusSelect) statusSelect.value = row.children[6].textContent.trim();
                    return;
                }

                if (actionKey === 'block' || actionKey === 'unblock') {
                    const next = actionKey === 'block' ? 'Blocked' : 'Active';
                    submitUserManagementAction({
                        action: 'block',
                        user_id: row.dataset.userDbId
                    }).then(function (result) {
                        const updatedStatus = result.status || next;
                        if (page && page.id === 'users-consultants-page') {
                            row.dataset.status = updatedStatus;
                            if (row.children[5]) {
                                row.children[5].innerHTML = '<span class="status ' + statusClassFromText(updatedStatus) + '">' + updatedStatus + '</span>';
                            }
                            notify('Consultant status updated');
                        } else if (page && page.id === 'users-admins-page') {
                            row.dataset.status = updatedStatus;
                            if (row.children[6]) {
                                row.children[6].innerHTML = '<span class="status ' + statusClassFromText(updatedStatus) + '">' + updatedStatus + '</span>';
                            }
                            notify('Admin status updated');
                        } else {
                            setStatusBadge(row, 5, updatedStatus);
                            notify('Customer status updated');
                        }
                        button.textContent = updatedStatus === 'Blocked' ? 'Unblock' : 'Block';
                        button.dataset.userAction = updatedStatus === 'Blocked' ? 'unblock' : 'block';
                        row.dataset.status = updatedStatus;
                    }).catch(function (error) {
                        notify(error.message || 'Unable to update status');
                    });
                    return;
                }

                if (actionKey === 'delete' || actionKey === 'product-delete') {
                    const contentPage = page && (page.id === 'content-blogs-page' || page.id === 'content-news-page' || page.id === 'content-faq-page');
                    const contentKind = contentPage ? (row.dataset.contentKind || (page.id === 'content-blogs-page' ? 'blog post' : (page.id === 'content-news-page' ? 'news post' : 'FAQ entry'))) : '';
                    openConfirmModal({
                        title: contentPage ? 'Delete Content' : 'Delete Record',
                        message: contentPage
                            ? 'Are you sure you want to delete this ' + contentKind + '? This action cannot be undone.'
                            : 'Are you sure you want to delete this record? This action cannot be undone.',
                        confirmLabel: 'Delete'
                    }, function () {
                        if (page && (page.id === 'content-blogs-page' || page.id === 'content-news-page' || page.id === 'content-faq-page') && row.dataset.deleteUrl) {
                            fetch(row.dataset.deleteUrl, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                            }).then(function (response) {
                                if (!response.ok) {
                                    throw new Error('Unable to delete content item.');
                                }
                                return response;
                            }).then(function () {
                                row.remove();
                                notify((contentKind.charAt(0).toUpperCase() + contentKind.slice(1)) + ' deleted successfully');
                            }).catch(function (error) {
                                notify(error.message || 'Unable to delete content item');
                            });
                            return;
                        }

                        if (page && page.id === 'content-faq-page' && !row.dataset.deleteUrl) {
                            row.remove();
                            notify('FAQ deleted successfully');
                            return;
                        }

                        if (page && page.id === 'contact-messages-page' && row.dataset.messageId) {
                            fetch(contactMessageApiBase + '/' + encodeURIComponent(row.dataset.messageId), {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                            }).then(function (response) {
                                return response.json().then(function (payload) {
                                    if (!response.ok) {
                                        throw new Error(payload.message || 'Unable to delete contact message.');
                                    }
                                    return payload;
                                });
                            }).then(function (payload) {
                                row.remove();
                                ensureContactMessageEmptyState();
                                updateContactMessageSummary();
                                notify(payload.message || 'Contact message deleted successfully');
                            }).catch(function (error) {
                                notify(error.message || 'Unable to delete contact message');
                            });
                            return;
                        }

                        if (page && page.id === 'products-all-page' && row.dataset.productDbId) {
                            fetch(adminProductManageRoute, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    action: 'delete',
                                    product_id: row.dataset.productDbId
                                }),
                            }).then(function (response) {
                                return response.json().then(function (payload) {
                                    if (!response.ok) {
                                        throw new Error(payload.message || 'Unable to delete product.');
                                    }
                                    return payload;
                                });
                            }).then(function (payload) {
                                row.remove();
                                notify(payload.message || 'Product deleted successfully');
                            }).catch(function (error) {
                                notify(error.message || 'Unable to delete product');
                            });
                            return;
                        }

                        if (page && page.id === 'products-categories-page' && row.dataset.typeId) {
                            fetch(adminCategoryManageRoute, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    action: 'delete',
                                    type_id: row.dataset.typeId
                                }),
                            }).then(function (response) {
                                return response.json().then(function (payload) {
                                    if (!response.ok) {
                                        throw new Error(payload.message || 'Unable to delete jewellery type.');
                                    }
                                    return payload;
                                });
                            }).then(function (payload) {
                                notify(payload.message || 'Jewellery type deleted successfully');
                                setTimeout(function () {
                                    window.location.reload();
                                }, 250);
                            }).catch(function (error) {
                                notify(error.message || 'Unable to delete jewellery type');
                            });
                            return;
                        }

                        submitUserManagementAction({
                            action: 'delete',
                            user_id: row.dataset.userDbId
                        }).then(function () {
                            row.remove();
                            notify('Record deleted');
                        }).catch(function (error) {
                            notify(error.message || 'Unable to delete record');
                        });
                    });
                }
            });

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

                document.addEventListener('keydown', function (event) {
                    if (event.key === 'Escape') {
                        profileWrap.classList.remove('open');
                        profileToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            const contactMessageApiBase = @json(url('/admin/contact-messages'));
            const contactMessagesTableBody = document.getElementById('contactMessagesTableBody');
            const contactSummaryTotal = document.getElementById('contactSummaryTotal');
            const contactSummaryUnread = document.getElementById('contactSummaryUnread');
            const contactSummaryRead = document.getElementById('contactSummaryRead');
            const contactSummaryReplied = document.getElementById('contactSummaryReplied');

            function escapeContactValue(value) {
                return String(value || '')
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;');
            }

            function getContactMessageRows() {
                if (!contactMessagesTableBody) return [];
                return Array.from(contactMessagesTableBody.querySelectorAll('tr[data-generated="contact-message"]'));
            }

            function ensureContactMessageEmptyState() {
                if (!contactMessagesTableBody) return;
                const dataRows = getContactMessageRows();
                const existingEmptyRow = contactMessagesTableBody.querySelector('tr[data-empty-contact="true"]');
                if (!dataRows.length) {
                    if (!existingEmptyRow) {
                        contactMessagesTableBody.innerHTML = '<tr data-empty-contact="true"><td colspan="8" style="text-align:center;color:var(--muted);padding:24px;">No contact messages have been sent yet.</td></tr>';
                    }
                    return;
                }
                if (existingEmptyRow) existingEmptyRow.remove();
            }

            function updateContactMessageSummary() {
                const rows = getContactMessageRows();
                const statuses = rows.map(function (row) {
                    return row.dataset.status || 'Unread';
                });
                if (contactSummaryTotal) contactSummaryTotal.textContent = String(rows.length);
                if (contactSummaryUnread) contactSummaryUnread.textContent = String(statuses.filter(function (status) { return status === 'Unread'; }).length);
                if (contactSummaryRead) contactSummaryRead.textContent = String(statuses.filter(function (status) { return status === 'Read'; }).length);
                if (contactSummaryReplied) contactSummaryReplied.textContent = String(statuses.filter(function (status) { return status === 'Replied'; }).length);
            }

            function buildContactMessageActions(status) {
                const buttons = ['<button class="mini-btn" type="button" data-contact-action="view">View</button>'];
                if (status === 'Unread') {
                    buttons.push('<button class="mini-btn" type="button" data-contact-action="mark-read">Mark as Read</button>');
                }
                buttons.push('<button class="mini-btn" type="button" data-contact-action="reply">Reply</button>');
                buttons.push('<button class="mini-btn" type="button" data-contact-action="delete">Delete</button>');
                return '<div class="actions-inline">' + buttons.join('') + '</div>';
            }

            function truncateContactMessage(value, limit) {
                const text = String(value || '');
                return text.length > limit ? text.slice(0, Math.max(0, limit - 1)).trimEnd() + '…' : text;
            }

            function applyContactMessageRowUpdate(row, item) {
                if (!row || !item) return;
                const status = item.status || row.dataset.status || 'Unread';
                const statusClass = item.status_class || (status === 'Replied' ? 'ok' : (status === 'Read' ? 'info' : 'warn'));

                row.dataset.messageId = item.db_id || row.dataset.contactId || row.dataset.messageId || '';
                row.dataset.contactId = item.db_id || row.dataset.contactId || row.dataset.messageId || '';
                row.dataset.displayMessageId = item.message_id || row.dataset.displayMessageId || '';
                row.dataset.name = item.name || row.dataset.name || '';
                row.dataset.email = item.email || row.dataset.email || '';
                row.dataset.date = item.date || row.dataset.date || '';
                row.dataset.message = item.message || row.dataset.message || '';
                row.dataset.subject = item.subject || row.dataset.subject || '';
                row.dataset.status = status;
                row.dataset.statusClass = statusClass;
                row.dataset.replyMessage = item.reply_message || '';
                row.dataset.replyDate = item.reply_date || '';
                row.dataset.replyBy = item.reply_by || '';

                if (row.children[0]) row.children[0].textContent = item.message_id || row.dataset.displayMessageId || '-';
                if (row.children[1]) row.children[1].textContent = item.name || row.dataset.name || '-';
                if (row.children[2]) row.children[2].textContent = item.email || row.dataset.email || '-';
                if (row.children[3]) row.children[3].textContent = item.date || row.dataset.date || '-';
                if (row.children[4]) row.children[4].textContent = truncateContactMessage(item.message || row.dataset.message || '-', 54);
                if (row.children[5]) row.children[5].innerHTML = '<span class="status ' + escapeContactValue(statusClass) + '">' + escapeContactValue(status) + '</span>';
                if (row.children[6]) row.children[6].textContent = item.subject || row.dataset.subject || '-';
                if (row.children[7]) row.children[7].innerHTML = buildContactMessageActions(status);
            }

            refreshActionInlineLayouts(document);
            startActionInlineLayoutObserver();

            ensureContactMessageEmptyState();
            updateContactMessageSummary();

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

            autoHideSuccessFeedback('.dashboard-profile-feedback.success.show', 3200);
        })();
    </script>
</body>
</html>
