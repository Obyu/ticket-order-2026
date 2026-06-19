<div class="min-h-screen bg-slate-950 text-white">

```
<div class="max-w-7xl mx-auto">

    {{-- Banner --}}
    <img
        src="{{ Storage::url($movie->banner) }}"
        alt="{{ $movie->title }}"
        class="
            w-full
            h-[500px]
            object-cover
        "
    >

    <div class="px-6 py-12">

        <div class="grid md:grid-cols-3 gap-10">

            {{-- Poster --}}
            <div>

                <img
                    src="{{ Storage::url($movie->poster) }}"
                    alt="{{ $movie->title }}"
                    class="
                        w-full
                        rounded-2xl
                        shadow-lg
                    "
                >

            </div>

            {{-- Detail --}}
            <div class="md:col-span-2">

                <div
                    class="
                        inline-block
                        px-4
                        py-2
                        rounded-lg
                        bg-amber-500
                        text-black
                        font-semibold
                        mb-4
                    "
                >
                    NOW SHOWING
                </div>

                <h1
                    class="
                        text-5xl
                        font-bold
                        mb-4
                    "
                >
                    {{ $movie->title }}
                </h1>

                <div
                    class="
                        flex
                        flex-wrap
                        gap-3
                        mb-6
                    "
                >

                    @foreach($movie->genres as $genre)

                        <span
                            class="
                                px-3
                                py-1
                                rounded-full
                                bg-slate-800
                                text-slate-300
                            "
                        >
                            {{ $genre->name }}
                        </span>

                    @endforeach

                </div>

                <div
                    class="
                        text-slate-400
                        mb-8
                    "
                >
                    ⏱ {{ $movie->duration }} Menit
                </div>

                <div
                    class="
                        prose
                        prose-invert
                        max-w-none
                    "
                >
                    {!! $movie->synopsis !!}
                </div>

            </div>

        </div>

        {{-- Schedule --}}
        <div class="mt-20">

            <h2
                class="
                    text-3xl
                    font-bold
                    mb-8
                "
            >
                Pilih Jadwal
            </h2>

            <div class="grid md:grid-cols-3 gap-6">

                @foreach ($movie->schedules as $schedule)

                    <a
                        href="{{ route('booking.seats', $schedule) }}"
                        class="
                            bg-slate-900
                            border
                            border-slate-800
                            rounded-2xl
                            p-6
                            hover:border-amber-500
                            hover:scale-105
                            transition
                        "
                    >

                        <div
                            class="
                                text-xl
                                font-bold
                                mb-3
                            "
                        >
                            {{ $schedule->studio->name }}
                        </div>

                        <div
                            class="
                                text-3xl
                                font-bold
                                text-amber-500
                                mb-3
                            "
                        >
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}
                        </div>

                        <div class="text-slate-400">

                            Rp
                            {{ number_format(
                                $schedule->price,
                                0,
                                ',',
                                '.'
                            ) }}

                        </div>

                    </a>

                @endforeach

            </div>

        </div>

    </div>

</div>
```

</div>
