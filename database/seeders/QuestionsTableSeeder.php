<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Question::create([
            'question_text' => 'Apa warna langit?',
            'answer1' => 'Merah',
            'answer2' => 'Kuning',
            'answer3' => 'Hijau',
            'answer4' => 'Biru',
            'correct_answer' => 'Biru',
            'answer_id' => 4,
        ]);

        Question::create([
            'question_text' => 'Berapa jumlah kaki manusia?',
            'answer1' => 'Dua',
            'answer2' => 'Empat',
            'answer3' => 'Enam',
            'answer4' => 'Sepuluh',
            'correct_answer' => 'Dua',
            'answer_id' => 1,
        ]);

        Question::create([
            'question_text' => 'Apa ibukota Indonesia?',
            'answer1' => 'Surabaya',
            'answer2' => 'Bandung',
            'answer3' => 'Jakarta',
            'answer4' => 'Yogyakarta',
            'correct_answer' => 'Jakarta',
            'answer_id' => 3,
        ]);

        Question::create([
            'question_text' => 'Apa huruf pertama abjad?',
            'answer1' => 'A',
            'answer2' => 'B',
            'answer3' => 'C',
            'answer4' => 'D',
            'correct_answer' => 'A',
            'answer_id' => 1,
        ]);

        Question::create([
            'question_text' => 'Apa ibukota Prancis?',
            'answer1' => 'Rome',
            'answer2' => 'Madrid',
            'answer3' => 'Berlin',
            'answer4' => 'Paris',
            'correct_answer' => 'Paris',
            'answer_id' => 4,
        ]);
    }
}
