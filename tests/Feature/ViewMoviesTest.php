<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/popular' => $this->fakePopularMovies(),
            'https://api.themoviedb.org/3/movie/now_playing' => $this->fakeNowPlayingMovies(),
            'https://api.themoviedb.org/3/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Adventure, Drama, Mystery, Science Fiction, Thriller');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }

    /** @test */
    public function the_movie_page_shows_the_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('Fake Jumanji');
        $response->assertSee('Jeanne McCarthy');
        $response->assertSee('Casting Director');
        $response->assertSee('Dwayne Johnson');
    }

    /** @test */
    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-dropdown')
            ->assertDontSee('jumanji')
            ->set('search', 'jumanji')
            ->assertSee('Jumanji');
    }

    private function fakeSearchMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "popularity" => 406.677,
                        "vote_count" => 2607,
                        "video" => false,
                        "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                        "id" => 419704,
                        "adult" => false,
                        "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                        "original_language" => "en",
                        "original_title" => "Jumanji",
                        "genre_ids" => [
                            12,
                            18,
                            9648,
                            878,
                            53,
                        ],
                        "title" => "Jumanji",
                        "vote_average" => 6,
                        "overview" => "Jumanji description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                        "release_date" => "2019-09-17",
                    ]
                ]
            ], 200);
    }

    private function fakePopularMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "popularity" => 406.677,
                        "vote_count" => 2607,
                        "video" => false,
                        "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                        "id" => 419704,
                        "adult" => false,
                        "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                        "original_language" => "en",
                        "original_title" => "Fake Movie",
                        "genre_ids" => [
                            12,
                            18,
                            9648,
                            878,
                            53,
                        ],
                        "title" => "Fake Movie",
                        "vote_average" => 6,
                        "overview" => "Fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                        "release_date" => "2019-09-17",
                    ]
                ]
            ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
                'results' => [
                    [
                        "popularity" => 406.677,
                        "vote_count" => 2607,
                        "video" => false,
                        "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                        "id" => 419704,
                        "adult" => false,
                        "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                        "original_language" => "en",
                        "original_title" => "Now Playing Fake Movie",
                        "genre_ids" => [
                            12,
                            18,
                            9648,
                            878,
                            53,
                        ],
                        "title" => "Now Playing Fake Movie",
                        "vote_average" => 6,
                        "overview" => "Now playing fake movie description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                        "release_date" => "2019-09-17",
                    ]
                ]
            ], 200);
    }

    public function fakeGenres()
    {
        return Http::response([
                'genres' => [
                    [
                      "id" => 28,
                      "name" => "Action"
                    ],
                    [
                      "id" => 12,
                      "name" => "Adventure"
                    ],
                    [
                      "id" => 16,
                      "name" => "Animation"
                    ],
                    [
                      "id" => 35,
                      "name" => "Comedy"
                    ],
                    [
                      "id" => 80,
                      "name" => "Crime"
                    ],
                    [
                      "id" => 99,
                      "name" => "Documentary"
                    ],
                    [
                      "id" => 18,
                      "name" => "Drama"
                    ],
                    [
                      "id" => 10751,
                      "name" => "Family"
                    ],
                    [
                      "id" => 14,
                      "name" => "Fantasy"
                    ],
                    [
                      "id" => 36,
                      "name" => "History"
                    ],
                    [
                      "id" => 27,
                      "name" => "Horror"
                    ],
                    [
                      "id" => 10402,
                      "name" => "Music"
                    ],
                    [
                      "id" => 9648,
                      "name" => "Mystery"
                    ],
                    [
                      "id" => 10749,
                      "name" => "Romance"
                    ],
                    [
                      "id" => 878,
                      "name" => "Science Fiction"
                    ],
                    [
                      "id" => 10770,
                      "name" => "TV Movie"
                    ],
                    [
                      "id" => 53,
                      "name" => "Thriller"
                    ],
                    [
                      "id" => 10752,
                      "name" => "War"
                    ],
                    [
                      "id" => 37,
                      "name" => "Western"
                    ],
                ]
            ], 200);
    }

    public function fakeSingleMovie()
    {
        return Http::response([
                "adult" => false,
                "backdrop_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                "genres" => [
                    ["id" => 28, "name" => "Action"],
                    ["id" => 12, "name" => "Adventure"],
                    ["id" => 35, "name" => "Comedy"],
                    ["id" => 14, "name" => "Fantasy"],
                ],
                "homepage" => "http://jumanjimovie.com",
                "id" => 12345,
                "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored.",
                "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
                "release_date" => "2019-12-04",
                "runtime" => 123,
                "title" => "Fake Jumanji: The Next Level",
                "vote_average" => 6.8,
                "credits" => [
                    "cast" => [
                        [
                            "cast_id" => 2,
                            "character" => "Dr. Smolder Bravestone",
                            "credit_id" => "5aac3960c3a36846ea005147",
                            "gender" => 2,
                            "id" => 18918,
                            "name" => "Dwayne Johnson",
                            "order" => 0,
                            "profile_path" => "/kuqFzlYMc2IrsOyPznMd1FroeGq.jpg",
                        ]
                    ],
                    "crew" => [
                        [
                            "credit_id" => "5d51d4ff18b75100174608d8",
                            "department" => "Production",
                            "gender" => 1,
                            "id" => 546,
                            "job" => "Casting Director",
                            "name" => "Jeanne McCarthy",
                            "profile_path" => null,
                        ]
                    ]
                ],
                "videos" => [
                    "results" => [
                        [
                            "id" => "5d1a1a9b30aa3163c6c5fe57",
                            "iso_639_1" => "en",
                            "iso_3166_1" => "US",
                            "key" => "rBxcF-r9Ibs",
                            "name" => "JUMANJI: THE NEXT LEVEL - Official Trailer (HD)",
                            "site" => "YouTube",
                            "size" => 1080,
                            "type" => "Trailer",
                        ]
                    ]
                ],
                "images" => [
                    "backdrops" => [
                        [
                            "aspect_ratio" => 1.7777777777778,
                            "file_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                            "height" => 2160,
                            "iso_639_1" => null,
                            "vote_average" => 5.388,
                            "vote_count" => 4,
                            "width" => 3840,
                        ]
                    ],
                    "posters" => [
                        [

                        ]
                    ]
                ]
            ], 200);
    }
}
