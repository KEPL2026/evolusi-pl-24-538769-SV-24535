<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Saving;

class SavingController extends Controller
{
    /**
     * Menampilkan daftar tabungan dan ringkasan dashboard dengan progress bar.
     */
    public function index()
    {
        $savings = Saving::latest()->get();
        $totalTarget = (float) $savings->sum('target_amount');
        $totalCurrent = (float) $savings->sum('current_amount');
        $overallProgress = $totalTarget > 0 ? min(100, round(($totalCurrent / $totalTarget) * 100, 1)) : 0;

        return view('savings.index', compact('savings', 'totalTarget', 'totalCurrent', 'overallProgress'));
    }

    /**
     * Menyimpan data tabungan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'current_amount' => 'nullable|numeric|min:0',
            'target_date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $validated['current_amount'] = $validated['current_amount'] ?? 0;

        Saving::create($validated);

        return redirect()->route('savings.index')->with('success', 'Tabungan baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui data tabungan (menambah saldo atau mengubah target).
     */
    public function update(Request $request, Saving $saving)
    {
        if ($request->has('add_amount')) {
            $request->validate([
                'add_amount' => 'required|numeric|min:1',
            ]);

            $saving->increment('current_amount', (float) $request->input('add_amount'));

            return redirect()->route('savings.index')->with('success', "Saldo tabungan '{$saving->name}' berhasil ditambah!");
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'current_amount' => 'required|numeric|min:0',
            'target_date' => 'nullable|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $saving->update($validated);

        return redirect()->route('savings.index')->with('success', "Data tabungan '{$saving->name}' berhasil diperbarui!");
    }

    /**
     * Menghapus data tabungan.
     */
    public function destroy(Saving $saving)
    {
        $saving->delete();

        return redirect()->route('savings.index')->with('success', 'Data tabungan berhasil dihapus!');
    }
}
