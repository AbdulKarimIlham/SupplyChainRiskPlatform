<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\NewsCache;
use App\Services\NewsService;
use App\Services\SentimentService;

class NewsController extends Controller
{
    public function index()
    {
        $news = NewsCache::with('country')->latest()->take(50)->get();
        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }

    public function show($code, NewsService $newsService, SentimentService $sentimentService)
    {
        $country = Country::where('code', strtoupper($code))->first();

        if (!$country) {
            return response()->json(['message' => 'Country not found'], 404);
        }

        $data = $newsService->search($country->name . " logistics trade economy");

        $articles = $data['articles'] ?? [];
        $result = [];
        $positiveCount = 0;
        $neutralCount = 0;
        $negativeCount = 0;

        if (empty($articles)) {
            // Fallback to existing cache if API yields empty result or rate limited
            $cached = NewsCache::where('country_id', $country->id)->latest()->take(10)->get();
            foreach ($cached as $item) {
                $sentimentLower = strtolower($item->sentiment);
                if ($sentimentLower === 'positive') $positiveCount++;
                elseif ($sentimentLower === 'negative') $negativeCount++;
                else $neutralCount++;

                $result[] = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    'source' => $item->source,
                    'sentiment' => $item->sentiment,
                    'sentiment_score' => $item->sentiment_score
                ];
            }
        } else {
            foreach ($articles as $article) {
                $text = ($article['title'] ?? '') . " " . ($article['description'] ?? '');
                $sentiment = $sentimentService->analyze($text);

                $sentimentStr = $sentiment['sentiment'];
                if ($sentimentStr === 'Positive') $positiveCount++;
                elseif ($sentimentStr === 'Negative') $negativeCount++;
                else $neutralCount++;

                $cache = NewsCache::create([
                    'country_id' => $country->id,
                    'title' => $article['title'] ?? 'No title',
                    'description' => $article['description'] ?? '',
                    'source' => $article['source']['name'] ?? 'GNews',
                    'sentiment' => $sentimentStr,
                    'sentiment_score' => $sentiment['score']
                ]);

                $result[] = [
                    'id' => $cache->id,
                    'title' => $article['title'],
                    'description' => $article['description'] ?? '',
                    'source' => $article['source']['name'] ?? 'GNews',
                    'sentiment' => $sentimentStr,
                    'sentiment_score' => $sentiment['score']
                ];
            }
        }

        $totalNews = count($result);
        $positivePct = $totalNews > 0 ? round(($positiveCount / $totalNews) * 100) : 0;
        $negativePct = $totalNews > 0 ? round(($negativeCount / $totalNews) * 100) : 0;
        $neutralPct = $totalNews > 0 ? 100 - ($positivePct + $negativePct) : 100;

        return response()->json([
            'success' => true,
            'country' => $country->name,
            'summary' => [
                'total' => $totalNews,
                'positive_percentage' => $positivePct,
                'neutral_percentage' => $neutralPct,
                'negative_percentage' => $negativePct
            ],
            'news' => $result
        ]);
    }
}