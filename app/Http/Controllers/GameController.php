<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * 新しい試合結果の保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'home_team' => 'required|string',
            'away_team' => 'required|string',
            'home_total_score' => 'required|integer',
            'away_total_score' => 'required|integer',
            'home_total_hits' => 'required|integer',
            'away_total_hits' => 'required|integer',
            'home_total_errors' => 'required|integer',
            'away_total_errors' => 'required|integer',
        ]);

        for ($inning = 1; $inning <= 9; $inning++) {
            $request->validate([
                "home_inning_{$inning}" => 'required|integer',
                "away_inning_{$inning}" => 'required|integer',
            ]);
        }

        $game = Game::create($request->all());

        return response()->json(['message' => 'Game result saved successfully', 'data' => $game], 201);
    }

    /**
     * 全試合結果の一覧取得
     */
    public function index()
    {
        $games = Game::all();

        return response()->json($games);
    }

    /**
     * 特定の試合結果の取得
     */
    public function show($id)
    {
        $game = Game::find($id);

        if (is_null($game)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        return response()->json($game);
    }

    /**
     * 試合結果の更新
     */
    public function update(Request $request, $id)
    {
        $game = Game::find($id);

        if (is_null($game)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $game->update($request->all());

        return response()->json($game);
    }

    /**
     * 試合結果の削除
     */
    public function destroy($id)
    {
        $game = Game::find($id);

        if (is_null($game)) {
            return response()->json(['message' => 'Not Found'], 404);
        }

        $game->delete();

        return response()->json(null, 204);
    }

    /**
     * 試合結果の検索
     */
    public function search(Request $request)
    {
        $query = Game::query();

        if ($request->has('date')) {
            $query->where('date', $request->date);
        }

        if ($request->has('team')) {
            $query->where(function ($query) use ($request) {
                $query->where('home_team', $request->team)
                      ->orWhere('away_team', $request->team);
            });
        }

        $games = $query->get();

        return response()->json($games);
    }

    /**
     * 全チーム名の取得
     */
    public function teams()
    {
        $homeTeams = Game::select('home_team')->distinct()->pluck('home_team');
        $awayTeams = Game::select('away_team')->distinct()->pluck('away_team');

        $teams = $homeTeams->merge($awayTeams)->unique()->values();

        return response()->json($teams);
    }

    /**
     * 特定のチームの試合結果の取得
     */
    public function team($team)
    {
        $games = Game::where('home_team', $team)
                     ->orWhere('away_team', $team)
                     ->get();

        return response()->json($games);
    }
}
