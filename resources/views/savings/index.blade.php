<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelacak Tabungan - Money Management</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        body {
            background-color: #f8fafc;
            color: #1e293b;
            padding: 24px 16px;
        }
        .container {
            max-width: 960px;
            margin: 0 auto;
        }
        header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        h1 {
            font-size: 1.6rem;
            font-weight: 700;
            color: #0f172a;
        }
        p.subtitle {
            font-size: 0.95rem;
            color: #64748b;
            margin-top: 4px;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .card-label {
            font-size: 0.82rem;
            color: #64748b;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.03em;
        }
        .card-value {
            font-size: 1.4rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 6px;
        }
        .card-value.highlight {
            color: #2563eb;
        }
        .overall-progress-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .progress-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .progress-bar-bg {
            background-color: #e2e8f0;
            border-radius: 9999px;
            height: 14px;
            overflow: hidden;
            width: 100%;
        }
        .progress-bar-fill {
            background-color: #3b82f6;
            height: 100%;
            border-radius: 9999px;
            transition: width 0.4s ease;
        }
        .main-layout {
            display: grid;
            grid-template-columns: 1fr 1.6fr;
            gap: 24px;
        }
        @media (max-width: 768px) {
            .main-layout {
                grid-template-columns: 1fr;
            }
        }
        .form-group {
            margin-bottom: 14px;
        }
        label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        input, textarea {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.9rem;
            background-color: #ffffff;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }
        button.btn-primary {
            width: 100%;
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.92rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        button.btn-primary:hover {
            background-color: #1d4ed8;
        }
        .saving-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 14px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        .saving-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 8px;
        }
        .saving-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
        }
        .saving-desc {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 2px;
        }
        .saving-stats {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            margin-top: 10px;
            color: #475569;
        }
        .saving-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 14px;
            padding-top: 12px;
            border-top: 1px solid #f1f5f9;
            gap: 12px;
            flex-wrap: wrap;
        }
        .deposit-form {
            display: flex;
            gap: 8px;
            flex: 1;
            min-width: 200px;
        }
        .deposit-form input {
            padding: 6px 10px;
            font-size: 0.85rem;
        }
        .deposit-form button {
            background-color: #10b981;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }
        .deposit-form button:hover {
            background-color: #059669;
        }
        .btn-delete {
            background: #ef4444;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }
        .btn-delete:hover {
            background-color: #dc2626;
        }
        .empty-state {
            text-align: center;
            padding: 36px 16px;
            color: #94a3b8;
            background: #ffffff;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Pelacak Tabungan (Saving Tracker)</h1>
        <p class="subtitle">Aplikasi dasar pengelolaan keuangan dan pemantauan target tabungan</p>
    </header>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-error">
            <ul style="padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Dashboard Ringkasan -->
    <div class="dashboard-grid">
        <div class="card">
            <div class="card-label">Total Target</div>
            <div class="card-value">Rp {{ number_format($totalTarget, 0, ',', '.') }}</div>
        </div>
        <div class="card">
            <div class="card-label">Total Terkumpul</div>
            <div class="card-value highlight">Rp {{ number_format($totalCurrent, 0, ',', '.') }}</div>
        </div>
        <div class="card">
            <div class="card-label">Sisa Kebutuhan</div>
            <div class="card-value">Rp {{ number_format(max(0, $totalTarget - $totalCurrent), 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Main Dashboard Progress Bar -->
    <div class="overall-progress-card">
        <div class="progress-header">
            <span>Overall Saving Progress</span>
            <span>{{ $overallProgress }}%</span>
        </div>
        <div class="progress-bar-bg">
            <div class="progress-bar-fill" style="width: {{ $overallProgress }}%;"></div>
        </div>
    </div>

    <div class="main-layout">
        <!-- Form Tambah Tabungan -->
        <div>
            <div class="card">
                <h2 style="font-size: 1.1rem; margin-bottom: 14px; font-weight: 700;">Tambah Target Tabungan</h2>
                <form action="{{ route('savings.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Tabungan / Tujuan</label>
                        <input type="text" id="name" name="name" placeholder="Contoh: Beli Laptop Baru" required value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="target_amount">Target Dana (Rp)</label>
                        <input type="number" id="target_amount" name="target_amount" placeholder="Contoh: 5000000" min="1" step="any" required value="{{ old('target_amount') }}">
                    </div>

                    <div class="form-group">
                        <label for="current_amount">Saldo Terkumpul Awal (Rp)</label>
                        <input type="number" id="current_amount" name="current_amount" placeholder="0" min="0" step="any" value="{{ old('current_amount', 0) }}">
                    </div>

                    <div class="form-group">
                        <label for="target_date">Target Tanggal Tercapai (Opsional)</label>
                        <input type="date" id="target_date" name="target_date" value="{{ old('target_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="notes">Catatan (Opsional)</label>
                        <textarea id="notes" name="notes" rows="2" placeholder="Catatan kecil mengenai target tabungan">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary">+ Simpan Tabungan</button>
                </form>
            </div>
        </div>

        <!-- Daftar Tabungan -->
        <div>
            <h2 style="font-size: 1.1rem; margin-bottom: 14px; font-weight: 700;">Daftar Target Tabungan ({{ $savings->count() }})</h2>

            @forelse ($savings as $saving)
                <div class="saving-card">
                    <div class="saving-header">
                        <div>
                            <div class="saving-title">{{ $saving->name }}</div>
                            @if ($saving->notes)
                                <div class="saving-desc">{{ $saving->notes }}</div>
                            @endif
                            <div style="display: flex; gap: 6px; align-items: center; margin-top: 6px; flex-wrap: wrap;">
                                @if ($saving->isReached())
                                    <span style="font-size: 0.75rem; font-weight: 600; color: #065f46; background-color: #d1fae5; padding: 2px 8px; border-radius: 9999px;">
                                        Tercapai
                                    </span>
                                @elseif ($saving->current_amount > 0)
                                    <span style="font-size: 0.75rem; font-weight: 600; color: #1e40af; background-color: #dbeafe; padding: 2px 8px; border-radius: 9999px;">
                                        Sedang Berjalan
                                    </span>
                                @else
                                    <span style="font-size: 0.75rem; font-weight: 600; color: #475569; background-color: #f1f5f9; padding: 2px 8px; border-radius: 9999px;">
                                        Belum Dimulai
                                    </span>
                                @endif

                                @if ($saving->target_date)
                                    <span style="font-size: 0.75rem; color: #854d0e; background-color: #fef9c3; padding: 2px 8px; border-radius: 4px;">
                                        Target: {{ $saving->target_date->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar Tabungan -->
                    <div style="margin-top: 12px;">
                        <div style="display: flex; justify-content: space-between; font-size: 0.85rem; font-weight: 600; margin-bottom: 6px;">
                            <span>Progress</span>
                            <span>{{ $saving->progress_percentage }}%</span>
                        </div>
                        <div class="progress-bar-bg" style="height: 10px;">
                            <div class="progress-bar-fill" style="width: {{ $saving->progress_percentage }}%; background-color: {{ $saving->isReached() ? '#10b981' : '#3b82f6' }};"></div>
                        </div>
                    </div>

                    <div class="saving-stats">
                        <span>Terkumpul: <strong>Rp {{ number_format($saving->current_amount, 0, ',', '.') }}</strong></span>
                        <span>Sisa: <strong style="color: {{ $saving->isReached() ? '#059669' : '#dc2626' }};">Rp {{ number_format($saving->remaining_amount, 0, ',', '.') }}</strong></span>
                        <span>Target: <strong>Rp {{ number_format($saving->target_amount, 0, ',', '.') }}</strong></span>
                    </div>

                    <div class="saving-actions">
                        <!-- Quick Deposit -->
                        <form action="{{ route('savings.update', $saving) }}" method="POST" class="deposit-form">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="add_amount" placeholder="Tambah saldo (Rp)" min="1" step="any" required>
                            <button type="submit">+ Setor</button>
                        </form>

                        <!-- Delete -->
                        <form action="{{ route('savings.destroy', $saving) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tabungan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p style="font-size: 1.2rem; margin-bottom: 6px;">Belum ada data tabungan</p>
                    <p style="font-size: 0.9rem;">Mulai dengan mengisi formulir di samping untuk menambahkan target tabungan pertamamu.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
</body>
</html>
