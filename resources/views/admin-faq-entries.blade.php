<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Management | Pinwntha Gems</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{
            --bg:#f5efe6;
            --panel:#fffaf4;
            --panel-strong:#ffffff;
            --line:#eadac2;
            --line-strong:#dec89f;
            --text:#2f2419;
            --muted:#75604d;
            --gold:#b98945;
            --gold-dark:#9b6d32;
            --green:#214841;
            --green-2:#2f6f65;
            --shadow:0 18px 42px rgba(65,45,23,.09);
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family:"Manrope",sans-serif;
            color:var(--text);
            background:
                radial-gradient(circle at top left, rgba(185,137,69,.12), transparent 26%),
                radial-gradient(circle at top right, rgba(47,111,101,.10), transparent 24%),
                linear-gradient(180deg,#fcf8f1, var(--bg));
        }
        a{text-decoration:none;color:inherit}
        .page{max-width:1400px;margin:0 auto;padding:28px 20px 56px}
        .hero{
            padding:30px 34px;
            border-radius:30px;
            border:1px solid rgba(185,137,69,.16);
            background:
                radial-gradient(circle at top right, rgba(47,111,101,.12), transparent 30%),
                linear-gradient(135deg, rgba(255,250,245,.98), rgba(250,240,224,.96));
            box-shadow:var(--shadow);
            display:flex;
            flex-wrap:wrap;
            justify-content:space-between;
            gap:18px;
            align-items:flex-start;
        }
        .hero h1{
            margin:0 0 10px;
            font-family:"Cormorant Garamond",serif;
            font-size:clamp(2.4rem,4vw,4rem);
            line-height:.94;
            letter-spacing:-.02em;
        }
        .hero p{
            margin:0;
            max-width:860px;
            color:var(--muted);
            line-height:1.75;
            font-size:1rem;
        }
        .actions{display:flex;gap:10px;flex-wrap:wrap}
        .link-btn,.btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            min-height:44px;
            padding:0 16px;
            border-radius:14px;
            text-decoration:none;
            font-weight:800;
            cursor:pointer;
            border:1px solid transparent;
        }
        .link-btn{
            background:#fff;
            border-color:var(--line);
            color:#5b452f;
        }
        .btn{
            background:linear-gradient(135deg,var(--gold),var(--gold-dark));
            color:#fff;
            box-shadow:0 12px 24px rgba(185,137,69,.18);
        }
        .panel{
            margin-top:20px;
            padding:24px;
            border-radius:28px;
            background:var(--panel);
            border:1px solid rgba(185,137,69,.16);
            box-shadow:var(--shadow);
        }
        .panel-title{
            margin:0 0 18px;
            font-family:"Cormorant Garamond",serif;
            font-size:2rem;
            line-height:1;
        }
        .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
        .field{display:flex;flex-direction:column;gap:7px}
        .field.full{grid-column:1 / -1}
        label{
            font-size:.83rem;
            font-weight:800;
            color:#77624c;
        }
        input:not([type="checkbox"]),select,textarea{
            width:100%;
            box-sizing:border-box;
            height:46px;
            padding:0 14px;
            border-radius:14px;
            border:1px solid #e4d4bd;
            background:#fff;
            font:inherit;
            color:var(--text);
        }
        textarea{min-height:180px;padding:14px;resize:vertical;line-height:1.7}
        input:not([type="checkbox"]):focus,select:focus,textarea:focus{
            outline:none;
            border-color:#c59a5c;
            box-shadow:0 0 0 4px rgba(185,137,69,.10);
        }
        .field-error{color:#b14d3c;font-size:.82rem;font-weight:700}
        .success{
            margin-bottom:14px;
            padding:14px 16px;
            border-radius:16px;
            background:#edf7ee;
            border:1px solid #cde6d0;
            color:#245f30;
        }
        .hint{margin-top:6px;color:var(--muted);font-size:.9rem}
        .table-wrap{overflow:auto}
        table{width:100%;border-collapse:collapse;min-width:760px}
        th,td{padding:14px 12px;border-bottom:1px solid #f1e6d4;text-align:left;vertical-align:top}
        th{font-size:.8rem;color:#8b7150;text-transform:uppercase;letter-spacing:.08em}
        .chip{display:inline-flex;align-items:center;padding:6px 10px;border-radius:999px;font-size:.76rem;font-weight:700}
        .chip.published{background:#e6f4eb;color:#245f30}
        .chip.draft{background:#faedd7;color:#936725}
        .row-actions{
            display:grid;
            grid-template-columns:repeat(2,minmax(0,1fr));
            gap:8px;
            min-width:188px;
        }
        .mini{
            min-height:36px;
            padding:0 12px;
            border-radius:11px;
            border:1px solid #e4d4bd;
            background:#fff;
            font-weight:800;
            cursor:pointer;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-align:center;
        }
        .mini.danger{border-color:#f0d2c7;color:#9c4d3d}
        .two-col{display:grid;grid-template-columns:minmax(0, .95fr) minmax(0, 1.05fr);gap:20px;align-items:start}
        .publish-toggle{
            display:flex;
            align-items:center;
            gap:10px;
            min-height:46px;
            padding:0 14px;
            border-radius:14px;
            border:1px solid #e4d4bd;
            background:#fff;
        }
        .publish-toggle input[type="checkbox"]{
            width:18px;
            height:18px;
            margin:0;
            flex:0 0 auto;
            accent-color:var(--gold-dark);
        }
        .publish-toggle span{
            font-weight:800;
            color:#5b452f;
        }
        .table-wrap table{
            table-layout:fixed;
        }
        .table-wrap th:first-child,
        .table-wrap td:first-child{
            width:44%;
        }
        .table-wrap th:nth-child(2),
        .table-wrap td:nth-child(2){
            width:18%;
        }
        .table-wrap th:nth-child(3),
        .table-wrap td:nth-child(3){
            width:14%;
        }
        .table-wrap th:nth-child(4),
        .table-wrap td:nth-child(4){
            width:24%;
        }
        @media (max-width: 900px){
            .two-col,.grid{grid-template-columns:1fr}
            .row-actions{grid-template-columns:1fr}
            .table-wrap table{table-layout:auto;min-width:760px}
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="hero">
            <div>
                <h1>FAQ Management</h1>
                <p>Manage the public FAQ content here</p>
            </div>
            <div class="actions">
                <a class="link-btn" href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
                <a class="link-btn" href="{{ route('faq') }}">View Public FAQ</a>
            </div>
        </div>

        @if (session('faq_success'))
            <div class="panel success">{{ session('faq_success') }}</div>
        @endif

        <div class="two-col">
            <div class="panel">
                <h2 class="panel-title">{{ isset($editingEntry) ? 'Edit FAQ' : 'Add FAQ' }}</h2>
                <form action="{{ isset($editingEntry) ? route('admin.faq-entries.update', $editingEntry) : route('admin.faq-entries.store') }}" method="POST">
                    @csrf
                    <div class="grid">
                        <div class="field full">
                            <label>Question</label>
                            <input type="text" name="question" value="{{ old('question', $editingEntry->question ?? '') }}">
                            @error('question')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field full">
                            <label>Answer</label>
                            <textarea name="answer">{{ old('answer', $editingEntry->answer ?? '') }}</textarea>
                            @error('answer')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field">
                            <label>Group</label>
                            <select name="group_name">
                                @php $currentGroup = old('group_name', $editingEntry->group_name ?? 'General'); @endphp
                                @foreach (['Orders', 'Custom Jewellery', 'Consultation', 'Payments', 'General'] as $group)
                                    <option value="{{ $group }}" @selected($currentGroup === $group)>{{ $group }}</option>
                                @endforeach
                            </select>
                            @error('group_name')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                        <div class="field">
                            <label>Publish Status</label>
                            <input type="hidden" name="is_published" value="0">
                            <label class="publish-toggle">
                                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $editingEntry->is_published ?? true) ? 'checked' : '' }}>
                                <span>Published</span>
                            </label>
                        </div>
                    </div>
                    <div style="margin-top:16px;display:flex;gap:10px;flex-wrap:wrap;">
                        <button class="btn" type="submit">{{ isset($editingEntry) ? 'Update FAQ' : 'Save FAQ' }}</button>
                        @if (isset($editingEntry))
                            <a class="link-btn" href="{{ route('admin.faq-entries') }}">Cancel Edit</a>
                        @endif
                    </div>
                </form>
            </div>

            
        </div>
    </div>
</body>
</html>
