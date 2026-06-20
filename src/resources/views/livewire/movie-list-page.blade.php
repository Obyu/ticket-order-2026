<div class="min-h-screen bg-slate-950 text-white">

    <div
        id="movies"
        class="max-w-7xl mx-auto px-6 py-16"
    >

        @if($featuredMovies->isNotEmpty())

            <div
                x-data="{
                    current: 0,
                    total: {{ $featuredMovies->count() }}
                }"
                x-init="
                    setInterval(() => {
                        current = (current + 1) % total
                    }, 5000)
                "
                class="
                    relative
                    h-[400px]
                    md:h-[550px]
                    rounded-3xl
                    overflow-hidden
                    mb-16
                "
            >

                @foreach($featuredMovies as $index => $movie)

                    <div
                        x-show="current === {{ $index }}"
                        x-transition.opacity.duration.700ms
                        class="absolute inset-0"
                    >

                        <img
                            src="{{
                                str_starts_with($movie->banner, 'http')
                                    ? $movie->banner
                                    : Storage::url($movie->banner)
                            }}"
                            alt="{{ $movie->title }}"
                            class="
                                w-full
                                h-full
                                object-cover
                            "
                        >

                        <div
                            class="
                                absolute
                                inset-0
                                bg-gradient-to-r
                                from-black
                                via-black/80
                                to-transparent
                            "
                        ></div>

                        <div
                            class="
                                absolute
                                left-6
                                md:left-12
                                top-1/2
                                -translate-y-1/2
                                max-w-xl
                            "
                        >

                            <div
                                class="
                                    inline-block
                                    bg-amber-500
                                    text-black
                                    px-4
                                    py-2
                                    rounded-lg
                                    font-bold
                                    mb-4
                                "
                            >
                                NOW SHOWING
                            </div>

                            <h2
                                class="
                                    text-3xl
                                    md:text-6xl
                                    font-bold
                                    mb-4
                                "
                            >
                                {{ $movie->title }}
                            </h2>

                            <p
                                class="
                                    text-slate-300
                                    mb-8
                                "
                            >
                                {{
                                    Str::limit(
                                        strip_tags($movie->synopsis),
                                        150
                                    )
                                }}
                            </p>

                            <div class="flex gap-4 flex-wrap">

                                <a
                                    href="{{ route('movies.show', $movie) }}"
                                    class="
                                        px-6
                                        py-3
                                        bg-amber-500
                                        text-black
                                        rounded-xl
                                        font-bold
                                    "
                                >
                                    🎟 Book Now
                                </a>

                                @if($movie->trailer_url)

                                    <a
                                        href="{{ $movie->trailer_url }}"
                                        target="_blank"
                                        class="
                                            px-6
                                            py-3
                                            border
                                            border-white
                                            rounded-xl
                                        "
                                    >
                                        ▶ Trailer
                                    </a>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @endif

        <div
            class="
                flex
                justify-between
                items-center
                mb-8
            "
        >

            <h2 class="text-3xl font-bold">
                Now Showing
            </h2>

        </div>

        <input
            type="text"
            wire:model.live.debounce.500ms="search"
            placeholder="Cari film..."
            class="
                w-full
                mb-6
                px-5
                py-4
                rounded-xl
                bg-slate-900
                border
                border-slate-800
                text-white
                focus:outline-none
                focus:ring-2
                focus:ring-amber-500
            "
        >

        <div
            wire:loading
            wire:target="search"
            class="
                mb-6
                text-amber-500
                font-semibold
            "
        >
            🔄 Mencari film...
        </div>

        <div
            class="
                grid
                grid-cols-1
                sm:grid-cols-2
                lg:grid-cols-4
                gap-6
            "
        >

            @forelse($movies as $movie)

                <a
                    href="{{ route('movies.show', $movie) }}"
                    class="
                        bg-slate-900
                        border
                        border-slate-800
                        rounded-2xl
                        overflow-hidden
                        hover:scale-105
                        transition
                        duration-300
                    "
                >

                    <img
                        src="{{
                            str_starts_with($movie->poster, 'http')
                                ? $movie->poster
                                : Storage::url($movie->poster)
                        }}"
                        alt="{{ $movie->title }}"
                        class="
                            w-full
                            h-80
                            object-cover
                        "
                    >

                    <div class="p-4">

                        <div class="flex gap-2 flex-wrap mb-3">

                            @foreach($movie->genres as $genre)

                                <span
                                    class="
                                        px-2
                                        py-1
                                        text-xs
                                        rounded
                                        bg-slate-800
                                    "
                                >
                                    {{ $genre->name }}
                                </span>

                            @endforeach

                        </div>

                        <h3
                            class="
                                text-lg
                                font-bold
                                mb-2
                            "
                        >
                            {{ $movie->title }}
                        </h3>

                        <p
                            class="
                                text-slate-400
                                mb-4
                            "
                        >
                            {{ $movie->duration }} Menit
                        </p>

                        <div
                            class="
                                inline-block
                                px-4
                                py-2
                                rounded-lg
                                bg-amber-500
                                text-black
                                font-semibold
                            "
                        >
                            Detail Film
                        </div>

                    </div>

                </a>

            @empty

                <div
                    class="
                        col-span-full
                        text-center
                        py-20
                        bg-slate-900
                        border
                        border-slate-800
                        rounded-3xl
                    "
                >

                    <div class="text-6xl mb-4">
                        🎬
                    </div>

                    <h3
                        class="
                            text-2xl
                            font-bold
                            mb-2
                        "
                    >
                        Film Tidak Ditemukan
                    </h3>

                    <p class="text-slate-400">
                        Coba kata kunci lain.
                    </p>

                </div>

            @endforelse

        </div>

    </div>

    <livewire:feature-section />

    <livewire:footer-section />

</div>t