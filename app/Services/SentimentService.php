<?php

namespace App\Services;

use App\Models\PositiveWord;
use App\Models\NegativeWord;

class SentimentService
{
    public function analyze($text)
    {
        $lowercaseText = strtolower($text);

        // Extract positive and negative lexicon dictionaries from DB
        $positiveWords = PositiveWord::pluck('word')->map(fn($w) => strtolower(trim($w)))->toArray();
        $negativeWords = NegativeWord::pluck('word')->map(fn($w) => strtolower(trim($w)))->toArray();

        $positiveScore = 0;
        $negativeScore = 0;

        // 1. Check for multi-word phrases (e.g., "trade war")
        foreach ($positiveWords as $posWord) {
            if (str_contains($posWord, ' ') && str_contains($lowercaseText, $posWord)) {
                $positiveScore++;
            }
        }
        foreach ($negativeWords as $negWord) {
            if (str_contains($negWord, ' ') && str_contains($lowercaseText, $negWord)) {
                $negativeScore++;
            }
        }

        // 2. Tokenize clean single words removing punctuation
        $words = preg_split('/[^a-z0-9_]+/i', $lowercaseText, -1, PREG_SPLIT_NO_EMPTY);

        $singlePosWords = array_filter($positiveWords, fn($w) => !str_contains($w, ' '));
        $singleNegWords = array_filter($negativeWords, fn($w) => !str_contains($w, ' '));

        foreach ($words as $word) {
            if (in_array($word, $singlePosWords, true)) {
                $positiveScore++;
            }
            if (in_array($word, $singleNegWords, true)) {
                $negativeScore++;
            }
        }

        if ($positiveScore > $negativeScore) {
            $sentiment = 'Positive';
        } elseif ($negativeScore > $positiveScore) {
            $sentiment = 'Negative';
        } else {
            $sentiment = 'Neutral';
        }

        return [
            'sentiment' => $sentiment,
            'score' => max($positiveScore, $negativeScore),
            'positive_score' => $positiveScore,
            'negative_score' => $negativeScore
        ];
    }
}