<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Pinwntha Gems</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root{--account-accent:#111111;--account-accent-soft:#333333;--account-gold:#b89250;--account-cream:#ffffff;--account-stroke:#ececec;--account-shadow:0 18px 46px rgba(83,57,26,.08)}
        body.customer-account-page{margin:0;font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:
            radial-gradient(circle at top left,rgba(191,161,106,.06),transparent 24%),
            radial-gradient(circle at top right,rgba(47,111,101,.04),transparent 24%),
            linear-gradient(180deg,#ffffff 0%,#fbfbfb 52%,#f8f3ea 100%);color:#2f261e}
        .account-shell{max-width:1260px;margin:0 auto;padding:38px 22px 56px}
        .account-hero{position:relative;overflow:hidden;padding:34px 30px 30px;border-radius:30px;background:linear-gradient(135deg,#ffffff,#fcfbf8);box-shadow:var(--account-shadow);border:1px solid rgba(191,161,106,.12)}
        .account-hero::after{content:"";position:absolute;inset:auto -80px -90px auto;width:240px;height:240px;border-radius:50%;background:radial-gradient(circle,rgba(191,161,106,.12),rgba(191,161,106,0))}
        .account-hero small{display:inline-flex;align-items:center;gap:8px;padding:8px 12px;border-radius:999px;background:#fff6e8;color:#8b6838;font-weight:700;letter-spacing:.08em;text-transform:uppercase}
        .account-hero h1{margin:14px 0 8px;font-size:2.45rem;font-family:Georgia,'Times New Roman',serif}
        .account-hero p{margin:0;color:#75624f;max-width:760px;line-height:1.7}
        .account-hero-top{display:flex;align-items:flex-start;justify-content:space-between;gap:18px}
        .account-highlight{display:grid;gap:10px;min-width:220px;padding:16px 18px;border-radius:22px;background:#fffdf9;border:1px solid rgba(191,161,106,.18);box-shadow:0 12px 26px rgba(83,57,26,.06)}
        .account-highlight span{font-size:.78rem;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:#8b7150}
        .account-highlight strong{font-size:1.1rem;color:var(--account-accent)}
        .account-highlight p{margin:0;font-size:.94rem;line-height:1.5;color:#6b7280}
        .account-quick-links{display:flex;flex-wrap:wrap;gap:10px;margin-top:20px}
        .account-quick-links a{display:inline-flex;align-items:center;gap:10px;padding:10px 14px;border-radius:999px;text-decoration:none;color:#374151;background:#fff;border:1px solid rgba(191,161,106,.16);font-weight:700;transition:.2s ease}
        .account-quick-links a:hover{transform:translateY(-1px);background:#fffaf2;border-color:rgba(191,161,106,.3);color:var(--account-accent)}
        .account-layout{display:grid;grid-template-columns:280px 1fr;gap:20px;margin-top:24px}
        .account-sidebar,.account-panel{background:#fff;border:1px solid var(--account-stroke);border-radius:24px;box-shadow:0 16px 36px rgba(83,57,26,.05)}
        .account-sidebar{position:sticky;top:98px;align-self:start;padding:18px}
        .account-sidebar-meta{padding:14px 14px 16px;margin-bottom:14px;border-radius:20px;background:linear-gradient(135deg,#fff8ec,#f7eddc);border:1px solid rgba(191,161,106,.18)}
        .account-sidebar-meta strong{display:block;font-size:1.05rem}
        .account-sidebar-meta span{display:block;margin-top:4px;color:#7a6550;font-size:.92rem}
        .sidebar-title{padding:12px 14px 14px;color:#8b7150;font-size:.78rem;font-weight:800;letter-spacing:.18em;text-transform:uppercase}
        .account-nav{display:grid;gap:8px}
        .account-nav a{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:13px 14px;border-radius:18px;color:#403227;text-decoration:none;font-weight:700;transition:.2s ease}
        .account-nav a > span{display:flex;align-items:center;gap:12px}
        .account-nav a i{width:18px;color:var(--account-gold)}
        .account-nav a::after{content:"\f054";font-family:"Font Awesome 6 Free";font-weight:900;font-size:.75rem;color:#ccb184;opacity:.75}
        .account-nav a.active,.account-nav a:hover{background:linear-gradient(135deg,#f4eadb,#efe1cb);color:#2b2118;transform:translateX(2px)}
        .account-nav a.active::after,.account-nav a:hover::after{color:var(--account-accent-soft)}
        .account-panel{padding:24px}
        .section-block{display:none}
        .section-block.active{display:block}
        .section-head{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:18px}
        .section-head h2{margin:0;font-size:1.85rem;font-family:Georgia,'Times New Roman',serif}
        .section-head p{margin:6px 0 0;color:#75624f}
        .section-head-actions{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
        .section-action{height:42px;padding:0 16px;border:none;border-radius:12px;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:700;cursor:pointer}
        .section-action.alt{background:linear-gradient(135deg,#444444,#111111)}
        .summary-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:18px}
        .summary-card{padding:16px 18px;border-radius:18px;border:1px solid #efe1ce;background:#fff}
        .summary-card span{display:block;color:#8b7150;font-size:.82rem}
        .summary-card strong{display:block;margin-top:8px;font-size:1.45rem}
        .profile-layout{display:grid;grid-template-columns:240px 1fr;gap:18px}
        .profile-card,.content-card{padding:18px;border:1px solid #efe1ce;border-radius:20px;background:#fff}
        .profile-preview{display:grid;place-items:center;gap:12px;text-align:center}
        .profile-avatar{width:94px;height:94px;border-radius:28px;display:grid;place-items:center;overflow:hidden;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-size:1.7rem;font-weight:800}
        .profile-avatar img{width:100%;height:100%;object-fit:cover;display:block}
        .upload-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid #ead7bd;background:#fff7ec;color:#7b5d33;font-weight:700;cursor:pointer}
        .remove-btn{display:inline-flex;align-items:center;gap:8px;padding:10px 14px;border-radius:12px;border:1px solid #efc9bf;background:#fff4ef;color:#a34f3c;font-weight:700;cursor:pointer}
        .profile-actions{display:grid;gap:10px;width:100%}
        .profile-image-input{display:none}
        .profile-feedback{width:100%;padding:10px 12px;border-radius:12px;font-size:.92rem;line-height:1.5}
        .profile-feedback.success{background:#fff4df;border:1px solid #ecd0a3;color:#8b6838}
        .profile-feedback.error{background:#fff0ea;border:1px solid #f0d2c7;color:#9c4d3d}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .field{display:flex;flex-direction:column;gap:6px}
        .field.full{grid-column:1 / -1}
        .field label{font-size:.84rem;color:#7a6550;font-weight:600}
        .field input,.field select,.field textarea{height:44px;padding:0 12px;border:1px solid #e8d8c2;border-radius:12px;background:#fff;font:inherit}
        .field textarea{min-height:110px;padding:12px;resize:vertical}
        .field-error{margin-top:2px;color:#b14d3c;font-size:.82rem}
        .form-actions{display:flex;justify-content:flex-end;margin-top:18px}
        .submit-btn{height:44px;padding:0 18px;border:none;border-radius:12px;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:700;cursor:pointer}
        table{width:100%;border-collapse:collapse}
        th,td{padding:14px 10px;text-align:left;border-bottom:1px solid #f0e4d2;font-size:.92rem}
        th{color:#8b7150;font-weight:700}
        .status{display:inline-flex;align-items:center;padding:7px 12px;border-radius:999px;font-size:.8rem;font-weight:700}
        .pending{background:#faedd7;color:#936725}
        .processing{background:#e4eefc;color:#245da8}
        .delivered{background:#e0efe8;color:#266353}
        .pickup{background:#efe6fb;color:#65459c}
        .request{background:#dfeafb;color:#285b9b}
        .unread{background:#fde7d9;color:#9d533f}
        .read{background:#e7f2ec;color:#2e695a}
        .action-row{display:flex;gap:8px;flex-wrap:wrap}
        .order-action-stack{display:grid;gap:10px;justify-items:start}
        .order-return-status{display:inline-flex;align-items:center;gap:6px;padding:7px 12px;border-radius:999px;font-size:.8rem;font-weight:700;box-shadow:0 8px 14px rgba(32,24,14,.06)}
        .mini-btn{display:inline-flex;align-items:center;justify-content:center;padding:8px 12px;border-radius:10px;border:1px solid #e8d5b8;background:#fff;color:#2d241b;text-decoration:none;font-weight:600;cursor:pointer}
        a.mini-btn{color:#2d241b}
        .orders-table-wrap{overflow-x:auto}
        .qty-badge{display:inline-flex;min-width:34px;justify-content:center;padding:7px 10px;border-radius:999px;background:#fff6e9;border:1px solid #edd8b5;color:#8d6932;font-weight:700}
        .review-eligible-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:999px;background:#edf7ee;border:1px solid #c9e8ce;color:#245f30;font-size:.74rem;font-weight:800;letter-spacing:.22px;text-transform:uppercase;white-space:nowrap}
        .wishlist-grid,.cart-grid,.request-grid,.notification-list{display:grid;gap:14px}
        .wishlist-card,.request-card,.notification-card{display:grid;gap:12px;padding:16px;border:1px solid #efe1ce;border-radius:20px;background:#fff}
        .wishlist-card{grid-template-columns:90px 1fr auto;align-items:center;cursor:pointer;transition:.2s ease}
        .wishlist-card:hover{transform:translateY(-2px);box-shadow:0 16px 30px rgba(83,57,26,.08);border-color:#e5d2b2}
        .stock-pill{display:inline-flex;align-items:center;padding:5px 10px;border-radius:999px;font-size:.74rem;font-weight:600;letter-spacing:.25px;text-transform:uppercase;border:1px solid transparent;width:max-content}
        .stock-pill.in-stock{background:#edf7ee;color:#245f30;border-color:#c9e8ce}
        .stock-pill.critical{background:#fff0e7;color:#b55a2d;border-color:#f1ccb5}
        .stock-pill.out-of-stock{background:#f5e6e6;color:#a33;border-color:#edc8c8}
        .request-card{box-shadow:none;padding:0;border:none;border-radius:0;background:transparent}
        .request-card-header{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;padding:0 0 12px;margin-bottom:12px;border-bottom:1px solid #eadbc8}
        .request-card-header strong{display:block;font-size:1.02rem}
        .request-card-header span{display:block;color:#8b7150;font-size:.88rem}
        .request-fields{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px 18px}
        .request-field{display:grid;grid-template-columns:220px minmax(0,1fr);gap:14px;align-items:start;padding:10px 0;border-bottom:1px solid #f3eadc}
        .request-field:last-child{border-bottom:none}
        .request-field span{display:block;color:#8b7150;font-size:.78rem;letter-spacing:.02em;text-transform:uppercase}
        .request-field strong{display:block}
        .request-field.full{grid-column:1 / -1;grid-template-columns:220px minmax(0,1fr)}
        .request-field.full strong{margin-top:0}
        .request-list{display:grid;gap:18px}
        .request-list-item{padding:0 0 18px;border-bottom:1px solid #eadbc8}
        .request-list-meta{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;padding-bottom:12px;margin-bottom:12px;border-bottom:1px solid #f0e3d2}
        .request-list-meta strong{display:block;font-size:1.02rem}
        .request-list-meta span{display:block;color:#8b7150;font-size:.88rem}
        .request-list-rows{display:grid;gap:10px}
        .request-list-row{display:grid;grid-template-columns:220px 1fr;gap:14px;align-items:start;padding:10px 0;border-bottom:1px solid #f3eadc}
        .request-list-row:last-child{border-bottom:none}
        .request-list-row span{display:block;color:#8b7150;font-size:.78rem;letter-spacing:.02em;text-transform:uppercase}
        .request-list-row strong{display:block;margin-top:6px}
        .request-list-row.full{grid-template-columns:1fr}
        .request-list-row.full span{margin-bottom:2px}
        .request-list-row .quotation-amount-wrap{margin-top:0}
        .cart-card{grid-template-columns:32px 90px 1fr auto;align-items:center}
        .cart-card:hover{transform:none}
        .cart-select{width:24px;height:24px;border-radius:8px;border:1px solid #d9c4a3;background:#fff;display:grid;place-items:center;color:#fff;cursor:pointer;transition:.2s ease}
        .cart-select.active{background:linear-gradient(135deg,#c5a067,#9f7740);border-color:#9f7740}
        .cart-select i{font-size:.72rem;opacity:0}
        .cart-select.active i{opacity:1}
        .product-thumb{width:90px;height:90px;border-radius:18px;overflow:hidden;border:1px solid #ecdcc3;background:#f8efe0}
        .product-thumb img{width:100%;height:100%;object-fit:cover;display:block}
        .wishlist-empty{padding:18px;border:1px dashed #e5d2b2;border-radius:18px;background:#fffaf2;color:#7a6550;line-height:1.7}
        .cart-summary{display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-bottom:18px}
        .cart-total-card{padding:16px 18px;border-radius:18px;border:1px solid #efe1ce;background:#fff}
        .cart-total-card span{display:block;color:#8b7150;font-size:.82rem}
        .cart-total-card strong{display:block;margin-top:8px;font-size:1.3rem;color:#9f7740}
        .cart-checkout-panel{display:flex;align-items:center;justify-content:flex-end;gap:16px;margin:14px 0 18px;padding:18px 20px;border-radius:20px;border:1px solid #ead7bd;background:linear-gradient(135deg,#fff8ee,#f8efe1)}
        .cart-checkout-actions{display:grid;grid-template-columns:repeat(2,minmax(150px,190px));align-items:stretch;gap:10px}
        .cart-checkout-actions .mini-btn,
        .cart-checkout-actions .checkout-btn{width:100%;height:46px;border-radius:14px;padding:0 18px}
        .checkout-btn{border:none;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:800;cursor:pointer}
        .checkout-btn:disabled{opacity:.55;cursor:not-allowed}
        .cart-selected-total{margin:14px 0 0;padding:14px 18px;border-radius:16px;border:1px solid #ead7bd;background:#fffaf2;display:flex;align-items:center;justify-content:space-between;gap:12px}
        .cart-selected-total span{color:#8b7150;font-size:.82rem;text-transform:uppercase;letter-spacing:.5px}
        .cart-selected-total strong{color:#111111;font-size:1.1rem}
        .qty-controls{display:inline-flex;align-items:center;gap:8px;flex-wrap:wrap}
        .qty-display{min-width:48px;height:36px;display:inline-flex;align-items:center;justify-content:center;padding:0 12px;border-radius:10px;border:1px solid #e8d5b8;background:#fff;font-weight:700;color:#2d241b}
        .qty-btn{width:36px;height:36px;padding:0;border:1px solid #e8d5b8;border-radius:10px;background:linear-gradient(135deg,#c5a067,#9f7740);color:#fff;font-weight:800;cursor:pointer;display:inline-flex;align-items:center;justify-content:center}
        .qty-btn:disabled{opacity:.45;cursor:not-allowed}
        .card-meta h3{margin:0 0 6px;font-size:1.05rem}
        .card-meta p{margin:0;color:#7a6550;line-height:1.5}
        .price{font-weight:800;color:#111111}
        .request-top,.notification-top{display:flex;align-items:center;justify-content:space-between;gap:12px}
        .quotation-amount-wrap{display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-top:8px}
        .quotation-preview-link{display:inline-flex;align-items:center;justify-content:center;width:104px;height:104px;border-radius:18px;border:1px solid #e8d8c0;background:#fbf8f2;overflow:hidden;flex:0 0 auto}
        .quotation-preview-link img{width:100%;height:100%;object-fit:cover;display:block}
        .quotation-amount-text{font-size:1.12rem;font-weight:700;color:#2d241b}
        .notification-card img{width:100%;max-height:240px;object-fit:contain;object-position:center;background:#fff;border-radius:14px;border:1px solid #efe1ce;padding:8px}
        #orderDetailImage{width:100%;max-width:240px;max-height:240px;object-fit:contain;object-position:center;background:#fff;border-radius:14px;border:1px solid #efe1ce;padding:8px}
        .chat-media{max-width:260px}
        .chat-media img{max-width:260px;max-height:180px;object-fit:contain;object-position:center;background:#fff}
        .product-thumb{width:76px;height:76px}
        .request-image-strip{display:flex;gap:8px;flex-wrap:wrap}
        .request-image-chip{display:inline-flex;align-items:center;gap:6px;padding:6px 10px;border-radius:999px;background:#fff;border:1px solid #ead9c0;color:#7a6550;font-size:.82rem}
        .request-empty{padding:18px;border:1px dashed #e5d2b2;border-radius:18px;background:#fffaf2;color:#7a6550;line-height:1.7}
        .notification-action{display:inline-flex;align-items:center;justify-content:center;width:max-content;margin-top:4px}
        .request-flash{margin-bottom:16px;padding:14px 16px;border-radius:18px;background:#eef6ef;border:1px solid #cfe6db;color:#215343}
        .request-flash.error{background:#fff0ea;border-color:#f0d2c7;color:#9c4d3d}
        .custom-request-form{display:grid;gap:14px}
        .type-selector{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .type-specific-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:4px}
        .type-group{padding:14px;border-radius:18px;border:1px solid #eadbc6;background:#fffdf9}
        .type-group[hidden]{display:none !important}
        .type-group-title{display:block;margin-bottom:10px;color:#8b7150;font-size:.78rem;font-weight:800;letter-spacing:.16em;text-transform:uppercase}
        .form-note{margin-top:-4px;color:#8b7150;font-size:.82rem;line-height:1.5}
        .notification-card p{margin:0;color:#6f5b47;line-height:1.6}
        .contact-message-stack{display:grid;gap:16px}
        .contact-message-toolbar{display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-bottom:18px}
        .contact-message-toolbar p{margin:0;color:#6f5b47;line-height:1.6;max-width:620px}
        .contact-message-cta{height:44px;padding:0 18px;border:none;border-radius:14px;background:linear-gradient(135deg,#444444,#111111);color:#fff;font-weight:700;cursor:pointer}
        .contact-message-card{padding:18px;border:1px solid #efe1ce;border-radius:22px;background:#fff;box-shadow:0 14px 30px rgba(83,57,26,.07);display:grid;gap:14px}
        .contact-message-head{display:flex;align-items:flex-start;justify-content:space-between;gap:12px;flex-wrap:wrap}
        .contact-message-head strong{display:block;font-size:1.08rem;color:#2d241b}
        .contact-message-head span{display:block;margin-top:4px;color:#8b7150;font-size:.9rem}
        .contact-message-body{padding:16px 18px;border-radius:18px;background:#fffaf2;border:1px solid #efdfca;color:#5d4a37;line-height:1.7}
        .contact-message-reply{padding:16px 18px;border-radius:18px;background:linear-gradient(135deg,#edf5f1,#e5f0eb);border:1px solid #cfe1d8}
        .contact-message-reply strong{display:block;color:#215343;margin-bottom:8px}
        .contact-message-reply p{margin:0;color:#476153;line-height:1.7}
        .contact-message-empty{padding:22px;border:1px dashed #e5d2b2;border-radius:20px;background:#fffaf2;color:#7a6550;line-height:1.7}
        .logout-card{display:grid;gap:12px;max-width:420px;padding:22px;border:1px solid #efd8cf;border-radius:22px;background:linear-gradient(135deg,#fff8f4,#fff)}
        .logout-card h3{margin:0}
        .logout-card p{margin:0;color:#7a6550;line-height:1.6}
        .logout-btn{height:44px;padding:0 16px;border:none;border-radius:12px;background:linear-gradient(135deg,#c76352,#9e4335);color:#fff;font-weight:700;cursor:pointer}
        .order-modal{position:fixed;inset:0;display:none;place-items:center;padding:20px;background:rgba(32,24,14,.52);backdrop-filter:blur(5px);z-index:1400}
        .order-modal.open{display:grid}
        .order-modal-card{width:min(920px,100%);max-height:min(86vh,920px);overflow:auto;background:#fffdf9;border:1px solid #eadbc6;border-radius:28px;box-shadow:0 22px 60px rgba(32,24,14,.2)}
        .order-modal-head{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:22px 24px 12px}
        .order-modal-head h3{margin:0;font-size:1.6rem;font-family:Georgia,'Times New Roman',serif}
        .order-modal-head p{margin:6px 0 0;color:#7a6550}
        .modal-close{width:40px;height:40px;border:none;border-radius:50%;background:#f5ebda;color:#5a4531;font-size:1rem;cursor:pointer}
        .order-modal-body{padding:0 24px 24px}
        .order-detail-layout{display:grid;grid-template-columns:320px 1fr;gap:20px}
        .order-image-box{padding:16px;border-radius:24px;background:linear-gradient(135deg,#fbf4e7,#f2e2c5)}
        .order-image-box img{width:100%;height:280px;object-fit:cover;border-radius:18px;display:block}
        .order-image-caption{margin-top:12px;color:#7a6550;line-height:1.6}
        .order-detail-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
        .order-detail-item{padding:14px 16px;border-radius:16px;background:#fffaf2;border:1px solid #efdfca}
        .order-detail-item span{display:block;font-size:.8rem;color:#8b7150}
        .order-detail-item strong{display:block;margin-top:6px;color:#2d241b}
        .order-summary-box{margin-top:16px;padding:16px 18px;border-radius:18px;background:#fff;border:1px solid #efe1ce}
        .order-summary-box h4{margin:0 0 8px;color:#3f3022}
        .order-summary-box p{margin:0;color:#6f5b47;line-height:1.65}
        .tracker-card{padding:8px 0 6px}
        .tracker-line{position:relative;display:grid;gap:0;margin-top:10px}
        .tracker-step{position:relative;display:grid;grid-template-columns:52px 1fr;gap:14px;padding:0 0 18px}
        .tracker-step:last-child{padding-bottom:0}
        .tracker-step::before{content:"";position:absolute;left:24px;top:34px;bottom:-4px;width:2px;background:#eadfcf}
        .tracker-step:last-child::before{display:none}
        .tracker-dot{position:relative;z-index:1;width:48px;height:48px;border-radius:50%;display:grid;place-items:center;background:#f6eee0;color:#b89a69;font-weight:800;border:2px solid #ead9bc}
        .tracker-content{padding-top:4px}
        .tracker-content strong{display:block;color:#34281e}
        .tracker-content p{margin:4px 0 0;color:#7a6550;line-height:1.55}
        .tracker-step.done .tracker-dot{background:linear-gradient(135deg,#444444,#111111);border-color:#111111;color:#fff}
        .tracker-step.current .tracker-dot{background:linear-gradient(135deg,#d7b16d,#b98b46);border-color:#b98b46;color:#fff;box-shadow:0 0 0 6px rgba(217,177,109,.18)}
        .tracker-step.current strong{color:#8c6429}
        .tracker-banner{margin-bottom:16px;padding:16px 18px;border-radius:18px;background:linear-gradient(135deg,#fff7e9,#f7ebd6);border:1px solid #edd8b5}
        .tracker-banner strong{display:block;color:#6b4d22}
        .tracker-banner span{display:block;margin-top:6px;color:#7a6550}
        .checkout-list{display:grid;gap:12px}
        .checkout-item{display:grid;grid-template-columns:72px 1fr auto;gap:12px;align-items:center;padding:14px;border:1px solid #efdfca;border-radius:18px;background:#fff}
        .checkout-item img{width:72px;height:72px;border-radius:16px;object-fit:cover}
        .checkout-item strong{display:block}
        .checkout-item span{display:block;color:#7a6550;font-size:.9rem;margin-top:4px}
        .checkout-total{display:flex;justify-content:space-between;align-items:center;gap:12px;margin-top:16px;padding:16px 18px;border-radius:18px;background:#fffaf2;border:1px solid #efdfca}
        .checkout-total strong{font-size:1.2rem;color:#111111}
        .request-modal-form{display:grid;gap:14px}
        .request-modal-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
        .request-modal-grid .field input,.request-modal-grid .field select,.request-modal-grid .field textarea{height:44px;padding:0 12px;border:1px solid #e8d8c2;border-radius:12px;background:#fff;font:inherit}
        .request-modal-grid .field textarea{min-height:110px;padding:12px;resize:vertical}
        .request-upload-note{color:#8b7150;font-size:.82rem}
        .consult-history-table{width:100%}
        .consult-chat-layout{display:grid;grid-template-columns:minmax(300px,330px) minmax(0,1fr);gap:18px;margin-top:18px;align-items:start}
        .chat-card{padding:18px;border:1px solid #efe1ce;border-radius:24px;background:#fff;box-shadow:0 16px 36px rgba(83,57,26,.08);align-self:start}
        .chat-card .section-head{margin-bottom:12px}
        .chat-card .section-head h3{margin:0;font-size:1.2rem}
        .chat-card .section-head span{display:block;color:#8b7150;margin-top:4px}
        .chat-contact{display:grid;gap:12px;max-height:calc(100vh - 360px);overflow-y:auto;padding-right:4px}
        .chat-contact-btn{width:100%;padding:14px 16px;border:1px solid #efcf9d;border-radius:20px;background:#fff;text-align:left;cursor:pointer;transition:.2s ease}
        .chat-contact-btn strong{display:block;margin-bottom:6px;font-size:1.02rem}
        .chat-contact-btn span{display:block;color:#7a6550;line-height:1.55}
        .chat-contact-btn.active,.chat-contact-btn:hover{background:linear-gradient(135deg,#fffaf2,#f8ecda);box-shadow:0 14px 28px rgba(42,29,18,.08);transform:translateY(-1px)}
        .chat-window{padding:18px;border:1px solid #efe1ce;border-radius:24px;background:#fff;box-shadow:0 16px 36px rgba(83,57,26,.08);display:grid;grid-template-rows:auto auto auto;gap:14px;min-height:0;align-self:start}
        .chat-header{padding:14px 16px;border:1px solid #efdfca;border-radius:18px;background:#fffaf4}
        .chat-header strong{display:block;font-size:1.1rem}
        .chat-header span{display:block;color:#8b7150;margin-top:6px}
        .chat-messages{display:grid;gap:14px;min-height:220px;max-height:360px;overflow-y:auto;padding-right:6px;scroll-behavior:smooth}
        .chat-bubble-wrap{display:flex}
        .chat-bubble-wrap.customer{justify-content:flex-end}
        .chat-bubble-wrap.consultant{justify-content:flex-start}
        .chat-bubble{max-width:82%;padding:14px 16px;border-radius:18px;border:1px solid #efdfca;background:#fff}
        .chat-bubble-wrap.consultant .chat-bubble{background:#efe6fb;border-color:#dfd1f3}
        .chat-bubble small{display:block;color:#8b7150;font-size:.78rem;margin-bottom:8px}
        .chat-media{margin-top:10px;max-width:320px}
        .chat-media img{display:block;width:100%;max-width:320px;max-height:220px;object-fit:cover;border-radius:14px;border:1px solid #e8d8c2;background:#fff}
        .reply-box{display:grid;gap:10px;padding:14px;border:1px solid #efdfca;border-radius:18px;background:#fffaf4}
        .reply-box textarea{width:100%;min-height:100px;border:1px solid #d5c3aa;border-radius:14px;padding:12px;background:#fff;font:inherit;resize:vertical;box-sizing:border-box}
        .reply-box input[type="file"]{width:100%;padding:10px;border:1px solid #e2d0b5;border-radius:12px;background:#fff;box-sizing:border-box}
        @media (max-width:1024px){.account-layout,.profile-layout,.summary-grid,.request-fields{grid-template-columns:1fr}.account-hero-top{display:grid;grid-template-columns:1fr}.account-sidebar{position:static}.form-grid{grid-template-columns:1fr 1fr}}
        @media (max-width:720px){.account-shell{padding:24px 14px 42px}.account-hero-top,.form-grid,.wishlist-card,.cart-card,.order-detail-layout,.order-detail-grid,.checkout-item,.request-modal-grid,.consult-chat-layout{display:grid;grid-template-columns:1fr}.section-head{flex-direction:column;align-items:flex-start}.account-panel,.account-sidebar,.account-hero{border-radius:20px}.account-quick-links{overflow:auto;flex-wrap:nowrap;padding-bottom:4px}.account-quick-links a{white-space:nowrap}.account-highlight{min-width:0}.order-modal-head,.order-modal-body{padding-left:16px;padding-right:16px}.cart-summary{grid-template-columns:1fr 1fr}.cart-checkout-panel,.checkout-total{display:grid}}
    </style>
</head>
<body class="customer-account-page">
    <x-navbar />

    <div class="account-shell">
        <section class="account-hero">
            <div class="account-hero-top">
                <div>
                    <small><i class="fas fa-user-circle"></i> Customer Account</small>
                    <h1>Welcome back, {{ auth()->user()->first_name }}</h1>
                    <p>Manage your profile, track orders, review wishlist items, submit custom jewellery requests, and follow up on consultations from one place.</p>
                </div>

        </section>

        <div class="account-layout">
            <aside class="account-sidebar">
                <div class="account-sidebar-meta">
                    <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                    <span>{{ auth()->user()->email }}</span>
                </div>
                <div class="sidebar-title">Account Menu</div>
                <nav class="account-nav">
                    <a href="{{ route('profile') }}" class="{{ ($activeSection ?? 'profile') === 'profile' ? 'active' : '' }}"><span><i class="fas fa-user"></i><span>My Profile</span></span></a>
                    <a href="{{ route('astrology') }}" class="{{ ($activeSection ?? '') === 'astrology' ? 'active' : '' }}"><span><i class="fas fa-moon"></i><span>Astrology</span></span></a>
                    <a href="{{ route('orders') }}" class="{{ ($activeSection ?? '') === 'orders' ? 'active' : '' }}"><span><i class="fas fa-box-open"></i><span>My Orders</span></span></a>
                    <a href="{{ route('wishlist') }}" class="{{ ($activeSection ?? '') === 'wishlist' ? 'active' : '' }}"><span><i class="fas fa-heart"></i><span>Wishlist</span></span></a>
                    <a href="{{ route('cart') }}" class="{{ ($activeSection ?? '') === 'cart' ? 'active' : '' }}"><span><i class="fas fa-cart-shopping"></i><span>Shopping Cart</span></span></a>
                    <a href="{{ route('custom.jewellery') }}" class="{{ ($activeSection ?? '') === 'custom-jewellery' ? 'active' : '' }}"><span><i class="fas fa-gem"></i><span>Custom Jewellery</span></span></a>
                    <a href="{{ route('consultations') }}" class="{{ ($activeSection ?? '') === 'consultations' ? 'active' : '' }}"><span><i class="fas fa-comments"></i><span>Consultations</span></span></a>
                    <a href="{{ route('contact.messages') }}" class="{{ ($activeSection ?? '') === 'contact-messages' ? 'active' : '' }}"><span><i class="fas fa-envelope-open-text"></i><span>Contact Messages</span></span></a>
                    <a href="{{ route('notifications') }}" class="{{ ($activeSection ?? '') === 'notifications' ? 'active' : '' }}"><span><i class="fas fa-bell"></i><span>Notifications</span></span></a>
                    <a href="{{ route('settings') }}" class="{{ ($activeSection ?? '') === 'settings' ? 'active' : '' }}"><span><i class="fas fa-gear"></i><span>Settings</span></span></a>
                </nav>
            </aside>

            <main class="account-panel">
                <section class="section-block {{ ($activeSection ?? 'profile') === 'profile' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>My Profile</h2>
                            <p>Update your personal details, contact information, and basic account information.</p>
                        </div>
                    </div>
                    <div class="profile-layout">
                        <div class="profile-card">
                            <div class="profile-preview">
                                <div class="profile-avatar">
                                    @if (auth()->user()->profileImageUrl())
                                        <img src="{{ auth()->user()->profileImageUrl() }}" alt="{{ auth()->user()->first_name }} profile image">
                                    @else
                                        {{ auth()->user()->profileInitial() }}
                                    @endif
                                </div>
                                <strong>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</strong>
                                <span style="color:#7a6550;">Customer Account</span>
                                @if (session('profile_image_success'))
                                    <div class="profile-feedback success">{{ session('profile_image_success') }}</div>
                                @endif
                                @error('profile_image')
                                    <div class="profile-feedback error">{{ $message }}</div>
                                @enderror
                                <div class="profile-actions">
                                    <form action="{{ route('profile.image.update') }}" method="POST" enctype="multipart/form-data" id="profileImageForm">
                                        @csrf
                                        <input type="file" name="profile_image" id="profileImageInput" class="profile-image-input" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                                        <label class="upload-btn" for="profileImageInput"><i class="fas fa-image"></i> Profile Image</label>
                                    </form>
                                    @if (auth()->user()->profile_image_path)
                                        <form action="{{ route('profile.image.remove') }}" method="POST" onsubmit="return confirm('Remove your profile picture completely?');">
                                            @csrf
                                            <button type="submit" class="remove-btn"><i class="fas fa-trash-alt"></i> Remove Picture</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="content-card">
                            @if (session('profile_success'))
                                <div class="profile-feedback success" style="margin-bottom:14px;">{{ session('profile_success') }}</div>
                            @endif
                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf
                                <div class="form-grid">
                                    <div class="field">
                                        <label>Full Name</label>
                                        <input type="text" name="full_name" value="{{ old('full_name', trim((auth()->user()->first_name ?? '').' '.(auth()->user()->last_name ?? ''))) }}">
                                        @error('full_name')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <label>Email</label>
                                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                                        @error('email')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}">
                                        @error('phone_number')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <label>Birth Date</label>
                                        <input type="date" name="birth_date" value="{{ old('birth_date', auth()->user()->birth_date) }}">
                                        @error('birth_date')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <label>Zodiac Sign</label>
                                        <input type="text" value="{{ auth()->user()->zodiacSign?->sign_name ?? 'Auto-calculated from birth date' }}" readonly>
                                    </div>
                                    <div class="field full">
                                        <label>Address</label>
                                        <textarea name="address">{{ old('address', auth()->user()->address) }}</textarea>
                                        @error('address')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-actions"><button class="submit-btn" type="submit">Update Profile</button></div>
                            </form>
                        </div>
                    </div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'orders' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>My Orders</h2>
                            <p>Track your order progress, pickup details, and delivered purchases.</p>
                        </div>
                    </div>
                    <div class="summary-grid">
                        <div class="summary-card"><span>All Orders</span><strong id="ordersSummaryAll">0</strong></div>
                        <div class="summary-card"><span>Active Orders</span><strong id="ordersSummaryActive">0</strong></div>
                        <div class="summary-card"><span>Pickup Orders</span><strong id="ordersSummaryPickup">0</strong></div>
                    </div>
                    <div class="orders-table-wrap">
                    <table>
                        <thead><tr><th>Order ID</th><th>Order Date</th><th>Quantity</th><th>Amount Paid</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody id="ordersTableBody"></tbody>
                    </table>
                    </div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'wishlist' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>Wishlist</h2>
                            <p>View your saved jewellery and gemstones, then move them to cart when ready.</p>
                        </div>
                    </div>
                    @if (session('wishlist_success'))
                        <div class="request-flash">{{ session('wishlist_success') }}</div>
                    @endif
                    @if (session('wishlist_error'))
                        <div class="request-flash error">{{ session('wishlist_error') }}</div>
                    @endif
                    @if (session('cart_error'))
                        <div class="request-flash error">{{ session('cart_error') }}</div>
                    @endif
                    <div class="wishlist-grid" id="wishlistGrid"></div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'cart' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>Shopping Cart</h2>
                            <p>Review the products you plan to purchase before checkout.</p>
                        </div>
                    </div>
                    @if (session('cart_error'))
                        <div class="request-flash error">{{ session('cart_error') }}</div>
                    @endif
                    <div class="cart-summary" id="cartSummary"></div>
                    <div class="cart-grid" id="cartGrid"></div>
                    <div class="cart-selected-total" id="cartSelectedTotal"></div>
                    <div id="cartCheckoutPanel"></div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'custom-jewellery' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>Custom Jewellery</h2>
                            <p>Create a custom request by jewellery type, gem, and metal, then track each submission here.</p>
                        </div>
                        <button class="section-action" type="button" id="newCustomRequestBtn">New Request</button>
                    </div>
                    @if (session('custom_jewellery_success'))
                        <div class="request-flash">{{ session('custom_jewellery_success') }}</div>
                    @endif
                    @if ($errors->any())
                        <div class="request-flash error">Please check the custom request form fields and try again.</div>
                    @endif
                    <div class="request-grid" id="customRequestGrid">
                        @forelse (($customJewelleryRequests ?? collect()) as $customRequest)
                            <article class="request-card">
                                @php
                                    $quotationStatus = $customRequest->quotation?->status ?? '';
                                    $quotationAmountText = $customRequest->quotation?->quotation_amount
                                        ? 'Rs ' . number_format((float) $customRequest->quotation->quotation_amount, 0)
                                        : ($customRequest->quotation_amount ? 'Rs ' . number_format((float) $customRequest->quotation_amount, 0) : '—');
                                @endphp
                                <div class="request-card-header">
                                    <div>
                                        <strong>{{ $customRequest->request_number }}</strong>
                                        <span>{{ $customRequest->type_display_name }} &middot; {{ $customRequest->created_at?->format('Y-m-d') }}</span>
                                    </div>
                                    <span class="status {{ $customRequest->status_class }}">{{ $customRequest->status }}</span>
                                </div>
                                <div class="request-fields">
                                    <div class="request-field"><span>Jewellery Type</span><strong>{{ $customRequest->type_display_name }}</strong></div>
                                    <div class="request-field"><span>Gem</span><strong>{{ $customRequest->gem_display_name }}</strong></div>
                                    <div class="request-field"><span>Metal</span><strong>{{ $customRequest->metal }}</strong></div>
                                    <div class="request-field"><span>{{ $customRequest->measurement_label ?? 'Measurement' }}</span><strong>
                                        {{ $customRequest->size_value ?: '—' }}</strong></div>
                                    <div class="request-field full"><span>Design Details</span><strong>{{ $customRequest->type_details_summary }}</strong></div>
                                    <div class="request-field"><span>Engraving</span><strong>{{ $customRequest->engraving ?: 'None' }}</strong></div>
                                    <div class="request-field"><span>Reference Images</span><strong>{{ $customRequest->reference_count }} 
                                        file{{ $customRequest->reference_count === 1 ? '' : 's' }}</strong></div>
                                    <div class="request-field"><span>Quotation Status</span><strong>{{ $quotationStatus ?: 
                                    ($customRequest->status === 'Quoted' ? 'Quoted' : '—') }}</strong></div>
                                    <div class="request-field full">
                                        <span>Quotation Amount</span>
                                        <div class="quotation-amount-wrap">
                                            @php
                                                $quotationImage = $customRequest->quotation?->quotation_image ? asset('images/Quotations/' . $customRequest->quotation->quotation_image) : null;
                                            @endphp
                                            @if ($quotationImage)
                                                <a class="quotation-preview-link" href="{{ $quotationImage }}" target="_blank" rel="noopener" aria-label="Open quotation image">
                                                    <img src="{{ $quotationImage }}" alt="Quotation preview">
                                                </a>
                                            @endif
                                            <span class="quotation-amount-text">{{ $quotationAmountText }}</span>
                                        </div>
                                    </div>
                                    @if ($customRequest->quotation?->quotation_note)
                                        <div class="request-field full"><span>Quotation Note</span><strong>{{ $customRequest->quotation->quotation_note }}</strong></div>
                                    @endif
                                    @if ($quotationStatus === 'Sent')
                                        <div class="request-field full">
                                            <span>Actions</span>
                                            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:10px;">
                                                <form method="POST" action="{{ route('custom.quotations.accept', $customRequest->quotation->id) }}">
                                                    @csrf
                                                    <button class="mini-btn" type="submit">Accept</button>
                                                </form>
                                                <form method="POST" action="{{ route('custom.quotations.reject', $customRequest->quotation->id) }}">
                                                    @csrf
                                                    <button class="mini-btn" type="submit">Reject</button>
                                                </form>
                                            </div>
                                        </div>
                                    @elseif ($quotationStatus === 'Accepted')
                                        <div class="request-field full">
                                            <span>Actions</span>
                                            <a class="mini-btn" href="{{ route('custom.quotations.pay', $customRequest->quotation->id) }}">Pay</a>
                                        </div>
                                    @elseif ($quotationStatus === 'Rejected')
                                        <div class="request-field full"><span>Quotation Decision</span><strong>Rejected</strong></div>
                                    @elseif ($quotationStatus === 'Paid')
                                        <div class="request-field full"><span>Payment Status</span><strong>Paid</strong></div>
                                    @endif
                                </div>
                            </article>
                        @empty
                            <div class="request-empty">No custom jewellery requests yet. Create your first request using the button above.</div>
                        @endforelse
                    </div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'consultations' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>Consultations</h2>
                            <p>Request expert gem advice or continue customer-consultant chat. Appointments are booked separately.</p>
                        </div>
                        <div class="section-head-actions">
                            <button class="section-action alt" type="button" id="bookAppointmentBtn">Book Appointment</button>
                            <button class="section-action" type="button" id="requestConsultationBtn">Request Consultation</button>
                        </div>
                    </div>
                    @if (session('consultation_request_success'))
                        <div class="profile-feedback show" style="margin-bottom:16px;">{{ session('consultation_request_success') }}</div>
                    @endif
                    @if (session('appointment_success'))
                        <div class="profile-feedback show" style="margin-bottom:16px;">{{ session('appointment_success') }}</div>
                    @endif
                    <div class="summary-grid">
                        <div class="summary-card"><span>Consultation Requests</span><strong>{{ $consultationSummary['requests'] ?? 0 }}
                            </strong></div>
                        <div class="summary-card"><span>Active Chats</span><strong>{{ $consultationSummary['active_chats'] ?? 0 }}
                            </strong></div>
                        <div class="summary-card"><span>Appointments</span><strong>{{ $consultationSummary['appointments'] ?? 0 }}<
                            /strong></div>
                    </div>
                    <div class="consult-chat-layout">
                        <div class="chat-card">
                            <div class="section-head">
                                <div>
                                    <h3>My Consultant Chats</h3>
                                    <span>Select your consultant conversation</span>
                                </div>
                            </div>
                            <div class="chat-contact" id="customerChatContacts"></div>
                        </div>
                        <div class="chat-window">
                            <div class="chat-header">
                                <strong id="customerConsultChatTitle">Chat with Consultant</strong>
                                <span id="customerConsultChatMeta">Customer and consultant thread</span>
                            </div>
                            <div class="chat-messages" id="customerConsultChatMessages"></div>
                            <div class="reply-box">
                                <textarea id="customerConsultChatInput" placeholder="Type your question, follow-up, or design note here...">

                                </textarea>
                                <input id="customerConsultChatImage" type="file" accept="image/*">
                                <div class="form-actions"><button class="submit-btn" id="customerConsultChatSend" type="button">Send Reply
                                    </button></div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:18px;">
                        <table class="consult-history-table">
                            <thead><tr><th>Submitted On</th><th>Consultant Name</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody id="consultationHistoryBody">
                                @forelse (($consultationRequests ?? collect()) as $consultationRequest)
                                    <tr data-chat-thread-id="{{ $consultationRequest->chat_thread_id }}">
                                        <td>
                                            {{ $consultationRequest->created_at?->format('Y-m-d') ?? '-' }}
                                            <br><span style="color:#8b7150;">{{ $consultationRequest->display_request_type }}</span>
                                        </td>
                                        <td>{{ $consultationRequest->consultant_name }}</td>
                                        <td><span class="status {{ $consultationRequest->status_class }}">{{ $consultationRequest->status }}</span></td>
                                        <td><div class="action-row"><button class="mini-btn" type="button" data-open-chat="{{ $consultationRequest->chat_thread_id }}">Chat / Message</button></div></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="request-empty" style="margin:0;">No consultation requests yet. Use the button above to get started.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-top:24px;">
                        <div class="section-head" style="margin-bottom:12px;">
                            <div>
                                <h3 style="margin:0;">Appointment Bookings</h3>
                                <span style="display:block;color:#8b7150;margin-top:4px;">In-store and video call appointments.</span>
                            </div>
                        </div>
                        <table class="consult-history-table">
                            <thead><tr><th>Date & Time</th><th>Mode</th><th>Consultant</th><th>Status</th><th>Actions</th></tr></thead>
                            <tbody>
                                @forelse (($appointments ?? collect()) as $appointment)
                                    @php $hasPendingReschedule = $appointment->has_pending_reschedule; @endphp
                                    <tr>
                                        <td>{{ $appointment->preferred_date?->format('Y-m-d') ?? '-' }} {{ $appointment->preferred_time }}</td>
                                        <td>{{ $appointment->appointment_mode }}</td>
                                        <td>{{ $appointment->consultant_name }}</td>
                                        <td>
                                            <span class="status {{ $appointment->status_class }}">{{ $appointment->status }}</span>
                                            @if ($hasPendingReschedule)
                                                <small style="display:block;color:#8b7150;margin-top:4px;">
                                                    Proposed: {{ $appointment->reschedule_proposed_date?->format('Y-m-d') ?? '-' }}
                                                     {{ $appointment->reschedule_proposed_time ?? '' }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($hasPendingReschedule)
                                                <div class="action-row">
                                                    <button class="mini-btn" type="button" data-appointment-action="accept" data-appointment-id="{{ $appointment->id }}">Accept</button>
                                                    <button class="mini-btn" type="button" data-appointment-action="reject" data-appointment-id="{{ $appointment->id }}">Reject</button>
                                                </div>
                                            @else
                                                <span class="status info">No actions</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <div class="request-empty" style="margin:0;">No appointments booked yet.</div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'notifications' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>Notifications</h2>
                            <p>Keep track of order updates, consultation reminders, custom request progress, and announcements.</p>
                        </div>
                    </div>
                    <div class="notification-list">
                        @forelse (($customerNotifications ?? collect()) as $notification)
                            <article class="notification-card">
                                <div class="notification-top">
                                    <strong>{{ $notification->title }}</strong>
                                    <span class="status {{ $notification->status_class }}">{{ $notification->status }}</span>
                                </div>
                                @if ($notification->imageUrl())
                                    <img src="{{ $notification->imageUrl() }}" alt="{{ $notification->title }}">
                                @endif
                                <p>{{ $notification->message }}</p>
                                @if (!empty($notification->action_label) && !empty($notification->action_url))
                                    <a class="mini-btn notification-action" href="{{ $notification->action_url }}">
                                        {{ $notification->action_label }}</a>
                                @endif
                                <small style="color:#8b7150;">
                                    {{ $notification->published_at?->format('Y-m-d') ?? $notification->created_at?->format('Y-m-d') }}
                                    @if ($notification->category)
                                        &middot; {{ $notification->category }}
                                    @endif
                                </small>
                            </article>
                        @empty
                            <div class="request-empty">No notifications yet. Admin announcements and updates will appear here once posted.</div>
                        @endforelse
                    </div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'contact-messages' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>Contact Messages</h2>
                            <p>Review the contact messages you have sent to the admin team and read their replies in one place.</p>
                        </div>
                    </div>
                    <div class="contact-message-toolbar">
                        <p>Your sent contact messages and admin replies appear here. Use the button below if you want to send a fresh message from the contact form.</p>
                        <button class="contact-message-cta" type="button" id="contactMessageRedirectBtn">Open Contact Form</button>
                    </div>
                    <div class="contact-message-stack" id="customerContactMessageList"></div>
                </section>

                <section class="section-block {{ ($activeSection ?? '') === 'settings' ? 'active' : '' }}">
                    <div class="section-head">
                        <div>
                            <h2>Settings</h2>
                            <p>Update your password and keep your customer account secure.</p>
                        </div>
                    </div>
                    <div class="content-card" id="change-password">
                        @if (session('password_success'))
                            <div class="profile-feedback success" style="margin-bottom:14px;">{{ session('password_success') }}</div>
                        @endif
                        <form action="{{ route('settings.password.update') }}" method="POST">
                            @csrf
                            <div class="form-grid">
                                <div class="field">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" placeholder="Enter current password" autocomplete="current-password">
                                    @error('current_password')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label>New Password</label>
                                    <input type="password" name="password" placeholder="Enter new password" autocomplete="new-password">
                                    @error('password')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="field full">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="password_confirmation" placeholder="Confirm new password" autocomplete="new-password">
                                </div>
                            </div>
                            @error('password_confirmation')
                                <div class="field-error" style="margin-top:8px;">{{ $message }}</div>
                            @enderror
                            <p class="form-note" style="margin-top:10px;">Changing your password will sign you out of other devices for security.</p>
                            <div class="form-actions"><button class="submit-btn" type="submit">Update Password</button></div>
                        </form>
                    </div>
                </section>
            </main>
        </div>
    </div>

    <div class="order-modal" id="orderDetailsModal" aria-hidden="true">
        <div class="order-modal-card">
            <div class="order-modal-head">
                <div>
                    <h3>Order Details</h3>
                    <p id="orderDetailsSubtitle">Full order summary</p>
                </div>
                <button class="modal-close" type="button" data-close-modal="orderDetailsModal"><i class="fas fa-times"></i></button>
            </div>
            <div class="order-modal-body">
                <div class="order-detail-layout">
                    <div class="order-image-box">
                        <img id="orderDetailImage" src="" alt="Ordered product">
                        <div class="order-image-caption" id="orderDetailCaption"></div>
                    </div>
                    <div>
                        <div class="order-detail-grid">
                            <div class="order-detail-item"><span>Order ID</span><strong id="detailOrderId"></strong></div>
                            <div class="order-detail-item"><span>Status</span><strong id="detailStatus"></strong></div>
                            <div class="order-detail-item"><span>Order Date</span><strong id="detailDate"></strong></div>
                            <div class="order-detail-item"><span>Quantity</span><strong id="detailQty"></strong></div>
                            <div class="order-detail-item"><span>Total Amount</span><strong id="detailTotal"></strong></div>
                            <div class="order-detail-item"><span id="detailDueNowLabel">Paid Amount</span><strong id="detailDueNow"></strong></div>
                            <div class="order-detail-item"><span id="detailBalanceDueLabel">Amount Left to Pay</span><strong id="detailBalanceDue"></strong></div>
                            <div class="order-detail-item"><span>Payment Method</span><strong id="detailPayment"></strong></div>
                            <div class="order-detail-item"><span>Receipt</span><strong id="detailReceipt"></strong></div>
                            <div class="order-detail-item"><span>Delivery / Pickup</span><strong id="detailAddress"></strong></div>
                            <div class="order-detail-item"><span>Contact Number</span><strong id="detailContact"></strong></div>
                        </div>
                        <div class="order-summary-box">
                            <h4>Order Note</h4>
                            <p id="detailNote"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="order-modal" id="orderTrackModal" aria-hidden="true">
        <div class="order-modal-card">
            <div class="order-modal-head">
                <div>
                    <h3>Track Order</h3>
                    <p id="orderTrackSubtitle">Current order journey</p>
                </div>
                <button class="modal-close" type="button" data-close-modal="orderTrackModal"><i class="fas fa-times"></i></button>
            </div>
            <div class="order-modal-body">
                <div class="tracker-banner">
                    <strong id="trackStatusLabel"></strong>
                    <span id="trackStatusMessage"></span>
                </div>
                <div class="tracker-card">
                    <div class="tracker-line">
                        <div class="tracker-step" data-step="1">
                            <div class="tracker-dot"><i class="fas fa-receipt"></i></div>
                            <div class="tracker-content"><strong>Pending</strong><p>Order received and waiting for confirmation.</p></div>
                        </div>
                        <div class="tracker-step" data-step="2">
                            <div class="tracker-dot"><i class="fas fa-tools"></i></div>
                            <div class="tracker-content"><strong>Processing</strong><p>Jewellery preparation, stone setting, and quality review in progress.</p></div>
                        </div>
                        <div class="tracker-step" data-step="3">
                            <div class="tracker-dot"><i class="fas fa-truck"></i></div>
                            <div class="tracker-content"><strong id="trackerStep3Title">Out for Delivery / Ready for Pickup</strong><p id="trackerStep3Text">The order has left our workshop and is on the way to you or ready at the showroom.</p></div>
                        </div>
                        <div class="tracker-step" data-step="4">
                            <div class="tracker-dot"><i class="fas fa-circle-check"></i></div>
                            <div class="tracker-content"><strong id="trackerStep4Title">Delivered</strong><p id="trackerStep4Text">Your order has been completed successfully.</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="order-modal" id="cartCheckoutModal" aria-hidden="true">
        <div class="order-modal-card">
            <div class="order-modal-head">
                <div>
                    <h3>Ready For Checkout</h3>
                    <p id="cartCheckoutSubtitle">Your selected items are prepared for checkout.</p>
                </div>
                <button class="modal-close" type="button" data-close-modal="cartCheckoutModal"><i class="fas fa-times"></i></button>
            </div>
            <div class="order-modal-body">
                <div class="checkout-list" id="cartCheckoutList"></div>
                <div class="checkout-total">
                    <span>Selected total</span>
                    <strong id="cartCheckoutTotal">Rs 0</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="order-modal" id="customRequestModal" aria-hidden="true">
        <div class="order-modal-card">
            <div class="order-modal-head">
                <div>
                    <h3>New Custom Request</h3>
                    <p>Share the exact details our admin team needs for a custom jewellery review.</p>
                </div>
                <button class="modal-close" type="button" data-close-modal="customRequestModal"><i class="fas fa-times"></i></button>
            </div>
            <div class="order-modal-body">
                <form class="custom-request-form" id="customRequestForm" action="{{ route('custom.jewellery.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="request-modal-grid">
                        <div class="field">
                            <label>Jewellery Type</label>
                            <select name="jewellery_type_id" id="customJewelleryType" required>
                                <option value="">Select jewellery type</option>
                                @foreach (($customJewelleryTypes ?? []) as $type)
                                    <option
                                        value="{{ $type['id'] }}"
                                        data-slug="{{ $type['slug'] }}"
                                        data-measurement-label="{{ $type['measurement_label'] }}"
                                        data-measurement-placeholder="{{ $type['measurement_placeholder'] }}"
                                        @selected(old('jewellery_type_id') == $type['id'])
                                    >{{ $type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label>Available Gem</label>
                            <select name="gem_product_id" required>
                                <option value="">Select gem</option>
                                @foreach (($customGemOptions ?? []) as $gem)
                                    <option value="{{ $gem['id'] }}" @selected(old('gem_product_id') == $gem['id'])>
                                        {{ $gem['label'] }}@if(!empty($gem['meta'])) - {{ $gem['meta'] }}@endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field">
                            <label>Metal</label>
                            <select name="metal" required>
                                <option value="">Select metal</option>
                                <option @selected(old('metal') === 'White Gold')>White Gold</option>
                                <option @selected(old('metal') === 'Rose Gold')>Rose Gold</option>
                                <option @selected(old('metal') === 'Yellow Gold')>Yellow Gold</option>
                                <option @selected(old('metal') === 'Silver')>Silver</option>
                                <option @selected(old('metal') === 'Platinum')>Platinum</option>
                            </select>
                        </div>
                        <div class="field">
                            <label id="customMeasurementLabel">Measurement</label>
                            <select name="size_value" id="customMeasurementInput" data-selected-value="{{ old('size_value') }}" required>
                                <option value="">Select a jewellery type first</option>
                            </select>
                        </div>
                        <div class="field full">
                            <div class="type-specific-grid">
                                <div class="type-group" data-type-group="ring" hidden>
                                    <span class="type-group-title">Ring Details</span>
                                    <div class="request-modal-grid">
                                        <div class="field"><label>Band Type</label><select name="ring_band_type" data-field-option="ring_band_type" data-selected-value="{{ old('ring_band_type') }}" disabled><option value="">Select band type</option></select></div>
                                        <div class="field"><label>Gem Cut</label><select name="ring_gem_cut" data-field-option="ring_gem_cut" data-selected-value="{{ old('ring_gem_cut') }}" disabled><option value="">Select gem cut</option></select></div>
                                        <div class="field full"><label>Setting Style</label><select name="ring_setting_style" data-field-option="ring_setting_style" data-selected-value="{{ old('ring_setting_style') }}" disabled><option value="">Select setting style</option></select></div>
                                    </div>
                                </div>
                                <div class="type-group" data-type-group="necklace" hidden>
                                    <span class="type-group-title">Necklace Details</span>
                                    <div class="request-modal-grid">
                                        <div class="field"><label>Chain Type</label><select name="necklace_chain_type" data-field-option="necklace_chain_type" data-selected-value="{{ old('necklace_chain_type') }}" disabled><option value="">Select chain type</option></select></div>
                                        <div class="field"><label>Pendant Type</label><select name="necklace_pendant_type" data-field-option="necklace_pendant_type" data-selected-value="{{ old('necklace_pendant_type') }}" disabled><option value="">Select pendant type</option></select></div>
                                        <div class="field full"><label>Chain Style</label><select name="necklace_chain_style" data-field-option="necklace_chain_style" data-selected-value="{{ old('necklace_chain_style') }}" disabled><option value="">Select chain style</option></select></div>
                                    </div>
                                </div>
                                <div class="type-group" data-type-group="bracelet" hidden>
                                    <span class="type-group-title">Bracelet Details</span>
                                    <div class="request-modal-grid">
                                        <div class="field"><label>Bracelet Type</label><select name="bracelet_bracelet_type" data-field-option="bracelet_bracelet_type" data-selected-value="{{ old('bracelet_bracelet_type') }}" disabled><option value="">Select bracelet type</option></select></div>
                                        <div class="field"><label>Clasp Type</label><select name="bracelet_clasp_type" data-field-option="bracelet_clasp_type" data-selected-value="{{ old('bracelet_clasp_type') }}" disabled><option value="">Select clasp type</option></select></div>
                                        <div class="field full"><label>Finish</label><select name="bracelet_finish" data-field-option="bracelet_finish" data-selected-value="{{ old('bracelet_finish') }}" disabled><option value="">Select finish</option></select></div>
                                    </div>
                                </div>
                                <div class="type-group" data-type-group="earring" hidden>
                                    <span class="type-group-title">Earring Details</span>
                                    <div class="request-modal-grid">
                                        <div class="field"><label>Earring Type</label><select name="earring_earring_type" data-field-option="earring_earring_type" data-selected-value="{{ old('earring_earring_type') }}" disabled><option value="">Select earring type</option></select></div>
                                        <div class="field"><label>Backing Type</label><select name="earring_backing_type" data-field-option="earring_backing_type" data-selected-value="{{ old('earring_backing_type') }}" disabled><option value="">Select backing type</option></select></div>
                                        <div class="field full"><label>Drop Style</label><select name="earring_drop_style" data-field-option="earring_drop_style" data-selected-value="{{ old('earring_drop_style') }}" disabled><option value="">Select drop style</option></select></div>
                                    </div>
                                </div>
                                <div class="type-group" data-type-group="chain" hidden>
                                    <span class="type-group-title">Chain Details</span>
                                    <div class="request-modal-grid">
                                        <div class="field"><label>Chain Type</label><select name="chain_chain_type" data-field-option="chain_chain_type" data-selected-value="{{ old('chain_chain_type') }}" disabled><option value="">Select chain type</option></select></div>
                                        <div class="field"><label>Link Style</label><select name="chain_link_style" data-field-option="chain_link_style" data-selected-value="{{ old('chain_link_style') }}" disabled><option value="">Select link style</option></select></div>
                                        <div class="field full"><label>Clasp Type</label><select name="chain_clasp_type" data-field-option="chain_clasp_type" data-selected-value="{{ old('chain_clasp_type') }}" disabled><option value="">Select clasp type</option></select></div>
                                    </div>
                                </div>
                                <div class="type-group" data-type-group="bangle" hidden>
                                    <span class="type-group-title">Bangle Details</span>
                                    <div class="request-modal-grid">
                                        <div class="field"><label>Bangle Type</label><select name="bangle_bangle_type" data-field-option="bangle_bangle_type" data-selected-value="{{ old('bangle_bangle_type') }}" disabled><option value="">Select bangle type</option></select></div>
                                        <div class="field"><label>Finish</label><select name="bangle_finish" data-field-option="bangle_finish" data-selected-value="{{ old('bangle_finish') }}" disabled><option value="">Select finish</option></select></div>
                                        <div class="field full"><label>Hinge Type</label><select name="bangle_hinge_type" data-field-option="bangle_hinge_type" data-selected-value="{{ old('bangle_hinge_type') }}" disabled><option value="">Select hinge type</option></select></div>
                                    </div>
                                </div>
                                <div class="type-group" data-type-group="pendant" hidden>
                                    <span class="type-group-title">Pendant Details</span>
                                    <div class="request-modal-grid">
                                        <div class="field"><label>Pendant Shape</label><select name="pendant_pendant_shape" data-field-option="pendant_pendant_shape" data-selected-value="{{ old('pendant_pendant_shape') }}" disabled><option value="">Select pendant shape</option></select></div>
                                        <div class="field"><label>Setting Type</label><select name="pendant_setting_type" data-field-option="pendant_setting_type" data-selected-value="{{ old('pendant_setting_type') }}" disabled><option value="">Select setting type</option></select></div>
                                        <div class="field full"><label>Bail Type</label><select name="pendant_bail_type" data-field-option="pendant_bail_type" data-selected-value="{{ old('pendant_bail_type') }}" disabled><option value="">Select bail type</option></select></div>
                                    </div>
                                </div>
                                <div class="type-group" data-type-group="other-jewellery" hidden>
                                    <span class="type-group-title">Other Jewellery</span>
                                    <div class="request-modal-grid">
                                        <div class="field full"><label>Design Focus</label><select name="other_design_focus" data-field-option="other_design_focus" data-selected-value="{{ old('other_design_focus') }}" disabled><option value="">Select design focus</option></select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field"><label>Engraving</label><input type="text" name="engraving" value="{{ old('engraving') }}" placeholder="Forever A"></div>
                        <div class="field full"><label>Design Notes</label><textarea name="notes" placeholder="Describe the shape, setting, inspiration, and any must-have finishing details." required>{{ old('notes') }}</textarea></div>
                        <div class="field full"><label>Reference Images</label><input type="file" name="reference_images[]" id="customReferenceImages" accept="image/*" multiple></div>
                    </div>
                    <div class="request-upload-note" id="customReferenceNote">You can attach inspiration images, sketches, or close-up samples for the admin review team.</div>
                    <div class="form-actions"><button class="submit-btn" type="submit">Send Request</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="order-modal" id="refundRequestModal" aria-hidden="true">
        <div class="order-modal-card">
            <div class="order-modal-head">
                <div>
                    <h3>Request Refund</h3>
                    <p id="refundRequestSubtitle">Submit your reason for review.</p>
                </div>
                <button class="modal-close" type="button" data-close-modal="refundRequestModal"><i class="fas fa-times"></i></button>
            </div>
            <div class="order-modal-body">
                <form class="request-modal-form" id="refundRequestForm">
                    @csrf
                    <input type="hidden" name="order_id" id="refundRequestOrderId">
                    <div class="request-modal-grid">
                        <div class="field full">
                            <label>Reason for Refund</label>
                            <textarea name="reason" id="refundRequestReason" placeholder="Tell us why you are requesting a refund." required></textarea>
                        </div>
                    </div>
                    <div class="request-upload-note">Refund requests are available only after the order has been completed.</div>
                    <div class="form-actions"><button class="submit-btn" type="submit">Submit Refund Request</button></div>
                </form>
            </div>
        </div>
    </div>

    <div class="order-modal" id="consultationRequestModal" aria-hidden="true">
        <div class="order-modal-card">
                <div class="order-modal-head">
                    <div>
                        <h3>Request Consultation</h3>
                        <p>Send a consultation topic and note for admin review.</p>
                    </div>
                    <button class="modal-close" type="button" data-close-modal="consultationRequestModal"><i class="fas fa-times"></i></button>
                </div>
                <div class="order-modal-body">
                    <form class="request-modal-form" id="consultationRequestForm" action="{{ route('consultations.store') }}" method="POST">
                        @csrf
                        <div class="request-modal-grid">
                            <div class="field"><label>Request Type</label><select name="request_type" required><option value="">Select request type</option><option>Gem Advice</option><option>Custom Design</option><option>Zodiac Recommendation</option></select></div>
                            <div class="field full"><label>Consultation Note</label><textarea name="customer_note" placeholder="Tell the consultant what gemstone guidance, design support, or occasion styling help you need." required></textarea></div>
                        </div>
                        <div class="form-actions"><button class="submit-btn" type="submit">Send Consultation Request</button></div>
                    </form>
                </div>
            </div>
    </div>

    <div class="order-modal" id="appointmentBookingModal" aria-hidden="true">
        <div class="order-modal-card">
            <div class="order-modal-head">
                <div>
                    <h3>Book Appointment</h3>
                    <p>Share the appointment details so the admin team can assign a consultant and approve your booking.</p>
                </div>
                <button class="modal-close" type="button" data-close-modal="appointmentBookingModal"><i class="fas fa-times"></i></button>
            </div>
            <div class="order-modal-body">
                <form class="request-modal-form" id="appointmentBookingForm" action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="request-modal-grid">
                        <div class="field"><label>Appointment Date</label><input id="appointmentDateInput" type="date" name="preferred_date" required></div>
                        <div class="field">
                            <label>Appointment Time</label>
                            <select id="appointmentTimeSelect" name="preferred_time" required disabled>
                                <option value="">Select a date first</option>
                            </select>
                            <span class="request-upload-note">Available Monday to Saturday, 8:00 AM to 4:00 PM, in 30-minute slots. Booked slots are removed automatically.</span>
                        </div>
                        <div class="field"><label>Appointment Mode</label><select name="appointment_mode" required><option value="">Select mode</option><option>In-store</option><option>Video Call</option></select></div>
                        <div class="field"><label>Consultation Focus</label><select name="appointment_topic" required><option value="">Select focus</option><option>Gem Advice</option><option>Custom Design</option><option>Zodiac Recommendation</option><option>Jewellery Styling</option></select></div>
                        <div class="field"><label>Contact Number</label><input type="text" name="contact_number" placeholder="07XXXXXXXX" required></div>
                        <div class="field full"><label>Appointment Details</label><textarea name="customer_note" placeholder="Tell the admin team what you need help with, whether you need gemstone guidance, design review, or an in-store appointment setup." required></textarea></div>
                    </div>
                    <div class="form-actions"><button class="submit-btn" type="submit">Send Appointment Request</button></div>
                </form>
            </div>
        </div>
    </div>

    <x-footer />
    @php
        $consultationThreadsForJs = ($consultationRequests ?? collect())->map(function ($request) {
            $canReply = $request->consultant_id && $request->status === 'Approved';

            return [
                'consultationId' => $request->id,
                'id' => $request->chat_thread_id,
                'requestId' => $request->request_number,
                'customerName' => trim((($request->customer?->first_name ?? '') . ' ' . ($request->customer?->last_name ?? ''))),
                'consultantName' => trim((($request->consultant?->first_name ?? '') . ' ' . ($request->consultant?->last_name ?? ''))) ?: 'Consultant Team',
                'requestType' => $request->request_type,
                'status' => $request->status,
                'consultantId' => $request->consultant_id,
                'canReply' => $canReply,
                'submittedAt' => $request->created_at?->format('Y-m-d'),
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
        (() => {
            const cartStorageKey = 'pg_cart';
            const cartSelectedStorageKey = 'pg_cart_selected';
            const checkoutStorageKey = 'pg_checkout_session';
            const consultationSyncStorageKey = 'pg_consultation_thread_sync';
            const consultationMessageStoreRoute = @json(url('/consultations'));
            const consultationThreadSyncRoute = @json(url('/consultations/threads'));
            const csrfToken = @json(csrf_token());
            const initialConsultationThreads = @json($consultationThreadsForJs);
            const initialCartItems = @json($cartItems ?? []);
            const initialPlacedOrders = @json($customerOrders ?? []);
            const initialWishlistItems = @json($wishlistItems ?? []);
            const initialCustomerContactMessages = @json($customerContactMessages ?? []);
            const cartSyncRoute = @json(route('cart.sync'));
            const wishlistGrid = document.getElementById('wishlistGrid');
            const cartGrid = document.getElementById('cartGrid');
            const cartSummary = document.getElementById('cartSummary');
            const cartSelectedTotal = document.getElementById('cartSelectedTotal');
            const cartCheckoutPanel = document.getElementById('cartCheckoutPanel');
            const ordersTableBody = document.getElementById('ordersTableBody');
            const ordersSummaryAll = document.getElementById('ordersSummaryAll');
            const ordersSummaryActive = document.getElementById('ordersSummaryActive');
            const ordersSummaryPickup = document.getElementById('ordersSummaryPickup');
            const cartRoute = @json(route('cart'));
            const checkoutRoute = @json(route('checkout'));
            const cartItemsStoreRoute = @json(route('cart.items.store'));
            const wishlistDeleteBase = @json(url('/wishlist/items'));
            const customRequestModal = document.getElementById('customRequestModal');
            const customRequestForm = document.getElementById('customRequestForm');
            const newCustomRequestBtn = document.getElementById('newCustomRequestBtn');
            const refundRequestModal = document.getElementById('refundRequestModal');
            const refundRequestForm = document.getElementById('refundRequestForm');
            const refundRequestSubtitle = document.getElementById('refundRequestSubtitle');
            const refundRequestOrderId = document.getElementById('refundRequestOrderId');
            const refundRequestReason = document.getElementById('refundRequestReason');
            const refundRequestRoute = @json(route('returns.refund.request'));
            const customReferenceImages = document.getElementById('customReferenceImages');
            const customReferenceNote = document.getElementById('customReferenceNote');
            const customJewelleryTypes = @json($customJewelleryTypes ?? []);
            const customMeasurementOptions = @json($customMeasurementOptions ?? []);
            const customTypeFieldOptions = @json($customTypeFieldOptions ?? []);
            const customJewelleryTypeSelect = document.getElementById('customJewelleryType');
            const customMeasurementLabel = document.getElementById('customMeasurementLabel');
            const customMeasurementInput = document.getElementById('customMeasurementInput');
            const customTypeOptionSelects = Array.from(document.querySelectorAll('[data-field-option]'));
            const customTypeGroups = Array.from(document.querySelectorAll('[data-type-group]'));
            const shouldOpenCustomRequestModal = @json($errors->any() && old('jewellery_type_id') !== null);
            const consultationRequestModal = document.getElementById('consultationRequestModal');
            const consultationRequestForm = document.getElementById('consultationRequestForm');
            const requestConsultationBtn = document.getElementById('requestConsultationBtn');
            const consultationHistoryBody = document.getElementById('consultationHistoryBody');
            const customerChatContacts = document.getElementById('customerChatContacts');
            const customerConsultChatTitle = document.getElementById('customerConsultChatTitle');
            const customerConsultChatMeta = document.getElementById('customerConsultChatMeta');
            const customerConsultChatMessages = document.getElementById('customerConsultChatMessages');
            const customerConsultChatInput = document.getElementById('customerConsultChatInput');
            const customerConsultChatImage = document.getElementById('customerConsultChatImage');
            const customerConsultChatSend = document.getElementById('customerConsultChatSend');
            const appointmentBookingModal = document.getElementById('appointmentBookingModal');
            const appointmentBookingForm = document.getElementById('appointmentBookingForm');
            const bookAppointmentBtn = document.getElementById('bookAppointmentBtn');
            const appointmentDateInput = document.getElementById('appointmentDateInput');
            const appointmentTimeSelect = document.getElementById('appointmentTimeSelect');
            const appointmentUpdateRoute = @json(url('/appointments'));
            const customerContactMessageList = document.getElementById('customerContactMessageList');
            const contactMessageRedirectBtn = document.getElementById('contactMessageRedirectBtn');
            const customerName = @json(trim((auth()->user()->first_name ?? '').' '.(auth()->user()->last_name ?? '')));
            const customerEmail = @json(auth()->user()->email);
            const contactPageRoute = @json(route('contact').'#customerContactForm');
            const customerConsultChatDefaultNote = customerConsultChatInput?.placeholder || 'Type your question, follow-up, or design note here...';
            const appointmentSlotMap = @json($appointmentSlotMap ?? []);
            const appointmentSlotTimes = Array.from({ length: 16 }, (_, index) => {
                const hour = Math.floor(index / 2) + 8;
                const minute = index % 2 === 0 ? '00' : '30';
                return `${String(hour).padStart(2, '0')}:${minute}`;
            }).slice(0, 16);
            window.__cartItems = Array.isArray(initialCartItems) ? initialCartItems : [];
            const getCartItems = () => {
                return Array.isArray(window.__cartItems) ? window.__cartItems : [];
            };
            const saveCartItems = (items) => {
                window.__cartItems = Array.isArray(items) ? items : [];
                localStorage.setItem(cartStorageKey, JSON.stringify(window.__cartItems));
                fetch(cartSyncRoute, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        items: window.__cartItems.map((item) => ({
                            id: item.product_id || item.id,
                            quantity: Number(item.quantity) || 1,
                        })),
                    }),
                }).catch(() => {});
            };
            const updateCartItemQuantity = (itemId, delta) => {
                const nextItems = getCartItems().map((item) => {
                    if (item.id !== itemId) return item;
                    const currentQty = Number(item.quantity) || 1;
                    const stockLimit = Number(item.stock || 99) || 99;
                    const nextQty = Math.min(Math.max(currentQty + delta, 1), stockLimit);
                    return { ...item, quantity: nextQty };
                });
                saveCartItems(nextItems);
                renderCart();
            };
            const getSelectedCartIds = () => {
                try {
                    return JSON.parse(localStorage.getItem(cartSelectedStorageKey) || '[]');
                } catch (error) {
                    return [];
                }
            };
            const saveSelectedCartIds = (ids) => {
                localStorage.setItem(cartSelectedStorageKey, JSON.stringify(ids));
            };
            const saveCheckoutSession = (items, source = 'cart') => {
                localStorage.setItem(checkoutStorageKey, JSON.stringify({
                    source,
                    createdAt: new Date().toISOString(),
                    items
                }));
            };
            const getPlacedOrders = () => (Array.isArray(initialPlacedOrders) ? initialPlacedOrders : []);
            const toLocalDateInputValue = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };
            const getTodayDateValue = () => toLocalDateInputValue(new Date());
            const formatAppointmentSlotLabel = (slot) => {
                const [hourPart, minutePart] = String(slot || '00:00').split(':');
                const hour = Number(hourPart) || 0;
                const suffix = hour >= 12 ? 'PM' : 'AM';
                const displayHour = hour % 12 || 12;

                return `${displayHour}:${minutePart} ${suffix}`;
            };
            const getBookedAppointmentSlots = (dateValue) => {
                if (!dateValue || !appointmentSlotMap || !Array.isArray(appointmentSlotMap[dateValue])) {
                    return [];
                }

                return appointmentSlotMap[dateValue].filter(Boolean);
            };
            const isBookableAppointmentDate = (dateValue) => {
                if (!dateValue) return false;
                const date = new Date(`${dateValue}T00:00:00`);
                if (Number.isNaN(date.getTime())) return false;
                const day = date.getDay();
                return day >= 1 && day <= 6 && dateValue >= getTodayDateValue();
            };
            const isFutureAppointmentTime = (slot) => {
                const [hourPart, minutePart] = String(slot || '00:00').split(':');
                const slotMinutes = (Number(hourPart) || 0) * 60 + (Number(minutePart) || 0);
                const now = new Date();
                return slotMinutes > ((now.getHours() * 60) + now.getMinutes());
            };
            const renderAppointmentTimeOptions = () => {
                if (!appointmentTimeSelect) return;

                const selectedDate = appointmentDateInput?.value?.trim() || '';
                const currentValue = appointmentTimeSelect.value || appointmentTimeSelect.dataset.selectedValue || '';
                const placeholder = document.createElement('option');
                placeholder.value = '';
                placeholder.textContent = !selectedDate
                    ? 'Select a date first'
                    : (isBookableAppointmentDate(selectedDate) ? 'Select a time slot' : 'Select a Monday to Saturday date');

                const options = document.createDocumentFragment();
                options.appendChild(placeholder);

                const isDateAllowed = isBookableAppointmentDate(selectedDate);
                const bookedSlots = new Set(getBookedAppointmentSlots(selectedDate));
                const availableSlots = isDateAllowed
                    ? appointmentSlotTimes.filter((slot) => !bookedSlots.has(slot) && (selectedDate !== getTodayDateValue() || isFutureAppointmentTime(slot)))
                    : [];

                availableSlots.forEach((slot) => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = formatAppointmentSlotLabel(slot);
                    if (slot === currentValue) {
                        option.selected = true;
                    }
                    options.appendChild(option);
                });

                appointmentTimeSelect.innerHTML = '';
                appointmentTimeSelect.appendChild(options);
                appointmentTimeSelect.disabled = !isDateAllowed;
                appointmentTimeSelect.value = availableSlots.includes(currentValue) ? currentValue : '';
                appointmentTimeSelect.setCustomValidity(selectedDate && isDateAllowed && !availableSlots.length
                    ? 'No time slots are available for this date.'
                    : '');

                if (selectedDate && isDateAllowed && !availableSlots.length) {
                    placeholder.textContent = 'No time slots left for this date';
                }
            };
            const syncAppointmentDateValidity = () => {
                if (!appointmentDateInput) return;
                const selectedDate = appointmentDateInput.value.trim();
                appointmentDateInput.setCustomValidity(selectedDate && !isBookableAppointmentDate(selectedDate)
                    ? 'Appointments are only available Monday through Saturday.'
                    : '');
                renderAppointmentTimeOptions();
            };
            const updateAppointmentOnServer = async (appointmentId, payload) => {
                const response = await fetch(`${appointmentUpdateRoute}/${appointmentId}/status`, {
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
                    throw new Error(data?.message || 'Unable to update the appointment.');
                }

                return data;
            };
            const submitConsultationMessage = async (consultationId, text, imageFile = null) => {
                const formData = new FormData();
                formData.append('message', text);
                if (imageFile) {
                    formData.append('image', imageFile);
                }

                const response = await fetch(`${consultationMessageStoreRoute}/${consultationId}/messages`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const payload = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(payload?.message || 'Unable to send the message.');
                }

                return payload.message;
            };
            const syncConsultationThreadsFromServer = async () => {
                try {
                    const response = await fetch(consultationThreadSyncRoute, {
                        headers: { 'Accept': 'application/json' },
                    });
                    if (!response.ok) return;
                    const payload = await response.json().catch(() => ({}));
                    if (!Array.isArray(payload?.threads)) return;

                    const currentActiveId = activeConsultationChatId;
                    saveConsultationChatThreads(payload.threads);

                    if (currentActiveId && getCustomerConsultationThreads().some((thread) => thread.id === currentActiveId)) {
                        activeConsultationChatId = currentActiveId;
                    } else {
                        activeConsultationChatId = getCustomerConsultationThreads()[0]?.id || null;
                    }

                    renderCustomerConsultationChat();
                } catch (error) {
                }
            };
            const broadcastConsultationThreadSync = (consultationId) => {
                try {
                    localStorage.setItem(consultationSyncStorageKey, JSON.stringify({
                        consultationId,
                        at: Date.now(),
                        sender: 'customer',
                    }));
                } catch (error) {
                }
            };
            const submitRefundRequest = async (orderId, reason) => {
                const response = await fetch(refundRequestRoute, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ order_id: Number(orderId), reason }),
                });

                const payload = await response.json().catch(() => ({}));
                if (!response.ok) {
                    throw new Error(payload?.message || 'Unable to submit refund request.');
                }

                return payload;
            };
            const slugifyName = (value) => String(value || '')
                .toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '') || 'consultation';
            const escapeHtml = (value) => String(value || '')
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#39;');
            const formatChatTime = (date = new Date()) => date.toLocaleTimeString('en-LK', {
                timeZone: 'Asia/Colombo',
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            const buildConsultationThreadMeta = (thread) => `${thread.requestType || 'Consultation'} / Customer and consultant thread`;
            const renderConsultationMessageMedia = (message) => {
                if (!message?.imageUrl) return '';
                const safeUrl = escapeHtml(message.imageUrl);
                return `<div class="chat-media"><img src="${safeUrl}" alt="Consultation attachment"></div>`;
            };
            const getConsultationThreadPreview = (thread) => {
                const latestMessage = Array.isArray(thread.messages) && thread.messages.length
                    ? thread.messages[thread.messages.length - 1]
                    : null;
                return latestMessage?.text || 'Continue your consultant conversation here.';
            };
            const populateCustomSelect = (select, options = [], selectedValue = '', placeholder = 'Select an option') => {
                if (!select) {
                    return;
                }

                const isEnabled = !select.disabled;
                const currentValue = selectedValue || select.value || select.dataset.selectedValue || '';
                const baseOptions = [`<option value="">${escapeHtml(placeholder)}</option>`];
                const optionMarkup = (Array.isArray(options) ? options : []).map((option) => {
                    const value = String(option ?? '');
                    const selected = value === String(currentValue) ? ' selected' : '';
                    return `<option value="${escapeHtml(value)}"${selected}>${escapeHtml(value)}</option>`;
                });
                select.innerHTML = [...baseOptions, ...optionMarkup].join('');
                if (isEnabled) {
                    select.disabled = false;
                }
            };
            const syncCustomJewelleryFields = () => {
                if (!customJewelleryTypeSelect || !customMeasurementLabel || !customMeasurementInput) {
                    return;
                }

                const selectedOption = customJewelleryTypeSelect.selectedOptions?.[0] || null;
                const selectedSlug = selectedOption?.dataset.slug || '';
                customMeasurementLabel.textContent = selectedOption?.dataset.measurementLabel || 'Measurement';

                populateCustomSelect(
                    customMeasurementInput,
                    customMeasurementOptions[selectedSlug] || [],
                    customMeasurementInput.value || customMeasurementInput.dataset.selectedValue || '',
                    selectedSlug ? 'Select measurement' : 'Select a jewellery type first'
                );
                customMeasurementInput.disabled = !selectedSlug;

                customTypeGroups.forEach((group) => {
                    const isActive = group.dataset.typeGroup === selectedSlug;
                    group.hidden = !isActive;
                    group.querySelectorAll('input, select, textarea').forEach((input) => {
                        if (isActive) {
                            input.removeAttribute('disabled');
                        } else {
                            input.setAttribute('disabled', 'disabled');
                        }
                    });
                });

                customTypeOptionSelects.forEach((select) => {
                    const optionKey = select.dataset.fieldOption || '';
                    if (!optionKey) {
                        return;
                    }

                    const options = customTypeFieldOptions[selectedSlug]?.[optionKey] || [];
                    populateCustomSelect(select, options, select.value || select.dataset.selectedValue || '', `Select ${select.closest('.field')?.querySelector('label')?.textContent || 'option'}`);
                });
            };
            const buildConsultationThreadTitle = (thread) => {
                const consultantName = thread?.consultantName || 'Consultant Team';
                const requestId = thread?.requestId ? ` (${thread.requestId})` : '';
                return `Chat with ${consultantName}${requestId}`;
            };
            let consultationThreadsState = normalizeConsultationThreads(initialConsultationThreads);
            const getConsultationChatThreads = () => consultationThreadsState;
            const saveConsultationChatThreads = (items) => {
                consultationThreadsState = normalizeConsultationThreads(items);
            };
            function normalizeConsultationThreads(items) {
                if (!Array.isArray(items)) return [];
                return items.filter((thread) => {
                    if (!thread || typeof thread !== 'object') return false;
                    const hasRequestLink = Boolean(thread.requestId);
                    return hasRequestLink;
                });
            }
            const getCustomerConsultationThreads = () => getConsultationChatThreads()
                .filter((thread) => Boolean(thread.requestId))
                .filter((thread) => thread.customerName === customerName)
                .sort((a, b) => {
                    const aRef = String(a.requestId || a.id || '');
                    const bRef = String(b.requestId || b.id || '');
                    return bRef.localeCompare(aRef, undefined, { numeric: true, sensitivity: 'base' });
                });
            const parsePrice = (priceText) => Number(String(priceText || '').replace(/[^\d.]/g, '')) || 0;
            const formatLkr = (value) => `Rs ${value.toLocaleString('en-LK')}`;
            const resolveTrackingStep = (status, trackingFlow) => {
                const normalized = String(status || '').trim().toLowerCase();
                if (normalized === 'completed' || normalized === 'pickup completed') return 4;
                if (normalized === 'out for delivery' || normalized === 'out for pickup' || normalized === 'ready for pickup' || normalized === 'ready to pickup') return 3;
                if (normalized === 'processing') return 2;
                if (trackingFlow === 'pickup' && normalized === 'pending') return 1;
                return 1;
            };
            const getSelectedCartItems = () => {
                const selectedIds = getSelectedCartIds();
                return getCartItems().filter((item) => selectedIds.includes(item.id));
            };
            const buildOrderRows = (orders = []) => orders.map((order) => {
                const qty = Array.isArray(order.items)
                    ? order.items.reduce((sum, item) => sum + (Number(item.quantity) || 1), 0)
                    : 1;
                const total = Number(order.itemsTotalLkr || 0) + Number(order.shippingPrice || 0);
                const pickupOnly = Boolean(order.pickupOnly);
                const orderStatus = String(order.status || 'Pending');
                const isPickupCompleted = pickupOnly && ['completed', 'pickup completed'].includes(orderStatus.toLowerCase());
                const isCompleted = orderStatus.toLowerCase() === 'completed' || orderStatus.toLowerCase() === 'pickup completed';
                const statusClass = isCompleted
                    ? 'delivered'
                    : (/processing/i.test(orderStatus) ? 'processing' : 'pending');
                const dueNow = isPickupCompleted ? total : Number(order.amountDueNow ?? total);
                const depositAmount = isPickupCompleted ? total : Number(order.depositAmount || 0);
                const balanceDue = isPickupCompleted ? 0 : Number(order.balanceDue || 0);
                const primaryItem = Array.isArray(order.items) && order.items.length ? order.items[0] : null;
                const reviewUrl = primaryItem?.id ? `{{ route('products.show', ['product' => '__PRODUCT__']) }}`.replace('__PRODUCT__', encodeURIComponent(primaryItem.id)) + '#reviewTab' : '';
                const productNames = Array.isArray(order.items)
                    ? order.items.map((item) => item.name).filter(Boolean).join(', ')
                    : 'Customer Order';
                const paymentLabel = order.paymentMethod === 'bank'
                    ? 'Bank Transfer'
                    : (order.paymentMethod === 'cod' ? 'Cash on Delivery' : 'Card Payment');
                const addressParts = [
                    order.customer?.address,
                    order.customer?.city,
                    order.customer?.town,
                    order.customer?.province,
                    order.customer?.postal_code
                ].filter(Boolean);
                const shippingNote = order.shippingMethod === 'express'
                    ? 'Your order has been placed successfully and is waiting for confirmation under express delivery.'
                    : order.shippingMethod === 'pickup'
                        ? (pickupOnly
                            ? (isPickupCompleted
                                ? 'This pickup order has been collected and marked fully paid.'
                                : 'This is a pickup-only order. The 20% deposit has been prepared for payment and the remaining balance will be settled at pickup.')
                            : 'Your order is set for store pickup and is waiting for confirmation before showroom preparation begins.')
                        : 'Your order has been placed successfully and is waiting for confirmation before dispatch begins.';
                const trackingFlow = order.shippingMethod === 'pickup' ? 'pickup' : 'delivery';
                const trackStep = resolveTrackingStep(orderStatus, trackingFlow);
                const trackLabel = isCompleted
                    ? (trackingFlow === 'pickup' ? 'Picked Up' : 'Delivered')
                    : (trackStep === 3 ? (trackingFlow === 'pickup' ? 'Ready to Pickup' : 'Out for Delivery') : (trackStep === 2 ? 'Processing' : 'Pending'));
                const trackMessage = isCompleted
                    ? (trackingFlow === 'pickup'
                        ? 'The customer has collected the order from the showroom and the order is now completed.'
                        : 'Your order has been completed successfully.')
                    : (trackStep === 3
                        ? (trackingFlow === 'pickup'
                            ? 'Your order is prepared and waiting at the showroom for customer pickup confirmation.'
                            : 'The order has left our workshop and is on the way to you.')
                        : (trackStep === 2
                            ? 'Jewellery preparation, stone setting, and quality review are in progress.'
                            : (trackingFlow === 'pickup'
                                ? 'We have received your pickup order and the admin team is reviewing it before showroom preparation.'
                                : 'We have received your checkout request and the admin team is reviewing the order details now.')));
                const paymentNote = pickupOnly
                    ? (isPickupCompleted ? 'Fully Paid at Pickup' : '20% Deposit Online / Balance at Pickup')
                    : (trackingFlow === 'pickup' ? 'Cash on Pickup / Card Confirmation' : paymentLabel);
                const addressLabel = order.shippingMethod === 'pickup'
                    ? 'Store Pickup - Ratnapura Showroom'
                    : addressParts.join(', ');
                const returnRequest = order.returnRequest || null;
                const returnDecision = String(returnRequest?.decision || '').trim();
                const returnStatus = String(returnRequest?.refundStatus || '').trim();
                const returnBadgeClass = returnDecision.toLowerCase() === 'approved'
                    ? (returnStatus.toLowerCase() === 'refunded' ? 'ok' : 'info')
                    : (returnDecision.toLowerCase() === 'rejected' ? 'bad' : 'warn');
                return `
                            <tr data-dynamic-order="${order.id}">
                                <td>${order.id}</td>
                                <td>${order.orderDate || ''}</td>
                                <td><span class="qty-badge">${qty}</span></td>
                                <td>${isPickupCompleted ? 'Fully Paid' : formatLkr(pickupOnly ? dueNow : total)}</td>
                                <td><span class="status ${statusClass}">${escapeHtml(orderStatus)}</span></td>
                                <td>
                                    <div class="order-action-stack">
                                    <div class="action-row">
                                        <button class="mini-btn js-order-details" type="button"
                                            data-order-id="${order.id}"
                                            data-product="${productNames.replace(/"/g, '&quot;')}"
                                            data-image="${primaryItem?.image || ''}"
                                            data-qty="${qty}"
                                            data-total="${formatLkr(total)}"
                                            data-due-now="${isPickupCompleted ? 'Fully Paid' : formatLkr(dueNow)}"
                                            data-balance-due="${isPickupCompleted ? 'Rs 0' : formatLkr(balanceDue)}"
                                            data-deposit="${formatLkr(depositAmount)}"
                                            data-payment="${paymentNote}"
                                            data-receipt-image="${order.receiptImage || ''}"
                                            data-address="${addressLabel.replace(/"/g, '&quot;')}"
                                            data-contact="${(order.customer?.phone || '').replace(/"/g, '&quot;')}"
                                            data-date="${order.orderDate || ''}"
                                            data-note="${shippingNote.replace(/"/g, '&quot;')}"
                                            data-status="${escapeHtml(orderStatus).replace(/"/g, '&quot;')}"
                                            data-status-class="${statusClass}"
                                            data-return-request-id="${returnRequest?.requestNumber || ''}"
                                            data-return-decision="${returnDecision}"
                                            data-return-status="${returnStatus}"
                                            data-tracking-flow="${trackingFlow}">View Details</button>
                                        <button class="mini-btn js-track-order" type="button"
                                            data-order-id="${order.id}"
                                            data-product="${productNames.replace(/"/g, '&quot;')}"
                                            data-status-label="${trackLabel}"
                                            data-track-message="${trackMessage.replace(/"/g, '&quot;')}"
                                            data-current-step="${trackStep}"
                                            data-tracking-flow="${trackingFlow}">Track Order</button>
                                        ${isCompleted && !returnRequest ? `<button class="mini-btn js-request-refund" type="button" data-order-db-id="${order.dbId || ''}" data-order-number="${order.id}" data-order-label="${escapeHtml(productNames).replace(/"/g, '&quot;')}" data-order-status="${escapeHtml(orderStatus).replace(/"/g, '&quot;')}">Request Refund</button>` : ''}
                                        ${isCompleted && reviewUrl ? `<a class="mini-btn" href="${reviewUrl}">Review</a>` : ''}
                                    </div>
                                    ${returnRequest ? `<span class="status ${returnBadgeClass} order-return-status">Return: ${escapeHtml(returnDecision || 'Pending Review')}${returnStatus ? ' / ' + escapeHtml(returnStatus) : ''}</span>` : ''}
                                    </div>
                                </td>
                            </tr>
                `;
            }).join('');
            const updateOrdersSummary = () => {
                if (!ordersTableBody) return;
                const rows = Array.isArray(initialPlacedOrders) ? initialPlacedOrders : [];
                const activeCount = rows.filter((order) => /pending|processing/i.test(String(order.status || 'Pending'))).length;
                const pickupCount = rows.filter((order) => /pickup/i.test(String(order.shippingMethod || ''))).length;
                if (ordersSummaryAll) ordersSummaryAll.textContent = String(rows.length);
                if (ordersSummaryActive) ordersSummaryActive.textContent = String(activeCount);
                if (ordersSummaryPickup) ordersSummaryPickup.textContent = String(pickupCount);
            };
            const bindOrderActionButtons = () => {
                document.querySelectorAll('.js-order-details').forEach((button) => {
                    if (button.dataset.bound === 'details') return;
                    button.dataset.bound = 'details';
                    button.addEventListener('click', () => {
                        const isFullyPaidPickup = String(button.dataset.status || '').toLowerCase() === 'pickup completed' || (String(button.dataset.status || '').toLowerCase() === 'completed' && String(button.dataset.trackingFlow || '').toLowerCase() === 'pickup');
                        document.getElementById('orderDetailsSubtitle').textContent = button.dataset.product;
                        document.getElementById('orderDetailImage').src = button.dataset.image;
                        document.getElementById('orderDetailCaption').textContent = button.dataset.product;
                        document.getElementById('detailOrderId').textContent = button.dataset.orderId;
                        document.getElementById('detailStatus').innerHTML = `<span class="status ${button.dataset.statusClass}">${button.dataset.status}</span>`;
                        document.getElementById('detailDate').textContent = button.dataset.date;
                        document.getElementById('detailQty').textContent = button.dataset.qty;
                        document.getElementById('detailTotal').textContent = button.dataset.total;
                        document.getElementById('detailDueNowLabel').textContent = isFullyPaidPickup ? 'Fully Paid' : 'Paid Amount';
                        document.getElementById('detailBalanceDueLabel').textContent = isFullyPaidPickup ? 'Outstanding Amount' : 'Amount Left to Pay';
                        document.getElementById('detailDueNow').textContent = button.dataset.dueNow || button.dataset.deposit || button.dataset.total;
                        document.getElementById('detailBalanceDue').textContent = button.dataset.balanceDue || 'Rs 0';
                        document.getElementById('detailPayment').textContent = button.dataset.payment;
                        document.getElementById('detailReceipt').innerHTML = button.dataset.receiptImage
                            ? `<a href="${button.dataset.receiptImage}" target="_blank" rel="noopener">View Uploaded Receipt</a>`
                            : 'Not uploaded';
                        document.getElementById('detailAddress').textContent = button.dataset.address;
                        document.getElementById('detailContact').textContent = button.dataset.contact;
                        document.getElementById('detailNote').textContent = button.dataset.note;
                        openModal(detailsModal);
                    });
                });

                document.querySelectorAll('.js-track-order').forEach((button) => {
                    if (button.dataset.bound === 'track') return;
                    button.dataset.bound = 'track';
                    button.addEventListener('click', () => {
                        document.getElementById('orderTrackSubtitle').textContent = `${button.dataset.orderId} - ${button.dataset.product}`;
                        document.getElementById('trackStatusLabel').textContent = button.dataset.statusLabel;
                        document.getElementById('trackStatusMessage').textContent = button.dataset.trackMessage;
                        const isPickupFlow = button.dataset.trackingFlow === 'pickup';
                        const currentStep = Math.max(1, Number(button.dataset.currentStep || 1));
                        const stepThreeTitle = document.getElementById('trackerStep3Title');
                        const stepThreeText = document.getElementById('trackerStep3Text');
                        const stepFourTitle = document.getElementById('trackerStep4Title');
                        const stepFourText = document.getElementById('trackerStep4Text');
                        const stepFour = document.querySelector('.tracker-step[data-step="4"]');

                        if (stepThreeTitle) {
                            stepThreeTitle.textContent = isPickupFlow ? 'Ready to Pickup' : 'Out for Delivery / Ready for Pickup';
                        }
                        if (stepThreeText) {
                            stepThreeText.textContent = isPickupFlow
                                ? 'Your order is prepared and waiting at the showroom for customer pickup confirmation.'
                                : 'The order has left our workshop and is on the way to you or ready at the showroom.';
                        }
                        if (stepFourTitle) {
                            stepFourTitle.textContent = isPickupFlow ? 'Picked Up' : 'Delivered';
                        }
                        if (stepFourText) {
                            stepFourText.textContent = isPickupFlow
                                ? 'The customer has collected the order from the showroom and the order is now completed.'
                                : 'Your order has been completed successfully.';
                        }
                        if (stepFour) {
                            stepFour.style.display = 'grid';
                        }

                        document.querySelectorAll('.tracker-step').forEach((step) => {
                            const stepNumber = Number(step.dataset.step);
                            step.classList.remove('done', 'current');
                            if (stepNumber < currentStep) {
                                step.classList.add('done');
                            } else if (stepNumber === currentStep) {
                                step.classList.add('current');
                            }
                        });

                        openModal(trackModal);
                    });
                });

                document.querySelectorAll('.js-request-refund').forEach((button) => {
                    if (button.dataset.bound === 'refund') return;
                    button.dataset.bound = 'refund';
                    button.addEventListener('click', () => {
                        if (refundRequestOrderId) {
                            refundRequestOrderId.value = button.dataset.orderDbId || '';
                        }
                        if (refundRequestSubtitle) {
                            refundRequestSubtitle.textContent = `${button.dataset.orderNumber || 'Order'} &middot; ${button.dataset.orderLabel || 'Completed order'}`;
                        }
                        if (refundRequestReason) {
                            refundRequestReason.value = '';
                        }
                        openModal(refundRequestModal);
                    });
                });
            };
            const renderOrders = () => {
                if (!ordersTableBody) return;
                const customerOrders = getPlacedOrders()
                    .filter((order) => order.customerEmail === customerEmail)
                    .map((order) => ({
                        ...order,
                        itemsTotalLkr: (order.items || []).reduce((sum, item) => {
                            return sum + (parsePrice(item.price) * (Number(item.quantity) || 1));
                        }, 0),
                        orderDate: order.createdAt ? new Date(order.createdAt).toISOString().slice(0, 10) : ''
                    }))
                    .sort((a, b) => new Date(b.createdAt || 0) - new Date(a.createdAt || 0));

                ordersTableBody.innerHTML = buildOrderRows(customerOrders) || `
                    <tr>
                        <td colspan="6">
                            <div class="request-empty">No orders yet. Products you purchase will appear here automatically.</div>
                        </td>
                    </tr>
                `;
                updateOrdersSummary();
                bindOrderActionButtons();
            };
            let activeConsultationChatId = getCustomerConsultationThreads()[0]?.id || null;
            const renderWishlist = () => {
                if (!wishlistGrid) return;
                const items = Array.isArray(initialWishlistItems) ? initialWishlistItems : [];
                if (!items.length) {
                    wishlistGrid.innerHTML = `<div class="wishlist-empty">No wishlist items yet. Tap the heart icon on any product to save it here.</div>`;
                    return;
                }

                wishlistGrid.innerHTML = items.map((item) => `
                    <article class="wishlist-card" data-target="${item.targetUrl}">
                        <div class="product-thumb"><img src="${item.image}" alt="${item.name}"></div>
                        <div class="card-meta"><h3>${item.name}</h3><p>${item.description || 'Saved product from your wishlist.'}</p>${item.size_value ? `<p style="margin-top:6px;color:var(--muted);font-size:.85rem;">${item.size_label || 'Size'}: ${item.size_value}</p>` : ''}<div class="price">${item.price || 'Price unavailable'}</div><div class="stock-pill ${String(item.stock_status || '').replace(/_/g, '-')}">${item.stock_label || 'In Stock'}</div></div>
                        <div class="action-row">
                            <form class="wishlist-inline-form" method="POST" action="${cartItemsStoreRoute}">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="product_id" value="${item.product_id}">
                                <input type="hidden" name="quantity" value="1">
                                <button class="mini-btn" type="submit" ${Number(item.stock || 0) <= 0 ? 'disabled' : ''}>${Number(item.stock || 0) <= 0 ? 'Out of Stock' : 'Add to Cart'}</button>
                            </form>
                            <form class="wishlist-inline-form" method="POST" action="${wishlistDeleteBase}/${item.wishlist_item_id}">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="mini-btn" type="submit">Remove</button>
                            </form>
                        </div>
                    </article>
                `).join('');

                wishlistGrid.querySelectorAll('.wishlist-card').forEach((card) => {
                    card.addEventListener('click', (event) => {
                        if (event.target.closest('form, button, input, a')) {
                            return;
                        }
                        const targetUrl = card.dataset.target;
                        if (targetUrl) window.location.href = targetUrl;
                    });
                });
            };
            const renderCart = () => {
                if (!cartGrid || !cartSummary || !cartSelectedTotal || !cartCheckoutPanel) return;
                const items = getCartItems();
                const selectedIds = getSelectedCartIds().filter((id) => items.some((item) => item.id === id));
                saveSelectedCartIds(selectedIds);
                const totalItems = items.reduce((sum, item) => sum + (Number(item.quantity) || 1), 0);
                const subtotal = items.reduce((sum, item) => sum + (parsePrice(item.price) * (Number(item.quantity) || 1)), 0);
                const selectedItems = items.filter((item) => selectedIds.includes(item.id));
                const selectedSubtotal = selectedItems.reduce((sum, item) => sum + (parsePrice(item.price) * (Number(item.quantity) || 1)), 0);
                const hasBlockedStock = selectedItems.some((item) => Number(item.stock || 0) <= 0);

                cartSummary.innerHTML = `
                    <div class="cart-total-card"><span>Cart Items</span><strong>${totalItems}</strong></div>
                    <div class="cart-total-card"><span>Subtotal</span><strong>${formatLkr(subtotal)}</strong></div>
                    <div class="cart-total-card"><span>Selected Items</span><strong>${selectedItems.length}</strong></div>
                    <div class="cart-total-card"><span>Selected Total</span><strong>${formatLkr(selectedSubtotal)}</strong></div>
                `;

                cartSelectedTotal.innerHTML = `
                    <span>Selected Total</span>
                    <strong>${formatLkr(selectedSubtotal)}</strong>
                `;

                cartCheckoutPanel.innerHTML = `
                    <div class="cart-checkout-panel">
                        <div class="cart-checkout-actions">
                            <button class="mini-btn" type="button" id="cartSelectAllBtn">${selectedItems.length === items.length && items.length ? 'Unselect All' : 'Select All'}</button>
                            <button class="checkout-btn" type="button" id="cartCheckoutBtn" ${(selectedItems.length && !hasBlockedStock) ? '' : 'disabled'}>Checkout ${selectedItems.length ? `(${selectedItems.length})` : ''}</button>
                        </div>
                    </div>
                `;

                if (!items.length) {
                    cartGrid.innerHTML = `<div class="wishlist-empty">Your shopping cart is empty. Add products from wishlist or product pages.</div>`;
                    cartSelectedTotal.innerHTML = '';
                    cartCheckoutPanel.innerHTML = '';
                    return;
                }

                cartGrid.innerHTML = items.map((item) => `
                    <article class="wishlist-card cart-card" data-target="${item.targetUrl}">
                        <button class="cart-select ${selectedIds.includes(item.id) ? 'active' : ''}" type="button" data-cart-select="${item.id}" aria-label="Select ${item.name}">
                            <i class="fas fa-check"></i>
                        </button>
                        <div class="product-thumb"><img src="${item.image}" alt="${item.name}"></div>
                        <div class="card-meta"><h3>${item.name}</h3><p>${item.description || 'Saved for checkout.'}</p>${item.size_value ? `<p style="margin-top:6px;color:var(--muted);font-size:.85rem;">${item.size_label || 'Size'}: ${item.size_value}</p>` : ''}<div class="price">${item.price || 'Price unavailable'}</div><div class="stock-pill ${String(item.stock_status || '').replace(/_/g, '-')}">${item.stock_label || 'In Stock'}</div></div>
                        <div class="action-row">
                            <div class="qty-controls">
                                <button class="qty-btn" type="button" data-cart-qty-change="${item.id}" data-delta="-1" aria-label="Decrease quantity" ${(Number(item.quantity) || 1) <= 1 ? 'disabled' : ''}>−</button>
                                <span class="qty-display">Qty: ${item.quantity || 1}</span>
                                <button class="qty-btn" type="button" data-cart-qty-change="${item.id}" data-delta="1" aria-label="Increase quantity" ${(Number(item.quantity) || 1) >= (Number(item.stock || 99) || 99) ? 'disabled' : ''}>+</button>
                            </div>
                            <button class="mini-btn" type="button" data-cart-remove="${item.id}">Remove</button>
                        </div>
                    </article>
                `).join('');

                cartGrid.querySelectorAll('.wishlist-card').forEach((card) => {
                    card.addEventListener('click', () => {
                        if (card.dataset.target) window.location.href = card.dataset.target;
                    });
                });

                cartGrid.querySelectorAll('[data-cart-select]').forEach((button) => {
                    button.addEventListener('click', (event) => {
                        event.stopPropagation();
                        const itemId = button.dataset.cartSelect;
                        const nextSelected = getSelectedCartIds();
                        const existingIndex = nextSelected.indexOf(itemId);
                        if (existingIndex >= 0) {
                            nextSelected.splice(existingIndex, 1);
                        } else {
                            nextSelected.push(itemId);
                        }
                        saveSelectedCartIds(nextSelected);
                        renderCart();
                    });
                });

                cartGrid.querySelectorAll('[data-cart-remove]').forEach((button) => {
                    button.addEventListener('click', (event) => {
                        event.stopPropagation();
                        const nextItems = getCartItems().filter((item) => item.id !== button.dataset.cartRemove);
                        saveCartItems(nextItems);
                        saveSelectedCartIds(getSelectedCartIds().filter((id) => id !== button.dataset.cartRemove));
                        renderCart();
                    });
                });

                cartGrid.querySelectorAll('[data-cart-qty-change]').forEach((button) => {
                    button.addEventListener('click', (event) => {
                        event.stopPropagation();
                        const itemId = button.dataset.cartQtyChange;
                        const delta = Number(button.dataset.delta || 0);
                        updateCartItemQuantity(itemId, delta);
                    });
                });

                document.getElementById('cartSelectAllBtn')?.addEventListener('click', () => {
                    if (selectedItems.length === items.length) {
                        saveSelectedCartIds([]);
                    } else {
                        saveSelectedCartIds(items.map((item) => item.id));
                    }
                    renderCart();
                });

                document.getElementById('cartCheckoutBtn')?.addEventListener('click', () => {
                    const selectedItems = getSelectedCartItems();
                    if (!selectedItems.length) return;
                    if (selectedItems.some((item) => Number(item.stock || 0) <= 0)) {
                        alert('Remove out of stock items before checkout.');
                        return;
                    }
                    saveCheckoutSession(selectedItems, 'cart');
                    window.location.href = checkoutRoute;
                });
            };

            const renderCheckoutModal = () => {
                const list = document.getElementById('cartCheckoutList');
                const total = document.getElementById('cartCheckoutTotal');
                const subtitle = document.getElementById('cartCheckoutSubtitle');
                const selectedItems = getSelectedCartItems();
                const selectedTotal = selectedItems.reduce((sum, item) => sum + (parsePrice(item.price) * (Number(item.quantity) || 1)), 0);
                if (!list || !total || !subtitle) return;
                subtitle.textContent = selectedItems.length > 1
                    ? `${selectedItems.length} items are lined up for your next checkout step.`
                    : 'Your selected product is lined up for checkout.';
                total.textContent = formatLkr(selectedTotal);
                list.innerHTML = selectedItems.map((item) => `
                    <article class="checkout-item">
                        <img src="${item.image}" alt="${item.name}">
                        <div>
                            <strong>${item.name}</strong>
                            <span>${item.description || 'Prepared from your cart selection.'}</span>
                            <span class="stock-pill ${String(item.stock_status || '').replace(/_/g, '-')}">${item.stock_label || 'In Stock'}</span>
                        </div>
                        <strong>${item.price || 'Price unavailable'}</strong>
                    </article>
                `).join('');
            };
            const renderConsultationHistory = () => {
                if (!consultationHistoryBody) return;
                consultationHistoryBody.querySelectorAll('[data-open-chat]').forEach((button) => {
                    button.addEventListener('click', () => {
                        const chatId = button.dataset.openChat || '';
                        if (!chatId) return;
                        activeConsultationChatId = chatId;
                        renderCustomerConsultationChat();
                        document.getElementById('customerConsultChatMessages')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    });
                });
            };
            const renderCustomerConsultationChat = () => {
                const threads = getCustomerConsultationThreads();
                const activeThread = threads.find((thread) => thread.id === activeConsultationChatId) || threads[0];
                if (!customerChatContacts || !customerConsultChatTitle || !customerConsultChatMeta || !customerConsultChatMessages) return;

                if (!activeThread) {
                    customerChatContacts.innerHTML = '<div class="wishlist-empty">Your consultant chat will appear here once a consultation request is created.</div>';
                    customerConsultChatTitle.textContent = 'Chat with Consultant';
                    customerConsultChatMeta.textContent = 'Customer and consultant thread';
                    customerConsultChatMessages.innerHTML = '<div class="wishlist-empty">No messages yet. Start the conversation from the box below.</div>';
                    if (customerConsultChatInput) {
                        customerConsultChatInput.placeholder = customerConsultChatDefaultNote;
                        customerConsultChatInput.disabled = true;
                    }
                    if (customerConsultChatSend) customerConsultChatSend.disabled = true;
                    return;
                }

                activeConsultationChatId = activeThread.id;
                customerChatContacts.innerHTML = threads.map((thread) => `
                    <button class="chat-contact-btn ${thread.id === activeConsultationChatId ? 'active' : ''}" type="button" data-chat-id="${escapeHtml(thread.id)}">
                        <strong>${escapeHtml(thread.requestId || thread.consultantName || 'Consultation')}</strong>
                        <span style="display:block;font-weight:700;color:#3f3125;margin-bottom:4px;">${escapeHtml(thread.consultantName || 'Consultant Team')}</span>
                        <span>${escapeHtml(getConsultationThreadPreview(thread))}</span>
                    </button>
                `).join('');

                customerConsultChatTitle.textContent = buildConsultationThreadTitle(activeThread);
                customerConsultChatMeta.textContent = buildConsultationThreadMeta(activeThread);
                const canReply = Boolean(activeThread.canReply);
                if (customerConsultChatInput) {
                    customerConsultChatInput.placeholder = canReply
                        ? `${customerConsultChatDefaultNote} [${activeThread.requestId || activeThread.requestType || 'Consultation'}]`
                        : 'Your request is waiting for admin approval and consultant assignment.';
                    customerConsultChatInput.disabled = !canReply;
                }
                if (customerConsultChatSend) customerConsultChatSend.disabled = !canReply;
                customerConsultChatMessages.innerHTML = activeThread.messages.length
                    ? activeThread.messages.map((message) => `
                        <div class="chat-bubble-wrap ${message.sender === 'Consultant' ? 'consultant' : 'customer'}">
                            <div class="chat-bubble">
                                <small>${message.sender} &middot; ${message.time}</small>
                                <div>${escapeHtml(message.text)}</div>
                                ${renderConsultationMessageMedia(message)}
                            </div>
                        </div>
                    `).join('')
                    : '<div class="wishlist-empty">This consultation is ready. Either you or the consultant can send the first message.</div>';

                requestAnimationFrame(() => {
                    customerConsultChatMessages.scrollTop = customerConsultChatMessages.scrollHeight;
                });

                customerChatContacts.querySelectorAll('[data-chat-id]').forEach((button) => {
                    button.addEventListener('click', () => {
                        activeConsultationChatId = button.dataset.chatId;
                        renderCustomerConsultationChat();
                    });
                });
            };
            const renderCustomerContactMessages = () => {
                if (!customerContactMessageList) return;
                const messages = (Array.isArray(initialCustomerContactMessages) ? initialCustomerContactMessages : [])
                    .slice()
                    .sort((a, b) => String(b.date || '').localeCompare(String(a.date || '')));

                if (!messages.length) {
                    customerContactMessageList.innerHTML = '<div class="contact-message-empty">No contact messages yet. Send a message from the contact form and it will appear here together with any admin reply.</div>';
                    return;
                }

                customerContactMessageList.innerHTML = messages.map((item) => `
                    <article class="contact-message-card">
                        <div class="contact-message-head">
                            <div>
                                <strong>${escapeHtml(item.subject || 'Contact Message')}</strong>
                                <span>${escapeHtml(item.id || 'MSG')} &middot; ${escapeHtml(item.date || '-')}</span>
                            </div>
                            <span class="status ${item.status === 'Replied' ? 'delivered' : (item.status === 'Read' ? 'processing' : 'request')}">${escapeHtml(item.status || 'Unread')}</span>
                        </div>
                        <div class="contact-message-body">${escapeHtml(item.message || '')}</div>
                        ${item.replyMessage ? `
                            <div class="contact-message-reply">
                                <strong>Admin Reply${item.replyBy ? ` &middot; ${escapeHtml(item.replyBy)}` : ''}${item.replyDate ? ` &middot; ${escapeHtml(item.replyDate)}` : ''}</strong>
                                <p>${escapeHtml(item.replyMessage)}</p>
                            </div>
                        ` : ''}
                    </article>
                `).join('');
            };

            const detailsModal = document.getElementById('orderDetailsModal');
            const trackModal = document.getElementById('orderTrackModal');
            const checkoutModal = document.getElementById('cartCheckoutModal');
            const closeModal = (modal) => {
                if (!modal) return;
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
            };
            const openModal = (modal) => {
                if (!modal) return;
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
            };

            if (shouldOpenCustomRequestModal) {
                openModal(customRequestModal);
            }

            if (window.location.hash === '#customRequestModal') {
                openModal(customRequestModal);
            }

            if (window.location.hash === '#consultationRequestModal') {
                openModal(consultationRequestModal);
            }

            bindOrderActionButtons();

            if (refundRequestForm) {
                refundRequestForm.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    const orderId = refundRequestOrderId?.value?.trim();
                    const reason = refundRequestReason?.value?.trim();
                    if (!orderId || !reason) {
                        notify('Please enter a refund reason.');
                        return;
                    }

                    const submitButton = refundRequestForm.querySelector('button[type="submit"]');
                    const previousLabel = submitButton?.textContent || 'Submit Refund Request';
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.textContent = 'Submitting...';
                    }

                    try {
                        const result = await submitRefundRequest(orderId, reason);
                        notify(result.message || 'Refund request submitted successfully.');
                        closeModal(refundRequestModal);
                        setTimeout(() => window.location.reload(), 700);
                    } catch (error) {
                        notify(error.message || 'Unable to submit refund request.');
                    } finally {
                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.textContent = previousLabel;
                        }
                    }
                });
            }

            document.querySelectorAll('[data-close-modal]').forEach((button) => {
                button.addEventListener('click', () => closeModal(document.getElementById(button.dataset.closeModal)));
            });

            [detailsModal, trackModal, checkoutModal, consultationRequestModal, appointmentBookingModal, customRequestModal, refundRequestModal].forEach((modal) => {
                if (!modal) return;
                modal.addEventListener('click', (event) => {
                    if (event.target === modal) {
                        closeModal(modal);
                    }
                });
            });

            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeModal(detailsModal);
                    closeModal(trackModal);
                    closeModal(checkoutModal);
                    closeModal(appointmentBookingModal);
                    closeModal(customRequestModal);
                    closeModal(refundRequestModal);
                }
            });

            window.addEventListener('storage', (event) => {
                if (event.key === cartStorageKey) {
                    try {
                        window.__cartItems = JSON.parse(event.newValue || '[]');
                    } catch (error) {
                        window.__cartItems = [];
                    }
                    renderCart();
                }
                if (event.key === consultationSyncStorageKey) {
                    syncConsultationThreadsFromServer();
                }
            });

            const profileImageInput = document.getElementById('profileImageInput');
            const profileImageForm = document.getElementById('profileImageForm');

            if (profileImageInput && profileImageForm) {
                profileImageInput.addEventListener('change', () => {
                    if (profileImageInput.files && profileImageInput.files.length) {
                        profileImageForm.submit();
                    }
                });
            }

            if (newCustomRequestBtn) {
                newCustomRequestBtn.addEventListener('click', () => openModal(customRequestModal));
            }

            if (requestConsultationBtn) {
                requestConsultationBtn.addEventListener('click', () => openModal(consultationRequestModal));
            }

            if (bookAppointmentBtn) {
                bookAppointmentBtn.addEventListener('click', () => {
                    if (appointmentDateInput) {
                        appointmentDateInput.min = getTodayDateValue();
                    }
                    renderAppointmentTimeOptions();
                    openModal(appointmentBookingModal);
                });
            }

            if (appointmentDateInput) {
                appointmentDateInput.min = getTodayDateValue();
                appointmentDateInput.addEventListener('change', syncAppointmentDateValidity);
                appointmentDateInput.addEventListener('input', syncAppointmentDateValidity);
            }

            if (appointmentBookingForm) {
                appointmentBookingForm.addEventListener('submit', () => {
                    if (appointmentTimeSelect && !appointmentTimeSelect.value) {
                        renderAppointmentTimeOptions();
                    }
                });
            }

            document.addEventListener('click', function (event) {
                const button = event.target.closest('button[data-appointment-action]');
                if (!button) return;
                const appointmentId = button.dataset.appointmentId || '';
                const action = button.dataset.appointmentAction || '';
                if (!appointmentId || !action) return;

                if (action === 'reject' && !window.confirm('Reject the suggested reschedule? This will cancel the appointment.')) {
                    return;
                }

                updateAppointmentOnServer(appointmentId, {
                    action: action === 'accept' ? 'accept-reschedule' : 'reject-reschedule',
                })
                    .then(() => window.location.reload())
                    .catch((error) => alert(error.message || 'Unable to update the appointment.'));
            });

            syncAppointmentDateValidity();

            if (contactMessageRedirectBtn) {
                contactMessageRedirectBtn.addEventListener('click', () => {
                    window.location.href = contactPageRoute;
                });
            }

            if (customReferenceImages && customReferenceNote) {
                customReferenceImages.addEventListener('change', () => {
                    const count = customReferenceImages.files ? customReferenceImages.files.length : 0;
                    customReferenceNote.textContent = count
                        ? `${count} reference image${count > 1 ? 's are' : ' is'} attached and ready for admin review.`
                        : 'You can attach inspiration images, sketches, or close-up samples for the admin review team.';
                });
            }

            if (customJewelleryTypeSelect) {
                customJewelleryTypeSelect.addEventListener('change', syncCustomJewelleryFields);
                syncCustomJewelleryFields();
            }

            if (customerConsultChatSend && customerConsultChatInput) {
                customerConsultChatSend.addEventListener('click', () => {
                    const text = customerConsultChatInput.value.trim();
                    if (!text) return;
                    const threads = getConsultationChatThreads();
                    const activeThread = threads.find((thread) => thread.id === activeConsultationChatId);
                    if (!activeThread) return;
                    if (!activeThread.canReply) return;
                    if (!activeThread.consultationId) return;
                    const imageFile = customerConsultChatImage?.files?.[0] || null;
                    submitConsultationMessage(activeThread.consultationId, text, imageFile)
                        .then((savedMessage) => {
                            activeThread.messages.push({
                                sender: 'Customer',
                                time: savedMessage.time || formatChatTime(),
                                text: savedMessage.text || text,
                                imageUrl: savedMessage.image_url || null,
                                imagePath: savedMessage.image_path || null,
                            });
                            saveConsultationChatThreads(threads);
                            broadcastConsultationThreadSync(activeThread.consultationId);
                            customerConsultChatInput.value = '';
                            if (customerConsultChatImage) customerConsultChatImage.value = '';
                            renderCustomerConsultationChat();
                        })
                        .catch((error) => {
                            alert(error.message || 'Unable to send the message.');
                        });
                });
            }

            renderOrders();
            renderWishlist();
            renderCart();
            renderConsultationHistory();
            renderCustomerConsultationChat();
            renderCustomerContactMessages();
            syncConsultationThreadsFromServer();
            setInterval(syncConsultationThreadsFromServer, 7000);
        })();
    </script>
</body>
</html>
