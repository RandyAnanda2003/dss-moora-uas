<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Alternative;

class DashboardController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::all();
        $results = $this->moora($criterias, $alternatives);

        return view('dashboard', compact('criterias', 'alternatives', 'results'));
    }

    public function moora($criterias, $alternatives)
    {
        $temp = $this->get_alternatives($alternatives);

        // Ambil nama kolom kriteria dari database
        $criteriaColumns = $criterias->map(function ($criteria) {
            return 'c' . $criteria->id;
        });

        // Kuadratkan nilai kriteria
        foreach ($temp as $t) {
            foreach ($criteriaColumns as $column) {
                $t->$column = $t->$column ** 2;
            }
        }

        // Inisialisasi array untuk menyimpan jumlah kuadrat
        $c = [];
        foreach ($criteriaColumns as $column) {
            $c[$column] = 0;
        }

        // Jumlahkan kuadrat nilai kriteria
        foreach ($temp as $t) {
            foreach ($criteriaColumns as $column) {
                $c[$column] += $t->$column;
            }
        }

        // Akar kuadrat dari jumlah kuadrat untuk normalisasi
        foreach ($criteriaColumns as $column) {
            $c[$column] = sqrt($c[$column]);
        }

        // Normalisasi dan pembobotan
        $temp2 = $this->get_alternatives($alternatives);

        foreach ($temp2 as $t) {
            foreach ($criteriaColumns as $index => $column) {
                if ($c[$column] != 0) {
                    $t->$column = ($t->$column / $c[$column]) * $criterias[$index]->weight;
                } else {
                    $t->$column = 0; // Nilai default jika pembagi adalah nol
                }
            }
        }

        // Pengecekan tipe 'Cost' dan penyesuaian nilai
        foreach ($temp2 as $t) {
            foreach ($criteriaColumns as $index => $column) {
                $type = strtolower($criterias[$index]->type);
                if ($type == 'cost') {
                    $t->$column *= -1;
                }
            }
        }

        // Hitung total nilai normalisasi untuk setiap alternatif
        $results = [];
        foreach ($temp2 as $t) {
            $total = 0;
            foreach ($criteriaColumns as $column) {
                $total += $t->$column;
            }
            $results[] = [
                'name' => $t->name,
                'y' => $total
            ];
        }

        // Urutkan hasil berdasarkan total nilai dari terbesar ke terkecil
        usort($results, function ($a, $b) {
            return $b['y'] <=> $a['y'];
        });

        return $results;
    }

    public function get_alternatives($alternatives)
    {
        $temp = [];
        foreach ($alternatives as $alternative) {
            $temp[] = clone $alternative;
        }
        return $temp;
    }
}
